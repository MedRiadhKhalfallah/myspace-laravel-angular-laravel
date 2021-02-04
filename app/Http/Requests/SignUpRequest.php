<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
//'nom'=>'required|min:4|max:255|regex:/(^([a-zA-Z]+)$)/u',

    public function rules()
    {
        return [
            'nom'=>'required|min:4|max:255',
            'prenom'=>'required|min:4|max:255',
            'telephone'=>'required|min:8|max:8',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:8|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'le :attribute est opligatoire.',
            'nom.max' => 'le :attribute doit etre inferieur a 255 carectaire.',
            'nom.min' => 'le :attribute doit etre superieur a 4 carectaire.',
            'prenom.required' => 'le :attribute est opligatoire.',
            'prenom.max' => 'le :attribute doit etre inferieur a 255 carectaire.',
            'prenom.min' => 'le :attribute doit etre superieur a 4 carectaire.',
            'telephone.required' => 'le :attribute est opligatoire.',
            'telephone.max' => 'le :attribute doit etre inferieur a 9 carectaire.',
            'telephone.min' => 'le :attribute doit etre superieur a 7 carectaire.',
            'email.required' => 'le :attribute est opligatoire.',
            'email.email' => 'le :attribute est format non valid.',
            'email.unique' => 'le :attribute est deja utilisé.',
            'password.required' => 'le :attribute est opligatoire.',
            'password.confirmed' => 'le :attribute est non confirme.',
            'password.max' => 'le :attribute doit etre inferieur a 255 carectaire.',
            'password.min' => 'le :attribute doit etre superieur a 8 carectaire.'
        ];
    }

}
