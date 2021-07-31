@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@can('imut_it')
<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('it/imut/pilar') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button> 

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses IT
            </span>
            
        </div>
        <div class="card-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">Rekapitulasi Data Indikator Mutu Pilar</h5><hr>
                </div>
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="table_imut" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>INSTRUKSI</th>
                                    <th>KETERANGAN</th>
                                    <th style="text-align: center">JAM AWAL</th>
                                    <th style="text-align: center">JAM SELESAI</th>
                                    <th><center>AKSI</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($list) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->namapi }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td style="text-align: center">{{ $item->jamawal }}</td>
                                    @if ($item->jamselesai == null)
                                        <td style="text-align: center"><span class="badge badge-pill badge-dark">Sedang Diproses</span></td>
                                    @else
                                        <td style="text-align: center">{{ $item->jamselesai }}</td>
                                    @endif
                                    <td><center>
                                        <div class="btn-group" role="group">
                                            @if ($item->jamselesai == null)
                                                <form action="{{ route('it.pilar.selesai', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm text-white"><i class="fa-fw fas fa-check nav-icon"></i></button>
                                                </form>
                                            @else
                                                <button type="submit" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-check nav-icon"></i></button>
                                            @endif
                                            @if ($item->jamselesai == null)
                                                <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            @else
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#editPilar{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            @endif
                                            {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusPilar{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button> --}}
                                        </div>
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>INSTRUKSI</th>
                                    <th>KETERANGAN</th>
                                    <th style="text-align: center">JAM AWAL</th>
                                    <th style="text-align: center">JAM SELESAI</th>
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

{{-- @foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusPilar{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                    Pemberi Instruksi : {{ $item->namapi }} <br>
                    Pelaksana : {{ $item->nama }} <br>
                    Jam Awal : {{ $item->jamawal }} <br>
                    Jam Selesai : {{ $item->jamselesai }} <br>
                    Keterangan : {{ $item->keterangan }}
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('it.pilar.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach --}}

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="editPilar{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('it.pilar.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label for="namapi">Pemberi Instruksi :</label>
            <input type="text" name="namapi" id="namapi" value="{{ $item->namapi }}" class="form-control" placeholder="">
            <br>
            <label for="namapi">Pelaksana :</label>
            <input type="text" name="nama" id="nama" value="{{ $item->nama }}" class="form-control" placeholder="{{ $item->nama }}" disabled>
            <br>
            <label for="jamawal">Jam Awal :</label>
            <input type="datetime-local" name="jamawal" id="jamawal" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->jamawal)); ?>" class="form-control" placeholder="">
            <br>
            <label for="jamselesai">Jam Selesai :</label>
            <input type="datetime-local" name="jamselesai" id="jamselesai" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->jamselesai)); ?>" class="form-control" placeholder="">
            <br>
            <label for="keterangan">Keterangan :</label>
            <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""><?php echo htmlspecialchars($item->keterangan); ?></textarea>
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
        $('#table_imut').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print','colvis'
                ],
                order: [[ 3, "desc" ]],
                pageLength: 50
            }
        );

        $("body").addClass('brand-minimized sidebar-minimized');
    } );
</script>

@endsection