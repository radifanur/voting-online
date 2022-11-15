@component('mail::message')
Hai, {{$data['nama']}}

Token anda adalah :

@component('mail::panel')
<center>{{$data['token']}}</center>
@endcomponent

Terima kasih,<br>
Panitia {{ config('app.name') }}
@endcomponent
