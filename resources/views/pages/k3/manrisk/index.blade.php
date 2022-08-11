@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">K3 MFK /</span> Daftar Risiko
</h4>

{{-- <div class="col-12 mb-4">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <div>
        <h5 class="card-title mb-0">Last updates</h5>
        <small class="text-muted">Commercial networks</small>
      </div>
      <div class="dropdown">
        <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-calendar"></i></button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a></li>
          <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a></li>
          <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a></li>
          <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a></li>
          <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a></li>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <div id="lineAreaChart"></div>
    </div>
  </div>
</div> --}}

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
      <a class="btn btn-primary" href="{{ route('manrisk.create') }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Tambah Daftar Risiko</span>">
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
    <div class="card-datatable table-responsive" style="margin-top: -10px;white-space: nowrap;word-break: break-word;">
      <table id="table" class="table border-top">
        <thead>
          <tr>
            <th>ID</th>
            <th>Unit</th>
            <th>Ruang Lingkup</th>
            <th>Proses Utama</th>
            <th>Item Kegiatan</th>
            <th>Jenis Aktivitas</th>
            <th>Kode Bahaya</th>
            <th>Sumber Bahaya</th>
            <th>Risiko</th>
            <th>Pengendalian yang telah Diterapkan</th>
            <th>Dampak</th>
            <th>Kemungkinan / Frekuensi</th>
            <th>Nilai</th>
            <th>Tingkat Risiko</th>
            <th>Evaluasi Pengendalian</th>
            {{-- <th>ELM</th>
            <th>SBT</th>
            <th>ENG</th>
            <th>ADM</th>
            <th>APD</th> --}}
            <th>Deskripsi Pengendalian Tambahan</th>
            <th>Waktu Penerapan</th>
            <th>Update</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody id="tampil-tbody"><tr><td colspan="23"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
      </table>
    </div>
  </div>
</div>

