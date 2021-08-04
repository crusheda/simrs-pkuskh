@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('lab/antigen/') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button> 

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Lab
            </span>
            
        </div>
        <div class="card-body">
            @can('antigen')
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">Data Swab Antigen</h5><hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="antigen" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>DOKTER PENGIRIM</th>
                                                <th>PEMERIKSA</th>
                                                <th>RM</th>
                                                <th>PASIEN</th>
                                                <th>JK/UMUR</th>
                                                <th>ALAMAT</th>
                                                <th>TGL</th>
                                                <th>HASIL</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($list) > 0)
                                                @foreach($list['show'] as $key => $item)
                                                <tr>
                                                    <td>
                                                        @php
                                                            echo \App\Models\dokter::where('id', $item->dr_pengirim)->pluck('nama')->first();
                                                        @endphp
                                                    </td>
                                                    <td>{{ $item->pemeriksa }}</td>
                                                    <td><b><kbd>{{ $item->rm }}</kbd></b></td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->jns_kelamin }} / {{ $item->umur }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->tgl }}</td>
                                                    <td>
                                                        @if ($item->hasil == "POSITIF")
                                                            <kbd style="background-color: red">{{ $item->hasil }}</kbd>
                                                        @else
                                                            <kbd style="background-color: royalblue">{{ $item->hasil }}</kbd>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center><a type="button" class="btn btn-success btn-sm" href="{{ route('lab.antigen.cetak', $item->id) }}"><i class="fa-fw fas fa-download nav-icon"></i></a></center>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>DOKTER PENGIRIM</th>
                                                <th>PEMERIKSA</th>
                                                <th>RM</th>
                                                <th>PASIEN</th>
                                                <th>JK/UMUR</th>
                                                <th>ALAMAT</th>
                                                <th>TGL</th>
                                                <th>HASIL</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#antigen').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print','colvis'
                ],
                order: [[ 6, "desc" ]],
                pageLength: 50
            }
        );

        $("body").addClass('brand-minimized sidebar-minimized');
    } );
</script>

@endsection