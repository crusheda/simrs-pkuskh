@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <a class="btn btn-primary btn-sm" href="{{ route("insentif.kehadiran") }}">
                <i class="fa-fw fas fa-hand-o-left nav-icon text-white">

                </i> Kembali
            </a>&nbsp;&nbsp;&nbsp;Set Finger

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses IT
            </span>
            
        </div>
        <div class="card-body">
            @role('it')
                <div class="table-responsive">
                    <table id="table" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID_USER</th>
                                <th>ID_FINGER</th>
                                <th>NAMA</th>
                                <th>ROLE</th>
                                <th><center>STATUS</center></th>
                                <th><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->id_finger }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>@foreach ($list['user'] as $val) @if ($item->id == $val->id) <kbd>{{ $val->nama_role }}</kbd> @endif @endforeach</td>
                                <td>
                                    <center>
                                        @if (empty($item->status) || $item->status == 0)
                                            <kbd class="text-white" style="background-color: rgb(66, 5, 179)">AKTIF</kbd>
                                        @else
                                            <kbd class="text-white" style="background-color: rgb(218, 38, 38)">NONAKTIF</kbd>
                                        @endif{{ $item->status }}
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
            @endcan
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
{{-- UBAH ID FINGER --}}
<div class="modal fade bd-example-modal-sm" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            ID USER : {{ $item->id }}
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('finger.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <label>ID Finger : </label>
                <input type="number" name="id_finger" id="id_finger" value="{{ $item->id_finger }}" class="form-control" autofocus required>
                <br>

        </div>
        <div class="modal-footer">
            
                <center><button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>
        </div>
      </div>
    </div>
</div>
@endforeach


@foreach($list['show'] as $item)
{{-- HAPUS ID FINGER --}}
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                ID USER : {{ $item->id }}
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    <a>Apakah anda yakin ingin menghapus ID Finger a/n <b>{{ $item->nama }}</b> ?</a><br>
                    <b>n.b </b> Penghapusan ini hanya menghapus ID Finger saja, tidak akan merubah data diri karyawan.
                </p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger" href="{{ route('setNull.finger', $item->id) }}"><i class="fa-fw fas fa-save nav-icon text-white"></i> YA</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> TIDAK</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#table').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print','colvis'
            ],
            order: [[ 1, "asc" ]]
        }
    );

    // VALIDASI INPUT NUMBER
    $('input[type=number][max]:not([max=""])').on('input', function(ev) {
        var $this = $(this);
        var maxlength = $this.attr('max').length;
        var value = $this.val();
        if (value && value.length >= maxlength) {
        $this.val(value.substr(0, maxlength));
        }
    });
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