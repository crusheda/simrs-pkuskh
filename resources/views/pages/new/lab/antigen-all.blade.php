@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>Tabel Antigen Keseluruhan</h4>
      </div>
      <div class="card-body">
        <div class="btn-group">
          <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location.href='{{ route('lab.antigen.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i></button>
          <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
        </div>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#show" data-toggle="tooltip" data-placement="bottom" title="DATA PASIEN HARI INI"><i class="fa-fw fas fa-info nav-icon text-white"></i> Informasi</button>
        <hr>
        <div class="table-responsive">
          <table id="tableku" class="table table-striped">
              <thead>
                  <tr>
                      <th>DOKTER PENGIRIM</th>
                      <th>PEMERIKSA</th>
                      <th>RM</th>
                      <th>PASIEN</th>
                      <th>JK/UMUR</th>
                      <th>ALAMAT</th>
                      <th>TGL</th>
                      <th>HASIL</th>
                      <th><center>AKSI</center></th>
                  </tr>
              </thead>
              <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="show" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title">
              Data Pasien Antigen
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              @if(!empty($list['getpos'][0]->jumlah))
                  <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN POSITIF (BULAN INI) : <kbd style="background-color: red">{{ $list['getpos'][0]->jumlah }} Pasien</kbd></a> <br><br>
              @endif
              @if(!empty($list['getposyear'][0]->jumlah))
                  <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN POSITIF (TAHUN INI) : <kbd style="background-color: RED">{{ $list['getposyear'][0]->jumlah }} Pasien</kbd></a> <br><br>
              @endif
              <hr>
              @if(!empty($list['getneg'][0]->jumlah))
                  <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN NEGATIF (BULAN INI) : <kbd style="background-color: royalblue">{{ $list['getneg'][0]->jumlah }} Pasien</kbd></a> <br><br>
              @endif
              @if(!empty($list['getnegyear'][0]->jumlah))
                  <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN NEGATIF (TAHUN INI) : <kbd style="background-color: royalblue">{{ $list['getnegyear'][0]->jumlah }} Pasien</kbd></a> <br><br>
              @endif
              <hr>
              @if(!empty($list['getmont'][0]->jumlah))
                  <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN BULAN INI : <kbd style="background-color: rgb(23, 106, 4)">{{ $list['getmont'][0]->jumlah }} Pasien</kbd></a> <br><br>
              @endif
              @if(!empty($list['getyear'][0]->jumlah))
                  <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN TAHUN INI : <kbd style="background-color: rgba(134, 19, 87, 0.45)">{{ $list['getyear'][0]->jumlah }} Pasien</kbd></a>
              @endif
          </div>
          <div class="modal-footer">
              <a class="pull-left"><b># Updated {{ \Carbon\Carbon::parse($list['now'])->isoFormat('DD MMMM YYYY') }}</b></a>
          </div>
      </div>
  </div>
</div>

<script>
  $(document).ready( function () {
    $.ajax(
      {
        url: "./all/api",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          $("#tampil-tbody").empty();
          if(res.show.length == 0){
            $("#tampil-tbody").append(`<tr><td colspan="6"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
          } else {
            res.show.forEach(item => {
              $("#tampil-tbody").append(`
                <tr id="data${item.id}">
                  <td>${item.dr_nama}</td>
                  <td>${item.pemeriksa}</td>
                  <td><kbd>${item.rm}</kbd></td>
                  <td>${item.nama}</td>
                  <td>${item.jns_kelamin} / ${item.umur}</td>
                  <td>${item.alamat}</td>
                  <td>${item.tgl}</td>
                  <td>${item.hasil == "POSITIF" ? "<kbd style='background-color: red'>"+item.hasil+"</kbd>" : "<kbd style='background-color: royalblue'>"+item.hasil+"</kbd>"}</td>
                  <td>
                    <center><div class="btn-group" role="group">
                      <button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('././${item.id}/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>
                      <a type="button" class="btn btn-success btn-sm" href="./${item.id}/cetak"><i class="fa-fw fas fa-download nav-icon"></i></a>
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
                order: [[ 6, "desc" ]],
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
  $("#tampil-tbody").empty().append(`<tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
  $.ajax(
    {
      url: "./all/api",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        $('#tableku').DataTable().clear().destroy();
        if(res.show.length == 0){
          $("#tampil-tbody").append(`<tr><td colspan="6"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
        } else {
          res.show.forEach(item => {
            $("#tampil-tbody").append(`
              <tr id="data${item.id}">
                <td>${item.dr_nama}</td>
                <td>${item.pemeriksa}</td>
                <td><kbd>${item.rm}</kbd></td>
                <td>${item.nama}</td>
                <td>${item.jns_kelamin} / ${item.umur}</td>
                <td>${item.alamat}</td>
                <td>${item.tgl}</td>
                <td>${item.hasil == "POSITIF" ? "<kbd style='background-color: red'>"+item.hasil+"</kbd>" : "<kbd style='background-color: royalblue'>"+item.hasil+"</kbd>"}</td>
                <td>
                  <center><div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('././${item.id}/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>
                    <a type="button" class="btn btn-success btn-sm" href="./${item.id}/cetak"><i class="fa-fw fas fa-download nav-icon"></i></a>
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
              order: [[ 6, "desc" ]],
              pageLength: 50
              // "columnDefs": [
              //   { "sortable": false, "targets": [0,2,3] }
              // ],
            }
        ).columns.adjust();
      }
    }
  );
}
</script>
@endsection