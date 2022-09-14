@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Lab / Antigen /</span> Filter 
</h4>
  
@can('antigen')

<button type="button" class="btn btn-label-dark mb-3" onclick="window.location.href='{{ route('antigen.index') }}'"><i class="bx bx-chevron-left me-1"></i> Kembali</button>
<div class="card card-action mb-4">
  <div class="card-header">
    <div class="card-action-title">
      <div class="input-group" style="width: 30%">
        <input type="text" id="filter" name="filter" class="form-control"/>
        <button type="button" class="btn btn-label-primary" onclick="filterAntigen()">
          <i class="bx bx-filter scaleX-n1-rtl"></i>
          <span class="align-middle">Filter</span>
        </button>
      </div>
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
          <th>RM</th>
          <th>DOKTER PENGIRIM</th>
          <th>PEMERIKSA</th>
          <th>PASIEN</th>
          <th>JK/UMUR</th>
          <th>ALAMAT</th>
          <th>HASIL</th>
          <th>TGL</th>
          <th><center>AKSI</center></th>
        </tr>
      </thead>
      <tbody id="tampil-tbody"><tr><td colspan="9"><center>No data available in table</center></td></tr></tbody>
      <tfoot>
          <tr>
              <th>RM</th>
              <th>DOKTER PENGIRIM</th>
              <th>PEMERIKSA</th>
              <th>PASIEN</th>
              <th>JK/UMUR</th>
              <th>ALAMAT</th>
              <th>HASIL</th>
              <th>TGL</th>
              <th><center>AKSI</center></th>
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

<script>$(document).ready( function () {
  $("html").addClass('layout-menu-collapsed');
  $("#filter").daterangepicker({
    ranges: {
      Today: [moment(), moment()],
      Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Last 7 Days": [moment().subtract(6, "days"), moment()],
      "Last 30 Days": [moment().subtract(29, "days"), moment()],
      "This Month": [moment().startOf("month"), moment().endOf("month")],
      "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
    },
    opens: isRtl ? "left" : "right"
  });
});

// FUNCTION
function filterAntigen() {
  var getFilter = $("#filter").val();

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'POST',
    url: '/api/antigen/filter', 
    dataType: 'json', 
    data: { 
      filter: getFilter,
    }, 
    success: function(res) {
      if (res) {
        $("#tampil-tbody").empty();
        $('#table').DataTable().clear().destroy();
        // if(res.length == 0){
        //   $("#tampil-tbody").append(`<tr><td colspan="7"><center>Data Tidak Ditemukan...</center></td></tr>`);
        // } else {
          res.forEach(item => {
              // var updet = item.updated_at.substring(0, 10);
              content = "<tr id='data"+ item.id +"'><td>"
                      + item.rm + "</td><td>" 
                      + item.dr_nama + "</td><td>" 
                      + item.pemeriksa + "</td><td>" 
                      + item.nama + "</td><td>"
                      + item.jns_kelamin + " / " + item.umur + "</td><td>"
                      + item.alamat + "</td>";
                      if (item.hasil == "POSITIF")
                        content += "<td><kbd style='background-color: red'>POSITIF</kbd></td><td>";
                      else
                        content += "<td><kbd style='background-color: royalblue'>NEGATIF</kbd></td><td>";
              content += item.tgl + "</td>";

              content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                  + `<li><a href='javascript:void(0);' class='dropdown-item text-info' target="popup" onclick="window.open('/v2/lab/antigen/`+item.id+`/print','id','width=900,height=600')"><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>`
                  + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/lab/antigen/`+item.id+`/cetak')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                + `</ul></center></td></tr>`;
              $('#tampil-tbody').append(content);
          });
        // }
        $('#table').DataTable(
          {
            order: [[7, "desc"]],
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
                    filename: 'Daftar Filter Antigen'
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
        $("div.head-label").html('<h5 class="card-title mb-0">Hasil Filter Antigen</h5>');
      }
      iziToast.success({
        title: 'Sukses!',
        message: 'Data Antigen Berhasil Di Filter',
        position: 'topRight'
      });
    }
  });
}
// function refresh() {
//   $("#tampil-tbody").empty().append(`<tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
//   $.ajax(
//     {
//       url: "/api/antigen/get",
//       type: 'GET',
//       dataType: 'json', // added data type
//       success: function(res) {
//         $("#tampil-tbody").empty();
//         $('#table').DataTable().clear().destroy();
//         if(res.show.length == 0){
//             $("#tampil-tbody").append(`<tr><td colspan="7"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
//         } else {
//             res.show.forEach(item => {
//                 // var updet = item.updated_at.substring(0, 10);
//                 content = "<tr id='data"+ item.id +"'><td>"; 
//                             if (item.hasil == "POSITIF")
//                                 content += "<kbd style='background-color: red'>P</kbd>&nbsp;";
//                             else
//                                 content += "<kbd style='background-color: royalblue'>N</kbd>&nbsp;";
//                 content += item.rm + "</td><td>" 
//                         + item.dr_nama + "</td><td>" 
//                         + item.nama + "</td><td>"
//                         + item.jns_kelamin + " / " + item.umur + "</td><td>"
//                         + item.alamat + "</td><td>"
//                         + item.tgl + "</td>";

