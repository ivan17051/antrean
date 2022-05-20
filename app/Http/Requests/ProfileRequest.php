<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idpasien' => 'required_with:nik,nama,jeniskelamin,tgllahir,alamat|integer',
            'email' => 'required_without:idpasien',
            'nohp' => 'required_without:idpasien',
            'nik' => 'nullable|string',
            'nama' => 'nullable|string',
            'jeniskelamin' => 'nullable|string',
            'tgllahir' => 'nullable|string',
            'alamat' => 'nullable|string',
        ];
    }
}
