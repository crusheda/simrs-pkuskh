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
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
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
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah <kbd>ID : {{ $item->id }}</kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('staf.jadwal.dinas.ubah', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="form-group">
                    <label>Staf</label>
                    <select class="form-control select2" name="id_staf" style="width: 100%" required>
                        <option hidden>Pilih</option>
                        @foreach($list['user'] as $key)
                            <option value="{{ $key->id }}" @if ($item->id_staf == $key->id) selected @endif>{{ $key->nama }}</option>
                        @endforeach
                    </select>
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
      order: [[ 0, "desc" ]],
      pageLength: 10
    }
  ).columns.adjust();
});

function hapus(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'STAF ID : '+id,
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
                message: 'Hapus Staf berhasil pada '+res,
                position: 'topRight'
            });
            window.location.reload();
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

function saveData() {
    // iziToast.warning({
    //     title: 'Stay Tune!!',
    //     message: 'Sebentar lagi sistem ini akan segera diluncurkan',
    //     position: 'topRight'
    // });
    $("#formTambah").one('submit', function() {
      //stop submitting the form to see the disabled button effect
      let x = document.forms["formTambah"]["unit"].value;
      if (x == "Pilih Unit") {
        iziToast.warning({
            title: 'Pesan Galat!',
            message: 'Unit belum terisi. Periksa sekali lagi',
            position: 'topRight'
        });

        return false;
      } else {
        $("#btn-submit").prop('disabled', true);
        $("#btn-submit").find("i").toggleClass("fa-save fa-sync fa-spin");

        return true;
      }
    });
  }
</script>
@endsection