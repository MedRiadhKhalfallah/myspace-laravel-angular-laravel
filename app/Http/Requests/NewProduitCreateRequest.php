<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewProduitCreateRequest extends FormRequest
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
            'titre' => 'required|max:255',
            'sous_category_id' => 'required',
            'modele_id' => 'required',
            'quantite' => 'required'
        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'titre.required' => 'le :attribute est opligatoire.',
            'marque_id.required' => 'la marque est opligatoire.',
            'modele_id.required' => 'la marque est opligatoire.',
            'quantite.required' => 'quantite est opligatoire.',
            'titre.max' => 'le titre doit etre inferieur a 255 carectaire.',
        ];
    }
}
