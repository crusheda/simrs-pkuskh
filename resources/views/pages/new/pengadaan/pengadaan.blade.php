@extends('layouts.newAdmin')

@section('content')
{{-- <div class="row">
  <div class="col-md-6">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title">Statistik
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
</div> --}}

<div class="card">
  <div class="card-header">
    <h4>Tabel</h4>
    <div class="card-header-action">
      @role('sekretaris-direktur|it')
      <div class="btn-group">
        <button type="button" class="btn btn-info disabled" data-toggle="tooltip" data-placement="bottom" title="TAMPILKAN SEMUA PENGADAAN"><i class="fa-fw fas fa-history nav-icon"></i> Riwayat Pengadaan</button>
        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="TAMBAH DATA BARANG" onclick="window.location='{{ route('barang.index') }}'"><i class="fa-fw fas fa-shopping-bag nav-icon"></i> Data Barang</button>
      </div>
      @endrole
    </div>
  </div>
  <div class="card-body">
		<div class="btn-group">
			<button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" data-placement="bottom" title="BUAT PENGUSULAN PENGADAAN">
        <i class="fa-fw fas fa-plus-square nav-icon"></i>	Tambah Pengadaan
			</button>
			<button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
      @role('sekretaris-direktur|it')
        <button type="button" class="btn btn-success disabled" data-toggle="tooltip" data-placement="bottom" title="REKAP HASIL PENGADAAN"><i class="fa-fw fas fa-business-time nav-icon"></i></button>
        <button type="button" class="btn btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="TAMPILKAN PENGADAAN TERHAPUS"><i class="fa-fw fas fa-eraser nav-icon"></i></button>
      @endrole
		</div>
    <br><sub>Data yang ditampilkan adalah pengadaan 2 bulan terakhir</sub>
    {{-- <br><sub>Data yang ditampilkan hanya berjumlah 30 data terbaru saja, Klik <a href="#" onclick="window.location.href='{{ url('pengadaan') }}'"><strong><u>Disini</u></strong></a> untuk melihat data seluruhnya.</sub> --}}
		<hr>
    <div class="table-responsive">
      <table id="table" class="table table-hover display" style="width: 100%;word-break: break-word;">
        <thead>
          <tr>
            <th>IDP</th>
            <th>NAMA</th>
            <th>UNIT</th>
            <th>TOTAL</th>
            <th>TGL</th>
            <th><center>#</center></th>
          </tr>
        </thead>
        <tbody id="tampil-tbody"><tr><td colspan="6"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">
        Tambah Pengadaan
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form-auth-small" action="{{ route('pengadaan.create') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Pilih Jenis Pengadaan</label>
            <select name="ref_barang" class="form-control selectric">
              <option value="2"><b>ATK Cetak</b></option>
                {{-- @foreach($list['ref'] as $key)
                  <option value="{{ $key->id }}"><b>{{ $key->nama }}</b></option>
                @endforeach --}}
            </select>
            <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan Anda mempunyai <b>Hak</b> untuk melakukan pengusulan pengadaan</sub>
          </div>
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
        </form>

        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="detail" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">
      Detail Pengadaan
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <label>Pemohon :</label><br>
          <h5 id="detail_nama" style="margin-bottom:-3px"></h5>
          <sub id="detail_unit"></sub>
        </div>
        <div class="col-md-6 text-right">
          <kbd>ID SYS : <a id="show_id"></a></kbd>&nbsp;<kbd id="detail_jenis"></kbd><br>
          Ditambahkan pada :<br><a id="detail_tgl"></a>
        </div>
        <div class="col-md-12">
          <hr>
          <div class="table-responsive">
            <table class="table table-bordered display" style="font-size: 13px;width: 100%;/* word-break: break-word; */">
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
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
    </div>
  </div>
  </div>
</div>

<script src="{{ asset('assets/modules/chart.min.js') }}"></script>
<script>
  $(document).ready( function () {
    $.ajax(
      {
        url: "./pengadaan/api/data",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          $("#tampil-tbody").empty();
          var date = new Date().toISOString().split('T')[0];
          var userID = "{{ Auth::user()->id }}";
          var adminID = "{{ Auth::user()->hasRole('it') }}";
          // $('#table').DataTable().clear().destroy();
          // var date = new Date().toISOString().split('T')[0];
          if(res.show.length == 0){
            $("#tampil-tbody").append(`<tr><td colspan="6"><center>No Data Available In Table</center></td></tr>`);
          } else {
            // console.log(res.show);
            res.show.forEach(item => {
              content = "<tr id='data"+ item.id +"'><td>" 
                        + item.id_pengadaan + "</td><td>" 
                        + item.nama + "</td><td>" 
                        + JSON.parse(item.unit) + "</td><td>" 
                        + item.total + "</td><td>" 
                        + item.tgl_pengadaan + "</td>";
              content += "<td><center><div class='btn-group' role='group'>";
              if (adminID) {
                content += `<button type="button" class="btn btn-info btn-sm" onclick="detail(`+item.id_pengadaan+`)" data-toggle="tooltip" data-placement="bottom" title="LIHAT PENGADAAN"><i class="fas fa-sort-amount-down"></i></button>`;
                content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id_pengadaan+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS PENGADAAN"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
              } else {
                if (item.id_user == userID) {
                  if (updet == date) {
                    content += `<button type="button" class="btn btn-info btn-sm" onclick="detail(`+item.id_pengadaan+`)" data-toggle="tooltip" data-placement="bottom" title="LIHAT PENGADAAN"><i class="fas fa-sort-amount-down"></i></button>`;
                    content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id_pengadaan+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS PENGADAAN"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                  } else {
                    content += `<button type="button" class="btn btn-info btn-sm" onclick="detail(`+item.id_pengadaan+`)" data-toggle="tooltip" data-placement="bottom" title="LIHAT PENGADAAN"><i class="fas fa-sort-amount-down"></i></button>`;
                  }
                } else {
                  content += `<button type="button" class="btn btn-info btn-sm disabled" disabled><i class="fas fa-sort-amount-down"></i></button>`;
                  content += `<button type="button" class="btn btn-danger btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                }
              } 

                
              
              content += "</div></center></td></tr>";
              $('#tampil-tbody').append(content);
            });
            $('#table').DataTable(
              {
                paging: true,
                searching: true,
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
                  {
                    extend: 'colvis',
                    className: 'btn-dark',
                    text: 'Sembunyikan Kolom',
                    exportOptions: {
                        columns: ':visible'
                    }
                  }
                ],
                order: [[ 4, "desc" ]],
                pageLength: 10
              }
            ).columns.adjust();
          }
        }
      }
    );

    // var balance_chart = document.getElementById("balance-chart").getContext('2d');
    
    // var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
    // balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
    // balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
    
    // var myChart = new Chart(balance_chart, {
    //   type: 'line',
    //   data: {
    //     labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
    //     datasets: [{
    //       label: 'Balance',
    //       data: [50, 61, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50, 62],
    //       backgroundColor: balance_chart_bg_color,
    //       borderWidth: 3,
    //       borderColor: 'rgba(63,82,227,1)',
    //       pointBorderWidth: 0,
    //       pointBorderColor: 'transparent',
    //       pointRadius: 3,
    //       pointBackgroundColor: 'transparent',
    //       pointHoverBackgroundColor: 'rgba(63,82,227,1)',
    //     }]
    //   },
    //   options: {
    //     layout: {
    //       padding: {
    //         bottom: -1,
    //         left: -1
    //       }
    //     },
    //     legend: {
    //       display: false
    //     },
    //     scales: {
    //       yAxes: [{
    //         gridLines: {
    //           display: false,
    //           drawBorder: false,
    //         },
    //         ticks: {
    //           beginAtZero: true,
    //           display: false
    //         }
    //       }],
    //       xAxes: [{
    //         gridLines: {
    //           drawBorder: false,
    //           display: false,
    //         },
    //         ticks: {
    //           display: false
    //         }
    //       }]
    //     },
    //   }
    // });

  });
</script>

<script>
  function refresh() {
    $("#tampil-tbody").empty().append(`<tr><td colspan="6"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
    $.ajax(
      {
        url: "./pengadaan/api/data",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          $("#tampil-tbody").empty();
          // var date = new Date().toISOString().split('T')[0];
          if(res.show.length == 0){
            $("#tampil-tbody").append(`<tr><td colspan="6"><center>No Data Available In Table</center></td></tr>`);
          } else {
            $('#table').DataTable().clear().destroy();
            // console.log(res.show);
            res.show.forEach(item => {
              content = "<tr id='data"+ item.id +"'><td>" 
                        + item.id_pengadaan + "</td><td>" 
                        + item.nama + "</td><td>" 
                        + JSON.parse(item.unit) + "</td><td>" 
                        + item.total + "</td><td>" 
                        + item.tgl_pengadaan + "</td>";

              content += "<td><center><div class='btn-group' role='group'>";
                // content += `<button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('antigen/`+item.id+`/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>`;
                // content += `<button type="button" class="btn btn-success btn-sm" onclick="window.open('antigen/`+item.id+`/cetak')" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></button>`;
                content += `<button type="button" class="btn btn-info btn-sm" onclick="detail(`+item.id_pengadaan+`)" data-toggle="tooltip" data-placement="bottom" title="LIHAT PENGADAAN"><i class="fas fa-sort-amount-down"></i></button>`;
                content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id_pengadaan+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS PENGADAAN"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
              content += "</div></center></td></tr>";
              $('#tampil-tbody').append(content);
            });
            $('#table').DataTable(
              {
                paging: true,
                searching: true,
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
                  {
                    extend: 'colvis',
                    className: 'btn-dark',
                    text: 'Sembunyikan Kolom',
                    exportOptions: {
                        columns: ':visible'
                    }
                  }
                ],
                order: [[ 4, "desc" ]],
                pageLength: 10
              }
            ).columns.adjust();
          }
        }
      }
    );
  }

  function detail(id) {
    $('#detail').modal('show');
    $.ajax(
      {
        url: "./pengadaan/api/data/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          
          // $("#show_id").empty();
          // $("#detail_nama").empty();
          // $("#detail_unit").empty();
          // $("#detail_jenis").empty();
          // $("#detail_tgl").empty();
          
          $("#show_id").text(res.detail.id);
          $("#detail_nama").text(res.detail.nama);
          $("#detail_unit").text(JSON.parse(res.detail.unit));
          $("#detail_jenis").text(res.show[0].jenis);
          $("#detail_tgl").text(res.detail.tgl_pengadaan);

          $("#tampil-tbody-detail").empty();
          $("#tampil-tfoot-detail").empty();
          res.show.forEach(item => {
            content = "<tr id='data"+ item.id +"'><td>" 
                      + item.id + "</td><td>" 
                      + item.nama + "</td><td>"  
                      + item.jumlah + "</td><td>"  
                      + "Rp. " + item.harga.toLocaleString().replace(/[,]/g,'.') + "</td><td>"  
                      + item.satuan + "</td><td>"  
                      + item.ket + "</td><td>" 
                      + "Rp. " + item.total.toLocaleString().replace(/[,]/g,'.') + "</td></tr>";
            $('#tampil-tbody-detail').append(content);
          });
          $("#tampil-tfoot-detail").append(
            `<tr><th colspan="6">TOTAL KESELURUHAN</th><th>Rp. `+ res.detail.total.toLocaleString().replace(/[,]/g,'.') +`</th></tr>`
          );
        }
      }
    );
  }

  function hapus(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Ingin menghapus Pengadaan ID : '+id,
      icon: 'warning',
      reverseButtons: false,
      showDenyButton: false,
      showCloseButton: false,
      showCancelButton: true,
      focusCancel: true,
      confirmButtonColor: '#FF4845',
      confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
      cancelButtonText: `<i class="fa fa-times"></i> Batal`,
      backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "./pengadaan/api/data/hapus/"+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            Swal.fire({
              title: `Pengadaan berhasil dihapus!`,
              text: 'Pada '+res,
              icon: `success`,
              showConfirmButton:false,
              showCancelButton:false,
              allowOutsideClick: true,
              allowEscapeKey: false,
              timer: 3000,
              timerProgressBar: true,
              backdrop: `rgba(26,27,41,0.8)`,
            });
            refresh();
          },
          error: function(res) {
            Swal.fire({
              title: `Pengadaan gagal di hapus!`,
              text: 'Pada '+res,
              icon: `error`,
              showConfirmButton:false,
              showCancelButton:false,
              allowOutsideClick: true,
              allowEscapeKey: true,
              timer: 3000,
              timerProgressBar: true,
              backdrop: `rgba(26,27,41,0.8)`,
            });
          }
        }); 
      }
    })
  }
</script>
@endsection
