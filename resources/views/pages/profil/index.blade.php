@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profil /</span> Detail
</h4>

@if(session('message'))
<div class="alert alert-primary alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
  <p class="mb-0">{{ session('message') }}</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if($errors->count() > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
  <p class="mb-0">
    <ul>
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif

<!-- Header -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      {{-- <div class="user-profile-header-banner">
        <img src="{{ asset('assets-new/img/pages/profile-banner.png') }}" width="100%" alt="Banner image" class="rounded-top">
      </div> --}}
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          @if (!empty($list['foto']->filename))
            <img src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" height="100" width="100" alt="user image" style="margin-top: 2rem" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
          @else
            <img alt="image" src="assets/img/avatar/avatar-1.png" class="d-block rounded" height="100">
          @endif
        </div>
        <div class="flex-grow-1 mt-3">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4" style="margin-top: 1rem">
            <div class="user-profile-info">
              <h4>Hai, {{ Auth::user()->name }} <sup><i class="bx bx-badge-check text-primary"></i></sup></h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item fw-semibold">
                  @foreach($list['user']->roles()->pluck('name') as $role) <span class="badge bg-secondary">{{ $role }}</span> @endforeach
                  <p></p>
                  <i class='bx bx-calendar'></i> Login terakhir : @if (!empty($list['showlog'][1])) {{ \Carbon\Carbon::parse($list['showlog'][1]->log_date)->diffForHumans() }} @else - @endif
                  <p></p>
                  <i class='bx bx-station'></i> Status : <kbd>Aktif</kbd>
                </li>
              </ul>
            </div>
            <a href="/v2/profil/{{ Auth::user()->id }}/edit" class="btn btn-primary text-nowrap">
              <i class='bx bx-edit'></i> Update Profil
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Header -->

<div class="row">
  <div class="col-md-6">
    <!-- About User -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-action-title mb-0"><i class='bx bx-list-ul me-2'></i>Biodata</h5><br>
        <small class="text-muted text-uppercase">Privasi</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-id-card"></i><span class="fw-semibold mx-2">NIK:</span> <span>{{ $list['show']->nik }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="fas fa-hospital-user"></i><span class="fw-semibold mx-2">NIP:</span> <span>{{ $list['show']->nip }}</span></li>
        </ul>
        <small class="text-muted text-uppercase">Data Diri</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Nama Lengkap, Gelar:</span> <span>{{ $list['show']->nama }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-user-check"></i><span class="fw-semibold mx-2">Panggilan:</span> <span>{{ $list['show']->nick }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-calendar-check"></i><span class="fw-semibold mx-2">Tempat, Tanggal Lahir:</span> <span>{{ $list['show']->temp_lahir }}, {{ \Carbon\Carbon::parse($list['show']->tgl_lahir)->isoFormat('D MMM Y') }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="fas fa-venus-mars"></i><span class="fw-semibold mx-2">Jenis Kelamin:</span> <span style="text-transform: lowercase;">{{ ucfirst($list['show']->jns_kelamin) }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="fas fa-heart"></i><span class="fw-semibold mx-2">Status Kawin:</span> <span style="text-transform: lowercase;">{{ $list['show']->status_kawin }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Status Karyawan:</span> <span>{{ $list['show']->status != 1? 'Aktif':'Non Aktif' }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-semibold mx-2">Jabatan:</span> <span>@foreach($list['user']->roles()->pluck('name') as $role) <span class="badge bg-secondary">{{ $role }}</span> @endforeach</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-action-title mb-0"><i class='bx bx-list-ul me-2'></i>Sosial Media</h5><br>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-semibold mx-2">No. HP:</span> <span>{{ $list['show']->no_hp }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="fab fa-instagram"></i><span class="fw-semibold mx-2">Instagram:</span> <span>{{ $list['show']->ig }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="fab fa-facebook"></i><span class="fw-semibold mx-2">Facebook:</span> <span>{{ $list['show']->fb }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span> <span>{{ $list['show']->email }}</span></li>
        </ul>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-action-title mb-0"><i class='bx bx-list-ul me-2'></i>Alamat</h5><br>
        <ul class="list-unstyled mt-3 mb-0">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Kelurahan:</span> <span>{{ $list['show']->ktp_kelurahan }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Kecamatan:</span> <span>{{ $list['show']->ktp_kecamatan }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Kabupaten:</span> <span>{{ $list['show']->ktp_kabupaten }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Provinsi:</span> <span>{{ $list['show']->ktp_provinsi }}</span></li>
          <hr>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-chevron-right"></i><span class="fw-semibold mx-2">Alamat Lengkap:</span></li>
          <li><span>{{ $list['show']->alamat_ktp }}</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection