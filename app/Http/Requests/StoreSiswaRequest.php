<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
            // 'kelas_id' => ['required'],
            // 'name' => ['required'],
            // 'jk' => ['required'],
            // 'jenispendaftaran' => ['required'],
            // 'diterimapada' => ['required'],
            'nis' => ['required', 'unique:siswas'],
            'nisn' => ['required', 'unique:siswas'],
            // 'tempatlahir' => ['required'],
            // 'tanggallahir' => ['required'],
            // 'agama' => ['required'],
            // 'statusdalamkeluarga' => ['required'],
            // 'anak_ke' => ['required'],
            // 'alamat' => ['required'],
            // 'telepon' => ['required'],
            // 'namaayah' => ['required'],
            // 'namaibu' => ['required'],
            // 'namawali' => ['required'],
            // 'pekerjaanayah' => ['required'],
            // 'pekerjaanibu' => ['required'],
            // 'pekerjaanwali' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Kolom username wajib diisi.',
            'username.unique' => 'Username sudah digunakan. Silakan pilih username lain.',
            'password.required' => 'Kolom password wajib diisi.',
            'kelas_id.required' => 'Kolom kelas wajib diisi.',
            'name.required' => 'Kolom nama wajib diisi.',
            'jk.required' => 'Kolom jenis kelamin wajib diisi.',
            'jenispendaftaran.required' => 'Kolom jenis pendaftaran wajib diisi.',
            'diterimapada.required' => 'Kolom diterima pada wajib diisi.',
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.max' => 'Kolom NIS maksimal 10 karakter.',
            'nisn.required' => 'Kolom NISN wajib diisi.',
            'nisn.max' => 'Kolom NISN maksimal 12 karakter.',
            'tempatlahir.required' => 'Kolom tempat lahir wajib diisi.',
            'tanggallahir.required' => 'Kolom tanggal lahir wajib diisi.',
            'agama.required' => 'Kolom agama wajib diisi.',
            'statusdalamkeluarga.required' => 'Kolom status dalam keluarga wajib diisi.',
            'anak_ke.required' => 'Kolom anak ke wajib diisi.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            // 'telepon.required' => 'Kolom telepon wajib diisi.',
            // 'namaayah.required' => 'Kolom nama ayah wajib diisi.',
            // 'namaibu.required' => 'Kolom nama ibu wajib diisi.',
            // 'namawali.required' => 'Kolom nama wali wajib diisi.',
            // 'pekerjaanayah.required' => 'Kolom pekerjaan ayah wajib diisi.',
            // 'pekerjaanibu.required' => 'Kolom pekerjaan ibu wajib diisi.',
            // 'pekerjaanwali.required' => 'Kolom pekerjaan wali wajib diisi.',
        ];
    }
}
