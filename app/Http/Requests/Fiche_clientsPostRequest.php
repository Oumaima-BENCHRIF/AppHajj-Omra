<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Fiche_clientsPostRequest extends FormRequest
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
             
            'compte' => 'required',
            'nom' => 'required',
            'adresse' => 'required',
            'C_postal' => 'required',
            'contact_commercial' => 'required',
            'telephone_commercial' => 'required',
            'mobile_commercial' => 'required',
            'ville_client' => 'required',
            'tele_client' => 'required',
            'email_client' => 'required|email',
            'pays_client' => 'required',
            'fax_client' => 'required',
            'marge_client' => 'required',
            'Remarques' => 'required',
        ];
    }
}
