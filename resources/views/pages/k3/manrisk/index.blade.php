@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">K3 MFK /</span> Daftar Risiko
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
<!-- Find Resiko Berulang -->
<div class="card card-action mb-5">
  {{-- <div class="card-alert"></div> --}}
  <div class="card-header">
    <div class="card-action-title">
      <div class="btn-group">
        <a class="btn btn-primary" href="{{ route('manrisk.create') }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Tambah Daftar Risiko</span>">
          <i class="bx bx-plus scaleX-n1-rtl"></i>
          <span class="align-middle">Risiko Awal</span>
        </a>
        <a class="btn btn-info text-white" onclick="info()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-info-circle bx-xs' ></i> <span>Informasi Tambahan</span>">
          <i class="bx bx-info-circle scaleX-n1-rtl"></i>
        </a>
        <a class="btn btn-dark text-white" onclick="berulang()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-refresh bx-xs' ></i> <span>Tambah Risiko Berulang</span>">
          <i class="bx bx-refresh scaleX-n1-rtl"></i>
          <span class="align-middle">Risiko Berulang</span>
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
            <th>Sumber Data</th>
            <th>Kode Bahaya</th>
            <th>Sumber Bahaya</th>
            <th>Risiko</th>
            <th>Usulan Pengendalian</th>
            <th>Dampak</th>
            <th>Kemungkinan / Frekuensi</th>
            <th>Nilai</th>
            <th>Tingkat Risiko</th>
            <th>Evaluasi Pengendalian</th>
            <th>Realisasi Pengendalian</th>
            <th>Waktu Penerapan</th>
            <th>Residual (Update)</th>
            <th>Dibuat</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody id="tampil-tbody"><tr><td colspan="23"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="berulang" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="berulang">Tambah Risiko Berulang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formResidual" class="form-auth-small" action="{{ route('manrisk.residual') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Sumber Bahaya</label>
                <select name="sumber_bahaya" id="berulang_sumber_bahaya" class="select2 form-select" onChange="validasiBerulang(this);" data-allow-clear="true" required>
                  <option value="">Pilih</option>
                </select>
                <div id="defaultFormControlHelp" class="form-text">Sebagai Acuan Risiko Berulang</div>
            </div>
          </div>
        </div>
        <div class="divider text-end" style="margin-top:-10px">
          <div class="divider-text">Periksa Data Anda</div>
        </div>
        <div class="row g-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Risiko</label>
              <input type="text" id="risiko" class="form-control" readonly/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Item / Jenis Kegiatan</label>
              <textarea rows="3" class="form-control" id="item_jenis" readonly></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Usulan Pengendalian</label>
              <textarea rows="3" class="form-control" id="pengendalian" readonly></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Realisasi Pengendalian</label>
              <textarea rows="3" class="form-control" id="deskripsi" readonly></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Waktu Penerapan</label>
              <textarea rows="3" class="form-control" id="waktu_penerapan" readonly></textarea>
            </div>
          </div>
        </div>
        <div class="divider text-end">
          <div class="divider-text">Status Risiko</div>
        </div>
        <div class="row g-2">
          <div class="col-md-6">
            <h6>Tingkat Risiko : <a id="tingkat_risiko">-</a></h6>
            <small>Update terakhir pada <b><a id="update">-</a></b></small>
          </div>
          <div class="col-md-6">
            <h6>Jumlah Residual : <kbd id="residual">-</kbd></h6>
            <small>(Jumlah Kasus yang Berulang)</small>
          </div>
        </div>
        <div class="divider text-end">
          <div class="divider-text">Status Residual</div>
        </div>
        <div class="table-responsive">
          <table class="table border-top">
            <thead>
              <tr>
                <th>Residual</th>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Update</th>
                <td id="residualdate1"></td>
                <td id="residualdate2"></td>
                <td id="residualdate3"></td>
                <td id="residualdate4"></td>
                <td id="residualdate5"></td>
                <td id="residualdate6"></td>
                <td id="residualdate7"></td>
                <td id="residualdate8"></td>
                <td id="residualdate9"></td>
                <td id="residualdate10"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
      </form>
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="info" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="berulang"><i class="fas fa-info-circle"></i> Informasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table class="table border-top">
              <tbody>
                <tr>
                  <th>Pengertian</th>
                  <td style="text-align: justify;">Mengidentifikasi semua potensi yang dapat menimbulkan bahaya bagi karyawan, pasien, 
                    pengunjung keluarga pasien dan lingkungan Rumah sakit serta mengetahui seberapa besar 
                    potensi dan kemungkinannya sehingga dapat melakukan tindakan pencegahan dan penanggulangannya</td>
                </tr>
                <tr>
                  <th>Tujuan</th>
                  <td>
                    <ul>
                      <li>Mengetahui potensi bahaya ditempat kerja</li>
                      <li>Mengetahui lokasi dan potensi bahaya</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <th>Kebijakan</th>
                  <td>Kebijakan Direktur Nomor 172/KEP/DIR/III.6.AU/PKUSKH/2021 tentang Pedoman Pelayanan Keselamatan dan Kesehatan Kerja di Rumah Sakit PKU Muhammadiyah Sukoharjo.</td>
                </tr>
                <tr>
                  <th>Prosedur</th>
                  <td style="text-align: justify;">
                    <ul>
                      <li>Penanggung jawab MFK memberikan penjelasan dengan aplikasi daftar risiko MFK simrsmu untuk mengidentifikasi potensi bahaya ditempat kerja kepada penanggung jawab unit kerja yang sudah ditugaskan masing-masing Bagian/ Unit</li>
                      <li>Penanggung jawab Unit kerja mengidentifikasi potensi bahaya ditempat kerja masing-masing</li>
                      <li>Identifikasi bahaya meliputi potensi bahaya Keselamatan, Keamanan, Proteksi kebakaran, Utilitas/fasilitas Rumah sakit, Peralatan medis, Pengendalian bencana dan Bahan beracun dan berbahaya di masing-masing unit</li>
                      <li>Data diidentifikasi dan dilaporkan di aplikasi daftar risiko MFK simrsmu</li>
                      <li>Laporan data daftar risiko dilaporkan ke kepala unit untuk dibahas bersama. dengan tujuan memenuhi rekomendasi yang tercantum dalam daftar risiko untuk dilakukan pengendalian</li>
                      <li>Usulan pengendalian yang belum bisa diselesaikan ditingkat unit ditindaklanjuti oleh penanggunggung jawab MFK untuk direalisasikan pengendalian</li>
                      <li>Semua dokumen data identifikasi potensi bahaya disimpan dalam daftar Risiko unit</li>
                    </ul>
                  </td>
                </tr>
                <tr>
                  <th>Unit Terkait</th>
                  <td>Seluruh Unit rumah sakit</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready( function () {
  // SELECT RISIKO BERULANG
  var t = $("#berulang_sumber_bahaya");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  })
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
      url: "/api/k3/manrisk/data",
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
                        // Jenis Aktivitas Diganti Sumber Data
                          if (item.jenis_aktivitas == 1) {
                            content += "Laporan Kejadian";
                          }
                          if (item.jenis_aktivitas == 2) {
                            content += "Survey";
                          }
                          if (item.jenis_aktivitas == 3) {
                            content += "Komplain";
                          }
                          if (item.jenis_aktivitas == 4) {
                            content += "Rapat Unit";
                          }
                        content += "</td><td>";
                        // Kode Bahaya
                          if (item.kode_bahaya == 1) {
                            content += "Cedera";
                          }
                          if (item.kode_bahaya == 2) {
                            content += "Gangguan Kesehatan";
                          }
                          if (item.kode_bahaya == 3) {
                            content += "Aset";
                          }
                          if (item.kode_bahaya == 4) {
                            content += "Pencemaran";
                          }
                          if (item.kode_bahaya == 5) {
                            content += "Citra Rumah Sakit";
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
                        + item.residual + " Kasus (";
                        if (item.residualdate10 != null) {
                          content += item.residualdate10;
                        } else {
                          if (item.residualdate9 != null) {
                            content += item.residualdate9;
                          } else {
                            if (item.residualdate8 != null) {
                              content += item.residualdate8;
                            } else {
                              if (item.residualdate7 != null) {
                                content += item.residualdate7;
                              } else {
                                if (item.residualdate6 != null) {
                                  content += item.residualdate6;
                                } else {
                                  if (item.residualdate5 != null) {
                                    content += item.residualdate5;
                                  } else {
                                    if (item.residualdate4 != null) {
                                      content += item.residualdate4;
                                    } else {
                                      if (item.residualdate3 != null) {
                                        content += item.residualdate3;
                                      } else {
                                        if (item.residualdate2 != null) {
                                          content += item.residualdate2;
                                        } else {
                                          if (item.residualdate1 != null) {
                                            content += item.residualdate1;
                                          } else {
                                            content += "-";
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                        content += ")</td><td>"
                        + item.created_at + "</td><td>";

            content += "<center><div class='btn-group'>"
              + "<button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button>";
              if (adminID) {
                content += "<ul class='dropdown-menu dropdown-menu-end'>"
                          + "<li><a class='dropdown-item text-warning' href='./manrisk/"+item.id+"/edit'><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                          // + "<li><a class='dropdown-item text-info' href='javascript:void(0);'><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>"
                          + "<li><a class='dropdown-item text-danger' onclick='hapus("+item.id+")'><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                        + "</ul>";
              } else {
                if (item.id_user == userID) {
                  if (updet == date) {
                    content += "<ul class='dropdown-menu dropdown-menu-end'>"
                              + "<li><a class='dropdown-item text-warning' href='./manrisk/"+item.id+"/edit'><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                              + "<li><a class='dropdown-item text-danger' onclick='hapus("+item.id+")'><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                            + "</ul>";
                  } else {
                    content += "<ul class='dropdown-menu dropdown-menu-end'>"
                              + "<li><a class='dropdown-item text-secondary disabled' href='javascript:void(0);' disabled><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                              + "<li><a class='dropdown-item text-secondary disabled' onclick='javascript:void(0);' disabled><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                            + "</ul>";
                  }
                } else {
                  content += "<ul class='dropdown-menu dropdown-menu-end'>"
                            + "<li><a class='dropdown-item text-secondary disabled' href='javascript:void(0);' disabled><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>"
                            + "<li><a class='dropdown-item text-secondary disabled' onclick='javascript:void(0);' disabled><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>"
                          + "</ul>";
                }
              } 
            + "</div></center></td></tr>";
            $('#tampil-tbody').append(content);
          });
          $('#table').DataTable(
            {
              order: [[18, "desc"]],
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
// VALIDATION ONLY ONE SUBMIT
$("#formResidual").one('submit', function() {
    //stop submitting the form to see the disabled button effect
    $("#btn-simpan").attr('disabled','disabled');
    $("#btn-simpan").find("i").toggleClass("fa-save fa-spinner fa-spin");

    return true;
});

function info() {
  $('#info').modal('show');
}

function berulang() {
  $.ajax(
    {
      url: "api/k3/manrisk/berulang",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $('#berulang').modal('show');
        // var dt = new Date(res.show.tanggal).toJSON().slice(0,19);
        // console.log(dt);
        // document.getElementById('show_edit').innerHTML = "ID : "+res.show.id;
        $("#berulang_sumber_bahaya").find('option').remove();
        $("#berulang_sumber_bahaya").append(`<option value="">Pilih</option>`);
        res.show.forEach(item => {
          $("#berulang_sumber_bahaya").append(`<option value="${item.id}">${item.sumber_bahaya}</option>`);
        });
        // $("#risiko").val();
        // $("#item_jenis").val();
        // $("#pengendalian").val();
        // $("#deskripsi").val();
        // $("#waktu_penerapan").val();
      }
    }
  );
}

function validasiBerulang(sel) {
  $.ajax(
    {
      url: "api/k3/manrisk/berulang/validasi/"+sel.value,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        // var dt = new Date(res.show.tanggal).toJSON().slice(0,19);
        if (res.tingkat_risiko == 'Low') {
          tingkat_risiko = '<span class="badge" style="background-color:#00B0F0">'+res.tingkat_risiko+'</span>';
        }
        if (res.tingkat_risiko == 'Medium') {
          tingkat_risiko = '<span class="badge" style="background-color:#00B050">'+res.tingkat_risiko+'</span>';
        }
        if (res.tingkat_risiko == 'High') {
          tingkat_risiko = '<span class="badge" style="background-color:#FFFF00;color:black">'+res.tingkat_risiko+'</span>';
        }
        if (res.tingkat_risiko == 'Extreme') {
          tingkat_risiko = '<span class="badge" style="background-color:#C65911">'+res.tingkat_risiko+'</span>';
        }
        if (res.tingkat_risiko == 'Very Extreme') {
          tingkat_risiko = '<span class="badge" style="background-color:#FF0000">'+res.tingkat_risiko+'</span>';
        }

        if (res.jenis_risiko == 1) {
          jenis_risiko = 'Staf';
        } 
        if (res.jenis_risiko == 2) {
          jenis_risiko = 'Pasien';
        } 
        if (res.jenis_risiko == 3) {
          jenis_risiko = 'Fasilitas Rumah Sakit';
        } 
        if (res.jenis_risiko == 4) {
          jenis_risiko = 'Lingkungan Rumah Sakit';
        } 
        if (res.jenis_risiko == 5) {
          jenis_risiko = 'Bisnis Rumah Sakit';
        } 

        if (res.residual != null) {
          residual = res.residual + ' Kasus';
        } else {
          residual = '-';
        }

        $("#risiko").val(res.risiko);
        $("#item_jenis").val(res.item_kegiatan + ' (' + jenis_risiko + ')');
        $("#pengendalian").val(res.pengendalian);
        $("#deskripsi").val(res.deskripsi);
        $("#waktu_penerapan").val(res.waktu_penerapan);
        document.getElementById('tingkat_risiko').innerHTML = tingkat_risiko;
        document.getElementById('update').innerHTML = res.updated_at;
        document.getElementById('residual').innerHTML = residual;
        document.getElementById('residualdate1').innerHTML = res.residualdate1;
        document.getElementById('residualdate2').innerHTML = res.residualdate2;
        document.getElementById('residualdate3').innerHTML = res.residualdate3;
        document.getElementById('residualdate4').innerHTML = res.residualdate4;
        document.getElementById('residualdate5').innerHTML = res.residualdate5;
        document.getElementById('residualdate6').innerHTML = res.residualdate6;
        document.getElementById('residualdate7').innerHTML = res.residualdate7;
        document.getElementById('residualdate8').innerHTML = res.residualdate8;
        document.getElementById('residualdate9').innerHTML = res.residualdate9;
        document.getElementById('residualdate10').innerHTML = res.residualdate10;
      }
    }
  );
};

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
        url: "api/k3/manrisk/hapus/"+id,
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