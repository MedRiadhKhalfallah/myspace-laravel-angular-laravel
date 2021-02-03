@component('mail::message')
    # Veuillez vérifier votre adresse email
    Cher utilisateur,
    Veuillez vérifier votre adresse email pour terminer votre enregistrement.

    @component('mail::button', ['url' => $url, 'color' => 'success'])
        Vérifier adresse email
    @endcomponent
@endcomponent
