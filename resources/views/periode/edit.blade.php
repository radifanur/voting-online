@extends('layouts.app')

@section('title')
    Data Periode
@endsection

@section('judul')
    Data Periode
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
@endpush

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

<form action="{{ route('periode.update', $edit->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title">Tambah Periode</h5>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">
              <h4>Periode</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Periode Tahun</label>
                <input type="text" name="tahun" class="form-control" value="{{$edit->tahun}}">
              </div>
              <div class="form-group">
                <label>Tanggal Mulai Pemilu</label>
                <input type="text" name="mulai" class="form-control datetimepicker">
              </div>
              <div class="form-group">
                <label>Tanggal Berakhir Pemilu</label>
                <input type="text" name="akhir" class="form-control datetimepicker" value="{{$edit->akhir}}">
              </div>
        </div>
      </div>
    <div class="modal-footer bg-whitesmoke br">
      <a href="{{route('periode.index')}}"><button type="button" class="btn btn-danger">Close</button></a>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
  </form>
@endsection

@push('js')
<script src="{{asset('assets/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>

<script src="{{asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

@endpush