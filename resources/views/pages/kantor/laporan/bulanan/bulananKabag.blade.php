@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@can('laporan')
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">
            
            <i class="fa-fw fas fa-book nav-icon text-info">

            </i> Laporan Bulanan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <div class="btn-group" role="group">
                            <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                                <i class="fa-fw fas fa-plus-square nav-icon">

                                </i>
                                Tambah
                            </a>
                            <button class="btn btn-warning text-white" onclick="refresh()">
                                <i class="fa-fw fas fa-refresh nav-icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group" role="group">
                            <a type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#roles" data-toggle="tooltip" data-placement="bottom" title="ATURAN VERIFIKATOR"><i class="fa-fw fas fa-feed nav-icon"></i></a>
                            <button class="btn btn-dark text-white" onclick="verif()">
                                <i class="fa-fw fas fa-check-square nav-icon"></i> Verifikasi&nbsp;
                                <span class="badge badge-light" id="jumlah-verif"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <sub>Data yang ditampilkan adalah data laporan yang sudah anda Upload</sub>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DIUPDATE</th>
                            <th>JUDUL</th>
                            <th>BLN / THN</th>
                            <th>KETERANGAN</th>
                            <th><center>AKSI</center></th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                </table>
            </div>
        </div>
    </div>
@endcan

@can('admin-laporan')
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">
            
            <i class="fa-fw fas fa-book nav-icon text-info">

            </i> Laporan Bulanan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Rahasia
            </span>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <div class="btn-group" role="group">
                            <button class="btn btn-warning text-white" onclick="refreshAdmin()">
                                <i class="fa-fw fas fa-refresh nav-icon"></i>
                            </button>
                            <button class="btn btn-danger text-white" onclick="restore()">
                                <i class="fa-fw fas fa-history nav-icon"></i> Restore Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="tableadmin" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><center>STATUS</center></th>
                            <th>DIUPDATE</th>
                            <th>JUDUL</th>
                            <th>UNIT</th>
                            <th>BLN / THN</th>
                            <th>KETERANGAN</th>
                            <th><center>AKSI</center></th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody-admin"><tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                </table>
            </div>
        </div>
    </div>
