<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'name'      => ['required'],
            'gelar'     => ['required'],
            'jk'        => ['required'],
            // 'nip' => ['numeric', 'max:18'],
            // 'nuptk' => ['numeric', 'max:18'],
            'tempatlahir'  => ['required'],
            'tanggallahir' => ['required'],
            'alamat'       => ['required'],
            'telepon'      => ['required', 'numeric'],
        ];
    }
}
