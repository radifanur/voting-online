@component('mail::message')
# Pemberitahuan

Berikut Merupakan Hasil Pemilihan Umum Tahun Periode {{$periode->tahun}}

@component('mail::table')
| Kandiat       | Jumlah Suara  | Perssentase  |
| :-----------  |:------------: | -----------: |
@foreach ($data as $data)
| {{$data->kandidat->ketua ." & ". $data->kandidat->wakil}} | {{$data->jml_pemilih}} | {{number_format(($data->jml_pemilih/$jumlah)*100)}} % |
@endforeach
@endcomponent

Terima kasih,<br>
Panitia {{ config('app.name') }}
@endcomponent
