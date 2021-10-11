{{-- @php
foreach($list['show'] as $key => $item){
    foreach($item as $keys => $items){
        print_r($items->ket);
    }
}
die();    
@endphp --}}

@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
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
                            @if ($list['tambah'] == true)
                                <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                                    <i class="fa-fw fas fa-plus-square nav-icon">
            
                                    </i>
                                    Tambah
                                </a>
                            @endif
                            @role('it')
                                <a type="button" class="btn btn-warning text-white" href="{{ route('it.roleuser.index') }}">
                                    <i class="fa-fw fas fa-drivers-license nav-icon">
            
                                    </i>
                                    Set User
                                </a>
                            @endrole
                            <a type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#readme" data-toggle="tooltip" data-placement="bottom" title="STRUKTUR BAGIAN 2021">
                                <i class="fa-fw fas fa-question-circle nav-icon">
        
                                </i>
                                Struktur Organisasi
                            </a>
                        </div>
                        <br>
                    </div>
                    @role('pelayanan')
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
            @role('pelayanan')
                <div class="table-responsive">
                    <table id="bulanan-admin" class="table table-striped display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                                                <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
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
                    <table id="bulanan-user" class="table table-striped display">
                        <thead>
                            <tr>
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
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffforhumans() }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->bln }} / {{ $item->thn }}</td>
                                            <td>{{ $item->ket }}</td>
                                            <td>
                                                <center>
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
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
                    <input type="text" name="unit" value="{{ $list['role'] }}" hidden>
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
                    <div class="col-md-2">
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
                    <input type="text" name="unit" value="{{ $item->unit }}" hidden>
                    <div class="col-md-8">
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

<script>
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
                { targets: 0, visible: false },
                { targets: 2, visible: false },
                { targets: 5, visible: false },
                { targets: 7, visible: false },
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 1, "desc" ]],
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
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 0, "desc" ]],
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