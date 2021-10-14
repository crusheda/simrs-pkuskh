@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('laporan/bulanan/') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button> 

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Pelayanan
            </span>
            
        </div>
        @role('pelayanan')
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h5>Pencarian {{ $list['time'] }}</h5>
                    </div>
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
                            <button class="form-control btn btn-info text-white" id="submit" disabled>Filter</button>
                        </form>
                    </div>
                </div>
            </div><hr>
            <div class="table-responsive">
                <table id="bulanan" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>DIBUAT</th>
                            <th>JUDUL</th>
                            <th>BLN / THN</th>
                            <th>UNIT</th>
                            <th>BLN / THN</th>
                            <th>KETERANGAN</th>
                            <th>
                                <center>#</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->bln }} / {{ $item->thn }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->bln }} / {{ $item->thn }}</td>
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
        </div>
        @else
        <div class="card-body">
            <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
        </div>
        @endrole
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <label>Unit</label>
                        <input type="text" name="unit" value="{{ $item->unit }}" hidden>
                        <select class="custom-select" name="unit" id="unit" disabled>
                            <option value="{{ $item->unit }}" selected>{{ $item->unit }}</option>
                            {{-- @foreach($list['unit'] as $name => $key)
                                <option value="{{ $name }}" @if ($item->unit == $name) echo selected @endif>{{ $name }}</option>
                            @endforeach --}}
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
            Ditambahkan <b>{{ $item->updated_at }}</b>
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
            order: [[ 0, "desc" ]]
        }
    );
    
    $("body").addClass('brand-minimized sidebar-minimized');
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