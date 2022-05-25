@extends('layouts.newAdmin')

@section('content')
@role('sekretaris-direktur|it')
<div class="row">
  <div class="col-md-6">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title"><b>Statistik</b>
        </div>
        <div class="card-stats-items">
          <div class="card-stats-item">
            <div class="card-stats-item-count">*</div>
            <div class="card-stats-item-label">Pending</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">*</div>
            <div class="card-stats-item-label">Shipping</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">*</div>
            <div class="card-stats-item-label">Completed</div>
          </div>
        </div>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-archive"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengadaan</h4>
        </div>
        <div class="card-body">
          *
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card card-statistic-2">
      <div class="card-chart">
        <canvas id="balance-chart" height="80"></canvas>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengeluaran</h4>
        </div>
        <div class="card-body">
          Rp. -
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4>Table</h4>
              <div class="card-header-action">
                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="HISTORY"><i class="fa-fw fas fa-history nav-icon text-white"></i> History</button>
              </div>
            </div>
            <div class="card-body">
              <div class="btn-group">
                  <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location='{{ route('pengadaan.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i></button>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#rekapAll" title="REKAP KESELURUHAN"><i class="fa-fw fas fa-database nav-icon text-white"></i> Rekap Keseluruhan</button>
                  <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="INFORMASI"><i class="fa-fw fas fa-question nav-icon text-white"></i> Informasi</button>
              </div>
              <hr>
                {{-- <form class="form-inline" action="{{ route('rekap.cari') }}" method="GET"> --}}
                  <div class="form-inline">
                    <span style="width: auto;margin-right:10px">Filter</span>
                    <select class="form-control mb-2 mr-sm-2">
                      <option hidden>Pilih Unit</option>
                      <option>Lorem Ipsum</option>
                      <option>Lorem Ipsum</option>
                      <option>Lorem Ipsum</option>
                      <option>Lorem Ipsum</option>
                      <option>Lorem Ipsum</option>
                    </select>
                    <select class="form-control mb-2 mr-sm-2">
                      <option hidden>Pilih Jenis</option>
                      <option>ATK Cetak</option>
                      <option>Alkes</option>
                      <option>Sarpras Non Alkes</option>
                      <option>Obat dan BHP Medis</option>
                      <option>BHP Non Medis dan Rumah Tangga</option>
                    </select>
                    <select onchange="submitBtn()" class="form-control mb-2 mr-sm-2" name="bulan" id="bulan">
                        <option hidden>Pilih Bulan</option>
                        <option value="01"> Januari</option>
                        <option value="02"> Februari</option>
                        <option value="03"> Maret</option>
                        <option value="04"> April</option>
                        <option value="05"> Mei</option>
                        <option value="06"> Juni</option>
                        <option value="07"> Juli</option>
                        <option value="08"> Agustus</option>
                        <option value="09"> September</option>
                        <option value="10"> Oktober</option>
                        <option value="11"> November</option>
                        <option value="12"> Desember</option>
                    </select>
                    <select onchange="submitBtn()" class="form-control mb-2 mr-sm-2" name="tahun" id="tahun">
                        <option hidden>Pilih Tahun</option>
                        @php
                            for ($i=2022; $i <= \Carbon\Carbon::now()->isoFormat('Y'); $i++) { 
                                echo"<option value=$i> $i </option>";
                            }
                            
                        @endphp
                    </select>
                    {{-- <button class="form-control btn btn-secondary text-white mb-2" id="submit_filter" onclick="cari()" disabled><i class="fa-fw fas fa-filter nav-icon text-white"></i> Submit</button> --}}
                    <button class="form-control btn btn-primary text-white mb-2" onclick="rekapPending()"><i class="fa-fw fas fa-filter nav-icon text-white"></i> Submit</button>
                  </div>
                {{-- </form> --}}
                <br>
                <div id="tampil-rekap"></div>
              </div>
            <div class="card-footer text-right">
            </div>
        </div>
    </div>
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endrole

