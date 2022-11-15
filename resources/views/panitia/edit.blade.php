@extends('layouts.app')

@section('title')
    Data Panitia
@endsection

@section('judul')
    Data Panitia
@endsection

@section('content')
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
      <div class="alert-title">Failed</div>
      <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
      </ul>
    </div>
  </div>
@endif

<form action="{{ route('panitia.update', $edit->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-header">
      <h5 class="modal-title">Update Data Panitia</h5>
    </div>
    <div class="modal-body">
      <div class="card">
          <div class="card-header">
            <h4>Data Panitia</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="name" class="form-control" value="{{$edit->name}}">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="{{$edit->username}}">
            </div>
            <div class="form-group">
              <label>Roles</label>
              <select class="form-control" name="roles">
                @if ($edit->roles_id == 1)
                <option value="1">Admin</option>
                <option value="2">Panitia</option>
                @else
                <option value="2">Panitia</option>
                <option value="1">Admin</option>
                @endif
              </select>
            </div>
      </div>
    </div>
    <div class="modal-footer bg-whitesmoke br">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection

@push('js')
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
    @if(count($errors)>0)
    swal('Gagal!', 'Data Harus Diisi!', 'error');
    @endif
</script>
@endpush