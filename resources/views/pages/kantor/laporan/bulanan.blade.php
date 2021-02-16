@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

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
            @role('admin-direksi')
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">
    
                            </i>
                            Tambah Laporan Bulanan
                        </a>
                    </div>
                </div><br>
            @endrole
            <div class="table-responsive">
                <table id="regulasi" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>JUDUL</th>
                            <th>BULAN</th>
                            <th>TAHUN</th>
                            <th>UNIT</th>
                            <th>KETERANGAN</th>
                            <th>DIBUAT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->bln }}</td>
                            <td>{{ $item->thn }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->ket }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <center>
                                    <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                    @role('admin-direksi')
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    @endrole
                                </center>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan=7>Tidak Ada Data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@role('admin-direksi')
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
                    <div class="col-md-4">
                        <label>Unit</label>
                        <select class="custom-select" name="unit" id="unit" required>
                            <option hidden>Pilih</option>
                            @foreach($list['unit'] as $name => $item)
                                <option value="{{ $name }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="ket" id="ket1" maxlength="190" rows="8"></textarea>
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
            {{ Form::model($item, array('route' => array('regulasi.update', $item->id), 'method' => 'PUT')) }}
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
                    <div class="col-md-4">
                        <label>Unit</label>
                        <select class="custom-select" name="unit" id="unit" required>
                            <option hidden>Pilih</option>
                            @foreach($list['unit'] as $name => $key)
                                <option value="{{ $name }}" @if ($item->unit == $name) echo selected @endif>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Judul</label>
                        <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" required>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="ket" id="ket2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->ket); ?></textarea>
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
                        <b>{{ $item->title }}</b> ({{Storage::size($item->filename)}} bytes)
                    @endif
                </div>
        </div>
        <div class="modal-footer">
            
                <center><button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
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
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Laporan Bulanan <b>{{ $item->judul }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('regulasi.destroy', $item->id) }}" method="POST">
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
@endrole

<script>
$(document).ready( function () {
    $('#regulasi').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ],
            order: [[ 5, "desc" ]]
        }
    );
} );
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
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
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
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
@endsection