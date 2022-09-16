@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrasi / Laporan /</span> Bulanan
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

<div class="row">
  <div class="col-lg-10 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Laporan Digital</h5>
            <p class="mb-4">Segera <span class="fw-bold">Upload</span> laporanmu agar bisa segera diverifikasi oleh Atasanmu sebelum Tanggal xx</p>

            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Form Upload</a>
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
  <div class="col-lg-2 mb-4 order-1">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="mb-0">Total Upload</h5>
        <small>Semua Unit/Bagian</small><h2></h2>
        <h3 class="text-primary card-title mb-1">4,230</h3>
        <small class="text-nowrap fw-semibold">Bulan Ini</small>
      </div>
    </div>
  </div>
</div>

<div class="card card-action mb-4">
  <div class="card-header" style="margin-bottom: -20px">
    <div class="card-action-title">
      <div class="btn-group">
        <a class="btn btn-label-primary" href="" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Menampilkan Semua Data Laporan Bulanan Bawahan" disabled>
          <i class="bx bx-history scaleX-n1-rtl"></i>
          <span class="align-middle">Laporan Bawahan</span>
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
  <div class="collapse show">
    <div class="card-datatable table-responsive text-nowrap">
      <table id="table" class="table table-striped" style="width:100%">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>DIUPDATE</th>
                  <th>JUDUL</th>
                  <th>BLN / THN</th>
                  <th>KETERANGAN</th>
                  <th><center>AKSI</center></th>
              </tr>
          </thead>
          <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
      </table>
    </div>
  </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="tambah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          Tambah Laporan Bulanan
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
          <form class="form-auth-small" name="formTambah" action="{{ route('bulanan.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <i class="fa-fw fas fa-info-circle nav-icon"></i> Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong>Hari saat Anda mengupload saja</strong><hr>
              <div class="row">
                  <div class="col-md-4">
                    <div class="form-group mb-3">
                      <label>Bulan</label>
                      <select class="select2 form-select" name="bln" id="bln-tambah" required>
                          <option value="">Bulan</option>
                          <?php
                              $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                              $jml_bln=count($bulan);
                              for($c=1 ; $c < $jml_bln ; $c+=1){
                                  echo"<option value=$c> $bulan[$c] </option>";
                              }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group mb-3">
                      <label>Tahun</label>
                      <select class="select2 form-select" name="thn" id="thn-tambah" required>
                          <option value="">Tahun</option>
                          @php
                              for ($i=2018; $i <= $list['thn']; $i++) { 
                                  echo"<option value=$i> $i </option>";
                              }
                              
                          @endphp
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group mb-3">
                      <label>Judul</label>
                      <input type="text" name="judul" class="form-control" placeholder="Laporan Bulanan Unit X" required>
                    </div>
                  </div>
              </div>
              <div class="form-group mb-3">
                <label>Keterangan :</label>
                <textarea rows="3" class="autosize2 form-control" id="ket" placeholder="Optional" required></textarea>
              </div>
              <div class="form-group mb-3">
                <label>Dokumen : </label>
                <input type="file" name="file" class="form-control mb-2">
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Format yang dibolehkan : <strong>.pdf </strong>, <strong>.docx </strong>, <strong>.doc </strong>, <strong>.xls </strong>, <strong>.xlsx </strong>, <strong>.ppt </strong>, <strong>.pptx </strong>.<br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>100 mb</strong>.
              </div>
      </div>
      <div class="modal-footer">
              <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
          </form>

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
<script>$(document).ready( function () {
  // $("html").addClass('layout-menu-collapsed');
  // SELECT2
  var t = $(".select2");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  })
  
  $.ajax(
    {
      url: "/api/laporan/bulanan/table/user",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        var date = new Date().toISOString().split('T')[0];
        res.show.forEach(item => {
            var updet = item.updated_at.substring(0, 10);
            $("#tampil-tbody").append(`
                <tr id="data${item.id}">
                    <td>${item.id} ${item.tgl_verif != null ? '<i class="fa-fw fas fa-check nav-icon"></i>' : '' }</td>
                    <td>${item.updated_at}</td>
                    <td>${item.judul}</td>
                    <td>${item.bln} / ${item.thn}</td>
                    <td>${item.ket}</td>
                    <td>
                        <center>
                            <div class="btn-group" role="group">
                                <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD LAPORAN"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                ${item.ket_verif != null ?
                                    '<button class="btn btn-info text-white btn-sm" onclick="ketLihat('+item.id+')" data-toggle="tooltip" data-placement="bottom" title="KETERANGAN VERIFIKATOR"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                    :
                                    '<button class="btn btn-secondary text-white btn-sm" disabled><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                }
                                ${updet == date ?
                                    '<button type="button" class="btn btn-warning btn-sm" onclick="showUbah('+item.id+')" data-toggle="tooltip" data-placement="bottom" title="UBAH LAPORAN"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> <button type="button" class="btn btn-danger btn-sm" onclick="hapus('+item.id+')" data-toggle="tooltip" data-placement="bottom" title="HAPUS LAPORAN"><i class="fa-fw fas fa-trash nav-icon"></i></button>' : '<button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>'
                                }
                            </div>
                        </center>
                    </td>
                </tr>
            `);
        });
        $('#table').DataTable(
          {
            order: [[1, "desc"]],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [{
                extend: "collection",
                className: "btn btn-label-primary dropdown-toggle me-2",
                text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                buttons: [{
                    extend: "print",
                    text: '<i class="bx bx-printer me-2" ></i>Print',
                    className: "dropdown-item",
                    // exportOptions: {
                    //     columns: [3, 4, 5, 6, 7]
                    // }
                }, {
                    extend: "excel",
                    text: '<i class="bx bxs-spreadsheet me-2"></i>Excel',
                    className: "dropdown-item",
                    autoFilter: true,
                    attr: {id: 'exportButton'},
                    sheetName: 'data',
                    title: '',
                    filename: 'Laporan Bulanan'
                }, {
                    extend: "pdf",
                    text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                    className: "dropdown-item",
                }, {
                    extend: "copy",
                    text: '<i class="bx bx-copy me-2" ></i>Copy',
                    className: "dropdown-item",
                    // exportOptions: {
                    //     columns: [3, 4, 5, 6, 7]
                    // }
                },]
              }, 
              {
                extend: 'colvis',
                text: '<i class="bx bx-hide me-sm-2"></i> <span class="d-none d-sm-inline-block">Column</span>',
                className: "btn btn-label-primary modal me-2",
                // collectionLayout: 'dropdown-menu',
                // contentClassName: 'dropdown-item'
              }
            ],
            'columnDefs': [
                // { targets: 3, visible: false },
                // { targets: 5, visible: false },
                // { targets: 6, visible: false },
                // { targets: 9, visible: false },
                // { targets: 10, visible: false },
                // { targets: 11, visible: false },
                // { targets: 12, visible: false },
                // { targets: 16, visible: false },
            ],
          },
        );
        $("div.head-label").html('<h5 class="card-title mb-0">Daftar Laporan Anda</h5>');
      }
    }
  );
  
});

// FUNCTION
</script>
@endsection