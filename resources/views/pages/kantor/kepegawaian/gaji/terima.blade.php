@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">

    @can('gaji')

    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-handshake nav-icon text-info">
        
            </i>
            Set Penerimaan Gaji Karyawan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kepegawaian
            </span>
            
        </div>
        <div class="card-body">
            @can('gaji')
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" data-toggle="tooltip" data-placement="bottom" title="Tambah Penerima">
                        <i class="fa-fw fas fa-plus-square nav-icon">

                        </i>
                        Tambah Penerima
                    </button>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#notyet" data-toggle="tooltip" data-placement="bottom" title="DATA BELUM MASUK"><i class="fa-fw fas fa-info nav-icon text-white"></i></button>
                    <div class="pull-right">
                        <form class="form-inline" action="{{ route('cari.log') }}" method="GET">
                            <select class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulanFilter">
                                <option hidden>Bln</option>
                                @php
                                    $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                    $jml_bln=count($bulan);
                                    for($c=1 ; $c < $jml_bln ; $c+=1){
                                        echo"<option value=$c> $bulan[$c] </option>";
                                    }
                                @endphp
                            </select>
                            <select class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahunFilter">
                                <option hidden>Thn</option>
                                @php
                                    for ($i=2021; $i <= $list['thn']; $i++) { 
                                        echo"<option value=$i> $i </option>";
                                    }
                                    
                                @endphp
                            </select>
                            {{-- <button class="form-control text-white" style="background-color: palevioletred" id="submit"><span class="badge">Filter</span></button> --}}
                            <button class="form-control btn-secondary text-white" id="submit" disabled><span class="badge">Filter</span></button>
                        </form>
                    </div>    
                </div>
            </div><hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="kepegawaian" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>NIP</th>
                                                <th>NAMA</th>
                                                <th>GOL</th>
                                                <th>STRUKTURAL</th>
                                                <th>FUNGSIONAL</th>
                                                <th>GAPOK</th>
                                                <th>INSENTIF</th>
                                                <th>DIPERBARUI</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($list) > 0)
                                                @foreach($list['show'] as $key => $item)
                                                <tr>
                                                    <td><b>{{ $item->nip }}</b></td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->nama_golongan }}</td>
                                                    <td>Rp. {{ number_format($item->struktural,2,",",".") }}</td>
                                                    <td>Rp. {{ number_format($item->fungsional,2,",",".") }}</td>
                                                    <td>Rp. {{ number_format($item->gapok,2,",",".") }}</td>
                                                    <td>Rp. {{ number_format($item->insentif,2,",",".") }}</td>
                                                    <td>{{ $item->updated_at }}</td>
                                                    <td>
                                                        <center>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ url('kepegawaian/gaji/terima/'. $item->id.'/detail') }}'"><i class="fa-fw fas fa-search nav-icon text-white"></i></button>
                                                                {{-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="DETAIL DATA"><i class="fa-fw fas fa-search nav-icon text-white"></i></button> --}}
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#recent{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="RIWAYAT DATA"><i class="fa-fw fas fa-sort-amount-desc nav-icon text-white"></i></button>
                                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="UBAH DATA"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="HAPUS DATA"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                            </div>
                                                        </center>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>NIP</th>
                                                <th>NAMA</th>
                                                <th>GOL</th>
                                                <th>STRUKTURAL</th>
                                                <th>FUNGSIONAL</th>
                                                <th>GAPOK</th>
                                                <th>INSENTIF</th>
                                                <th>DIPERBARUI</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>

    @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
    @endcan

</div>

