@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-dark pull-left" onclick="window.location.href='{{ url('pengaduan/ipsrs') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button>
            </div>
            @if (empty($list['show'][0]->filename_pengaduan))
                <img class="card-img-top img-thumbnail" src="{{ url('img/no_image.jpg') }}" height="300" alt="Card image cap">
            @else
                <img class="card-img-top img-thumbnail" src="{{ url('storage/'.substr($list['show'][0]->filename_pengaduan,7,1000)) }}" height="300" alt="Card image cap">
            @endif
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Status : <b></b></li>
              <li class="list-group-item">Nama : <b>{{ $list['show'][0]->nama }}</b></li>
              <li class="list-group-item">Unit : <b>{{ $list['show'][0]->unit }}</b></li>
            </ul>
            <div class="card-body">
                @if (!empty($list['show'][0]->filename_pengaduan))
                    <center><button type="button" onclick="window.location.href='{{ url('pengaduan/ipsrs/'. $list['show'][0]->id) }}'" class="btn btn-dark">Download Lampiran</button></center>
                @else
                    <center><button type="button" class="btn btn-secondary" disabled>Download Lampiran</button></center>
                @endif
            </div>
        </div>
        <div class="card">
            @if (!empty($list['show'][0]->tgl_diterima))
                @if (!empty($list['show'][0]->tgl_dikerjakan))
                    @if (!empty($list['show'][0]->tgl_selesai))
                        @if (!empty($list['show'][0]->ket_penolakan))
                            <div class="card-body">
                                Status : <kbd style="background-color: red">PENGADUAN DITOLAK</kbd>
                            </div>
                        @else
                            <div class="card-body">
                                Status : <kbd style="background-color: turquoise">PENGADUAN SELESAI</kbd>
                            </div>
                        @endif
                    @else
                        <div class="card-body">
                            <a class="btn btn-warning text-white pull-left" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa-fw fas fa-plus nav-icon"></i> Catatan</a>
                            
                            <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#selesai{{ $list['show'][0]->id }}"><i class="fa-fw fas fa-thumbs-up nav-icon"></i> Selesai</button>
                            <br><br>
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                {{ Form::model($list['show'][0], array('route' => array('pengaduan.ipsrs.tambahketerangan', $list['show'][0]->id), 'method' => 'POST', 'enctype' => 'multipart/form-data')) }}
                                        {{-- {{ $item->id }} --}}
                                    <br><label>Catatan (Optional) : </label><br>
                                    <input type="text" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                                    <textarea class="form-control" name="ket" id="ket_catatan1" placeholder="" maxlength="190" rows="8"></textarea>
                                    <span class="help-block">
                                        <p id="max_ket_catatan1" class="help-block "></p>
                                    </span>
                                    <label>Lampiran (Optional) : </label><br>
                                    <input type="file" class="form-control" name="catatan"><br>
                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    @endif
                @else
                    {{ Form::model($list['show'][0], array('route' => array('pengaduan.ipsrs.kerjakan', $list['show'][0]->id), 'method' => 'POST')) }}
                        <div class="card-body">
                            <h6>Kerjakan Laporan Sekarang?</h6>
                            <sub>Tuliskan Keterangan (Optional) :</sub>
                            <input type="text" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                            <textarea class="form-control" name="ket" id="ket_dikerjakan1" placeholder="" maxlength="190" rows="8"></textarea>
                            <span class="help-block">
                                <p id="max_ket_dikerjakan1" class="help-block "></p>
                            </span>
                            <center><button type="submit" class="btn btn-success">SUBMIT</button></center>
                        </div>
                    {{ Form::close() }}
                @endif
            @else
                @if (!empty($list['show'][0]->ket_penolakan))
                    <div class="card-body">
                        Status : <kbd style="background-color: red">PENGADUAN DITOLAK</kbd>
                    </div>
                @else
                    <div class="card-body">
                        <h5 class="text-center">Verifikasi Laporan ini?</h5><hr>
                        <button type="button" class="btn btn-success pull-left" value="0" id="btnterima"><i class="fa-fw fas fa-check-square nav-icon"></i> TERIMA</button>
                        <button type="button" class="btn btn-danger pull-right" value="0" id="btntolak"><i class="fa-fw fas fa-window-close nav-icon"></i> TOLAK</button>
                        <br><br>
                        <div id="terima" hidden>
                            {{ Form::model($list['show'][0], array('route' => array('pengaduan.ipsrs.terima', $list['show'][0]->id), 'method' => 'POST')) }}
                                <hr>
                                <h6 class="text-left">Keterangan Terima Laporan :</h6>
                                <input type="text" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                                <textarea class="form-control" name="ket" id="ket_verifikasi1" placeholder="" maxlength="190" rows="8"></textarea>
                                <span class="help-block">
                                    <p id="max_ket_verifikasi1" class="help-block "></p>
                                </span>
                                <center><button type="submit" class="btn btn-dark">SUBMIT</button></center>
                            {{ Form::close() }}
                        </div>
                        <div id="tolak" hidden>
                            {{ Form::model($list['show'][0], array('route' => array('pengaduan.ipsrs.tolak', $list['show'][0]->id), 'method' => 'POST')) }}
                                <hr>
                                <h6 class="text-left">Keterangan Tolak Laporan :</h6>
                                <input type="text" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                                <textarea class="form-control" name="ket" id="ket_verifikasi2" placeholder="" maxlength="190" rows="8" required></textarea>
                                <span class="help-block">
                                    <p id="max_ket_verifikasi2" class="help-block "></p>
                                </span>
                                <center><button type="submit" class="btn btn-dark">SUBMIT</button></center>
                            {{ Form::close() }}
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-wrench nav-icon text-info">

                </i> Detail Pengaduan <kbd>ID : {{ $list['show'][0]->id }}</kbd>

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses IPSRS
                </span>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Tgl Pengaduan :</label>
                        <input type="text" class="form-control" value="{{ $list['show'][0]->tgl_pengaduan }}" aria-label="Name" aria-describedby="basic-addon1" disabled><br>
                    </div>
                    <div class="col-md-6">
                        <label>Tgl Diverifikasi :</label>
                        <input type="text" class="form-control" value="{{ $list['show'][0]->tgl_diterima }}" aria-label="Name" aria-describedby="basic-addon1" disabled><br>
                    </div>
                    <div class="col-md-12">
                        <label>Pengaduan :</label>
                        <textarea class="form-control" placeholder="" style="min-height: 100px" maxlength="190" rows="5" disabled><?php echo htmlspecialchars($list['show'][0]->ket_pengaduan); ?></textarea>
                    </div>
                    @if ($list['show'][0]->ket_diterima)
                        @if (!empty($list['show'][0]->tgl_dikerjakan))
                            <div class="col-md-12">
                                <hr>
                                <label>Keterangan Verifikasi :</label>
                                <textarea class="form-control" placeholder="" style="min-height: 100px" maxlength="190" rows="5" disabled><?php echo htmlspecialchars($list['show'][0]->ket_diterima); ?></textarea>
                            </div>
                        @else
                            <div class="col-md-12">
                                {{ Form::model($list['show'][0], array('route' => array('pengaduan.ipsrs.ubah.terima', $list['show'][0]->id), 'method' => 'POST')) }}
                                    <hr>
                                    <label>Keterangan Verifikasi :</label>
                                    <input type="text" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                                    <textarea class="form-control" placeholder="" style="min-height: 100px" maxlength="190" rows="5" name="ket" required><?php echo htmlspecialchars($list['show'][0]->ket_diterima); ?></textarea><br>
                                    <button type="submit" class="btn btn-warning text-white pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                {{ Form::close() }}
                            </div>
                        @endif
                    @endif
                    @if ($list['show'][0]->ket_penolakan)
                        <div class="col-md-12">
                            <hr>
                            <label>Keterangan Penolakan :</label>
                            <textarea class="form-control" placeholder="" style="min-height: 100px" maxlength="190" rows="5" disabled><?php echo htmlspecialchars($list['show'][0]->ket_penolakan); ?></textarea>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (!empty($list['show'][0]->tgl_dikerjakan))
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-truck nav-icon text-danger">

                </i> Detail Dikerjakan <kbd> {{ $list['show'][0]->tgl_dikerjakan }} </kbd>
                
            </div>
            <div class="card-body">
                <div class="row">
                    @if (!empty($list['show'][0]->tgl_dikerjakan))
                        <div class="col-md-12">
                            @if (!empty($list['show'][0]->tgl_selesai))
                                <label>Keterangan Mulai Dikerjakan :</label>
                                <textarea class="form-control" placeholder="" style="min-height: 100px" maxlength="190" rows="5" disabled><?php echo htmlspecialchars($list['show'][0]->ket_dikerjakan); ?></textarea>
                            @else
                                {{ Form::model($list['show'][0], array('route' => array('pengaduan.ipsrs.ubah.kerjakan', $list['show'][0]->id), 'method' => 'POST')) }}
                                    <label>Keterangan Mulai Dikerjakan :</label>
                                    <input type="text" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                                    <textarea class="form-control" placeholder="" style="min-height: 100px" maxlength="190" rows="5" name="ket" id="ket_dikerjakan2"><?php echo htmlspecialchars($list['show'][0]->ket_dikerjakan); ?></textarea>
                                    <span class="help-block">
                                        <p id="max_ket_dikerjakan2" class="help-block "></p>
                                    </span>
                                    <button type="submit" class="btn btn-warning text-white pull-right" style="margin-top: -10px"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                {{ Form::close() }}
                            @endif
                        </div>
                    @endif
                    <div class="col-md-12">
                        <hr>
                        <h5 class="text-center"><b>Catatan Pengerjaan</b></h5>
                        <div class="table-responsive">
                            <table id="dikerjakan" class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>File</th>
                                        <th>Tgl</th>
                                        <th><center>AKSI</center></th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['dikerjakan']) > 0)
                                    @foreach($list['dikerjakan'] as $item)
                                    <tr>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <center>
                                            {{-- Tombol Ubah --}}
                                            @if (!empty($list['show'][0]->tgl_selesai))
                                                <button type="button" class="btn btn-secondary" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            @else
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ubahCatatan{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            @endif
                                            {{-- Tombol Download --}}
                                            @if (!empty($item->title))
                                                <button class="btn btn-success" onclick="window.location.href='{{ url('pengaduan/ipsrs/lampiran/catatan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                            @else
                                                <button class="btn btn-secondary" disabled><i class="fa-fw fas fa-download nav-icon"></i></button>
                                            @endif
                                            </center>
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
        </div>
        @endif
    </div>
</div>

{{-- Selesai Pengaduan --}}
<div class="modal" tabindex="-1" id="selesai{{ $list['show'][0]->id }}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Laporan Pengaduan&nbsp;<kbd>ID : {{ $list['show'][0]->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Apakah anda yakin ingin menyelesaikan laporan pengaduan dari <kbd>{{ $list['show'][0]->nama }}</kbd> ?
        </div>
        <div class="modal-footer">
            {{ Form::model($list['show'][0], array('route' => array('pengaduan.ipsrs.selesai', $list['show'][0]->id), 'method' => 'POST')) }}
                <input type="text" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i>&nbsp;&nbsp;Submit</button>
            {{ Form::close() }}

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

{{-- Ubah Catatan Dikerjakan --}}
@foreach($list['dikerjakan'] as $item)
<div class="modal" tabindex="-1" id="ubahCatatan{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Ubah Catatan&nbsp;<kbd>ID : {{ $item->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('pengaduan.ipsrs.ubahketerangan', $item->id), 'method' => 'POST', 'enctype' => 'multipart/form-data')) }}
                <input type="text" class="form-control" name="id" value="{{ $item->id }}" hidden>
                <textarea class="form-control" name="ket" id="ket_catatan2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->keterangan); ?></textarea>
                <span class="help-block">
                    <p id="max_ket_catatan2" class="help-block "></p>
                </span>
                
                <hr>

                @if (!empty($item->title))
                    <label>Lampiran :</label>
                    <img class="card-img-top img-thumbnail" src="{{ url('storage/'.substr($item->filename,7,1000)) }}" height="300" alt="Card image cap">
                    <br><br>
                    <label>Ubah Lampiran : </label><br>
                    <input type="file" class="form-control" name="catatan">
                @else
                    <label>Tambah Lampiran : (Optional)</label><br>
                    <input type="file" class="form-control" name="catatan">
                @endif
        </div>
        <div class="modal-footer">

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
            {{ Form::close() }}

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#pengaduan_ipsrs').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            order: [[ 3, "desc" ]]
        }
    );
    
    $('#dikerjakan').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            order: [[ 2, "desc" ]]
        }
    );
    
    $("#btnterima").click(function() {
        if ($(this).val() == "1") {
            $('#tolak').prop('hidden', true); 
            $('#terima').prop('hidden', true); 
            $(this).val("0");
        } else {
            $('#tolak').prop('hidden', true); 
            $('#terima').prop('hidden', false); 
            $(this).val("1");
        }
    });

    $("#btntolak").click(function() {
        if ($(this).val() == "1") {
            $('#tolak').prop('hidden', true); 
            $('#terima').prop('hidden', true); 
            $(this).val("0");
        } else {
            $('#tolak').prop('hidden', false); 
            $('#terima').prop('hidden', true); 
            $(this).val("1");
        }
    });

    $('#max_ket_catatan1').text('190 Limit Text');
    $('#max_ket_catatan2').text('190 Limit Text');
    $('#max_ket_dikerjakan1').text('190 Limit Text');
    $('#max_ket_dikerjakan2').text('190 Limit Text');
    $('#max_ket_verifikasi1').text('190 Limit Text');
    $('#max_ket_verifikasi1').text('190 Limit Text');
    
    $('#ket_catatan1').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#max_ket_catatan1').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#max_ket_catatan1').text(ch + ' Limit Text');     
        }
    }); 
    $('#ket_catatan2').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#max_ket_catatan2').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#max_ket_catatan2').text(ch + ' Limit Text');     
        }
    }); 
    $('#ket_dikerjakan1').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#max_ket_dikerjakan1').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#max_ket_dikerjakan1').text(ch + ' Limit Text');     
        }
    }); 
    $('#ket_dikerjakan2').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#max_ket_dikerjakan2').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#max_ket_dikerjakan2').text(ch + ' Limit Text');     
        }
    }); 
    $('#ket_verifikasi1').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#max_ket_verifikasi1').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#max_ket_verifikasi1').text(ch + ' Limit Text');     
        }
    }); 
    $('#ket_verifikasi2').keydown(function () {
        var max = 190;
        var len = $(this).val().length;
        if (len >= max) {
            $('#max_ket_verifikasi2').text('Anda telah mencapai Limit Maksimal.');          
        } 
        else {
            var ch = max - len;
            $('#max_ket_verifikasi2').text(ch + ' Limit Text');     
        }
    }); 
} );
</script>

@endsection