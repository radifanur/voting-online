@extends('layouts.app')

@section('title')
    Data Pemilih
@endsection

@section('judul')
    Data Pemilih
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

<form action="{{ route('pemilih.update', $edit->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-header">
      <h5 class="modal-title">Update Data Pemilih</h5>
    </div>
    <div class="modal-body">
      <div class="card">
          <div class="card-header">
            <h4>Data Pemilih</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nim</label>
              <input type="text" name="nim" class="form-control" value="{{$edit->nim}}">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="{{$edit->email}}">
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <select class="form-control" name="kelas">
                <option value="{{$edit->kelas_id}}" selected>{{$edit->kelas->nama}}</option>
                @foreach ($kelas as $p)
                <option value="{{$p->id}}">{{$p->nama}}</option>
                @endforeach
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