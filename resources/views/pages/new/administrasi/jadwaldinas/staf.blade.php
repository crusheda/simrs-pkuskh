@extends('layouts.newAdmin')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              <h4>Tambah</h4>
            </div>
            <div class="card-body">
              <form class="form-auth-small" action="{{ route('staf.jadwal.dinas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Staf</label>
                    <select class="form-control select2" name="id_staf" required>
                        <option hidden>Pilih</option>
                        @foreach($list['user'] as $key)
                            <option value="{{ $key->id }}">{{ $key->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Masukkan semua pegawai di Unit anda<br><i class="fa-fw fas fa-caret-right nav-icon"></i> Jika terdapat perubahan struktur pegawai pada Unit anda, mohon untuk segera mengupdate data staf</sub>
            </div>
            <div class="card-footer text-right">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location='{{ route('jadwal.dinas.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i> Kembali</button>
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
                    <table id="table" class="table table-striped display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IDS</th>
                                <th>NAMA</th>
                                <th>UPDATE</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->id_staf }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
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

<script>
$(document).ready( function () {
  $('#table').DataTable(
    {
      paging: true,
      searching: true,
      scrollX: true,
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
        {
          extend: 'colvis',
          className: 'btn-dark',
          text: 'Sembunyikan Kolom',
          exportOptions: {
              columns: ':visible'
          }
        }
      ],
      order: [[ 3, "desc" ]],
      pageLength: 10
    }
  ).columns.adjust();
});
</script>
@endsection