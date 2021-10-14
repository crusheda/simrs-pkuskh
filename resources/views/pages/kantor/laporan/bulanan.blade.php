@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
    @if(Auth::user()->hasAnyRole([
        'kasubag-perencanaan-it',
        'kasubag-diklat',
        'kasubag-marketing',
        'kasubag-perbendaharaan',
        'kasubag-verifikasi-akuntansi-pajak',
        'kasubag-aset-gudang',
        'kasubag-ipsrs',
        'kasubag-kesling-k3',
        'kasubag-kepegawaian',
        'kasubag-aik',
        'kasubag-tata-usaha',
        'kasubag-humas',
        'kasubag-penunjang-operasional',
        'kasubag-penunjang-medik',
        'kasubag-penunjang-nonmedik',
        'kasubag-keperawatan-rajal-gadar',
        'kasubag-keperawatan-ranap',
        'kasubag-rajal-gadar',
        'kasubag-ranap',

        'kabag-perencanaan',
        'kabag-keuangan',
        'kabag-rumah-tangga',
        'kabag-kepegawaian',
        'kabag-umum',
        'kabag-penunjang',
        'kabag-keperawatan',
        'kabag-pelayanan-medik',
        
        'direktur-keuangan-perencanaan',
        'direktur-umum-kepegawaian',
        'direktur-pelayanan-keperawatan-penunjang',
    ]))
    <div class="col-md-6">
    @else
    <div class="col-md-12">
    @endif
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-book nav-icon text-info">

                </i> Tabel Laporan Bulanan

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Pribadi
                </span>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <div class="btn-group" role="group">
                                @if ($list['tambah'] == true)
                                    @if(Auth::user()->hasAnyRole([
                                            'perencanaan',
                                            'pelayanan',
                                            'direktur-utama',
                                            'direktur-keuangan-perencanaan',
                                            'direktur-umum-kepegawaian',
                                            'direktur-pelayanan-keperawatan-penunjang',
                                        ]))
                                        <button type="button" class="btn btn-secondary text-white" disabled>
                                            <i class="fa-fw fas fa-plus-square nav-icon">
                    
                                            </i>
                                            Tambah
                                        </button>
                                    @else
                                        <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                                            <i class="fa-fw fas fa-plus-square nav-icon">
                    
                                            </i>
                                            Tambah
                                        </a>
                                    @endif
                                @endif
                                @role('it')
                                    <a type="button" class="btn btn-warning text-white" href="{{ route('it.roleuser.index') }}">
                                        <i class="fa-fw fas fa-drivers-license nav-icon">
                
                                        </i>
                                        Set User
                                    </a>
                                @endrole
                                <a type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#backup">
                                    <i class="fa-fw fas fa-server nav-icon">
            
                                    </i>
                                    Backup
                                </a>
                                @if(Auth::user()->hasAnyRole([
                                    'it',
                                    'pelayanan',
                                    'direktur-utama',
                                    'direktur-umum-kepegawaian',
                                    'direktur-pelayanan-keperawatan-penunjang',
                                ]))
                                @else
                                    <a type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#roles" data-toggle="tooltip" data-placement="bottom" title="ATURAN VERIFIKATOR"><i class="fa-fw fas fa-feed nav-icon"></i></a>
                                @endif
                            </div>
                            <br>
                        </div>
                        @role('it|pelayanan|direktur-utama')
                        <div class="pull-right">
                            <form class="form-inline" action="{{ route('bulanan.filter') }}" method="GET">
                                <span style="width: auto;margin-right:10px">Filter</span>
                                <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan">
                                    <option hidden>Bulan</option>
                                    <?php
                                        $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        $jml_bln=count($bulan);
                                        for($c=1 ; $c < $jml_bln ; $c+=1){
                                            echo"<option value=$c> $bulan[$c] </option>";
                                        }
                                    ?>
                                </select>
                                <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun">
                                    <option hidden>Tahun</option>
                                    @php
                                        for ($i=2018; $i <= $list['thn']; $i++) { 
                                            echo"<option value=$i> $i </option>";
                                        }
                                        
                                    @endphp
                                </select>
                                <button class="form-control btn btn-info text-white" id="submit" disabled><i class="fa-fw fas fa-search nav-icon"></i></button>
                            </form>
                        </div>
                        @endrole
                    </div>
                </div><hr>
                @role('pelayanan|direktur-utama')
                    <div class="table-responsive">
                        <table id="bulanan-admin" class="table table-striped display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><center>STATUS</center></th>
                                    <th>DIBUAT</th>
                                    <th>DIUPDATE</th>
                                    <th>JUDUL</th>
                                    <th>BLN / THN</th>
                                    <th>USER</th>
                                    <th>UNIT</th>
                                    <th>KETERANGAN</th>
                                    <th><center>AKSI</center></th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['show']) > 0)
                                    @foreach($list['show'] as $key => $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <center>
                                                    <div class="btn-group" role="group">
                                                        @if ($item->tgl_verif == null)
                                                            <button class="btn btn-dark text-white btn-sm" onclick="verifikasi({{ $item->id }})">
                                                                <i class="fa-fw fas fa-star nav-icon"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-info text-white btn-sm" onclick="verified({{ $item->id }})">
                                                                <i class="fa-fw fas fa-star nav-icon"></i>
                                                            </button>
                                                        @endif
                                                        @if ($item->ket_verif != null)
                                                            <button class="btn btn-success text-white btn-sm" data-toggle="modal" data-target="#ket{{ $item->id }}">
                                                                <i class="fa-fw fas fa-edit nav-icon"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </center>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->bln }} / {{ $item->thn }}</td>
                                            <td>
                                                @foreach($list['user'] as $items)
                                                    @if ($item->id_user == $items->id) {{ $items->nama }} @endif
                                                @endforeach
                                            </td>
                                            <td style="text-transform: uppercase">{{ str_replace("-"," ",$item->unit) }}</td>
                                            <td>{{ $item->ket }}</td>
                                            <td>
                                                <center>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i> {{ number_format(Storage::size($item->filename) / 1048576,2) }} MB</a>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                </div>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="table-responsive">
                        <table id="bulanan-user" class="table table-striped display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><center>STATUS</center></th>
                                    <th>DIBUAT</th>
                                    <th>DIPERBARUI</th>
                                    <th>JUDUL</th>
                                    <th>BLN / THN</th>
                                    <th>KETERANGAN</th>
                                    <th><center>AKSI</center></th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['push']) > 0)
                                    @foreach($list['push'] as $keys => $items)
                                        @foreach($items as $key => $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group" role="group">
                                                            @if ($item->tgl_verif == null)
                                                                <button class="btn btn-dark text-white btn-sm" onclick="unverified()">
                                                                    <i class="fa-fw fas fa-square nav-icon"></i>
                                                                </button>
                                                            @else
                                                                <button class="btn btn-info text-white btn-sm" onclick="verified({{ $item->id }})">
                                                                    <i class="fa-fw fas fa-check-square nav-icon"></i>
                                                                </button>
                                                            @endif
                                                            @if ($item->ket_verif != null)
                                                                <button class="btn btn-success text-white btn-sm" data-toggle="modal" data-target="#ket{{ $item->id }}">
                                                                    <i class="fa-fw fas fa-edit nav-icon"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </center>
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffforhumans() }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->bln }} / {{ $item->thn }}</td>
                                                <td>{{ $item->ket }}</td>
                                                <td>
                                                    <center>
                                                    <div class="btn-group" role="group">
                                                        <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i> {{ number_format(Storage::size($item->filename) / 1048576,2) }} MB</a>
                                                        @if ($item->tgl_verif == null)
                                                            @if ($list['role'] == $item->unit)
                                                                {{-- AFTER 3 DAY --}}
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tglAfter3Day'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                @endif
                                                                {{-- AFTER 2 DAY --}}
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tglAfter2Day'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                @endif
                                                                {{-- AFTER 1 DAY --}}
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tglAfter1Day'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                @endif
                                                                {{-- TODAY --}}
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tgl'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endrole
            </div>
        </div>
    </div>
    
    @if(Auth::user()->hasAnyRole([
        'kasubag-perencanaan-it',
        'kasubag-diklat',
        'kasubag-marketing',
        'kasubag-perbendaharaan',
        'kasubag-verifikasi-akuntansi-pajak',
        'kasubag-aset-gudang',
        'kasubag-ipsrs',
        'kasubag-kesling-k3',
        'kasubag-kepegawaian',
        'kasubag-aik',
        'kasubag-tata-usaha',
        'kasubag-humas',
        'kasubag-penunjang-operasional',
        'kasubag-penunjang-medik',
        'kasubag-penunjang-nonmedik',
        'kasubag-keperawatan-rajal-gadar',
        'kasubag-keperawatan-ranap',
        'kasubag-rajal-gadar',
        'kasubag-ranap',

        'kabag-perencanaan',
        'kabag-keuangan',
        'kabag-rumah-tangga',
        'kabag-kepegawaian',
        'kabag-umum',
        'kabag-penunjang',
        'kabag-keperawatan',
        'kabag-pelayanan-medik',
        
        'direktur-keuangan-perencanaan',
        'direktur-umum-kepegawaian',
        'direktur-pelayanan-keperawatan-penunjang',
    ]))
    <div class="col-md-6">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark">

                <i class="fa-fw fas fa-check-square nav-icon text-danger">

                </i> Tabel Verifikasi Laporan Bulanan

                <span class="pull-right badge badge-danger text-dark" style="margin-top:4px">
                    Akses Verifikator
                </span>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <div class="pull-left">
                                    <a type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#readme" data-toggle="tooltip" data-placement="bottom" title="STRUKTUR BAGIAN 2021">
                                        <i class="fa-fw fas fa-question-circle nav-icon">
                
                                        </i>
                                        Struktur Organisasi
                                    </a>
                                </div>
                                <div class="pull-right">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="bulanan-user-verif" class="table table-striped display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th><center>VERIF</center></th>
                                        <th>DIBUAT</th>
                                        <th>DIPERBARUI</th>
                                        <th>JUDUL</th>
                                        <th>BLN / THN</th>
                                        <th>KETERANGAN</th>
                                        <th><center>AKSI</center></th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['show']) > 0)
                                        @foreach($list['show'] as $keys => $items)
                                            @foreach($items as $key => $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        <center>
                                                            <div class="btn-group" role="group">
                                                                @if(Auth::user()->hasAnyRole([
                                                                        'perencanaan',
                                                                        'pelayanan',
                                                                        'direktur-utama',
                                                                    ]))
                                                                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#status{{ $item->id }}"><i class="fa-fw fas fa-check-square nav-icon text-white"></i></button>
                                                                @else
                                                                    @if ($item->tgl_verif == null)
                                                                        <button class="btn btn-danger text-white btn-sm" onclick="verifikasi({{ $item->id }})">
                                                                            <i class="fa-fw fas fa-square nav-icon"></i>
                                                                        </button>
                                                                    @else
                                                                        <button class="btn btn-info text-white btn-sm" onclick="verified({{ $item->id }})">
                                                                            <i class="fa-fw fas fa-check-square nav-icon"></i>
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                @if ($item->ket_verif == null)
                                                                    <button class="btn btn-warning text-white btn-sm" onclick="ket({{ $item->id }})">
                                                                        <i class="fa-fw fas fa-edit nav-icon"></i>
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-success text-white btn-sm" data-toggle="modal" data-target="#ket{{ $item->id }}">
                                                                        <i class="fa-fw fas fa-edit nav-icon"></i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </center>
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffforhumans() }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->bln }} / {{ $item->thn }}</td>
                                                    <td>{{ $item->ket }}</td>
                                                    <td>
                                                        <center>
                                                        <div class="btn-group" role="group">
                                                            <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i> {{ number_format(Storage::size($item->filename) / 1048576,2) }} MB</a>
                                                            {{-- @if ($list['role'] == $item->unit)
                                                                AFTER 3 DAY
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tglAfter3Day'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                @endif
                                                                AFTER 2 DAY
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tglAfter2Day'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                @endif
                                                                AFTER 1 DAY
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tglAfter1Day'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                @endif
                                                                TODAY
                                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tgl'])
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                                @endif
                                                            @endif --}}
                                                        </div>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
