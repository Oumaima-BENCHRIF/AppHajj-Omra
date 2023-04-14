<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentsPostRequest extends FormRequest
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
            'code_agents'=>'required',
            'nom_agents'=>'required',
            'telephone'=>'required',
            'fax'=>'required',
            'adresse'=>'required',
        ];
    }
}
