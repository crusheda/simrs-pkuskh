@extends('layouts.newAdmin')

@section('content')
@role('it')
<div class="row">
    <div class="col-md-4">
        <div class="card" style="width: 100%">
            <div class="card-header">

                <h4>Tambah</h4>
                
            </div>
            <div class="card-body">
                <form class="form-auth-small" action="{{ route('it.dokter.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Nama Dokter :</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="e.g. dr. Soenaryo" autofocus required>
                    <br>
                    <label>Jabatan :</label>
                    <div class="input-group mb-3">
                        <select class="custom-select" name="jabatan" id="jabatan" required>
                            <option value="" hidden>Pilih</option>
                            <option value="UMUM">UMUM</option>
                            <option value="GIGI">GIGI</option>
                            <option value="SPESIALIS BEDAH">SPESIALIS BEDAH</option>
                            <option value="SPESIALIS ANESTESI">SPESIALIS ANESTESI</option>
                            <option value="SPESIALIS DALAM">SPESIALIS DALAM</option>
                            <option value="SPESIALIS OBSGYN">SPESIALIS OBSGYN</option>
                            <option value="SPESIALIS ANAK">SPESIALIS ANAK</option>
                            <option value="SPESIALIS KULIT KELAMIN">SPESIALIS KULIT KELAMIN</option>
                            <option value="SPESIALIS ORTOPEDI">SPESIALIS ORTOPEDI</option>
                            <option value="SPESIALIS JIWA">SPESIALIS JIWA</option>
                            <option value="SPESIALIS JANTUNG">SPESIALIS JANTUNG</option>
                            <option value="SPESIALIS RADIOLOGI">SPESIALIS RADIOLOGI</option>
                            <option value="SPESIALIS THT">SPESIALIS THT</option>
                            <option value="SPESIALIS PARU">SPESIALIS PARU</option>
                            <option value="SPESIALIS SARAF">SPESIALIS SARAF</option>
                            <option value="SPESIALIS MATA">SPESIALIS MATA</option>
                            <option value="SPESIALIS REHABILITASI MEDIS">SPESIALIS REHABILITASI MEDIS</option>
                            <option value="SPESIALIS PATOLOGI KLINIK">SPESIALIS PATOLOGI KLINIK</option>
                        </select>
                    </div>
                    <label>Poliklinik</label>
                    <div class="input-group mb-3">
                        <select class="custom-select" name="poli" id="poli" required>
                            <option hidden>Pilih</option>
                            @foreach($list['poli'] as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_queue }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <button class="btn btn-primary text-white float-right" id="submit"><i class="fa-fw fas fa-save nav-icon"></i> TAMBAH</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="width: 100%">
            <div class="card-header">

                <h4>Tabel</h4>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dokter" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA</th>
                                <th>JABATAN</th>
                                <th>DITAMBAHKAN</th>
                                <th><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
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
            </div>
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                    <div class="row">
                        <div class="col-md-12">
                            Nama Dokter : <b>{{ $item->nama }}</b><br>
                            Jabatan : <b>{{ $item->jabatan }}</b><br>
                            Ditambahkan pada : <b>{{ $item->created_at }}</b>
                        </div>
                    </div>
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('it.dokter.destroy', $item->id) }}" method="POST">
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
<div class="modal fade bd-example-modal-lg" id="edit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('it.dokter.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label>Nama Dokter :</label>
            <input type="text" name="nama" id="nama" value="{{ $item->nama }}" class="form-control" placeholder="" autofocus required>
            <br>
            <label>Jabatan :</label>
            <div class="input-group mb-3">
                <select class="custom-select" name="jabatan" id="jabatan" required>
                    <option value="" hidden>Pilih</option>
                    <option value="UMUM" @if ($item->jabatan == 'UMUM') echo selected @endif>UMUM</option>
                    <option value="GIGI" @if ($item->jabatan == 'GIGI') echo selected @endif>GIGI</option>
                    <option value="SPESIALIS BEDAH" @if ($item->jabatan == 'SPESIALIS BEDAH') echo selected @endif>SPESIALIS BEDAH</option>
                    <option value="SPESIALIS ANESTESI" @if ($item->jabatan == 'SPESIALIS ANESTESI') echo selected @endif>SPESIALIS ANESTESI</option>
                    <option value="SPESIALIS DALAM" @if ($item->jabatan == 'SPESIALIS DALAM') echo selected @endif>SPESIALIS DALAM</option>
                    <option value="SPESIALIS OBSGYN" @if ($item->jabatan == 'SPESIALIS OBSGYN') echo selected @endif>SPESIALIS OBSGYN</option>
                    <option value="SPESIALIS ANAK" @if ($item->jabatan == 'SPESIALIS ANAK') echo selected @endif>SPESIALIS ANAK</option>
                    <option value="SPESIALIS KULIT KELAMIN" @if ($item->jabatan == 'SPESIALIS KULIT KELAMIN') echo selected @endif>SPESIALIS KULIT KELAMIN</option>
                    <option value="SPESIALIS ORTOPEDI" @if ($item->jabatan == 'SPESIALIS ORTOPEDI') echo selected @endif>SPESIALIS ORTOPEDI</option>
                    <option value="SPESIALIS JIWA" @if ($item->jabatan == 'SPESIALIS JIWA') echo selected @endif>SPESIALIS JIWA</option>
                    <option value="SPESIALIS JANTUNG" @if ($item->jabatan == 'SPESIALIS JANTUNG') echo selected @endif>SPESIALIS JANTUNG</option>
                    <option value="SPESIALIS RADIOLOGI" @if ($item->jabatan == 'SPESIALIS RADIOLOGI') echo selected @endif>SPESIALIS RADIOLOGI</option>
                    <option value="SPESIALIS THT" @if ($item->jabatan == 'SPESIALIS THT') echo selected @endif>SPESIALIS THT</option>
                    <option value="SPESIALIS PARU" @if ($item->jabatan == 'SPESIALIS PARU') echo selected @endif>SPESIALIS PARU</option>
                    <option value="SPESIALIS SARAF" @if ($item->jabatan == 'SPESIALIS SARAF') echo selected @endif>SPESIALIS SARAF</option>
                    <option value="SPESIALIS MATA" @if ($item->jabatan == 'SPESIALIS MATA') echo selected @endif>SPESIALIS MATA</option>
                    <option value="SPESIALIS REHABILITASI MEDIS" @if ($item->jabatan == 'SPESIALIS REHABILITASI MEDIS') echo selected @endif>SPESIALIS REHABILITASI MEDIS</option>
                    <option value="SPESIALIS PATOLOGI KLINIK" @if ($item->jabatan == 'SPESIALIS PATOLOGI KLINIK') echo selected @endif>SPESIALIS PATOLOGI KLINIK</option>
                </select>
            </div>
            <label>Poliklinik</label>
            <div class="input-group mb-3">
                <select class="custom-select" name="poli" id="poli" required>
                    <option hidden>Pilih</option>
                    @foreach($list['poli'] as $key)
                        <option value="{{ $key->id }}" @if ($item->id_poli == $key->id) echo selected @endif>{{ $key->nama_queue }}</option>
                    @endforeach
                </select>
            </div>
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
@endrole

<script>
$(document).ready( function () {
    $('#dokter').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
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
            order: [[ 3, "desc" ]]
        }
    );
} );
</script>

@endsection