@extends('layouts.newAdmin')

@section('content')
@role('it')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              <h4>Tambah</h4>
            </div>
            <div class="card-body">
              <form class="form-auth-small" action="{{ route('ibs.refsupervisi.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label>Supervisi :</label>
                      <input type="text" name="supervisi" class="form-control" placeholder="e.g. Pengecekan Alat/Mesin" autofocus required>
                  </div>
                  <div class="form-group">
                      <label>Ruang</label>
                      <select name="ruang" class="form-control selectric" required>
                        <option hidden>Pilih</option>
                        <option value="Ruang Resusitasi Bayi">Ruang Resusitasi Bayi</option>
                        <option value="Ruang OK 1">Ruang OK 1</option>
                        <option value="Ruang OK 2">Ruang OK 2</option>
                        <option value="Ruang Cuci Tangan Bedah">Ruang Cuci Tangan Bedah</option>
                        <option value="Ruang Instrumen">Ruang Instrumen</option>
                        <option value="Ruang Cuci Alat">Ruang Cuci Alat</option>
                        <option value="Ruang BHP">Ruang BHP</option>
                        <option value="Ruang Recovery">Ruang Recovery</option>
                        <option value="Ruang Pre Operasi">Ruang Pre Operasi</option>
                        <option value="Ruang Counter Perawat">Ruang Counter Perawat</option>
                      </select>
                  </div>
                </div>
            <div class="card-footer text-right">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location='{{ route('pengadaan.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i> Kembali</button>
                <button class="btn btn-primary text-white" type="submit"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
              </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Tabel</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Supervisi</th>
                                <th>Ruang</th>
                                <th>Tgl</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->supervisi }}</td>
                                    <td>{{ $item->ruang }}</td>
                                    <td>{{ $item->tgl }}</td>
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
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endrole

{{-- @foreach($list['show'] as $item)
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
            @if(count($list) > 0)
                Supervisi : <b>{{ $item->supervisi }}</b><br>
                Ruang : <b>{{ $item->ruang }},-</b><br>
                Ditambahkan pada : <b>{{ $item->created_at }}</b><br>
                Update pada : <b>{{ $item->tgl }}</b>
            @endif
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('ibs.refsupervisi.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach --}}

{{-- @foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="edit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('ibs.refsupervisi.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>Supervisi :</label>
                <input type="text" name="supervisi" value="{{ $item->supervisi }}" class="form-control" placeholder="e.g. Pengecekan Alat/Mesin" autofocus required>
            </div>
            <div class="form-group">
                <label>Ruang</label>
                <select name="ruang" class="form-control selectric" required>
                  <option hidden>Pilih</option>
                  <option value="Ruang Resusitasi Bayi" @if ($item->ruang == 'Ruang Resusitasi Bayi') echo selected @endif>Ruang Resusitasi Bayi</option>
                  <option value="Ruang OK 1" @if ($item->ruang == 'Ruang OK 1') echo selected @endif>Ruang OK 1</option>
                  <option value="Ruang OK 2" @if ($item->ruang == 'Ruang OK 2') echo selected @endif>Ruang OK 2</option>
                  <option value="Ruang Cuci Tangan Bedah" @if ($item->ruang == 'Ruang Cuci Tangan Bedah') echo selected @endif>Ruang Cuci Tangan Bedah</option>
                  <option value="Ruang Instrumen" @if ($item->ruang == 'Ruang Instrumen') echo selected @endif>Ruang Instrumen</option>
                  <option value="Ruang Cuci Alat" @if ($item->ruang == 'Ruang Cuci Alat') echo selected @endif>Ruang Cuci Alat</option>
                  <option value="Ruang BHP" @if ($item->ruang == 'Ruang BHP') echo selected @endif>Ruang BHP</option>
                  <option value="Ruang Recovery" @if ($item->ruang == 'Ruang Recovery') echo selected @endif>Ruang Recovery</option>
                  <option value="Ruang Pre Operasi" @if ($item->ruang == 'Ruang Pre Operasi') echo selected @endif>Ruang Pre Operasi</option>
                  <option value="Ruang Counter Perawat" @if ($item->ruang == 'Ruang Counter Perawat') echo selected @endif>Ruang Counter Perawat</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary text-white" id="submit"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
        {{ Form::close() }}
        @endif
      </div>
    </div>
</div>
@endforeach --}}

<script>
$(document).ready( function () {
    $('#table').DataTable(
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