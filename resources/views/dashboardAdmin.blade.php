@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('judul')
    Dashboard
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('assets/node_modules/izitoast/dist/css/iziToast.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/node_modules/owl.carousel/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css')}}">
@endpush

@section('content')

@can('panitia') 
<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Panitia</h4>
          </div>
          <div class="card-body">
            {{$totalPanitia}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-user-circle"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pemilih</h4>
          </div>
          <div class="card-body">
            {{$totalPemilih}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-edit"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Sudah Voting</h4>
          </div>
          <div class="card-body">
            {{$totalSudah}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="far fa-times-circle"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Belum Memilih</h4>
          </div>
          <div class="card-body">
            {{$totalBelum}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endcan

@can('pemilih')


@if (Auth::user()->verif == 0)

  <div class="col-12 mb-4">
    <div class="hero bg-primary text-white">
      <div class="hero-inner">
        <h2>Hai, @if (Auth::user()->name == NULL)
            {{Auth::user()->username}}
        @else
            {{Auth::user()->name}}
        @endif</h2>
        <p class="lead">Akun belum terverifikasi!. Silahkan lakukan verifikasi sebelum memulai voting.</p>
        <div class="mt-4">
          <a href="{{route('verif.index')}}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Verifikasi Akun</a>
        </div>
      </div>
    </div>
  </div>

@else

<div class="row">
  <div class="col-12 mb-4">
    <div class="hero bg-primary text-white">
      <div class="hero-inner">
        <h2>Hai, {{Auth::user()->name}}</h2>
        <p class="lead">Selamat datang di Sistem Voting Online Pemilihan Ketua dan Wakil Ketua HMTI</p>
      </div>
    </div>
  </div>
</div>

@if ($kandidat->count() > 0)
<div class="row">
  <div class="col-12 col-sm-6 col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Kandidat Ketua dan Wakil Ketua HMTI</h4>
      </div>
      <div class="card-body">
        <div class="owl-carousel owl-theme slider" id="slider2">
          @foreach ($kandidat as $no => $data)

          <div><img alt="image" class="img-fluid" src="{{Asset('storage/' . $data->image)}}" style="height: 320px">
            <div class="slider-caption">
              <div class="slider-title">Kandidat {{$no+1}}</div>
              <div class="slider-description">{{$data->ketua}} dan {{$data->wakil}}</div>
            </div>
          </div>
         
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @if ($jumlahSuara != 0)
  <div class="col-12 col-md-6 col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Chart Pemilihan</h4>
      </div>
      <div class="card-body">
        <div id="piechart" style=" height: 400px;"></div>
      </div>
    </div>
  </div>
  @endif
  
  
</div>
@endif


@endif
    
@endcan




@endsection
@push('js')
<script src="{{asset('assets/node_modules/izitoast/dist/js/iziToast.min.js')}}"></script>
<script src="{{asset('assets/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/node_modules/owl.carousel/dist/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          
          ['Task', 'Hours per Day'],
          @php
            foreach($vote as $d) {
              echo "['".$d->kandidat->ketua." Dan ".$d->kandidat->wakil."', ".$d->jml_pemilih."],";
            }
          @endphp
        ]);

        var options = {
          title: 'Pemilihan Ketua dan Wakil Ketua HMTI'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

<script>

$("#slider1,#slider2").owlCarousel({
  items: 1,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
});
  
  @if ( Session::get('success') )
  iziToast.success({
      // title: 'Hello, world!',
      message: '{{Session::get('success')}}',
      position: 'topRight'
  });
  @elseif(Session::get('info'))
  swal('Info', '{{Session::get('info')}}', 'info');
  

  @elseif ( Session::get('error') )
  swal('Gagal!', '{{Session::get('error')}}', 'error');
  @endif
</script>
@endpush