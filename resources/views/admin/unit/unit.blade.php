@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                Tabel Unit

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Admin
                </span>
                
            </div>
            <div class="card-body">
                @can('users_manage')<div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table id="tabelunit" class="table table-striped display">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
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
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUnit{{ $item->id }}">Lihat</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUnit{{ $item->id }}">Hapus</button>
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
                        <div class="col-md-4">
                            <form class="form-auth-small" action="{{ route('admin.unit.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <center><h3>Form Tambah Unit</h3></center>
                                <hr>
                                <label>Nama Unit :</label>
                                <input type="text" name="unit" id="unit" class="form-control" placeholder="">
                                <br>
                                <center><button class="btn btn-primary text-white" id="submit">Tambah</button></center>
                                <br>
                            </form>
                        </div>
                    </div>
                @else
                    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
                @endcan
            </div>
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusUnit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                    Nama Unit : <b>{{ $item->name }}</b> <br>
                    Waktu Penambahan : {{ $item->created_at->diffForHumans() }}
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('admin.unit.destroy', $item->id) }}" method="POST">
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
<div class="modal fade bd-example-modal-lg" id="editUnit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Data Unit
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('admin.unit.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label>Nama Unit :</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control" placeholder="">
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
    $('#tabelunit').DataTable();
} );
</script>

@endsection