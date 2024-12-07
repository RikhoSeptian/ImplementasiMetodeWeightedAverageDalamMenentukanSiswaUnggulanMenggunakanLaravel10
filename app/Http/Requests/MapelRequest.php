<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MapelRequest extends FormRequest
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
        $unique = Rule::unique('mapels')->ignore($this->id);

        return [
            'name' => ['required', $unique],
            'singkatan' => ['required'],
            'kelompok' => ['required'],
            'tapel_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama wajib diisi.',
            'name.unique' => 'Nama sudah digunakan. Silakan pilih nama lain.',
            'singkatan.required' => 'Kolom singkatan wajib diisi.',
            'kelompok.required' => 'Kolom kelompok wajib diisi.',
            'tapel_id.required' => 'Kolom tahun pelajaran wajib diisi.',
        ];
    }
}
