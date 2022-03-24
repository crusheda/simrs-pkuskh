@php
    $route = Route::currentRouteName();
    $title = null;
    $b1 = null;
    $b2 = null;
    $b3 = null;
    $b4 = null;
    $b5 = null;
    $b6 = null;
    // print_r($route);
    // die();

    // AUTH
    if ($route == 'auth.change_password') {
      $title = 'Ubah Password';
      $b1 = 'Ubah Password'; 
    }
    // PUBLIK
    if ($route == 'welcome') {
      $title = 'Dashboard';
      $b1 = 'Dashboard'; 
    }
    if ($route == 'profil.index') {
      $title = 'Ubah Profil Karyawan'; 
      $b1 = 'Profil'; 
    }
    if ($route == 'kunjungan') {
      $title = 'Data Kunjungan Pasien';
      $b1 = 'Dashboard'; 
      $b2 = 'Kunjungan'; 
    }
    // ADMINISTRASI
      // LAPORAN BULANAN
      if ($route == 'bulan.index') {
        $title = 'Laporan Bulanan';
        $b1 = 'Administrasi'; 
        $b2 = 'Laporan'; 
        $b3 = 'Bulanan'; 
      }
      // REGULASI
      if ($route == 'regulasi.index') {
        $title = 'Regulasi';
        $b1 = 'Administrasi'; 
        $b2 = 'Regulasi'; 
      }
      // BERKAS RAPAT
      if ($route == 'rapat.index') {
        $title = 'Berkas Rapat';
        $b1 = 'Administrasi'; 
        $b2 = 'Berkas Rapat';
      }
      // File Manajer
      if ($route == 'managerfile') {
        $title = 'File Manajer';
        $b1 = 'Administrasi'; 
        $b2 = 'File Manajer';
      }
      // RKA
      if ($route == 'perencanaan.index') {
        $title = 'Rencana Kerja Anggaran';
        $b1 = 'Administrasi'; 
        $b2 = 'RKA';
      }
    // PERNYATAAN LOG PERAWAT
    if ($route == 'logperawat.index') {
      $title = 'Indikator Tindakan Harian';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Tindakan Harian';
      $b4 = 'Tambah Indikator';
    }
    if ($route == 'logtgsperawat.index') {
      $title = 'Indikator Penunjang Tugas';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Penunjang Tugas';
      $b4 = 'Tambah Indikator';
    }
    if ($route == 'logprofkpr.index') {
      $title = 'Indikator Profesi Keperawatan';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Profesi Keperawatan';
      $b4 = 'Tambah Indikator';
    }
    // LOG PERAWAT
    if ($route == 'tindakan-harian.index') {
      $title = 'Tindakan Harian';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Tindakan Harian';
    }
    if ($route == 'tindakan-harian.cari') {
      $title = 'Filter - Tindakan Harian';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Tindakan Harian';
      $b4 = 'Filter';
    }
    if ($route == 'tgsperawat.index') {
      $title = 'Penunjang Tugas';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Penunjang Tugas';
    }
    if ($route == 'tgsperawat.show') {
      $title = 'Detail Penunjang Tugas';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Penunjang Tugas';
      $b4 = 'Detail Penunjang Tugas';
    }
    if ($route == 'profkpr.index') {
      $title = 'Profesi Keperawatan';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Profesi Keperawatan';
    }
    if ($route == 'profkpr.show') {
      $title = 'Detail Profesi Keperawatan';
      $b1 = 'Laporan'; 
      $b2 = 'Log Perawat';
      $b3 = 'Profesi Keperawatan';
      $b4 = 'Detail Profesi Keperawatan';
    }

      // IPSRS
      if ($route == 'ipsrs.index') {
        $title = 'Pengaduan IPSRS';
        $b1 = 'Laporan'; 
        $b2 = 'Pengaduan IPSRS'; 
      }
      if ($route == 'pengaduan.ipsrs.detail') {
        $title = 'Detail Pengaduan IPSRS';
        $b1 = 'Laporan'; 
        $b2 = 'Pengaduan IPSRS'; 
        $b3 = 'Detail'; 
      }
      if ($route == 'pengaduan.ipsrs.history') {
        $title = 'Rekap Keseluruhan Pengaduan IPSRS';
        $b1 = 'Laporan'; 
        $b2 = 'Pengaduan IPSRS'; 
        $b3 = 'Rekap'; 
      }
      // K3
      if ($route == 'accidentreport.index') {
        $title = 'Laporan Kecelakaan Kerja';
        $b1 = 'Dashboard'; 
        $b2 = 'Accident Report'; 
      }
      // PPI
      if ($route == 'decubitus.index') {
        $title = 'Decubitus';
        $b1 = 'Laporan'; 
        $b2 = 'Surveilans PPI'; 
        $b3 = 'Decubitus'; 
      }
      if ($route == 'ido.index') {
        $title = 'IDO';
        $b1 = 'Laporan'; 
        $b2 = 'Surveilans PPI'; 
        $b3 = 'IDO'; 
      }
      if ($route == 'isk.index') {
        $title = 'ISK';
        $b1 = 'Laporan'; 
        $b2 = 'Surveilans PPI'; 
        $b3 = 'ISK'; 
      }
      if ($route == 'plebitis.index') {
        $title = 'Plebitis';
        $b1 = 'Laporan'; 
        $b2 = 'Surveilans PPI'; 
        $b3 = 'Plebitis'; 
      }
      if ($route == 'vap.index') {
        $title = 'VAP';
        $b1 = 'Laporan'; 
        $b2 = 'Surveilans PPI'; 
        $b3 = 'VAP'; 
      }

    // LAB
    if ($route == 'lab.antigen.index') {
      $title = 'Data Antigen';
      $b1 = 'Laboratorium'; 
      $b2 = 'Antigen'; 
    }
    if ($route == 'lab.antigen.all') {
      $title = 'Rekap Data Antigen';
      $b1 = 'Laboratorium'; 
      $b2 = 'Antigen'; 
      $b3 = 'all'; 
    }

    // KEBIDANAN
    if ($route == 'skl.index') {
      $title = 'Surat Keterangan Lahir';
      $b1 = 'Dashboard'; 
      $b2 = 'Kebidanan'; 
      $b3 = 'SKL'; 
    }

    // KEPEGAWAIAN
    if ($route == 'kepegawaian.karyawan.index') {
      $title = 'Data Seluruh Karyawan';
      $b1 = 'Kepegawaian'; 
      $b2 = 'Data Karyawan';
    }

    // IT
    if ($route == 'it.pilar.index') {
      $title = 'Indikator Mutu Pilar';
      $b1 = 'Pilar'; 
      $b2 = 'Indikator Mutu';
    }
    if ($route == 'it.pilar.all') {
      $title = 'Rekap Indikator Mutu Pilar';
      $b1 = 'Pilar'; 
      $b2 = 'Indikator Mutu';
      $b3 = 'Rekap Indikator Mutu';
    }
    if ($route == 'it.supervisi.index') {
      $title = 'Supervisi IT';
      $b1 = 'Supervisi IT'; 
    }
    if ($route == 'it.logit.all') {
      $title = 'Rekap Supervisi IT';
      $b1 = 'Supervisi IT'; 
      $b2 = 'Rekap Supervisi IT'; 
    }

    // IBS
    if ($route == 'ibs.supervisi.index') {
      $title = 'Ceklist Alat dan Bahan Habis Pakai';
      $b1 = 'Supervisi'; 
      $b2 = 'Ceklist Alat & BHP'; 
    }
    if ($route == 'ibs.supervisi.pushtim') {
      $title = 'Ceklist Alat dan Bahan Habis Pakai';
      $b1 = 'Supervisi'; 
      $b2 = 'Ceklist Alat & BHP'; 
      $b3 = 'Mulai Pengecekan Kelengkapan Alat & BHP'; 
    }
    if ($route == 'ibs.supervisi.cari') {
      $title = 'Filter Ceklist Alat & BHP';
      $b1 = 'Supervisi'; 
      $b2 = 'Ceklist Alat & BHP'; 
      $b3 = 'Filter Ceklist Alat & BHP'; 
    }
    if ($route == 'ibs.refsupervisi.index') {
      $title = 'Indikator Supervisi Alat dan BHP';
      $b1 = 'Supervisi'; 
      $b2 = 'Ceklist Alat & BHP'; 
      $b3 = 'Indikator'; 
    }

    // Administrator
    if ($route == 'notif.index') {
      $title = 'Notifikasi';
      $b1 = 'Administrator'; 
      $b2 = 'Notifikasi';
    }
      // Users
      if ($route == 'admin.users.index') {
        $title = 'Daftar Pengguna Simrsmu';
        $b1 = 'Administrator'; 
        $b2 = 'Atur Pengguna';
        $b3 = 'Users';
      }

@endphp
<h1>{{ $title }}</h1>
<nav class="section-header-breadcrumb" aria-label="breadcrumb" style="margin-bottom: -10px">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      @if ($b2 != null)
        <a href="#">{{ $b1 }}</a>
      @else
        {{ $b1 }}
      @endif
    </li>

    @if ($b2 != null)
      <li class="breadcrumb-item active">
        @if ($b3 != null)
          <a href="#">{{ $b2 }}</a>
        @else
          {{ $b2 }}
        @endif
      </li>
    @endif
    
    @if ($b3 != null)
      <li class="breadcrumb-item active">
        @if ($b4 != null)
          <a href="#">{{ $b3 }}</a>
        @else
          {{ $b3 }}
        @endif
      </li>
    @endif
    
    @if ($b4 != null)
      <li class="breadcrumb-item active">
        @if ($b5 != null)
          <a href="#">{{ $b4 }}</a>
        @else
          {{ $b4 }}
        @endif
      </li>
    @endif
    
    @if ($b6 != null)
      <li class="breadcrumb-item active">
        {{ $b6 }}
      </li>
    @endif
  </ol>
</nav>