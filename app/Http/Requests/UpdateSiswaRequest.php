<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
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
            // 'jk' => ['required'],
            // 'jenispendaftaran' => ['required'],
            // 'diterimapada' => ['required'],
            'nis' => ['nullable','unique:siswas'],
            'nisn' => ['nullable','unique:siswas'],
            // 'tempatlahir' => ['required'],
            // 'tanggallahir' => ['required'],
            // 'agama' => ['required'],
            // 'statusdalamkeluarga' => ['required'],
            // 'anak_ke' => ['required'],
            // 'alamat' => ['required'],
            // 'status' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'jk.required' => 'Jenis kelamin wajib diisi.',
            'jenispendaftaran.required' => 'Jenis pendaftaran wajib diisi.',
            'diterimapada.required' => 'Field diterima pada wajib diisi.',
            'nis.unique' => 'NIS sudah ada. ',
            'nisn.unique' => 'NISN sudah ada.',
            // 'nis.required' => 'NIS wajib diisi.',
            // 'nis.max' => 'NIS tidak boleh lebih dari 8 karakter.',
            // 'nisn.required' => 'NISN wajib diisi.',
            // 'nisn.max' => 'NISN tidak boleh lebih dari 10 karakter.',
            'tempatlahir.required' => 'Tempat lahir wajib diisi.',
            'tanggallahir.required' => 'Tanggal lahir wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'statusdalamkeluarga.required' => 'Status dalam keluarga wajib diisi.',
            'anak_ke.required' => 'Anak ke-berapa wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ];
    }
}
