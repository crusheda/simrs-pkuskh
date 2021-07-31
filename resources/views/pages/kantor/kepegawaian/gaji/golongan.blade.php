@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">

    @can('gaji')

    <div class="col-md-4">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-plus nav-icon text-success">

                </i> Tambah Golongan
                
            </div>
            <div class="card-body">
                    <form class="form-auth-small" action="{{ route('kepegawaian.golongan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label>Nama Golongan :</label>
                        <input type="text" name="nama" class="form-control" placeholder="e.g. IIIA" autofocus required>
                        <br>
                        <label>Keterangan :</label>
                        <input type="text" name="ket" class="form-control" placeholder="e.g. Penata Muda" autofocus required>
                        <br>
                        <label>Nominal (Rp) :</label>
                        <input type="number" name="nominal" class="form-control">
                        <hr>
                        <center><button class="btn btn-success text-white" id="submit">TAMBAH</button></center>
                    </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-sort-amount-desc nav-icon text-info">

                </i> Tabel Tunjangan Golongan

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Kepegawaian
                </span>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kepegawaian" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA</th>
                                <th>KETERANGAN</th>
                                <th>NOMINAL</th>
                                <th>DITAMBAHKAN</th>
                                <th><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->ket }}</td>
                                    <td>Rp. {{ $item->nominal }},-</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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

    @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
    @endcan
    
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus?
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            @if(count($list) > 0)
                Nama : <b>{{ $item->nama }}</b><br>
                Keterangan : <b>{{ $item->ket }}</b><br>
                Nominal : <b>Rp. {{ $item->nominal }},-</b><br>
                Ditambahkan pada : <b>{{ $item->created_at }}</b>
            @endif
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('kepegawaian.golongan.destroy', $item->id) }}" method="POST">
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
<div class="modal fade bd-example-modal-lg" id="edit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('kepegawaian.golongan.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label>Nama Golongan :</label>
            <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" placeholder="e.g. IIIA" autofocus required>
            <br>
            <label>Keterangan :</label>
            <input type="text" name="ket" value="{{ $item->ket }}" class="form-control" placeholder="e.g. Penata Muda" autofocus required>
            <br>
            <label>Nominal :</label>
            <input type="number" name="nominal" value="{{ $item->nominal }}" class="form-control">
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
    $('#kepegawaian').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print','colvis'
            ],
            order: [[ 4, "desc" ]]
        }
    );
} );
</script>

@endsection