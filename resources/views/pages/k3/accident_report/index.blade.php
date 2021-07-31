@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">
<style>
    
</style>
<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-list-alt nav-icon text-info">

            </i> Laporan Kecelakaan Kerja

            <span class="pull-right badge badge-warning" style="margin-top:4px;text-transform: capitalize">
                Akses {{ Auth::user()->roles->first()->name }}
            </span>
            
        </div>
        <div class="card-body">
            @can('accident_report')
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambahbayi">
                            <i class="fa-fw fas fa-plus-square nav-icon">
    
                            </i>
                            Tambah Laporan
                        </a>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table id="skl" class="table table-striped display">
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
                                            <button type="button" class="btn btn-dark btn-sm text-white" data-toggle="modal" data-target="#verifikasi{{ $item->id }}">Verifikasi</button>
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
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#show{{ $item->id }}"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        @else
                                            @if ($item->verifikasi == null)
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#show{{ $item->id }}"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                            @else
                                                <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                <button type="button" class="btn btn-secondary btn-sm"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                            @endif
                                        @endrole
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    @role('k3')
                                        <td colspan=7>Tidak Ada Data</td>
                                    @else
                                        <td colspan=6>Tidak Ada Data</td>
                                    @endrole
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
            @endcan
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambahbayi" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Laporan Kecelakaan Kerja <span class="badge badge-primary">Accident Report</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('accidentreport.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="container">
                        <h4>A. Identifikasi Kecelakaan</h4><hr>
                        <div class="row">
                            <div class="col">
                                <label>Waktu :</label>
                                <input type="datetime-local" name="tgl" id="tgl" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Lokasi : </label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Jenis Kecelakaan : </label>
                                <select onchange="jenisBtn()" class="custom-select" name="jenis" id="jenis" required>
                                    <option hidden>Pilih</option>
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
                        </div>
                        <br>
                        <div id="lainlain" class="row" hidden>
                            <div class="col">
                                <label>Lain-lain :</label>
                                <textarea class="form-control" name="lain1" id="lain1" placeholder="" maxlength="190" rows="8"></textarea><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Kronologi Kecelakaan :</label>
                                <textarea class="form-control" name="kronologi" id="kronologi1" placeholder="" maxlength="190" rows="8"></textarea>
                                <span class="help-block">
                                    <p id="maxkronologi1" class="help-block "></p>
                                </span>  
                            </div>
                        </div>
                        <hr><h4>B. Kerugian</h4><hr>
                        <div class="row">
                            <div class="col">
                                <label>Kerugian Pada Manusia : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa-fw fas fa-question nav-icon text-light"></i>
                                        </button>
                                    </div>
                                    <select onchange="infoBtn()" class="custom-select" name="kerugian" id="kerugian" required>
                                        <option hidden>Pilih</option>
                                        <option value="1">Tak Cedera</option>
                                        <option value="2">Cedera Ringan</option>
                                        <option value="3">Cedera Sedang</option>
                                        <option value="4">Cedera Berat</option>
                                        <option value="5">Meninggal/Fatal</option>
                                    </select>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <p>
                                            - <b>Tak Cedera</b> (Tidak ada cedera dan tidak ada hilang hari kerja) <br>
                                            - <b>Cedera Ringan</b> (Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang hari kerja) <br>
                                            - <b>Cedera Sedang</b> (Mengalami cedera yang memerlukan pertolongan medis tapi adanya hilang hari kerja) <br>
                                            - <b>Cedera Berat</b> (Mengalami cedera yang memerlukan pertolongan medis dan atau rujukan medis, cacat sementara dan adanya hilang hari kerja) <br>
                                            - <b>Meninggal/Fatal</b> (Mengalami cacat permanen atau kematian)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Nama Korban : </label>
                                <input type="text" name="korban" id="korban" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir :</label>
                                <input type="date" name="lahir" id="lahir" class="form-control" placeholder="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-control" required>
                                      <option hidden>Pilih</option>
                                      <option value="laki-laki">Laki-laki</option>
                                      <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label>Unit :</label>
                                @role('k3')
                                    <select class="custom-select" name="unit" id="unit" required>
                                        <option hidden>Pilih</option>
                                        @foreach($list['unit'] as $name => $item)
                                            <option value="{{ $name }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" name="unit" class="form-control" value="{{ Auth::user()->roles->first()->name }}" disabled>
                                    <input type="text" name="unit" class="form-control" value="{{ Auth::user()->roles->first()->name }}" hidden>
                                @endrole
                            </div>
                        </div>
                        <label>Bila cedera / cacat, anggota tubuh mana yang terkena? </label>
                        <input type="text" name="cedera" id="cedera" class="form-control" placeholder="">
                        <br>
                        <label>Penanganan </label>
                        <textarea class="form-control" name="penanganan" id="penanganan1" placeholder="" maxlength="190" rows="8"></textarea>
                        <span class="help-block">
                            <p id="maxpenanganan1" class="help-block "></p>
                        </span>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>Kerugian Aset/Material/Proses : </label>
                                <input type="text" name="k_aset" id="k_aset" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Kerugian Lingkungan : </label>
                                <input type="text" name="k_lingkungan" id="k_lingkungan" class="form-control" placeholder="">
                            </div>
                        </div>
                        <hr><h4>C. Investigasi Kecelakaan</h4><hr>
                        <h5>1. Penyebab Langsung</h5>
                        <div class="row">
                            <div class="col">
                                <label>Tindakan Tidak Aman <i>(Unsafe Action)</i> : </label>
                                <input type="text" name="tta" id="tta" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Kondisi Tidak Aman <i>(Unsafe Condition)</i> : </label>
                                <input type="text" name="kta" id="kta" class="form-control" placeholder="">
                            </div>
                        </div>
                        <br>
                        <h5>2. Penyebab Dasar</h5>
                        <div class="row">
                            <div class="col">
                                <label>Faktor Personal : </label>
                                <input type="text" name="f_personal" id="f_personal" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Faktor Pekerjaan : </label>
                                <input type="text" name="f_pekerjaan" id="f_pekerjaan" class="form-control" placeholder="">
                            </div>
                        </div>
                        <br>
                        <h5>3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Peralatan Kerja : </label>
                                <input type="text" name="p_kerja" id="p_kerja" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Benda Bergerak : </label>
                                <input type="text" name="benda_bergerak" id="benda_bergerak" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Mesin : </label>
                                <input type="text" name="mesin" id="mesin" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Bejana Tekan : </label>
                                <input type="text" name="bejana_tekan" id="bejana_tekan" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Material : </label>
                                <input type="text" name="material" id="material" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Alat Listrik : </label>
                                <input type="text" name="alat_listrik" id="alat_listrik" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Alat Berat : </label>
                                <input type="text" name="alat_berat" id="alat_berat" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Radiasi : </label>
                                <input type="text" name="radiasi" id="radiasi" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Kendaraan : </label>
                                <input type="text" name="kendaraan" id="kendaraan" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Binatang : </label>
                                <input type="text" name="binatang" id="binatang" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Lain-lain : </label>
                                <textarea class="form-control" name="lain2" id="lain2" placeholder="" maxlength="190" rows="8"></textarea>
                            </div>
                        </div>
                        <hr><h4>D. Rencana Tindakan Perbaikan</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Rencana Tindakan : </label>
                                <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder="" maxlength="190" rows="8"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label>Target Waktu : </label>
                                <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder="" maxlength="190" rows="8"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label>Wewenang : </label>
                                <textarea class="form-control" name="wewenang" id="wewenang" placeholder="" maxlength="190" rows="8"></textarea>
                            </div>
                        </div>
                        <hr>
                        <label>Lampiran : </label>
                        <input type="file" name="file">
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Laporan Kecelakaan Kerja <span class="badge badge-primary">Accident Report</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('accidentreport.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="container">
                        <h4>A. Identifikasi Kecelakaan</h4><hr>
                        <div class="row">
                            <div class="col">
                                <label>Waktu :</label>
                                <input type="datetime-local" name="tgl" id="tgl" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->tgl)); ?>" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Lokasi : </label>
                                <input type="text" name="lokasi" id="lokasi" value="{{ $item->lokasi }}" class="form-control" placeholder="">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Jenis Kecelakaan : </label>
                                <select onchange="jenisBtn2()" class="custom-select" name="jenis" id="jenis2" required>
                                    <option hidden>Pilih</option>
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
                        </div>
                        <br>
                        <div id="lainlain2" class="row" hidden>
                            <div class="col">
                                <label>Lain-lain :</label>
                                <textarea class="form-control" name="lain1" id="lain1" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->lain1); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Kronologi Kecelakaan :</label>
                                <textarea class="form-control" name="kronologi" id="kronologi2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->kronologi); ?></textarea>
                                <span class="help-block">
                                    <p id="maxkronologi2" class="help-block "></p>
                                </span>
                            </div>
                        </div>
                        <hr><h4>B. Kerugian</h4><hr>
                        <div class="row">
                            <div class="col">
                                <label>Kerugian Pada Manusia : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                            <i class="fa-fw fas fa-question nav-icon text-light"></i>
                                        </button>
                                    </div>
                                    <select onchange="infoBtn()" class="custom-select" name="kerugian" id="kerugian" required>
                                        <option hidden>Pilih</option>
                                        <option value="1" @if ($item->kerugian == '1') echo selected @endif>Tak Cedera</option>
                                        <option value="2" @if ($item->kerugian == '2') echo selected @endif>Cedera Ringan</option>
                                        <option value="3" @if ($item->kerugian == '3') echo selected @endif>Cedera Sedang</option>
                                        <option value="4" @if ($item->kerugian == '4') echo selected @endif>Cedera Berat</option>
                                        <option value="5" @if ($item->kerugian == '5') echo selected @endif>Meninggal/Fatal</option>
                                    </select>
                                </div>
                                <div class="collapse" id="collapseExample2">
                                    <div class="card card-body">
                                        <p>
                                            - <b>Tak Cedera</b> (Tidak ada cedera dan tidak ada hilang hari kerja) <br>
                                            - <b>Cedera Ringan</b> (Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang hari kerja) <br>
                                            - <b>Cedera Sedang</b> (Mengalami cedera yang memerlukan pertolongan medis tapi adanya hilang hari kerja) <br>
                                            - <b>Cedera Berat</b> (Mengalami cedera yang memerlukan pertolongan medis dan atau rujukan medis, cacat sementara dan adanya hilang hari kerja) <br>
                                            - <b>Meninggal/Fatal</b> (Mengalami cacat permanen atau kematian)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Nama Korban : </label>
                                <input type="text" name="korban" id="korban" value="{{ $item->korban }}" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir :</label>
                                <input type="date" name="lahir" id="lahir" value="<?php echo strftime('%Y-%m-%d', strtotime($item->lahir)); ?>" class="form-control" placeholder="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-control" required>
                                      <option hidden>Pilih</option>
                                      <option value="laki-laki" @if ($item->jk == 'laki-laki') echo selected @endif>Laki-laki</option>
                                      <option value="perempuan" @if ($item->jk == 'perempuan') echo selected @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label>Unit :</label>
                                @role('k3')
                                    <select class="custom-select" name="unit" id="unit" required>
                                        <option hidden>Pilih</option>
                                        @foreach($list['unit'] as $name => $key)
                                            <option value="{{ $name }}" @if ($item->unit == $name) echo selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" name="unit" class="form-control" value="{{ $item->unit }}" disabled>
                                    <input type="text" name="unit" class="form-control" value="{{ $item->unit }}" hidden>
                                @endrole
                            </div>
                        </div>
                        <label>Bila cedera / cacat, anggota tubuh mana yang terkena? </label>
                        <input type="text" name="cedera" id="cedera" value="{{ $item->cedera }}" class="form-control" placeholder="">
                        <br>
                        <label>Penanganan </label>
                        <textarea class="form-control" name="penanganan" id="penanganan2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->penanganan); ?></textarea>
                        <span class="help-block">
                            <p id="maxpenanganan2" class="help-block "></p>
                        </span>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>Kerugian Aset/Material/Proses : </label>
                                <input type="text" name="k_aset" id="k_aset" value="{{ $item->k_aset }}" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Kerugian Lingkungan : </label>
                                <input type="text" name="k_lingkungan" id="k_lingkungan" value="{{ $item->k_lingkungan }}" class="form-control" placeholder="">
                            </div>
                        </div>
                        <hr><h4>C. Investigasi Kecelakaan</h4><hr>
                        <h5>1. Penyebab Langsung</h5>
                        <div class="row">
                            <div class="col">
                                <label>Tindakan Tidak Aman <i>(Unsafe Action)</i> : </label>
                                <input type="text" name="tta" id="tta" value="{{ $item->tta }}" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Kondisi Tidak Aman <i>(Unsafe Condition)</i> : </label>
                                <input type="text" name="kta" id="kta" value="{{ $item->kta }}" class="form-control" placeholder="">
                            </div>
                        </div>
                        <br>
                        <h5>2. Penyebab Dasar</h5>
                        <div class="row">
                            <div class="col">
                                <label>Faktor Personal : </label>
                                <input type="text" name="f_personal" id="f_personal" value="{{ $item->f_personal }}" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Faktor Pekerjaan : </label>
                                <input type="text" name="f_pekerjaan" id="f_pekerjaan" value="{{ $item->f_pekerjaan }}" class="form-control" placeholder="">
                            </div>
                        </div>
                        <br>
                        <h5>3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Peralatan Kerja : </label>
                                <input type="text" name="p_kerja" id="p_kerja" value="{{ $item->p_kerja }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Benda Bergerak : </label>
                                <input type="text" name="benda_bergerak" id="benda_bergerak" value="{{ $item->benda_bergerak }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Mesin : </label>
                                <input type="text" name="mesin" id="mesin" value="{{ $item->mesin }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Bejana Tekan : </label>
                                <input type="text" name="bejana_tekan" id="bejana_tekan" value="{{ $item->bejana_tekan }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Material : </label>
                                <input type="text" name="material" id="material" value="{{ $item->material }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Alat Listrik : </label>
                                <input type="text" name="alat_listrik" id="alat_listrik" value="{{ $item->alat_listrik }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Alat Berat : </label>
                                <input type="text" name="alat_berat" id="alat_berat" value="{{ $item->alat_berat }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Radiasi : </label>
                                <input type="text" name="radiasi" id="radiasi" value="{{ $item->radiasi }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Kendaraan : </label>
                                <input type="text" name="kendaraan" id="kendaraan" value="{{ $item->kendaraan }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label>Binatang : </label>
                                <input type="text" name="binatang" id="binatang" value="{{ $item->binatang }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Lain-lain : </label>
                                <textarea class="form-control" name="lain2" id="lain2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->lain2); ?></textarea>
                            </div>
                        </div>
                        <hr><h4>D. Rencana Tindakan Perbaikan</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Rencana Tindakan : </label>
                                <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->r_tindakan); ?></textarea>
                            </div>
                            <div class="col-md-3">
                                <label>Target Waktu : </label>
                                <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->t_waktu); ?></textarea>
                            </div>
                            <div class="col-md-3">
                                <label>Wewenang : </label>
                                <textarea class="form-control" name="wewenang" id="wewenang" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->wewenang); ?></textarea>
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

                <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal" tabindex="-1" id="show{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
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
<div class="modal" id="verifikasi{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Lampiran <a style="text-transform: capitalize"><b>{{ $item->user }}</b></a> - Unit {{ $item->unit }}
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p><b>nb.</b> Apakah anda yakin sudah menverifikasi Laporan <b>{{ $item->user }}</b> ?<br>
            Setelah anda menekan Tombol Verifikasi, anda tidak bisa lagi mengubah laporan. <br><br>
            Untuk penanganan lebih lanjut, silakan hubungi Staff-IT. Terima Kasih.<i class="fa-fw fas fa-smile nav-icon"></i>
            </p>
        </div>
        <div class="modal-footer">
            @if ($item->verifikasi == null)
                <form action="{{ route('accidentreport.check', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fa-fw fas fa-check-square nav-icon"></i> Verifikasi</button>
                </form>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#skl').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf','colvis'
            ],
            order: [[ 4, "desc" ]]
        }
    );
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