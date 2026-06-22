<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\ToolHandler;
use Illuminate\Support\Collection;

/**
 * Holds all registered ToolHandler instances.
 * Tools are registered by the AIToolServiceProvider.
 * The registry can be filtered by role to produce the Gemini
 * function-declaration list for a given request surface.
 */
class ToolRegistry
{
    /** @var array<string, ToolHandler> */
    private array $tools = [];

    public function register(ToolHandler $tool): void
    {
        $this->tools[$tool->name()] = $tool;
    }

    public function get(string $name): ?ToolHandler
    {
        return $this->tools[$name] ?? null;
    }

    /** @return array<string, ToolHandler> */
    public function all(): array
    {
        return $this->tools;
    }

    /**
     * Return tools whose requiredRole is accessible by the given role.
     * Role hierarchy: admin > auth > public
     *
     * @return Collection<string, ToolHandler>
     */
    public function forRole(string $role): Collection
    {
        $allowed = match ($role) {
            'admin'  => ['public', 'auth', 'admin'],
            'auth'   => ['public', 'auth'],
            default  => ['public'],
        };

        return collect($this->tools)->filter(
            fn (ToolHandler $t) => in_array($t->requiredRole(), $allowed, true)
        );
    }

    /**
     * Build the Gemini `tools` payload for a given role.
     * Returns an array suitable for the `tools` key in the Gemini request body.
     *
     * @return array<int, array{functionDeclarations: array}>
     */
    public function toGeminiDeclarations(string $role): array
    {
        $declarations = $this->forRole($role)->map(fn (ToolHandler $t) => [
            'name'        => $t->name(),
            'description' => $t->description(),
            'parameters'  => $t->parameters(),
        ])->values()->all();

        if (empty($declarations)) {
            return [];
        }

        return [['functionDeclarations' => $declarations]];
    }
}
