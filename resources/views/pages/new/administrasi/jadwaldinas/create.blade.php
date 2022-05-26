@extends('layouts.newAdmin')

@section('content')
{{-- SweetAlert2 for Button Submit --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" rel="stylesheet"/>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4>Formulir</h4>
              {{-- <div class="card-header-action">
                <h4></h4>
              </div> --}}
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <label>User :</label><br>
                  <h5 style="margin-bottom:-3px">{{ Auth::user()->nama }}</h5>
                  <sub>Penambahan Pada {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</sub>
                </div>
                <div class="col text-right">
                  <kbd>{{ $list['waktu'] }}</kbd><br>
                  {{-- <a>Periksa <i class="fa-fw fas fa-caret-left nav-icon"></i></a><br> --}}
                  {{-- <a>Pengusulan Pengadaan dapat dilakukan pada tanggal 1 - 25 setiap bulannya <i class="fa-fw fas fa-caret-left nav-icon"></i></a> --}}
                  {{-- <a>Mohon untuk menyertakan gambarnya <i class="fa-fw fas fa-caret-left nav-icon"></i></a> --}}
                </div>
              </div>
              <hr>
              <form class="form-auth-small" id="formTambah" action="{{ route('jadwal.dinas.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return submitForm(this);">
                @csrf
                <div class="table-responsive">
                  <table id="table" class="table table-bordered table-hover display" style="width: 100%">
                    <thead id="tampil-thead"><tr><th colspan="34"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</th></tr></thead>
                    <tbody id="tampil-tbody">
                        @if (count($list['user']) > 0)
                          @foreach($list['user'] as $item)
                            <tr>
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->nama }}</td>
                              @for ($i = 1; $i <= $list['days']; $i++)
                                <td style="white-space: nowrap;">
                                  <div class="form-group">
                                    <select name="barang[]" id="" class="form-control" style="width: 100%" required>
                                      <option hidden>Pilih</option>
                                      @if (count($list['ref']) > 0)
                                        @foreach ($list['ref'] as $val)
                                            <option value="{{ $val->id }}">{{ $val->waktu }}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                  </div>
                                </td>
                              @endfor
                            </tr>
                          @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="card-footer text-right">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('jadwal.dinas.index') }}'" data-toggle="tooltip" data-placement="bottom" title="KEMBALI"><i class="fa-fw fas fa-caret-left nav-icon"></i> Kembali</button>
                <input type="submit" class="btn btn-primary fas fa-save" data-toggle="tooltip" data-placement="bottom" title="VALIDASI FORM" value="&#xf0c7; Submit"/>
              </div>
              </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {

  $("#formTambah").one('submit', function() {
    //stop submitting the form to see the disabled button effect
    $("#btn-simpan").attr('disabled','disabled');
    $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
    
    return true;
  });

  // 👇️ DEFINE COUNT DAYS IN THIS MONTH
  const date = new Date();
  const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  const currentYear = date.getFullYear();
  const currentMonth = date.getMonth() + 1; // 👈️ months are 0-based
  const countBulan = getDaysInMonth(currentYear, currentMonth);

  // iSIAN TABLE
  $.ajax(
    {
      url: "./create/api/data",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        // TABLE HEAD
        $('#tampil-thead').empty();
        content_thead = `<tr>`;
        content_thead += `<th rowspan="2">IDS</th><th rowspan="2">NAMA</th><th style="text-transform:uppercase" colspan="`+countBulan+`"><center>BULAN `+monthNames[date.getMonth()]+`</center></th>`;
        content_thead += `</tr><tr>`;
        for (let i = 1; i <= countBulan; i++) {
          content_thead += `<th>`+i+`</th>`;
        }
        content_thead += `</tr>`;
        $('#tampil-thead').append(content_thead);

        // TABLE BODY
        // res.show.forEach(item => {
        //   $("#tampil-tbody").append(`
              
        //   `);
        // });
        // $("#barang1").prop('disabled', false);
      }
    }
  );
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

  function submitForm(form) {
    swal({
        title: "Apakah anda sudah yakin?",
        text: "Periksa sekali lagi untuk memastikan data sudah terisi dengan benar",
        // icon: "info",
        // buttons: true,
        // dangerMode: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        timer: 5000,
        // timerProgressBar: true,
        focusCancel: true,
        showCancelButton: true,
        confirmButtonColor: '#6777EF',
        confirmButtonText: `<i class="fa fa-save"></i> Submit`,
        cancelButtonText: `<i class="fa fa-times"></i> Batal`,
        // backdrop: `rgba(26,27,41,0.8)`,
    })
    .then(function (isOkay) {
        if (isOkay) {
            form.submit();
        }
    });
    return false;
  }

  function getDaysInMonth(year, month) {
    return new Date(year, month, 0).getDate();
  }
</script>
@endsection