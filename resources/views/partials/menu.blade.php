<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            {{-- <li class="nav-item">
                <center>
                    <span class="badge badge-pill badge-light" style="text-transform: capitalize;margin-top: 10px;margin-bottom: 10px">
                    <i class="fa-fw fas fa-user-circle nav-icon"></i> {{ Auth::user()->name }} </span>
                </center>
            </li> --}}
            <li class="nav-item">
                <a href="{{ route("home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('log_it')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-low-vision nav-icon">

                        </i>
                        Supervisi IT
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("it.supervisi.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-leaf nav-icon">

                                </i>
                                Detail Log
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('imut_it')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-line-chart nav-icon">

                        </i>
                        Indikator Mutu
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("it.pilar.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-database nav-icon">

                                </i>
                                Pilar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.printer.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-print nav-icon">

                                </i>
                                Printer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.cpu.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-wrench nav-icon">

                                </i>
                                CPU
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.jaringan.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-wifi nav-icon">

                                </i>
                                Jaringan
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- @can('penyimpanan_file')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-archive nav-icon">

                        </i>
                        Penyimpanan File
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-fw fas fa-file-archive-o nav-icon">

                                </i>
                                Lihat File
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-fw fas fa-plus-square nav-icon">

                                </i>
                                Tambah File
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan --}}
            @can('berkas_rapat')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-inbox nav-icon">

                        </i>
                        Berkas Rapat
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("rapat.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-book nav-icon">

                                </i>
                                Lihat Berkas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("rapat.create") }}" class="nav-link">
                                <i class="fa-fw fas fa-plus-square nav-icon">

                                </i>
                                Tambah Berkas
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @role('kabag-keperawatan')
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle">
                    <i class="fa-fw fas fa-plus-square nav-icon">
        
                    </i>
                    Pernyataan Log
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("logperawat.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-address-book nav-icon">

                            </i>
                            Tindakan Harian
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("logprofkpr.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-id-badge nav-icon">

                            </i>
                            Profesi Keperawatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("logtgsperawat.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-vcard nav-icon">

                            </i>
                            Penunjang Tugas
                        </a>
                    </li>
                </ul>
            </li>
            @endrole
            @can('log_perawat')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle">
                        <i class="fa-fw fas fa-book nav-icon">

                        </i>
                        Log Perawat
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("tdkperawat.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-address-book nav-icon">

                                </i>
                                Tindakan Harian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("profkpr.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-id-badge nav-icon">

                                </i>
                                Profesi Keperawatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("tgsperawat.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-vcard nav-icon">

                                </i>
                                Penunjang Tugas
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('skl')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-universal-access nav-icon">

                        </i>
                        SKL
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("skl.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-list-alt nav-icon">

                                </i>
                                Detail SKL
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            
            @can('accident_report')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-wheelchair nav-icon">

                        </i>
                        Accident Report
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("accidentreport.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-list-alt nav-icon">

                                </i>
                                Detail Laporan
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('pengadaan')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-shopping-cart nav-icon">

                        </i>
                        Pengadaan
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("all.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-calendar-check-o nav-icon">

                                </i>
                                Detail Pengadaan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("barang.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-cubes nav-icon">

                                </i>
                                Detail Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("log.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-history nav-icon">

                                </i>
                                Log Pengadaan
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('accident_report')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-folder nav-icon">

                        </i>
                        Administrasi
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("file_manager") }}" class="nav-link">
                                <i class="fa-fw fas fa-folder-open nav-icon">

                                </i>
                                File Manager
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('users_manage')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.unit.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-group nav-icon">
        
                                </i>
                                Unit
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change password
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>