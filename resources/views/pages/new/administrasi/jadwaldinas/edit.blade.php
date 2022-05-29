@extends('layouts.newAdmin')

@section('content')
{{-- SweetAlert2 for Button Submit --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" rel="stylesheet"/>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4>Formulir Jadwal {{ $list['waktu'] }} - <kbd>ID : {{ $list['show']->id_jadwal }}</kbd></h4>
              <div class="card-header-action">
                <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="INFORMASI JADWAL DINAS"><i class="fa-fw fas fa-info-circle nav-icon"></i> Informasi</button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <label>User :</label><br>
                  <h5 style="margin-bottom:-3px">{{ Auth::user()->nama }}</h5>
                  <sub>Terakhir Diupdate : {{ \Carbon\Carbon::parse($list['show']->updated_at)->isoFormat('dddd, D MMMM Y') }}</sub>
                </div>
                <div class="col text-right">
                  <sub>Untuk mempercepat pengisian Jadwal Dinas, <br>gunakan tombol keyboard : <h6 style="margin-top: 5px"><span class="badge badge-dark">TAB <i class="fa fa-arrows-alt-h fa-fw"></i></span> / <span class="badge badge-dark"> <i class="fa fa-arrow-up fa-fw"></i></span> / <span class="badge badge-dark"> <i class="fa fa-arrow-down fa-fw"></i></span></h6></sub>
                  {{-- <kbd></kbd><br> --}}
                  {{-- <a>Periksa <i class="fa-fw fas fa-caret-left nav-icon"></i></a><br> --}}
                  {{-- <a>Pengusulan Pengadaan dapat dilakukan pada tanggal 1 - 25 setiap bulannya <i class="fa-fw fas fa-caret-left nav-icon"></i></a> --}}
                  {{-- <a>Mohon untuk menyertakan gambarnya <i class="fa-fw fas fa-caret-left nav-icon"></i></a> --}}
                </div>
              </div>
              <hr>
              {{ Form::model($list['show'], array('route' => array('jadwal.dinas.ubah', $list['show']->id_jadwal), 'method' => 'PUT')) }}
                @csrf
                <input type="text" name="bulan" class="form-control" value="{{ $list['waktuOri'] }}" hidden>
                <input type="text" name="unit" class="form-control" value="{{ $list['unit'] }}" hidden>
                <div class="table-responsive">
                  <table id="table" class="table-striped" style="width: 100%">
                    <thead id="tampil-thead" class="text-center">
                      <tr>
                        <th rowspan="2">IDS</th>
                        <th rowspan="2">NAMA</th>
                        <th style="text-transform:uppercase" colspan="{{ $list['days'] }}">BULAN {{ $list['waktu'] }}</th>
                      </tr>
                      <tr>
                        @for ($i = 1; $i <= $list['days']; $i++)
                          <th style="width:35px">{{ $i }}</th>
                        @endfor
                      </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        @if (count($list['user']) > 0)
                          @foreach($list['user'] as $item)
                            <tr>
                              <td class="text-center" style="vertical-align: top;">{{ $item->id }}</td>
                              <td style="white-space: nowrap;vertical-align: top;">{{ $item->nama }}</td>
                                @foreach ($list['detail'] as $dt)
                                @if ($item->id_staf == $dt->id_staf)
                                  <td style="white-space: nowrap;">
                                    <div class="form-group"><center>
                                      <select name="waktu[]" id="waktu{{ $item->id }}{{ $dt->tgl }}" onchange="waktuJadwal({{ $item->id }}{{ $dt->tgl }})" required>
                                        <option hidden @if ($dt->id_ref == null) selected @endif></option>
                                        @if (count($list['ref']) > 0)
                                          @foreach ($list['ref'] as $val)
                                              <option value="{{ $val->id }}" @if ($val->id == $dt->id_ref) selected @endif>{{ $val->singkat }}</option>
                                          @endforeach
                                        @endif
                                        <option value="100001" @if ($dt->id_ref == '100001') selected @endif>L</option>
                                        <option value="100002" @if ($dt->id_ref == '100002') selected @endif>C</option>
                                      </select></center>
                                    </div>
                                  </td>
                                @endif
                                @endforeach
                            </tr>
                          @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="card-footer text-right">
              <div class="btn-group">
                <sub style="margin-top:10px">Pastikan semua pilihan terisi <i class="fa-fw fas fa-caret-left nav-icon"></i>&nbsp;&nbsp;</sub>
                <button type="button" class="btn btn-secondary" onclick="batalJadwal()" data-toggle="tooltip" data-placement="bottom" title="KEMBALI"><i class="fa-fw fas fa-caret-left nav-icon"></i> Kembali</button>
                <input type="submit" class="btn btn-primary fas fa-save" data-toggle="tooltip" data-placement="bottom" title="VALIDASI FORM" value="&#xf0c7; Simpan Perubahan"/>
              </div>
              </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {

  // 👇️ DEFINE COUNT DAYS IN THIS MONTH
  const date = new Date();
  const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
  ];
  const currentYear = date.getFullYear();
  const currentMonth = date.getMonth() + 1; // 👈️ months are 0-based
  const countBulan = getDaysInMonth(currentYear, currentMonth);

  $("body").addClass('sidebar-mini');
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
  
  function waktuJadwal(params) {
    $('#waktu'+params).css('background-color', '#FDD1D0');
  }
  
  function batalJadwal() {
    iziToast.show({
      theme: 'warning',
      icon: 'icon-person',
      title: 'Apakah anda yakin?',
      message: 'Ingin membatalkan pengubahan Jadwal Dinas',
      position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
      progressBarColor: '#6777EF',
      buttons: [
          ['<button>Ya</button>', function (instance, toast) {
            window.location.href = "{{ route('jadwal.dinas.index') }}";
          }], // true to focus
          ['<button>Tidak</button>', function (instance, toast) {
              instance.hide({
                  transitionOut: 'fadeOutUp',
              }, toast, 'buttonName');
          },true]
      ],
    });
    // Swal.fire({
    //   title: 'Apakah anda yakin?',
    //   text: 'Ingin membatalkan pembuatan Jadwal Dinas',
    //   reverseButtons: false,
    //   showDenyButton: false,
    //   showCloseButton: false,
    //   showCancelButton: true,
    //   focusCancel: true,
    //   confirmButtonColor: '#FF4845',
    //   confirmButtonText: `<i class="fa fa-thumbs-up"></i> Ya`,
    //   cancelButtonText: `<i class="fa fa-thumbs-down"></i> Tidak`,
    //   backdrop: `rgba(26,27,41,0.8)`,
    // }).then((result) => {
    //   if (result.isConfirmed) {
    //   }
    // })
  }

  function getDaysInMonth(year, month) {
    return new Date(year, month, 0).getDate();
  }
</script>
@endsection