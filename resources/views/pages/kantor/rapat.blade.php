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
                        Tambah
                    </a>
                </div>
            </div><hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="table_rapat" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>KEGIATAN</th>
                                                <th>KETUA</th>
                                                <th>WAKTU</th>
                                                <th>LOKASI</th>
                                                <th>KET</th>
                                                <th>UPDATE</th>
                                                <th>USER</th>
                                                <th><center>#</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($list) > 0)
                                            @foreach($list['show'] as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>
                                                    @foreach($list['user'] as $key => $val)
                                                        @if ($val->id == $item->kepala) {{ $val->nama }} @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMM Y, HH:mm a') }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->nama_user }}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group" role="group">
                                                            @if ($item->title1 != null)
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#lihatFile{{ $item->id }}"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>   
                                                            @else
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#download{{ $item->id }}"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>   
                                                            @endif
                                                            @if (\Carbon\Carbon::parse($item->created_at)->isoFormat('YYYY/MM/DD') ==  $list['today'])
                                                                @if(Auth::user()->id == $item->id_user)
                                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubahFile{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusFile{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                                @endif
                                                            @endif
                                                            @hasanyrole('it|kantor|pelayanan')
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusFile{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                            @endhasanyrole
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>KEGIATAN</th>
                                                <th>KETUA</th>
                                                <th>WAKTU</th>
                                                <th>LOKASI</th>
                                                <th>KET</th>
                                                <th>UPDATE</th>
                                                <th>USER</th>
                                                <th><center>#</center></th>
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
                <form class="form-auth-small" name="formTambah" action="{{ route('rapat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Kegiatan :</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="e.g. Rapat Rutin Unit ***" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Ketua Rapat : </label>
                                <select class="fstdropdown-select" id="kepala" name="kepala" required>
                                    <option value="Pilih" selected hidden>Pilih</option>
                                    @foreach($list['user'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal :</label>
                                <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list['tgl'])); ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Lokasi Rapat :</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Ruang ***" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="" maxlength="190" rows="8"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <p>Upload <b>(Bisa lebih dari satu file)</b></p>
                        <input type="file" name="file2[]" id="file2" multiple required><br>
                        <sub>Berkas : Undangan / Materi / Absensi / Notulen / Dokumentasi.</sub><br>
                        <span class="help-block text-danger">{{ $errors->first('file2') }}</span>
                    </div>
            </div>
            <div class="modal-footer">

                    <button class="btn btn-success" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Kegiatan :</label>
                                <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Ketua Rapat : </label>
                                <select class="fstdropdown-select" name="kepala" required>
                                    @foreach($list['user'] as $key => $val)
                                        <option value="{{ $val->id }}" @if ($val->id == $item->kepala) echo selected @endif>{{ $val->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal :</label>
                                <input type="datetime-local" name="tanggal" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->tanggal)); ?>" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Lokasi Rapat :</label>
                                <input type="text" name="lokasi" value="{{ $item->lokasi }}" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" maxlength="190" rows="8"><?php echo htmlspecialchars($item->keterangan); ?></textarea>
                    </div>
                    
            </div>
            <div class="modal-footer">
                    @if ($item->nama_user != null) <a><b>User :</b>&nbsp;{{ $item->nama_user }}</a>@endif
                    <button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
                    @if ($item->title1 != null)
                        <a onclick="window.location.href='{{ url('rapat/show/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>   {{ $item->title1 }} ({{Storage::size($item->filename1)}} bytes)<p></p>
                    @else
                        -<p></p>
                    @endif
                    @if ($item->title2 != null)
                        @if (substr($item->title2,0,2) == '["')
                            <a onclick="window.location.href='{{ url('rapat/show2all/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ str_replace(['"','[',']'],'',json_encode(json_decode($item->title2))) }} <b>(ZIP)</b><p></p>
                        @else
                            <a onclick="window.location.href='{{ url('rapat/show2/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ $item->title2 }} ({{Storage::size($item->filename2)}} bytes)<p></p>
                        @endif
                    @else
                        -<p></p>
                    @endif
                    @if ($item->title3 != null)
                        <a onclick="window.location.href='{{ url('rapat/show3/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ $item->title3 }} ({{Storage::size($item->filename3)}} bytes)<p></p>
                    @else
                        -<p></p>
                    @endif
                    @if ($item->title4 != null)
                        <a onclick="window.location.href='{{ url('rapat/show4/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a>  {{ $item->title4 }} ({{Storage::size($item->filename4)}} bytes)<p></p>
                    @else
                        -<p></p>
                    @endif
                </p>
                </div>
                <div class="modal-footer">
                    <p class="pull-left"><td>{{ $item->updated_at->diffForHumans() }}</td></p>
                </div>
            </div>
            </div>
        </div>
    @endforeach

    @foreach($list['show'] as $item)
        <div class="modal fade bd-example-modal-lg" id="download{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    {{ $item->nama }}'s Files
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h5>Deskripsi File:</h5>
                    @if ($item->title2 != null)
                        @foreach (str_replace(['"','[',']'],'',json_decode($item->title2)) as $val)
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> {{ $val }} <br>
                        @endforeach
                    @endif
                    <p></p>
                    <h6>File download akan digabungkan dan dikonversikan dalam bentuk <kbd>ZIP FILE</kbd></h6>
                </div>
                <div class="modal-footer">
                    <a>{{ $item->updated_at->diffForHumans() }}</a>
                    <button type="button" onclick="window.location.href='{{ url('rapat/zip/'. $item->id) }}'" class="btn btn-success text-white"><i class="fa fa-download"></i> Download</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
                </div>
            </div>
            </div>
        </div>
    @endforeach

<script>
    $(document).ready( function () {
        $('#table_rapat').DataTable(   
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'colvis'
                ],
                'columnDefs': [
                    { "width": "8%", "targets": 8 },
                    { targets: 0, visible: false },
                    { targets: 7, visible: false },
                ],
                language: {
                    buttons: {
                        colvis: 'Sembunyikan Kolom',
                        excel: 'Jadikan Excell',
                        pdf: 'Jadikan PDF',
                    }
                },
                order: [[ 3, "desc" ]]
            }
        );
    } );
    
    function saveData() {
        $("#tambah").one('submit', function() {
            //stop submitting the form to see the disabled button effect
            let x = document.forms["formTambah"]["kepala"].value;
            if (x == "Pilih") {

                Swal.fire({
                    position: 'top',
                    title: 'Perhatian',
                    text: 'Mohon untuk memilih Ketua Rapat',
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
</script>

@endsection