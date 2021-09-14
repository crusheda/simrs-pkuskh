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
                        <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">
    
                            </i>
                            Tambah
                        </a>
                        <a type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#" hidden>
                            <i class="fa-fw fas fa-question-circle nav-icon">
    
                            </i>
                            Struktur Organisasi
                        </a>
                        <br>
                        {{-- <sub>Role : <b></b></sub> --}}
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
            <div class="table-responsive">
                <table id="bulanan" class="table table-striped display">
                    <thead>
                        <tr>
                            @role('pelayanan')
                                <th>DIBUAT</th>
                                <th>JUDUL</th>
                                <th>BLN / THN</th>
                                <th>UNIT</th>
                            @else
                                <th>DIBUAT</th>
                                <th>DIPERBARUI</th>
                                <th>JUDUL</th>
                                <th>BLN / THN</th>
                            @endrole
                            <th>KETERANGAN</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            @role('pelayanan')
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->bln }} / {{ $item->thn }}</td>
                                <td style="text-transform: uppercase">{{ str_replace("-"," ",$item->unit) }}</td>
                            @else
                                <td>{{ $item->created_at }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffforhumans() }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->bln }} / {{ $item->thn }}</td>
                            @endrole
                            <td>{{ $item->ket }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                    @role('pelayanan')
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    @else
                                        @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['tgl'])
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        @endif
                                    @endrole
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark">

            <div class="pull-left" style="margin-top: 3px">
                <i class="fa-fw fas fa-question-circle nav-icon">
    
                </i> Lihat Struktur Organisasi
            </div>
            <div class="pull-right">
                <a type="button" class="btn btn-light btn-sm text-dark" data-toggle="modal" data-target="#tambah">
                    <i class="fa-fw fas fa-plus-square nav-icon">

                    </i>
                    Tampilkan
                </a>
            </div>

        </div>
    </div>
</div> --}}

{{-- @role('admin-direksi') --}}
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
                    {{-- <div class="col-md-4">
                        <label>Unit</label>
                        <select class="custom-select" name="unit" id="unit" disabled>
                            <option value="{{ $list['role'] }}" selected>{{ $list['role'] }}</option>
                        </select>
                    </div> --}}
                    <div class="col-md-4">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
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
                <input type="file" name="file" required>
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
                    {{-- <div class="col-md-4">
                        <label>Unit</label>
                        <select class="custom-select" name="unit" id="unit" disabled>
                            <option value="{{ $item->unit }}" selected>{{ $item->unit }}</option>
                        </select>
                    </div> --}}
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
                <div class="col-md-12">
                    <label>Detail Dokumen : </label>
                    @if ($item->filename == '')
                    -
                    @else
                        <b><a href="bulanan/{{ $item->id }}">{{ $item->title }}</a></b> ({{Storage::size($item->filename)}} bytes)
                    @endif
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

@foreach($list['show'] as $item)
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
{{-- @endrole --}}

<script>
$(document).ready( function () {
    $('#bulanan').DataTable(
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
            order: [[ 0, "desc" ]]
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