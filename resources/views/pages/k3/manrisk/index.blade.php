@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pelaporan /</span> Manajemen Risiko
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
<!-- DataTable with Buttons -->
<div class="card card-action mb-5">
  {{-- <div class="card-alert"></div> --}}
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
  <hr style="margin-top: -5px">
  <div class="collapse show">
    <div class="card-datatable table-responsive" style="margin-top: -10px">
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
            <th>Update</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tampil-tbody"><tr><td colspan="10"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready( function () {
  $.ajax(
    {
      url: "./manrisk/api/data",
      type: 'GET',
      async: true,
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        if(res.show.length == 0){
          $("#tampil-tbody").append(`<tr><td colspan="10"><center>Tidak Ada Data</center></td></tr>`);
        } else {
          res.show.forEach(item => {
            $("#tampil-tbody").append(`
              <tr id="data${item.id}">
                <td><kbd>${item.id}</kbd></td>
                <td>${JSON.parse(item.unit)}</td>
                <td>${item.jenis_risiko}</td>
                <td>${item.proses_utama}</td>
                <td>${item.item_kegiatan}</td>
                <td>${item.jenis_aktivitas}</td>
                <td>${item.kode_bahaya}</td>
                <td>${item.sumber_bahaya}</td>
                <td>${item.updated_at}</td>
                <td>
                  <center><div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item text-warning" href="javascript:void(0);"><i class="bx bx-edit scaleX-n1-rtl"></i> Ubah</a></li>
                      <li><a class="dropdown-item text-info" href="javascript:void(0);"><i class="bx bx-printer scaleX-n1-rtl"></i> Cetak</a></li>
                      <li><a class="dropdown-item text-danger" href="javascript:void(0);"><i class="bx bx-trash scaleX-n1-rtl"></i> Hapus</a></li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li><a class="dropdown-item text-dark" href="javascript:void(0);"><i class="bx bx-refresh scaleX-n1-rtl"></i> Residual</a></li>
                    </ul>
                  </center></div>
                </td>
              </tr>
            `);
          });
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
          $("div.head-label").html('<h5 class="card-title mb-0">Tabel</h5>');
        }
      }
    }
  );
} );
</script>
@endsection