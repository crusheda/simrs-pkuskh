<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <span class="navbar-brand-full"><img src="{{ asset('img/logo-admin.png') }}"></span>
      {{-- <a href="index.html">Stisla</a> --}}
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <span class="navbar-brand-minimized"><img src="{{ asset('img/pku_ico.png') }}"></span>
      {{-- <a href="index.html">St</a> --}}
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Publik</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
        <ul class="dropdown-menu">
          <li class="active"><a class="nav-link" href="welcome">Halaman Utama</a></li>
          <li><a class="nav-link" href="kunjungan">Kunjungan Pasien</a></li>
        </ul>
      </li>
      <li class="menu-header">Unit IT</li>
      <li><a class="nav-link" href="credits.html"><i class="fas fa-briefcase"></i> <span>Supervisi</span></a></li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bug"></i> <span>Pilar</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="pilar/imut">Indikator Mutu</a></li>
          <li><a class="nav-link" href="pilar/revisi">Revisi</a></li>
        </ul>
      </li>
      {{-- <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
        <ul class="dropdown-menu">
          <li><a href="utilities-contact.html">Contact</a></li>
          <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li>
          <li><a href="utilities-subscribe.html">Subscribe</a></li>
        </ul>
      </li> --}}
    </ul>

    {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Logout
      </a>
    </div> --}}
  </aside>
</div>