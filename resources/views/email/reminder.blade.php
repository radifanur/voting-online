@component('mail::message')
# Hallo, Peserta Pemilu!

Pemilu HMTI tahun {{$data['tahun']}} akan berakhir pada
@component('mail::panel')
<center>{{$data['akhir']}}</center>
@endcomponent
Harap untuk melakukan pemilihan Calon Ketua dan Wakil Ketua HMTI tahun {{$data['tahun']}}


Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
