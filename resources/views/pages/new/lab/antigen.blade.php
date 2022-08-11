@extends('layouts.newAdmin')

@section('content')
{{-- <h2 class="section-title">DataTables</h2> --}}
<p>
</p>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>Tabel Antigen</h4>
      </div>
      <div class="card-body">
        <div class="btn-group">
            <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" data-toggle="tooltip" data-placement="bottom" title="TAMBAH HASIL ANTIGEN PASIEN">
            <i class="fa-fw fas fa-plus-square nav-icon">

            </i>
            Tambah Hasil
            </button>
            <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
            {{-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#show" data-toggle="tooltip" data-placement="bottom" title="DATA PASIEN HARI INI"><i class="fa-fw fas fa-info nav-icon text-white"></i> Informasi</button><br> --}}
        </div><br>
        <sub>Data yang ditampilkan hanya berjumlah 30 data terbaru saja, Klik <a href="javascript:void(0)" onclick="window.location.href='{{ url('lab/antigen/all') }}'"><strong><u>Disini</u></strong></a> untuk melihat data seluruhnya.</sub>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped" id="tableku" style="width: 100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>DOKTER PENGIRIM</th>
                <th>RM</th>
                <th>PASIEN</th>
                <th>JK/UMUR</th>
                <th>ALAMAT</th>
                <th>TGL</th>
                <th>HASIL</th>
                <th><center>AKSI</center></th>
              </tr>
            </thead>
            <tbody id="tampil-tbody"><tr><td colspan="9"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>DOKTER PENGIRIM</th>
                    <th>RM</th>
                    <th>PASIEN</th>
                    <th>JK/UMUR</th>
                    <th>ALAMAT</th>
                    <th>TGL</th>
                    <th>HASIL</th>
                    <th><center>AKSI</center></th>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@can('antigen')
    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Tambah Hasil Antigen
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-auth-small" action="{{ route('lab.antigen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>RM :</label>
                                <input type="number" name="rm" id="rm" max="99999999" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Pemeriksa :</label>
                                <input type="text" name="pemeriksa" id="pemeriksa" class="form-control" placeholder="Optional">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tgl :</label>
                                <input type="datetime-local" name="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list['now'])); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Dokter Pengirim :</label>
                                <select class="form-control select2" name="dr_pengirim" id="dr_pengirim" style="width: 100%" required>
                                    <option value="" hidden>Pilih</option>
                                        @foreach($list['dokter'] as $key => $item)
                                            <option value="{{ $item->id }}"><label><b>{{ $item->jabatan }}</b></label> - {{ $item->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hasil :</label>
                                <select class="form-control selectric" name="hasil" id="hasil" style="width: 100%" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="POSITIF">POSITIF</option>
                                    <option value="NEGATIF">NEGATIF</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama :</label>
                                <input type="text" name="nama" id="nama1" class="form-control" placeholder="" hidden>
                                <input type="text" id="nama2" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis Kelamin :</label>
                                <input type="text" name="jns_kelamin" id="jns_kelamin1" class="form-control" hidden>
                                <input type="text" id="jns_kelamin2" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Umur :</label>
                                <input type="text" name="umur" id="umur1" class="form-control" hidden>
                                <input type="text" id="umur2" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat :</label>
                                <input type="text" name="des" id="des" class="form-control" hidden>
                                <input type="text" name="kec" id="kec" class="form-control" hidden>
                                <input type="text" name="kab" id="kab" class="form-control" hidden>
                                <textarea class="form-control" name="alamat" id="alamat1" placeholder="" maxlength="190" rows="8" hidden></textarea>
                                <textarea class="form-control" style="min-height: 100px" id="alamat2" placeholder="" maxlength="190" rows="5" disabled></textarea>
                            </div>
                        </div>
                    </div><br>
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan <kbd>Nomor RM</kbd> sesuai dengan Database Pilar.</a>

            </div>
            <div class="modal-footer">

                    <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ubah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Hasil Antigen&nbsp;<span class="pull-right badge badge-info text-white">ID : <a id="show_id"></a></span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_edit" hidden>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>RM :</label>
                            <input type="number" id="rm_edit" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Pemeriksa :</label>
                            <input type="text" id="pemeriksa_edit" class="form-control" placeholder="Optional">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl :</label>
                            <input type="datetime-local" id="tgl_edit" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Dokter Pengirim :</label>
                            <select class="form-control select2" style="width: 100%" id="dr_pengirim_edit" required></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hasil :</label>
                            <select class="form-control select" id="hasil_edit" style="width: 100%" required></select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama :</label>
                            <input type="text" class="form-control" id="nama_edit" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis Kelamin :</label>
                            <input type="text" class="form-control" id="jns_kelamin_edit" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Umur :</label>
                            <input type="text" class="form-control" id="umur_edit" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Alamat :</label>
                            <textarea class="form-control" id="alamat_edit" disabled></textarea>
                        </div>
                    </div>
                </div>
                <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Jika terdapat kesalahan pada penulisan <kbd>Nomor RM</kbd> , silakan Hapus data dan Input ulang kembali</a>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary pull-right" id="submit_edit" onclick="ubah()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>

    {{-- <div class="modal fade bd-example-modal-lg" id="show" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Data Pasien Antigen Hari Ini
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @if(!empty($list['getpos'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN POSITIF (HARI INI) : <kbd style="background-color: red">{{ $list['getpos'][0]->jumlah }} Pasien</kbd></a> <br><br>
                    @endif
                    @if(!empty($list['getneg'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN NEGATIF (HARI INI) : <kbd style="background-color: royalblue">{{ $list['getneg'][0]->jumlah }} Pasien</kbd></a> <br><br>
                    @endif
                    @if(!empty($list['gettoday'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN HARI INI : <kbd style="background-color: rgba(134, 19, 87, 0.45)">{{ $list['gettoday'][0]->jumlah }} Pasien</kbd></a> <br><br>
                    @endif
                    @if(!empty($list['getmont'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN BULAN INI : <kbd style="background-color: rgb(23, 106, 4)">{{ $list['getmont'][0]->jumlah }} Pasien</kbd></a>
                    @endif
                </div>
                <div class="modal-footer">
                    <a class="pull-left"><b># Updated {{ \Carbon\Carbon::parse($list['now'])->isoFormat('DD MMMM YYYY') }}</b></a>
                </div>
            </div>
        </div>
    </div> --}}
@endcan

<script>
  $(document).ready( function () {
    // $("body").addClass('sidebar-mini');
    $.ajax(
        {
            url: "./antigen/api/get",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                // var date = new Date().toISOString().split('T')[0];
                if(res.show.length == 0){
                    $("#tampil-tbody").append(`<tr><td colspan="9"><center><i class="fas fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
                } else {
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = "<tr id='data"+ item.id +"'><td>" 
                                    + item.id + "</td><td>" 
                                    + item.dr_nama + "</td><td>" 
                                    + item.rm + "</td><td>" 
                                    + item.nama + "</td><td>"
                                    + item.jns_kelamin + " / " + item.umur + "</td><td>"
                                    + item.alamat + "</td><td>"
                                    + item.tgl + "</td><td>";
                                    if (item.hasil == "POSITIF")
                                        content += "<kbd style='background-color: red'>" + item.hasil + "</kbd>";
                                    else
                                        content += "<kbd style='background-color: royalblue'>"+item.hasil+"</kbd>";

                        content += "<td><center><div class='btn-group' role='group'>";
                            content += `<button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('antigen/`+item.id+`/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>`;
                            content += `<button type="button" class="btn btn-success btn-sm" onclick="window.open('antigen/`+item.id+`/cetak')" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></button>`;
                            content += `<button type="button" class="btn btn-warning btn-sm" onclick="showUbah(${item.id})" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>`;
                            content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(${item.id})" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                        content += "</div></center></td></tr>";
                        $('#tampil-tbody').append(content);
                    });
                }
                $('#tableku').DataTable(
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
                            },
                        ],
                        order: [[ 6, "desc" ]],
                        pageLength: 10
                    }
                ).columns.adjust();
            }
        }
    );
    
    // VALIDASI INPUT NUMBER
    $('input[type=number][max]:not([max=""])').on('input', function(ev) {
        var $this = $(this);
        var maxlength = $this.attr('max').length;
        var value = $this.val();
        if (value && value.length >= maxlength) {
        $this.val(value.substr(0, maxlength));
        }
    });
    $('#rm').change(function() { 
        if (this.value == '') {
            $("#nama1").val("");
            $("#nama2").val("");
            $("#jns_kelamin1").val("");
            $("#jns_kelamin2").val("");
            $("#umur2").val("");
            $("#umur1").val("");
            $("#alamat1").val("");
            $("#alamat2").val("");
            $("#des").val("");
            $("#kec").val("");
            $("#kab").val("");
        } else {
            if (this.value.length == 4) {
                this.value = '0000'+this.value;
            }
            if (this.value.length == 5) {
                this.value = '000'+this.value;
            } 
            if (this.value.length == 6) {
                this.value = '00'+this.value;
            }
            if (this.value.length < 4) {
                this.value = this.value;
            }
            $.ajax({
                url: "http://192.168.1.3:8000/api/all/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res);
                    $("#nama1").val(res.NAMAPASIEN);
                    $("#nama2").val(res.NAMAPASIEN);
                    $("#jns_kelamin1").val(res.JNSKELAMIN);
                    $("#jns_kelamin2").val(res.JNSKELAMIN);
                    $("#umur1").val(res.UMUR);
                    $("#umur2").val(res.UMUR);
                    $("#alamat1").val(res.ALAMAT);
                    $("#alamat2").val(res.ALAMAT);
                    
                    $("#des").val(res.DESA);
                    $("#kec").val(res.KECAMATAN);
                    $("#kab").val(res.NAMA_KABKOTA);
                    // $('#jumlah20').attr('required', true);
                }
            });
            $.ajax({
                url: "http://103.155.246.25:8000/api/all/"+this.value,
                // url: "http://192.168.1.3:8000/api/all/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res);
                    $("#nama1").val(res.NAMAPASIEN);
                    $("#nama2").val(res.NAMAPASIEN);
                    $("#jns_kelamin1").val(res.JNSKELAMIN);
                    $("#jns_kelamin2").val(res.JNSKELAMIN);
                    $("#umur1").val(res.UMUR);
                    $("#umur2").val(res.UMUR);
                    $("#alamat1").val(res.ALAMAT);
                    $("#alamat2").val(res.ALAMAT);

                    $("#des").val(res.DESA);
                    $("#kec").val(res.KECAMATAN);
                    $("#kab").val(res.NAMA_KABKOTA);
                    // $('#jumlah20').attr('required', true);
                }
            });
        }
    });
  })

function refresh() {
  $("#tampil-tbody").empty().append(`<tr><td colspan="9"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
  $.ajax(
    {
      url: "./antigen/api/get",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        // $('#tableku').DataTable().clear().destroy();
        if(res.show.length == 0){
            $("#tampil-tbody").append(`<tr><td colspan="9"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
        } else {
            res.show.forEach(item => {
                // var updet = item.updated_at.substring(0, 10);
                content = "<tr id='data"+ item.id +"'><td>" 
                            + item.id + "</td><td>" 
                            + item.dr_nama + "</td><td>" 
                            + item.rm + "</td><td>" 
                            + item.nama + "</td><td>"
                            + item.jns_kelamin + " / " + item.umur + "</td><td>"
                            + item.alamat + "</td><td>"
                            + item.tgl + "</td><td>";
                            if (item.hasil == "POSITIF")
                                content += "<kbd style='background-color: red'>" + item.hasil + "</kbd>";
                            else
                                content += "<kbd style='background-color: royalblue'>"+item.hasil+"</kbd>";

                content += "<td><center><div class='btn-group' role='group'>";
                    content += `<button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('antigen/`+item.id+`/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>`;
                    content += `<button type="button" class="btn btn-success btn-sm" onclick="window.open('antigen/`+item.id+`/cetak')" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></button>`;
                    content += `<button type="button" class="btn btn-warning btn-sm" onclick="showUbah(${item.id})" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>`;
                    content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(${item.id})" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                content += "</div></center></td></tr>";
                $('#tampil-tbody').append(content);
            });
        }
        // $('#tableku').DataTable(
        //     {
        //       dom: 'Bfrtip',
        //       buttons: [
        //         {
        //           extend: 'copyHtml5',
        //           className: 'btn-info',
        //           text: 'Salin Baris',
        //           download: 'open',
        //         },
        //         {
        //           extend: 'excelHtml5',
        //           className: 'btn-success',
        //           text: 'Export Excell',
        //           download: 'open',
        //         },
        //         {
        //           extend: 'pdfHtml5',
        //           className: 'btn-warning',
        //           text: 'Cetak PDF',
        //           download: 'open',
        //         },
        //         {
        //             extend: 'colvis',
        //             className: 'btn-dark',
        //             text: 'Sembunyikan Kolom',
        //             exportOptions: {
        //                 columns: ':visible'
        //             }
        //         },
        //       ],
        //       order: [[ 5, "desc" ]],
        //       pageLength: 10
        //     }
        // ).columns.adjust();
      }
    }
  );
}
function showUbah(id) {
    $('#ubah').modal('show');
    $.ajax(
        {
            url: "./antigen/api/getubah/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                var tgl = res.tgl + 'T' + res.waktu;
                document.getElementById('show_id').innerHTML = res.show.id;
                $("#id_edit").val(res.show.id);
                $("#rm_edit").val(res.show.rm);
                $("#pemeriksa_edit").val(res.show.pemeriksa);
                $("#tgl_edit").val(tgl); // yyyy-MM-ddThh:mm
                // document.getElementById('tgl_edit').value = tgl;
                $("#nama_edit").val(res.show.nama);
                $("#jns_kelamin_edit").val(res.show.jns_kelamin);
                $("#umur_edit").val(res.show.umur);
                $("#alamat_edit").val(res.show.alamat);
                $("#dr_pengirim_edit").find('option').remove();
                $("#hasil_edit").find('option').remove();
                res.dokter.forEach(item => {
                    $("#dr_pengirim_edit").append(`
                        <option value="${item.id}" ${item.id == res.show.dr_pengirim? "selected":""}>${item.nama} (${item.jabatan})</option>
                    `);
                });
                $("#hasil_edit").append(`
                    <option value="POSITIF" ${res.show.hasil == 'POSITIF'? "selected":""}>POSITIF</option>
                    <option value="NEGATIF" ${res.show.hasil == 'NEGATIF'? "selected":""}>NEGATIF</option>
                `);
            }
        }
    );
}

function ubah() {
    var id          = $("#id_edit").val();
    var pemeriksa   = $("#pemeriksa_edit").val();
    var tgl         = $("#tgl_edit").val();
    var dr_pengirim = $("#dr_pengirim_edit").val();
    var hasil       = $("#hasil_edit").val();

    if (pemeriksa == "" || tgl == "") {
        Swal.fire({
        title: 'Pesan Galat!',
        text: 'Mohon lengkapi semua data terlebih dahulu',
        icon: 'error',
        showConfirmButton:false,
        showCancelButton:false,
        allowOutsideClick: true,
        allowEscapeKey: true,
        timer: 3000,
        timerProgressBar: true,
        backdrop: `rgba(26,27,41,0.8)`,
        });
    } else {
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: './antigen/api/ubah/'+id, 
        dataType: 'json', 
        data: { 
            id: id,
            pemeriksa: pemeriksa,
            tgl: tgl,
            dr_pengirim: dr_pengirim,
            hasil: hasil,
        }, 
        success: function(res) {
            iziToast.success({
                title: 'Sukses!',
                message: 'Ubah hasil Antigen berhasil pada '+res,
                position: 'topRight'
            });
            if (res) {
                $('#ubah').modal('hide');
                refresh();
            }
        }
        });
    }
}

function hapus(id) {
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Hasil Antigen ID : '+id,
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
          url: "./antigen/api/hapus/"+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            iziToast.success({
                title: 'Sukses!',
                message: 'Hapus hasil Antigen berhasil pada '+res,
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