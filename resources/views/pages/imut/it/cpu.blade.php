@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                Indikator Mutu CPU

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses IT
                </span>
                
            </div>
            <div class="card-body">
                @can('imut_it')
                <form class="form-auth-small" action="{{ route('cpu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Pemberi Instruksi :</label>
                    <input type="text" name="namapi" id="namapi" class="form-control" placeholder="">
                    <br>
                    <label>Keterangan :</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""></textarea>
                    <br>
                    <center><button class="btn btn-primary text-white" id="submit">Submit</button></center>
                </form>
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="table_imut" class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>PEMBERI INSTRUKSI</th>
                                    <th>PELAKSANA</th>
                                    <th>KETERANGAN</th>
                                    <th>JAM AWAL</th>
                                    <th>JAM SELESAI</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($list) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>
                                        @if ($item->jamselesai == null)
                                            <form action="{{ route('cpu.selesai', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                            </form>
                                        @endif
                                        {{-- <a class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ route('cpu.selesai', $item->id) }}'">
                                            Selesai
                                        </a> --}}
                                    </td>
                                    <td>{{ $item->namapi }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->jamawal }}</td>
                                    <td>{{ $item->jamselesai }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editcpu{{ $item->id }}">Ubah</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapuscpu{{ $item->id }}">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan=8>Tidak Ada Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapuscpu{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                <form action="{{ route('cpu.destroy', $item->id) }}" method="POST">
                    {{-- <a class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('imutcpu.edit', $item->id) }}'">
                        <i class="lnr lnr-pencil"></i>Edit
                    </a> --}}
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
<div class="modal fade bd-example-modal-lg" id="editcpu{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('cpu.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label for="namapi">Pemberi Instruksi :</label>
            <input type="text" name="namapi" id="namapi" value="{{ $item->namapi }}" class="form-control" placeholder="">
            <br>
            <label for="namapi">Pelaksana :</label>
            <input type="text" name="nama" id="nama" value="{{ $item->nama }}" class="form-control" placeholder="" disabled>
            <br>
            <label for="jamawal">Jam Awal :</label>
            <input type="datetime-local" name="jamawal" id="jamawal" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->jamawal)); ?>" class="form-control" placeholder="">
            <br>
            <label for="jamselesai">Jam Selesai :</label>
            <input type="datetime-local" name="jamselesai" id="jamselesai" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->jamselesai)); ?>" class="form-control" placeholder="">
            <br>
            <label for="keterangan">Keterangan :</label>
            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="">{{ $item->keterangan }}</textarea>
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
        $('#table_imut').DataTable();
    } );
</script>

@endsection