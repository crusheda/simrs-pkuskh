@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pelaporan / Manajemen Risiko /</span> Tambah
</h4>
    
<div class="row">

  <!-- Form Separator -->
  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header d-flex align-items-center justify-content-between">
        <button class="btn btn-label-dark" onclick="window.location='{{ route('manrisk.index') }}'"><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Kembali</button>
        <div class="card-title mb-0" style="text-align: right;">
          <h5 class="mb-2 me-2">Form Tambah</h5>
          <small class="text-muted">Manajemen Fasilitas Keselamatan (MFK)</small>
        </div>
      </h5>

      <form action="">

      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Jenis Risiko</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
              {{-- <div id="defaultFormControlHelp" class="form-text">We'll never share your details with anyone else.</div> --}}
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Proses Utama</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Item Kegiatan</label>
            <div class="form-group">
              <textarea rows="3" class="autosize1 form-control" placeholder=""></textarea>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Jenis Aktivitas</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Kode Bahaya</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Sumber Bahaya</label>
              <input type="text" id="" class="form-control" placeholder="" />
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Risiko</label>
              <input type="text" id="" class="form-control" placeholder="" />
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Pengendalian yang telah diterapkan</label>
            <div class="form-group">
              <textarea rows="3" class="autosize2 form-control" placeholder=""></textarea>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Dampak</label>
              <div class="input-group">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" href="#lihatdampak" role="button" aria-expanded="false" aria-controls="lihatdampak">Lihat</button>
                <select id="" class="form-select" data-allow-clear="true">
                  <option hidden>Pilih</option>
                  <option value="Australia">Australia</option>
                  <option value="Bangladesh">Bangladesh</option>
                </select>
              </div>
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
              <label for="defaultFormControlInput" class="form-label">Kemungkinan / Frekuensi</label>
              <div class="input-group">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" href="#lihatfrekuensi" role="button" aria-expanded="false" aria-controls="lihatfrekuensi">Lihat</button>
                <select id="" class="form-select" data-allow-clear="true">
                  <option hidden>Pilih</option>
                  <option value="Australia">Australia</option>
                  <option value="Bangladesh">Bangladesh</option>
                </select>
              </div>
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
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="defaultFormControlInput" class="form-label">Nilai</label>
              <div class="input-group">
                <span class="input-group-text">Dampak * Frekuensi</span>
                <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" disabled />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-4">
              <label for="defaultFormControlInput" class="form-label">Tingkat Risiko</label>
              <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" disabled />
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
              <input class="form-check-input" type="checkbox" value="" id="" />
              <label class="form-check-label">
                <strong>Eliminasi</strong> (Eliminasi Sumber Bahaya)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" value="" id="" />
              <label class="form-check-label">
                <strong>Substitusi</strong> (Substitusi Alat/Mesin/Bahan)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" value="" id="" />
              <label class="form-check-label">
                <strong>Enginering</strong> (Modifikasi/Perancangan Alat/Mesin/Tempat Kerja yang Lebih Aman)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" value="" id="" />
              <label class="form-check-label">
                <strong>Administration</strong> (Prosedur, Aturan, Pelatihan, Durasi Kerja, Tanda Bahaya, Rambu, Poster, Label)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" value="" id="" />
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
                <label for="defaultFormControlInput" class="form-label">Deskripsi Pengendalian Tambahan</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize3 form-control" placeholder=""></textarea>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <label for="defaultFormControlInput" class="form-label">Waktu Penerapan</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize4 form-control" placeholder=""></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-between">
        <small style="margin-top:10px"><i class="bx bx-info-circle"></i>&nbsp;&nbsp;Periksa kembali data anda</small>
        <button class="btn btn-primary" disabled>
          <i class="bx bx-save bx-sm ms-sm-n2"></i>
          <span class="align-middle d-sm-inline-block d-none me-sm-1">Simpan</span>
        </button>
      </div>
    
      </form>
    
    </div>
  </div>

</div>
<script>$(document).ready( function () {
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
} );
</script>
@endsection