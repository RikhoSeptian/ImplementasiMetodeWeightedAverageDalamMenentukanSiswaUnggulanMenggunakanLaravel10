<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuruRequest extends FormRequest
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
        return [
            'name' => ['required'],
            // 'gelar' => ['required'],
            // 'jk' => ['required'],
            'nip' => ['nullable','unique:gurus'],
            'nuptk' => ['nullable','unique:gurus'],
            // 'tempatlahir' => ['required'],
            // 'tanggallahir' => ['required'],
            // 'alamat' => ['required'],
            // 'telepon' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama wajib diisi.',
            'gelar.required'    => 'Kolom gelar wajib diisi.',
            'jk.required'   => 'Kolom jenis kelamin wajib diisi.',
            // 'nip.numeric'   => 'NIP harus berupa angka.',
            // 'nip.max'   => 'NIP tidak boleh lebih dari 18 digit.',
            // 'nuptk.numeric' => 'NUPTK harus berupa angka.',
            // 'nuptk.max' => 'NUPTK tidak boleh lebih dari 18 digit.',
            'tempatlahir.required'  => 'Kolom tempat lahir wajib diisi.',
            'tanggallahir.required' => 'Kolom tanggal lahir wajib diisi.',
            'alamat.required'   => 'Kolom alamat wajib diisi.',
            'telepon.required'  => 'Kolom telepon wajib diisi.',
            'telepon.numeric'   => 'Kolom telepon harus berupa angka.',
        ];
    }
}
