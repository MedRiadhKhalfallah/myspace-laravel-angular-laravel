@component('mail::message')
    # Change password Request
    Click on the button below to change password Request.

    @component('mail::button', ['url' => $url])
        Reset password
    @endcomponent

    Thanks,<br>
    My space Application
@endcomponent
