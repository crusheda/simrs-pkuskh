@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@role('kabag-keuangan|it')
<div class="row">
    <div class="col-md-4">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">
                
                <i class="fa-fw fas fa-plus-square nav-icon text-success">

                </i> Tambah PBF
    
                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Admin
                </span>
                
            </div>
            <div class="card-body">
                <form class="form-auth-small" action="{{ route('pbf.store') }}" method="POST" enctype="multipart/form-data" id="tambah">
                    @csrf
                    <div class="form-group">
                        <label>Nama PBF :</label>
                        <input type="text" name="pbf" class="form-control" placeholder="Masukkan nama PBF" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis :</label>
                        <select name="jenis" class="form-control" required>
                            <option hidden>Pilih</option>
                            <option value="CASH">CASH</option>
                            <option value="TRANSFER">TRANSFER</option>
                        </select>
                    </div>
            </div>
            <div class="card-footer" style="background-color: #2F353A">

                    <button class="btn btn-success btn-sm text-white pull-right" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                    <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ route('pengajuan.index') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-sort-amount-asc nav-icon text-info">

                </i> Tabel PBF
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-hover display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PBF</th>
                                <th>JENIS</th>
                                <th>DITAMBAHKAN</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->pbf }}</td>
                                <td>{{ $item->jenis }}</td>
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
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endrole

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ditambahkan pada <b>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</b>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Data <b>{{ $item->pbf }}</b>?</p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('pbf.destroy', $item->id) }}" method="POST">
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
            Ubah PBF
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('pbf.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama PBF :</label>
                        <input type="text" name="pbf" value="{{ $item->pbf }}" class="form-control" placeholder="Masukkan nama PBF" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Jenis :</label>
                        <select name="jenis" class="form-control" required>
                            <option hidden>Pilih</option>
                            @foreach($list['jenis'] as $key => $items)
                                <option value="{{ $items->jenis }}" @if ($items->jenis == $item->jenis) echo selected @endif><label>{{ $items->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success text-white">Ubah</button>
        </div>
        {{ Form::close() }}
        @endif
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#table').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            order: [[ 3, "desc" ]]
        }
    );
    $("#tambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

        return true;
    });
} );
</script>

@endsection