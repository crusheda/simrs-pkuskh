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
                                                @foreach($list['show'] as $key => $item)
                                                <tr>
                                                    <td>
                                                        @php
                                                            echo \App\Models\dokter::where('id', $item->dr_pengirim)->pluck('nama')->first();
                                                        @endphp
                                                    </td>
                                                    <td><b>{{ $item->rm }}</b></td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->jns_kelamin }} / {{ $item->umur }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->tgl }}</td>
                                                    <td>
                                                        @if ($item->hasil == "POSITIF")
                                                            <kbd style="background-color: red">{{ $item->hasil }}</kbd>
                                                        @else
                                                            <kbd style="background-color: royalblue">{{ $item->hasil }}</kbd>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                        </center><hr>
                                                        <a type="button" class="btn btn-success btn-block btn-sm" href="{{ route('lab.antigen.cetak', $item->id) }}"><i class="fa-fw fas fa-print nav-icon"></i></a>
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
                            <input type="number" name="rm" id="rm" max="999999" class="form-control" placeholder="" autofocus required><br>
                        </div>
                        <div class="col-md-6">
                            <label>Pemeriksa :</label>
                            <input type="text" name="pemeriksa" id="pemeriksa" class="form-control" placeholder="Optional"><br>
                        </div>
                        <div class="col-md-4">
                            <label>Tgl :</label>
                            <input type="datetime-local" name="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list['now'])); ?>" required><br>
                        </div>
                        <div class="col-md-8">
                            <label>Dokter Pengirim :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="dr_pengirim" id="dr_pengirim" required>
                                    <option value="" hidden>Pilih</option>
                                        @foreach($list['dokter'] as $key => $item)
                                            <option value="{{ $item->id }}"><label><b>{{ $item->jabatan }}</b></label> - {{ $item->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Hasil :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="hasil" id="hasil" required>
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
                            <input type="text" name="kec" id="kec" class="form-control" hidden>
                            <input type="text" name="kab" id="kab" class="form-control" hidden>
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
                {{ Form::model($item, array('route' => array('lab.antigen.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <label>RM :</label>
                            <input type="number" name="rm" max="999999" value="{{ $item->rm }}" class="form-control" hidden><br>
                            <input type="number" value="{{ $item->rm }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-6">
                            <label>Pemeriksa :</label>
                            <input type="text" name="pemeriksa" value="{{ $item->pemeriksa }}" class="form-control" placeholder="Optional"><br>
                        </div>
                        <div class="col-md-4">
                            <label>Tgl :</label>
                            <input type="datetime-local" name="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->tgl)); ?>"><br>
                        </div>
                        <div class="col-md-8">
                            <label>Dokter Pengirim :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="dr_pengirim">
                                    <option value="" hidden>Pilih</option>
                                    @foreach($list['dokter'] as $key)
                                        <option value="{{ $key->id }}" @if ($item->dr_pengirim == $key->id) echo selected @endif><label>{{ $key->jabatan }}</label> - {{ $key->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Hasil :</label>
                            <div class="input-group mb-3">
                                <select class="custom-select" name="hasil" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="POSITIF" @if ($item->hasil == 'POSITIF') echo selected @endif>POSITIF</option>
                                    <option value="NEGATIF" @if ($item->hasil == 'NEGATIF') echo selected @endif>NEGATIF</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Nama :</label>
                            <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" placeholder="" hidden required>
                            <input type="text" value="{{ $item->nama }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Jenis Kelamin :</label>
                            <input type="text" name="jns_kelamin" value="{{ $item->jns_kelamin }}" class="form-control" hidden>
                            <input type="text" value="{{ $item->jns_kelamin }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Umur :</label>
                            <input type="text" name="umur" value="{{ $item->umur }}" class="form-control" hidden>
                            <input type="text" value="{{ $item->umur }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-12">
                            <label>Alamat :</label>
                            <textarea class="form-control" name="alamat3" placeholder="" maxlength="190" rows="8" hidden><?php echo htmlspecialchars($item->alamat); ?></textarea>
                            <textarea class="form-control" disabled><?php echo htmlspecialchars($item->alamat); ?></textarea>
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
                    Hapus Hasil Antigen <kbd>ID : {{ $item->id }}</kbd> ?
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        @if(count($list) > 0)
                            <b> Dokter Pengirim</b> : @php echo \App\Models\dokter::where('id', $item->dr_pengirim)->pluck('nama')->first(); @endphp<br>
                            <b> Pemeriksa</b> : {{ $item->pemeriksa }}<br>
                            <b> RM</b> : {{ $item->rm }}<br>
                            <b> PASIEN</b> : {{ $item->nama }}<br>
                            <b> UMUR</b> : {{ $item->umur }}<br>
                            <b> HASIL</b> : {{ $item->hasil }}
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
                // paging: true,
                // searching: true,
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                order: [[ 5, "desc" ]],
            }
        );

        $("body").addClass('brand-minimized sidebar-minimized');

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
                $("#umur2").val("");
                $("#umur1").val("");
                $("#alamat1").val("");
                $("#alamat2").val("");
            } else {
                $.ajax({
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
                        
                        $("#kec").val(res.KECAMATAN);
                        $("#kab").val(res.NAMA_KABKOTA);
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

                        $("#kec").val(res.KECAMATAN);
                        $("#kab").val(res.NAMA_KABKOTA);
                        // $('#jumlah20').attr('required', true);
                    }
                });
            }
        });
        // $('#rm_edit').change(function() { 
        //     if (this.value == '') {
        //         $("#nama3").val("");
        //         $("#nama4").val("");
        //         $("#jns_kelamin3").val("");
        //         $("#jns_kelamin4").val("");
        //         $("#umur3").val("");
        //         $("#umur4").val("");
        //         $("#alamat3").val("");
        //         $("#alamat4").val("");
        //     } else {
        //         $.ajax({
        //             // url: "http://103.155.246.25:8000/api/all/"+this.value,
        //             url: "http://192.168.1.3:8000/api/all/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 // console.log(res);
        //                 $("#nama3").val(res.NAMAPASIEN);
        //                 $("#nama4").val(res.NAMAPASIEN);
        //                 $("#jns_kelamin3").val(res.JNSKELAMIN);
        //                 $("#jns_kelamin4").val(res.JNSKELAMIN);
        //                 $("#umur3").val(res.UMUR);
        //                 $("#umur4").val(res.UMUR);
        //                 $("#alamat3").val(res.ALAMAT);
        //                 $("#alamat4").val(res.ALAMAT);
        //                 // $('#jumlah20').attr('required', true);
        //             }
        //         });
        //         $.ajax({
        //             url: "http://103.155.246.25:8000/api/all/"+this.value,
        //             // url: "http://192.168.1.3:8000/api/all/"+this.value,
        //             type: 'GET',
        //             dataType: 'json', // added data type
        //             success: function(res) {
        //                 // console.log(res);
        //                 $("#nama3").val(res.NAMAPASIEN);
        //                 $("#nama4").val(res.NAMAPASIEN);
        //                 $("#jns_kelamin3").val(res.JNSKELAMIN);
        //                 $("#jns_kelamin4").val(res.JNSKELAMIN);
        //                 $("#umur3").val(res.UMUR);
        //                 $("#umur4").val(res.UMUR);
        //                 $("#alamat3").val(res.ALAMAT);
        //                 $("#alamat4").val(res.ALAMAT);
        //                 // $('#jumlah20').attr('required', true);
        //             }
        //         });
        //     }
        // });
    } );
</script>

@endsection