<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAkunRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $unique = Rule::unique('users')->ignore('id'); // Pengecualian Unique Saat Update
        
        return [
            'username' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username wajib diisi.',
        ];
    }
}
