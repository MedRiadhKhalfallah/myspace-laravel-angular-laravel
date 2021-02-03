<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeActiviteCreateRequest extends FormRequest
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
            'nom'=>'required|max:255',
            'coleur'=>'required|max:255',
            'iconUrl'=>'required|max:255',
            'map_legende'=>'required|max:255'
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
            'coleur.required' => 'le :attribute est opligatoire.',
            'coleur.max' => 'le titre doit etre inferieur a 255 carectaire.',
            'iconUrl.required' => 'le :attribute est opligatoire.',
            'iconUrl.max' => 'le titre doit etre inferieur a 255 carectaire.',
            'map_legende.required' => 'le :attribute est opligatoire.',
            'map_legende.max' => 'le titre doit etre inferieur a 255 carectaire.',
        ];
    }

}
