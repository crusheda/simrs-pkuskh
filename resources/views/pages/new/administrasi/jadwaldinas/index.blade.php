@extends('layouts.newAdmin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4>Table</h4>
              {{-- <div class="card-header-action">
                <h4></h4>
              </div> --}}
            </div>
            <div class="card-body">
              <div class="btn-group">
                <button type="button" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="bottom" title="BUAT PENGUSULAN PENGADAAN" onclick="tambah()">
                  <i class="fa-fw fas fa-plus-square nav-icon"></i>	Tambah Pengadaan
                </button>
                <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="TAMBAH REFERENSI JADWAL" onclick="window.location='{{ route('ref.jadwal.dinas.index') }}'"><i class="fa-fw fas fa-clock nav-icon"></i> Ref Jadwal</button>
                <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="TAMBAH STAF UNIT" onclick="window.location='{{ route('staf.jadwal.dinas.index') }}'"><i class="fa-fw fas fa-users-cog nav-icon"></i> Atur Staf</button>
              </div>
              <hr>
              <div class="table-responsive">
                  <table id="table" class="table table-striped display" style="width: 100%">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>USER</th>
                              <th>UNIT</th>
                              <th>UPDATE</th>
                              <th><center>#</center></th>
                          </tr>
                      </thead>
                      <tbody>
                          {{-- @if(count($list['show']) > 0)
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
                          @endif --}}
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">
        Tambah Jadwal Dinas
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form-auth-small" action="{{ route('jadwal.dinas.create') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Bulan dan Tahun</label>
            <input type="month" name="waktu" class="form-control" value="{{ \Carbon\Carbon::now()->isoFormat('YYYY-MM') }}" required>
          </div>
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan Anda mempunyai <b>Hak</b> dalam pembuatan Jadwal Dinas</sub> <br>
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pembuatan Jadwal Dinas hanya dapat dilakukan 1x (Satu Kali) pada setiap bulannya</sub> <br>
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pengumpulan Jadwal Dinas dilakukan pada tanggal x - x</sub>
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Lanjutkan</button>
        </form>

        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready( function () {

});

// FUNCTION-FUNCTION
  function tambah() {
    // const d = new Date();
    // var day = d.getDate();
    // console.log('ini tanggal : '+day);
    // if (day > 25) {
    //   iziToast.warning({
    //       title: 'Pesan Galat!',
    //       message: 'Pengusulan Pengadaan hanya dapat dilakukan pada tanggal 1-25 Setiap Bulannya.',
    //       position: 'topRight'
    //   });
    // } else {
    // }
      $('#tambah').modal('show');
    
  }
</script>
@endsection