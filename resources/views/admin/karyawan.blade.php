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

            <i class="fa-fw fas fa-male nav-icon text-info">

            </i> Tabel Karyawan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Admin
            </span>
            
        </div>
        <div class="card-body">
            @can('users_manage')
                <div class="row">
                    <div class="col-md-4">
                        <form class="form-auth-small" action="{{ route('admin.karyawan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <center><h3>Form Tambah Karyawan</h3></center>
                            <hr>
                            <div class="form-group">
                                <label>USER ACCOUNT :</label>
                                <select class="fstdropdown-select" name="user_id" id="karyawan">
                                    <option selected hidden>Pilih User</option>
                                    @foreach($list['users'] as $name => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;{{ $item->unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label>Nama Lengkap Karyawan (Beserta Gelar) :</label>
                            <input type="text" name="name" id="nama" class="form-control" placeholder="e.g. Ronald Paul Soenaryo, S.Kep. Ns">
                            <br>
                            <center><button class="btn btn-primary text-white" id="submit">Tambah</button></center>
                            <br>
                        </form><hr>
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table id="tabelkaryawan" class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>USER_ID</th>
                                        <th>NAME</th>
                                        <th>UNIT</th>
                                        <th>TGL</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($list['show']) > 0)
                                    @foreach($list['show'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan=6>Tidak Ada Data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
            @endcan
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus? <kbd>ID : {{ $item->id }}</kbd> <kbd class="bg-info">USER ID : {{ $item->user_id }}</kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-2">
                    <b>Nama</b><br>
                    <b>Unit</b>
                </div>
                <div class="col-10">
                    : {{ $item->name }}<br>
                    : {{ $item->unit }}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('admin.karyawan.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger"><i class="lnr lnr-trash"></i>Hapus</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="edit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Data Karyawan <kbd>ID : {{ $item->id }}</kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('admin.karyawan.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>USER ACCOUNT :</label>
                <select class="fstdropdown-select" name="user_id" id="karyawan">
                    <option selected hidden>Pilih User</option>
                    @foreach($list['users'] as $name => $items)
                        <option value="{{ $items->id }}" @if ($item->user_id == $items->id) echo selected @endif>{{ $items->name }}&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;{{ $items->unit }}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <label>Nama Karyawan :</label>
            <input type="text" name="name" value="{{ $item->name }}" class="form-control" placeholder="">
            <br>
            <label>Unit :</label>
            <input type="text" name="unit" value="{{ $item->unit }}" class="form-control" placeholder="">
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary text-white btn-block" id="submit">Submit</button>
        </div>
        {{ Form::close() }}
        @endif
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#tabelkaryawan').DataTable();
} );
</script>

@endsection