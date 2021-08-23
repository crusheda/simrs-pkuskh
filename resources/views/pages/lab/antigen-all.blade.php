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
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center pull-left">Data Swab Antigen</h5>
                            <button type="button" class="btn btn-dark pull-right" data-toggle="modal" data-target="#show" data-toggle="tooltip" data-placement="bottom" title="DATA PASIEN HARI INI"><i class="fa-fw fas fa-info nav-icon text-white"></i> Informasi</button>
                        </div>
                    </div><hr>
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
<div class="modal fade bd-example-modal-lg" id="show" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Data Pasien Antigen
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @if(!empty($list['getpos'][0]->jumlah))
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN POSITIF (BULAN INI) : <kbd style="background-color: red">{{ $list['getpos'][0]->jumlah }} Pasien</kbd></a> <br><br>
                @endif
                @if(!empty($list['getposyear'][0]->jumlah))
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN POSITIF (TAHUN INI) : <kbd style="background-color: RED">{{ $list['getposyear'][0]->jumlah }} Pasien</kbd></a> <br><br>
                @endif
                <hr>
                @if(!empty($list['getneg'][0]->jumlah))
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN NEGATIF (BULAN INI) : <kbd style="background-color: royalblue">{{ $list['getneg'][0]->jumlah }} Pasien</kbd></a> <br><br>
                @endif
                @if(!empty($list['getnegyear'][0]->jumlah))
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN NEGATIF (TAHUN INI) : <kbd style="background-color: royalblue">{{ $list['getnegyear'][0]->jumlah }} Pasien</kbd></a> <br><br>
                @endif
                <hr>
                @if(!empty($list['getmont'][0]->jumlah))
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN BULAN INI : <kbd style="background-color: rgb(23, 106, 4)">{{ $list['getmont'][0]->jumlah }} Pasien</kbd></a> <br><br>
                @endif
                @if(!empty($list['getyear'][0]->jumlah))
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN TAHUN INI : <kbd style="background-color: rgba(134, 19, 87, 0.45)">{{ $list['getyear'][0]->jumlah }} Pasien</kbd></a>
                @endif
            </div>
            <div class="modal-footer">
                <a class="pull-left"><b># Updated {{ \Carbon\Carbon::parse($list['now'])->isoFormat('DD MMMM YYYY') }}</b></a>
            </div>
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
                language: {
                    buttons: {
                        colvis: 'Sembunyikan Kolom',
                        excel: 'Jadikan Excell',
                        pdf: 'Jadikan PDF',
                        print: 'Cetak Table',
                    }
                },
                order: [[ 6, "desc" ]],
                pageLength: 50
            }
        );

        $("body").addClass('brand-minimized sidebar-minimized');
    } );
</script>

@endsection