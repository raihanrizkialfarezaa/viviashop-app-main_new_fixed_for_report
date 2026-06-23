<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'title' => ['required', 'max:255', 'string'],
                    'url' => ['nullable', 'max:255', 'string'],
                    'path' => ['required', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
                    'body' => ['nullable', 'string'],
                    'status' => ['required', 'string']
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => ['required', 'max:255', 'string'],
                    'url' => ['nullable', 'max:255', 'string'],
                    'path' => ['nullable', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
                    'body' => ['nullable', 'string'],
                    'status' => ['required', 'string']
                ];
            }
            default: break;
        }
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul slide wajib diisi.',
            'title.max' => 'Judul slide maksimal 255 karakter.',
            'title.string' => 'Judul slide harus berupa teks.',
            'url.max' => 'URL maksimal 255 karakter.',
            'url.string' => 'URL harus berupa teks.',
            'path.required' => 'Gambar slide wajib diunggah.',
            'path.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau webp.',
            'path.max' => 'Ukuran gambar maksimal 4MB (4096KB).',
            'path.uploaded' => 'Gagal mengunggah gambar. Periksa ukuran file (maks 4MB) atau coba file lain.',
            'body.string' => 'Deskripsi harus berupa teks.',
            'status.required' => 'Status slide wajib dipilih.',
            'status.string' => 'Status harus berupa teks.',
        ];
    }
}
