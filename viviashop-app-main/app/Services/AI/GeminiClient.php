<?php

namespace App\Services\AI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

/**
 * Thin Guzzle wrapper around the Gemini generateContent REST endpoint.
 * Handles retries, timeout, and response normalisation.
 */
class GeminiClient
{
    private Client $http;
    private string $apiKey;
    private string $model;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey  = config('ai.gemini.api_key', '');
        $this->model   = config('ai.gemini.model', 'gemini-1.5-flash');
        $this->baseUrl = config('ai.gemini.base_url', 'https://generativelanguage.googleapis.com/v1beta');

        $isLocalhost = in_array(request()->getHost(), ['localhost', '127.0.0.1', '::1'])
            || str_contains(request()->getHost(), '.local')
            || str_contains(request()->getHost(), 'laragon')
            || PHP_SAPI === 'cli';

        $curlOptions = [];
        if ($isLocalhost) {
            // Disable SSL verification on local dev (same pattern as PrintService)
            $curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ];
        }

        $this->http = new Client([
            'timeout'         => config('ai.gemini.timeout', 60),
            'connect_timeout' => 10,
            'curl'            => $curlOptions,
        ]);
    }

    /**
     * Call Gemini generateContent.
     *
     * @param array<int, array>  $contents  Gemini `contents` array (turn history)
     * @param array              $tools     Gemini `tools` array (function declarations)
     * @param string             $systemInstruction  Plain-text system prompt
     *
     * @return array  Decoded Gemini response body
     *
     * @throws \RuntimeException on HTTP or API error
     */
    public function generateContent(array $contents, array $tools = [], string $systemInstruction = ''): array
    {
        $url = "{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}";

        $sanitizedContents = [];
        foreach ($contents as $turn) {
            $sanitizedTurn = $turn;
            if (isset($sanitizedTurn['parts']) && is_array($sanitizedTurn['parts'])) {
                foreach ($sanitizedTurn['parts'] as &$part) {
                    if (isset($part['functionCall'])) {
                        $args = $part['functionCall']['args'] ?? null;
                        if ($args === null || (is_array($args) && count($args) === 0)) {
                            $part['functionCall']['args'] = (object)[];
                        }
                    }
                    if (isset($part['functionResponse'])) {
                        $response = $part['functionResponse']['response'] ?? null;
                        if ($response === null || (is_array($response) && count($response) === 0)) {
                            $part['functionResponse']['response'] = (object)[];
                        }
                    }
                }
                unset($part);
            }
            $sanitizedContents[] = $sanitizedTurn;
        }

        $body = ['contents' => $sanitizedContents];

        if (! empty($tools)) {
            $body['tools'] = $tools;
        }

        if ($systemInstruction !== '') {
            $body['systemInstruction'] = [
                'parts' => [['text' => $systemInstruction]],
            ];
        }

        $maxRetries = 3;
        $attempt    = 0;

        while ($attempt < $maxRetries) {
            try {
                Log::info('GeminiClient request payload', ['body' => $body]);
                $response = $this->http->post($url, [
                    'json'    => $body,
                    'headers' => ['Content-Type' => 'application/json'],
                ]);

                $responseBodyStr = (string) $response->getBody();
                Log::info('GeminiClient response raw', ['response' => $responseBodyStr]);
                $decoded = json_decode($responseBodyStr, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \RuntimeException('Gemini returned non-JSON response.');
                }

                return $decoded;

            } catch (GuzzleException $e) {
                $statusCode = method_exists($e, 'getResponse') && $e->getResponse()
                    ? $e->getResponse()->getStatusCode()
                    : 0;

                $responseBody = '';
                if (method_exists($e, 'getResponse') && $e->getResponse()) {
                    $responseBody = (string) $e->getResponse()->getBody();
                }

                // Retry on 429 (rate limit) or 503 (service unavailable)
                if (in_array($statusCode, [429, 503]) && $attempt < $maxRetries - 1) {
                    $attempt++;
                    $waitSeconds = $attempt * 15; // 15s, 30s backoff
                    Log::warning("GeminiClient: HTTP {$statusCode}, retrying in {$waitSeconds}s (attempt {$attempt}/{$maxRetries})");
                    sleep($waitSeconds);
                    continue;
                }

                Log::error('GeminiClient HTTP error', [
                    'message' => $e->getMessage(),
                    'status_code' => $statusCode,
                    'response_body' => $responseBody,
                    'request_contents' => json_encode($contents, JSON_PRETTY_PRINT),
                ]);
                throw new \RuntimeException('Gemini API request failed: ' . ($responseBody ?: $e->getMessage()), 0, $e);
            }
        }

        throw new \RuntimeException('Gemini API request failed after ' . $maxRetries . ' attempts.');
    }

    /**
     * Extract the first text part from a Gemini response.
     */
    public function extractText(array $response): string
    {
        return $response['candidates'][0]['content']['parts'][0]['text'] ?? '';
    }

    /**
     * Extract a functionCall part from a Gemini response, if present.
     *
     * @return array{name: string, args: array}|null
     */
    public function extractFunctionCall(array $response): ?array
    {
        $parts = $response['candidates'][0]['content']['parts'] ?? [];

        foreach ($parts as $part) {
            if (isset($part['functionCall'])) {
                return [
                    'name' => $part['functionCall']['name'],
                    'args' => $part['functionCall']['args'] ?? [],
                ];
            }
        }

        return null;
    }

    /**
     * Check whether the response finished normally (no more tool calls needed).
     */
    public function isFinished(array $response): bool
    {
        $finishReason = $response['candidates'][0]['finishReason'] ?? '';
        return in_array($finishReason, ['STOP', 'MAX_TOKENS', ''], true)
            && $this->extractFunctionCall($response) === null;
    }
}
