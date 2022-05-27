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
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="text" name="waktu" placeholder="e.g. Pagi / Siang / Malam ..." class="form-control up" required>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label>Singkatan</label>
                        <input type="text" name="singkat" placeholder="e.g. P / P6 / M / S1 /  ..." class="form-control up" required>
                    </div>
                  </div>
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
                                <th>Singkatan</th>
                                <th>Jam</th>
                                <th>Ditambahkan</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>**</td>
                            <td>Libur</td>
                            <td>L</td>
                            <td>00:00:00 - 00:00:00</td>
                            <td>-</td>
                            <td>
                                <center>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm text-white disabled" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    </div>
                                </center>
                            </td>
                          </tr>
                          <tr>
                            <td>**</td>
                            <td>Cuti</td>
                            <td>C</td>
                            <td>00:00:00 - 00:00:00</td>
                            <td>-</td>
                            <td>
                                <center>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm text-white disabled" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    </div>
                                </center>
                            </td>
                          </tr>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>{{ $item->singkat }}</td>
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

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah <kbd>ID : {{ $item->id }}</kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('program.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Pengesahan</label>
                            <input type="date" name="sah" value="<?php echo strftime('%Y-%m-%d', strtotime($item->sah)); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit Pembuat</label>
                            <select class="form-control selectric" name="pembuat" required>
                                @foreach($list['unit'] as $key)
                                    <option value="{{ $key->id }}" @if ($key->id == $item->pembuat) selected @endif>{{ $key->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit Terkait</label>
                            <input type="text" name="unit" value="{{ $item->unit }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Detail Dokumen</label><br>
                            @if ($item->filename == '')
                            -
                            @else
                                <b><u><a href="kebijakan/{{ $item->id }}">{{ substr($item->title,0,50) }}...</a></u></b><br><sub>Ukuran File : {{ number_format(Storage::size($item->filename) / 1048576,2) }} MB</sub>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <a>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</a>
                <button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
  $('.up').keyup(function() {
    this.value = this.value.toLocaleUpperCase();
  });
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
      order: [[ 4, "desc" ]],
      pageLength: 10
    }
  ).columns.adjust();
});

// FUNCTION
function hapus(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'REF ID : '+id,
      icon: 'warning',
      reverseButtons: false,
      showDenyButton: false,
      showCloseButton: false,
      showCancelButton: true,
      focusCancel: true,
      confirmButtonColor: '#FF4845',
      confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
      cancelButtonText: `<i class="fa fa-times"></i> Batal`,
      backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "./ref/api/hapus/"+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            iziToast.success({
                title: 'Sukses!',
                message: 'Hapus Regulasi SPO berhasil pada '+res,
                position: 'topRight'
            });
            refresh();
          },
          error: function(res) {
            Swal.fire({
              title: `Gagal di hapus!`,
              text: 'Pada '+res,
              icon: `error`,
              showConfirmButton:false,
              showCancelButton:false,
              allowOutsideClick: true,
              allowEscapeKey: true,
              timer: 3000,
              timerProgressBar: true,
              backdrop: `rgba(26,27,41,0.8)`,
            });
          }
        }); 
      }
    })
}
</script>
@endsection