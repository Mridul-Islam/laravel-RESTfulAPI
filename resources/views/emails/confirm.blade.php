
@component('mail::message')
    # Hello {{ $user->name }}

    You Changed your email. So we need to verify your new email address. Please verify your email using this button:

    @component('mail::button', ['url' => route('verify', $user->verification_token)])
        Verify Account
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

