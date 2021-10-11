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

            <i class="fa-fw fas fa-book nav-icon text-info">

            </i> Set User Role untuk Struktur Bagian RS

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Admin
            </span>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <div class="btn-group" role="group">
                            <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah
                            </a>
                        </div>
                    </div>
                </div>
            </div><hr>
            <div class="table-responsive">
                <table id="bulanan" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID USER</th>
                            <th>ID ROLE</th>
                            <th>USER</th>
                            <th>ROLE</th>
                            <th>DIPERBARUI</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                            @foreach($list['show'] as $key => $item)
                                <tr>
                                    {{-- <td>{{ $item->created_at }}</td>
                                    {{-- <td>{{ $item->judul }}</td>
                                    <td>{{ $item->bln }} / {{ $item->thn }}</td> --}}
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->id_user }}</td>
                                    <td>{{ $item->id_roles }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>@foreach($list['role'] as $get => $value) @if ($item->id_roles == $value->id) {{ $value->name }} @endif @endforeach</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
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

{{-- @role('admin-direksi') --}}
<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Laporan Bulanan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('it.roleuser.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>User :</label>
                        <div class="input-group mb-3">
                            <select class="custom-select" name="user" id="user" required>
                                <option value="" hidden>Pilih</option>
                                    @foreach($list['user'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <label>Role :</label>
                        <div class="input-group mb-3">
                            <select class="custom-select" name="role" id="role" required>
                                <option value="" hidden>Pilih</option>
                                    @foreach($list['role'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            
        </div>
        <div class="modal-footer">

                <button class="btn btn-success" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
            Ubah Role User&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('it.roleuser.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col">
                        <label>User :</label>
                        <div class="input-group mb-3">
                            <select class="custom-select" name="user" id="user" required>
                                <option value="" hidden>Pilih</option>
                                    @foreach($list['user'] as $key => $items)
                                        <option value="{{ $items->id }}" @if ($item->id_user == $items->id) echo selected @endif>{{ $items->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <label>Role :</label>
                        <div class="input-group mb-3">
                            <select class="custom-select" name="role" id="role" required>
                                <option value="" hidden>Pilih</option>
                                    @foreach($list['role'] as $key => $items)
                                        <option value="{{ $items->id }}" @if ($item->id_roles == $items->id) echo selected @endif>{{ $items->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>

            </form>
            
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
            Diperbarui pada <b>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Role User <b>ID : {{ $item->id }}</b> | {{ $item->nama }} ?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('it.roleuser.destroy', $item->id) }}" method="POST">
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

<script>
$(document).ready( function () {
    $('#bulanan').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf','colvis'
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 5, "desc" ]]
        }
    );
});
</script>
@endsection