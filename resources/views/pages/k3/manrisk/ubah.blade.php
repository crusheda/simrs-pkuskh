@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">K3 MFK / Daftar Risiko /</span> Ubah
</h4>

@foreach($list['show'] as $item)
<div class="row">

  <!-- Form Separator -->
  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header d-flex align-items-center justify-content-between">
        <button class="btn btn-label-dark" onclick="window.location='{{ route('manrisk.index') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<i class='bx bx-chevron-left bx-xs' ></i> <span>Kembali ke Halaman Sebelumnya</span>"><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Kembali</button>
        <div class="card-title mb-0" style="text-align: right;">
          <h5 class="mb-2 me-2">Form Ubah <kbd>ID : {{ $item->id }}</kbd></h5>
          <small class="text-muted">Manajemen Fasilitas Keselamatan (MFK)</small>
        </div>
      </h5>

      {{ Form::model($item, array('route' => array('manrisk.update', $item->id), 'method' => 'PUT')) }}
      @csrf

      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Ruang Lingkup</label>
              <select name="jenis_risiko" class="select2 form-select" data-allow-clear="true" data-bs-auto-close="outside" required>
                <option value="1" @if ($item->jenis_risiko == 1 ) selected @endif>Staf</option>
                <option value="2" @if ($item->jenis_risiko == 2 ) selected @endif>Pasien</option>
                <option value="3" @if ($item->jenis_risiko == 3 ) selected @endif>Fasilitas Rumah Sakit</option>
                <option value="4" @if ($item->jenis_risiko == 4 ) selected @endif>Lingkungan Rumah Sakit</option>
                <option value="5" @if ($item->jenis_risiko == 5 ) selected @endif>Bisnis Rumah Sakit</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Proses Utama</label>
              <select name="proses_utama" class="select2 form-select" data-allow-clear="true" required>
                <option value="1" @if ($item->proses_utama == 1 ) selected @endif>Keselamatan</option>
                <option value="2" @if ($item->proses_utama == 2 ) selected @endif>Keamanan</option>
                <option value="3" @if ($item->proses_utama == 3 ) selected @endif>Pelayanan Kesehatan Kerja</option>
                <option value="4" @if ($item->proses_utama == 4 ) selected @endif>Pengelolaan B3</option>
                <option value="5" @if ($item->proses_utama == 5 ) selected @endif>Pengendalian Kebakaran</option>
                <option value="6" @if ($item->proses_utama == 6 ) selected @endif>Utilitas</option>
                <option value="7" @if ($item->proses_utama == 7 ) selected @endif>Prasarana Medis</option>
                <option value="8" @if ($item->proses_utama == 8 ) selected @endif>Kebencanaan</option>
              </select>
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Item Kegiatan</label>
            <div class="form-group">
              <textarea rows="3" class="autosize1 form-control" name="item_kegiatan" placeholder="" required><?php echo htmlspecialchars($item->item_kegiatan); ?></textarea>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Sumber Data</label>
              <select name="jenis_aktivitas" class="select2 form-select" data-allow-clear="true" required>
                <option value="1" @if ($item->jenis_aktivitas == 1 ) selected @endif>Laporan Kejadian</option>
                <option value="2" @if ($item->jenis_aktivitas == 2 ) selected @endif>Survey</option>
                <option value="3" @if ($item->jenis_aktivitas == 3 ) selected @endif>Komplain</option>
                <option value="4" @if ($item->jenis_aktivitas == 4 ) selected @endif>Rapat Unit</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Kode Bahaya</label>
              <select name="kode_bahaya" class="select2 form-select" data-allow-clear="true" required>
                <option value="1" @if ($item->kode_bahaya == 1 ) selected @endif>Cedera</option>
                <option value="2" @if ($item->kode_bahaya == 2 ) selected @endif>Gangguan Kesehatan</option>
                <option value="3" @if ($item->kode_bahaya == 3 ) selected @endif>Aset</option>
                <option value="4" @if ($item->kode_bahaya == 4 ) selected @endif>Pencemaran</option>
                <option value="5" @if ($item->kode_bahaya == 5 ) selected @endif>Citra Rumah Sakit</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Sumber Bahaya</label>
              <input type="text" name="sumber_bahaya" class="form-control" value="{{ $item->sumber_bahaya }}" placeholder="" required/>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Risiko</label>
              <input type="text" name="risiko" class="form-control" value="{{ $item->risiko }}" placeholder="" required/>
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Usulan Pengendalian</label>
            <div class="form-group">
              <textarea rows="3" class="autosize2 form-control" name="pengendalian" placeholder="" required><?php echo htmlspecialchars($item->pengendalian); ?></textarea>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Dampak&nbsp;&nbsp;</label>
              <button class="btn btn-xs btn-outline-dark" type="button" data-bs-toggle="collapse" href="#lihatdampak" role="button" aria-expanded="false" aria-controls="lihatdampak">Lihat</button>
              <select name="dampak" class="select2 form-select" data-allow-clear="true" required>
                <option value="1" @if ($item->dampak == 1 ) selected @endif>Sangat Rendah</option>
                <option value="2" @if ($item->dampak == 2 ) selected @endif>Rendah</option>
                <option value="3" @if ($item->dampak == 3 ) selected @endif>Sedang</option>
                <option value="4" @if ($item->dampak == 4 ) selected @endif>Tinggi</option>
                <option value="5" @if ($item->dampak == 5 ) selected @endif>Sangat Tinggi</option>
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
                  <option value="1" @if ($item->frekuensi == 1 ) selected @endif>Sangat Jarang</option>
                  <option value="2" @if ($item->frekuensi == 2 ) selected @endif>Jarang</option>
                  <option value="2" @if ($item->frekuensi == 3 ) selected @endif>Mungkin</option>
                  <option value="2" @if ($item->frekuensi == 4 ) selected @endif>Sering</option>
                  <option value="2" @if ($item->frekuensi == 5 ) selected @endif>Sangat Sering</option>
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
              <input class="form-check-input checkbox" type="checkbox" value="{{ $item->elm }}" name="elm" @if ($item->elm == 1 ) checked @endif/>
              <label class="form-check-label">
                <strong>Eliminasi</strong> (Eliminasi Sumber Bahaya)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="{{ $item->sbt }}" name="sbt" @if ($item->sbt == 1 ) checked @endif/>
              <label class="form-check-label">
                <strong>Substitusi</strong> (Substitusi Alat/Mesin/Bahan)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="{{ $item->eng }}" name="eng" @if ($item->eng == 1 ) checked @endif/>
              <label class="form-check-label">
                <strong>Enginering</strong> (Modifikasi/Perancangan Alat/Mesin/Tempat Kerja yang Lebih Aman)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="{{ $item->adm }}" name="adm" @if ($item->adm == 1 ) checked @endif/>
              <label class="form-check-label">
                <strong>Administration</strong> (Prosedur, Aturan, Pelatihan, Durasi Kerja, Tanda Bahaya, Rambu, Poster, Label)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input checkbox" type="checkbox" value="{{ $item->apd }}" name="apd" @if ($item->apd == 1 ) checked @endif/>
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
                  <textarea rows="3" class="autosize3 form-control" name="deskripsi" placeholder="" required><?php echo htmlspecialchars($item->deskripsi); ?></textarea>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <label for="defaultFormControlInput" class="form-label">Waktu Penerapan</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize4 form-control" name="waktu_penerapan" placeholder="" required><?php echo htmlspecialchars($item->waktu_penerapan); ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="divider text-end" style="margin-top:-10px">
        <div class="divider-text">Periksa kembali data anda&nbsp;&nbsp;</div>
      </div>
      <div class="col-12 d-flex justify-content-between">
        <small style="margin-top:10px"></small>
        <button class="btn btn-primary" id="btn-simpan" type="submit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<i class='fas fa-save nav-icon' ></i> <span>Ubah Data</span>">
          <i class="fa-fw fas fa-save nav-icon"></i> 
          <span class="align-middle d-sm-inline-block d-none me-sm-1">Ubah</span>
        </button>
      </div>
    
      {!! Form::close() !!}
    
    </div>
  </div>

</div>
@endforeach
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