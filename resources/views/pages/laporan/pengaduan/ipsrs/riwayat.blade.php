@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Laporan / Pengaduan / IPSRS /</span> Riwayat
</h4>
  
<button type="button" class="btn btn-label-dark mb-3" onclick="window.location.href='{{ route('ipsrs.index') }}'"><i class="bx bx-chevron-left me-1"></i> Kembali</button>
<div class="card card-action mb-4">
  <div class="card-header">
    <div class="card-action-title">
      <div class="input-group mb-2" style="width: 30%">
        <input type="text" id="filter" name="filter" class="form-control"/>
        <button type="button" class="btn btn-label-primary" onclick="filterRiwayat()">
          <i class="bx bx-filter scaleX-n1-rtl"></i>
          <span class="align-middle">Filter</span>
        </button>
      </div>
      <small><i class="fas fa-chevron-right"></i> Penentuan Tanggal terhitung mulai dari <kbd>Pukul 00:00 - 00:00</kbd><br>
             <i class="fas fa-chevron-right"></i> Contoh Penarikan data Tgl <strong>1 September 2022</strong>, tuliskan <kbd>09/01/2022 - 09/02/2022</kbd><br>
             &nbsp;&nbsp;&nbsp;Maka dari itu Sistem akan membaca Data dari tgl 01-09-2022 00:00 sampai tgl 02-09-2022 00:00 WIB</small>
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
          <th><center>AKSI</center></th>
          <th>NAMA</th>
          <th>UNIT</th>
          <th>LOKASI</th>
          <th>TGL PENGADUAN</th>
          <th>KET PENGADUAN</th>
          <th>TGL DITERIMA</th>
          <th>ESTIMASI PENGERJAAN</th>
          <th>KET DITERIMA</th>
          <th>TGL DIKERJAKAN</th>
          <th>KET DIKERJAKAN</th>
          <th>TGL SELESAI</th>
          <th>KETERANGAN</th>
        </tr>
      </thead>
      <tbody id="tampil-tbody"><tr><td colspan="13"><center>No data available in table</center></td></tr></tbody>
      <tfoot>
          <tr>
            <th><center>AKSI</center></th>
            <th>NAMA</th>
            <th>UNIT</th>
            <th>LOKASI</th>
            <th>TGL PENGADUAN</th>
            <th>KET PENGADUAN</th>
            <th>TGL DITERIMA</th>
            <th>ESTIMASI PENGERJAAN</th>
            <th>KET DITERIMA</th>
            <th>TGL DIKERJAKAN</th>
            <th>KET DIKERJAKAN</th>
            <th>TGL SELESAI</th>
            <th>KETERANGAN</th>
          </tr>
      </tfoot>
    </table>
  </div>
</div>

<script>$(document).ready( function () {
  $("html").addClass('layout-menu-collapsed');
  $("#filter").daterangepicker({
    ranges: {
      Today: [moment(), moment().add(1, 'days')],
      Yesterday: [moment().subtract(1, "days"), moment()],
      "Last 7 Days": [moment().subtract(6, "days"), moment()],
      "Last 30 Days": [moment().subtract(29, "days"), moment()],
      "This Month": [moment().startOf("month"), moment().endOf("month")],
      "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
    },
    opens: isRtl ? "left" : "right"
  });
});

// FUNCTION
function filterRiwayat() {
  var getFilter = $("#filter").val();

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'POST',
    url: '/api/laporan/pengaduan/ipsrs/filter', 
    dataType: 'json', 
    data: { 
      filter: getFilter,
    }, 
    success: function(res) {
      if (res) {
        $("#tampil-tbody").empty();
        $('#table').DataTable().clear().destroy();
        res.forEach(item => {
            content = `<tr id='data"+ item.id +"'><td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                  + `<li><a class='dropdown-item text-warning' href='/v2/laporan/pengaduan/ipsrs/detail/`+item.id+`'><i class='bx bx-edit scaleX-n1-rtl'></i> Lihat</a></li>`
                  + `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="showLampiran(`+item.id+`)"><i class='bx bx-image scaleX-n1-rtl'></i> Lampiran</a></li>`
                  + `</ul></div</center></td><td>`;
            content += item.nama + "</td><td>"
                    + JSON.parse(item.unit) + "</td><td>"
                    + item.lokasi + "</td><td>"
                    + item.tgl_pengaduan + "</td><td>"
                    + item.ket_pengaduan + "</td><td>"
                    + item.tgl_diterima + "</td><td>"
                    + item.estimasi + "</td><td>"
                    + item.ket_diterima + "</td><td>"
                    + item.tgl_dikerjakan + "</td><td>"
                    + item.ket_dikerjakan + "</td><td>"
                    + item.tgl_selesai + "</td><td>";
                      if (item.ket_penolakan != null) {
                        content += item.ket_penolakan;
                      } else {
                        content += item.ket_selesai;
                      }
            content += `</td></tr>`;
            $('#tampil-tbody').append(content);
        });
        $('#table').DataTable(
          {
            order: [[4, "desc"]],
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
                    filename: 'Pengaduan IPSRS'
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
        $("div.head-label").html('<h5 class="card-title mb-0">Hasil Filter Pengaduan IPSRS</h5>');
      }
      iziToast.success({
        title: 'Sukses!',
        message: 'Data Laporan Berhasil Di Filter',
        position: 'topRight'
      });
    }
  });
}
function showLampiran(id) {
  Swal.fire({
    // title: 'Lampiran ID : '+id,
    // text: '',
    imageUrl: '/v2/laporan/pengaduan/ipsrs/'+id,
    // imageWidth: 400,
    imageHeight: 275,
    imageAlt: 'Lampiran',
    reverseButtons: true,
    showDenyButton: false,
    showCloseButton: true,
    showCancelButton: true,
    cancelButtonText: `<i class="fa fa-times"></i> Tutup`,
    confirmButtonText: `<i class="fa fa-download"></i> Download`,
    backdrop: `rgba(26,27,41,0.8)`,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "/v2/laporan/pengaduan/ipsrs/"+id;
    }
  })
}
</script>
@endsection