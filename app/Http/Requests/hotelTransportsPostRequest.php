<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class hotelTransportsPostRequest extends FormRequest
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
           
            'code' => 'required',
            'nom' => 'required',
            'ville' => 'required',
            'emplacement' => 'required',
            'telephone' => 'required',
            'fax' => 'required',
            'site' => 'required',
            'compte_comptable_ramadan' => 'required',
            'compte_comptable_mouloud' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'categorie' => 'required',
            'nom_en_arabe' => 'required',
            'type' => 'required',
        ];
    }
}
