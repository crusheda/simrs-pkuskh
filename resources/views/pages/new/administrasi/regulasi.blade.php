@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h4>Tabel Regulasi</h4>   
        </div>
        <div class="card-body">
            <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                <i class="fa-fw fas fa-plus-square nav-icon">

                </i>
                Tambah
            </a>
            <hr>
            <div class="table-responsive">
                <table id="regulasi" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DISAHKAN</th>
                            <th>JUDUL</th>
                            <th>JENIS</th>
                            <th>USER</th>
                            <th>UNIT</th>
                            <th>KETERANGAN</th>
                            <th>DIBUAT</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->sah)->isoFormat('D MMMM Y') }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>
                                @foreach($list['user'] as $items)
                                    @if ($item->id_user == $items->id) {{ $items->nama }} @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach (json_decode($item->unit) as $key => $value)
                                    <kbd>{{ $value }}</kbd>
                                @endforeach
                            </td>
                            <td>{{ $item->ket }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <center>
                                    @role('it|kantor')
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#note{{ $item->id }}"><i class="fa-fw fas fa-sticky-note nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('regulasi/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
                                    @else
                                        <div class="btn-group" role="group">
                                            {{-- <button type="button" class="btn btn-info btn-sm" onclick="showNote({{ $item->id }})"><i class="fa-fw fas fa-pencil-square nav-icon text-white"></i></button> --}}
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#note{{ $item->id }}"><i class="fa-fw fas fa-sticky-note nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('regulasi/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>
                                            @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['today'])
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                            @endif
                                        </div>
                                    @endrole
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

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Regulasi
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('regulasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Pengesahan :</label>
                            <input type="date" name="sah" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Jenis</label>
                            <select name="jenis" class="form-control" required>
                              <option hidden>Pilih</option>
                              <option value="SPO">SPO</option>
                              <option value="PEDOMAN">Pedoman</option>
                              <option value="PANDUAN">Panduan</option>
                              <option value="KEBIJAKAN">Kebijakan</option>
                              <option value="PROGRAM">Program</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Keterangan :</label>
                            <textarea class="form-control" name="ket" id="ket1" maxlength="190" rows="8"></textarea>
                            <span class="help-block">
                                <p id="maxtambah" class="help-block "></p>
                            </span>  
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Dokumen : </label>
                    <input type="file" name="file" required>
                </div>
        </div>
        <div class="modal-footer">

                <button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
            Ubah Regulasi&nbsp;<span class="pull-right badge badge-info text-white">ID : {{ $item->id }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('regulasi.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Pengesahan :</label>
                            <input type="date" name="sah" value="<?php echo strftime('%Y-%m-%d', strtotime($item->sah)); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Jenis</label>
                            <select name="jenis" class="form-control" required>
                              <option hidden>Pilih</option>
                              <option value="SPO"       @if ($item->jenis == 'SPO') echo selected @endif>SPO</option>
                              <option value="PEDOMAN"   @if ($item->jenis == 'PEDOMAN') echo selected @endif>Pedoman</option>
                              <option value="PANDUAN"   @if ($item->jenis == 'PANDUAN') echo selected @endif>Panduan</option>
                              <option value="KEBIJAKAN" @if ($item->jenis == 'KEBIJAKAN') echo selected @endif>Kebijakan</option>
                              <option value="PROGRAM"   @if ($item->jenis == 'PROGRAM') echo selected @endif>Program</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Keterangan :</label>
                            <textarea class="form-control" name="ket" id="ket2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->ket); ?></textarea>
                            <span class="help-block">
                                <p id="maxubah" class="help-block "></p>
                            </span>  
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Detail Dokumen : </label>
                    @if ($item->filename == '')
                    -
                    @else
                        <b><a href="regulasi/{{ $item->id }}">{{ $item->title }}</a></b> ({{ number_format(Storage::size($item->filename) / 1048576,2) }} MB)
                    @endif
                </div>
        </div>
        <div class="modal-footer">
                <a>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</a>
                <button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Regulasi <b>{{ $item->judul }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('regulasi.destroy', $item->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade" id="note{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Catatan Regulasi&nbsp;<span class="pull-right badge badge-info text-white">ID : {{ $item->id }}</span></b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body modal-note">
            {{ Form::model($item, array('route' => array('regulasi.note', $item->id), 'method' => 'PUT')) }}
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Tambah Catatan :</label>
                        <textarea class="form-control" name="note" placeholder="" maxlength="190" rows="5" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button class="btn btn-success pull-right"><i class="fa-fw fas fa-plus-square nav-icon"></i> Tambah Catatan</button>
                </div>
            </div>
            {!! Form::close() !!}
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive" style="width: 100%">
                        <table id="catatan{{ $item->id }}" class="table table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CATATAN</th>
                                    <th>UPDATE</th>
                                    <th><center>#</center></th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['note']) > 0)
                                    @foreach($list['note'] as $items)
                                        @if ($item->id == $items->id_regulasi)
                                            @if (Auth::user()->id == $items->id_user)
                                                @if (\Carbon\Carbon::parse($items->updated_at)->isoFormat('YYYY/MM/DD') == $list['today'])
                                                    <tr>
                                                        <td>{{ $items->id }}</td>
                                                        <td>
                                                            <textarea class="form-control" name="note" placeholder="" maxlength="190" rows="5" required><?php echo htmlspecialchars($items->note); ?></textarea>
                                                        </td>
                                                        <td>{{ $items->updated_at }}</td>
                                                        <td>
                                                            <center>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='{{ url('regulasi/note/edit/'. $items->id) }}'"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='{{ url('regulasi/note/hapus/'. $items->id) }}'"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                                </div>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{ $items->id }}</td>
                                                        <td>{{ $items->note }}</td>
                                                        <td>{{ $items->updated_at }}</td>
                                                        <td>
                                                            <center>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                    <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-trash nav-icon text-white"></i></button>
                                                                </div>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @else
                                                <tr>
                                                    <td>{{ $items->id }}</td>
                                                    <td>{{ $items->note }}</td>
                                                    <td>{{ $items->updated_at }}</td>
                                                    <td>
                                                        <center>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-trash nav-icon text-white"></i></button>
                                                            </div>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#regulasi').DataTable(
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
            order: [[ 7, "desc" ]]
        }
    );
} );
// function showNote(id) {
//     $('#catatan'+id).DataTable(
//         {
//             destroy: true,
//             paging: true,
//             searching: true,
//             dom: 'Bfrtip',
//             buttons: [
//                 'excel', 'pdf','colvis'
//             ],
//             order: [[ 2, "desc" ]]
//         }
//     );
//     $('#note'+id).modal('show');
// }
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