@endcan

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
            <form class="form-auth-small" name="formTambah" action="{{ route('bulanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <i class="fa-fw fas fa-info-circle nav-icon"></i> Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong>Hari saat Anda mengupload saja</strong><hr>
                <div class="row">
                    <div class="col-md-4">
                        <label>Bulan</label>
                        <select class="form-control" name="bln" id="bln-tambah" required>
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
                        <select class="form-control" name="thn" id="thn-tambah" required>
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
                User :&nbsp;<strong>{{ Auth::user()->nama }}</strong> 
                <button class="btn btn-success" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modal-verif" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Verifkasi Laporan Bulanan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="btn-group" role="group">
                <button class="btn btn-warning text-white" onclick="refreshVerif()">
                    <i class="fa-fw fas fa-refresh nav-icon"></i>
                </button>
                <button class="btn btn-success text-white" onclick="window.location.href='{{ route('riwayat.laporan.bulanan') }}'">
                    <i class="fa-fw fas fa-history nav-icon"></i> Riwayat Verifikasi
                </button>
            </div>
            <br>
            <sub>Data yang ditampilkan khusus Laporan yang belum terverifikasi</sub>
            <hr>
            <table id="tableverif" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DIUPDATE</th>
                        <th>JUDUL</th>
                        <th>UNIT</th>
                        <th>BLN / THN</th>
                        <th>KETERANGAN</th>
                        <th><center>AKSI</center></th>
                    </tr>
                </thead>
                <tbody id="tampil-verif"><tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
            </table>
        </div>
        <div class="modal-footer">
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
                            <select class="form-control" name="bln" required>
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
                            <select class="form-control" name="thn" required>
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
                                <b><a href="bulan/{{ $item->id }}">{{ $item->title }}</a></b> ({{ number_format(Storage::size($item->filename) / 1048576,2) }} MB)
                            @endif
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <a>Ditambahkan {{ \Carbon\Carbon::parse($item->created_at)->diffforhumans() }}</a>
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
<div class="modal fade" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b>
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
                        <h3><strong>Kepala Sub Bagian Rawat Inap</strong></h3><br>
                        <h3><strong>Kepala Sub Bagian Keperawatan Rawat Inap</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'karu-igd',
                        'karu-poli',
                        ]))
                        <h3><strong>Kepala Sub Bagian Rawat Jalan dan Gawat Darurat</strong></h3><br>
                        <h3><strong>Kepala Sub Bagian Keperawatan Rawat Jalan dan Gawat Darurat</strong></h3>
                    @endif
                    
                    @if(Auth::user()->hasAnyRole([
                        'karu-kasir',
                        ]))
                        <h3><strong>Kepala Sub Bagian Akuntansi, Pajak, dan Verifikasi</strong></h3>
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
    $(document).ready( function () {
        $.ajax(
            {
                url: "./bulan/table",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var date = new Date().toISOString().split('T')[0];
                    res.show.forEach(item => {
                        var updet = item.updated_at.substring(0, 10);
                        $("#tampil-tbody").append(`
                            <tr id="data${item.id}">
                                <td>${item.id} ${item.tgl_verif != null ? '<i class="fa-fw fas fa-check nav-icon"></i>' : '' }</td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                            ${item.ket_verif != null ?
                                                '<button class="btn btn-info text-white btn-sm" onclick="ketLihat('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                                :
                                                '<button class="btn btn-secondary text-white btn-sm" disabled><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            }
                                            ${updet == date ?
                                                '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah'+item.id+'"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus'+item.id+'"><i class="fa-fw fas fa-trash nav-icon"></i></button>' : '<button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>'
                                            }
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                    $('#table').DataTable(
                        {
                            paging: true,
                            searching: true,
                            dom: 'Bfrtip',
                            buttons: [
                                'excel', 'pdf','colvis'
                            ],
                            select: {
                                style: 'single'
                            },
                            'columnDefs': [
                                // { targets: 0, visible: false },
                                // { targets: 3, visible: false },
                                // { targets: 6, visible: false },
                                // { targets: 8, visible: false },
                            ],
                            language: {
                                buttons: {
                                    colvis: 'Sembunyikan Kolom',
                                    excel: 'Jadikan Excell',
                                    pdf: 'Jadikan PDF',
                                }
                            },
                            order: [[ 1, "desc" ]],
                            pageLength: 10
                        }
                    ).columns.adjust();
                }
            }
        );
        $.ajax(
            {
                url: "./bulan/tableadmin",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-admin").empty();
                    res.show.forEach(item => {
                        if(item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch(e) {
                                var un = item.unit;
                            }
                        }
                        $("#tampil-tbody-admin").append(`
                            <tr id="data${item.id}">
                                <td><kbd>${item.id}</kbd></td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            ${item.tgl_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="verifikasiAdmin('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="verified('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            }
                                            ${item.ket_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="ketAdmin('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapusAdmin('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            }
                                        </div>
                                    </center>
                                </td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket != null ? item.ket : ''}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah${item.id}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus${item.id}"><i class="fa-fw fas fa-trash nav-icon"></i></button>                                        
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                    $('#tableadmin').DataTable(
                        {
                            paging: true,
                            searching: true,
                            dom: 'Bfrtip',
                            buttons: [
                                'excel', 'pdf','colvis'
                            ],
                            select: {
                                style: 'single'
                            },
                            'columnDefs': [
                                // { targets: 0, visible: false },
                                // { targets: 3, visible: false },
                                // { targets: 6, visible: false },
                                // { targets: 8, visible: false },
                            ],
                            language: {
                                buttons: {
                                    colvis: 'Sembunyikan Kolom',
                                    excel: 'Jadikan Excell',
                                    pdf: 'Jadikan PDF',
                                }
                            },
                            order: [[ 2, "desc" ]],
                            pageLength: 10
                        }
                    ).columns.adjust();
                }
            }
        );
        
        $.ajax({
            url: "./bulan/tableverif",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('#jumlah-verif').text(Object.keys(res).length);
            }
        });
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
    } );
</script>

<script>
    // FUNCTION - FUNCTION
    function refresh() {
        $("#tampil-tbody").empty().append(`<tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
            {
                url: "./bulan/table",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#table').DataTable().clear().destroy();
                    var date = new Date().toISOString().split('T')[0];
                    res.show.forEach(item => {
                        var updet = item.updated_at.substring(0, 10);
                        $("#tampil-tbody").append(`
                            <tr id="data${item.id}">
                                <td>${item.id} ${item.tgl_verif != null ? '<i class="fa-fw fas fa-check nav-icon"></i>' : '' }</td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                            <button class="btn btn-info text-white btn-sm" onclick="ketLihat(${item.id})"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>
                                            ${updet == date ?
                                                '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah'+item.id+'"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus'+item.id+'"><i class="fa-fw fas fa-trash nav-icon"></i></button>' : '<button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>'
                                            }
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                    $('#table').DataTable(
                        {
                            paging: true,
                            searching: true,
                            dom: 'Bfrtip',
                            buttons: [
                                'excel', 'pdf','colvis'
                            ],
                            select: {
                                style: 'single'
                            },
                            'columnDefs': [
                                // { targets: 0, visible: false },
                                // { targets: 3, visible: false },
                                // { targets: 6, visible: false },
                                // { targets: 8, visible: false },
                            ],
                            language: {
                                buttons: {
                                    colvis: 'Sembunyikan Kolom',
                                    excel: 'Jadikan Excell',
                                    pdf: 'Jadikan PDF',
                                }
                            },
                            order: [[ 1, "desc" ]],
                            pageLength: 10
                        }
                    ).columns.adjust();
                }
            }
        );
    }
    
    function verif() {
        $.ajax(
            {
                url: "./bulan/tableverif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#modal-verif').modal('show');
                    $("#tampil-verif").empty();
                    res.forEach(item => {
                        if(item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch(e) {
                                var un = item.unit;
                            }
                        }
                        $("#tampil-verif").append(`
                            <tr id="data${item.id}">
                                <td><kbd>${item.id}</kbd></td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket ? item.ket : '' }</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            ${item.tgl_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="verifikasi('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="verified('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            }
                                            ${item.ket_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="ket('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapus('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            }
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                }
            }
        );
    }

    function refreshVerif() {
        $("#tampil-verif").empty().append(`<tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
            {
                url: "./bulan/tableverif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#modal-verif').modal('show');
                    $("#tampil-verif").empty();
                    res.forEach(item => {
                        if(item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch(e) {
                                var un = item.unit;
                            }
                        }
                        $("#tampil-verif").append(`
                            <tr id="data${item.id}">
                                <td><kbd>${item.id}</kbd></td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket ? item.ket : '' }</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            ${item.tgl_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="verifikasi('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="verified('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            }
                                            ${item.ket_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="ket('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapus('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            }
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                }
            }
        );
    }

    function refreshAdmin() {
        $("#tampil-tbody-admin").empty().append(`<tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
            {
                url: "./bulan/tableadmin",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-admin").empty();
                    $('#tableadmin').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        if(item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch(e) {
                                var un = item.unit;
                            }
                        }
                        $("#tampil-tbody-admin").append(`
                            <tr id="data${item.id}">
                                <td><kbd>${item.id}</kbd></td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            ${item.tgl_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="verifikasiAdmin('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="verified('+item.id+')"><i class="fa-fw fas fa-check nav-icon"></i></button>'
                                            }
                                            ${item.ket_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="ketAdmin('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapusAdmin('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            }
                                        </div>
                                    </center>
                                </td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket != null ? item.ket : ''}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah${item.id}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus${item.id}"><i class="fa-fw fas fa-trash nav-icon"></i></button>                                        
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                    $('#tableadmin').DataTable(
                        {
                            paging: true,
                            searching: true,
                            dom: 'Bfrtip',
                            buttons: [
                                'excel', 'pdf','colvis'
                            ],
                            select: {
                                style: 'single'
                            },
                            'columnDefs': [
                                // { targets: 0, visible: false },
                                // { targets: 3, visible: false },
                                // { targets: 6, visible: false },
                                // { targets: 8, visible: false },
                            ],
                            language: {
                                buttons: {
                                    colvis: 'Sembunyikan Kolom',
                                    excel: 'Jadikan Excell',
                                    pdf: 'Jadikan PDF',
                                }
                            },
                            order: [[ 2, "desc" ]],
                            pageLength: 10
                        }
                    ).columns.adjust();
                }
            }
        );
    }

    function saveData() {
        $("#tambah").one('submit', function() {
            //stop submitting the form to see the disabled button effect
            let x = document.forms["formTambah"]["bln-tambah"].value;
            let y = document.forms["formTambah"]["thn-tambah"].value;
            if (x == "Bulan" || y == "Tahun") {

                Swal.fire({
                    position: 'top',
                    title: 'Perhatian',
                    text: 'Anda belum memasukkan Bulan / Tahun',
                    icon: 'warning',
                    showConfirmButton:false,
                    showCancelButton:true,
                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                    timer: 3000,
                    timerProgressBar: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });

                return false;
            } else {
                $("#btn-simpan").attr('disabled','disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

                return true;
            }
        });
    }

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
                    url: './bulan/api/', 
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
                            refreshVerif();
                        }
                    }
                }); 
            }
        })
    }

    function verifikasiAdmin(id) {
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
                    url: './bulan/api/', 
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
                            refreshAdmin();
                        }
                    }
                }); 
            }
        })
    }

    function verified(id) {
        $.ajax({
            method: 'GET',
            url: './bulan/api/'+id+'/verified', 
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
    
    function ket(id) {
        Swal.fire({
            title: 'Keterangan Verifikasi',
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
                    url: './bulan/api/ket/', 
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
                            refreshVerif();
                        }
                    }
                }); 
            }
        })
    }
    
    function ketAdmin(id) {
        Swal.fire({
            title: 'Keterangan Verifikasi',
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
                    url: './bulan/api/ket/', 
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
                            refreshAdmin();
                        }
                    }
                }); 
            }
        })
    }
    
    function ketHapus(id) {
        $.ajax({
            method: 'GET',
            url: './bulan/api/ket/'+id, 
            dataType: 'json', 
            data: { 
                id: id
            }, 
            success: function(res) {
                Swal.fire({
                    title: 'Keterangan',
                    text: res.ket_verif,
                    focusCancel: true,
                    showConfirmButton:true,
                    confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                    confirmButtonColor: '#FF4845',
                    showCancelButton: true,
                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                    showCloseButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: './bulan/api/ket/'+id+'/hapus', 
                            dataType: 'json', 
                            data: { 
                                id: id
                            }, 
                            success: function(val) {
                                Swal.fire({
                                    title: 'Keterangan berhasil dihapus!',
                                    text: val.text,
                                    icon: val.icon,
                                    showConfirmButton:false,
                                    showCancelButton:false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    backdrop: `rgba(26,27,41,0.8)`,
                                });
                                if (val) {
                                    refreshVerif();
                                }
                            }
                        }); 
                    }
                })
            }
        }); 
    }
    
    function ketHapusAdmin(id) {
        $.ajax({
            method: 'GET',
            url: './bulan/api/ket/'+id, 
            dataType: 'json', 
            data: { 
                id: id
            }, 
            success: function(res) {
                Swal.fire({
                    title: 'Keterangan',
                    text: res.ket_verif,
                    focusCancel: true,
                    showConfirmButton:true,
                    confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                    confirmButtonColor: '#FF4845',
                    showCancelButton: true,
                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                    showCloseButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: './bulan/api/ket/'+id+'/hapus', 
                            dataType: 'json', 
                            data: { 
                                id: id
                            }, 
                            success: function(val) {
                                Swal.fire({
                                    title: 'Keterangan berhasil dihapus!',
                                    text: val.text,
                                    icon: val.icon,
                                    showConfirmButton:false,
                                    showCancelButton:false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    backdrop: `rgba(26,27,41,0.8)`,
                                });
                                if (val) {
                                    refreshAdmin();
                                }
                            }
                        }); 
                    }
                })
            }
        }); 
    }
    
    function ketLihat(id) {
        $.ajax({
            method: 'GET',
            url: './bulan/api/ket/'+id, 
            dataType: 'json', 
            data: { 
                id: id
            }, 
            success: function(res) {
                Swal.fire({
                    title: 'Keterangan Verifikator',
                    text: res.ket_verif,
                    focusCancel: true,
                    showConfirmButton:false,
                    showCancelButton: true,
                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                    showCloseButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
            }
        }); 
    }
</script>
@endsection