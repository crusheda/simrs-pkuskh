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

                <i class="fa-fw fas fa-cubes nav-icon">

                </i> Tabel Barang Pengadaan

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body">
                @can('pengadaan')
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table id="barang" class="table table-striped display">
                                    <thead>
                                        <tr>
                                            <th>BARANG</th>
                                            <th>SATUAN</th>
                                            <th>HARGA</th>
                                            <th>TANGGAL</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($list['show']) > 0)
                                        @foreach($list['show'] as $item)
                                        <tr>
                                            <td>{{ $item->barang }}</td>
                                            <td>{{ $item->satuan }}</td>
                                            <td>{{ $item->harga }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#editBarang{{ $item->id }}">Ubah</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusBarang{{ $item->id }}">Hapus</button>
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
                            <form class="form-auth-small" action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label>Nama Barang :</label>
                                <input type="text" name="barang" id="barang" class="form-control" placeholder="">
                                <br>
                                <label>Satuan :</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="">
                                <br>
                                <label>Harga :</label>
                                <input type="number" name="harga" id="harga" class="form-control" placeholder="">
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
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusBarang{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                    Nama Barang : <b>{{ $item->barang }}</b> <br>
                    Satuan : {{ $item->satuan }} <br>
                    Harga : {{ $item->harga }} <br>
                    Ditambahkan pada {{ $item->created_at }} <br>
                    Barang Sudah dipakai pengadaan sebanyak @if ($item->count == null) 0 @else {{ $item->count }} @endif kali.<br>
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('barang.destroy', $item->id) }}" method="POST">
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
<div class="modal fade bd-example-modal-lg" id="editBarang{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('barang.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label>Nama Barang :</label>
            <input type="text" name="barang" id="barang" value="{{ $item->barang }}" class="form-control" placeholder="">
            <br>
            <label>Satuan :</label>
            <input type="text" name="satuan" id="satuan" value="{{ $item->satuan }}" class="form-control" placeholder="">
            <br>
            <label>Harga :</label>
            <input type="number" name="harga" id="harga" value="{{ $item->harga }}" class="form-control" placeholder="">
            <br>
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
    $('#barang').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        }
    );
} );
</script>

@endsection