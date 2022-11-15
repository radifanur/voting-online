@extends('layouts.app')

@section('title')
    Periode
@endsection

@section('judul')
    Periode
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
@endpush

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

@if ($periode->count() == 0)
<button class="btn btn-icon icon-left btn-primary float-right" data-toggle="modal" data-target="#tambahModal"><i class="far fa-edit"></i>Tambah Data</button>
@endif

<div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped mt-3 mb-0">
        <thead>
          <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Mulai Pemilu</th>
            <th>Akhir Pemilu</th>
            <th>Action</th>
          </tr>
        </thead>
        @foreach ($periode as $no => $data)

        <tbody>
          <tr>
            <td>{{$no+1}}</td>
            <td>{{$data->tahun}}</td>
            <td>{{$data->mulai}}</td>
            <td>{{$data->akhir}}</td>
            <td>
              <a class="btn btn-primary btn-action mr-1" href="{{ route('periode.edit', $data->id) }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
              <a class="btn btn-danger btn-action delete" href="#" data-id="{{$data->id}}" data-nama="{{$data->tahun}}" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
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
      <form action="{{ route('periode.store') }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Periode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
              <div class="card-header">
                <h4>Periode</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Periode Tahun</label>
                  <input type="text" name="tahun" class="form-control">
                </div>
                <div class="form-group">
                  <label>Tanggal Mulai Pemilu</label>
                  <input type="text" name="mulai" class="form-control datetimepicker">
                </div>
                <div class="form-group">
                  <label>Tanggal Berakhir Pemilu</label>
                  <input type="text" name="akhir" class="form-control datetimepicker">
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
<script src="{{asset('assets/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>

<script src="{{asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>
    @if(count($errors)>0)
    swal('Gagal!', 'Data Harus Diisi!', 'error');
    @endif

    $('.delete').click(function(){
      var id = $(this).attr('data-id');
      var nama = $(this).attr('data-nama') 
      swal({
        title: "Yakin ?",
        text: "Kamu akan menghapus Tahun "+nama+" ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/periode/delete/"+id+""
          swal("Tahun "+nama+" Berhasil Di hapus", {
            icon: "success",
          });
        } else {
          swal("Tahun Tidak Jadi Di Hapus");
        }
      });
    });
</script>

@endpush