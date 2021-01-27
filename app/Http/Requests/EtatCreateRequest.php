<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EtatCreateRequest extends FormRequest
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
            'nom' => 'required|max:255',
            'order' => 'required|max:255',

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
            'nom.required' => 'le :attribute est opligatoire.',
            'nom.max' => 'le titre doit etre inferieur a 255 carectaire.',
            'order.required' => 'le :attribute est opligatoire.',
            'order.max' => 'le titre doit etre inferieur a 255 carectaire.',
        ];
    }

}
