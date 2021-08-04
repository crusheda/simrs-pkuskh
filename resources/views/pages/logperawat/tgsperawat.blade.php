@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

    @can('log_perawat')
        @role('kabag-keperawatan')
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-vcard nav-icon">

                </i> Penunjang Tugas Perawat 

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Kabag Keperawatan
                </span>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="admintgsperawat" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->queue }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>
                                    <a type="button" class="btn btn-info btn-sm text-white" href="{{ route('tgsperawat.show', $item->queue) }}"><i class="fa-fw fas fa-search nav-icon"></i> Detail</a>
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
        @else
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">

                        <i class="fa-fw fas fa-plus-square nav-icon">
            
                        </i> Input 

                    </div>
                    <div class="card-body">
                        <a type="button" class="btn btn-primary text-white btn-block" data-toggle="modal" data-target="#tambahtgs">
                            Masukkan Data
                        </a>
                        <hr>
                        Data Terakhir : <kbd>@if ($list['recent'] == null) Unknown @else {{ $list['recent'] }} @endif</kbd>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card" style="width: 100%">
                    <div class="card-header bg-dark text-white">

                        <i class="fa-fw fas fa-vcard nav-icon">

                        </i> Penunjang Tugas Perawat 

                        <span class="pull-right badge badge-warning" style="margin-top:4px">
                            Akses Perawat
                        </span>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tgsperawat" class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PERNYATAAN</th>
                                        <th>KETERANGAN</th>
                                        <th>TGL</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['show']) > 0)
                                    <a hidden>{{ $id = 1 }}</a>
                                    @foreach($list['show'] as $item)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>{{ $item->pernyataan }}</td>
                                        <td>{{ $item->ket }}</td>
                                        <td>{{ $item->tgl }}</td>
                                        <td>
                                            <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubahLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
        </div>
        @endrole
    @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
    @endcan

@role('kabag-keperawatan')
    {{-- @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="lihatLog{{ $item->queue }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Detail Penunjang Tugas Perawat&nbsp;<span class="pull-right badge badge-dark text-white" style="margin-top:5px">ID : {{ $item->queue }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>
    @endforeach --}}
@else
    <!-- Tambah -->
    <div class="modal fade" id="tambahtgs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Penunjang Tugas Perawat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form class="form-auth-small" action="{{ route('tgsperawat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label>Pernyataan :</label>
                    <select class="custom-select" name="pernyataan" id="pernyataan" required>
                        <option hidden>Pilih</option>
                        @foreach($list['log'] as $pernyataan => $item)
                            <option value="{{ $pernyataan }}">{{ $pernyataan }}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <label>Tgl :</label>
                    <input type="date" name="tgl" id="tgl" class="form-control" placeholder="">
                    <br>
                    <label>Keterangan :</label>
                    <textarea class="form-control" name="ket" id="ket" placeholder=""></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Ubah -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="ubahLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Penunjang Tugas Perawat&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('tgsperawat.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="container">
                        <label>Pernyataan :</label>
                        <select class="custom-select" name="pernyataan" id="pernyataan" required>
                            @foreach($list['pernyataan'] as $key)
                                <option value="{{ $key->pernyataan }}" @if ($key->pernyataan == $item->pernyataan) echo selected @endif>{{ $key->pernyataan }}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <label>Tgl :</label>
                        <input type="date" name="tgl" id="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl)); ?>" placeholder="">
                        <br>
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="ket" id="ket" placeholder=""maxlength="190" rows="8"><?php echo htmlspecialchars($item->ket); ?></textarea>
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
    <div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                    @if(count($list) > 0)
                        <div class="row">
                            <div class="col-md-2">
                                <a>Nama</a><br>
                                <a>Unit</a><br>
                                <a>Pernyataan</a><br>
                            </div>
                            <div class="col-md-10">
                                <a>: {{ $item->name }}</a><br>
                                <a>: {{ $item->unit }}</a><br>
                                <a>: {{ $item->pernyataan }}</a><br>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <a>Keterangan :</a><br>
                                <a style="word-wrap: break-word;"><b>{{ $item->ket }}</b></a>
                            </div>
                        </div>
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                @if(count($list) > 0)
                    <form action="{{ route('tgsperawat.destroy', $item->id) }}" method="POST">
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
@endrole

<script>
    $(document).ready( function () {
        $('#tgsperawat').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print','colvis'
                ],
                order: [ 3, "desc" ]
            }
        );
    } );
</script>
<script>
    $(document).ready( function () {
        $('#admintgsperawat').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print','colvis'
                ],
                order: [[ 0, "desc" ]]
            }
        );
    } );
</script>
{{-- <script>
    function submitBtn() {
        var bulan = document.getElementById("bulan").value;
        var tahun = document.getElementById("tahun").value;
        if (bulan != "Bln" && tahun != "Thn" ) {
            document.getElementById("submit").disabled = false;
        }
    }
</script> --}}

@endsection