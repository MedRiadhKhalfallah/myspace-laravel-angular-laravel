<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitCreateRequest extends FormRequest
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
            'reference' => 'required|max:255',

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
            'reference.required' => 'le :attribute est opligatoire.',
            'reference.max' => 'le titre doit etre inferieur a 255 carectaire.',
        ];
    }

}
