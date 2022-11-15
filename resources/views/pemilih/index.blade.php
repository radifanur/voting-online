@extends('layouts.app')

@section('title')
    Data Pemilih
@endsection

@section('judul')
    Data Pemilih
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



<div class="card">
  <div class="card-header">Filter Data</div>
  <form action="{{route('pemilih.index')}}" method="GET">
    <div class="row ml-3">
      <div class="form-group col-auto">
        <label for="kelas">Kelas</label>
        <select id="kelas" name="kelas" class="form-control">
          
          <option value="" selected>Pilih Kelas</option>
          @foreach ($kelas as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-auto">
        <label for="stats">Status</label>
        <select id="status" name="status" class="form-control">
          <option value="" selected>Pilih Status</option>
          <option value="belum">Belum</option>
          <option value="sudah">Sudah</option>
        </select>
      </div>
      <div class="form-group col-auto" style="margin-top: 30px">
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
  
  
</div>

<button class="btn btn-icon icon-left btn-primary float-right mt-3" data-toggle="modal" data-target="#tambahModal"><i class="far fa-edit"></i>Tambah Data</button>
<div class="card-body p-0">
    <div class="table-responsive">
      <table id="table-1" class="table table-striped mt-3 mb-0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nim</th>
            <th>Kelas</th>
            <th>Email</th>
            <th>Token</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        @forelse ($pemilih as $no => $data)
        <tbody>
          <tr>
            <td>{{$no+1}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->nim}}</td>
            <td>{{$data->kelas->nama}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->token}}</td>
            @if ($data->status == 'sudah')
              <td><div class="badge badge-success">Sudah</td>
            @else
              <td><div class="badge badge-danger">Belum</td>
            @endif
            <td>
              <a class="btn btn-primary btn-action mr-1" href="{{ route('pemilih.edit', $data->id) }}" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
              <a class="btn btn-danger btn-action delete" href="#" data-id="{{$data->id}}" data-username="{{$data->nim}}" title="Delete"><i class="fas fa-trash"></i></a>
            </td>

          </tr>
          
        </tbody>
        @empty
           <p>Tidak Ada Data</p> 
        @endforelse
      </table>
      <div class="d-flex mt-2">
        {{$pemilih->links()}}
      </div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{ route('pemilih.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="card">
              <div class="card-header">
                <h4>Data Pemilih</h4>
              </div>
              <div class="card-body">
                {{-- <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control">
                </div> --}}
                <div class="form-group">
                  <label>Nim</label>
                  <input type="number" name="nim" class="form-control">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <select class="form-control" name="kelas">
                    <option value="" selected>Pilih kelas</option>
                    @foreach ($kelas as $p)
                    <option value="{{$p->id}}">{{$p->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Periode</label>
                  <select class="form-control" name="periode">
                    @foreach ($periode as $p)
                    <option value="{{$p->id}}">{{$p->tahun}}</option>
                    @endforeach
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

    @elseif ( Session::get('error') )
    swal('Gagal!', '{{Session::get('error')}}', 'error');
    @endif

    $('.delete').click(function(){
      var id = $(this).attr('data-id');
      var username = $(this).attr('data-username');
      var user = username.toUpperCase(); 
      swal({
        title: "Yakin ?",
        text: "Kamu akan menghapus "+user+" ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = "/pemilih/delete/"+id+""
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
