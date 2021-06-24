@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-hand-lizard nav-icon text-danger">

            </i>
            Swab Antigen

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Lab
            </span>
            
        </div>
        <div class="card-body">
            @can('antigen')
            <div class="row">
                <div class="col-md-12">
                    <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                        <i class="fa-fw fas fa-plus-square nav-icon">

                        </i>
                        Tambah Hasil
                    </a>
                </div>
            </div><br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="antigen" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>DOKTER PENGIRIM</th>
                                                <th>RM</th>
                                                <th>PASIEN</th>
                                                <th>JK/UMUR</th>
                                                <th>ALAMAT</th>
                                                <th>TGL</th>
                                                <th>HASIL</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($list) > 0)
                                                @foreach($list['show'] as $item)
                                                <tr>
                                                    <td>{{ $item->dr_pengirim }}</td>
                                                    <td>{{ $item->rm }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->jns_kelamin }} / {{ $item->umur }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->tgl }}</td>
                                                    <td>{{ $item->hasil }}</td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                            <a type="button" class="btn btn-success btn-sm" href="{{ route('lab.antigen.cetak', $item->id) }}"><i class="fa-fw fas fa-print nav-icon"></i></a>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                        </center>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>DOKTER PENGIRIM</th>
                                                <th>RM</th>
                                                <th>PASIEN</th>
                                                <th>JK/UMUR</th>
                                                <th>ALAMAT</th>
                                                <th>TGL</th>
                                                <th>HASIL</th>
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
</div>

