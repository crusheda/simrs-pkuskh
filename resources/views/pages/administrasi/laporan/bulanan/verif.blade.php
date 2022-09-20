@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrasi / Laporan / Bulanan /</span> Verifikasi 
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

{{-- <div class="row">
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
        <h3 class="text-primary card-title mb-1">0</h3>
        <small class="text-nowrap fw-semibold">Bulan Ini</small>
      </div>
    </div>
  </div>
</div> --}}

<div class="card card-action mb-4">
  <div class="card-header" style="margin-bottom: -20px">
    <div class="card-action-title">
      <div class="btn-group">
        <a class="btn btn-label-dark" href="{{ route('bulanan.index') }}">
          <i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Kembali
        </a>
        <button class="btn btn-label-warning" data-bs-target="#info" data-bs-toggle="modal">
          <i class="fas fa-info"></i>&nbsp;&nbsp;Informasi
        </button>
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
              <th class="cell-fit"><center>#</center></th>
              <th>NAMA</th>
              <th>UNIT</th>
              <th>JUDUL</th>
              <th>BLN / THN</th>
              <th>KETERANGAN</th>
              <th>DIUPDATE</th>
            </tr>
          </thead>
          <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
          <tfoot>
            <tr>
              <th class="cell-fit"><center>#</center></th>
              <th>NAMA</th>
              <th>UNIT</th>
              <th>JUDUL</th>
              <th>BLN / THN</th>
              <th>KETERANGAN</th>
              <th>DIUPDATE</th>
            </tr>
          </tfoot>
      </table>
    </div>
  </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="verif" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-5">Verifikasi Dokumen</h3>
        </div>
        <h6>Kami sedang dalam perbaikan Sistem Laporan Bulanan</h6><hr>
        <p>Tunggu beberapa saat lagi...</p>
      </div>
    </div>
  </div>
</div>
{{-- <div class="modal fade" id="verif" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Status</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <table id="tableverif" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>NAMA</th>
                <th>UNIT</th>
                <th>KET</th>
                <th>TGL</th>
              </tr>
            </thead>
            <tbody id="tampil-tbody"><tr><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
            <tfoot>
              <tr>
                <th>NAMA</th>
                <th>UNIT</th>
                <th>KET</th>
                <th>TGL</th>
              </tr>
            </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" id="btn-verif" onclick="verif()" disabled><i class="fa-fw fas fa-check nav-icon"></i> Verifikasi</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div> --}}
<div class="modal fade" id="info" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Informasi</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <h5 class="mb-0">Cara Setting PDF Viewer pada browser Google Chrome</h5>
        <sub>Terdapat 2 cara untuk melihat laporan bulanan PDF tanpa mendownload. Apabila anda menggunakan browser Firefox, silakan abaikan semua langkah di bawah.</sub>
        <div class="divider text-end">
          <div class="divider-text">Plugin PDF Viewer</div>
        </div>
        <p>
          <h6>1. Instal plugin untuk Google Chrome dengan membuka Link <a target="_blank" href="https://chrome.google.com/webstore/detail/pdf-viewer/oemmndcbldboiebfnladdacbdfmadadm?hl=in"><u>Disini</u></a></h6>
          <h6>2. Klik <strong>Tambahkan ke Chrome</strong></h6>
          <img src="{{ asset('img/pdf-viewer/1.jpg') }}" class="img-fluid" alt="">
          <h6>3. Klik <strong>Add extension</strong></h6>
          <img src="{{ asset('img/pdf-viewer/2.jpg') }}" class="img-fluid" alt="">
        </p>
        <div class="divider text-end">
          <div class="divider-text">Mode Incognito (Private Browser)</div>
        </div>
        <p>
          <h6>1. Masuk ke Menu Chrome dengan cara klik tombol Titik Tiga di Pojok Kanan Atas</h6>
          <img src="{{ asset('img/pdf-viewer/3.jpg') }}" class="img-fluid mb-3" alt="">
          <h6>2. Klik tombol <strong>New Incognito Window</strong> atau dengan menekan kombinasi tombol <strong>Ctrl+Shift+N</strong></h6>
          <h6>3. Masuk/Login <strong>Simrsmu</strong> kembali pada Mode Incognito tersebut dan anda sudah bisa melihat dokumen Laporan Bulanan tanpa harus mendownloadnya terlebih dahulu</h6>
        </p>
      </div>
      <div class="modal-footer">
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
      url: "/api/laporan/bulanan/table/verif",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        var date = getDateTime();
        res.forEach(item => {
            if(item.unit) {
              try {
                var un = JSON.parse(item.unit);
              } catch(e) {
                var un = item.unit;
              }
            }
            var updet = item.updated_at.substring(0, 10);
            content = `<tr id="data`+item.id+`">`;
            content += `<td><center><div class="btn-group">
                        <button class='btn btn-primary btn-sm' onclick="window.location.href='{{ url('v2/laporan/bulanan/`+item.id+`') }}'"><i class="fa-fw fas fa-eye nav-icon"></i></button>
                        <button class='btn btn-success btn-sm' onclick="window.location.href='{{ url('v2/laporan/bulanan/download/`+item.id+`') }}'"><i class="fa-fw fas fa-download nav-icon"></i></button>
                        <button class='btn btn-info btn-sm' onclick="showVerif(`+item.id+`)"><i class="fa-fw fas fa-check nav-icon"></i></button>`;
                        // if(item.tgl_verif != null) {
                        // } else {
                        //   content += `<button class='btn btn-secondary btn-sm' disabled><i class="fa-fw fas fa-check nav-icon"></i></a></li>`;
                        // };
            content += `</div></center></td>
                        <td>`+item.nama+`</td>
                        <td>`+un+`</td>
                        <td>`+item.judul+`</td>
                        <td>`+item.bln+` / `+item.thn+`</td><td>`;
                        if (item.ket != null) {
                          content += item.ket;
                        }
            content += `</td><td>`+item.updated_at+`</td></tr>`;
            $('#tampil-tbody').append(content);
        });
        $('#table').DataTable(
          {
            order: [[6, "desc"]],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100, 500],
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
            columnDefs: [
                { targets: 0, orderable: !1,searchable: !1, },
                { targets: 3, orderable: !1 },
                { targets: 5, orderable: !1 },
                // { targets: 6, visible: false },
                // { targets: 9, visible: false },
                // { targets: 10, visible: false },
                // { targets: 11, visible: false },
                // { targets: 12, visible: false },
                // { targets: 16, visible: false },
            ],
          },
        );
        $("div.head-label").html('<h5 class="card-title mb-0">Daftar Laporan Bawahan</h5>');
      }
    }
  );
  
});

// FUNCTION
function getDateTime() {
  var now     = new Date(); 
  var year    = now.getFullYear();
  var month   = now.getMonth()+1; 
  var day     = now.getDate();
  if(month.toString().length == 1) {
        month = '0'+month;
  }
  if(day.toString().length == 1) {
        day = '0'+day;
  } 
  var dateTime = year+'-'+month+'-'+day;   
    return dateTime;
}

function saveData() {
  $("#tambah").one('submit', function() {
    $("#btn-simpan").attr('disabled','disabled');
    $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
    return true;
  });
}

function showVerif(id) {
  $('#verif').modal('show');
}
</script>
@endsection