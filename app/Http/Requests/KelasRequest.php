<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KelasRequest extends FormRequest
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
        $unique = Rule::unique('kelas')->ignore($this->id);

        return [
            'name' => ['required', $unique],
            'guru_id' => ['required'],
            'tingkat' => ['required'],
            'tapel_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama kelas wajib diisi.',
            'name.unique' => 'Nama sudah digunakan. Silakan pilih nama lain.',
            'guru_id.required' => 'Kolom ID guru wajib diisi.',
            'tingkat.required' => 'Kolom tingkat wajib diisi.',
            'tapel_id.required' => 'Kolom ID tahun pelajaran wajib diisi.',
        ];
    }
}
