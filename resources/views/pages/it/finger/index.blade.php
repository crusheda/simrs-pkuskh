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

            <i class="fa-fw fas fa-retweet nav-icon text-info">

            </i> Insentif Kehadiran

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses IT
            </span>
            
        </div>
        <div class="card-body">
            @role('it')
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary pull-left" onclick="window.location.href='{{ url('insentif/finger') }}'"><i class="fa-fw fas fa-hand-pointer-o nav-icon text-white"></i> Set Finger</button>
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#upload" data-toggle="tooltip" data-placement="bottom" title="UPLOAD EXCELL"><i class="fa-fw fas fa-upload nav-icon"></i> Upload Excell</button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="table" class="table table-striped display">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th><center>ID_FINGER</center></th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>TIDAK TERLAMBAT</th>
                                <th>TERLAMBAT</th>
                                <th>ABSEN 1 KALI</th>
                                <th>BLN / THN</th>
                                {{-- <th><center>AKSI</center></th> --}}
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                {{-- <td>{{ $item->id }}</td> --}}
                                <td><center><kbd>{{ $item->id_finger }}</kbd></center></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->absen1 }}</td>
                                <td>{{ $item->absen2 }}</td>
                                <td>{{ $item->absen3 }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM / YYYY') }}</td>
                                {{-- <td>@foreach ($list['userAll'] as $val) @if ($item->id == $val->id) <kbd>{{ $val->nama_role }}</kbd> @endif @endforeach</td> --}}
                                {{-- <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
                                    </center>
                                </td> --}}
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

<div class="modal fade bd-example-modal-lg" id="upload" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Upload Dokumen Kehadiran
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('import.insentif') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            - Pastikan format dokumen yang diupload sesuai seperti di bawah ini :<br><br>
                            &nbsp;&nbsp;<kbd>Row 1</kbd> adalah NIP <b>[INT]</b><br><br>
                            &nbsp;&nbsp;<kbd>Row 2</kbd> adalah NAMA <b>[STRING]</b><br><br>
                            &nbsp;&nbsp;<kbd>Row 3</kbd> adalah UNIT <b>[STRING]</b><br><br>
                            &nbsp;&nbsp;<kbd>Row 4</kbd> adalah JUMLAH TIDAK TERLAMBAT <b>[INT]</b><br><br>
                            &nbsp;&nbsp;<kbd>Row 5</kbd> adalah JUMLAH TERLAMBAT <b>[INT]</b><br><br>
                            &nbsp;&nbsp;<kbd>Row 6</kbd> adalah JUMLAH ABSEN 1 KALI <b>[INT]</b><br><br>
                            - Pastikan baris paling atas (Pertama) adalah data pertama yang akan dimasukkan<br>
                            - Disarankan untuk tidak memakai border atau sejenisnya<br>
                            - Ekstensi File yang digunakan yaitu <i>.CSV , .XLS , .XLSX</i>
                        </p>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <input type="file" name="file">
                        <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-success" id="btn-upload"><i class="fa-fw fas fa-upload nav-icon"></i> Upload</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>

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
            order: [[ 0, "asc" ]],
            pageLength: 30
        }
    );
    
    $( "#btn-upload" ).click(function() {
        $(this).find("i").toggleClass("fa-upload fa-refresh fa-spin");
    });
} );
</script>

@endsection