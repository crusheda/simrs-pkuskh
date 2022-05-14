@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h4>Tabel</h4>   
        </div>
        <div class="card-body">
            @role('sekretaris-direktur')
                <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" data-placement="bottom" title="TAMBAH REGULASI">
                    <i class="fa-fw fas fa-plus-square nav-icon">

                    </i>
                    Tambah
                </a>
                <hr>
            @endrole
            <div class="table-responsive">
                <table id="table" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DISAHKAN</th>
                            <th>JUDUL</th>
                            <th>UNIT TERKAIT</th>
                            <th>DIBUAT</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="6"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
                    {{-- <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->sah)->isoFormat('D MMMM Y') }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                            <td>
                                <center>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='{{ url('regulasi/spo/'. $item->id) }}'" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>
                                        @role('sekretaris-direktur')
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        @endrole
                                    </div>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
  </div>
</div>

@role('sekretaris-direktur')
<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('spo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Pengesahan</label>
                            <input type="date" name="sah" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit Pembuat</label>
                            <select class="form-control selectric" name="pembuat" required>
                                <option hidden>Pilih</option>
                                @foreach($list['unit'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit Terkait</label>
                            <input type="text" name="unit" class="form-control" placeholder="IGD , ICU , ... , Semua Unit" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Dokumen</label><br>
                            <input type="file" name="file" required><br>
                            <sub>Format Upload : pdf,docx,doc,xls,xlsx,ppt,pptx,rtf</sub>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">

                <button class="btn btn-primary" type="submit"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
            Ubah <kbd id="id_edit"></kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Pengesahan</label>
                        <input type="date" id="sah_edit" class="form-control">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" id="judul_edit" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Unit Pembuat</label>
                        <select class="form-control selectric" id="pembuat_edit" required>
                            <option value="" hidden>Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Unit Terkait</label>
                        <input type="text" id="unit_edit" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Detail Dokumen</label><br>
                        {{-- @if ($item->filename == '')
                        -
                        @else
                            <b><u><a href="kebijakan/{{ $item->id }}">{{ substr($item->title,0,50) }}...</a></u></b><br><sub>Ukuran File : {{ number_format(Storage::size($item->filename) / 1048576,2) }} MB</sub>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary pull-right" id="submit_edit" onclick="ubah()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

{{-- @foreach($list['show'] as $item)
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
            {{ Form::model($item, array('route' => array('spo.update', $item->id), 'method' => 'PUT')) }}
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
@endforeach --}}

@foreach($list['show'] as $item)
<div class="modal fade" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Regulasi spo <b>{{ $item->judul }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('spo.destroy', $item->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach
@endrole

<script>
$(document).ready( function () {
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
                },
            ],
            order: [[ 0, "desc" ]]
        }
    );
} );
function refresh() {
  $("#tampil-tbody").empty().append(`<tr><td colspan="9"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
  $.ajax(
    {
      url: "./regulasi/spo/api/get",
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
                    content += `<button type="button" class="btn btn-danger btn-sm onclick="hapus(${item.id})" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
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
            url: "./regulasi/spo/api/getubah/"+id,
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
        url: './regulasi/spo/api/ubah/'+id, 
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
          url: "./regulasi/spo/api/hapus/"+id,
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