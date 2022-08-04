@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pelaporan /</span> Manajemen Risiko
</h4>

<!-- DataTable with Buttons -->
<div class="card card-action mb-5">
  <div class="card-alert"></div>
  <div class="card-header">
    <div class="card-action-title">
      <a class="btn btn-label-primary" href="{{ route('manrisk.create') }}">
        <i class="bx bx-plus scaleX-n1-rtl"></i>
        <span class="align-middle">Tambah</span>
      </a>
      {{-- <button class="btn btn-primary">
        <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah
      </button> --}}
    </div>
    <div class="card-action-element">
      <ul class="list-inline mb-0">
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
        </li>
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-reload"><i class="tf-icons bx bx-rotate-left scaleX-n1-rtl"></i></a>
        </li>
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
        </li>
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-close"><i class="tf-icons bx bx-x"></i></a>
        </li>
      </ul>
    </div>
  </div>
  {{-- <div class="card-header flex-column flex-md-row">
    <div class="head-label"><h5 class="card-title mb-0">DataTable with Buttons</h5></div>
  </div> --}}
  <div class="collapse show">
    <div class="card-datatable table-responsive">
      <table id="table" class="table border-top">
        <thead>
          <tr>
            <th>ID</th>
            <th>Unit</th>
            <th>Jenis Risiko</th>
            <th>Proses Utama</th>
            <th>Item Kegiatan</th>
            <th>Jenis Aktivitas</th>
            <th>Kode Bahaya</th>
            <th>Sumber Bahaya</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tampil-tbody"><tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
      </table>
    </div>
  </div>
</div>

<script>$(document).ready( function () {
  $('#table').DataTable(
    {
      order: [[2, "desc"]],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: "collection",
          className: "btn btn-label-primary dropdown-toggle me-2",
          text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [{
            extend: "print",
            text: '<i class="bx bx-printer me-2" ></i>Print',
            className: "dropdown-item",
            exportOptions: {
                columns: [3, 4, 5, 6, 7]
            }
          }, {
            extend: "csv",
            text: '<i class="bx bx-file me-2" ></i>Csv',
            className: "dropdown-item",
            exportOptions: {
                columns: [3, 4, 5, 6, 7]
            }
          }, {
            extend: "excel",
            text: "Excel",
            className: "dropdown-item",
            exportOptions: {
                columns: [3, 4, 5, 6, 7]
            }
          }, {
            extend: "pdf",
            text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
            className: "dropdown-item",
            exportOptions: {
                columns: [3, 4, 5, 6, 7]
            }
          }, {
            extend: "copy",
            text: '<i class="bx bx-copy me-2" ></i>Copy',
            className: "dropdown-item",
            exportOptions: {
                columns: [3, 4, 5, 6, 7]
            }
          }]
        }
      ]
    },
  );
  $(".head-label").html('<h5 class="card-title mb-0">Tabel</h5>');
} );
</script>
@endsection