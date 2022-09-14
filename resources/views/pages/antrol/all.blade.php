@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Antrian Online /</span> Daftar Pasien 
</h4>
  
@can('antigen')

<button type="button" class="btn btn-label-dark mb-3" onclick="window.location.href='{{ route('beranda.index') }}'"><i class="bx bx-chevron-left me-1"></i> Kembali</button>
<div class="card card-action mb-4">
  <div class="card-header">
    <div class="card-action-title">
      <h5>Antrian Online BPJS &nbsp;<button type="button" class="btn btn-primary btn-sm" onclick="window.open('/v2/antrol/display','width=900,height=600')"><i class="fas fa-tv"></i>&nbsp;&nbsp;Display Antrian</button></h5>
      <small>
        <i class="fas fa-chevron-right"></i>&nbsp;&nbsp;Data yang ditampilkan adalah <strong>Data 30 Hari ke belakang dihitung dari Hari ini</strong><br>
        <i class="fas fa-chevron-right"></i>&nbsp;&nbsp;Koneksi internet Anda sangat berpengaruh terhadap Penarikan Data Pasien
      </small>
      {{-- <div class="input-group mb-2" style="width: 30%">
        <input type="text" id="filter" name="filter" class="form-control"/>
        <button type="button" class="btn btn-label-primary" onclick="filterAntigen()">
          <i class="bx bx-filter scaleX-n1-rtl"></i>
          <span class="align-middle">Filter</span>
        </button>
      </div>
      <small><i class="fas fa-chevron-right"></i> Penentuan Tanggal terhitung mulai dari <kbd>Pukul 00:00 - 00:00</kbd><br>
             <i class="fas fa-chevron-right"></i> Contoh Penarikan data Tgl <strong>1 September 2022</strong>, tuliskan <kbd>09/01/2022 - 09/02/2022</kbd><br>
             &nbsp;&nbsp;&nbsp;Maka dari itu Sistem akan membaca Data dari tgl 01-09-2022 00:00 sampai tgl 02-09-2022 00:00 WIB</small> --}}
    </div>
    <div class="card-action-element">
      <ul class="list-inline mb-0">
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="card-datatable table-responsive text-nowrap">
    <table id="table" class="dt-column-search table table-striped">
      <thead>
        <tr>
          <th>BookID</th>
          <th>RM</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Checkin</th>
          <th>Kunjungan</th>
          <th>TaskID 1</th>
          <th>TaskID 2</th>
          <th>TaskID 3</th>
          <th>TaskID 4</th>
          <th>TaskID 5</th>
          <th>TaskID 6</th>
          <th>TaskID 7</th>
        </tr>
      </thead>
      <tbody id="tampil-tbody"><tr><td colspan="13"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
      <tfoot>
          <tr>
            <th>BookID</th>
            <th>RM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Checkin</th>
            <th>Kunjungan</th>
            <th>TaskID 1</th>
            <th>TaskID 2</th>
            <th>TaskID 3</th>
            <th>TaskID 4</th>
            <th>TaskID 5</th>
            <th>TaskID 6</th>
            <th>TaskID 7</th>
          </tr>
      </tfoot>
    </table>
  </div>
</div>

{{-- MODAL START --}}
<div class="modal fade" id="maintenance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-5">On Process</h3>
        </div>
        <center><h5>Mohon Maaf, fitur sedang dalam Perbaikan <hr>Akan segera Ada! Stay Tune!</h5></center>
      </div>
    </div>
  </div>
</div>
{{-- MODAL END --}}
  
@endcan

<script>
$(document).ready( function () {
  $("html").addClass('layout-menu-collapsed');

    $.ajax(
      {
          url: "http://192.168.1.3:8000/api/antrol",
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              $("#tampil-tbody").empty();
              // var date = new Date().toISOString().split('T')[0];
              if(res.length == 0){
                  $("#tampil-tbody").append(`<tr><td colspan="7"><center><i class="fas fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
              } else {
                  res.forEach(item => {
                      // var updet = item.updated_at.substring(0, 10);
                      content = "<tr id='data"+ item.DAT_PASIENBOOK +"'><td>"
                              + item.DAT_PASIENBOOK + "</td><td><kbd>" 
                              + item.DAT_PASIEN + "</kbd></td><td>"
                              + item.NAMAPASIEN + "</td><td>" 
                              + item.ALAMAT + "</td><td>" 
                              + item.TGL_CHECKIN + "</td><td>" 
                              + item.TGL_KUNJUNGAN + "</td><td>" 
                              + item.TASKID_01 + "</td><td>" 
                              + item.TASKID_02 + "</td><td>" 
                              + item.TASKID_03 + "</td><td>" 
                              + item.TASKID_04 + "</td><td>" 
                              + item.TASKID_05 + "</td><td>" 
                              + item.TASKID_06 + "</td><td>" 
                              + item.TASKID_07 + "</td></tr>";

                      // content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/v2/lab/antigen/`+item.id+`/print','id','width=900,height=600')"><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/lab/antigen/`+item.id+`/cetak')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                      //           + `</ul></center></td></tr>`;
                      $('#tampil-tbody').append(content);
                  });
              }
              $('#table').DataTable(
                {
                  order: [[10, "desc"]],
                  dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                  displayLength: 10,
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
                          filename: 'Daftar Antigen'
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
              $("div.head-label").html('<h5 class="card-title mb-0">Daftar Pasien</h5>');
          }
      }
    );
    $.ajax(
      {
          url: "http://103.155.246.25:8000/api/antrol",
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
              $("#tampil-tbody").empty();
              // var date = new Date().toISOString().split('T')[0];
              if(res.length == 0){
                  $("#tampil-tbody").append(`<tr><td colspan="7"><center><i class="fas fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
              } else {
                  res.forEach(item => {
                      // var updet = item.updated_at.substring(0, 10);
                      content = "<tr id='data"+ item.DAT_PASIENBOOK +"'><td>"
                              + item.DAT_PASIENBOOK + "</td><td><kbd>" 
                              + item.DAT_PASIEN + "</kbd></td><td>"
                              + item.NAMAPASIEN + "</td><td>" 
                              + item.ALAMAT + "</td><td>" 
                              + item.TGL_CHECKIN + "</td><td>" 
                              + item.TGL_KUNJUNGAN + "</td><td>" 
                              + item.TASKID_01 + "</td><td>" 
                              + item.TASKID_02 + "</td><td>" 
                              + item.TASKID_03 + "</td><td>" 
                              + item.TASKID_04 + "</td><td>" 
                              + item.TASKID_05 + "</td><td>" 
                              + item.TASKID_06 + "</td><td>" 
                              + item.TASKID_07 + "</td></tr>";

                      // content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/v2/lab/antigen/`+item.id+`/print','id','width=900,height=600')"><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/lab/antigen/`+item.id+`/cetak')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                      //             + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                      //           + `</ul></center></td></tr>`;
                      $('#tampil-tbody').append(content);
                  });
              }
              $('#table').DataTable(
                {
                  order: [[10, "desc"]],
                  dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                  displayLength: 10,
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
                          filename: 'Daftar Antigen'
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
              $("div.head-label").html('<h5 class="card-title mb-0">Daftar Pasien</h5>');
          }
      }
    );
});

// FUNCTION
</script>
@endsection