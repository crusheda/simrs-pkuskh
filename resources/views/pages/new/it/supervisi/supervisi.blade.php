@extends('layouts.newAdmin')

@section('content')
@hasrole('it')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Tabel Supervisi</h4>
        </div>
        <div class="card-body">
            <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambahlog">
                <i class="fa-fw fas fa-plus-square nav-icon">

                </i>
                Tambah Kegiatan
            </a><br><br>
            <sub>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Data yang ditampilkan hanya berjumlah 20 data terbaru saja<br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Klik tombol <a href="#" onclick="window.location.href='{{ url('it/supervisi/all') }}'"><u><b>LIHAT</b></u></a> untuk melihat data seluruhnya
            </sub>
            <hr>
            <div class="table-responsive">
                <table id="logit" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>NAMA</th>
                            <th>KEGIATAN</th>
                            <th>LOKASI</th>
                            <th>KETERANGAN</th>
                            <th>TGL</th>
                            <th><center>AKSI</center></th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <center>
                                    <div class="btn-group" role="group">
                                        @if ($item->filename != '')
                                            <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-image nav-icon"></i></button>
                                        @endif
                                        <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubahLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
    </div>
  </div>
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endhasrole

<div class="modal fade bd-example-modal-lg" id="tambahlog" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Supervisi
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('it.supervisi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama :</label>
                            <select class="form-control selectric" name="nama" required>
                                <option value="" hidden>Pilih</option>
                                    @foreach($list['user'] as $key)
                                        <option value="{{ $key->id }}"><b>{{ $key->nama }}</b></option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Kegiatan : </label>
                        <input type="text" name="kegiatan" id="kegiatan" class="form-control" placeholder="" autofocus required>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label>Lokasi :</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""></textarea>
                        <br>
                    </div>
                    <div class="col-md-3">
                        <label>Upload Lampiran :</label>
                        <input type="file" name="file">
                        <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                    </div>
                    <br>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubahLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah kegiatan &nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">{{ $item->updated_at->diffForHumans() }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('it.supervisi.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <input type="text" class="form-control" name="id_user" value="{{ $item->id_user }}" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <label>Kegiatan : </label>
                                <input type="text" name="kegiatan" id="kegiatan" value="{{ $item->kegiatan }}" class="form-control" placeholder="" autofocus required>
                                <br>
                            </div>
                            <div class="col">
                                <label for="">Nama :</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" name="nama" required>
                                        <option value="" hidden>Pilih</option>
                                            @foreach($list['user'] as $key)
                                                <option value="{{ $key->id }}" @if ($item->id_user == $key->id) echo selected @endif><b>{{ $key->nama }}</b></option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Lokasi :</label>
                                <input type="text" name="lokasi" id="lokasi" value="{{ $item->lokasi }}" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Waktu :</label>
                                <input type="datetime-local" name="tgl" id="tgl" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->created_at)); ?>" class="form-control" placeholder="" disabled>
                            </div>
                        </div><br>
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""><?php echo htmlspecialchars($item->keterangan); ?></textarea>
                        <br>
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
                    <br>
                </div>

        </div>
        <div class="modal-footer">
            
                <center><button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus?
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>
                @if(count($list) > 0)
                {{ $item->nama }}'s Files. <br>
                    @if ($item->filename == '')
                    Dokumen : - <br>
                    @else
                    Dokumen  : {{ $item->title }} ({{Storage::size($item->filename)}} bytes) <br>
                    @endif
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('it.supervisi.destroy', $item->id) }}" method="POST">
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
    <div class="modal fade bd-example-modal-lg" id="lihatLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
<div class="modal fade" tabindex="-1" id="lihatGambar{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ $item->title }} ({{ $item->updated_at->diffForHumans() }})</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <center><img src="{{ url('public/storage/'.substr($item->filename,7,1000)) }}" style="width:400px" alt="" title="" /></center>
        </div>
        <div class="modal-footer">
          <button onclick="window.location.href='{{ url('it/supervisi/'. $item->id) }}'" type="button" class="btn btn-success"><i class="fas fa-download"></i> Download</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
    function showLampiran(id) {
        Swal.fire({
            title: 'Lampiran Supervisi '+id,
            text: 'Refresh halaman ini untuk mengupdate lampiran',
            imageUrl: './supervisi/'+id,
            imageWidth: 400,
            // imageHeight: 200,
            imageAlt: 'Lampiran',
            reverseButtons: true,
            showDenyButton: false,
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonText: `<i class="fa fa-download"></i> Download`,
            backdrop: `rgba(26,27,41,0.8)`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "./supervisi/"+id;
            }
        })
    }
    $(document).ready( function () {
        $('#logit').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    // 'copyHtml5',
                    // 'excelHtml5',
                    // 'csvHtml5',
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
                order: [[ 4, "desc" ]]
            }
        );
    } );
</script>
@endsection