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

                <i class="fa-fw fas fa-history nav-icon">

                </i> Tabel Log Pengadaan Barang

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Pengadaan
                </span>
                
            </div>
            <div class="card-body">
                @can('pengadaan')
                <div class="container">
                    <form class="form-inline" action="{{ route('cari.log') }}" method="GET">
                        <select class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan">
                            <option hidden>Bulan</option>
                            @php
                                $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                $jml_bln=count($bulan);
                                for($c=1 ; $c < $jml_bln ; $c+=1){
                                    echo"<option value=$c> $bulan[$c] </option>";
                                }
                            @endphp
                        </select>
                        <select class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun">
                            <option hidden>Tahun</option>
                            @php
                                for ($i=2019; $i <= $list['thn']; $i++) { 
                                    echo"<option value=$i> $i </option>";
                                }
                                
                            @endphp
                        </select>
                        <button class="form-control btn-info text-white" id="submit"><span class="badge">Filter</span></button>
                    </form>
                    <hr>
                    <div class="data-table-list">
                        <div class="table-responsive">
                            <table id="table_log" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nama Barang</th>
                                        <th>Unit</th>
                                        <th>Jumlah</th>
                                        <th>Jenis</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($list) > 0)
                                        @foreach($list['show'] as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->barang }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->jnspengadaan }}</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan=6>Tidak Ada Data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#table_log').DataTable(
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