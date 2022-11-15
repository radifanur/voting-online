@extends('layouts.app')

@section('title')
    Data Kandidat
@endsection

@section('judul')
    Data Kandidat
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
  <div class="tambah">
    <a href="{{ route('kandidat.tambah')}}"><button class="btn btn-icon icon-left btn-primary float-right mb-2"><i class="far fa-edit"></i>Tambah Data</button></a>
  </div>
  <br><br>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped mt-3 mb-0" id="tablePemilih">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Ketua</th>
            <th>Nama Wakil</th>
            <th>Gambar</th>
            <th>Action</th>
          </tr>
        </thead>
        @foreach ($kandidat as $no => $data)

        <tbody>
          <tr>
            <td>{{$no+1}}</td>
            <td>{{$data->ketua}}</td>
            <td>{{$data->wakil}}</td>
            <td><img src="{{Asset('storage/' . $data->image)}}" width="100px" alt=""></td>
            <td>
              <a class="btn btn-primary btn-action mr-1" href="{{ route('kandidat.edit', $data->id) }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
              <a class="btn btn-danger btn-action delete" href="#" data-id="{{$data->id}}" data-no="{{$no+1}}" title="Delete"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
        </tbody>                
        @endforeach
      </table>
    </div>
  </div>

  
@endsection

@push('js')
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
  $('.delete').click(function(){
    var id = $(this).attr('data-id');
    var no = $(this).attr('data-no');
    swal({
      title: "Yakin ?",
      text: "Kamu akan menghapus Kandidat "+no+" ",
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

@if(count($errors)>0)
swal('Gagal!', 'Data Harus Diisi!', 'error');
@endif

</script>
@endpush