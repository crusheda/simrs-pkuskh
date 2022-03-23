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
          <li class="active"><a class="nav-link" href="{{ route("welcome") }}">Halaman Utama</a></li>
          <li><a class="nav-link" href="{{ route("kunjungan") }}">Kunjungan Pasien</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-archive"></i><span>Laporan</span></a>
        <ul class="dropdown-menu">
          <li class="nav-item"><a href="{{ route("accidentreport.index") }}" class="nav-link">Accident Report</a></li>
          <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Log Perawat</a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a href="{{ route("tindakan-harian.index") }}" class="nav-link">Tindakan Harian</a></li>
              <li class="nav-item"><a href="{{ route("profkpr.index") }}" class="nav-link">Profesi Keperawatan</a></li>
              <li class="nav-item"><a href="{{ route("tgsperawat.index") }}" class="nav-link">Penunjang Tugas</a></li>
            </ul>
          </li>
          <li class="nav-item"><a href="{{ route("ipsrs.index") }}" class="nav-link">Pengaduan IPSRS</a></li>
          <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Surveilans PPI</a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a href="{{ route("plebitis.index") }}" class="nav-link">Plebitis</a></li>
              <li class="nav-item"><a href="{{ route("ido.index") }}" class="nav-link">IDO</a></li>
              <li class="nav-item"><a href="{{ route("isk.index") }}" class="nav-link">ISK</a></li>
              <li class="nav-item"><a href="{{ route("decubitus.index") }}" class="nav-link">Decubitus</a></li>
              <li class="nav-item"><a href="{{ route("vap.index") }}" class="nav-link">VAP</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-header">Unit IT</li>
      <li><a class="nav-link" href="#"><i class="fas fa-briefcase"></i> <span>Supervisi</span></a></li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bug"></i> <span>Pilar</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route("it.pilar.index") }}">Indikator Mutu</a></li>
          <li><a class="nav-link" href="{{ route("it.supervisi.index") }}">Revisi</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="far fa-clone"></i><span>Multiple Dropdown</span></a>
        <ul class="dropdown-menu">
          <li class="nav-item"><a href="#" class="nav-link">Not Dropdown Link</a></li>
          <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Hover Me</a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
              <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                  <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                  <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                </ul>
              </li>
              <li class="nav-item"><a href="#" class="nav-link">Link 3</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="menu-header">Unit Kepegawaian</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-id-card-alt"></i> <span>Kepegawaian</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route("kepegawaian.karyawan.index") }}">Data Karyawan</a></li>
        </ul>
      </li>
      <li class="menu-header">Unit LAB</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-vial"></i> <span>Laboratorium</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route("lab.antigen.index") }}">Antigen</a></li>
          <li><a class="nav-link" href="#"><del>PCR</del></a></li>
        </ul>
      </li>
      <li class="menu-header">Unit Kebidanan</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-address-book"></i> <span>Kebidanan</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route("skl.index") }}">SKL</a></li>
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