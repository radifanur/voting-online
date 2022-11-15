@extends('layouts.app')

@section('title')
    Data Panitia
@endsection

@section('judul')
    Data Panitia
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
      <table class="table table-striped mt-3 mb-0" id="tablePemilih">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Roles</th>
            <th>Action</th>
          </tr>
        </thead>
        @foreach ($user as $no => $data)

        <tbody>
          <tr>
            <td>{{$no+1}}</td>
            <td>
              <a href="#" class="font-weight-600">
                @if ($data->roles_id == 1)
                  <img src="../assets/img/avatar/avatar-1.png" alt="avatar" width="30" class="rounded-circle mr-1">
                @else
                <img src="../assets/img/avatar/avatar-5.png" alt="avatar" width="30" class="rounded-circle mr-1">
                @endif
                {{$data->name}}
              </a>
            </td>
            <td>{{$data->username}}</td>
            <td>
              @if ($data->roles_id == 1)
                  Admin
              @else
                  Panitia
              @endif
            </td>
            <td>
              <a class="btn btn-primary btn-action mr-1" href="{{ route('panitia.edit', $data->id) }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
              <a class="btn btn-danger btn-action delete" href="#" data-id="{{$data->id}}" data-username="{{$data->username}}" title="Delete"><i class="fas fa-trash"></i></a>
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
      <form action="{{ route('panitia.store') }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Panitia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
              <div class="card-header">
                <h4>Data Panitia</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                  <label>Roles</label>
                  <select class="form-control" name="roles">
                    <option value="2">Panitia</option>
                    <option value="1">Admin</option>
                  </select>
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
      var username = $(this).attr('data-username');
      var user = username.toUpperCase(); 
      swal({
        title: "Yakin ?",
        text: "Kamu akan menghapus Data "+user+" ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/panitia/delete/"+id+""
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