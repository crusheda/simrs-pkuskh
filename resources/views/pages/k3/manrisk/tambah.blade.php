@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">K3 MFK / Daftar Risiko /</span> Tambah
</h4>
    
<div class="row">

  <!-- Form Separator -->
  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header d-flex align-items-center justify-content-between">
        <button class="btn btn-label-dark" onclick="window.location='{{ route('manrisk.index') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<i class='bx bx-chevron-left bx-xs' ></i> <span>Kembali ke Halaman Sebelumnya</span>"><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Kembali</button>
        <div class="card-title mb-0" style="text-align: right;">
          <h5 class="mb-2 me-2">Form Tambah Risiko Awal</h5>
          <small class="text-muted">Manajemen Fasilitas Keselamatan (MFK)</small>
        </div>
      </h5>

      <form id="formTambah" action="{{ route('manrisk.store') }}" method="POST">
      @csrf

      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Ruang Lingkup</label>
              <select name="jenis_risiko" class="select2 form-select" data-allow-clear="true" data-bs-auto-close="outside" required>
                <option value="">Pilih</option>
                <option value="1">Staf</option>
                <option value="2">Pasien</option>
                <option value="3">Fasilitas Rumah Sakit</option>
                <option value="4">Lingkungan Rumah Sakit</option>
                <option value="5">Bisnis Rumah Sakit</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Proses Utama</label>
              <select name="proses_utama" class="select2 form-select" data-allow-clear="true" required>
                <option value="">Pilih</option>
                <option value="1">Keselamatan</option>
                <option value="2">Keamanan</option>
                <option value="3">Pelayanan Kesehatan Kerja</option>
                <option value="4">Pengelolaan B3</option>
                <option value="5">Pengendalian Kebakaran</option>
                <option value="6">Utilitas</option>
                <option value="7">Prasarana Medis</option>
                <option value="8">Kebencanaan</option>
              </select>
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Item Kegiatan</label>
            <div class="form-group">
              <textarea rows="3" class="autosize1 form-control" name="item_kegiatan" placeholder="" required></textarea>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Sumber Data</label>
              <select name="jenis_aktivitas" class="select2 form-select" data-allow-clear="true" required>
                <option value="">Pilih</option>
                <option value="1">Laporan Kejadian</option>
                <option value="2">Survey</option>
                <option value="3">Komplain</option>
                <option value="4">Rapat Unit</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Kode Bahaya</label>
              <select name="kode_bahaya" class="select2 form-select" data-allow-clear="true" required>
                <option value="">Pilih</option>
                <option value="1">Cedera</option>
                <option value="2">Gangguan Kesehatan</option>
                <option value="3">Aset</option>
                <option value="4">Pencemaran</option>
                <option value="5">Citra Rumah Sakit</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Sumber Bahaya</label>
              <input type="text" name="sumber_bahaya" class="form-control" placeholder="" required/>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Risiko</label>
              <input type="text" name="risiko" class="form-control" placeholder="" required/>
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Usulan Pengendalian</label>
            <div class="form-group">
              <textarea rows="3" class="autosize2 form-control" name="pengendalian" placeholder="" required></textarea>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Dampak&nbsp;&nbsp;</label>
              <button class="btn btn-xs btn-outline-dark" type="button" data-bs-toggle="collapse" href="#lihatdampak" role="button" aria-expanded="false" aria-controls="lihatdampak">Lihat</button>
              <select name="dampak" class="select2 form-select" data-allow-clear="true" required>
                <option value="">Pilih</option>
                <option value="1">Sangat Rendah</option>
                <option value="2">Rendah</option>
                <option value="3">Sedang</option>
                <option value="4">Tinggi</option>
                <option value="5">Sangat Tinggi</option>
              </select>
              <div id="defaultFormControlHelp" class="form-text">Tombol Lihat untuk melihat Keterangan</div>
            </div>
            <div class="collapse" id="lihatdampak">
              <div class="d-grid d-sm-flex p-3 border">
                <div class="table-responsive text-nowrap">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Level</th>
                        <th>Deskripsi</th>
                        <th>Contoh</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><strong>1</strong></td>
                        <td>Sangat Rendah</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Tidak berdampak pada pencapaian tujuan instansi/kegiatan secara umum, agak mengganggu pelayanan, 
                          dampaknya dapat ditangani pada tahap kegiatan rutin, tidak mempengaruhi stake holder, tidak ada luka pada orang</td>
                      </tr>
                      <tr>
                        <td><strong>2</strong></td>
                        <td>Rendah</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengganggu pencapaian tujuan instansi/kegiatan meskipun tidak signifikan, cukup mengganggu jalannya pelayanan, 
                        mengancam efisiensi dan efektifitas beberapa program, sedikit mempengaruhi stake holder, luka kecil pada orang</td>
                      </tr>
                      <tr>
                        <td><strong>3</strong></td>
                        <td>Sedang</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengganggu pencapaian tujuan instansi/kegiatan secara signifikan, mengganggu jalannya pelayanan signifikan, 
                          mengancam efisiensi administrasi program, kerugian keuangan cukup besar, luka berarti pada orang</td>
                      </tr>
                      <tr>
                        <td><strong>4</strong></td>
                        <td>Tinggi</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Sebagian tujuan instansi/kegiatan gagal dilaksanakan, terganggunya pelayanan lebih dari 2 hari tetapi kurang dari seminnggu, 
                          mengancam fungsi program, kerugian besar keuangan, luka serius pada orang</td>
                      </tr>
                      <tr>
                        <td><strong>5</strong></td>
                        <td>Sangat Tinggi</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Sebagian besar tujuan/kegiatan gagal dilaksanakan, terganggunya palayanan lebih dari seminggu, 
                          mengancam program dan stake holder kerugian sangat besar pada keuangan, cacat dan kematian</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Kemungkinan / Frekuensi&nbsp;&nbsp;</label>
                <button class="btn btn-xs btn-outline-dark" type="button" data-bs-toggle="collapse" href="#lihatfrekuensi" role="button" aria-expanded="false" aria-controls="lihatfrekuensi">Lihat</button>
                <select name="frekuensi" class="select2 form-select" data-allow-clear="true" required>
                  <option value="">Pilih</option>
                  <option value="1">Sangat Jarang</option>
                  <option value="2">Jarang</option>
                  <option value="2">Mungkin</option>
                  <option value="2">Sering</option>
                  <option value="2">Sangat Sering</option>
                </select>
                <div id="defaultFormControlHelp" class="form-text">Tombol Lihat untuk melihat Keterangan</div>
            </div>
            <div class="collapse" id="lihatfrekuensi">
              <div class="d-grid d-sm-flex p-3 border">
                <div class="table-responsive text-nowrap">
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Level</th>
                        <th>Frekuensi</th>
                        <th>Kejadian Aktual</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><strong>1</strong></td>
                        <td>Sangat Jarang</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Peristiwa hanya akan timbul pada kondisi luar biasa (0-10%)</td>
                      </tr>
                      <tr>
                        <td><strong>2</strong></td>
                        <td>Jarang</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Peristiwa diharapkan tidak terjadi (>10-30%)</td>
                      </tr>
                      <tr>
                        <td><strong>3</strong></td>
                        <td>Mungkin</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Peristiwa kadang-kadang terjadi (>30-50%)</td>
                      </tr>
                      <tr>
                        <td><strong>4</strong></td>
                        <td>Sering</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Sangat mungkin terjadi pada sebagian kondisi (>50-90%)</td>
                      </tr>
                      <tr>
                        <td><strong>5</strong></td>
                        <td>Sangat Sering</td>
                        <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Selalu terjadi hampir setiap kondisi (>90%)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="card mb-4">
          <div class="card-header">Evaluasi Pengendalian</div>
          <div class="card-body">
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="0" name="elm"/>
              <label class="form-check-label">
                <strong>Eliminasi</strong> (Eliminasi Sumber Bahaya)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="0" name="sbt"/>
              <label class="form-check-label">
                <strong>Substitusi</strong> (Substitusi Alat/Mesin/Bahan)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="0" name="eng"/>
              <label class="form-check-label">
                <strong>Enginering</strong> (Modifikasi/Perancangan Alat/Mesin/Tempat Kerja yang Lebih Aman)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="0" name="adm"/>
              <label class="form-check-label">
                <strong>Administration</strong> (Prosedur, Aturan, Pelatihan, Durasi Kerja, Tanda Bahaya, Rambu, Poster, Label)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="0" name="apd"/>
              <label class="form-check-label">
                <strong>APD</strong> (Alat Perlindungan Diri Tenaga Kerja)
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-4">
                <label for="defaultFormControlInput" class="form-label">Realisasi Pengendalian</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize3 form-control" name="deskripsi" placeholder="" required></textarea>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <label for="defaultFormControlInput" class="form-label">Waktu Penerapan</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize4 form-control" name="waktu_penerapan" placeholder="" required></textarea>
                </div>
              </div>
              @hasrole('it|k3')
              <div class="col-md-12 mb-4">
                <div class="form-group">
                  <label for="defaultFormControlInput" class="form-label">Unit</label>
                  <select name="user_unit" class="form-select" data-allow-clear="true" data-bs-auto-close="outside" required>
                    <option value="">Pilih</option>
                    @if(count($list['unit']) > 0)
                      @foreach($list['unit'] as $item)
                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                      @endforeach
                    @endif
                  </select>
                  <div id="defaultFormControlHelp" class="form-text">Pastikan pemilihan Unit sudah benar</div>
                </div>
              </div>
              @endhasrole
            </div>
          </div>
        </div>
      </div>
      <div class="divider text-end" style="margin-top:-10px">
        <div class="divider-text">Periksa kembali data anda&nbsp;&nbsp;</div>
      </div>
      <div class="col-12 d-flex justify-content-between">
        <small style="margin-top:10px"></small>
        <button class="btn btn-primary" id="btn-simpan" type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<i class='fas fa-save nav-icon' ></i> <span>Simpan Data</span>">
          <i class="fa-fw fas fa-save nav-icon"></i> 
          <span class="align-middle d-sm-inline-block d-none me-sm-1">Simpan</span>
        </button>
      </div>
    
      </form>
    
    </div>
  </div>

</div>
<script>$(document).ready( function () {
  $("html").addClass('layout-menu-collapsed');
  // VALIDATION OF FORMSELECT
  // if($(".form-select").val() == "Pilih"){
  //   iziToast.error({
  //     title: 'Pesan Gagal',
  //     message: 'Periksa data anda sekali lagi',
  //     position: 'topRight'
  //   });    
  // }
  // AUTOSIZE TEXTAREA
  autosize(document.querySelector(".autosize1"));
  autosize(document.querySelector(".autosize2"));
  autosize(document.querySelector(".autosize3"));
  autosize(document.querySelector(".autosize4"));
  // SELECT2
  var t = $(".select2");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  })
  // DATEPICKER
  $(".dob-picker").flatpickr({
    monthSelectorType: "static"
  });
  // VALIDATION ONLY ONE SUBMIT
  $("#formTambah").one('submit', function() {
      //stop submitting the form to see the disabled button effect
      $("#btn-simpan").attr('disabled','disabled');
      $("#btn-simpan").find("i").toggleClass("fa-save fa-spinner fa-spin");

      return true;
  });
} );
</script>
@endsection