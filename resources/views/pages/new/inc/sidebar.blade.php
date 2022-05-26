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
      <li class="nav-item dropdown {{ request()->routeIs(['welcome','kunjungan']) ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('welcome') ? 'active' : '' }}"><a class="nav-link" href="{{ route("welcome") }}">Halaman Utama</a></li>
          <li class="{{ request()->routeIs('kunjungan') ? 'active' : '' }}"><a class="nav-link" href="{{ route("kunjungan") }}">Kunjungan Pasien</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ request()->routeIs(['rapat.index','managerfile','perencanaan.index','kebijakan.index','panduan.index','pedoman.index','program.index','spo.index','jadwal.dinas.index']) ? 'active' : '' }}">
        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-book-open"></i><span>Administrasi</span></a>
        <ul class="dropdown-menu">
          <li class="nav-item {{ request()->routeIs('managerfile') ? 'active' : '' }}"><a href="{{ route("managerfile") }}" class="nav-link">File Manager</a></li>
          @if(auth()->user()->can('laporan') || auth()->user()->can('admin-laporan'))
            <li class="nav-item dropdown {{ request()->routeIs(['bulan.index']) ? 'active' : '' }}"><a href="#" class="nav-link has-dropdown">Laporan</a>
              <ul class="dropdown-menu">
                <li class="nav-item {{ request()->routeIs('bulan.index') ? 'active' : '' }}"><a href="{{ route('bulan.index') }}" class="nav-link">Bulanan</a></li>
                {{-- <li class="nav-item dropdown"><a href="#" class="nav-link has-dropdown">Link 2</a>
                  <ul class="dropdown-menu">
                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Link</a></li>
                  </ul>
                </li> --}}
              </ul>
            </li>
          @endif
          <li class="nav-item {{ request()->routeIs('rapat.index') ? 'active' : '' }}"><a href="{{ route("rapat.index") }}" class="nav-link">Berkas Rapat</a></li>
          <li class="nav-item {{ request()->routeIs('jadwal.dinas.index') ? 'active' : '' }}"><a href="{{ route("jadwal.dinas.index") }}" class="nav-link">Jadwal Dinas</a></li>
          {{-- <li class="nav-item {{ request()->routeIs('regulasi.index') ? 'active' : '' }}"><a href="{{ route("regulasi.index") }}" class="nav-link">Regulasi OLD</a></li> --}}
          <li class="nav-item dropdown {{ request()->routeIs(['kebijakan.index','panduan.index','pedoman.index','program.index','spo.index']) ? 'active' : '' }}"><a href="#" class="nav-link has-dropdown">Regulasi</a>
            <ul class="dropdown-menu">
              <li class="nav-item {{ request()->routeIs('kebijakan.index') ? 'active' : '' }}"><a href="{{ route('kebijakan.index') }}" class="nav-link">Kebijakan</a></li>
              <li class="nav-item {{ request()->routeIs('panduan.index') ? 'active' : '' }}"><a href="{{ route('panduan.index') }}" class="nav-link">Panduan</a></li>
              <li class="nav-item {{ request()->routeIs('pedoman.index') ? 'active' : '' }}"><a href="{{ route('pedoman.index') }}" class="nav-link">Pedoman</a></li>
              <li class="nav-item {{ request()->routeIs('program.index') ? 'active' : '' }}"><a href="{{ route('program.index') }}" class="nav-link">Program</a></li>
              <li class="nav-item {{ request()->routeIs('spo.index') ? 'active' : '' }}"><a href="{{ route('spo.index') }}" class="nav-link">SPO</a></li>
            </ul>
          </li>
          <li class="nav-item {{ request()->routeIs('perencanaan.index') ? 'active' : '' }}"><a href="{{ route("perencanaan.index") }}" class="nav-link">RKA</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ request()->routeIs(['accidentreport.index','tindakan-harian.index','profkpr.index','tgsperawat.index','ipsrs.index','plebitis.index','ido.index','isk.index','decubitus.index','vap.index']) ? 'active' : '' }}">
        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-archive"></i><span>Laporan</span></a>
        <ul class="dropdown-menu">
          <li class="nav-item {{ request()->routeIs('accidentreport.index') ? 'active' : '' }}"><a href="{{ route("accidentreport.index") }}" class="nav-link">Accident Report</a></li>
          @can('log_perawat')
            <li class="nav-item dropdown {{ request()->routeIs(['tindakan-harian.index','profkpr.index','tgsperawat.index']) ? 'active' : '' }}"><a href="#" class="nav-link has-dropdown">Log Perawat</a>
              <ul class="dropdown-menu">
                <li class="nav-item {{ request()->routeIs('tindakan-harian.index') ? 'active' : '' }}"><a href="{{ route("tindakan-harian.index") }}" class="nav-link">Tindakan Harian</a></li>
                <li class="nav-item {{ request()->routeIs('profkpr.index') ? 'active' : '' }}"><a href="{{ route("profkpr.index") }}" class="nav-link">Profesi Keperawatan</a></li>
                <li class="nav-item {{ request()->routeIs('tgsperawat.index') ? 'active' : '' }}"><a href="{{ route("tgsperawat.index") }}" class="nav-link">Penunjang Tugas</a></li>
              </ul>
            </li>
          @endcan
          <li class="nav-item {{ request()->routeIs('ipsrs.index') ? 'active' : '' }}">
            <a href="{{ route("ipsrs.index") }}" class="nav-link">Pengaduan IPSRS&nbsp;
              <h6><span class="badge badge-light" style="margin-top: 5px">
                  @role('ipsrs')
                      @php
                          echo count(\DB::table('pengaduan_ipsrs')->where('tgl_selesai',null)->get()); 
                      @endphp
                  @else
                      @php
                          $getid = Auth::user()->id;
                          echo count(\DB::table('pengaduan_ipsrs')->where('tgl_selesai',null)->where('user_id',$getid)->get()); 
                      @endphp
                  @endrole
              </span></h6>
            </a>
          </li>
          @can('surveilans-ppi')
            <li class="nav-item dropdown {{ request()->routeIs(['plebitis.index','ido.index','isk.index','decubitus.index','vap.index']) ? 'active' : '' }}"><a href="#" class="nav-link has-dropdown">Surveilans PPI</a>
              <ul class="dropdown-menu">
                <li class="nav-item {{ request()->routeIs('plebitis.index') ? 'active' : '' }}"><a href="{{ route("plebitis.index") }}" class="nav-link">Plebitis</a></li>
                <li class="nav-item {{ request()->routeIs('ido.index') ? 'active' : '' }}"><a href="{{ route("ido.index") }}" class="nav-link">IDO</a></li>
                <li class="nav-item {{ request()->routeIs('isk.index') ? 'active' : '' }}"><a href="{{ route("isk.index") }}" class="nav-link">ISK</a></li>
                <li class="nav-item {{ request()->routeIs('decubitus.index') ? 'active' : '' }}"><a href="{{ route("decubitus.index") }}" class="nav-link">Decubitus</a></li>
                <li class="nav-item {{ request()->routeIs('vap.index') ? 'active' : '' }}"><a href="{{ route("vap.index") }}" class="nav-link">VAP</a></li>
              </ul>
            </li>
          @endcan
        </ul>
      </li>
      <li class="nav-item {{ request()->routeIs('pengadaan.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route("pengadaan.index") }}"><i class="fas fa-shopping-cart"></i> <span>Pengadaan</span></a></li>
      @hasrole('it')
      <li class="menu-header">Unit IT</li>
      <li class="nav-item {{ request()->routeIs('it.supervisi.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route("it.supervisi.index") }}"><i class="fas fa-briefcase"></i> <span>Supervisi</span></a></li>
      <li class="dropdown {{ request()->routeIs(['it.pilar.index']) ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bug"></i> <span>Pilar</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('it.pilar.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route("it.pilar.index") }}">Indikator Mutu</a></li>
          <li><a class="nav-link" href="#"><del>Revisi</del></a></li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ request()->routeIs(['notif.index','admin.permissions.index','admin.roles.index','admin.users.index','admin.unit.index','it.dokter.index','it.roleuser.index','it.user.activity']) ? 'active' : '' }}">
        <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-lock"></i><span>Administrator</span></a>
        <ul class="dropdown-menu">
          <li class="nav-item {{ request()->routeIs('notif.index') ? 'active' : '' }}"><a href="{{ route("notif.index") }}" class="nav-link">Notifikasi</a></li>
          <li class="nav-item dropdown {{ request()->routeIs(['admin.permissions.index','admin.roles.index','admin.users.index']) ? 'active' : '' }}"><a href="#" class="nav-link has-dropdown">Atur Pengguna</a>
            <ul class="dropdown-menu">
              <li class="nav-item {{ request()->routeIs('admin.permissions.index') ? 'active' : '' }}"><a href="{{ route("admin.permissions.index") }}" class="nav-link">Permissions</a></li>
              <li class="nav-item {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}"><a href="{{ route("admin.roles.index") }}" class="nav-link">Roles</a></li>
              <li class="nav-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><a href="{{ route("admin.users.index") }}" class="nav-link">Users</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown {{ request()->routeIs(['admin.unit.index','it.dokter.index','it.roleuser.index','it.user.activity']) ? 'active' : '' }}"><a href="#" class="nav-link has-dropdown">Other</a>
            <ul class="dropdown-menu">
              <li class="nav-item {{ request()->routeIs('admin.unit.index') ? 'active' : '' }}"><a href="{{ route("admin.unit.index") }}" class="nav-link">Unit</a></li>
              <li class="nav-item {{ request()->routeIs('it.dokter.index') ? 'active' : '' }}"><a href="{{ route("it.dokter.index") }}" class="nav-link">Dokter</a></li>
              <li class="nav-item {{ request()->routeIs('it.roleuser.index') ? 'active' : '' }}"><a href="{{ route("it.roleuser.index") }}" class="nav-link">Set Role Finger</a></li>
              <li class="nav-item {{ request()->routeIs('it.user.activity') ? 'active' : '' }}"><a href="{{ route("it.user.activity") }}" class="nav-link">User Activity</a></li>
            </ul>
          </li>
        </ul>
      </li>
      @endhasrole
      @if(Auth::user()->hasAnyRole(['ibs', 'spv']))
      <li class="menu-header">Unit IBS</li>
      <li class="dropdown {{ request()->routeIs(['ibs.supervisi.index']) ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-calendar-check"></i> <span>Supervisi</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('ibs.supervisi.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route("ibs.supervisi.index") }}">Ceklist Alat & BHP</a></li>
        </ul>
      </li>
      @endif
      {{-- <li class="nav-item dropdown">
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
      </li> --}}
      @hasrole('it|kepegawaian')
      <li class="menu-header">Unit Kepegawaian</li>
      <li class="dropdown {{ request()->routeIs(['kepegawaian.karyawan.index']) ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-id-card-alt"></i> <span>Kepegawaian</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('kepegawaian.karyawan.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route("kepegawaian.karyawan.index") }}">Data Karyawan</a></li>
        </ul>
      </li>
      @endhasrole
      @hasrole('it|lab')
      <li class="menu-header">Unit LAB</li>
      <li class="dropdown {{ request()->routeIs(['lab.antigen.index']) ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-vial"></i> <span>Laboratorium</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('lab.antigen.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route("lab.antigen.index") }}">Antigen</a></li>
          {{-- <li><a class="nav-link" href="#"><del>PCR</del></a></li> --}}
        </ul>
      </li>
      @endhasrole
      @hasrole('it|kebidanan')
      <li class="menu-header">Unit Kebidanan</li>
      <li class="dropdown {{ request()->routeIs(['skl.index']) ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-address-book"></i> <span>Kebidanan</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->routeIs('skl.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route("skl.index") }}">SKL</a></li>
        </ul>
      </li>
      @endhasrole
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