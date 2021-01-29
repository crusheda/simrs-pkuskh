@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    @can('log_perawat')
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-plus-square nav-icon">
    
                </i> Input 

            </div>
            <div class="card-body">
                <a type="button" class="btn btn-primary text-white btn-block" data-toggle="modal" data-target="#tambahtgs">
                    Masukkan Data
                </a>
                <hr>
                Data Terakhir : <kbd>@if ($list['recent'] == null) Unknown @else {{ $list['recent'] }} @endif</kbd>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-vcard nav-icon">

                </i> Penunjang Tugas Perawat 

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Perawat
                </span>

            </div>
            <div class="card-body">
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
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->tgl }}</td>
                                <td>
                                    <a type="button" class="btn btn-info btn-sm" href="{{ route('tgsperawat.show', $item->id) }}"><i class="fa-fw fas fa-search nav-icon"></i></a>
                                    <a type="button" class="btn btn-success btn-sm" href="{{ route('tgsperawat.edit', $item->id) }}"><i class="fa-fw fas fa-edit nav-icon"></i></a>
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
            </div>
        </div>
    </div>
    @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
    @endcan
</div>

<!-- Tambah -->
<div class="modal fade" id="tambahtgs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Penunjang Tugas Perawat <kbd>{{ $list['thn'] }}</kbd></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-auth-small" action="{{ route('tgsperawat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <label>Pernyataan :</label>
                <select class="custom-select" name="pernyataan" id="pernyataan" required>
                    <option hidden>Pilih</option>
                    @foreach($list['log'] as $pernyataan => $item)
                        <option value="{{ $pernyataan }}">{{ $pernyataan }}</option>
                    @endforeach
                </select>
                <br><br>
                {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary active">
                      <input type="radio" name="options" id="radio1" checked> Ya
                    </label>
                    <label class="btn btn-secondary">
                      <input type="radio" name="options" id="radio2"> Tidak
                    </label>
                </div>
                <br><br> --}}
                <label>Tgl :</label>
                <input type="date" name="tgl" id="tgl" class="form-control" placeholder="">
                <br>
                <label>Keterangan :</label>
                <textarea class="form-control" name="ket" id="ket" placeholder=""></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
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
            },
            order: [[ 3, "desc" ]]
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