<div class="modal fade bd-example-modal-lg" id="rekapAll" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">
      Rekap Keseluruhan
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <form action="{{ route('rekapAll.index') }}" method="GET">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group" style="width: 100%">
              <select onchange="submitBtnAll()" class="form-control mb-2 mr-sm-2" name="bulan" id="bulan_all">
                  <option hidden>Pilih Bulan</option>
                  <option value="01"> Januari</option>
                  <option value="02"> Februari</option>
                  <option value="03"> Maret</option>
                  <option value="04"> April</option>
                  <option value="05"> Mei</option>
                  <option value="06"> Juni</option>
                  <option value="07"> Juli</option>
                  <option value="08"> Agustus</option>
                  <option value="09"> September</option>
                  <option value="10"> Oktober</option>
                  <option value="11"> November</option>
                  <option value="12"> Desember</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group" style="width: 100%">
              <select onchange="submitBtnAll()" class="form-control" name="tahun" id="tahun_all">
                  <option hidden>Pilih Tahun</option>
                  @php
                      for ($i=2022; $i <= \Carbon\Carbon::now()->isoFormat('Y'); $i++) { 
                          echo"<option value=$i> $i </option>";
                      }
                  @endphp
              </select>
            </div>
          </div>
        </div>

    </div>
    <div class="modal-footer">

        <button class="btn btn-secondary text-white" id="submit_filterAll" disabled><i class="fa-fw fas fa-filter nav-icon text-white"></i> Submit</button>
      </form>
      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
    </div>
  </div>
  </div>
</div>

<script src="{{ asset('assets/modules/chart.min.js') }}"></script>
<script>
$(document).ready( function () {
    // CHART
    var balance_chart = document.getElementById("balance-chart").getContext('2d');
    
    var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
    balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
    balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
    
    var myChart = new Chart(balance_chart, {
        type: 'line',
        data: {
        labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
        datasets: [{
            label: 'Balance',
            data: [50, 61, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50, 62],
            backgroundColor: balance_chart_bg_color,
            borderWidth: 3,
            borderColor: 'rgba(63,82,227,1)',
            pointBorderWidth: 0,
            pointBorderColor: 'transparent',
            pointRadius: 3,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'rgba(63,82,227,1)',
        }]
        },
        options: {
        layout: {
            padding: {
            bottom: -1,
            left: -1
            }
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
            gridLines: {
                display: false,
                drawBorder: false,
            },
            ticks: {
                beginAtZero: true,
                display: false
            }
            }],
            xAxes: [{
            gridLines: {
                drawBorder: false,
                display: false,
            },
            ticks: {
                display: false
            }
            }]
        },
        }
    });

    //  AJX

} );

