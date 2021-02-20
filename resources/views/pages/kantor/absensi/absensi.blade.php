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

            <i class="fa-fw fas fa-signing nav-icon text-info">

            </i> Daftar Hadir

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            
        </div>
        <div class="card-body">
            @role('kantor')
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">
    
                            </i>
                            Tambah Kegiatan
                        </a>
                    </div>
                </div><br>
            @endrole
            <div class="table-responsive">
                <table id="absensi" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>KEGIATAN</th>
                            <th>LOKASI</th>
                            <th>HARI, TGL</th>
                            <th>DIBUAT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->tgl }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <center>
                                    <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lihat{{ $item->id }}"><i class="fa-fw fas fa-sort-amount-desc nav-icon text-white"></i></a>
                                    @role('kantor')
                                        <a type="button" class="btn btn-success btn-sm" href="{{ route('absensi.show', $item->id) }}"><i class="fa-fw fas fa-search nav-icon text-white"></i></a>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    @endrole
                                </center>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan=5>Tidak Ada Data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@role('kantor')
<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Kegiatan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label>Tanggal</label>
                        <input type="date" name="tgl" class="form-control">
                    </div>
                    <div class="col-md-7">
                        <div class="col">
                            <label>Tempat</label>
                            <input type="text" name="lokasi" class="form-control" required>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Nama Acara / Kegiatan</label>
                        <input type="text" name="kegiatan" class="form-control" required>
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
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Kegiatan&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('absensi.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label>Tanggal</label>
                        <input type="date" name="tgl" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl)); ?>" class="form-control">
                    </div>
                    <div class="col-md-7">
                        <div class="col">
                            <label>Tempat</label>
                            <input type="text" name="lokasi" value="{{ $item->lokasi }}" class="form-control" required>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label>Nama Acara / Kegiatan</label>
                        <input type="text" name="kegiatan" value="{{ $item->kegiatan }}" class="form-control" required>
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
            <p>Apakah anda yakin ingin menghapus Absensi <b>{{ $item->kegiatan }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('absensi.destroy', $item->id) }}" method="POST">
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
@foreach($list['show'] as $item)
<div class="modal" id="lihat{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Daftar Hadir Acara <b>{{ $item->kegiatan }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="absensi" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>BAGIAN</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['absensi']) > 0)
                        <div hidden>{{ $id = 1 }}</div>
                        @foreach($list['absensi'] as $item)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                        </tr>
                        {{-- <td hidden>{{ $td++ }}</td> --}}
                        @endforeach
                        @else
                            <tr>
                                <td colspan=3>Tidak Ada Data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#absensi').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ],
            order: [[ 3, "desc" ]]
        }
    );
} );
</script>
@endsection