@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card" style="width: 100%">
                <div class="card-header bg-dark text-white">
    
                    <i class="fa-fw fas fa-bug nav-icon text-danger">
    
                    </i> Tabel Pelaporan Bug Unit IT
    
                    <span class="pull-right badge badge-warning" style="margin-top:4px">
                        Akses IT
                    </span>
                    
                </div>
                <div class="card-body">
                    @can('log_it')
                    <div class="container">
                        <div class="table-responsive">
                            <table id="tablebug" class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAMA</th>
                                        <th>PESAN</th>
                                        <th>TGL</th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['show']) > 0)
                                    @foreach($list['show'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->pesan }}</td>
                                        <td>{{ $item->created_at }}</td>
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
                    @else
                    <div class="col text-center">
                        Mohon maaf, Anda tidak mempunyai ijin akses halaman ini. Hubungi Admin IT untuk mendapatkan akses.
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-5">
            
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#tablebug').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 4, "desc" ]]
            }
        );
    } );
</script>

@endsection
