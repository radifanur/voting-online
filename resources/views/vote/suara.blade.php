@extends('layouts.app')

@section('title')
    Perolehan Suara
@endsection

@section('judul')
    Perolehan Suara
@endsection

@section('content')
@if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
      <div class="alert-title">Success</div>
      {{$message}}
    </div>
  </div>
@endif



<div class="section-body">
  <div class="card-body p-0">
    {{-- <a href="#"><button class="btn btn-icon icon-left btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button></a> --}}
    <div class="table-responsive">
      <table class="table table-striped mt-3 mb-0" id="tablePemilih">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kandidat</th>
            @can('panitia')
            <th>Jumlah Suara</th>
            @endcan
            <th>Persentase</th>
          </tr>
        </thead>
        @foreach ($data as $no => $data)

        <tbody>
          <tr>
            <td>{{$no+1}}</td>
            <td>{{$data->kandidat->ketua ." & ". $data->kandidat->wakil}}</td>
            @can('panitia')
            <td>{{$data->jml_pemilih}}</td>
            @endcan
            <td>{{number_format(($data->jml_pemilih/$jumlah)*100)}} %</td>
          </tr>
        </tbody> 
        @endforeach               
      </table>
    </div>
  </div>

  
@endsection

@push('js')
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>\
<script>
  $('.delete').click(function(){
    var id = $(this).attr('data-id');
    swal({
      title: "Yakin ?",
      text: "Kamu akan menghapus Kandidat "+id+" ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location = "/kandidat/delete/"+id+""
        swal("Data Berhasil Di hapus", {
          icon: "success",
        });
      } else {
        swal("Kandidat Tidak Jadi Di Hapus");
      }
    });
  });

</script>
@endpush