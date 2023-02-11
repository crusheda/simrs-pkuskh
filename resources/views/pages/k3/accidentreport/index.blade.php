@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">K3 /</span> Laporan Kecelakaan Kerja
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

<div class="card card-action mb-5">
  {{-- <div class="card-alert"></div> --}}
  <div class="card-header">
    <div class="card-action-title">
      <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah">
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
  <hr style="margin-top: -5px">
  <div class="collapse show">
    <div class="card-datatable table-responsive">
      <table id="table" class="table table-striped display">
          <thead>
              <tr class="text-center">
                  @role('k3')
                      <th>VERIFY</th>
                  @endrole
                  <th>KORBAN</th>
                  <th>UNIT</th>
                  <th>LOKASI</th>
                  <th>TGL</th>
                  <th>VERIFIED</th>
                  <th>AKSI</th>
              </tr>
          </thead>
          <tbody style="text-transform: capitalize">
              @if(count($list['show']) > 0)
              {{-- <div hidden>{{ $id = 1 }}</div> --}}
              @foreach($list['show'] as $item)
              <tr>
                  {{-- <td>{{ $id++ }}</td> --}}
                  @role('k3')
                  <td>
                      <center>
                          @if ($item->verifikasi == null)
                              <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#verifikasi{{ $item->id }}">Verifikasi</button>
                          @else
                              <button type="button" class="btn btn-secondary btn-sm text-white" disabled>Sudah di Verifikasi</button>
                          @endif
                      </center>
                  </td>
                  @endrole
                  <td>{{ $item->korban }}</td>
                  <td>{{ $item->unit }}</td>
                  <td>{{ $item->lokasi }}</td>
                  <td>{{ $item->tgl }}</td>
                  @if ($item->verifikasi == null)
                      <td style="text-align: center"><span class="badge badge-pill badge-dark">Sedang Diverifikasi</span></td>
                  @else
                      <td style="text-align: center">{{ $item->verifikasi }}</td>
                  @endif
                  <td>
                      <center>
                          @role('k3')
                            <div class="btn-group">
                              <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#show{{ $item->id }}"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                            </div>
                          @else
                              @if ($item->verifikasi == null)
                                <div class="btn-group">
                                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                  <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#show{{ $item->id }}"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                </div>
                              @else
                                <div class="btn-group">
                                  <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                  <button type="button" class="btn btn-secondary btn-sm"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                  <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                </div>
                              @endif
                          @endrole
                      </center>
                  </td>
              </tr>
              @endforeach
              @endif
          </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Form Tambah
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('accidentreport.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="container">
                        <h4>A. Identifikasi Kecelakaan</h4><hr>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Waktu :</label>
                                <input type="text" class="form-control flatpickrtime" name="tgl" placeholder="YYYY-MM-DD HH:MM" required>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Lokasi : </label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                          <label>Jenis Kecelakaan : </label>
                          <select onchange="jenisBtn()" class="select2 form-select" name="jenis" id="jenis" required>
                              <option value="">Pilih</option>
                              <option value="1">Menabrak</option>
                              <option value="2">Tertabrak</option>
                              <option value="3">Terperangkap</option>
                              <option value="4">Terbentur / Terpukul</option>
                              <option value="5">Tergelincir</option>
                              <option value="6">Terjepit</option>
                              <option value="7">Tersangkut</option>
                              <option value="8">Tertimbun</option>
                              <option value="9">Terhirup</option>
                              <option value="10">Tenggelam</option>
                              <option value="11">Jatuh dari ketinggian yang sama</option>
                              <option value="12">Jatuh dari ketinggian yang berbeda</option>
                              <option value="13">Kontak dengan (Arus Listrik, Suhu Panas, Suhu Dingin, Terpapar Radiasi, Bahan Kimia Berbahaya)</option>
                              <option value="14">Lain-lain</option>
                          </select>
                        </div>
                        <div id="lainlain" class="row" hidden>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Lain-lain :</label>
                                <textarea class="form-control" name="lain1" id="lain1" placeholder="" maxlength="190" rows="8"></textarea>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kronologi Kecelakaan :</label>
                                <textarea class="form-control" name="kronologi" id="kronologi1" placeholder="" maxlength="190" rows="8"></textarea>
                                <span class="help-block">
                                    <p id="maxkronologi1" class="help-block "></p>
                                </span>
                              </div>
                            </div>
                        </div>
                        <h4>B. Kerugian</h4><hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                  <label>Kerugian Pada Manusia : </label>
                                  <button class="btn btn-xs btn-outline-dark" type="button" data-bs-toggle="collapse" href="#lihat" role="button" aria-expanded="false" aria-controls="lihat">Lihat</button>
                                  <select onchange="infoBtn()" class="select2 form-select" name="kerugian" id="kerugian" required>
                                      <option value="">Pilih</option>
                                      <option value="1">Tak Cedera</option>
                                      <option value="2">Cedera Ringan</option>
                                      <option value="3">Cedera Sedang</option>
                                      <option value="4">Cedera Berat</option>
                                      <option value="5">Meninggal/Fatal</option>
                                  </select>
                                  <div id="defaultFormControlHelp" class="form-text">Tombol Lihat untuk melihat Keterangan</div>
                                </div>
                                <div class="collapse" id="lihat">
                                  <div class="d-grid d-sm-flex p-3 border">
                                    <div class="table-responsive text-nowrap mb-3">
                                      <table class="table table-borderless">
                                        <tbody>
                                          <tr>
                                            <td>Tak Cedera</td>
                                            <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Tidak ada cedera dan tidak ada hilang hari kerja</td>
                                          </tr>
                                          <tr>
                                            <td>Cedera Ringan</td>
                                            <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang hari kerja</td>
                                          </tr>
                                          <tr>
                                            <td>Cedera Sedang</td>
                                            <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cedera yang memerlukan pertolongan medis tapi adanya hilang hari kerja</td>
                                          </tr>
                                          <tr>
                                            <td>Cedera Berat</td>
                                            <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cedera yang memerlukan pertolongan medis dan atau rujukan medis, cacat sementara dan adanya hilang hari kerja</td>
                                          </tr>
                                          <tr>
                                            <td>Meninggal/Fatal</td>
                                            <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cacat permanen atau kematian</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Nama Korban : </label>
                                <input type="text" name="korban" id="korban" class="form-control" placeholder="" required>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Tanggal Lahir :</label>
                                <input type="text" name="lahir" class="form-control flatpickr" placeholder="YYYY-MM-DD">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="select2 form-select" required>
                                      <option value="">Pilih</option>
                                      <option value="laki-laki">Laki-laki</option>
                                      <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label>Unit :</label>
                                @role('k3')
                                  <div class="form-group mb-3">
                                    <select class="select2 form-select" name="unit" id="unit" required>
                                        <option value="">Pilih</option>
                                        @foreach($list['unit'] as $name => $item)
                                            <option value="{{ $name }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                @else
                                    <input type="text" name="unit" class="form-control" value="{{ Auth::user()->roles->first()->name }}" disabled>
                                    <input type="text" name="unit" class="form-control" value="{{ Auth::user()->roles->first()->name }}" hidden>
                                @endrole
                            </div>
                        </div>
                        <div class="form-group mb-3">
                          <label>Bila cedera / cacat, anggota tubuh mana yang terkena? </label>
                          <input type="text" name="cedera" id="cedera" class="form-control" placeholder="">
                        </div>
                        <div class="form-group mb-3">
                          <label>Penanganan </label>
                          <textarea class="form-control" name="penanganan" id="penanganan1" placeholder="" maxlength="190" rows="8"></textarea>
                          <span class="help-block">
                              <p id="maxpenanganan1" class="help-block "></p>
                          </span>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kerugian Aset/Material/Proses : </label>
                                <input type="text" name="k_aset" id="k_aset" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kerugian Lingkungan : </label>
                                <input type="text" name="k_lingkungan" id="k_lingkungan" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <h4>C. Investigasi Kecelakaan</h4><hr>
                        <h5>1. Penyebab Langsung</h5>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Tindakan Tidak Aman <i>(Unsafe Action)</i> : </label>
                                <input type="text" name="tta" id="tta" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kondisi Tidak Aman <i>(Unsafe Condition)</i> : </label>
                                <input type="text" name="kta" id="kta" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <br>
                        <h5>2. Penyebab Dasar</h5>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Faktor Personal : </label>
                                <input type="text" name="f_personal" id="f_personal" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Faktor Pekerjaan : </label>
                                <input type="text" name="f_pekerjaan" id="f_pekerjaan" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <br>
                        <h5>3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h5>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Peralatan Kerja : </label>
                                <input type="text" name="p_kerja" id="p_kerja" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Benda Bergerak : </label>
                                <input type="text" name="benda_bergerak" id="benda_bergerak" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Mesin : </label>
                                <input type="text" name="mesin" id="mesin" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Bejana Tekan : </label>
                                <input type="text" name="bejana_tekan" id="bejana_tekan" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Material : </label>
                                <input type="text" name="material" id="material" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Alat Listrik : </label>
                                <input type="text" name="alat_listrik" id="alat_listrik" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Alat Berat : </label>
                                <input type="text" name="alat_berat" id="alat_berat" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Radiasi : </label>
                                <input type="text" name="radiasi" id="radiasi" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Kendaraan : </label>
                                <input type="text" name="kendaraan" id="kendaraan" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Binatang : </label>
                                <input type="text" name="binatang" id="binatang" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group mb-3">
                                <label>Lain-lain : </label>
                                <textarea class="form-control" name="lain2" id="lain2" placeholder="" maxlength="190" rows="8"></textarea>
                              </div>
                            </div>
                        </div>
                        <h4>D. Rencana Tindakan Perbaikan</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Rencana Tindakan : </label>
                                <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder="" maxlength="190" rows="8"></textarea>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group mb-3">
                                <label>Target Waktu : </label>
                                <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder="" maxlength="190" rows="8"></textarea>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group mb-3">
                                <label>Wewenang : </label>
                                <textarea class="form-control" name="wewenang" id="wewenang" placeholder="" maxlength="190" rows="8"></textarea>
                              </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                          <label>Lampiran : </label>
                          <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Form Ubah
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('accidentreport.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="container">
                        <h4>A. Identifikasi Kecelakaan</h4><hr>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Waktu :</label>
                                <input type="text" name="tgl" value="{{ $item->tgl }}" class="form-control flatpickrtime" placeholder="YYYY-MM-DD HH:MM">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Lokasi : </label>
                                <input type="text" name="lokasi" id="lokasi" value="{{ $item->lokasi }}" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                          <label>Jenis Kecelakaan : </label>
                          <select onchange="jenisBtn2()" class="form-select" name="jenis" id="jenis2" required>
                              <option value="">Pilih</option>
                              <option value="1" @if ($item->jenis == '1') echo selected @endif>Menabrak</option>
                              <option value="2" @if ($item->jenis == '2') echo selected @endif>Tertabrak</option>
                              <option value="3" @if ($item->jenis == '3') echo selected @endif>Terperangkap</option>
                              <option value="4" @if ($item->jenis == '4') echo selected @endif>Terbentur / Terpukul</option>
                              <option value="5" @if ($item->jenis == '5') echo selected @endif>Tergelincir</option>
                              <option value="6" @if ($item->jenis == '6') echo selected @endif>Terjepit</option>
                              <option value="7" @if ($item->jenis == '7') echo selected @endif>Tersangkut</option>
                              <option value="8" @if ($item->jenis == '8') echo selected @endif>Tertimbun</option>
                              <option value="9" @if ($item->jenis == '9') echo selected @endif>Terhirup</option>
                              <option value="10" @if ($item->jenis == '10') echo selected @endif>Tenggelam</option>
                              <option value="11" @if ($item->jenis == '11') echo selected @endif>Jatuh dari ketinggian yang sama</option>
                              <option value="12" @if ($item->jenis == '12') echo selected @endif>Jatuh dari ketinggian yang berbeda</option>
                              <option value="13" @if ($item->jenis == '13') echo selected @endif>Kontak dengan (Arus Listrik, Suhu Panas, Suhu Dingin, Terpapar Radiasi, Bahan Kimia Berbahaya)</option>
                              <option value="14" @if ($item->jenis == '14') echo selected @endif>Lain-lain</option>
                          </select>
                        </div>
                        <div id="lainlain2" class="row" hidden>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Lain-lain :</label>
                                <textarea class="form-control" name="lain1" id="lain1" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->lain1); ?></textarea>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kronologi Kecelakaan :</label>
                                <textarea class="form-control" name="kronologi" id="kronologi2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->kronologi); ?></textarea>
                                <span class="help-block">
                                    <p id="maxkronologi2" class="help-block "></p>
                                </span>
                              </div>
                            </div>
                        </div>
                        <h4>B. Kerugian</h4><hr>
                        <div class="form-group mb-3">
                          <label>Kerugian Pada Manusia : </label>
                          <button class="btn btn-xs btn-outline-dark" type="button" data-bs-toggle="collapse" href="#lihatEdit" role="button" aria-expanded="false" aria-controls="lihatEdit">Lihat</button>
                          <select onchange="infoBtn()" class="form-select" name="kerugian" id="kerugian2" required>
                              <option value="">Pilih</option>
                              <option value="1" @if ($item->kerugian == '1') echo selected @endif>Tak Cedera</option>
                              <option value="2" @if ($item->kerugian == '2') echo selected @endif>Cedera Ringan</option>
                              <option value="3" @if ($item->kerugian == '3') echo selected @endif>Cedera Sedang</option>
                              <option value="4" @if ($item->kerugian == '4') echo selected @endif>Cedera Berat</option>
                              <option value="5" @if ($item->kerugian == '5') echo selected @endif>Meninggal/Fatal</option>
                          </select>
                          <div id="defaultFormControlHelp" class="form-text">Tombol Lihat untuk melihat Keterangan</div>
                        </div>
                        <div class="collapse" id="lihatEdit">
                          <div class="d-grid d-sm-flex p-3 border">
                            <div class="table-responsive text-nowrap mb-3">
                              <table class="table table-borderless">
                                <tbody>
                                  <tr>
                                    <td>Tak Cedera</td>
                                    <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Tidak ada cedera dan tidak ada hilang hari kerja</td>
                                  </tr>
                                  <tr>
                                    <td>Cedera Ringan</td>
                                    <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang hari kerja</td>
                                  </tr>
                                  <tr>
                                    <td>Cedera Sedang</td>
                                    <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cedera yang memerlukan pertolongan medis tapi adanya hilang hari kerja</td>
                                  </tr>
                                  <tr>
                                    <td>Cedera Berat</td>
                                    <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cedera yang memerlukan pertolongan medis dan atau rujukan medis, cacat sementara dan adanya hilang hari kerja</td>
                                  </tr>
                                  <tr>
                                    <td>Meninggal/Fatal</td>
                                    <td style="word-wrap: break-word;min-width: 160px;white-space:normal;">Mengalami cacat permanen atau kematian</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Nama Korban : </label>
                                <input type="text" name="korban" id="korban" value="{{ $item->korban }}" class="form-control" placeholder="" required>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Tanggal Lahir :</label>
                                <input type="date" name="lahir" value="{{ $item->lahir }}" class="form-control flatpickr" placeholder="YYYY-MM-DD">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-select" required>
                                      <option value="">Pilih</option>
                                      <option value="laki-laki" @if ($item->jk == 'laki-laki') echo selected @endif>Laki-laki</option>
                                      <option value="perempuan" @if ($item->jk == 'perempuan') echo selected @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Unit :</label>
                                @role('k3')
                                    <select class="form-select" name="unit" id="unit" required>
                                        <option value="">Pilih</option>
                                        @foreach($list['unit'] as $name => $key)
                                            <option value="{{ $name }}" @if ($item->unit == $name) echo selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" name="unit" class="form-control disabled" value="{{ $item->unit }}" disabled>
                                    <input type="text" name="unit" class="form-control" value="{{ $item->unit }}" hidden>
                                @endrole
                              </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                          <label>Bila cedera / cacat, anggota tubuh mana yang terkena? </label>
                          <input type="text" name="cedera" id="cedera" value="{{ $item->cedera }}" class="form-control" placeholder="">
                        </div>
                        <div class="form-group mb-3">
                          <label>Penanganan </label>
                          <textarea class="form-control" name="penanganan" id="penanganan2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->penanganan); ?></textarea>
                          <span class="help-block">
                              <p id="maxpenanganan2" class="help-block "></p>
                          </span>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kerugian Aset/Material/Proses : </label>
                                <input type="text" name="k_aset" id="k_aset" value="{{ $item->k_aset }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kerugian Lingkungan : </label>
                                <input type="text" name="k_lingkungan" id="k_lingkungan" value="{{ $item->k_lingkungan }}" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <h4>C. Investigasi Kecelakaan</h4><hr>
                        <h5>1. Penyebab Langsung</h5>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Tindakan Tidak Aman <i>(Unsafe Action)</i> : </label>
                                <input type="text" name="tta" id="tta" value="{{ $item->tta }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Kondisi Tidak Aman <i>(Unsafe Condition)</i> : </label>
                                <input type="text" name="kta" id="kta" value="{{ $item->kta }}" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <h5>2. Penyebab Dasar</h5>
                        <div class="row">
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Faktor Personal : </label>
                                <input type="text" name="f_personal" id="f_personal" value="{{ $item->f_personal }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group mb-3">
                                <label>Faktor Pekerjaan : </label>
                                <input type="text" name="f_pekerjaan" id="f_pekerjaan" value="{{ $item->f_pekerjaan }}" class="form-control" placeholder="">
                              </div>
                            </div>
                        </div>
                        <h5>3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h5>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Peralatan Kerja : </label>
                                <input type="text" name="p_kerja" id="p_kerja" value="{{ $item->p_kerja }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Benda Bergerak : </label>
                                <input type="text" name="benda_bergerak" id="benda_bergerak" value="{{ $item->benda_bergerak }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Mesin : </label>
                                <input type="text" name="mesin" id="mesin" value="{{ $item->mesin }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Bejana Tekan : </label>
                                <input type="text" name="bejana_tekan" id="bejana_tekan" value="{{ $item->bejana_tekan }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Material : </label>
                                <input type="text" name="material" id="material" value="{{ $item->material }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Alat Listrik : </label>
                                <input type="text" name="alat_listrik" id="alat_listrik" value="{{ $item->alat_listrik }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Alat Berat : </label>
                                <input type="text" name="alat_berat" id="alat_berat" value="{{ $item->alat_berat }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Radiasi : </label>
                                <input type="text" name="radiasi" id="radiasi" value="{{ $item->radiasi }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Kendaraan : </label>
                                <input type="text" name="kendaraan" id="kendaraan" value="{{ $item->kendaraan }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Binatang : </label>
                                <input type="text" name="binatang" id="binatang" value="{{ $item->binatang }}" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group mb-3">
                                <label>Lain-lain : </label>
                                <textarea class="form-control" name="lain2" id="lain2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->lain2); ?></textarea>
                              </div>
                            </div>
                        </div>
                        <h4>D. Rencana Tindakan Perbaikan</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label>Rencana Tindakan : </label>
                                <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->r_tindakan); ?></textarea>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group mb-3">
                                <label>Target Waktu : </label>
                                <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->t_waktu); ?></textarea>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group mb-3">
                                <label>Wewenang : </label>
                                <textarea class="form-control" name="wewenang" id="wewenang" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->wewenang); ?></textarea>
                              </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <label>Detail Lampiran : </label>
                            @if ($item->filename == '')
                            -
                            @else
                               <b>{{ $item->title }}</b> ({{Storage::size($item->filename)}} bytes)
                            @endif
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade" tabindex="-1" id="show{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Lampiran Dari <a style="text-transform: capitalize"><b>{{ $item->user }}</b></a>, Unit {{ $item->unit }}. <br>
            @if ($item->filename == '')
                <p><b>File tidak ditemukan / tidak diupload.</b></p>
            @else
                <i class="fa-fw fas fa-angle-right nav-icon"></i>&nbsp;Nama File : {{ $item->title }} <br>
                <i class="fa-fw fas fa-angle-right nav-icon"></i>&nbsp;Ukuran File : {{Storage::size($item->filename)}} bytes.
            @endif
        </div>
        <div class="modal-footer">
            @if ($item->filename == '')
                <button type="button" class="btn btn-secondary" disabled><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Lampiran</button>
            @else
                <button onclick="window.location.href='{{ url('k3/accidentreport/'. $item->id.'/show') }}'" type="button" class="btn btn-success"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Lampiran</button>
            @endif
            @role('k3')
                <a type="button" href="{{ route('accidentreport.cetak', $item->id) }}" class="btn btn-warning text-white">
                    <i class="fa-fw fas fa-print nav-icon"></i> Cetak Word
                </a>
            @endrole
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade" id="verifikasi{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Lampiran <a style="text-transform: capitalize"><b>{{ $item->user }}</b></a> - <kbd>{{ $item->unit }}</kbd>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin sudah menverifikasi Laporan <b>{{ $item->user }}</b> ?<br>
            Setelah anda menekan Tombol Verifikasi, User yang bersangkutan tidak dapat <b>mengubah / menghapus laporan</b> ini.
            </p>
        </div>
        <div class="modal-footer">
            @if ($item->verifikasi == null)
                <form action="{{ route('accidentreport.check', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fa-fw fas fa-check-square nav-icon"></i> Verifikasi</button>
                </form>
            @endif
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Laporan <b>{{ $item->user }}</b> pada {{ $item->updated_at->diffForHumans() }} ?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('accidentreport.destroy', $item->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
  $('#table').DataTable(
    {
      order: [[4, "desc"]],
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
  // SELECT2
  var t = $(".select2");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  });
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
} );
</script>

<script>
    function jenisBtn() {
        var val = document.getElementById("jenis").value;
        if (val != 14) {
            document.getElementById("lainlain").hidden = true;
        }else{
            document.getElementById("lainlain").hidden = false;
        }
    }
</script>

<script>
    function jenisBtn2() {
        var val = document.getElementById("jenis2").value;
        if (val != 14) {
            document.getElementById("lainlain2").hidden = true;
        }else{
            document.getElementById("lainlain2").hidden = false;
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){ 
    $('#maxkronologi1').text('190 Limit Text');
    $('#kronologi1').keydown(function () {
    var max = 190;
    var len = $(this).val().length;
    if (len >= max) {
        $('#maxkronologi1').text('Anda telah mencapai Limit Maksimal.');          
    } 
    else {
        var ch = max - len;
        $('#maxkronologi1').text(ch + ' Limit Text');     
    }
    });    
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){ 
    $('#maxpenanganan1').text('190 Limit Text');
    $('#penanganan1').keydown(function () {
    var max = 190;
    var len = $(this).val().length;
    if (len >= max) {
        $('#maxpenanganan1').text('Anda telah mencapai Limit Maksimal.');          
    } 
    else {
        var ch = max - len;
        $('#maxpenanganan1').text(ch + ' Limit Text');     
    }
    });    
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){ 
    $('#maxpenanganan2').text('190 Limit Text');
    $('#penanganan2').keydown(function () {
    var max = 190;
    var len = $(this).val().length;
    if (len >= max) {
        $('#maxpenanganan2').text('Anda telah mencapai Limit Maksimal.');          
    } 
    else {
        var ch = max - len;
        $('#maxpenanganan2').text(ch + ' Limit Text');     
    }
    });    
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){ 
    $('#maxkronologi2').text('190 Limit Text');
    $('#kronologi2').keydown(function () {
    var max = 190;
    var len = $(this).val().length;
    if (len >= max) {
        $('#maxkronologi2').text('Anda telah mencapai Limit Maksimal.');          
    } 
    else {
        var ch = max - len;
        $('#maxkronologi2').text(ch + ' Limit Text');     
    }
    });    
    });
</script>
@endsection