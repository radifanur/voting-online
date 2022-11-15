@extends('layouts.app')

@section('title')
    Vote
@endsection

@section('judul')
    Pemilihan Ketua dan Wakil Ketua
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
  <div class="card-deck mt-2" style="width: 50rem;">
    @forelse ($kandidat as $no => $data)
    <div class="card" >
      <img src="{{Asset('storage/' . $data->image)}}" class="card-img-top img-thumbnail" style="height: 160px" alt="...">
      <div class="card-body">
        <h5 class="card-title">Kandidat {{$no+1}}</h5>
        <p class="card-text">{{$data->ketua . " & " . $data->wakil}}</p>
        <a class="btn btn-primary vote" href="#"  data-kandidat="{{$data->id}}" data-pemilih="{{Auth::user()->id}}" >Vote</a>
      </div>
    </div> 
    @empty
      <h2>Data kandidat belum ada!</h2>
    @endforelse
  </div>

  
@endsection

@push('js')
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

<script>
    $('.vote').click(function(){
      var pemilih = $(this).attr('data-pemilih');
      var kandidat = $(this).attr('data-kandidat');
      var route = "{{route('voting',":kandidat")}}";
      route = route.replace(':kandidat', kandidat);
      swal({
        title: "Yakin ?",
        text: "Kamu akan memilih "+kandidat+"",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href=route
          swal("Data Berhasil Di hapus", {
            icon: "success",
          });
        } else {
          swal("Batal memilih!");
        }
      });
    });

</script>
@endpush