@can('gaji')

    {{-- TAMBAH DATA --}}
    <div class="modal fade bd-example-modal-xl" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Tambah Penerima Gaji
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-auth-small" action="{{ route('kepegawaian.terima.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <label>Nama Karyawan :</label>
                            <div class="input-group mb-3">
                                <select class="fstdropdown-select" name="user_id" autofocus required>
                                    <option value="">Pilih</option>
                                    @foreach($list['notyet'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ strtoupper(str_replace('-', ' ', $item->nama_role)) }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Golongan Karyawan :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="golongan" required>
                                    <option value="" hidden>Pilih</option>
                                        @foreach($list['golongan'] as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <label>Jabatan Struktural :</label>
                            <div class="input-group mb-3">
                                <select name="struktural[]" class="form-control select2" multiple="multiple" required>
                                    @foreach($list['struktural'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->ket }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Jabatan Fungsional :</label>
                            <div class="input-group mb-3">
                                <select name="fungsional[]" class="form-control select2" multiple="multiple" required>
                                    @foreach($list['fungsional'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->ket }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Gaji Pokok :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" name="gapok" max="99999999" class="form-control" placeholder="" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">,-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Total Insentif Kehadiran :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" name="insentif" max="99999999" class="form-control" placeholder="" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">,-</div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <hr>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="baru" value="0" id="baru" style="width: 1.25rem;height: 1.25rem;">
                                <label class="form-check-label" for="baru">
                                Centang apabila karyawan tersebut termasuk penerima <kbd>Potongan Koperasi / Iuran Pokok</kbd> saat pertama kali gajian.
                                </label>
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <table id="" class="table table-hover display">
                                <thead>
                                    <tr>
                                        <th>Kriteria Potongan</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="karybar" hidden>
                                        <td>Koperasi / Iuran Pokok<br><sub><kbd>Karyawan Baru</kbd></sub></td>
                                        <td>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend"><div class="input-group-text">Rp </div></div><input type="number" class="form-control" value="100000" disabled><div class="input-group-prepend"><div class="input-group-text">,-</div></div>
                                            </div>
                                        </td>
                                        <td>Sekali Saat Pertama Kali Gajian</td>
                                    </tr>
                                    <tr id="karylam">
                                        <td>Koperasi / Iuran Pokok<br><sub><kbd>Karyawan Lama</kbd></sub></td>
                                        <td>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend"><div class="input-group-text">Rp </div></div><input type="number" class="form-control" value="5000" disabled><div class="input-group-prepend"><div class="input-group-text">,-</div></div>
                                            </div>
                                        </td>
                                        <td>Setiap Bulan Untuk Karyawan Lama</td>
                                    </tr>
                                    @if(count($list['ref_potong']) > 0)
                                    @foreach($list['ref_potong'] as $item)
                                    <tr>
                                        {{-- <td><input type="text" class="form-control" name="jawaban[]" placeholder=""></td> --}}
                                        <td>
                                            <input type="text" class="form-control" name="id[]" placeholder="" value="{{ $item->id }}" hidden>
                                            <label>{{ $item->kriteria }}</label>
                                        </td>
                                        <td>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend"><div class="input-group-text">Rp </div></div>
                                                @if (!empty($item->nominal))
                                                    <input type="number" class="form-control" value="{{ $item->nominal }}" disabled>
                                                    <input type="number" class="form-control" name="nominal[]" value="{{ $item->nominal }}" hidden>
                                                @else
                                                    <input type="number" class="form-control" name="nominal[]" value="{{ $item->nominal }}">
                                                @endif
                                                <div class="input-group-prepend"><div class="input-group-text">,-</div></div>
                                            </div>
                                        </td>
                                        <td>
                                            @if (!empty($item->nominal))
                                                <label>{{ $item->ket }}</label>
                                                <input type="text" class="form-control" name="ket[]" value="{{ $item->ket }}" hidden>
                                            @else
                                                <input type="text" class="form-control" name="ket[]" placeholder="Optional">
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="form-inline">
                        <label><b>Kriteria Infaq</b>&nbsp;&nbsp;&nbsp;</label>
                        <div class="input-group mb-3" style="margin-top: 15px">
                            <select name="infaq" class="form-control" required>
                                <option hidden>Pilih</option>
                                <option value="1" selected>1 % dari Gaji Pokok</option>
                                <option value="2">2,5 % dari Gaji Pokok</option>
                                <option value="3">2,5 % dari Penerimaan Kotor</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">

                    <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>

    {{-- UBAH DATA --}}
    @foreach($list['show'] as $items)
    <div class="modal fade bd-example-modal-xl" id="ubah{{ $items->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Data ID : {{ $items->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($items, array('route' => array('kepegawaian.terima.update', $items->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label>Nama Karyawan :</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="user_id" value="{{ $items->id_user }}" hidden> 
                                <input type="text" class="form-control" value="{{ $items->nama }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>NIP :</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $items->nip }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Golongan Karyawan :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="golongan" required>
                                    <option value="" hidden>Pilih</option>
                                        @foreach($list['golongan'] as $key)
                                            <option value="{{ $key->id }}" @if ($items->id_golongan == $key->id) echo selected @endif><b>{{ $key->nama }}</b></option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        @php
                            $getStruktural = \App\Models\gaji\struktural_has_user::where('id_user', $items->id_user)->get();
                            $getFungsional = \App\Models\gaji\fungsional_has_user::where('id_user', $items->id_user)->get();
                            $getPotong = \App\Models\gaji\potong_has_user::where('id_user', $items->id_user)->get();
                            $bln = Carbon\Carbon::now()->isoFormat('MM');
                            $thn = Carbon\Carbon::now()->isoFormat('YYYY');
                            $query_string = "SELECT created_at,iuran_pokok FROM gaji_terima WHERE id_user = $items->id_user AND YEAR(created_at) = $thn AND MONTH(created_at) = $bln AND deleted_at IS NULL";
                            $getTglQuery = \DB::select($query_string);
                                $tglCarbon = Carbon\Carbon::now()->isoFormat('YYYY-MM'); // 2021-07
                                $tglTimestamp = Carbon\Carbon::parse($getTglQuery[0]->created_at)->isoFormat('YYYY-MM'); // 2021-07
                                if ($tglCarbon == $tglTimestamp) {
                                    $IDiuranPokok = true;
                                }
                        @endphp

                        <div class="col-md-6">
                            <label>Jabatan Struktural :</label>
                            <div class="input-group mb-3">
                                <select name="struktural[]" class="form-control select2" multiple="multiple" required>
                                        @foreach($list['struktural'] as $item)
                                            <option value="{{ $item->id }}" @foreach($getStruktural as $value) @if ($value->id_struktural == $item->id) echo selected @endif @endforeach>{{ $item->ket }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Jabatan Fungsional :</label>
                            <div class="input-group mb-3">
                                <select name="fungsional[]" class="form-control select2" multiple="multiple" required>
                                    @foreach($list['fungsional'] as $item)
                                        <option value="{{ $item->id }}" @foreach($getFungsional as $value) @if ($value->id_fungsional == $item->id) echo selected @endif @endforeach>{{ $item->ket }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Gaji Pokok :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" name="gapok" value="{{ $items->gapok }}" max="99999999" class="form-control" placeholder="" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">,-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Total Insentif Kehadiran :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" name="insentif" value="{{ $items->insentif }}" max="99999999" class="form-control" placeholder="" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">,-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <table id="" class="table table-hover display">
                            <thead>
                                <tr>
                                    <th>Kriteria Potongan</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if ($items->iuran_pokok == true)
                                        @if ($IDiuranPokok == true)
                                            <td>Koperasi / Iuran Pokok<br><sub><kbd>Karyawan Baru</kbd></sub></td>
                                            <td>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend"><div class="input-group-text">Rp </div></div><input type="number" class="form-control" value="100000" disabled><div class="input-group-prepend"><div class="input-group-text">,-</div></div>
                                                </div>
                                            </td>
                                            <td>Sekali Saat Pertama Kali Gajian</td>
                                        @else
                                            <td>Koperasi / Iuran Pokok<br><sub><kbd>Karyawan Lama</kbd></sub></td>
                                            <td>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend"><div class="input-group-text">Rp </div></div><input type="number" class="form-control" value="5000" disabled><div class="input-group-prepend"><div class="input-group-text">,-</div></div>
                                                </div>
                                            </td>
                                            <td>Setiap Bulan Untuk Karyawan Lama</td>
                                        @endif
                                    @else
                                        <td>Koperasi / Iuran Pokok<br><sub><kbd>Karyawan Lama</kbd></sub></td>
                                        <td>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend"><div class="input-group-text">Rp </div></div><input type="number" class="form-control" value="5000" disabled><div class="input-group-prepend"><div class="input-group-text">,-</div></div>
                                            </div>
                                        </td>
                                        <td>Setiap Bulan Untuk Karyawan Lama</td>
                                    @endif
                                </tr>
                                @if(count($list['ref_potong']) > 0)
                                @foreach($list['ref_potong'] as $key => $item)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="id[]" value="{{ $item->id }}" hidden>
                                        <label>{{ $item->kriteria }}</label>
                                    </td>
                                    <td>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend"><div class="input-group-text">Rp </div></div>
                                            @if (!empty($item->nominal))
                                                <input type="number" class="form-control" @foreach ($list['potongHas'] as $potong) @if ($item->id == $potong->id_potong) value="{{ $potong->nominal }}" @endif @endforeach disabled>
                                                <input type="number" class="form-control" name="nominal[]" @foreach ($list['potongHas'] as $potong) @if ($item->id == $potong->id_potong) @if ($items->id_user == $potong->id_user) value="{{ $potong->nominal }}"@endif @endif @endforeach hidden>
                                            @else
                                                <input type="number" class="form-control" name="nominal[]" @foreach ($list['potongHas'] as $potong) @if ($item->id == $potong->id_potong) @if ($items->id_user == $potong->id_user) value="{{ $potong->nominal }}"@endif @endif @endforeach>
                                            @endif
                                            <div class="input-group-prepend"><div class="input-group-text">,-</div></div>
                                        </div>
                                    </td>
                                    <td>
                                        @if (!empty($item->nominal))
                                            <label>{{ $item->ket }}</label>
                                            <input type="text" class="form-control" name="ket[]" @foreach ($list['potongHas'] as $potong) @if ($item->id == $potong->id_potong) @if ($items->id_user == $potong->id_user) value="{{ $potong->ket }}" @endif @endif @endforeach hidden>
                                        @else
                                            <input type="text" class="form-control" name="ket[]" placeholder="Optional" @foreach ($list['potongHas'] as $potong) @if ($item->id == $potong->id_potong) @if ($items->id_user == $potong->id_user) value="{{ $potong->ket }}" @endif @endif @endforeach>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="form-inline">
                        <label><b>Kriteria Infaq</b>&nbsp;&nbsp;&nbsp;</label>
                        <div class="input-group mb-3" style="margin-top: 15px">
                            <select name="infaq" class="form-control" required>
                                <option hidden>Pilih</option>
                                <option value="1" @if ($items->id_infaq == 1) echo selected @endif>1 % dari Gaji Pokok</option>
                                <option value="2" @if ($items->id_infaq == 2) echo selected @endif>2,5 % dari Gaji Pokok</option>
                                <option value="3" @if ($items->id_infaq == 3) echo selected @endif>2,5 % dari Penerimaan Kotor</option>
                            </select>
                        </div>
                    </div>
                    {{-- <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Jika terdapat kesalahan pada penulisan <kbd>Nomor RM</kbd> , silakan Hapus data dan Input ulang kembali</a> --}}
                    
            </div>
            <div class="modal-footer">
                    <button class="btn btn-success pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>
    @endforeach
    
    {{-- HAPUS DATA --}}
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Hapus ID : {{ $item->id }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        @if(count($list) > 0)
                            <a>Apakah anda yakin ingin menghapus Gaji a/n <kbd>{{ $item->nama }}</kbd> ?</a>
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    @if(count($list) > 0)
                        <form action="{{ route('kepegawaian.terima.destroy', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
                        </form>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    {{-- RIWAYAT DATA --}}
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-xl" id="recent{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Riwayat Perubahan ID : {{ $item->id }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @php
                        $getRecent = \DB::table('gaji_terima')->where('id_user',$item->id_user)->whereNotNull('deleted_at')->orderBy('deleted_at','DESC')->limit('50')->get();
                    @endphp
                    <table id="recent" class="table table-hover display">
                        <thead>
                            <tr>
                                <th>Tgl</th>
                                <th>Struktural</th>
                                <th>Fungsional</th>
                                <th>Gaji Pokok</th>
                                <th>Insentif</th>
                                <th>Total Potongan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($getRecent) > 0)
                            @foreach($getRecent as $gt => $val)
                                <tr>
                                    <td>{{ $val->deleted_at }}</td>
                                    <td>Rp. {{ number_format($val->struktural,2,",",".") }}</td>
                                    <td>Rp. {{ number_format($val->fungsional,2,",",".") }}</td>
                                    <td>Rp. {{ number_format($val->gapok,2,",",".") }}</td>
                                    <td>Rp. {{ number_format($val->insentif,2,",",".") }}</td>
                                    <td>Rp. {{ number_format($val->potong + $val->infaq,2,",",".") }}<br>@if ($val->iuran_pokok == true) <kbd>Karyawan Baru</kbd> @endif</td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    {{-- DATA BELUM MASUK --}}
    <div class="modal fade bd-example-modal-xl" id="notyet" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa-fw fas fa-info-circle nav-icon"></i> KARYAWAN YANG BELUM TERDAFTAR
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="data-table-list">
                        <div class="table-responsive">
                            <table id="unregistered" class="table table-hover display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>AKUN</th>
                                        <th>NIP</th>
                                        <th>NAMA</th>
                                        <th>UNIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($list['notyet']) > 0)
                                    @foreach($list['notyet'] as $yolo)
                                        <tr>
                                            <td>{{ $yolo->id }}</td>
                                            <td>{{ $yolo->name }}</td>
                                            <td>{{ $yolo->nip }}</td>
                                            <td>{{ $yolo->nama }}</td>
                                            <td>{{ $yolo->nama_role }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endcan

<script>
    $(document).ready( function () {
        $('#kepegawaian').DataTable(
            {
                // paging: true,
                // searching: true,
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                order: [[ 7, "desc" ]],
            }
        );

        $('#unregistered').DataTable(
            {
                order: [[ 4, "asc" ]],
                pageLength: 50
            }
        );

        // $("body").addClass('brand-minimized sidebar-minimized');

        // VALIDASI INPUT NUMBER
        $('input[type=number][max]:not([max=""])').on('input', function(ev) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
            $this.val(value.substr(0, maxlength));
            }
        });
        $("#baru").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 1);
                $('#karybar').prop('hidden', false);
                $('#karylam').prop('hidden', true);
            } else {
                $(this).attr('value', 0);
                $('#karylam').prop('hidden', false);
                $('#karybar').prop('hidden', true);
            }
        });
    } );
</script>

@endsection