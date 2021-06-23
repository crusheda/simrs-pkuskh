@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-calendar-plus-o nav-icon text-info">

            </i>
            Berkas Rapat

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                        <i class="fa-fw fas fa-plus-square nav-icon">

                        </i>
                        Tambah Rapat
                    </a>
                </div>
            </div><br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="table_rapat" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>KEGIATAN</th>
                                                <th>KETUA</th>
                                                <th>WAKTU</th>
                                                <th>LOKASI</th>
                                                <th>KET</th>
                                                <th>UPDATE</th>
                                                <th><center>ACTION</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($list) > 0)
                                            @foreach($list['show'] as $item)
                                            <tr>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->kepala }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <center>
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#lihatFile{{ $item->id }}"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>
                                                        @hasanyrole('kantor|pelayanan')
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubahFile{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusFile{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                        @endhasanyrole
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
                                        <tfoot>
                                            <tr>
                                                <th>KEGIATAN</th>
                                                <th>KETUA</th>
                                                <th>WAKTU</th>
                                                <th>LOKASI</th>
                                                <th>KET</th>
                                                <th>UPDATE</th>
                                                <th><center>ACTION</center></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Tambah Berkas Rapat
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-auth-small" action="{{ route('rapat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <label>Kegiatan :</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="" required>
                            <br>
                            <label>Ketua Rapat :</label>
                            <input type="text" name="kepala" id="kepala" class="form-control" placeholder="">
                            <br>
                            <label>Tanggal :</label>
                            <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" placeholder="" required>
                            <br>
                            <label>Lokasi Rapat :</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                            <br>
                            <label>Keterangan :</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="" maxlength="190" rows="8"></textarea><br>
                        </div>
                        <div class="col-md-5">
                            <p><b>Undangan</b></p>
                            <input type="file" name="file1" id="file1">
                            <span class="help-block text-danger">{{ $errors->first('file1') }}</span><hr>
                            <p><b>Materi</b> (Bisa lebih dari satu file PDF)</p>
                            <input type="file" name="file2[]" id="file2" multiple>
                            <span class="help-block text-danger">{{ $errors->first('file2') }}</span><hr>
                            <p><b>Absensi</b></p>
                            <input type="file" name="file3">
                            <span class="help-block text-danger">{{ $errors->first('file3') }}</span><hr>
                            <p><b>Notulen</b></p>
                            <input type="file" name="file4">
                            <span class="help-block text-danger">{{ $errors->first('file4') }}</span><hr>
                            <p><b>Dokumentasi</b></p>
                            <input type="file" name="file5">
                            <span class="help-block text-danger">{{ $errors->first('file5') }}</span>
                        </div>
                    </div>
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
    <div class="modal fade bd-example-modal-lg" id="ubahFile{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Rapat&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('rapat.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <label>Kegiatan :</label>
                    <input type="text" name="nama" id="nama" value="{{ $item->nama }}" class="form-control" placeholder="" required>
                    <br>
                    <label>Ketua Rapat :</label>
                    <input type="text" name="kepala" id="kepala" value="{{ $item->kepala }}" class="form-control" placeholder="">
                    <br>
                    <label>Tanggal :</label>
                    <input type="datetime-local" name="tanggal" id="tanggal" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->tanggal)); ?>" class="form-control" placeholder="" required>
                    <br>
                    <label>Lokasi Rapat :</label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ $item->lokasi }}" class="form-control" placeholder="">
                    <br>
                    <label>Keterangan :</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" maxlength="190" rows="8"><?php echo htmlspecialchars($item->keterangan); ?></textarea>
                    
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
    <div class="modal fade bd-example-modal-lg" id="hapusFile{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Yakin ingin Menghapus Dokumen Rapat <b>{{ $item->nama }} ?</b>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        @if(count($list) > 0)
                        <div class="row">
                            <div class="col-2">
                            <b> Undangan</b> <br>
                            <b> Materi</b> <br>
                            <b> Absensi</b> <br>
                            <b> Notulen</b>
                            </div>
                            <div class="col-10">
                                : {{ $item->title1 }} ({{Storage::size($item->filename1)}} bytes) <br>
                                @if (substr($item->title2,0,2) == '["')
                                    : {{ str_replace(['"','[',']'],'',json_encode(json_decode($item->title2))) }} <b>(ZIP)</b> <br>
                                @else
                                    : {{ $item->title2 }} ({{Storage::size($item->filename2)}} bytes) <br>
                                @endif
                                : {{ $item->title3 }} ({{Storage::size($item->filename3)}} bytes) <br>
                                : {{ $item->title4 }} ({{Storage::size($item->filename4)}} bytes)
                            </div>
                        </div>
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    @if(count($list) > 0)
                        <form action="{{ route('rapat.destroy', $item->id) }}" method="POST">
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

    @foreach($list['show'] as $item)
        <div class="modal fade bd-example-modal-lg" id="lihatFile{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    {{ $item->nama }}'s Files
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                <p>
                    Download File: <p></p>
                    <a onclick="window.location.href='{{ url('rapat/show/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>   {{ $item->title1 }} ({{Storage::size($item->filename1)}} bytes)<p></p>
                    @if (substr($item->title2,0,2) == '["')
                        <a onclick="window.location.href='{{ url('rapat/show2all/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ str_replace(['"','[',']'],'',json_encode(json_decode($item->title2))) }} <b>(ZIP)</b><p></p>
                    @else
                        <a onclick="window.location.href='{{ url('rapat/show2/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ $item->title2 }} ({{Storage::size($item->filename2)}} bytes)<p></p>
                    @endif
                    <a onclick="window.location.href='{{ url('rapat/show3/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ $item->title3 }} ({{Storage::size($item->filename3)}} bytes)<p></p>
                    <a onclick="window.location.href='{{ url('rapat/show4/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ $item->title4 }} ({{Storage::size($item->filename4)}} bytes)<p></p>
                </p>
                </div>
                <div class="modal-footer">
                    <p class="pull-left"><td>{{ $item->updated_at->diffForHumans() }}</td></p>
                </div>
            </div>
            </div>
        </div>
    @endforeach

<script>
    $(document).ready( function () {
        $('#table_rapat').DataTable();
    } );
</script>

@endsection