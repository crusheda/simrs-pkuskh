@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('laporan/bulanan/') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button> 

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Pribadi
            </span>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="bulanan" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>DIBUAT</th>
                            <th>JUDUL</th>
                            <th>BLN / THN</th>
                            <th>UNIT</th>
                            <th>BLN / THN</th>
                            <th>KETERANGAN</th>
                            <th>
                                <center>#</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->bln }} / {{ $item->thn }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->bln }} / {{ $item->thn }}</td>
                            <td>{{ $item->ket }}</td>
                            <td>
                                <center>
                                    <div class="btn-group" role="group">
                                        <a type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('laporan/bulanan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i> {{ number_format(Storage::size($item->filename) / 1048576,2) }} MB</a>
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
            order: [[ 0, "desc" ]]
        }
    );
    
    $("body").addClass('brand-minimized sidebar-minimized'); 
});
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