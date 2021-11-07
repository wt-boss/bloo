@component('mail::message')
### @lang("Hello") {{ $user->first_name }},

@lang("Thank you for signing up on") **[{{ config('app.name') }}]({{ url('/') }})** @lang("To complete your signup, please verify your email by clicking on the button below"):

@component('mail::button', ['url' => url("email/verify/{$user->email_token}"), 'color' => 'success'])
@lang("Verify Email Address")
@endcomponent


<p style="text-align: center">
@lang("If you need any help or have any suggestion, kindly send us a mail at"):<br>
<a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
</p>


<br><br>
@lang("Thanks"),<br>
@lang('The') {{ config('app.name') }} Team
@endcomponent
