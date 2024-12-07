<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SekolahRequest extends FormRequest
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
            // 'npsn' => ['required'],
            // 'nss' => ['numeric', 'nullable'],
            // 'kodepos' => ['numeric'],
            // 'telepon' => ['required', 'numeric'],
            // 'alamat' => ['required'],
            // 'website' => ['required'],
            // 'email' => ['required', 'email'],
            // 'alamat' => ['required'],
            // 'kepsek' => ['required'],
            'nuptkkepsek' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama sekolah wajib diisi.',
            'npsn.required' => 'Kolom NPSN wajib diisi.',
            'nss.numeric' => 'Kolom NSS harus berupa angka.',
            'kodepos.numeric' => 'Kolom kode pos harus berupa angka.',
            'telepon.required' => 'Kolom telepon wajib diisi.',
            'telepon.numeric' => 'Kolom telepon harus berupa angka.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'website.required' => 'Kolom website wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Kolom email harus berformat email yang valid.',
            'kepsek.required' => 'Kolom nama kepala sekolah wajib diisi.',
            'nuptkkepsek.required' => 'Kolom NUPTK kepala sekolah wajib diisi.',
        ];
    }
}
