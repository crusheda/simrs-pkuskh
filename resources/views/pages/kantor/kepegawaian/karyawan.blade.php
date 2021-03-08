@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-male nav-icon text-info">
        
            </i> Tabel Karyawan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kepegawaian
            </span>
            
        </div>
        <div class="card-body">
            @can('kepegawaian')
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">
    
                            </i>
                            Tambah Karyawan
                        </a>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table id="karyawan" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>USER_ID</th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>UPDATE</th>
                                <th><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <center><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button></center><hr>
                                    <center><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button></center>
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
            @else
                <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
            @endcan
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Karyawan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('kepegawaian.karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <select class="fstdropdown-select" name="id" id="karyawan">
                                <option selected hidden>Pilih Karyawan</option>
                                @foreach ($list['users'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <label>Kegiatan : </label>
                        <input type="text" name="kegiatan" id="kegiatan" class="form-control" placeholder="" required>
                        <br>
                        <label>Lokasi :</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                        <br>
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""></textarea>
                        <br>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#karyawan').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 0, "desc" ]]
            }
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