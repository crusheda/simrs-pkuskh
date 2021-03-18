@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

    @can('antrian_poli')
        @role('informasi')
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">

                        <i class="fa-fw fas fa-plus-square nav-icon">
            
                        </i> Input Inden Pasien

                    </div>
                    <div class="card-body">
                        <form class="form-auth-small" action="{{ route('queue.informasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="inden" id="checkbox" checked>
                                <label class="form-check-label" for="checkbox">
                                  Daftar Inden
                                </label>
                            </div><hr>
                            <div class="form-group" id="tgl-inden">
                                <label>Tgl Inden :</label>
                                <input type="date" name="tgl_queue" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>No. Rekam Medik</label>
                                <input type="number" name="no_rm" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Poliklinik</label>
                                <select class="form-control" name="kode_queue" required>
                                    <option hidden>Pilih</option>
                                    @foreach($list['poli'] as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_queue }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="kelamin" required>
                                    <option hidden>Pilih</option>
                                    <option value="TN. ">Pria</option>
                                    <option value="NY. ">Wanita</option>
                                </select>
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

                        </i> Data Pasien

                        <span class="pull-right badge badge-warning" style="margin-top:4px">
                            Akses RM
                        </span>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="antrian" class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th class="text-center">ANTRIAN</th>
                                        <th>RM</th>
                                        <th>NAMA</th>
                                        <th>POLI</th>
                                        <th>STATUS</th>
                                        <th>DAFTAR</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['show']) > 0)
                                    @foreach($list['show'] as $item)
                                    <tr>
                                        <td class="text-center"><kbd>{{ $item->queue }}</kbd></td>
                                        <td>{{ $item->no_rm }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kode_queue }}</td>
                                        <td>{{ $item->inden }}</td>
                                        <td>{{ $item->tgl_queue }}</td>
                                        <td>
                                            <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan=7>Tidak Ada Data</td>
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
                Ubah Identitas Pasien&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('queue.informasi.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="form-group">
                        <label>No. Rekam Medik</label>
                        <input type="number" name="no_rm" value="{{ $item->no_rm }}" class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Poliklinik</label>
                        <select class="form-control" name="kode_queue" required>
                            @foreach($list['poli'] as $key)
                                <option value="{{ $key->id }}" @if ($key->id == $item->id) echo selected @endif>{{ $key->nama_queue }}</option>
                            @endforeach
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                
                    <center><button class="btn btn-success pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
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
                Hapus Data Pasien&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;?
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    @if(count($list) > 0)
                    <table id="antrian" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ANTRIAN</th>
                                <th>RM</th>
                                <th>NAMA</th>
                                <th>POLI</th>
                                <th>STATUS</th>
                                <th>DAFTAR</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            <tr>
                                <td><kbd>{{ $item->queue }}</kbd></td>
                                <td>{{ $item->no_rm }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kode_queue }}</td>
                                <td>{{ $item->inden }}</td>
                                <td>{{ $item->tgl_queue }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                @if(count($list) > 0)
                    <form action="{{ route('queue.informasi.destroy', $item->id) }}" method="POST">
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
                order: [ 0, "desc" ]
            }
        );
        $("#checkbox").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 1);
                $('#tgl-inden').prop('hidden', false);
            } else {
                $(this).attr('value', 0);
                $('#tgl-inden').prop('hidden', true); 
            }
        });
    } );
</script>

@endsection