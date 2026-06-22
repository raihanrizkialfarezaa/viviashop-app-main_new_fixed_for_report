<?php

namespace App\Http\Requests\AI;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates the payload for both /ai/chat and /admin/ai-assistant/chat.
 */
class AIChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Authorization is handled by route middleware (auth, is_admin).
        // Public chat (UC1) is allowed without auth.
        return true;
    }

    public function rules(): array
    {
        return [
            'message'             => ['required', 'string', 'min:1', 'max:2000'],
            'print_session_token' => ['nullable', 'string', 'max:64'],
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.max'      => 'Pesan terlalu panjang (maksimal 2000 karakter).',
        ];
    }
}
