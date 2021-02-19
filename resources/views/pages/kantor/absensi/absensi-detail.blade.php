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

            <a class="btn btn-success btn-sm" href="{{ route("absensi.index") }}">
                <i class="fa-fw fas fa-chevron-left nav-icon">

                </i> Kembali <span class="badge badge-light">ID : {{ $list['absensi']->id }}</span>
            </a>

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kantor
            </span>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <b>
                        <h5>Hari, Tgl</h5>
                        <h5>Kegiatan / Acara</h5>
                        <h5>Tempat</h5>
                    </b>
                </div>
                <div class="col-md-10">
                    <h5>: {{ $list['absensi']->tgl }}</h5>
                    <h5>: {{ $list['absensi']->kegiatan }}</h5>
                    <h5>: {{ $list['absensi']->lokasi }}</h5>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark">
            Tambah Kehadiran
        </div>
        <div class="card-body">
            {{-- {{ Form::model($item, array('route' => array('absensi.update', $item->id), 'method' => 'PUT', 'class' => 'form-inline')) }} --}}
            <form action="{{ route('absensi.hadir', $list['absensi']->id) }}" method="POST">
                {{-- {{ method_field('PUT') }} --}}
                @csrf
                <div class="form-row">
                    <div class="col-11">
                        <select class="fstdropdown-select" name="id" id="karyawan">
                            <option selected hidden>Pilih Karyawan</option>
                            @foreach($list['karyawan'] as $name => $item)
                                <option value="{{ $item }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-success"><i class="fa-fw fas fa-plus-square nav-icon"></i> Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark">
            Daftar Kehadiran Karyawan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="absensi" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>BAGIAN</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['absensihadir']) > 0)
                        <div hidden>{{ $id = 1 }}</div>
                        @foreach($list['absensihadir'] as $item)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>
                                <center>
                                    @role('kantor')
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    @endrole
                                </center>
                            </td>
                        </tr>
                        {{-- <td hidden>{{ $td++ }}</td> --}}
                        @endforeach
                        @else
                            <tr>
                                <td colspan=4>Tidak Ada Data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@foreach($list['absensihadir'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Karyawan&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('absensi.edit', $item->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <select class="fstdropdown-select" name="id" id="karyawan">
                            <option selected hidden>Pilih Karyawan</option>
                            @foreach($list['karyawan'] as $name => $items)
                                <option value="{{ $items }}" @if ($item->name == $name) echo selected @endif>{{ $name }}</option>
                            @endforeach
                        </select>
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

@foreach($list['absensihadir'] as $item)
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
            <p>Apakah anda yakin ingin menghapus Karyawan <b>{{ $item->name }} </b>dari Daftar Kehadiran ?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('absensi.hapus', $item->id) }}" method="POST">
                @csrf
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
            </form>
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
            order: [[ 0, "desc" ]]
        }
    );
} );
</script>
@endsection