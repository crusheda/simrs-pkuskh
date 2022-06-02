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
              <div class="row">
                <div class="col">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="bottom" title="TAMBAH JADWAL DINAS" onclick="tambah()">
                      <i class="fa-fw fas fa-plus-square nav-icon"></i>	Buat Jadwal
                    </button>
                    <button type="button" class="btn btn-dark text-white disabled" data-toggle="tooltip" data-placement="bottom" title="INFORMASI JADWAL DINAS" onclick="" disabled>
                      <i class="fa-fw fas fa-business-time nav-icon"></i>
                    </button>
                  </div>
                </div>
                <div class="col text-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="TAMBAH REFERENSI JADWAL" onclick="window.location='{{ route('ref.jadwal.dinas.index') }}'"><i class="fa-fw fas fa-clock nav-icon"></i> Ref Jadwal</button>
                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="TAMBAH STAF UNIT" onclick="window.location='{{ route('staf.jadwal.dinas.index') }}'"><i class="fa-fw fas fa-users-cog nav-icon"></i> Atur Staf</button>
                  </div>
                </div>
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
                                  <td>{{ $item->nama_unit }}</td>
                                  <td>{{ \Carbon\Carbon::parse($item->waktu)->isoFormat("MMMM Y") }}</td>
                                  <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                  <td>
                                      <center>
                                          <div class="btn-group" role="group">
                                              <button type="button" class="btn btn-info btn-sm" id="btn-detail{{ $item->id_jadwal }}" onclick="detail({{ $item->id_jadwal }})" data-toggle="tooltip" data-placement="bottom" title="LIHAT JADWAL DINAS"><i class="fas fa-sort-amount-down"></i></button>
                                              @role('it')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus({{ $item->id_jadwal }})" data-toggle="tooltip" data-placement="bottom" title="HAPUS JADWAL DINAS"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                              @else
                                                @if (Auth::user()->id == $item->id_user)
                                                  @if (\Carbon\Carbon::parse($item->waktu)->isoFormat("YYYY-MM") == \Carbon\Carbon::now()->isoFormat("YYYY-MM"))
                                                    {{-- <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='./jadwaldinas/ubah/{{ $item->id_jadwal }}'" data-toggle="tooltip" data-placement="bottom" title="UBAH JADWAL DINAS"><i class="fa-fw fas fa-edit nav-icon"></i></button> --}}
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus({{ $item->id_jadwal }})" data-toggle="tooltip" data-placement="bottom" title="HAPUS JADWAL DINAS"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                  @else
                                                    {{-- <button type="button" class="btn btn-secondary btn-sm text-white disabled" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> --}}
                                                    <button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                  @endif
                                                @else
                                                  {{-- <button type="button" class="btn btn-secondary btn-sm text-white disabled" disabled><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> --}}
                                                  <button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                @endif
                                              @endrole
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
        <form id="formTambah" class="form-auth-small" action="{{ route('jadwal.dinas.create') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Bulan dan Tahun</label>
            {{-- <input type="month" class="form-control disabled" value="{{ \Carbon\Carbon::now()->isoFormat('YYYY-MM') }}" disabled> --}}
            <input type="month" name="waktu" class="form-control" value="{{ \Carbon\Carbon::now()->isoFormat('YYYY-MM') }}">
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
          <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Penghapusan Jadwal Dinas hanya bisa dilakukan pada bulan yg sama dengan jadwal</sub>
          {{-- <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pengumpulan Jadwal Dinas dilakukan pada tanggal x - x</sub> --}}
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary" id="btn-lanjutkan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Lanjutkan</button>
        </form>

        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="detail" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-xxl">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">
        Detail Jadwal Dinas
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <label>Pemohon :</label><br>
            <u><h5 style="margin-bottom:-3px" id="d_user"></h5></u>
            <sub id="d_update"></sub>
          </div>
          <div class="col text-right">
            <kbd>IDJ : <a id="d_id"></a></kbd> <kbd><a id="d_unit"></a></kbd><br>
            <label style="margin-bottom:-3px;margin-top:5px">Jadwal Pada Bulan :</label><br>
            <h5 id="d_waktu"></h5>
            {{-- <a>Tuliskan (CITO) pada kolom keterangan, bila Darurat <i class="fa-fw fas fa-caret-left nav-icon"></i></a><br>
            <a>Pengusulan Pengadaan dapat dilakukan pada tanggal 1 - 25 setiap bulannya <i class="fa-fw fas fa-caret-left nav-icon"></i></a> --}}
          </div>
        </div>
        <div class="table-responsive">
          <table id="table" class="table-striped table-bordered" style="width: 100%">
              <thead id="tampil-thead"><tr><center><td><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></center></tr></thead>
              <tbody id="tampil-tbody"><tr><center><td><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></center></tr></tbody>
          </table>
        </div>
        <br>
        <label>Keterangan :</label>
        <div id="tampil-ket"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
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
      order: [[ 0, "desc" ]],
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

  function detail(id) {
    $("#btn-detail"+id).prop('disabled', true);
    $("#btn-detail"+id).find("i").toggleClass("fa-sort-amount-down fa-sync fa-spin");
    $.ajax(
      {
        url: "./jadwaldinas/api/detail/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          // 👇️ DEFINE COUNT DAYS IN THIS MONTH
          const date = new Date();
          const monthNames = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
          ];
          const currentYear = date.getFullYear();
          // const currentMonth = date.getMonth() + 1; // 👈️ months are 0-based
          const currentMonth = res.getBulan; // 👈️ months are 0-based
          const countBulan = getDaysInMonth(currentYear, currentMonth);

          $("#btn-detail"+id).prop('disabled', false);
          $("#btn-detail"+id).find("i").removeClass("fa-sync fa-spin").addClass('fa-sort-amount-down');

          $("#d_id").text(res.jadwalDinas.id_jadwal);
          $("#d_user").text(res.jadwalDinas.nama_user);
          $("#d_update").text(res.jadwalDinas.updated_at);
          $("#d_unit").text(res.jadwalDinas.nama_unit);
          $("#d_waktu").text(res.bulan);

          // TABLE HEAD
          $('#tampil-thead').empty();
          $('#tampil-tbody').empty();
          $('#tampil-ket').empty();
          // $('#tampil-tfoot').empty();
          content_thead = `<tr>`;
          content_thead += `<th rowspan="2"><center>IDS</center></th><th rowspan="2"><center>NAMA</center></th><th style="text-transform:uppercase" colspan="`+countBulan+`"><center>BULAN `+monthNames[currentMonth]+`</center></th>`;
          content_thead += `</tr><tr>`;
          for (let i = 1; i <= countBulan; i++) {
            content_thead += `<th style="width:35px"><center>`+i+`</center></th>`;
          }
          content_thead += `</tr>`;
          $('#tampil-thead').append(content_thead);
          
          // TABLE BODY
          content_tbody = ``;
          console.log(res.totalDays);
          res.detailJadwalDinas.forEach(item => {
            console.log(item);
            content_tbody += `<tr>`;
            content_tbody += `<td><center>`+item.id_staf+`</center></td>`;
            content_tbody += `<td style="white-space: nowrap;">`+item.nama_staf+`</td>`;
            // LOOP TGL JADWAL
            res.ref.forEach(val => { 
              if (val.id == item.tgl1) {
                content_tbody += `<td><center>`+val.singkat+`</center></td>`; 
              }
            })
            if (item.tgl1 == 100001) {
              content_tbody += `<td><center>L</center></td>`;
            }
            if (item.tgl1 == 100002) { 
              content_tbody += `<td><center>C</center></td>`; 
            }
            // res.ref.forEach(val => { if (val.id == item.tgl1) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl1 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl1 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl2) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl2 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl2 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl3) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl3 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl3 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl4) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl4 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl4 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl5) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl5 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl5 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl6) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl6 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl6 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl7) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl7 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl7 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl8) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl8 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl8 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl9) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl9 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl9 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl10) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl10 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl10 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl11) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl11 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl11 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl12) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl12 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl12 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl13) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl13 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl13 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl14) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl14 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl14 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl15) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl15 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl15 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl16) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl16 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl16 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl17) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl17 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl17 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl18) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl18 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl18 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl19) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl19 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl19 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl20) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl20 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl20 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl21) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl21 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl21 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl22) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl22 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl22 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl23) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl23 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl23 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl24) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl24 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl24 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl25) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl25 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl25 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl26) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl26 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl26 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // res.ref.forEach(val => { if (val.id == item.tgl27) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl27 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl27 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // if (res.totalDays >= 28) {  
            //   res.ref.forEach(val => { if (val.id == item.tgl28) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl28 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl28 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })            
            // }
            // if (res.totalDays >= 29) {    
            //   res.ref.forEach(val => { if (val.id == item.tgl29) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl29 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl29 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })          
            // }
            // if (res.totalDays >= 30) {    
            //   res.ref.forEach(val => { if (val.id == item.tgl30) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl30 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl30 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })          
            // }
            // if (res.totalDays == 31) {              
            //   res.ref.forEach(val => { if (val.id == item.tgl31) { content_tbody += `<td><center>`+val.singkat+`</center></td>`; } else { if (item.tgl31 == '100002') { content_tbody += `<td><center>C</center></td>`; } else { if (item.tgl31 == '100001') {content_tbody += `<td><center>L</center></td>`;} } } })
            // }
            content_tbody += `</tr>`;
          });
          $('#tampil-tbody').append(content_tbody);
          
          // KET
          content_ket = ``;
          res.ref.forEach(item => {
            content_ket += `<p style="margin-bottom: -3px"><i class="fa-fw fas fa-caret-right nav-icon"></i> `+item.waktu+` (<b>`+item.singkat+`</b>) : `+item.berangkat+` - `+item.pulang+`</p>`;
          });
          $('#tampil-ket').append(content_ket);
          $('#detail').modal('show');
        }
      }
    );
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
        $("#btn-lanjutkan").prop('disabled', true);
        $("#btn-lanjutkan").find("i").toggleClass("fa-save fa-sync fa-spin");

        return true;
      }
    });
  }
  
  // FUNCTION
  function hapus(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Penghapusan Jadwal Dinas ID : '+id,
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
          url: "./jadwaldinas/api/hapus/"+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            iziToast.success({
                title: 'Sukses!',
                message: 'Hapus Jadwal Dinas berhasil pada '+res,
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

  function getDaysInMonth(year, month) {
    return new Date(year, month, 0).getDate();
  }
</script>
@endsection