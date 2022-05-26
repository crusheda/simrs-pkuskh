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
                  <i class="fa-fw fas fa-plus-square nav-icon"></i>	Buat Jadwal
                </button>
                @role('kepegawaian|it')
                  <button type="button" class="btn btn-success text-white" data-toggle="tooltip" data-placement="bottom" title="BUAT PENGUSULAN PENGADAAN" onclick="tambah()">
                    <i class="fa-fw fas fa-business-time nav-icon"></i>	Rekap
                  </button>
                @endrole
              </div>
              <hr>
              <div class="btn-group">
                <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="TAMBAH REFERENSI JADWAL" onclick="window.location='{{ route('ref.jadwal.dinas.index') }}'"><i class="fa-fw fas fa-clock nav-icon"></i> Ref Jadwal</button>
                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="TAMBAH STAF UNIT" onclick="window.location='{{ route('staf.jadwal.dinas.index') }}'"><i class="fa-fw fas fa-users-cog nav-icon"></i> Atur Staf</button>
              </div>
              <hr>
              <div class="table-responsive">
                  <table id="table" class="table table-striped display" style="width: 100%">
                      <thead>
                          <tr>
                              <th>IDJ</th>
                              <th>USER</th>
                              <th>UNIT</th>
                              <th>WAKTU</th>
                              <th>UPDATE</th>
                              <th><center>#</center></th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($list['show']) > 0)
                              @foreach($list['show'] as $item)
                              <tr>
                                  <td>{{ $item->id_jadwal }}</td>
                                  <td>{{ $item->nama_user }}</td>
                                  <td>
                                    @foreach (json_decode($item->unit) as $key => $value)
                                        <kbd>{{ $value }}</kbd>
                                    @endforeach
                                  </td>
                                  <td>{{ \Carbon\Carbon::parse($item->waktu)->isoFormat("MMMM Y") }}</td>
                                  <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                  <td>
                                      <center>
                                          <div class="btn-group" role="group">
                                              <button type="button" class="btn btn-secondary btn-sm text-white disabled" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                              <button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
        {{-- <form id="formTambah" class="form-auth-small" action="{{ route('jadwal.dinas.create') }}" method="POST" enctype="multipart/form-data"> --}}
          @csrf
          <div class="form-group">
            <label>Bulan dan Tahun</label>
            <input type="month" name="waktu" class="form-control" value="{{ \Carbon\Carbon::now()->isoFormat('YYYY-MM') }}" required>
          </div>
          <div class="form-group">
            <label>Unit</label>
            <select name="unit" class="form-control" style="width: 100%" required>
              <option hidden>Pilih Unit</option>
                @foreach ($list['unit'] as $val)
                  <option value="{{ $val->id }}">{{ $val->nama }}</option>
                @endforeach
            </select>
          </div>
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan Anda mempunyai <b>HAK</b> dalam pembuatan Jadwal Dinas</sub> <br>
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan Anda sudah melengkapi <b>Ref Jadwal</b> dan <b>Data Staf</b></sub> <br>
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pembuatan Jadwal Dinas hanya dapat dilakukan 1x (Satu Kali) pada setiap bulannya</sub> <br>
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pengumpulan Jadwal Dinas dilakukan pada tanggal x - x</sub>
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary" id="btn-lanjutkan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Lanjutkan</button>
        {{-- </form> --}}

        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
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
      order: [[ 4, "desc" ]],
      pageLength: 10
    }
  ).columns.adjust();
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

  function saveData() {
    iziToast.warning({
        title: 'Stay Tune!!',
        message: 'Sebentar lagi sistem ini akan segera diluncurkan',
        position: 'topRight'
    });
    // $("#formTambah").one('submit', function() {
    //   //stop submitting the form to see the disabled button effect
    //   let x = document.forms["formTambah"]["unit"].value;
    //   if (x == "Pilih Unit") {
    //     iziToast.warning({
    //         title: 'Pesan Galat!',
    //         message: 'Unit belum terisi. Periksa sekali lagi',
    //         position: 'topRight'
    //     });

    //     return false;
    //   } else {
    //     $("#btn-lanjutkan").prop('disabled', true);
    //     $("#btn-lanjutkan").find("i").toggleClass("fa-save fa-sync fa-spin");

    //     return true;
    //   }
    // });
  }
</script>
@endsection