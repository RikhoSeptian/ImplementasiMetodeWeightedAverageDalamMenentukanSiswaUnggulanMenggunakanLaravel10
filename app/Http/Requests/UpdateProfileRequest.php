<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $unique = Rule::unique('users')->ignore(auth()->user()->id); // Pengeculian Unique Saat Update

        $role = auth()->user()->role;

        if ($role == 'admin' || $role == 'guru') {
            return [
                'name'      => ['required'],
                // 'gelar'     => ['required'],
                // 'jk'        => ['required'],
                // 'nip'       => ['numeric'],
                // 'nuptk'     => ['numeric'],
                // 'tempatlahir'  => ['required'],
                // 'tanggallahir' => ['required'],
                // 'alamat'       => ['required'],
                // 'telepon'      => ['required', 'numeric'],
            ];
        } elseif ($role == 'siswa') {
            return [
                // 'token' => ['required'],
                // 'jk' => ['required'],
                // 'tempatlahir' => ['required'],
                // 'tanggallahir' => ['required'],
                // 'telepon' => ['required', 'numeric'],
            ];
        }
    }
}
