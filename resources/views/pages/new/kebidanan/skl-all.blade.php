@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>Tabel SKL Keseluruhan</h4>
      </div>
      <div class="card-body">
        <div class="btn-group">
          <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location.href='{{ route('skl.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i></button>
          <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="tableku" class="table table-striped">
              <thead>
                  <tr>
                    <th>NO</th>
                    <th>TGL</th>
                    <th>IBU</th>
                    <th>AYAH</th>
                    <th>ANAK</th>
                    <th>ALAMAT</th>
                    <th>BB / TB</th>
                    <th><center>#</center></th>
                  </tr>
              </thead>
              <tbody id="tampil-tbody"><tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function () {
    $.ajax(
      {
        url: "/api/kebidanan/skl/all",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          $("#tampil-tbody").empty();
          if(res.show.length == 0){
            $("#tampil-tbody").append(`<tr><td colspan="8"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
          } else {
            res.show.forEach(item => {
              $("#tampil-tbody").append(`
                <tr id="data${item.id}">
                  <td><kbd>${item.no_surat}</kbd></td>
                  <td>${item.tgl}</td>
                  <td>${item.ibu}</td>
                  <td>${item.ayah}</td>
                  <td style="text-transform: uppercase">${item.anak} (${item.kelamin})</td>
                  <td>${item.alamat}</td>
                  <td>${item.bb} / ${item.tb}</td>
                  <td>
                    <center><div class="btn-group" role="group">
                      <button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('./${item.id}/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>
                      <a type="button" class="btn btn-success btn-sm" href="./${item.id}/cetak" data-toggle="tooltip" data-placement="left" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></a>
                    </center></div>
                  </td>
                </tr>
              `);
            });
          }
          $('#tableku').DataTable(
              {
                dom: 'Bfrtip',
                buttons: [
                  {
                    extend: 'copyHtml5',
                    className: 'btn-info',
                    text: 'Salin Baris',
                    download: 'open',
                  },
                  {
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    text: 'Export Excell',
                    download: 'open',
                  },
                  {
                    extend: 'pdfHtml5',
                    className: 'btn-warning',
                    text: 'Cetak PDF',
                    download: 'open',
                  },
                ],
                order: [[ 1, "desc" ]],
                pageLength: 50
                // "columnDefs": [
                //   { "sortable": false, "targets": [0,2,3] }
                // ],
              }
          ).columns.adjust();
        }
      }
    );
  })
  
function refresh() {
  $("#tampil-tbody").empty().append(`<tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
  $.ajax(
    {
      url: "/api/kebidanan/skl/all",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        if(res.show.length == 0){
          $("#tampil-tbody").append(`<tr><td colspan="8"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
        } else {
          res.show.forEach(item => {
            $("#tampil-tbody").append(`
              <tr id="data${item.id}">
                <td><kbd>${item.no_surat}</kbd></td>
                <td>${item.tgl}</td>
                <td>${item.ibu}</td>
                <td>${item.ayah}</td>
                <td style="text-transform: uppercase">${item.anak} (${item.kelamin})</td>
                <td>${item.alamat}</td>
                <td>${item.bb} / ${item.tb}</td>
                <td>
                  <center><div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('./${item.id}/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>
                    <a type="button" class="btn btn-success btn-sm" href="./${item.id}/cetak" data-toggle="tooltip" data-placement="left" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></a>
                  </center></div>
                </td>
              </tr>
            `);
          });
        }
      }
    }
  );
}
</script>
@endsection