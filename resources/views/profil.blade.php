@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
    <div class="col-md-3">
        <div class="card">
            @if (empty($list['foto']->filename))
                <img class="card-img-top img-thumbnail" src="{{ url('img/user_unknown.jpg') }}" height="300" alt="Card image cap">
            @else
                <img class="card-img-top img-thumbnail" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" height="300" alt="Card image cap">
            @endif
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Username : <b>{{ $list['user']->name }}</b></li>
              <li class="list-group-item">Email : <b>{{ $list['user']->email }}</b></li>
            </ul>
            <div class="card-body">
                <center><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ubahFoto">Ubah Foto Profil</button></center>
            </div>
        </div>
        <div class="card">
            <ul class="list-group list-group-flush">
                @if (empty($list['showlog'][1]))
                    <li class="list-group-item"><i class="fa-fw fas fa-history nav-icon"></i> Terakhir Login : <b>Riwayat Tidak Ditemukan</b></li>
                @else
                    <li class="list-group-item"><i class="fa-fw fas fa-history nav-icon"></i> Terakhir Login : <b>{{ \Carbon\Carbon::parse($list['showlog'][1]->log_date)->diffForHumans() }}</b></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <h5 class="card-header"><i class="fa-fw fas fa-user nav-icon"></i> Profil Karyawan<kbd style="float: right">ID : {{ $list['user']->id }}</kbd></h5>
            <div class="card-body">
                <form class="form-auth-small" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="number" name="id" value="{{ $list['user']->id }}" hidden>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Username :</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $list['user']->name }}" aria-label="Name" aria-describedby="basic-addon1" disabled>
                                <input type="text" class="form-control" name="name" value="{{ $list['user']->name }}" aria-label="Name" aria-describedby="basic-addon1" hidden>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>NIK :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['user']->nik))
                                    <input type="number" class="form-control is-invalid" name="nik" id="nik" value="{{ $list['user']->nik }}" max="9999999999999999" placeholder="e.g. 331xxxxxxxxxxxxx" autofocus required>
                                    <div class="invalid-feedback">
                                        Tuliskan Nomor Induk Kependudukan Anda.
                                    </div>
                                @else
                                    <input type="number" class="form-control" name="nik" value="{{ $list['user']->nik }}" max="9999999999999999" required>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label>Nama Lengkap + Gelar :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->nama))
                                    <input type="text" class="form-control is-invalid" name="nama" id="nama" aria-label="Username" aria-describedby="basic-addon1" placeholder="e.g. Soenaryo, S.Kep. Ns" required>
                                    <div class="invalid-feedback">
                                        Tuliskan Nama Lengkap Anda.
                                    </div>
                                @else
                                    <input type="text" class="form-control" name="nama" value="{{ $list['showuser']->nama }}" minlength="1" aria-label="Username" aria-describedby="basic-addon1" required>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label>Nama Panggilan :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->nick))
                                    <input type="text" class="form-control is-invalid" name="nick" id="nick" placeholder="e.g. Soenaryo" required>
                                    <div class="invalid-feedback">
                                        Tuliskan Nama Panggilan Anda.
                                    </div>
                                @else
                                    <input type="text" class="form-control" name="nick" value="{{ $list['showuser']->nick }}" minlength="1" aria-label="Username" aria-describedby="basic-addon1" required>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <label>Tempat Lahir :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->temp_lahir))
                                    <input type="text" class="form-control is-invalid" name="temp_lahir" id="temp_lahir" placeholder="e.g. Sukoharjo">
                                    <div class="invalid-feedback">
                                        Tuliskan Nama Tempat Lahir Anda.
                                    </div>
                                @else
                                    <input type="text" class="form-control" name="temp_lahir" value="{{ $list['showuser']->temp_lahir }}" minlength="1">
                                @endif
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <label>Tempat Lahir :</label>
                            <div class="input-group mb-3">
                                <select class="fstdropdown-select" id="temp_lahir" name="temp_lahir" required>
                                    <option selected="selected" value="">Pilih Kota</option>
                                    @foreach($list['nama_kabkota'] as $item)
                                        <option value="{{ $item->nama_kabkota }}" @if ($list['showuser']->temp_lahir == $item->nama_kabkota) echo selected @endif>{{ $item->nama_kabkota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Tanggal Lahir :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->tgl_lahir))
                                    <input type="date" name="tgl_lahir" class="form-control" required>
                                @else
                                    <input type="date" name="tgl_lahir" value="<?php echo strftime('%Y-%m-%d', strtotime($list['showuser']->tgl_lahir)); ?>" class="form-control" required>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Jenis Kelamin :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="jns_kelamin" id="jns_kelamin" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="LAKI-LAKI" @if ($list['showuser']->jns_kelamin == 'LAKI-LAKI') echo selected @endif>LAKI-LAKI</option>
                                    <option value="PEREMPUAN" @if ($list['showuser']->jns_kelamin == 'PEREMPUAN') echo selected @endif>PEREMPUAN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Status Kawin :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="status_kawin" id="status_kawin" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="SUDAH" @if ($list['showuser']->status_kawin == 'SUDAH') echo selected @endif>SUDAH</option>
                                    <option value="BELUM" @if ($list['showuser']->status_kawin == 'BELUM') echo selected @endif>BELUM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: -3px">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->email))
                                    <input type="email" class="form-control is-invalid" name="email" id="email" placeholder="e.g. soenaryo@gmail.com">
                                    <div class="invalid-feedback">
                                        Tuliskan Email Anda.
                                    </div>
                                @else
                                    <input type="email" class="form-control" name="email" value="{{ $list['user']->email }}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Nomor HP / Whatsapp :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->no_hp))
                                    <input type="number" class="form-control is-invalid" name="no_hp" id="no_hp" value="{{ $list['showuser']->no_hp }}" max="9999999999999" placeholder="e.g. 628xxxxxxxxxx" required>
                                    <div class="invalid-feedback">
                                        Tuliskan Nomor HP / Whatsapp Anda.
                                    </div>
                                @else
                                    <input type="number" class="form-control" name="no_hp" value="{{ $list['showuser']->no_hp }}" max="9999999999999" placeholder="e.g. 628xxxxxxxxxx" required>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Instagram :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->ig))
                                    <input type="text" class="form-control is-invalid" name="ig" id="ig" value="{{ $list['showuser']->ig }}" placeholder="e.g. soenaryo_37">
                                    <div class="invalid-feedback">
                                        Tuliskan Instagram Anda.
                                    </div>
                                @else
                                    <input type="text" class="form-control" name="ig" value="{{ $list['showuser']->ig }}" placeholder="e.g. soenaryo_37">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Facebook :</label>
                            <div class="input-group mb-3">
                                @if (empty($list['showuser']->fb))
                                    <input type="text" class="form-control is-invalid" name="fb" id="fb" value="{{ $list['showuser']->fb }}" placeholder="e.g. soenaryo_37">
                                    <div class="invalid-feedback">
                                        Tuliskan Facebook Anda.
                                    </div>
                                @else
                                    <input type="text" class="form-control" name="fb" value="{{ $list['showuser']->fb }}" placeholder="e.g. soenaryo_37">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <h6 class="text-center"><b>Alamat Sesuai KTP</b></h6><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Provinsi :</label>
                                    <select class="form-control" id="apiprovinsi" name="ktp_provinsi">
                                        <option value="" hidden>Pilih Provinsi</option>
                                        @foreach($list['provinsi'] as $item)
                                            <option value="{{ $item->provinsi }}" @if ($item->provinsi == $list['showuser']->ktp_provinsi) echo selected @endif>{{ $item->provinsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kabupaten :</label>
                                    <select class="form-control" aria-label=".form-select-sm example" id="apikota" name="ktp_kabupaten" disabled required>
                                        @if (empty($list['showuser']->ktp_kabupaten))
                                        @else
                                            <option value="{{ $list['showuser']->ktp_kabupaten }}">{{ $list['showuser']->ktp_kabupaten }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kecamatan :</label>
                                    <select class="form-control" aria-label=".form-select-sm example" id="apikecamatan" name="ktp_kecamatan" disabled required>
                                        @if (empty($list['showuser']->ktp_kecamatan))
                                        @else
                                            <option value="{{ $list['showuser']->ktp_kecamatan }}">{{ $list['showuser']->ktp_kecamatan }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kelurahan :</label>
                                    <select class="form-control" aria-label=".form-select-sm example" id="apidesa" name="ktp_kelurahan" disabled required>
                                        @if (empty($list['showuser']->ktp_kelurahan))
                                        @else
                                            <option value="{{ $list['showuser']->ktp_kelurahan }}">{{ $list['showuser']->ktp_kelurahan }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat_ktp" class="control-label">Alamat Lengkap :</label>
                                    <textarea class="form-control" name="alamat_ktp" id="alamat_ktp" placeholder="" maxlength="190" rows="8" required><?php echo htmlspecialchars($list['showuser']->alamat_ktp); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_alamat_ktp" class="help-block "></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        @if (!empty($list['user']->alamat_dom))
                            <input class="form-check-input" type="checkbox" value="1" name="cek_dom" id="checkbox_alamat" style="width: 1.25rem;height: 1.25rem;">
                        @else
                            <input class="form-check-input" type="checkbox" value="0" name="cek_dom" id="checkbox_alamat" style="width: 1.25rem;height: 1.25rem;" checked>
                        @endif
                        <label class="form-check-label" for="checkbox" style="margin-top:4px">
                            &nbsp;&nbsp;Alamat Domisili Sama Dengan Alamat KTP
                        </label>
                    </div><br>
                    <div class="card card-body" id="alamatdomisili" @if (empty($list['user']->alamat_dom)) echo hidden @endif>
                        <h6 class="text-center"><b>Alamat Domisili</b></h6><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Provinsi :</label>
                                    <select class="form-control" id="apiprovinsidom" name="dom_provinsi">
                                        <option id="pilih" value="" hidden>Pilih Provinsi</option>
                                        @foreach($list['provinsi'] as $item)
                                            <option value="{{ $item->provinsi }}" @if ($item->provinsi == $list['showuser']->dom_provinsi) echo selected @endif>{{ $item->provinsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kabupaten :</label>
                                    <select class="form-control" aria-label=".form-select-sm example" id="apikotadom" name="dom_kabupaten" disabled>
                                        @if (empty($list['showuser']->dom_kabupaten))
                                        @else
                                            <option value="{{ $list['showuser']->dom_kabupaten }}">{{ $list['showuser']->dom_kabupaten }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kecamatan :</label>
                                    <select class="form-control" aria-label=".form-select-sm example" id="apikecamatandom" name="dom_kecamatan" disabled>
                                        @if (empty($list['showuser']->dom_kecamatan))
                                        @else
                                            <option value="{{ $list['showuser']->dom_kecamatan }}">{{ $list['showuser']->dom_kecamatan }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kelurahan :</label>
                                    <select class="form-control" aria-label=".form-select-sm example" id="apidesadom" name="dom_kelurahan" disabled>
                                        @if (empty($list['showuser']->dom_kelurahan))
                                        @else
                                            <option value="{{ $list['showuser']->dom_kelurahan }}">{{ $list['showuser']->dom_kelurahan }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Alamat Lengkap :</label>
                                <textarea class="form-control" name="alamat_dom" id="alamat_dom" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($list['showuser']->alamat_dom); ?></textarea>
                                <span class="help-block">
                                    <p id="max_alamat_dom" class="help-block "></p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        <h6 class="text-center"><b>Pendidikan Formal</b></h6><br>
                        <div class="row">
                            {{-- SD --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>SD</b>
                                </label>
                            </div><br><br>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->sd }}" name="sd" id="sd" placeholder="Nama Sekolah Dasar"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_sd }}" name="th_sd" id="th_sd" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- SMP --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>SMP</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->smp }}" name="smp" id="smp" placeholder="Nama Sekolah Menengah Pertama"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_smp }}" name="th_smp" id="th_smp" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- SMA --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>SMA</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->sma }}" name="sma" id="sma" placeholder="Nama Sekolah Menengah Atas"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_sma }}" name="th_sma" id="th_sma" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- D1 --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>D1</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->d1 }}" name="d1" id="d1" placeholder="Nama Diploma Satu"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_d1 }}" name="th_d1" id="th_d1" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- D3 --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>D3</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->d3 }}" name="d3" id="d3" placeholder="Nama Universitas"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_d3 }}" name="th_d3" id="th_d3" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- D4 --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>D4</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->d4 }}" name="d4" id="d4" placeholder="Nama Universitas"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_d4 }}" name="th_d4" id="th_d4" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- S1 --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>S1</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->s1 }}" name="s1" id="s1" placeholder="Nama Universitas"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_s1 }}" name="th_s1" id="th_s1" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- S2 --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>S2</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->s2 }}" name="s2" id="s2" placeholder="Nama Universitas"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_s2 }}" name="th_s2" id="th_s2" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            {{-- S3 --}}
                            <div class="col-md-1">
                                <label class="form-check-label" style="margin-top: 4px">
                                    <b>S3</b>
                                </label><br><br>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{ $list['showuser']->s3 }}" name="s3" id="s3" placeholder="Nama Universitas"><br>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" value="{{ $list['showuser']->th_s3 }}" name="th_s3" id="th_s3" max="9999" placeholder="Tahun Lulus" disabled><br>
                            </div>
                            <div class="col-md-12">
                                <p><i><b>Catatan:</b> <br>Kosongi Kolom Pengisian Bila Tidak Ada.<br>Jika ingin mengisi/merubah Tahun Lulus, lakukan perubahan terlebih dahulu pada kolom Nama Pendidikan.</i></p>
                            </div>
                        </div>
                    </div>
                    @role('kepegawaian')
                    <div class="card card-body">
                        <h6 class="text-center"><b>Dokumen Kepegawaian</b></h6><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label>NIP :</label>
                                <div class="input-group mb-3">
                                    @if (empty($list['showuser']->nip))
                                        <input type="text" class="form-control is-invalid" name="nip" id="nip" placeholder="e.g. 11.1x.xxx">
                                        <div class="invalid-feedback">
                                            Tuliskan Nomor Induk Pegawai Anda.
                                        </div>
                                    @else
                                        <input type="text" class="form-control" name="nip" value="{{ $list['showuser']->nip }}" minlength="1">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Jabatan :</label>
                                <div class="input-group mb-3">
                                    @if (empty($list['showuser']->jabatan))
                                        <input type="text" class="form-control is-invalid" name="jabatan" id="jabatan" placeholder="e.g. Staff">
                                        <div class="invalid-feedback">
                                            Tuliskan Jabatan Anda.
                                        </div>
                                    @else
                                        <input type="text" class="form-control" name="jabatan" value="{{ $list['showuser']->jabatan }}" minlength="1">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Masuk Kerja :</label>
                                <div class="input-group mb-3">
                                    @if (empty($list['showuser']->masuk_kerja))
                                        <input type="date" name="masuk_kerja" class="form-control">
                                    @else
                                        <input type="date" name="masuk_kerja" value="<?php echo strftime('%Y-%m-%d', strtotime($list['showuser']->masuk_kerja)); ?>" class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Nomor STR :</label>
                                <div class="input-group mb-3">
                                    @if (empty($list['showuser']->no_str))
                                        <input type="text" class="form-control is-invalid" name="no_str" id="no_str" placeholder="e.g. 11 1x xxx-xx">
                                        <div class="invalid-feedback">
                                            Tuliskan Nomor Surat Tanda Registrasi Anda.
                                        </div>
                                    @else
                                        <input type="text" class="form-control" name="no_str" value="{{ $list['showuser']->no_str }}" minlength="1">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Masa STR :</label>
                                <div class="input-group mb-3">
                                    @if (empty($list['showuser']->masa_str))
                                        <input type="date" name="masa_str" class="form-control">
                                    @else
                                        <input type="date" name="masa_str" value="<?php echo strftime('%Y-%m-%d', strtotime($list['showuser']->masa_str)); ?>" class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Masa SIP :</label>
                                <div class="input-group mb-3">
                                    @if (empty($list['showuser']->masa_sip))
                                        <input type="date" name="masa_sip" class="form-control">
                                    @else
                                        <input type="date" name="masa_sip" value="<?php echo strftime('%Y-%m-%d', strtotime($list['showuser']->masa_sip)); ?>" class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pengalaman_kerja" class="control-label">Pengalaman Kerja :</label>
                                    <textarea class="form-control" name="pengalaman_kerja" id="pengalaman_kerja" placeholder="" required><?php echo htmlspecialchars($list['user']->pengalaman_kerja); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_pengalaman_kerja" class="help-block "></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else
            
                    <div class="card card-body">
                        <h6 class="text-center"><b>Dokumen Kepegawaian</b></h6><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pengalaman_kerja" class="control-label">Pengalaman Kerja :</label>
                                    <textarea class="form-control" name="pengalaman_kerja" id="pengalaman_kerja" placeholder=""><?php echo htmlspecialchars($list['user']->pengalaman_kerja); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_pengalaman_kerja" class="help-block "></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endrole
                    <div class="card card-body">
                        <h6 class="text-center"><b>Dokumen Medis</b></h6><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="riwayat_penyakit" class="control-label">Riwayat Penyakit :</label>
                                    <textarea class="form-control" name="riwayat_penyakit" id="riwayat_penyakit" placeholder=""><?php echo htmlspecialchars($list['user']->riwayat_penyakit); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_riwayat_penyakit" class="help-block "></p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="riwayat_penyakit_keluarga" class="control-label">Riwayat Penyakit Keluarga :</label>
                                    <textarea class="form-control" name="riwayat_penyakit_keluarga" id="riwayat_penyakit_keluarga" placeholder=""><?php echo htmlspecialchars($list['user']->riwayat_penyakit_keluarga); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_riwayat_penyakit_keluarga" class="help-block "></p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="riwayat_operasi" class="control-label">Riwayat Operasi :</label>
                                    <textarea class="form-control" name="riwayat_operasi" id="riwayat_operasi" placeholder=""><?php echo htmlspecialchars($list['user']->riwayat_operasi); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_riwayat_operasi" class="help-block "></p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="riwayat_penggunaan_obat" class="control-label">Riwayat Penggunaan Obat :</label>
                                    <textarea class="form-control" name="riwayat_penggunaan_obat" id="riwayat_penggunaan_obat" placeholder=""><?php echo htmlspecialchars($list['user']->riwayat_penggunaan_obat); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_riwayat_penggunaan_obat" class="help-block "></p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p><i><b>Catatan: Kosongi Kolom Pengisian Bila Tidak Ada.</b></i></p>
                            </div>
                        </div>
                    </div>

                    <ul class="list-inline" style="float: right">
                        <li class="list-inline-item">
                            <a class="btn btn-warning text-white" href="{{ route('auth.change_password') }}">Ubah Password</a>
                        </li>
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </li>
                    </ul>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ubah Foto Profil -->
