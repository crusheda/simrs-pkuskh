@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <a class="btn btn-success btn-sm" href="{{ route("tgsperawat.index") }}">Kembali</a>
            <i class="fa-fw fas fa-file-text nav-icon" style="margin-left:10px">

            </i> Detail Profesi Keperawatan ( <b>{{ $list['show'][0]->name }}</b> )

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kabag Keperawatan
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="detailtgs" class="table table-striped">
                    <thead>
                        <th>NAMA</th>
                        <th>UNIT</th>
                        <th>PERNYATAAN</th>
                        <th>KETERANGAN</th>
                        <th>TGL</th>
                        <th>DITAMBAHKAN</th>
                        <th>DIUBAH</th>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->pernyataan }}</td>
                            <td>{{ $item->ket }} Kali</td>
                            <td>{{ $item->tgl }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>NAMA</th>
                        <th>UNIT</th>
                        <th>PERNYATAAN</th>
                        <th>KETERANGAN</th>
                        <th>TGL</th>
                        <th>DITAMBAHKAN</th>
                        <th>DIUBAH</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#detailtgs').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print']
                ,
                order: [[ 5, "desc" ]]
            }
        );
    } );
</script>

@endsection