<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#">Voting Online HMTI</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">HMTI</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="nav-item {{Request::is('/*') ? 'active' : ''}}"><a class="nav-link" href="/"><i class="far fa-sun"></i> <span>Dashboard</span></a></li>
          
          @can('panitia')
          <li class="menu-header">Pengaturan</li>
          <li class="nav-item {{Request::is('periode*') ? 'active' : ''}}"><a class="nav-link" href="{{route('periode.index')}}"><i class="fas fa-calendar-alt"></i> <span>Periode</span></a></li>
          <li class="nav-item {{Request::is('kelas*') ? 'active' : ''}}"><a class="nav-link" href="{{route('kelas.index')}}"><i class="far fa-address-book"></i> <span>Kelas</span></a></li>
          <li class="nav-item {{Request::is('suara*') ? 'active' : ''}}"><a class="nav-link" href="/suara"><i class="far fa-chart-bar"></i><span>Perolehan Suara</span></a></li>
          @endcan
          
          @can('admin')
          <li class="nav-item {{Request::is('panitia*') ? 'active' : ''}}"><a class="nav-link" href="/panitia"><i class="far fa-user-circle"></i> <span>Panitia</span></a></li>
          @endcan

          @can('panitia')
          <li class="menu-header">Data</li>
          <li class="nav-item {{ Request::is('pemilih*') ? 'active' : ''}} "><a class="nav-link" href="/pemilih"><i class="far fa-user"></i></i> <span>Pemilih</span></a></li>
          <li class="nav-item {{ Request::is('kandidat*') ? 'active' : ''}}"><a class="nav-link" href="/kandidat"><i class="far fa-address-book"></i> <span>Kandidat</span></a></li>
          @endcan
          
          @can('pemilih')
          <li class="menu-header">Pemilu</li>
          <li class="nav-item {{Request::is('vote*') ? 'active' : ''}}"><a class="nav-link" href="/vote"><i class="far fa-sticky-note"></i> <span>Vote</span></a></li> 
          <li class="nav-item {{Request::is('suara*') ? 'active' : ''}}"><a class="nav-link" href="/suara"><i class="far fa-chart-bar"></i><span>Perolehan Suara</span></a></li>
          @endcan
          
    </aside>
  </div>