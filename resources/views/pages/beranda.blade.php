@extends('layouts.simrsmuv2')

@section('content')
<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary"><i class="bx bx-pin"></i> Sistem Simrsmu versi 2.0 ?</h5>
            <p class="mb-4">Website simrsmu versi 2.0 ini dibuat untuk memudahkan karyawan Rumah Sakit PKU Muhammadiyah Sukoharjo di jaman yang serba Digital dan Paperless.<br><br>
              Kami akan membuat sistem ini berdasarkan <i>User Experience</i> dari sistem sebelum-sebelumnya sehingga dapat diakses dengan cepat dan mudah.</p>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengajuanSistem"> <i class="bx bx-wrench"></i>  Pengajuan Sistem </button>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{ asset('assets-new/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pengajuanSistem" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-5">Pengajuan Sistem</h3>
        </div>
        <h6>Ahh.. Maaf, Belum saatnya..<br>Kami sedang dalam perbaikan sistem..</h6><hr>
        <p>Konsultasikan terlebih dahulu dengan Programmer Kami untuk perancangan Sistem yang akan dibuat.</p>
      </div>
    </div>
  </div>
</div>
@endsection