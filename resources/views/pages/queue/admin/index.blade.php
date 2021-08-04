@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

    @can('antrian_poli')
        @role('it')
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">

                        <i class="fa-fw fas fa-plus-square nav-icon">
            
                        </i> Tambah Poli 

                    </div>
                    <div class="card-body">
                        <form class="form-auth-small" action="{{ route('it.poli.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Kode Poli</label>
                                <input type="text" name="kode_queue" class="form-control" placeholder="Contoh: A, B, C, D" onKeyPress="if(this.value.length==1) return false;" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Poliklinik</label>
                                <input type="text" name="nama_queue" class="form-control">
                            </div>
                            <hr>
                            <center><button class="btn btn-success">Tambah</button></center>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card" style="width: 100%">
                    <div class="card-header bg-dark text-white">

                        <i class="fa-fw fas fa-vcard nav-icon">

                        </i> Data Poliklinik

                        <span class="pull-right badge badge-warning" style="margin-top:4px">
                            Akses Admin
                        </span>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="antrian" class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode Poliklinik</th>
                                        <th>Nama</th>
                                        <th>Aktif</th>
                                        <th>Ditambahkan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['show']) > 0)
                                    @foreach($list['show'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->kode_queue }}</td>
                                        <td>{{ $item->nama_queue }}</td>
                                        <td>{{ $item->aktif }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </td>
                                    </tr>
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
        </div>
        @endrole
    @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
    @endcan

    
    <!-- Ubah -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Poliklinik&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('it.poli.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="form-group">
                        <label>Kode Poliklinik</label>
                        <input type="text" name="kode_queue" value="{{ $list['show'][0]->kode_queue }}" onKeyPress="if(this.value.length==1) return false;" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama :</label>
                        <input type="text" name="nama_queue" value="{{ $list['show'][0]->nama_queue }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Aktif</label>
                        <select name="aktif" class="form-control" required>
                            <option value="1" @if ($item->aktif == true) echo selected @endif>Ya</option>
                            <option value="0" @if ($item->aktif == false) echo selected @endif>Tidak</option>
                        </select>
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

    <!-- Hapus -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Yakin ingin Menghapus?&nbsp;<span class="pull-right badge badge-dark text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    @if(count($list['show']) > 0)
                    <table id="antrian" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Poliklinik</th>
                                <th>Nama</th>
                                <th>Aktif</th>
                                <th>Ditambahkan</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->kode_queue }}</td>
                                <td>{{ $item->nama_queue }}</td>
                                <td>{{ $item->aktif }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                @if(count($list) > 0)
                    <form action="{{ route('it.poli.destroy', $item->id) }}" method="POST">
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
    
<script>
    $(document).ready( function () {
        $('#antrian').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [ 4, "desc" ]
            }
        );
    } );
</script>

@endsection