</div>


<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Laporan Bulanan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('bulanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Setelah menambahkan laporan, anda dapat mengubahnya hanya sampai <strong>3 hari kedepan</strong>. Penghapusan dokumen laporan hanya berlaku pada <strong>Hari saat Anda mengupload saja</strong>.<br><i class="fa-fw fas fa-caret-right nav-icon"></i> Bila terjadi kesalahan sistem mohon hubungi <kbd>102</kbd> . Terima Kasih. :)<hr>
                <div class="row">
                    <div class="col-md-4">
                        <label>Bulan</label>
                        <select onchange="submitBtn()" class="form-control" name="bln" required>
                            <option hidden>Bulan</option>
                            <?php
                                $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                $jml_bln=count($bulan);
                                for($c=1 ; $c < $jml_bln ; $c+=1){
                                    echo"<option value=$c> $bulan[$c] </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Tahun</label>
                        <select onchange="submitBtn()" class="form-control" name="thn" required>
                            <option hidden selected>Tahun</option>
                            @php
                                for ($i=2018; $i <= $list['thn']; $i++) { 
                                    echo"<option value=$i> $i </option>";
                                }
                                
                            @endphp
                        </select>
                    </div>
                    {{-- <input type="text" name="unit" value="{{ $list['role'] }}" hidden> --}}
                    <div class="col-md-4">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" placeholder="Laporan Triwulan Bulan X" required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Keterangan :</label>
                        <textarea class="form-control" style="min-height: 100px" name="ket" id="ket1" maxlength="190" rows="5"></textarea>
                        <span class="help-block">
                            <p id="maxtambah" class="help-block "></p>
                        </span>  
                    </div>
                </div>
                <hr>
                <label>Dokumen : </label>
                <input type="file" name="file" required><br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Format yang dibolehkan : <strong>.pdf </strong>, <strong>.docx </strong>, <strong>.doc </strong>, <strong>.xls </strong>, <strong>.xlsx </strong>, <strong>.ppt </strong>, <strong>.pptx </strong>.<br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>100 mb</strong>.
        </div>
        <div class="modal-footer">
                User :&nbsp;<strong>{{ Auth::user()->nama }}</strong> &nbsp;
                <center><button class="btn btn-success" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

@foreach($list['showall'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Laporan Bulanan&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('bulanan.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Bulan</label>
                        <select onchange="submitBtn()" class="form-control" name="bln" required>
                            <option hidden>Bulan</option>
                            <?php
                                $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                $jml_bln=count($bulan);
                                for($c=1 ; $c < $jml_bln ; $c+=1){
                                    if ($item->bln == $c) {
                                        echo"<option value=$c selected> $bulan[$c] </option>";
                                    } else {
                                        echo"<option value=$c> $bulan[$c] </option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Tahun</label>
                        <select onchange="submitBtn()" class="form-control" name="thn" required>
                            <option hidden selected>Tahun</option>
                            @php
                                for ($i=2018; $i <= $list['thn']; $i++) { 
                                    if ($item->thn == $i) {
                                        echo"<option value=$i selected> $i </option>";
                                    } else {
                                        echo"<option value=$i> $i </option>";
                                    }
                                }
                                
                            @endphp
                        </select>
                    </div>
                    {{-- <input type="text" name="unit" value="{{ $item->unit }}" hidden> --}}
                    <div class="col-md-7">
                        <label>Judul</label>
                        <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Keterangan :</label>
                        <textarea class="form-control" style="min-height: 100px" name="ket" id="ket2" placeholder="" maxlength="190" rows="5"><?php echo htmlspecialchars($item->ket); ?></textarea>
                        <span class="help-block">
                            <p id="maxubah" class="help-block "></p>
                        </span>  
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <i class="fa-fw fas fa-caret-right nav-icon"></i> Detail Dokumen :
                        @if ($item->filename == '')
                        -
                        @else
                            <b><a href="bulanan/{{ $item->id }}">{{ $item->title }}</a></b> ({{ number_format(Storage::size($item->filename) / 1048576,2) }} MB)
                        @endif
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <div class="pull-left">
                @foreach($list['user'] as $items)
                    @if ($item->id_user == $items->id) Ditambahkan oleh {{ $items->nama }} @endif
                @endforeach
            </div>
            <div class="pull-right">
                <button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>

            </form>
            
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['showall'] as $item)
<div class="modal" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b>
                @foreach($list['user'] as $items)
                    @if ($item->id_user == $items->id) oleh {{ $items->nama }} @endif
                @endforeach
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Laporan Bulanan <b>{{ $item->judul }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('bulanan.destroy', $item->id) }}" method="POST">
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

@foreach($list['showall'] as $item)
<div class="modal" id="ket{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Keterangan dari Verifikator <b></b>
                @foreach($list['user'] as $items)
                    @if ($item->id_user == $items->id) oleh {{ $items->nama }} @endif
                @endforeach
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <p>{{ $item->ket_verif }}</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a>{{ \Carbon\Carbon::parse($item->tgl_ket_verif)->diffForHumans() }}</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<div class="modal fade bd-example-modal-lg" id="readme" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Struktur Bagian 2021
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img class="card-img-top img-thumbnail" src="{{ url('img/struktur_bagian_pkuskh.jpg') }}" height="300" alt="Card image cap">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="backup" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Kehilangan Dokumen Laporan Terdahulu Anda?
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <strong><h5 class="text-center">Mengapa dokumen anda yang lama tidak muncul pada tabel Laporan Bulanan?</h5></strong>
                  <p>Hal ini terjadi dikarenakan pada Update Penyesuaian Sistem Laporan Bulanan yang dilakukan pada Bulan Oktober 2021 kali ini
                     hanya menampilkan dokumen sesuai masing-masing Unit / Bagian yang sudah ditentukan pada Struktur Bagian RS 2021. Tapi tenang saja, dokumen yang anda Upload terdahulu
                     masih dapat anda Download dengan Masuk ke halaman berikutnya ( Klik tombol <kbd style="background-color: rgb(26, 158, 26)">Lanjutkan</kbd> ) di bawah ini. Halaman Backup Dokumen Laporan Bulanan
                     ini hanya bersifat sementara saja. mohon untuk menguploadnya sesuai masing-masing Bagian agar dapat diverifikasi oleh Atasan Terkait.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('bulanan.old') }}'"><i class="fa-fw fas fa-thumbs-up nav-icon"></i> Lanjutkan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="roles" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Alur Verifikasi Laporan Anda
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <h6>Verifikator : <br>
                    {{-- TIM --}}
                    @if(Auth::user()->hasAnyRole([
                        'spi',
                        'spv',
                        'pkrs',
                        'mpp',
                        'ppi',
                        'pmkp',
                        'asuransi',
                        'komite-medik',
                        'komite-keperawatan',
                        ]))
                        <h3><strong>Direktur Utama</strong></h3>
                    @endif

                    {{-- KABAG --}}
                    @if(Auth::user()->hasAnyRole([
                        'kabag-perencanaan',
                        ]))
                        <h3><strong>Direktur Keuangan dan Perencanaan</strong></h3>
                    @endif

                    @if(Auth::user()->hasAnyRole([
                        'kabag-keuangan',
                        ]))
                        <h3><strong>Direktur Keuangan dan Perencanaan</strong></h3>
                    @endif

                    @if(Auth::user()->hasAnyRole([
                        'kabag-rumah-tangga',
                        ]))
                        <h3><strong>Direktur Umum dan Kepegawaian</strong></h3>
                    @endif

                    @if(Auth::user()->hasAnyRole([
                        'kabag-kepegawaian',
                        ]))
                        <h3><strong>Direktur Umum dan Kepegawaian</strong></h3>
                    @endif

                    @if(Auth::user()->hasAnyRole([
                        'kabag-umum',
                        ]))
                        <h3><strong>Direktur Umum dan Kepegawaian</strong></h3>
                    @endif

                    @if(Auth::user()->hasAnyRole([
                        'kabag-penunjang',
                        ]))
                        <h3><strong>Direktur Pelayanan Medik, Keperawatan, dan Penunjang</strong></h3>
                    @endif

                    @if(Auth::user()->hasAnyRole([
                        'kabag-keperawatan',
                        ]))
                        <h3><strong>Direktur Pelayanan Medik, Keperawatan, dan Penunjang</strong></h3>
                    @endif

                    @if(Auth::user()->hasAnyRole([
                        'kabag-pelayanan-medik',
                        ]))
                        <h3><strong>Direktur Pelayanan Medik, Keperawatan, dan Penunjang</strong></h3>
                    @endif
                    
                    {{-- KASUBAG --}}
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-perencanaan-it',
                        'kasubag-diklat',
                        'kasubag-marketing',
                        ]))
                        <h3><strong>Kepala Bagian Perencanaan dan Pengembangan RS</strong></h3>
                    @endif
                        
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-perbendaharaan',
                        'kasubag-verifikasi-akuntansi-pajak',
                        ]))
                        <h3><strong>Kepala Bagian Keuangan</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-aset-gudang',
                        'kasubag-ipsrs',
                        'kasubag-kesling-k3',
                        ]))
                        <h3><strong>Kepala Bagian Rumah Tangga</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-kepegawaian',
                        'kasubag-aik',
                        ]))
                        <h3><strong>Kepala Bagian Kepegawaian</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-tata-usaha',
                        'kasubag-humas',
                        'kasubag-penunjang-operasional',
                        ]))
                        <h3><strong>Kepala Bagian Umum</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-penunjang-medik',
                        'kasubag-penunjang-nonmedik',
                        ]))
                        <h3><strong>Kepala Bagian Penunjang</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-keperawatan-rajal-gadar',
                        'kasubag-keperawatan-ranap',
                        ]))
                        <h3><strong>Kepala Bagian Keperawatan</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'kasubag-rajal-gadar',
                        'kasubag-ranap',
                        ]))
                        <h3><strong>Kepala Bagian Pelayanan Medik</strong></h3>
                    @endif
                    
                    {{-- BAWAHAN KASUBAG --}}
                    @if(Auth::user()->hasAnyRole([
                        'karu-lab',
                        'karu-rm-informasi',
                        'karu-radiologi',
                        'karu-rehab',
                        'karu-farmasi',
                        ]))
                        <h3><strong>Kepala Sub Bagian Penunjang Medik</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'karu-gizi',
                        'karu-laundry',
                        'karu-cssd',
                        'karu-cssd',
                        'karu-binroh',
                        ]))
                        <h3><strong>Kepala Sub Bagian Penunjang Non Medik</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'karu-driver',
                        'karu-cs',
                        'karu-security',
                        ]))
                        <h3><strong>Kepala Sub Bagian Penunjang Operasional</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'karu-ibs',
                        'karu-icu',
                        'karu-bangsal3',
                        'karu-bangsal4',
                        'karu-kebidanan',
                        ]))
                        <h3><strong>Kepala Sub Bagian Rawat Inap</strong></h3> <br>&<br>
                        <h3><strong>Kepala Sub Bagian Keperawatan Rawat Inap</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'karu-igd',
                        'karu-poli',
                        ]))
                        <h3><strong>Kepala Sub Bagian Rawat Jalan dan Gawat Darurat</strong></h3> <br>&<br>
                        <h3><strong>Kepala Sub Bagian Keperawatan Rawat Jalan dan Gawat Darurat</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'karu-kasir',
                        ]))
                        <h3><strong>Kepala Sub Bagian </strong></h3>
                    @endif
                </h6>
                <hr>
                <p class="text-left">
                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Upload dokumen laporan dengan menggunakan akun sesuai Unit / Bagian anda agar dokumen dapat diverifikasi oleh masing-masing verifikator.<br>
                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Apabila laporan telah berhasil diverifikasi oleh Atasan terkait, anda tidak lagi dapat mengubah / menghapus Laporan bulanan.<br>
                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Jika ada kesalahan sistem <kbd><i class="fa-fw fas fa-bug nav-icon"></i> BUG</kbd> , mohon segera melapor bagian IT untuk segera ditindaklanjuti.
                </p>
            </div>
            <div class="modal-footer">
                <a>Laporan bulanan anda akan diverifikasi oleh Atasan terkait (<b>Verifikator</b>)</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function verifikasi(id) {
    Swal.fire({
        title: 'Verifikasi Laporan?',
        text: 'Laporan ID : '+id,
        icon: 'info',
        reverseButtons: true,
        focusConfirm: true,
        showDenyButton: true,
        showCloseButton: true,
        showCancelButton: false,
        confirmButtonText: `<i class="fa fa-thumbs-up"></i> Verifikasi`,
        denyButtonText: `<i class="fa fa-thumbs-down"></i> Batal`,
        backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: './bulanan/api/', 
                dataType: 'json', 
                data: { 
                    id: id,
                    verifikasi: true,
                }, 
                success: function(res) {
                    Swal.fire({
                        title: 'Verifikasi Berhasil!',
                        text: 'Laporan berhasil diverifikasi oleh '+res.nama,
                        icon: 'success',
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 3000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                    if (res) {
                        window.setTimeout(function(){location.href = "./bulanan"},3000);
                    }
                }
            }); 
        }
    })
}
function verified(id) {
    $.ajax({
        // headers: {
        // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        method: 'GET',
        url: './bulanan/api/'+id+'/verified', 
        dataType: 'json', 
        data: { 
            id: id
        }, 
        success: function(res) {
            Swal.fire({
                title: 'Terverifikasi!',
                text: 'Laporan ini diverifikasi oleh '+res.nama+' Pada '+res.tgl_verif,
                icon: 'success',
                showConfirmButton:false,
                showCancelButton:false,
                timer: 3000,
                timerProgressBar: true,
                backdrop: `rgba(26,27,41,0.8)`,
            });
        }
    }); 
}
function unverified() {
    Swal.fire({
        title: 'Belum Diverifikasi',
        text: 'Laporan ini belum diverifikasi oleh atasan terkait.',
        icon: 'error',
        showConfirmButton:false,
        showCancelButton:false,
        timer: 3000,
        timerProgressBar: true,
        backdrop: `rgba(26,27,41,0.8)`,
    });
}
function ket(id) {
    Swal.fire({
        title: 'Keterangan Verifikasi Opsional',
        text: 'ID : '+id,
        input: 'textarea',
        reverseButtons: true,
        showDenyButton: false,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: `<i class="fa fa-send"></i> Kirim`,
        backdrop: `rgba(26,27,41,0.8)`,
        inputValidator: (value) => {
            if (!value) {
                return 'Pengisian keterangan tidak boleh kosong!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: './bulanan/api/ket/', 
                dataType: 'json', 
                data: { 
                    id: id,
                    ket: result.value,
                }, 
                success: function(res) {
                    Swal.fire({
                        title: `Keterangan Ditambahkan!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 3000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                    if (res) {
                        window.setTimeout(function(){location.href = "./bulanan"},3000);
                    }
                }
            }); 
        }
    })
}
$(document).ready( function () {
    $('#bulanan-admin').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf','colvis'
            ],
            'columnDefs': [
                { "width": "5%", "targets": 1 },
                { targets: 0, visible: false },
                { targets: 3, visible: false },
                { targets: 6, visible: false },
                { targets: 8, visible: false },
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 2, "desc" ]],
            pageLength: 20
        }
    );
    $('#bulanan-user').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf','colvis'
            ],
            'columnDefs': [
                { "width": "5%", "targets": 1 },
                { targets: 0, visible: false },
                { targets: 3, visible: false },
                { targets: 6, visible: false },
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 2, "desc" ]],
            pageLength: 20
        }
    );
    $('#bulanan-user-verif').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf','colvis'
            ],
            'columnDefs': [
                { "width": "5%", "targets": 1 },
                { targets: 0, visible: false },
                { targets: 3, visible: false },
                { targets: 6, visible: false },
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 2, "desc" ]],
            pageLength: 20
        }
    );
    
    $("body").addClass('brand-minimized sidebar-minimized');
    $('#maxtambah').text('190 Limit Text');
    $('#ket1').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#maxtambah').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#maxtambah').text(ch + ' Limit Text');     
        }
    });
    $('#maxubah').text('');
    $('#ket2').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#maxubah').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#maxubah').text(ch + ' Limit Text');     
        }
    });
    
    $("#tambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

        return true;
    });
});
</script>
<script>
    function submitBtn() {
        var bulan = document.getElementById("bulan").value;
        var tahun = document.getElementById("tahun").value;
        if (bulan != "Bln" && tahun != "Thn" ) {
            document.getElementById("submit").disabled = false;
        }
    } 
</script>
@endsection