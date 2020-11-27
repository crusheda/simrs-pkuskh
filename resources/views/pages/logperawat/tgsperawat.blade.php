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

                <i class="fa-fw fas fa-vcard nav-icon">

                </i> Penunjang Tugas Perawat 

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Perawat
                </span>

            </div>
            <div class="card-body">
                @can('log_perawat')
                <div class="container">
                    <a type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#tambahtdk">
                        <i class="fa-fw fas fa-plus-square nav-icon">

                        </i>
                        Input Penunjang Tugas Perawat
                        @if($list['recent'] != null)
                            <span class="badge badge-light">
                                Recent : {{ $list['recent'] }}   
                            </span>
                        @endif
                    </a>
                    <hr>
                    <div class="table-responsive">
                        <table id="tdkperawat" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAMA</th>
                                    <th>UNIT</th>
                                    <th>TGL</th>
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
                                    <td>{{ $item->tgl }}</td>
                                    <td>
                                        <a type="button" class="btn btn-info btn-sm" href="{{ route('tgsperawat.show', $item->queue) }}"><i class="fa-fw fas fa-search nav-icon"></i></a>
                                        <a type="button" class="btn btn-success btn-sm" href="{{ route('tgsperawat.edit', $item->queue) }}"><i class="fa-fw fas fa-edit nav-icon"></i></a>
                                        {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->queue }}"><i class="fa-fw fas fa-trash nav-icon"></i></button> --}}
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
                @else
                    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
                @endcan
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#detailprof').DataTable(
            {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print']
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