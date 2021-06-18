@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-sort-amount-asc nav-icon">

                </i> Antrian Poliklinik <kbd></kbd>

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Poli
                </span>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="antrian" class="table table-striped display">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Poliklinik</th>
                                <th>Jumlah Antrian</th>
                                <th>Antrian</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td class="text-center">{{ $item->kode_queue }}</td>
                                <td><kbd>{{ $item->nama_queue }}</kbd></td>
                                <td>{{ $item->jumlah }}</td>
                                <td><a type="button" class="btn btn-primary btn-sm" href="{{ route('queue.poli.show', $item->kode_queue) }}"><i class="fa-fw fas fa-search nav-icon"></i> Lihat</a></td>
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
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-question nav-icon">

                </i> Readmore

            </div>
            <div class="card-body">
                <h6>Update : {{ $list['now'] }}</h6>
            </div>
        </div>
    </div>
</div>

@endsection