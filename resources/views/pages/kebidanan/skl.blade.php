@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">K3 MFK /</span> Daftar Risiko
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
<!-- Find Resiko Berulang -->
<div class="card card-action mb-5">
  {{-- <div class="card-alert"></div> --}}
  <div class="card-header">
    <div class="card-action-title">
      <div class="btn-group">
        <a class="btn btn-primary" href="{{ route('manrisk.create') }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Tambah Daftar Risiko</span>">
          <i class="bx bx-plus scaleX-n1-rtl"></i>
          <span class="align-middle">Risiko Awal</span>
        </a>
        <a class="btn btn-info text-white" onclick="info()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-info-circle bx-xs' ></i> <span>Informasi Tambahan</span>">
          <i class="bx bx-info-circle scaleX-n1-rtl"></i>
        </a>
        <a class="btn btn-dark text-white" onclick="berulang()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-refresh bx-xs' ></i> <span>Tambah Risiko Berulang</span>">
          <i class="bx bx-refresh scaleX-n1-rtl"></i>
          <span class="align-middle">Risiko Berulang</span>
        </a>
      </div>
    </div>
    <div class="card-action-element">
      <ul class="list-inline mb-0">
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
        </li>
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
        </li>
      </ul>
    </div>
  </div>
  {{-- <div class="card-header flex-column flex-md-row">
    <div class="head-label"><h5 class="card-title mb-0">DataTable with Buttons</h5></div>
  </div> --}}
  <hr style="margin-top: -5px">
  <div class="collapse show">
    <div class="card-datatable table-responsive" style="margin-top: -10px;white-space: nowrap;word-break: break-word;">
      <table id="table" class="table border-top">
        <thead>
          <tr>
            <th>ID</th>
            <th>Unit</th>
            <th>Ruang Lingkup</th>
            <th>Proses Utama</th>
            <th>Item Kegiatan</th>
            <th>Sumber Data</th>
            <th>Kode Bahaya</th>
            <th>Sumber Bahaya</th>
            <th>Risiko</th>
            <th>Usulan Pengendalian</th>
            <th>Dampak</th>
            <th>Kemungkinan / Frekuensi</th>
            <th>Nilai</th>
            <th>Tingkat Risiko</th>
            <th>Evaluasi Pengendalian</th>
            <th>Realisasi Pengendalian</th>
            <th>Waktu Penerapan</th>
            <th>Residual (Update)</th>
            <th>Dibuat</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody id="tampil-tbody"><tr><td colspan="23"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="berulang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="berulang">Tambah Risiko Berulang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formResidual" class="form-auth-small" action="{{ route('manrisk.residual') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
      </form>
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection