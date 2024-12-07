<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePembelajaranRequest extends FormRequest
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
            'kelas_id' => ['required'],
            'mapel_id' => ['required'],
            'guru_id' => ['required'],
            'kkm' => ['required', 'numeric', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'kelas_id.required' => 'Kolom kelas wajib diisi.',
            'mapel_id.required' => 'Kolom mata pelajaran wajib diisi.',
            'guru_id.required' => 'Kolom guru wajib diisi.',
            'kkm.required' => 'Kolom KKM wajib diisi.',
            'kkm.numeric' => 'Kolom KKM harus berupa angka.',
            'kkm.max' => 'Kolom KKM maksimal bernilai 100.',
        ];
    }
}
