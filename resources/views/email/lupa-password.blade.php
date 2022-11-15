@component('mail::message')
# Hallo

Kamu menerima email ini karena kami menerima permintaan lupa password pada akun ini

@component('mail::button', ['url' => route('resetpassword.get', ['email'=>$email, 'token' => $token ])])
Reset Password
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
