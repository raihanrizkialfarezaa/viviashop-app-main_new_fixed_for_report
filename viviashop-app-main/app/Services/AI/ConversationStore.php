<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Session;

/**
 * Stores and retrieves per-session Gemini conversation history.
 *
 * History is kept in the Laravel session as a flat array of Gemini
 * `contents` objects (role + parts). The length is capped by
 * config('ai.agent.history_length') to avoid unbounded session growth.
 */
class ConversationStore
{
    private int    $maxLength;
    private string $prefix;

    public function __construct()
    {
        $this->maxLength = (int) config('ai.agent.history_length', 20);
        $this->prefix    = config('ai.agent.session_prefix', 'ai_conversation_');
    }

    /**
     * Return the full conversation history for a session key.
     *
     * @return array<int, array{role: string, parts: array}>
     */
    public function get(string $sessionKey): array
    {
        $history = Session::get($this->prefix . $sessionKey, []);
        return $this->sanitizeHistory($history);
    }

    /**
     * Append a new turn (user or model) to the history.
     *
     * @param array{role: string, parts: array} $turn
     */
    public function append(string $sessionKey, array $turn): void
    {
        $key     = $this->prefix . $sessionKey;
        $history = Session::get($key, []);
        $history[] = $turn;

        $history = $this->sanitizeHistory($history);
        $history = $this->safeSlice($history, $this->maxLength);

        Session::put($key, $history);
    }

    /**
     * Replace the entire history (used after a full agent turn completes).
     *
     * @param array<int, array{role: string, parts: array}> $history
     */
    public function set(string $sessionKey, array $history): void
    {
        $history = $this->sanitizeHistory($history);
        $history = $this->safeSlice($history, $this->maxLength);
        Session::put($this->prefix . $sessionKey, $history);
    }

    /**
     * Strip out orphaned function calls and responses to keep history sequence valid,
     * and ensure roles (user/model) strictly alternate.
     */
    private function sanitizeHistory(array $history): array
    {
        // Step 1: Pair up functionCall and functionResponse turns, discard orphans.
        $paired = [];
        $i = 0;
        $n = count($history);
        while ($i < $n) {
            $turn = $history[$i];
            
            $isCall = false;
            if (isset($turn['parts']) && is_array($turn['parts'])) {
                foreach ($turn['parts'] as $part) {
                    if (isset($part['functionCall'])) {
                        $isCall = true;
                        break;
                    }
                }
            }
            
            $isResponse = false;
            if (isset($turn['parts']) && is_array($turn['parts'])) {
                foreach ($turn['parts'] as $part) {
                    if (isset($part['functionResponse'])) {
                        $isResponse = true;
                        break;
                    }
                }
            }
            
            if ($isCall) {
                // Check if next turn is a function response
                if ($i + 1 < $n) {
                    $nextTurn = $history[$i + 1];
                    $nextIsResponse = false;
                    if (isset($nextTurn['parts']) && is_array($nextTurn['parts'])) {
                        foreach ($nextTurn['parts'] as $part) {
                            if (isset($part['functionResponse'])) {
                                $nextIsResponse = true;
                                break;
                            }
                        }
                    }
                    
                    if ($nextIsResponse) {
                        $paired[] = $turn;
                        $paired[] = $nextTurn;
                        $i += 2;
                        continue;
                    }
                }
                // Discard orphaned functionCall
                \Illuminate\Support\Facades\Log::warning('ConversationStore: Discarded orphaned functionCall');
                $i++;
            } elseif ($isResponse) {
                // Discard orphaned functionResponse
                \Illuminate\Support\Facades\Log::warning('ConversationStore: Discarded orphaned functionResponse');
                $i++;
            } else {
                $paired[] = $turn;
                $i++;
            }
        }

        // Step 2: Ensure alternating roles
        $alternated = [];
        foreach ($paired as $turn) {
            if (empty($alternated)) {
                $alternated[] = $turn;
                continue;
            }
            
            $lastIdx = count($alternated) - 1;
            $lastTurn = $alternated[$lastIdx];
            
            if ($lastTurn['role'] === $turn['role']) {
                $lastHasSpecial = false;
                if (isset($lastTurn['parts']) && is_array($lastTurn['parts'])) {
                    foreach ($lastTurn['parts'] as $part) {
                        if (isset($part['functionCall']) || isset($part['functionResponse'])) {
                            $lastHasSpecial = true;
                            break;
                        }
                    }
                }
                
                $currHasSpecial = false;
                if (isset($turn['parts']) && is_array($turn['parts'])) {
                    foreach ($turn['parts'] as $part) {
                        if (isset($part['functionCall']) || isset($part['functionResponse'])) {
                            $currHasSpecial = true;
                            break;
                        }
                    }
                }
                
                if ($lastHasSpecial && !$currHasSpecial) {
                    // Keep the special turn, discard the text turn
                    continue;
                } elseif (!$lastHasSpecial && $currHasSpecial) {
                    // Replace the text turn with the special turn
                    $alternated[$lastIdx] = $turn;
                } else {
                    // Both are text turns or both are special. Merge parts.
                    $alternated[$lastIdx]['parts'] = array_merge($lastTurn['parts'] ?? [], $turn['parts'] ?? []);
                }
            } else {
                $alternated[] = $turn;
            }
        }

        return $alternated;
    }

    /**
     * Slice history to maxLength, ensuring we don't start with a functionResponse.
     */
    private function safeSlice(array $history, int $maxLength): array
    {
        if (count($history) <= $maxLength) {
            return $history;
        }

        $sliceStart = count($history) - $maxLength;

        while ($sliceStart > 0) {
            $firstElement = $history[$sliceStart];
            $isResponse = false;
            if (isset($firstElement['parts']) && is_array($firstElement['parts'])) {
                foreach ($firstElement['parts'] as $part) {
                    if (isset($part['functionResponse'])) {
                        $isResponse = true;
                        break;
                    }
                }
            }

            if ($isResponse) {
                $sliceStart--;
            } else {
                break;
            }
        }

        return array_slice($history, $sliceStart);
    }

    /**
     * Clear the conversation history for a session key.
     */
    public function clear(string $sessionKey): void
    {
        Session::forget($this->prefix . $sessionKey);
    }

    /**
     * Derive a stable session key from the request context.
     * Uses the authenticated user ID if available, otherwise the session ID.
     */
    public function keyFromContext(Context $ctx): string
    {
        if ($ctx->user) {
            return 'user_' . $ctx->user->id;
        }

        return 'guest_' . Session::getId();
    }
}
