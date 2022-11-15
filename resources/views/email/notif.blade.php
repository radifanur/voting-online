@component('mail::message')
Hai, {{$data['nama']}}

The body of your message.

@component('mail::table')
| Kandiat       | Jumlah Suara  | Perssentase  |
| :------------ |:------------: | -----------: |

@endcomponent

Terima kasih,<br>
Panitia {{ config('app.name') }}
@endcomponent
