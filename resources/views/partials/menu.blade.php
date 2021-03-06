<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
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
                            <a href="{{ route("nonrutin.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-calendar-check-o nav-icon">

                                </i>
                                Riwayat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("nonrutin.create") }}" class="nav-link">
                                <i class="fa-fw fas fa-plus-square nav-icon">

                                </i>
                                Tambah Pengadaan
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
                            <a href="{{ route("pilar.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-database nav-icon">

                                </i>
                                Pilar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("printer.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-print nav-icon">

                                </i>
                                Printer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("cpu.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-wrench nav-icon">

                                </i>
                                CPU
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("jaringan.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-wifi nav-icon">

                                </i>
                                Jaringan
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('penyimpanan_file')
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
            @endcan
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
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change password
                </a>
            </li>
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