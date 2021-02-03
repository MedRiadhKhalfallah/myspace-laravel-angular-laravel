@component('mail::message')
    Vous avez demandé à réinitialiser vos identifiants de connexion sur Maintenance TN.<br>
    Cette opération vous attribuera un nouveau mot de passe.<br>
    Pour confirmer cette action, cliquez sur le bouton suivant :

    @component('mail::button', ['url' => $url,'color'=>'primary'])
        Réinitialiser le mot de passe
    @endcomponent

@endcomponent
