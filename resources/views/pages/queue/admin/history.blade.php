@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@can('antrian_poli')
<div class="card" style="width: 100%">
    <div class="card-header bg-dark text-white">

        <i class="fa-fw fas fa-bookmark nav-icon">

        </i> Antrian Pasien Poliklinik&nbsp;&nbsp;<kbd style="background-color: brown">SAAT INI</kbd>

        <span class="pull-right badge badge-warning" style="margin-top:4px">
            Akses Publik
        </span>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="antrian" class="table table-striped display">
                <thead>
                    <tr>
                        <th class="text-center">ANTRIAN</th>
                        <th>RM</th>
                        <th>NAMA</th>
                        <th>POLI</th>
                        <th>INDEN</th>
                        <th class="text-center">DAFTAR</th>
                    </tr>
                </thead>
                <tbody style="text-transform: capitalize">
                    @if(!empty($list['show1']) )
                    @foreach($list['show1'] as $item)
                    <tr>
                        <td class="text-center"><kbd>{{ $item->queue }}</kbd></td>
                        <td>{{ $item->no_rm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nama_queue }}</td>
                        <th>{{ $item->inden }}</th>
                        <td class="text-center">{{ $item->tgl_queue }} <br><sub><kbd>{{ \Carbon\Carbon::parse($item->tgl_queue)->diffForHumans() }}</kbd></sub></td>
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


<div class="card" style="width: 100%">
    <div class="card-header bg-dark text-white">

        <i class="fa-fw fas fa-bookmark nav-icon">

        </i> Data Riwayat Antrian Pasien Poliklinik

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="history" class="table table-striped display">
                <thead>
                    <tr>
                        <th class="text-center">ANTRIAN</th>
                        <th>RM</th>
                        <th>NAMA</th>
                        <th>POLI</th>
                        <th>INDEN</th>
                        <th>DAFTAR</th>
                        <th>SELESAI</th>
                    </tr>
                </thead>
                <tbody style="text-transform: capitalize">
                    @if(!empty($list['show2']) > 0)
                    @foreach($list['show2'] as $item)
                    <tr>
                        <td class="text-center"><kbd>{{ $item->queue }}</kbd></td>
                        <td>{{ $item->no_rm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nama_queue }}</td>
                        <td>{{ $item->inden }}</td>
                        <td>{{ $item->tgl_queue }}</td>
                        <td>{{ $item->tgl_visite }}</td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan=7>Tidak Ada Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endcan
    
<script>
    $(document).ready( function () {
        $('#antrian').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                order: [ 0, "desc" ]
            }
        );
        $('#history').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                order: [ 6, "desc" ]
            }
        );
    } );
</script>

@endsection