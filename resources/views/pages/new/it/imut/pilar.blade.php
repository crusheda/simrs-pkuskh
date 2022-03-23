@extends('layouts.newAdmin')

@section('content')
@role('it')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              <h4>Tambah Tindakan</h4>
            </div>
            <div class="card-body">
                <form class="form-auth-small" action="{{ route('it.pilar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Pemberi Instruksi :</label>
                    <input type="text" name="namapi" id="namapi" class="form-control" placeholder="" autofocus required>
                    <br>
                    <label>Keterangan :</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" placeholder="" required></textarea>
                    <br>
                    <div class="btn-group">
                        <button class="btn btn-success text-white pull-right" id="submit"><i class="fa-fw fas fa-check nav-icon"></i> Submit</button>
                </form>
                        <button class="btn btn-info text-white pull-left" onclick="window.location.href='{{ route('it.rev.index') }}'"><i class="fa-fw fas fa-code-branch nav-icon"></i> Revisi</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h4>Table</h4>
            </div>
            <div class="card-body">
                <a class="pull-left"><i class="fa-fw fas fa-caret-right nav-icon"></i> Data yang ditampilkan hanya berjumlah 50 data terbaru saja<br><i class="fa-fw fas fa-caret-right nav-icon"></i> Klik tombol <u><a href="#" onclick="window.location.href='{{ url('it/imut/pilar/all') }}'"><b>LIHAT</b></a></u> untuk melihat Rekapitulasi Data keseluruhan</a>
                <br><br><hr>
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="table_imut" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>INSTRUKSI</th>
                                    {{-- <th>PELAKSANA</th> --}}
                                    <th>KETERANGAN</th>
                                    <th style="text-align: center">JAM AWAL</th>
                                    <th style="text-align: center">JAM SELESAI</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($list) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->namapi }}</td>
                                    {{-- <td>{{ $item->nama }}</td> --}}
                                    <td>{{ $item->keterangan }}</td>
                                    <td style="text-align: center">{{ $item->jamawal }}</td>
                                    @if ($item->jamselesai == null)
                                        <td style="text-align: center"><span class="badge badge-pill badge-dark">Sedang Diproses</span></td>
                                    @else
                                        <td style="text-align: center">{{ $item->jamselesai }}</td>
                                    @endif
                                    <td>
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
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusPilar{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole

@foreach($list['show'] as $item)
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
                    {{-- <a class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('imutpilar.edit', $item->id) }}'">
                        <i class="lnr lnr-pencil"></i>Edit
                    </a> --}}
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach

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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namapi">Pelaksana :</label>
                        <input type="text" name="nama" id="nama" value="{{ $item->nama }}" class="form-control" placeholder="{{ $item->nama }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namapi">Pemberi Instruksi :</label>
                        <input type="text" name="namapi" id="namapi" value="{{ $item->namapi }}" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jamawal">Jam Awal :</label>
                        <input type="datetime-local" name="jamawal" id="jamawal" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->jamawal)); ?>" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jamselesai">Jam Selesai :</label>
                        <input type="datetime-local" name="jamselesai" id="jamselesai" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->jamselesai)); ?>" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="keterangan">Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""><?php echo htmlspecialchars($item->keterangan); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success text-white" id="submit"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
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
                    // 'copyHtml5',
                    // 'excelHtml5',
                    // 'csvHtml5',
                    {
                    extend: 'copyHtml5',
                    className: 'btn-info',
                    text: 'Salin Baris',
                    download: 'open',
                    },
                    {
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    text: 'Export Excell',
                    download: 'open',
                    },
                    {
                    extend: 'pdfHtml5',
                    className: 'btn-warning',
                    text: 'Cetak PDF',
                    download: 'open',
                    },
                ],
                order: [[ 3, "desc" ]],
            }
        );
    } );
</script>
@endsection