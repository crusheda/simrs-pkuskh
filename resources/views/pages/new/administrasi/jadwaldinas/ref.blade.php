@extends('layouts.newAdmin')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              <h4>Tambah</h4>
            </div>
            <div class="card-body">
              <form class="form-auth-small" action="{{ route('ref.jadwal.dinas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Waktu</label>
                    <input type="text" name="waktu" placeholder="e.g. Pagi / Siang / Malam ..." class="form-control" required>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label>Jam Masuk</label>
                        <input type="string" name="berangkat" class="form-control fp" value="07:00" placeholder="Pilih" style="background-color: #FDFDFF" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label>Jam Keluar</label>
                        <input type="string" name="pulang" class="form-control fp" value="14:00" placeholder="Pilih" style="background-color: #FDFDFF" required>
                    </div>
                  </div>
                </div>
                <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Jam menyesuaikan masing-masing unit.<br><i class="fa-fw fas fa-caret-right nav-icon"></i> Format Jam adalah 24hr (00:00 - 23:59 WIB)</sub>
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
                                <th>Waktu</th>
                                <th>Jam</th>
                                <th>Ditambahkan</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>{{ $item->berangkat }} - {{ $item->pulang }}</td>
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
  $(".fp").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });
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