//                 content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
//                     + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
//                     + `<li><a href='javascript:void(0);' class='dropdown-item text-info' target="popup" onclick="window.open('/v2/lab/antigen/`+item.id+`/print','id','width=900,height=600')"><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>`
//                     + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/lab/antigen/`+item.id+`/cetak')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
//                     + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
//                   + `</ul></center></td></tr>`;
//                 $('#tampil-tbody').append(content);
//             });
//         }
//         $('#table').DataTable(
//           {
//             order: [[5, "desc"]],
//             dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
//             displayLength: 7,
//             lengthMenu: [7, 10, 25, 50, 75, 100],
//             buttons: [{
//                 extend: "collection",
//                 className: "btn btn-label-primary dropdown-toggle me-2",
//                 text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
//                 buttons: [{
//                     extend: "print",
//                     text: '<i class="bx bx-printer me-2" ></i>Print',
//                     className: "dropdown-item",
//                     // exportOptions: {
//                     //     columns: [3, 4, 5, 6, 7]
//                     // }
//                 }, {
//                     extend: "excel",
//                     text: '<i class="bx bxs-spreadsheet me-2"></i>Excel',
//                     className: "dropdown-item",
//                     autoFilter: true,
//                     attr: {id: 'exportButton'},
//                     sheetName: 'data',
//                     title: '',
//                     filename: 'Daftar Risiko K3'
//                 }, {
//                     extend: "pdf",
//                     text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
//                     className: "dropdown-item",
//                 }, {
//                     extend: "copy",
//                     text: '<i class="bx bx-copy me-2" ></i>Copy',
//                     className: "dropdown-item",
//                     // exportOptions: {
//                     //     columns: [3, 4, 5, 6, 7]
//                     // }
//                 },]
//               }, 
//               {
//                 extend: 'colvis',
//                 text: '<i class="bx bx-hide me-sm-2"></i> <span class="d-none d-sm-inline-block">Column</span>',
//                 className: "btn btn-label-primary modal me-2",
//                 // collectionLayout: 'dropdown-menu',
//                 // contentClassName: 'dropdown-item'
//               }
//             ],
//             'columnDefs': [
//                 // { targets: 3, visible: false },
//                 // { targets: 5, visible: false },
//                 // { targets: 6, visible: false },
//                 // { targets: 9, visible: false },
//                 // { targets: 10, visible: false },
//                 // { targets: 11, visible: false },
//                 // { targets: 12, visible: false },
//                 // { targets: 16, visible: false },
//             ],
//           },
//         );
//         $("div.head-label").html('<h5 class="card-title mb-0">Daftar Antigen</h5>');
//       }
//     }
//   );
// }
</script>
@endsection