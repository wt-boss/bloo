@component('mail::message')
    ### Salut je suis {{ $contact['Nom'] }} mon email {{$contact['Email'] }}.

    {{ $contact['Message'] }}

    @component('mail::panel')
        <p style="text-align: center">
            If you need any help or have any suggestion, kindly send us a mail at:<br>
            <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
        </p>
    @endcomponent
    <br><br>
    Thanks,<br>
    The {{ config('app.name') }} Team
@endcomponent