<script>
$(document).ready( function () {
  // let e, o, s, r;
  // r = isDarkStyle ? (e = config.colors_dark.cardColor,
  // o = config.colors_dark.headingColor,
  // s = config.colors_dark.axisColor,
  // config.colors_dark.borderColor) : (e = config.colors.white,
  // o = config.colors.headingColor,
  // s = config.colors.axisColor,
  // config.colors.borderColor);
  // const a = {
  //     series1: "#826af9",
  //     series2: "#d2b0ff",
  //     bg: "#f8d3ff"
  // }
  //   , t = {
  //     series1: "#fee802",
  //     series2: "#3fd0bd",
  //     series3: "#826bf8",
  //     series4: "#2b9bf4"
  // }
  //   , i = {
  //     series1: "#29dac7",
  //     series2: "#60f2ca",
  //     series3: "#a5f8cd"
  // };
  // function l(e, o) {
  //     let s = 0
  //       , r = [];
  //     for (; s < e; ) {
  //         var a = "w" + (s + 1).toString()
  //           , t = Math.floor(Math.random() * (o.max - o.min + 1)) + o.min;
  //         r.push({
  //             x: a,
  //             y: t
  //         }),
  //         s++
  //     }
  //     return r
  // }
  // var n = document.querySelector("#lineAreaChart")
  // , c = {
  //   chart: {
  //       height: 400,
  //       type: "area",
  //       parentHeightOffset: 0,
  //       toolbar: {
  //           show: !1
  //       }
  //   },
  //   dataLabels: {
  //       enabled: !1
  //   },
  //   stroke: {
  //       show: !1,
  //       curve: "straight"
  //   },
  //   legend: {
  //       show: !0,
  //       position: "top",
  //       horizontalAlign: "start",
  //       labels: {
  //           colors: "#aab3bf",
  //           useSeriesColors: !1
  //       }
  //   },
  //   grid: {
  //       borderColor: r,
  //       xaxis: {
  //           lines: {
  //               show: !0
  //           }
  //       }
  //   },
  //   colors: [i.series3, i.series2, i.series1],
  //   series: [{
  //       name: "Low",
  //       data: [100]
  //   }, {
  //       name: "Medium",
  //       data: [60]
  //   }, {
  //       name: "High",
  //       data: [20]
  //   }],
  //   xaxis: {
  //       categories: ["Status"],
  //       axisBorder: {
  //           show: !1
  //       },
  //       axisTicks: {
  //           show: !1
  //       },
  //       labels: {
  //           style: {
  //               colors: s,
  //               fontSize: "13px"
  //           }
  //       }
  //   },
  //   yaxis: {
  //       labels: {
  //           style: {
  //               colors: s,
  //               fontSize: "13px"
  //           }
  //       }
  //   },
  //   fill: {
  //       opacity: 1,
  //       type: "solid"
  //   },
  //   tooltip: {
  //       shared: !1
  //   }
  // };

  // if (null !== n) {
  //     const d = new ApexCharts(n,c);
  //     d.render()
  // }


  $.ajax(
    {
      url: "./manrisk/api/data",
      type: 'GET',
      async: true,
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        var date = new Date().toISOString().split('T')[0];
        var userID = "{{ Auth::user()->id }}";
        var adminID = "{{ Auth::user()->hasRole('it|k3') }}";
        var date = new Date().toISOString().split('T')[0];
        if(res.show.length == 0){
          $("#tampil-tbody").append(`<tr><td colspan="23"><center>Tidak Ada Data</center></td></tr>`);
        } else {
          res.show.forEach(item => {
            var updet = item.updated_at.substring(0, 10);
            content = "<tr id='data"+ item.id +"'><td><kbd>" 
                        + item.id + "</kbd></td><td>" 
                        + JSON.parse(item.unit) + "</td><td>"; 
                        // Ruang Linkup
                          if (item.jenis_risiko == 1) {
                            content += "Staf";
                          }
                          if (item.jenis_risiko == 2) {
                            content += "Pasien";
                          }
                          if (item.jenis_risiko == 3) {
                            content += "Fasilitas Rumah Sakit";
                          }
                          if (item.jenis_risiko == 4) {
                            content += "Lingkungan Rumah Sakit";
                          }
                          if (item.jenis_risiko == 5) {
                            content += "Bisnis Rumah Sakit";
                          }
                        content += "</td><td>";
                        // Proses Utama
                          if (item.proses_utama == 1) {
                            content += "Keselamatan";
                          }
                          if (item.proses_utama == 2) {
                            content += "Keamanan";
                          }
                          if (item.proses_utama == 3) {
                            content += "Pelayanan Kesehatan Kerja";
                          }
                          if (item.proses_utama == 4) {
                            content += "Pengelolaan B3";
                          }
                          if (item.proses_utama == 5) {
                            content += "Pengendalian Kebakaran";
                          }
                          if (item.proses_utama == 6) {
                            content += "Utilitas";
                          }
                          if (item.proses_utama == 7) {
                            content += "Prasarana Medis";
                          }
                          if (item.proses_utama == 8) {
                            content += "Kebencanaan";
                          }
                        content += "</td><td>"
                        + item.item_kegiatan + "</td><td>";
                        // Jenis Aktivitas
                          if (item.jenis_aktivitas == 1) {
                            content += "Rutin";
                          }
                          if (item.jenis_aktivitas == 2) {
                            content += "Non Rutin";
                          }
                        content += "</td><td>";
                        // Kode Bahaya
                          if (item.kode_bahaya == 1) {
                            content += "Cedera";
                          }
                          if (item.kode_bahaya == 2) {
                            content += "Gangguan Kesehatan";
                          }
                        content += "</td><td>"
                        + item.sumber_bahaya + "</td><td>"
                        + item.risiko + "</td><td>"
                        + item.pengendalian + "</td><td>";
                        // Dampak
                          if (item.dampak == 1) {
                            content += "Sangat Rendah";
                          }
                          if (item.dampak == 2) {
                            content += "Rendah";
                          }
                          if (item.dampak == 3) {
                            content += "Sedang";
                          }
                          if (item.dampak == 4) {
                            content += "Tinggi";
                          }
                          if (item.dampak == 5) {
                            content += "Sangat Tinggi";
                          }
                        content += "</td><td>";
                        // Frekuensi
                          if (item.frekuensi == 1) {
                            content += "Sangat Jarang";
                          }
                          if (item.frekuensi == 2) {
                            content += "Jarang";
                          }
                          if (item.frekuensi == 3) {
                            content += "Mungkin";
                          }
                          if (item.frekuensi == 4) {
                            content += "Sering";
                          }
                          if (item.frekuensi == 5) {
                            content += "Sangat Sering";
                          }
                        content += "</td><td>"
                        + item.nilai + "</td><td>"
                        + item.tingkat_risiko + "</td><td>";
                        if(item.elm == 1){
                          content += "<div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' checked disabled/> ELM</div>"
                        };
                        if(item.sbt == 1){
                          content += "<div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' checked disabled/> SBT</div>"
                        };
                        if(item.eng == 1){
                          content += "<div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' checked disabled/> ENG</div>"
                        };
                        if(item.adm == 1){
                          content += "<div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' checked disabled/> ADM</div>"
                        };
                        if(item.apd == 1){
                          content += "<div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' checked disabled/> APD</div>"
                        };
                        content += "</td><td>"
                        + item.deskripsi + "</td><td>"
                        + item.waktu_penerapan + "</td><td>"
                        + item.updated_at + "</td><td>";

            content += "<center><div class='btn-group'>"
              + "<button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button>";
              if (adminID) {
                content += "<ul class='dropdown-menu dropdown-menu-end'>"
                          + "<li><a class='dropdown-item text-warning' href='./manrisk/"+item.id+"/edit'><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                          // + "<li><a class='dropdown-item text-info' href='javascript:void(0);'><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>"
                          + "<li><a class='dropdown-item text-danger' onclick='hapus("+item.id+")'><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                          + "<li><hr class='dropdown-divider'></li>"
                          + "<li><a class='dropdown-item text-dark' onclick='resikoBerulang("+item.id+")'><i class='bx bx-refresh scaleX-n1-rtl'></i> Risiko Berulang</a></li>"
                        + "</ul>";
              } else {
                if (item.id_user == userID) {
                  if (updet == date) {
                    content += "<ul class='dropdown-menu dropdown-menu-end'>"
                              + "<li><a class='dropdown-item text-warning' href='./manrisk/"+item.id+"/edit'><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                              + "<li><a class='dropdown-item text-danger' onclick='hapus("+item.id+")'><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                              + "<li><hr class='dropdown-divider'></li>"
                              + "<li><a class='dropdown-item text-dark' onclick='resikoBerulang("+item.id+")'><i class='bx bx-refresh scaleX-n1-rtl'></i> Risiko Berulang</a></li>"
                            + "</ul>";
                  } else {
                    content += "<ul class='dropdown-menu dropdown-menu-end'>"
                              + "<li><a class='dropdown-item text-secondary disabled' href='javascript:void(0);' disabled><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                              + "<li><a class='dropdown-item text-secondary disabled' onclick='javascript:void(0);' disabled><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                              + "<li><hr class='dropdown-divider'></li>"
                              + "<li><a class='dropdown-item text-dark' onclick='resikoBerulang("+item.id+")'><i class='bx bx-refresh scaleX-n1-rtl'></i> Risiko Berulang</a></li>"
                            + "</ul>";
                  }
                } else {
                  content += "<ul class='dropdown-menu dropdown-menu-end'>"
                            + "<li><a class='dropdown-item text-secondary disabled' href='javascript:void(0);' disabled><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                            + "<li><a class='dropdown-item text-secondary disabled' onclick='javascript:void(0);' disabled><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                            + "<li><hr class='dropdown-divider'></li>"
                            + "<li><a class='dropdown-item text-dark' onclick='resikoBerulang("+item.id+")'><i class='bx bx-refresh scaleX-n1-rtl'></i> Risiko Berulang</a></li>"
                          + "</ul>";
                }
              } 
            + "</div></center></td></tr>";
            $('#tampil-tbody').append(content);
          });
          $('#table').DataTable(
            {
              order: [[17, "desc"]],
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
                      filename: 'Daftar Risiko K3'
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
          $("div.head-label").html('<h5 class="card-title mb-0">Tabel</h5>');
          $(".buttons-columnVisibility").addClass('dropdown-item');
        }
      }
    }
  );
} );

// Function-function

function hapus(id) {
  Swal.fire({
    title: 'Apakah anda yakin?',
    text: 'Hapus Daftar Resiko ID : '+id,
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
        url: "./manrisk/api/hapus/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          iziToast.success({
            title: 'Sukses!',
            message: 'Hapus Daftar Resiko berhasil pada '+res,
            position: 'topRight'
          });
          window.location.reload();
        },
        error: function(res) {
          Swal.fire({
            title: `Gagal di hapus!`,
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