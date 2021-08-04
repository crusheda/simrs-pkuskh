@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('it/supervisi/') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button> 

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses IT
            </span>
            
        </div>
        <div class="card-body">
            @can('antigen')
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">Data Supervisi IT</h5><hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="logit" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>NAMA</th>
                                                <th>KEGIATAN</th>
                                                <th>LOKASI</th>
                                                <th>KETERANGAN</th>
                                                <th>TGL</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-transform: capitalize">
                                            @if(count($list['show']) > 0)
                                            @foreach($list['show'] as $item)
                                            <tr>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->kegiatan }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group" role="group">
                                                            @if ($item->filename != '')
                                                                <button type="button" onclick="window.location.href='{{ url('it/supervisi/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></button>
                                                            @else
                                                                <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa fa-download"></i></button>
                                                            @endif
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>NAMA</th>
                                                <th>KEGIATAN</th>
                                                <th>LOKASI</th>
                                                <th>KETERANGAN</th>
                                                <th>TGL</th>
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
        $('#logit').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print','colvis'
                ],
                order: [[ 4, "desc" ]],
                pageLength: 50
            }
        );

        $("body").addClass('brand-minimized sidebar-minimized');
    } );
</script>

@endsection