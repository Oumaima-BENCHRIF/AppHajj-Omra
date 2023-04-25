<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gestion_UtilisateursPostRequest extends FormRequest
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
            'nom_utilisateur' => 'required',
            'Email' => 'required|email',
            'mot_passe' => 'required',
            'ville' => 'required',
            'address' => 'required',
            'Nom_DB' => 'required_if:Nom_DB,super-admin',
            'privilege' => 'required',
            'telephone' => 'required',

        ];
    }
}