<div class="modal fade" id="ubahFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Ubah Foto Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-auth-small" action="{{ action('Admin\profilController@storeImg') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            <div class="modal-body">
                <input type="file" name="file">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
      </div>
    </div>
</div>

<script>
    $(document).ready( function () {

        // VALIDASI INPUT NUMBER
        $('input[type=number][max]:not([max=""])').on('input', function(ev) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
            $this.val(value.substr(0, maxlength));
            }
        });
        
        // ALAMAT KTP
            $('#apiprovinsi').change(function() { 
            // console.log(this.value);
            
                $.ajax({
                    url: "http://simrsku.com/api/provinsi/"+this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        // var valprovinsi = $("#apiprovinsi").val();
                        $("#apikota").val("").find('option').remove();
                        $("#apikecamatan").val("").find('option').remove();
                        $("#apidesa").val("").find('option').remove();
                        $("#apikota").attr('disabled', false);
                        $("#apikecamatan").attr('disabled', true);
                        $("#apidesa").attr('disabled', true);
                        $("#apikota").append('<option value="" hidden>Pilih Kabupaten</option>');
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
            // console.log(this.value);
                
                $.ajax({
                    url: "http://simrsku.com/api/kota/"+this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apikecamatan").val("").find('option').remove();
                        $("#apidesa").val("").find('option').remove();
                        $("#apikecamatan").attr('disabled', false);
                        $("#apidesa").attr('disabled', true);
                        $("#apikecamatan").append('<option value="" hidden>Pilih Kecamatan</option>');
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
            // console.log(this.value);
                
                $.ajax({
                    url: "http://simrsku.com/api/kecamatan/"+this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apidesa").val("").find('option').remove();
                        $("#apidesa").attr('disabled', false);
                        $("#apidesa").append('<option value="" hidden>Pilih Desa</option>');
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
            // console.log(this.value);
            
                $.ajax({
                    url: "http://simrsku.com/api/provinsi/"+this.value,
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
                        $("#apikotadom").append('<option value="" hidden>Pilih Kabupaten</option>');
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
            // console.log(this.value);
                
                $.ajax({
                    url: "http://simrsku.com/api/kota/"+this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apikecamatandom").val("").find('option').remove();
                        $("#apidesadom").val("").find('option').remove();
                        $("#apikecamatandom").attr('disabled', false);
                        $("#apidesadom").attr('disabled', true);
                        $("#apikecamatandom").append('<option value="" hidden>Pilih Kecamatan</option>');
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
            // console.log(this.value);
                
                $.ajax({
                    url: "http://simrsku.com/api/kecamatan/"+this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apidesadom").val("").find('option').remove();
                        $("#apidesadom").attr('disabled', false);
                        $("#apidesadom").append('<option value="" hidden>Pilih Desa</option>');
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
        
        // ALAMAT KTP LOKAL
        //     $('#apiprovinsi').change(function() { 
        //     // console.log(this.value);
            
        //         $.ajax({
        //             url: "http://localhost:8000/api/provinsi/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 // var valprovinsi = $("#apiprovinsi").val();
        //                 $("#apikota").val("").find('option').remove();
        //                 $("#apikecamatan").val("").find('option').remove();
        //                 $("#apidesa").val("").find('option').remove();
        //                 $("#apikota").attr('disabled', false);
        //                 $("#apikecamatan").attr('disabled', true);
        //                 $("#apidesa").attr('disabled', true);
        //                 $("#apikota").append('<option value="" hidden>Pilih Kabupaten</option>');
        //                 // res.forEach(item => {
        //                 //     $("#apikota").val(item.nama_kabkota);
        //                 // });
        //                 // var ary = res.;  
        //                 var len = res.length;   
        //                 var sel = document.getElementById('apikota');
        //                 for(var i = 0; i < len; i++) {
        //                     var opt = document.createElement('option');
        //                     opt.innerHTML = res[i]['nama_kabkota'];
        //                     opt.value = res[i]['nama_kabkota'];
        //                     sel.appendChild(opt);
        //                     // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
        //                 }
        //             }
        //         });
        //     });
        
        //     $('#apikota').change(function() { 
        //     // console.log(this.value);
                
        //         $.ajax({
        //             url: "http://localhost:8000/api/kota/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 $("#apikecamatan").val("").find('option').remove();
        //                 $("#apidesa").val("").find('option').remove();
        //                 $("#apikecamatan").attr('disabled', false);
        //                 $("#apidesa").attr('disabled', true);
        //                 $("#apikecamatan").append('<option value="" hidden>Pilih Kecamatan</option>');
        //                 // res.forEach(item => {
        //                 //     $("#apikota").val(item.nama_kabkota);
        //                 // });
        //                 // var ary = res.;  
        //                 var len = res.length;   
        //                 var sel = document.getElementById('apikecamatan');
        //                 for(var i = 0; i < len; i++) {
        //                     var opt = document.createElement('option');
        //                     opt.innerHTML = res[i]['kecamatan'];
        //                     opt.value = res[i]['kecamatan'];
        //                     sel.appendChild(opt);
        //                     // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
        //                 }
        //             }
        //         });
        //     });
        
        //     $('#apikecamatan').change(function() { 
        //     // console.log(this.value);
                
        //         $.ajax({
        //             url: "http://localhost:8000/api/kecamatan/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 $("#apidesa").val("").find('option').remove();
        //                 $("#apidesa").attr('disabled', false);
        //                 $("#apidesa").append('<option value="" hidden>Pilih Desa</option>');
        //                 // res.forEach(item => {
        //                 //     $("#apikota").val(item.nama_kabkota);
        //                 // });
        //                 // var ary = res.;  
        //                 var len = res.length;   
        //                 var sel = document.getElementById('apidesa');
        //                 for(var i = 0; i < len; i++) {
        //                     var opt = document.createElement('option');
        //                     opt.innerHTML = res[i]['desa'];
        //                     opt.value = res[i]['desa'];
        //                     sel.appendChild(opt);
        //                     // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
        //                 }
        //             }
        //         });
        //     });

        // // ALAMAT DOMISILI
        //     $('#apiprovinsidom').change(function() { 
        //     // console.log(this.value);
            
        //         $.ajax({
        //             url: "http://localhost:8000/api/provinsi/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 // var valprovinsi = $("#apiprovinsi").val();
        //                 $("#apikotadom").val("").find('option').remove();
        //                 $("#apikecamatandom").val("").find('option').remove();
        //                 $("#apidesadom").val("").find('option').remove();
        //                 $("#apikotadom").attr('disabled', false);
        //                 $("#apikecamatandom").attr('disabled', true);
        //                 $("#apidesadom").attr('disabled', true);
        //                 $("#apikotadom").append('<option value="" hidden>Pilih Kabupaten</option>');
        //                 // res.forEach(item => {
        //                 //     $("#apikota").val(item.nama_kabkota);
        //                 // });
        //                 // var ary = res.;  
        //                 var len = res.length;   
        //                 var sel = document.getElementById('apikotadom');
        //                 for(var i = 0; i < len; i++) {
        //                     var opt = document.createElement('option');
        //                     opt.innerHTML = res[i]['nama_kabkota'];
        //                     opt.value = res[i]['nama_kabkota'];
        //                     sel.appendChild(opt);
        //                     // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
        //                 }
        //             }
        //         });
        //     });
        
        //     $('#apikotadom').change(function() { 
        //     // console.log(this.value);
                
        //         $.ajax({
        //             url: "http://localhost:8000/api/kota/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 $("#apikecamatandom").val("").find('option').remove();
        //                 $("#apidesadom").val("").find('option').remove();
        //                 $("#apikecamatandom").attr('disabled', false);
        //                 $("#apidesadom").attr('disabled', true);
        //                 $("#apikecamatandom").append('<option value="" hidden>Pilih Kecamatan</option>');
        //                 // res.forEach(item => {
        //                 //     $("#apikota").val(item.nama_kabkota);
        //                 // });
        //                 // var ary = res.;  
        //                 var len = res.length;   
        //                 var sel = document.getElementById('apikecamatandom');
        //                 for(var i = 0; i < len; i++) {
        //                     var opt = document.createElement('option');
        //                     opt.innerHTML = res[i]['kecamatan'];
        //                     opt.value = res[i]['kecamatan'];
        //                     sel.appendChild(opt);
        //                     // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
        //                 }
        //             }
        //         });
        //     });
        
        //     $('#apikecamatandom').change(function() { 
        //     // console.log(this.value);
                
        //         $.ajax({
        //             url: "http://localhost:8000/api/kecamatan/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 $("#apidesadom").val("").find('option').remove();
        //                 $("#apidesadom").attr('disabled', false);
        //                 $("#apidesadom").append('<option value="" hidden>Pilih Desa</option>');
        //                 // res.forEach(item => {
        //                 //     $("#apikota").val(item.nama_kabkota);
        //                 // });
        //                 // var ary = res.;  
        //                 var len = res.length;   
        //                 var sel = document.getElementById('apidesadom');
        //                 for(var i = 0; i < len; i++) {
        //                     var opt = document.createElement('option');
        //                     opt.innerHTML = res[i]['desa'];
        //                     opt.value = res[i]['desa'];
        //                     sel.appendChild(opt);
        //                     // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
        //                 }
        //             }
        //         });
        //     });

        // VALIDASI INPUT FORMULIR BIODATA
        $('#nik').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nik').removeClass('is-invalid');          
            } 
            else {
                $('#nik').addClass('is-invalid');     
            }
        });
        $('#nama').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nama').removeClass('is-invalid');          
            } 
            else {
                $('#nama').addClass('is-invalid');     
            }
        });
        $('#temp_lahir').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#temp_lahir').removeClass('is-invalid');          
            } 
            else {
                $('#temp_lahir').addClass('is-invalid');     
            }
        });
        $('#nick').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nick').removeClass('is-invalid');          
            } 
            else {
                $('#nick').addClass('is-invalid');     
            }
        });
        $('#email').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#email').removeClass('is-invalid');          
            } 
            else {
                $('#email').addClass('is-invalid');     
            }
        });
        $('#no_hp').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#no_hp').removeClass('is-invalid');          
            } 
            else {
                $('#no_hp').addClass('is-invalid');     
            }
        });
        $('#ig').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#ig').removeClass('is-invalid');          
            } 
            else {
                $('#ig').addClass('is-invalid');     
            }
        });
        $('#fb').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#fb').removeClass('is-invalid');          
            } 
            else {
                $('#fb').addClass('is-invalid');     
            }
        });

        // VALIDASI PENDIDIKAN FORMAL
        $('#sd').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_sd').prop('disabled', false);         
            }
            else {
                $('#th_sd').prop('disabled', true);    
            }
        });
        $('#smp').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_smp').prop('disabled', false);         
            }
            else {
                $('#th_smp').prop('disabled', true);    
            }
        });
        $('#sma').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_sma').prop('disabled', false);         
            }
            else {
                $('#th_sma').prop('disabled', true);    
            }
        });
        $('#d1').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_d1').prop('disabled', false);         
            }
            else {
                $('#th_d1').prop('disabled', true);    
            }
        });
        $('#d3').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_d3').prop('disabled', false);         
            }
            else {
                $('#th_d3').prop('disabled', true);    
            }
        });
        $('#d4').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_d4').prop('disabled', false);         
            }
            else {
                $('#th_d4').prop('disabled', true);    
            }
        });
        $('#s1').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_s1').prop('disabled', false);         
            }
            else {
                $('#th_s1').prop('disabled', true);    
            }
        });
        $('#s2').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_s2').prop('disabled', false);         
            }
            else {
                $('#th_s2').prop('disabled', true);    
            }
        });
        $('#s3').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#th_s3').prop('disabled', false);         
            }
            else {
                $('#th_s3').prop('disabled', true);    
            }
        });

        // VALIDASI DOKUMEN KEPEGAWAIAN
        $('#nip').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nip').removeClass('is-invalid');          
            } 
            else {
                $('#nip').addClass('is-invalid');     
            }
        });
        $('#jabatan').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#jabatan').removeClass('is-invalid');          
            } 
            else {
                $('#jabatan').addClass('is-invalid');     
            }
        });
        $('#no_str').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#no_str').removeClass('is-invalid');          
            } 
            else {
                $('#no_str').addClass('is-invalid');     
            }
        });

        // VALIDASI CHECKBOX ALAMAT
        $("#checkbox_alamat").on('change', function() {
            if ($(this).is(':checked')) {
                $('#alamatdomisili').prop('hidden', true); 
                $("#apiprovinsidom").val("").find('selected').remove();
                $("#apikotadom").val("").find('selected').remove();
                $("#apikecamatandom").val("").find('selected').remove();
                $("#apidesadom").val("").find('selected').remove();
                $("#alamat_dom").val("");
                $(this).val("0");
            } else {
                $('#alamatdomisili').prop('hidden', false);
                $(this).val("1");
            }
        });

        $('#max_alamat_ktp').text('190 Limit Text');
        $('#alamat_ktp').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#max_alamat_ktp').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#max_alamat_ktp').text(ch + ' Limit Text');     
            }
        });

        $('#max_alamat_dom').text('190 Limit Text');
        $('#alamat_dom').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#max_alamat_dom').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#max_alamat_dom').text(ch + ' Limit Text');     
            }
        });
    });
</script>
@endsection