@can('antigen')
    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Tambah Hasil Antigen
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-auth-small" action="{{ route('lab.antigen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <label>RM :</label>
                            <input type="number" name="rm" id="rm" max="999999" class="form-control" placeholder="" autofocus><br>
                        </div>
                        <div class="col-md-4">
                            <label>Dokter Pengirim :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="dr_pengirim" id="dr_pengirim" >
                                    <option value="" hidden>Pilih</option>
                                    @foreach($list['dokter'] as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Tgl :</label>
                            <input type="datetime-local" name="tgl" class="form-control"><br>
                        </div>
                        <div class="col-md-2">
                            <label>Hasil :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="hasil" id="hasil" >
                                    <option value="" hidden>Pilih</option>
                                    <option value="POSITIF">POSITIF</option>
                                    <option value="NEGATIF">NEGATIF</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Nama :</label>
                            <input type="text" name="nama" id="nama1" class="form-control" placeholder="" hidden>
                            <input type="text" id="nama2" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Jenis Kelamin :</label>
                            <input type="text" name="jns_kelamin" id="jns_kelamin1" class="form-control" hidden>
                            <input type="text" id="jns_kelamin2" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Umur :</label>
                            <input type="text" name="umur" id="umur1" class="form-control" hidden>
                            <input type="text" id="umur2" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-12">
                            <label>Alamat :</label>
                            <textarea class="form-control" name="alamat" id="alamat1" placeholder="" maxlength="190" rows="8" hidden></textarea>
                            <textarea class="form-control" id="alamat2" placeholder="" maxlength="190" rows="8" disabled></textarea>
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

    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Hasil Antigen&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('rapat.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <label>RM :</label>
                            <input type="number" name="rm" id="rm" max="999999" value="{{ $item->rm }}" class="form-control" placeholder=""><br>
                        </div>
                        <div class="col-md-4">
                            <label>Dokter Pengirim :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="dr_pengirim" id="dr_pengirim">
                                    <option value="" hidden>Pilih</option>
                                    @foreach($list['dokter'] as $key)
                                        <option value="{{ $key->id }}" @if ($item->id == $key->id) echo selected @endif>{{ $key->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Tgl :</label>
                            <input type="datetime-local" name="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->tgl)); ?>">
                        </div>
                        <div class="col-md-2">
                            <label>Hasil :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="hasil" id="hasil" >
                                    <option value="" hidden>Pilih</option>
                                    <option value="POSITIF" @if ($item->hasil == 'POSITIF') echo selected @endif>POSITIF</option>
                                    <option value="NEGATIF" @if ($item->hasil == 'NEGATIF') echo selected @endif>NEGATIF</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Nama :</label>
                            <input type="text" name="nama" id="nama1" value="{{ $item->nama }}" class="form-control" placeholder="" hidden required>
                            <input type="text" id="nama2" value="{{ $item->nama }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Jenis Kelamin :</label>
                            <input type="text" name="jns_kelamin" id="jns_kelamin1" value="{{ $item->jns_kelamin }}" class="form-control" hidden>
                            <input type="text" id="jns_kelamin2" value="{{ $item->jns_kelamin }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Umur :</label>
                            <input type="text" name="umur" id="umur1" value="{{ $item->umur }}" class="form-control" hidden>
                            <input type="text" id="umur2" value="{{ $item->umur }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-12">
                            <label>Alamat :</label>
                            <textarea class="form-control" name="alamat" id="alamat1" placeholder="" maxlength="190" rows="8" hidden><?php echo htmlspecialchars($item->alamat); ?></textarea>
                            <textarea class="form-control" id="alamat2" placeholder="" maxlength="190" rows="8" disabled><?php echo htmlspecialchars($item->alamat); ?></textarea>
                        </div>
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
    <div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Yakin ingin Menghapus Hasil Antigen <kbd>ID : {{ $item->id }}</kbd> ?
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        @if(count($list) > 0)
                        <div class="row">
                            <div class="col-2">
                            <b> Dokter Pengirim</b> <br>
                            <b> RM</b> <br>
                            <b> PASIEN</b> <br>
                            <b> UMUR</b>
                            <b> HASIL</b> <br>
                            </div>
                            <div class="col-10">
                                : {{ $item->dr_pengirim }}<br>
                                : {{ $item->rm }}<br>
                                : {{ $item->nama }}<br>
                                : {{ $item->umur }}<br>
                                : {{ $item->hasil }}
                            </div>
                        </div>
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    @if(count($list) > 0)
                        <form action="{{ route('lab.antigen.destroy', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endcan

<script>
    $(document).ready( function () {
        $('#antigen').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 5, "desc" ]],
            }
        );

        // VALIDASI INPUT NUMBER
        $('input[type=number][max]:not([max=""])').on('input', function(ev) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
            $this.val(value.substr(0, maxlength));
            }
        });
        $('#rm').change(function() { 
            if (this.value == '') {
                $("#nama1").val("");
                $("#nama2").val("");
                $("#jns_kelamin1").val("");
                $("#jns_kelamin2").val("");
                $("#umur1").val("");
                $("#umur2").val("");
                $("#alamat1").val("");
                $("#alamat2").val("");
            } else {
                $.ajax({
                    // url: "http://103.155.246.25:8000/api/all/"+this.value,
                    url: "http://192.168.1.3:8000/api/all/"+this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        // console.log(res);
                        $("#nama1").val(res.NAMAPASIEN);
                        $("#nama2").val(res.NAMAPASIEN);
                        $("#jns_kelamin1").val(res.JNSKELAMIN);
                        $("#jns_kelamin2").val(res.JNSKELAMIN);
                        $("#umur1").val(res.UMUR);
                        $("#umur2").val(res.UMUR);
                        $("#alamat1").val(res.ALAMAT);
                        $("#alamat2").val(res.ALAMAT);
                        // $('#jumlah20').attr('required', true);
                    }
                });
                $.ajax({
                    url: "http://103.155.246.25:8000/api/all/"+this.value,
                    // url: "http://192.168.1.3:8000/api/all/"+this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        // console.log(res);
                        $("#nama1").val(res.NAMAPASIEN);
                        $("#nama2").val(res.NAMAPASIEN);
                        $("#jns_kelamin1").val(res.JNSKELAMIN);
                        $("#jns_kelamin2").val(res.JNSKELAMIN);
                        $("#umur1").val(res.UMUR);
                        $("#umur2").val(res.UMUR);
                        $("#alamat1").val(res.ALAMAT);
                        $("#alamat2").val(res.ALAMAT);
                        // $('#jumlah20').attr('required', true);
                    }
                });
            }
        });
    } );
</script>

@endsection