@extends('layouts.newAdmin')

@section('content')
@can('log_perawat')
    @role('kabag-keperawatan')
    <div class="card">
        <div class="card-header">
            <h4>Tabel</h4>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-warning text-white" onclick="window.location.href='{{ url('logprofkpr') }}'" data-toggle="tooltip" data-placement="right" title="TAMBAH INDIKATOR PROFESI KEPERAWATAN"><i class="fa-fw fas fa-plus-square nav-icon text-white"></i> Indikator</button>
            <hr>
            <div class="table-responsive">
                <table id="adminprofkpr" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>UNIT</th>
                            <th>UPDATE TERAKHIR</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->queue }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>
                                @php
                                    $data = \App\Models\profkpr::select('updated_at')->where('queue',$item->queue)->orderBy('created_at','DESC')->pluck('updated_at')->first();
                                    echo $data;
                                @endphp
                            </td>
                            <td>
                                <a type="button" class="btn btn-info btn-sm text-white" href="{{ route('profkpr.show', $item->queue) }}"><i class="fa-fw fas fa-search nav-icon"></i> Detail</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>                                
    @else
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Input</h4>
                </div>
                <div class="card-body">
                    <a type="button" class="btn btn-primary text-white btn-block" data-toggle="modal" data-target="#tambahtgs">
                        <i class="fa-fw fas fa-plus-square nav-icon"></i> Masukkan Data
                    </a>
                    <hr>
                    Data Terakhir : <kbd>@if ($list['recent'] == null) Unknown @else {{ $list['recent'] }} @endif</kbd>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Penunjang Tugas Perawat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="profkpr" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PERNYATAAN</th>
                                    <th>KETERANGAN</th>
                                    <th>TGL</th>
                                    <th class="text-center">LAMPIRAN</th>
                                    <th class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['show']) > 0)
                                <a hidden>{{ $id = 1 }}</a>
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $id++ }}</td>
                                    <td>{{ $item->pernyataan }}</td>
                                    <td>{{ $item->ket }}</td>
                                    <td>{{ $item->tgl }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#show{{ $item->id }}"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i> Detail</button>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubahLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
    </div>
    @endrole
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endcan

@role('kabag-keperawatan')
@else
    <!-- Tambah -->
    <div class="modal fade" id="tambahtgs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Profesi Keperawatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form class="form-auth-small" action="{{ route('profkpr.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label>Pernyataan :</label>
                    <select class="custom-select" name="pernyataan" id="pernyataan" required>
                        <option hidden>Pilih</option>
                        @foreach($list['log'] as $pernyataan => $item)
                            <option value="{{ $pernyataan }}">{{ $pernyataan }}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <label>Tgl :</label>
                    <input type="date" name="tgl" id="tgl" class="form-control" placeholder="">
                    <br>
                    <label>Keterangan :</label>
                    <textarea class="form-control" name="ket" id="ket" placeholder=""></textarea>
                    <hr>
                    <label>Upload Lampiran :</label><br>
                    <input type="file" name="file">
                    <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-fw fas fa-plus-square nav-icon"></i> Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Ubah -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="ubahLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Profesi Keperawatan&nbsp;<span class="pull-right badge badge-info text-white">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('profkpr.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="form-group">
                        <label>Pernyataan :</label>
                        <select class="custom-select" name="pernyataan" id="pernyataan" required>
                            @foreach($list['pernyataan'] as $key)
                                <option value="{{ $key->pernyataan }}" @if ($key->pernyataan == $item->pernyataan) echo selected @endif>{{ $key->pernyataan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tgl :</label>
                        <input type="date" name="tgl" id="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl)); ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="ket" id="ket" placeholder=""maxlength="190" rows="8"><?php echo htmlspecialchars($item->ket); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Detail Lampiran : </label>
                        @if ($item->filename == '')
                        -
                        @else
                           <b>{{ $item->title }}</b> ({{Storage::size($item->filename)}} bytes)
                        @endif
                    </div>

            </div>
            <div class="modal-footer">
                
                    <button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>
    @endforeach

    <!-- Hapus -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Yakin ingin Menghapus?&nbsp;<span class="pull-right badge badge-dark text-white">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    @if(count($list) > 0)
                        <div class="row">
                            <div class="col-md-2">
                                <a>Nama</a><br>
                                <a>Unit</a><br>
                                <a>Pernyataan</a><br>
                            </div>
                            <div class="col-md-10">
                                <a>: {{ $item->name }}</a><br>
                                <a>: {{ $item->unit }}</a><br>
                                <a>: {{ $item->pernyataan }}</a><br>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <a>Keterangan :</a><br>
                                <a style="word-wrap: break-word;"><b>{{ $item->ket }}</b></a>
                            </div>
                        </div>
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                @if(count($list) > 0)
                    <form action="{{ route('profkpr.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                @endif
            </div>
        </div>
        </div>
    </div>
    @endforeach

    @foreach($list['show'] as $item)
    <div class="modal fade" tabindex="-1" id="show{{ $item->id }}" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Update <b>{{ $item->updated_at }}</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @if ($item->filename == '')
                    <p class="text-center"><kbd>File tidak ditemukan / tidak diupload.</kbd></p>
                @else
                    Lampiran Dari <a style="text-transform: capitalize"><b>{{ $item->name }}</b></a>, Unit {{ $item->unit }}. <br>
                    <i class="fa-fw fas fa-angle-right nav-icon"></i>&nbsp;Nama File : {{ $item->title }} <br>
                    <i class="fa-fw fas fa-angle-right nav-icon"></i>&nbsp;Ukuran File : {{Storage::size($item->filename)}} bytes.
                @endif
            </div>
            <div class="modal-footer">
                @if ($item->filename == '')
                    <button type="button" class="btn btn-secondary" disabled><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Lampiran</button>
                @else
                    <button onclick="window.location.href='{{ url('profkpr/'. $item->id.'/show') }}'" type="button" class="btn btn-success"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Lampiran</button>
                @endif
            </div>
        </div>
        </div>
    </div>
    @endforeach
@endrole

<script>
    $(document).ready( function () {
        $('#profkpr').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn-info',
                    text: 'Salin Baris',
                    download: 'open',
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    text: 'Export Excell',
                    download: 'open',
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn-warning',
                    text: 'Cetak PDF',
                    download: 'open',
                },
                ],
                order: [ 3, "desc" ]
            }
        );
    } );
</script>
<script>
    $(document).ready( function () {
        $('#adminprofkpr').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn-info',
                    text: 'Salin Baris',
                    download: 'open',
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    text: 'Export Excell',
                    download: 'open',
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn-warning',
                    text: 'Cetak PDF',
                    download: 'open',
                },
                ],
                order: [[ 0, "desc" ]]
            }
        );
    } );
</script>
@endsection