@extends('layouts.app')

@section('title')
    Kelas
@endsection

@section('judul')
    Kelas
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


<button class="btn btn-icon icon-left btn-primary float-right" data-toggle="modal" data-target="#tambahModal"><i class="far fa-edit"></i>Tambah Data</button>
<div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped mt-3 mb-0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kelas</th>
            <th>Action</th>
          </tr>
        </thead>
        @foreach ($kelas as $no => $data)

        <tbody>
          <tr>
            <td>{{$no+1}}</td>
            <td>{{$data->nama}}</td>
            <td>
              <a class="btn btn-danger btn-action delete" href="#" data-id="{{$data->id}}" data-name="{{$data->nama}}" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
        </tbody>                
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
              <div class="card-header">
                <h4>Kelas</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Kelas</label>
                  <input type="text" name="nama" class="form-control">
                </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
    @if(count($errors)>0)
    swal('Gagal!', 'Data Harus Diisi!', 'error');
    @endif

    $('.delete').click(function(){
      var id = $(this).attr('data-id');
      var nama = $(this).attr('data-name');
      swal({
        title: "Yakin ?",
        text: "Kamu akan menghapus Kelas  "+nama+" ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/kelas/delete/"+id+""
          swal("Data Berhasil Di hapus", {
            icon: "success",
          });
        } else {
          swal("Data Tidak Jadi Di Hapus");
        }
      });
    });

</script>
@endpush