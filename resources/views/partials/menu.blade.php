<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            {{-- <li class="nav-item">
                <center>
                    <span class="badge badge-pill badge-light" style="text-transform: capitalize;margin-top: 10px;margin-bottom: 10px">
                    <i class="fa-fw fas fa-user-circle nav-icon"></i> {{ Auth::user()->name }} </span>
                </center>
            </li> --}}
            <li class="nav-item" style="background-color: #262A2E" onclick="window.location.href='{{ route('user.index') }}'">
                <a onclick="window.location.href='{{ route('user.index') }}'" class="nav-link disabled text-white" style="font-size: 15px">
                    <i class="nav-icon fas fa-fw fa-user-circle text-white"></i>
                    <b>Hi, {{ Auth::user()->nick }}</b>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            {{-- <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user nav-icon"></i>
                    Pengaturan
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("home") }}" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-tachometer-alt">
        
                            </i>
                            {{ trans('global.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="fa-fw fas fa-user-circle nav-icon text-primary">

                            </i>
                            Profil
                        </a>
                    </li>
                        <a href="{{ route('auth.change_password') }}" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-key text-warning">

                            </i>
                            Ubah Password
                        </a>
                    </li>
                        <a onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-sign-out-alt text-danger">

                            </i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li> --}}
            @if(Auth::user()->hasAnyRole(['ibs', 'spv']))
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-low-vision nav-icon">

                    </i>
                    Supervisi
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("ibs.supervisi.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-calendar-check nav-icon">

                            </i>
                            Ceklist Alat & BHP IBS
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @role('it')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-low-vision nav-icon">

                        </i>
                        Supervisi
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
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-coffee nav-icon">

                        </i>
                        Pilar Hospital
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("it.pilar.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-database nav-icon">

                                </i>
                                Imut
                                <span class="badge badge-light">
                                    @php
                                        echo count(\DB::table('imutpilar')->where('jamselesai',null)->where('deleted_at',null)->get()); 
                                    @endphp
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.rev.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-code-fork nav-icon">

                                </i>
                                Rev
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.pilar.kunjungan") }}" class="nav-link">
                                <i class="fa-fw fas fa-taxi nav-icon">

                                </i>
                                Kunjungan
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- @can('imut_it')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-line-chart nav-icon">

                        </i>
                        Imut
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("it.pilar.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-database nav-icon">

                                </i>
                                Pilar
                                <span class="badge badge-light">
                                    @php
                                        echo count(\DB::table('imutpilar')->where('jamselesai',null)->where('deleted_at',null)->get()); 
                                    @endphp
                                </span>
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
            @endcan --}}
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
            {{-- @can('sisrute')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle">
                        <i class="fa-fw fas fa-heartbeat nav-icon">

                        </i>
                        Sisrute
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("sisrute.diagnosis") }}" class="nav-link">
                                <i class="fa-fw fas fa-book nav-icon">

                                </i>
                                Diagnosis
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan --}}
            @can('log_perawat')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle">
                        <i class="fa-fw fas fa-book nav-icon">

                        </i>
                        Log Perawat
                        @if (\Carbon\Carbon::now()->isoFormat('MM') == '11')
                            <span class="badge badge-info">Baru</span>
                        @endif
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("tindakan-harian.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-book nav-icon">

                                </i>
                                Tindakan Harian
                                @if (\Carbon\Carbon::now()->isoFormat('MM') == '11')
                                    <span class="badge badge-info">Baru</span>
                                @endif
                            </a>
                        </li>
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

            @can('antigen')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-flask nav-icon">

                        </i>
                        Laboratorium
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("lab.antigen.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-hand-lizard nav-icon">

                                </i>
                                Antigen
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
            @can('surveilans-ppi')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-tags nav-icon">

                        </i>
                        Surveilans PPI
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("plebitis.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-caret-right nav-icon">

                                </i>
                                Plebitis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("ido.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-caret-right nav-icon">

                                </i>
                                IDO
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("isk.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-caret-right nav-icon">

                                </i>
                                ISK
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("decubitus.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-caret-right nav-icon">

                                </i>
                                Decubitus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("vap.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-caret-right nav-icon">

                                </i>
                                VAP
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('pengajuan-pengeluaran')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-money nav-icon">

                        </i>
                        Keuangan
                    </a>
                    <ul class="nav-dropdown-items">
                        @role('kasir|kabag-keuangan|it')
                        <li class="nav-item">
                            <a href="{{ route("pendapatan.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-bar-chart nav-icon">

                                </i>
                                Pendapatan
                            </a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{ route("pengajuan.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-area-chart nav-icon">

                                </i>
                                Pengajuan
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('kepegawaian')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-folder nav-icon">

                        </i>
                        Kepegawaian
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("kepegawaian.karyawan.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-male nav-icon">
        
                                </i>
                                Data Karyawan
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('insentif_kehadiran')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-percent nav-icon">

                        </i>
                        Insentif
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("insentif.kehadiran") }}" class="nav-link">
                                <i class="fa-fw fas fa-retweet nav-icon">
        
                                </i>
                                Kehadiran
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('gaji')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-gift nav-icon">

                        </i>
                        Gaji Karyawan
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("kepegawaian.final.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-money nav-icon">
        
                                </i>
                                Detail Gaji
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("kepegawaian.terima.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-handshake nav-icon">
        
                                </i>
                                Set Gaji
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-bookmark nav-icon">

                        </i>
                        Ref Gaji
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("kepegawaian.golongan.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-chevron-right nav-icon">
        
                                </i>
                                Golongan Karyawan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("kepegawaian.potong.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-chevron-right nav-icon">
        
                                </i>
                                Potong Gaji
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("kepegawaian.struktural.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-chevron-right nav-icon">
        
                                </i>
                                Tunjangan Struktural
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("kepegawaian.fungsional.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-chevron-right nav-icon">
        
                                </i>
                                Tunjangan Fungsional
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-gavel nav-icon">

                    </i>
                    Pengaduan
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("ipsrs.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-wrench nav-icon">
    
                            </i>
                            IPSRS 
                            <span class="badge badge-light">
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
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-folder nav-icon">

                    </i>
                    Administrasi
                    @if (\Carbon\Carbon::now()->isoFormat('MM') == '11')
                        <span class="badge badge-light">Baru</span>
                    @endif
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("managerfile") }}" class="nav-link">
                            <i class="fa-fw fas fa-folder-open nav-icon">

                            </i>
                            File Manager
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bulan.index') }}" class="nav-link">
                            <i class="fa-fw fas fa-book nav-icon">

                            </i>
                            Laporan Bulanan
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route("bulanan.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-book nav-icon">

                            </i>
                            Laporan Bulanan
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route("rapat.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-inbox nav-icon">
    
                            </i>
                            Berkas Rapat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("regulasi.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-legal nav-icon">

                            </i>
                            Regulasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("perencanaan.index") }}" class="nav-link">
                            <i class="fa-fw fas fa-puzzle-piece nav-icon">

                            </i>
                            RKA
                        </a>
                    </li>
                </ul>
            </li>
            @can('antrian_poli')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-bullhorn nav-icon">

                        </i>
                        Antrian Poli
                    </a>
                    <ul class="nav-dropdown-items">
                    @role('informasi')
                        <li class="nav-item">
                            <a href="{{ route("queue.informasi.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-user-plus nav-icon">

                                </i>
                                Daftar Inden Pasien
                            </a>
                        </li>
                    @endrole
                    @role('rm')
                        <li class="nav-item">
                            <a href="{{ route("queue.rm.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-user-plus nav-icon">

                                </i>
                                Daftar Pasien
                            </a>
                        </li>
                    @endrole
                    @role('poli')
                        <li class="nav-item">
                            <a href="{{ route("queue.poli.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-sort-amount-asc nav-icon">

                                </i>
                                Detail Antrian
                            </a>
                        </li>
                    @endrole
                    @role('it')
                        <li class="nav-item">
                            <a href="{{ route("it.poli.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-sort-amount-asc nav-icon">

                                </i>
                                Detail Set Poli
                            </a>
                        </li>
                    @endrole
                        <li class="nav-item">
                            <a href="{{ route("show.history") }}" class="nav-link">
                                <i class="fa-fw fas fa-bookmark nav-icon">

                                </i>
                                History Antrian
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
                        <li class="nav-item">
                            <a href="{{ route("it.dokter.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-user-md nav-icon">
        
                                </i>
                                Dokter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.roleuser.index") }}" class="nav-link">
                                <i class="fa-fw fas fa-drivers-license nav-icon">
        
                                </i>
                                Set User Role
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("it.user.activity") }}" class="nav-link">
                                <i class="fa-fw fas fa-eye nav-icon">
        
                                </i>
                                User Activity
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
            {{-- <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li> --}}
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>