@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-3">
  <span class="text-muted fw-light">Profil / Detail /</span> Ubah
</h4>

<div class="row">
  <div class="col-md-12">
    <a class="btn btn-dark mb-3" href="{{ route('profil.index') }}"><i class="bx bx-chevron-left me-1"></i> Kembali</a>
    {{-- <hr class="my-0"> --}}
    <div class="card mb-4">
      <div class="bs-stepper wizard-numbered mt-2">
        <div class="bs-stepper-header">
          <div class="step" data-target="#personal-info">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">1</span>
              <span class="bs-stepper-label mt-1">
                <span class="bs-stepper-title">Data Diri</span>
                <span class="bs-stepper-subtitle">Atur Data Pribadi Anda</span>
              </span>
            </button>
          </div>
          <div class="line">
            <i class="bx bx-chevron-right"></i>
          </div>
          <div class="step" data-target="#alamat-links">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">2</span>
              <span class="bs-stepper-label mt-1">
                <span class="bs-stepper-title">Alamat</span>
                <span class="bs-stepper-subtitle">Atur Alamat Lengkap Anda</span>
              </span>
            </button>
          </div>
          <div class="line">
            <i class="bx bx-chevron-right"></i>
          </div>
          <div class="step" data-target="#social-links">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">3</span>
              <span class="bs-stepper-label mt-1">
                <span class="bs-stepper-title">Kontak</span>
                <span class="bs-stepper-subtitle">Atur Kontak Anda</span>
              </span>
            </button>
          </div>
          <div class="line">
            <i class="bx bx-chevron-right"></i>
          </div>
          <div class="step" data-target="#riwayat">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">4</span>
              <span class="bs-stepper-label mt-1">
                <span class="bs-stepper-title">Riwayat</span>
                <span class="bs-stepper-subtitle">Atur Riwayat Anda</span>
              </span>
            </button>
          </div>
          <div class="line">
            <i class="bx bx-chevron-right"></i>
          </div>
          <div class="step" data-target="#foto-profil">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">5</span>
              <span class="bs-stepper-label mt-1">
                <span class="bs-stepper-title">Foto Profil</span>
                <span class="bs-stepper-subtitle">Atur Foto Profil Anda</span>
              </span>
            </button>
          </div>
        </div>
        <div class="bs-stepper-content">
          <form id="formUpdate" class="form-auth-small" action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Data Diri -->
            <div id="personal-info" class="content">
              <div class="content-header mb-3">
                <h6 class="mb-0">Data Diri</h6>
                <small>Atur Data Pribadi Anda</small>
              </div>
              <div class="row g-3">
                <div class="col-sm-4">
                  <label class="form-label">Akun</label>
                  <input type="text" class="form-control" value="{{ $list['show']->name }}" disabled />
                </div>
                <div class="col-sm-4">
                  <label class="form-label" for="username">NIP</label>
                  <input type="text" name="nip" class="form-control" value="{{ $list['show']->nip }}" placeholder="Terisi Otomatis Oleh Kepegawaian" disabled />
                </div>
                <div class="col-sm-4">
                  <label class="form-label" for="email">NIK</label>
                  <input type="text" name="nik" class="form-control" value="{{ $list['show']->nik }}" placeholder="Isi dengan kombinasi Angka" required/>
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="first-name">Nama Lengkap, Gelar</label>
                  <input type="text" name="nama" class="form-control" value="{{ $list['show']->nama }}" placeholder="e.g. Sunaryo, S.Kep" required/>
                </div>
                <div class="col-sm-6">
                  <label class="form-label" for="last-name">Nama Panggilan</label>
                  <input type="text" name="nick" class="form-control" value="{{ $list['show']->nick }}" placeholder="e.g. Soenaryo" required/>
                </div>
                <div class="col-sm-3">
                  <label class="form-label" for="temp_lahir">Tempat Lahir</label>
                  <select class="select2 form-control" name="temp_lahir" required>
                    <option value="">Pilih</option>
                    @foreach($list['kota'] as $item)
                        <option value="{{ $item->nama_kabkota }}" @if ($list['show']->temp_lahir == $item->nama_kabkota) echo selected @endif>{{ $item->nama_kabkota }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                  <input type="text" class="form-control flatpickr" name="tgl_lahir" value="{{ $list['show']->tgl_lahir }}" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="col-sm-3">
                  <label class="form-label" for="temp_lahir">Jenis Kelamin</label>
                  <select class="select2 form-control" name="jns_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="LAKI-LAKI" @if ($list['show']->jns_kelamin == 'LAKI-LAKI') echo selected @endif>Laki-laki</option>
                    <option value="PEREMPUAN" @if ($list['show']->jns_kelamin == 'PEREMPUAN') echo selected @endif>Perempuan</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="form-label" for="temp_lahir">Status Kawin</label>
                  <select class="select2 form-control" name="status_kawin" required>
                    <option value="">Pilih</option>
                    <option value="BELUM" @if ($list['show']->status_kawin == 'BELUM') echo selected @endif>Belum</option>
                    <option value="SUDAH" @if ($list['show']->status_kawin == 'SUDAH') echo selected @endif>Sudah</option>
                    <option value="CERAI" @if ($list['show']->status_kawin == 'CERAI') echo selected @endif>Cerai</option>
                    <option value="RAHASIA" @if ($list['show']->status_kawin == 'RAHASIA') echo selected @endif>Tidak ingin memberi tahu</option>
                  </select>
                </div>
                <div class="col-12 d-flex justify-content-between">
                  <button class="btn btn-label-secondary btn-prev" disabled>
                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                  </button>
                  <a class="btn btn-primary btn-next" href="javascript:void(0);">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Selanjutnya</span>
                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- Alamat -->
            <div id="alamat-links" class="content">
              <div class="content-header mb-3">
                <h6 class="mb-0">Alamat</h6>
                <small>Atur Alamat Lengkap Anda</small>
              </div>
              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label">Provinsi</label>
                  <select class="select2 form-control" name="ktp_provinsi" id="apiprovinsi" required>
                    <option value="">Pilih</option>
                    @foreach($list['provinsi'] as $item)
                      <option value="{{ $item->provinsi }}" @if ($item->provinsi == $list['show']->ktp_provinsi) echo selected @endif>{{ $item->provinsi }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Kabupaten</label>
                  <select class="select2 form-control" name="ktp_kabupaten" id="apikota" disabled required>
                    @if (!empty($list['show']->ktp_kabupaten))
                      <option value="{{ $list['show']->ktp_kabupaten }}">{{ $list['show']->ktp_kabupaten }}</option>
                    @endif
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Kecamatan</label>
                  <select class="select2 form-control" name="ktp_kecamatan" id="apikecamatan" disabled required>
                    @if (!empty($list['show']->ktp_kecamatan))
                      <option value="{{ $list['show']->ktp_kecamatan }}">{{ $list['show']->ktp_kecamatan }}</option>
                    @endif
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Kelurahan</label>
                  <select class="select2 form-control" name="ktp_kelurahan" id="apidesa" disabled required>
                    @if (!empty($list['show']->ktp_kelurahan))
                      <option value="{{ $list['show']->ktp_kelurahan }}">{{ $list['show']->ktp_kelurahan }}</option>
                    @endif
                  </select>
                </div>
                <div class="col-sm-12">
                  <label class="form-label">Alamat Lengkap</label>
                  <textarea rows="3" class="form-control" name="alamat_ktp" required><?php echo htmlspecialchars($list['show']->alamat_ktp); ?></textarea>
                </div>
                <div class="form-group col-md-12 col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" @if (!empty($list['show']->alamat_dom)) value="1" @else value="0" checked @endif name="cek_dom" id="checkbox_alamat">
                    <label class="custom-control-label" for="checkbox_alamat">Alamat Domisili sesuai dengan KTP</label>
                    <div class="text-muted form-text">
                      Centang apabila alamat Domisili sekarang sama dengan alamat di KTP anda.
                    </div>
                  </div>
                </div>
              </div>
              <div class="collapse" id="hidedom">
                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Provinsi</label>
                    <select class="select2 form-control" name="dom_provinsi" id="apiprovinsidom">
                      <option value="">Pilih</option>
                      @foreach($list['provinsi'] as $item)
                        <option value="{{ $item->provinsi }}" @if ($item->provinsi == $list['show']->dom_provinsi) echo selected @endif>{{ $item->provinsi }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Kabupaten</label>
                    <select class="select2 form-control" name="dom_kabupaten" id="apikotadom" disabled>
                      @if (!empty($list['show']->dom_kabupaten))
                        <option value="{{ $list['show']->dom_kabupaten }}">{{ $list['show']->dom_kabupaten }}</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Kecamatan</label>
                    <select class="select2 form-control" name="dom_kecamatan" id="apikecamatandom" disabled>
                      @if (!empty($list['show']->dom_kecamatan))
                        <option value="{{ $list['show']->dom_kecamatan }}">{{ $list['show']->dom_kecamatan }}</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Kelurahan</label>
                    <select class="select2 form-control" name="dom_kelurahan" id="apidesadom" disabled>
                      @if (!empty($list['show']->dom_kelurahan))
                        <option value="{{ $list['show']->dom_kelurahan }}">{{ $list['show']->dom_kelurahan }}</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea rows="3" class="form-control" name="alamat_dom"><?php echo htmlspecialchars($list['show']->alamat_dom); ?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 d-flex justify-content-between">
                  <a class="btn btn-primary btn-prev" href="javascript:void(0);">
                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                  </a>
                  <a class="btn btn-primary btn-next" href="javascript:void(0);">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Selanjutnya</span>
                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- Sosial Media -->
            <div id="social-links" class="content">
              <div class="content-header mb-3">
                <h6 class="mb-0">Kontak</h6>
                <small>Atur Kontak Anda</small>
              </div>
              <div class="row g-3">
                <div class="col-sm-6">
                  <label class="form-label">Nomor HP</label>
                  <input type="text" name="no_hp" class="form-control phone" value="{{ $list['show']->no_hp }}" maxlength="13" placeholder="628**********" required/>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Instagram</label>
                  <input type="text" name="ig" class="form-control" value="{{ $list['show']->ig }}" placeholder="" />
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Facebook</label>
                  <input type="text" name="fb" class="form-control" value="{{ $list['show']->fb }}" placeholder="" />
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ $list['show']->email }}" placeholder="" />
                </div>
                <div class="row g-3">
                  <div class="col-12 d-flex justify-content-between">
                    <a class="btn btn-primary btn-prev" href="javascript:void(0);">
                      <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                      <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                    </a>
                    <a class="btn btn-primary btn-next" href="javascript:void(0);">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Selanjutnya</span>
                      <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Riwayat -->
            <div id="riwayat" class="content">
              <div class="content-header mb-3">
                <h6 class="mb-0">Riwayat</h6>
                <small>Atur Riwayat Pendidikan Anda</small>
              </div>
              <div class="row g-3 mb-3">
                <div class="col-sm-6">
                  <label class="form-label">Sekolah Dasar</label>
                  <div class="input-group">
                    <input type="text" name="sd" value="{{ $list['show']->sd }}" class="form-control" placeholder="Nama Sekolah Dasar">
                    <input type="text" name="th_sd" value="{{ $list['show']->th_sd }}" class="form-control phone" maxlength="4" placeholder="Tahun Lulus">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">SMP/MTS</label>
                  <div class="input-group">
                    <input type="text" name="smp" value="{{ $list['show']->smp }}" class="form-control" placeholder="Nama Sekolah Menengah Pertama">
                    <input type="text" name="th_smp" value="{{ $list['show']->th_smp }}" class="form-control" placeholder="Tahun Lulus">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">SMA/SMK</label>
                  <div class="input-group">
                    <input type="text" name="sma" value="{{ $list['show']->sma }}" class="form-control" placeholder="Nama Sekolah Menengah Atas">
                    <input type="text" name="th_sma" value="{{ $list['show']->th_sma }}" class="form-control" placeholder="Tahun Lulus">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">D1</label>
                  <div class="input-group">
                    <input type="text" name="d1" value="{{ $list['show']->d1 }}" class="form-control" placeholder="Nama Universitas">
                    <input type="text" name="th_d1" value="{{ $list['show']->th_d1 }}" class="form-control" placeholder="Tahun Lulus">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">D3</label>
                  <div class="input-group">
                    <input type="text" name="d3" value="{{ $list['show']->d3 }}" class="form-control" placeholder="Nama Universitas">
                    <input type="text" name="th_d3" value="{{ $list['show']->th_d3 }}" class="form-control" placeholder="Tahun Lulus">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">S1/D4</label>
                  <div class="input-group">
                    <input type="text" name="s1" value="{{ $list['show']->s1 }}" class="form-control" placeholder="Nama Universitas">
                    <input type="text" name="th_s1" value="{{ $list['show']->th_s1 }}" class="form-control" placeholder="Tahun Lulus">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">S2</label>
                  <div class="input-group">
                    <input type="text" name="s2" value="{{ $list['show']->s2 }}" class="form-control" placeholder="Nama Universitas">
                    <input type="text" name="th_s2" value="{{ $list['show']->th_s2 }}" class="form-control" placeholder="Tahun Lulus">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">S3</label>
                  <div class="input-group">
                    <input type="text" name="s3" value="{{ $list['show']->s3 }}" class="form-control" placeholder="Nama Universitas">
                    <input type="text" name="th_s3" value="{{ $list['show']->th_s3 }}" class="form-control" placeholder="Tahun Lulus">
                  </div>
                </div>
              </div>
              <div class="content-header mb-3">
                <hr>
                <h6 class="mb-0">Dokumen Kepegawaian</h6>
                <small>Atur Riwayat Pekerjaan Anda</small>
              </div>
              <div class="row g-3 mb-3">
                <div class="col-sm-12">
                  <label class="form-label">Pengalaman Kerja</label>
                  <textarea rows="3" class="form-control" name="pengalaman_kerja"><?php echo htmlspecialchars($list['show']->pengalaman_kerja); ?></textarea>
                </div>
              </div>
              <div class="content-header mb-3">
                <hr>
                <h6 class="mb-0">Dokumen Medis</h6>
                <small>Tambahkan Riwayat Penyakit Anda</small>
              </div>
              <div class="row g-3">
                <div class="col-sm-6">
                  <label class="form-label">Riwayat Penyakit</label>
                  <textarea rows="3" class="form-control" name="riwayat_penyakit"><?php echo htmlspecialchars($list['show']->riwayat_penyakit); ?></textarea>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Riwayat Penyakit Keluarga</label>
                  <textarea rows="3" class="form-control" name="riwayat_penyakit_keluarga"><?php echo htmlspecialchars($list['show']->riwayat_penyakit_keluarga); ?></textarea>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Riwayat Operasi</label>
                  <textarea rows="3" class="form-control" name="riwayat_operasi"><?php echo htmlspecialchars($list['show']->riwayat_operasi); ?></textarea>
                </div>
                <div class="col-sm-6">
                  <label class="form-label">Riwayat Penggunaan Obat</label>
                  <textarea rows="3" class="form-control" name="riwayat_penggunaan_obat"><?php echo htmlspecialchars($list['show']->riwayat_penggunaan_obat); ?></textarea>
                </div>
                <div class="col-12 d-flex justify-content-between">
                  <a class="btn btn-primary btn-prev" href="javascript:void(0);">
                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                  </a>
                  <a class="btn btn-primary btn-next" href="javascript:void(0);">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Selanjutnya</span>
                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- Social Links -->
            <div id="foto-profil" class="content">
              <div class="content-header mb-3">
                <h6 class="mb-0">Foto Profil</h6>
                <small>Atur Foto Profil Akun Anda</small>
              </div>
              <div class="row g-3">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                  @if (!empty($list['foto']->filename))
                    <img src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" alt="user-avatar" class="d-block rounded" height="100" id="blah" />
                  @else
                    <img alt="image" src="/assets/img/avatar/avatar-1.png" class="d-block rounded" height="100" id="blah">
                  @endif
                  <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                      <span class="d-none d-sm-block">Upload Foto</span>
                      <i class="bx bx-upload d-block d-sm-none"></i>
                      <input type="file" name="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                    </label>
                    {{-- <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                      <i class="bx bx-reset d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Reset</span>
                    </button> --}}
        
                    <p class="text-muted mb-0">File berformat JPG, GIF, atau PNG</p>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-between">
                  <a class="btn btn-primary btn-prev" href="javascript:void(0);">
                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                    <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                  </a>
                  <button class="btn btn-warning btn-submit" onclick="saveData()" type="submit" id="btn-simpan" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-chevron-right bx-xs' ></i> <span>Periksa Data Anda Sekali Lagi!</span>">
                    <i class="fas fa-save"></i> Simpan
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Account -->
    <div class="card">
      <h5 class="card-header">Nonaktifkan Akun</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Apakah Anda sudah yakin ingin menonaktifkan akun Anda?</h6>
            <p class="mb-0">Sesaat setelah Anda menonaktifkan akun, maka Anda tidak lagi dapat mengakses sistem Simrsmu terkecuali akun diaktifkan kembali oleh Admin. </p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">Saya menyetujui semua risiko</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account" disabled>Nonaktifkan Akun</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function () {
    // SELECT2
    var sel = $(".select2");
    sel.length && sel.each(function() {
      var eval = $(this);
      eval.wrap('<div class="position-relative"></div>').select2({
        placeholder: "Pilih",
        dropdownParent: eval.parent()
      })
    })
    // DATEPICKER
      // DATE
      $('.flatpickr').flatpickr({
        monthSelectorType: "static"
      });
      // DATETIME
      $('.flatpickrtime').flatpickr({
        enableTime: !0,
        dateFormat: "Y-m-d H:i"
      });
    // const e = $(".select2")
    //   , t = $(".selectpicker");
    // t.length && t.selectpicker(),
    // e.length && e.each(function() {
    //     var e = $(this);
    //     e.wrap('<div class="position-relative"></div>'),
    //     e.select2({
    //         placeholder: "Select value",
    //         dropdownParent: e.parent()
    //     })
    // })
    const e = document.querySelector(".wizard-numbered")
      , t = [].slice.call(e.querySelectorAll(".btn-next"))
      , l = [].slice.call(e.querySelectorAll(".btn-prev"))
      , phone = document.querySelectorAll(".phone");
    if (e,
    null !== e) {
      const i = new Stepper(e,{
          linear: !1
      });
      t && t.forEach(e=>{
          e.addEventListener("click", e=>{
              i.next()
          }
          )
      }
      ),
      l && l.forEach(e=>{
          e.addEventListener("click", e=>{
              i.previous()
          }
          )
      }
      )
    }
    phone && phone.forEach(function(phone) {
        new Cleave(phone,{
            phone: !0,
            phoneRegionCode: "ID"
        })
    }),
    
      // ALAMAT KTP
      $('#apiprovinsi').change(function() { 
          
          $.ajax({
              url: "/api/provinsi/"+this.value,
              type: 'GET',
              dataType: 'json', // added data type
              success: function(res) {
                // console.log(this.value);
                  // var valprovinsi = $("#apiprovinsi").val();
                  $("#apikota").val("").find('option').remove();
                  $("#apikecamatan").val("").find('option').remove();
                  $("#apidesa").val("").find('option').remove();
                  $("#apikota").attr('disabled', false);
                  $("#apikecamatan").attr('disabled', true);
                  $("#apidesa").attr('disabled', true);
                  $("#apikota").append('<option value="">Pilih</option>');
                  // res.forEach(item => {
                  //     $("#apikota").val(item.nama_kabkota);
                  // });
                  // var ary = res.;  
                  var len = res.length;   
                  var sel = document.getElementById('apikota');
                  for(var i = 0; i < len; i++) {
                      var opt = document.createElement('option');
                      opt.innerHTML = res[i]['nama_kabkota'];
                      opt.value = res[i]['nama_kabkota'];
                      sel.appendChild(opt);
                      // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                  }
              }
          });
      });
  
      $('#apikota').change(function() {
          
          $.ajax({
              url: "/api/kota/"+this.value,
              type: 'GET',
              dataType: 'json', // added data type
              success: function(res) {
                  $("#apikecamatan").val("").find('option').remove();
                  $("#apidesa").val("").find('option').remove();
                  $("#apikecamatan").attr('disabled', false);
                  $("#apidesa").attr('disabled', true);
                  $("#apikecamatan").append('<option value="">Pilih</option>');
                  // res.forEach(item => {
                  //     $("#apikota").val(item.nama_kabkota);
                  // });
                  // var ary = res.;  
                  var len = res.length;   
                  var sel = document.getElementById('apikecamatan');
                  for(var i = 0; i < len; i++) {
                      var opt = document.createElement('option');
                      opt.innerHTML = res[i]['kecamatan'];
                      opt.value = res[i]['kecamatan'];
                      sel.appendChild(opt);
                      // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                  }
              }
          });
      });
  
      $('#apikecamatan').change(function() {
          
          $.ajax({
              url: "/api/kecamatan/"+this.value,
              type: 'GET',
              dataType: 'json', // added data type
              success: function(res) {
                  $("#apidesa").val("").find('option').remove();
                  $("#apidesa").attr('disabled', false);
                  $("#apidesa").append('<option value="">Pilih</option>');
                  // res.forEach(item => {
                  //     $("#apikota").val(item.nama_kabkota);
                  // });
                  // var ary = res.;  
                  var len = res.length;   
                  var sel = document.getElementById('apidesa');
                  for(var i = 0; i < len; i++) {
                      var opt = document.createElement('option');
                      opt.innerHTML = res[i]['desa'];
                      opt.value = res[i]['desa'];
                      sel.appendChild(opt);
                      // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                  }
              }
          });
      });

      // ALAMAT DOMISILI
      $('#apiprovinsidom').change(function() {
      
          $.ajax({
              url: "/api/provinsi/"+this.value,
              type: 'GET',
              dataType: 'json', // added data type
              success: function(res) {
                  // var valprovinsi = $("#apiprovinsi").val();
                  $("#apikotadom").val("").find('option').remove();
                  $("#apikecamatandom").val("").find('option').remove();
                  $("#apidesadom").val("").find('option').remove();
                  $("#apikotadom").attr('disabled', false);
                  $("#apikecamatandom").attr('disabled', true);
                  $("#apidesadom").attr('disabled', true);
                  $("#apikotadom").append('<option value="">Pilih</option>');
                  // res.forEach(item => {
                  //     $("#apikota").val(item.nama_kabkota);
                  // });
                  // var ary = res.;  
                  var len = res.length;   
                  var sel = document.getElementById('apikotadom');
                  for(var i = 0; i < len; i++) {
                      var opt = document.createElement('option');
                      opt.innerHTML = res[i]['nama_kabkota'];
                      opt.value = res[i]['nama_kabkota'];
                      sel.appendChild(opt);
                      // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                  }
              }
          });
      });
  
      $('#apikotadom').change(function() {
          
          $.ajax({
              url: "/api/kota/"+this.value,
              type: 'GET',
              dataType: 'json', // added data type
              success: function(res) {
                  $("#apikecamatandom").val("").find('option').remove();
                  $("#apidesadom").val("").find('option').remove();
                  $("#apikecamatandom").attr('disabled', false);
                  $("#apidesadom").attr('disabled', true);
                  $("#apikecamatandom").append('<option value="">Pilih</option>');
                  // res.forEach(item => {
                  //     $("#apikota").val(item.nama_kabkota);
                  // });
                  // var ary = res.;  
                  var len = res.length;   
                  var sel = document.getElementById('apikecamatandom');
                  for(var i = 0; i < len; i++) {
                      var opt = document.createElement('option');
                      opt.innerHTML = res[i]['kecamatan'];
                      opt.value = res[i]['kecamatan'];
                      sel.appendChild(opt);
                      // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                  }
              }
          });
      });
  
      $('#apikecamatandom').change(function() { 
          
          $.ajax({
              url: "/api/kecamatan/"+this.value,
              type: 'GET',
              dataType: 'json', // added data type
              success: function(res) {
                  $("#apidesadom").val("").find('option').remove();
                  $("#apidesadom").attr('disabled', false);
                  $("#apidesadom").append('<option value="">Pilih</option>');
                  // res.forEach(item => {
                  //     $("#apikota").val(item.nama_kabkota);
                  // });
                  // var ary = res.;  
                  var len = res.length;   
                  var sel = document.getElementById('apidesadom');
                  for(var i = 0; i < len; i++) {
                      var opt = document.createElement('option');
                      opt.innerHTML = res[i]['desa'];
                      opt.value = res[i]['desa'];
                      sel.appendChild(opt);
                      // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                  }
              }
          });
      });

    // VALIDASI CHECKBOX ALAMAT
    $("#checkbox_alamat").on('change', function() {
      if ($(this).is(':checked')) {
        $("#apiprovinsidom").val("").find('selected').remove();
        $("#apikotadom").val("").find('selected').remove();
        $("#apikecamatandom").val("").find('selected').remove();
        $("#apidesadom").val("").find('selected').remove();
        // $('#apiprovinsidom').prop('disabled', true); 
        // $('#apikotadom').prop('disabled', true); 
        // $('#apikecamatandom').prop('disabled', true); 
        // $('#apidesadom').prop('disabled', true); 
        // $('#alamat_dom').prop('disabled', true); 
        $("#hidedom").removeClass('show');
        $(this).val("0");
      } else {
          // $('#alamatdomisili').prop('hidden', false);
        $('#apiprovinsidom').prop('disabled', false); 
        $('#apikotadom').prop('disabled', true); 
        $('#apikecamatandom').prop('disabled', true); 
        $('#apidesadom').prop('disabled', true); 
        $("#hidedom").addClass('show');
        $(this).val("1");
      }
    });

  });
</script>
<script>
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#upload").change(function(){
      readURL(this);
  });

  function saveData() {
    let x = document.forms["formUpdate"]["nik"].value;
    if (x == "") {
      iziToast.error({
        title: 'Error!',
        message: 'NIK kosong',
        position: 'topRight'
      });
      return false;
    } else {
      $("#formUpdate").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");

        return true;
      });
    }
  }
</script>
@endsection