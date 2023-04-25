<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompagniesPostRequests extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code_cie' => 'required',
            'compagnie' => 'required',
            'telephone' => 'required',
            'fax' => 'required',
            'adresse' => 'required',
            'directeur' => 'required',
            'tel_directeur' => 'required',
            'nom_en_arabe' => 'required',
            'compte_comptable_BSP' => 'required',
            'compte_comptable_normal' => 'required',
        ];
    }
}