// FUNCTION-FUNCTION
    function submitBtn() {
        // var unit = $("#unit_cari").val();
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();

        if ( bulan != 'Pilih Bulan' && tahun != 'Pilih Tahun' ) {
            $('#submit_filter').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
        }
    }

    function submitBtnAll() {
        // var unit = $("#unit_cari").val();
        var bulan = $("#bulan_all").val();
        var tahun = $("#tahun_all").val();

        if ( bulan != 'Pilih Bulan' && tahun != 'Pilih Tahun' ) {
            $('#submit_filterAll').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
        }
    }

    function cari() {
      var bulan = $("#bulan").val();
      var tahun = $("#tahun").val();
      $("#tampil-rekap").empty();
      $("#tampil-rekap").append(
        `<table id="table" class="table table-bordered display" style="font-size: 13px;width: 100%;overflow-x : auto;">
          <thead id="tampil-thead">
            <tr>
              <th>IDB</th>
              <th>BARANG</th>
              <th>HARGA</th>
              <th>SATUAN</th>
              <th>MEMPROSES UNIT <i class="fa fa-spinner fa-pulse fa-fw"></i></th>
            </tr>
          </thead>
          <tbody id="tampil-tbody"><tr><td colspan="5"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
        </table>`
      );
      $.ajax(
        {
          url: "./rekap/api/data/bulan/"+bulan+"/tahun/"+tahun,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            $("#tampil-thead").empty();
            $("#tampil-tbody").empty();
            if(res.show.length == 0){
              $("#tampil-tbody").append(`<tr><td colspan="5"><center>No Data Available In Table</center></td></tr>`);
            } else {
              // TABLE HEAD
              contenthead = '<tr>'
                      + '<th rowspan="2">IDB</th>'
                      + '<th rowspan="2">BARANG</th>'
                      + '<th rowspan="2">HARGA</th>'
                      + '<th rowspan="2">SATUAN</th>';
                      res.unit.forEach(key => {
                        contenthead += '<th colspan="2">' + JSON.parse(key.unit) + '</th>';
                      });
              contenthead += "</tr><tr>";
              res.unit.forEach(key => {
                contenthead += "<th>JML</th><th>NOM</th>";
              });
              contenthead += "</tr>";
              $('#tampil-thead').append(contenthead);
              // TABLE BODY
              contentbody = "";
              res.barang.forEach(item => {
                contentbody += "<tr><td>"
                      + item.id_barang + "</td><td>" 
                      + item.nama_barang + "</td><td>" 
                      + item.harga_barang + "</td><td>"
                      + item.satuan_barang + "</td>";
                // contentbody += addField(item.id_barang);
                // $.ajax(
                //   {
                //     url: "./rekap/api/data/barang/addfield/"+item.id_barang,
                //     type: 'GET',
                //     dataType: 'json', // added data type
                //     success: function(lan) {
                //       if(lan.length == 0){
                //         // $("#tampil-tbody").append(`<tr><td colspan="5"><center>No Data Available In Table</center></td></tr>`);
                //       } else {
                //         lan.forEach(lol => {
                //           contentbody += "<td>" + lol.jumlah + "</td><td>" + lol.total + "</td>";
                //           console.log(lol.jumlah);
                //         });
                //       }
                //     }
                //   }
                // );
                      res.unit.forEach(key => {
                        res.show.forEach(val => {
                          if (val.unit == key.unit) {
                          // if (item.id_barang == val.id_barang) {
                            // if (key.unit == val.unit) {
                            if (item.id_barang == val.id_barang) {
                              contentbody += "<td>" + val.jumlah + "</td><td>" + val.total + "</td>";
                            }
                            // else {
                            //   contentbody += '<td></td>';
                            // }
                          }
                        });
                      });
                contentbody += "</tr>";
              });
              $('#tampil-tbody').append(contentbody);
              // $('#table').DataTable(
              //   {
              //     paging: true,
              //     searching: true,
              //     scrollX: true,
              //     dom: 'Bfrtip',
              //     buttons: [
              //       {
              //         extend: 'copyHtml5',
              //         className: 'btn-info',
              //         text: 'Salin Baris',
              //         download: 'open',
              //       },
              //       {
              //         extend: 'excelHtml5',
              //         className: 'btn-success',
              //         text: 'Export Excell',
              //         download: 'open',
              //       },
              //       {
              //         extend: 'pdfHtml5',
              //         className: 'btn-warning',
              //         text: 'Cetak PDF',
              //         download: 'open',
              //       },
              //       {
              //         extend: 'colvis',
              //         className: 'btn-dark',
              //         text: 'Sembunyikan Kolom',
              //         exportOptions: {
              //             columns: ':visible'
              //         }
              //       }
              //     ],
              //     order: [[ 1, "asc" ]],
              //     pageLength: 20
              //   }
              // ).columns.adjust();
            }
          }
        }
      );
    }

    function addField(id_barang) {
      $.ajax(
        {
          url: "./rekap/api/data/barang/addfield/"+id_barang,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            if(res.length == 0){
              // $("#tampil-tbody").append(`<tr><td colspan="5"><center>No Data Available In Table</center></td></tr>`);
            } else {
              res.forEach(val => {
                contentbody += "<td>" + val.jumlah + "</td><td>" + val.total + "</td>";
                // if (val.unit == val.unit) {
                //   contentbody += "<td>" + val.jumlah + "</td><td>" + val.total + "</td>";
                // }
                // else {
                //   contentbody += '<td colspan="2"></td>';
                // }
                // res.unit.forEach(key => {
                //   if (item.id_barang == val.id_barang) {
                //   }
                // });
              });
            }
          }
        }
      );
      console.log(id_barang);
    }

    function rekapPending() {
      iziToast.warning({
          title: 'Pesan Galat!',
          message: 'Kami masih dalam perbaikan fitur. Anda dapat memilih Rekap Keseluruhan.',
          position: 'topRight'
      });
    }
</script>
@endsection

{{-- <table class="table table-bordered display" style="font-size: 13px;width: 100%;/* word-break: break-word; */">
  <thead>
    <tr>
      <th style="width:5%">ID</th>
      <th style="width:20%">BARANG</th>
      <th style="width:5%">JML</th>
      <th style="width:15%">HARGA</th>
      <th style="width:10%">SATUAN</th>
      <th style="width:20%">KET</th>
      <th style="width:20%">TOTAL</th>
    </tr>
  </thead>
  <tbody id="tampil-tbody-detail"><tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
  <tfoot id="tampil-tfoot-detail"></tfoot>
</table> --}}
