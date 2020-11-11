@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                Tabel Pernyataan Log

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Kabag Keperawatan
                </span>
                
            </div>
            <div class="card-body">
                @can('log_perawat')
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <center><h4>Tambah Pertanyaan</h4></center><br>
                            <form class="form-auth-small" action="{{ route('logperawat.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <select class="custom-select" name="unit" id="unit" required>
                                    <option selected hidden>Pilih Unit...</option>
                                    @foreach($list['unit'] as $name => $item)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <p></p>
                                <label>Pertanyaan :</label>
                                <textarea class="form-control" name="pertanyaan" id="pertanyaan" placeholder="" required></textarea>
                                <br>
                                <label>Pilihan Jawaban :</label>
                                <input type="number" min="1" max="5" class="form-control" name="box" id="box" value="1" required>
                                <br>
                                <center><button class="btn btn-primary text-white" id="submit">Tambah</button></center>
                                <br>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table id="logperawat" class="table table-striped display">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PERTANYAAN</th>
                                            <th>UNIT</th>
                                            <th>JAWABAN</th>
                                            <th>TGL</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($list['show']) > 0)
                                        @foreach($list['show'] as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->pertanyaan }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->box }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
                @else
                    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
                @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus?
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>
                @if(count($list) > 0)
                Unit : {{ $item->unit }} <br>
                Pertanyaan : <b>{{ $item->pertanyaan }}</b> <br>
                Ditambahkan pada {{ $item->created_at }} <br>
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('logperawat.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="editLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('logperawat.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label>Unit :</label>
            <select class="custom-select" name="unit" id="unit" required>
                @foreach($list['unit'] as $name => $yoi)
                    <option value="{{ $name }}" <?php if($name == $item->unit) { echo "selected";} ?>>{{ $name }}</option>
                @endforeach
            </select>
            <br>
            <label for="keterangan">Pertanyaan :</label>
            <textarea class="form-control" name="pertanyaan" id="pertanyaan" placeholder="" required>{{ $item->pertanyaan }}</textarea>
            <br>
            <label>Pilihan Jawaban :</label>
            <input type="number" class="form-control" value="{{ $item->box }}" min="0" max="5" name="box" id="box" required>
            <br>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary text-white btn-block" id="submit">Submit</button>
        </div>
        {{ Form::close() }}
        @endif
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#logperawat').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        }
    );
} );
</script>

@endsection