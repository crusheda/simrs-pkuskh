@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
        <div class="card-header">
          <h6>Pengajuan sistem untuk Unit Anda?</h6>
        </div>
        <div class="card-body">
          <p>
            Konsultasikan terlebih dahulu dengan Kami untuk perancangan Sistem yang akan dibuat.<br>Silakan menambahkan Rincian Kegiatan Penambahan Sistem pada Program Kerja 2023 anda beserta anggarannya.
            <hr>
            <kbd style="background-color: #696CFF">Simrsmu versi 2.0</kbd> ini dibuat untuk memudahkan karyawan Rumah Sakit PKU Muhammadiyah Sukoharjo di jaman yang serba Digital dan Paperless. Kami akan membuat sistem ini berdasarkan <i>User Experience</i> dari sistem sebelum-sebelumnya sehingga dapat diakses dengan cepat dan mudah.
          </p>
        </div>
        <div class="card-footer">
            <a class="btn btn-dark" target="_blank" href="https://wa.me/6282223680801"><i class="fas fa-phone"></i>&nbsp;&nbsp;Konsultasi by WA</a>
        </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
        <div class="card-header">
          <h6>Pengaduan IPSRS Sudah Tersedia !!</h6>
        </div>
        <div class="card-body">
            <p>Instalasi yang melaksanakan tugas pokok dan fungsi dalam hal pemeliharaan Sarana Rumah Sakit</p>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary pull-right" href="{{ route('ipsrs.index') }}"><i class="fas fa-wrench"></i>&nbsp;&nbsp;Buka Pengaduan Sekarang</a>
        </div>
    </div>
  </div>
</div>
@endsection