@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h4>Tabel</h4>   
        </div>
        <div class="card-body">
            <div class="btn-group">
                @role('it|sekretaris-direktur')
                    <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" data-placement="bottom" title="TAMBAH REGULASI">
                        <i class="fa-fw fas fa-plus-square nav-icon">
    
                        </i>
                        Tambah
                    </a>
                    <hr>
                @endrole
                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped display" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DISAHKAN</th>
                            <th>JUDUL</th>
                            <th>UNIT PEMBUAT</th>
                            <th>UNIT TERKAIT</th>
                            <th>DIBUAT</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="7"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>

@role('it|sekretaris-direktur')
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
            Ubah <kbd id="show_edit"></kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <input type="text" id="id_edit" class="form-control" hidden>
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
                        <select class="form-control" id="pembuat_edit" required>
                            {{-- <option value="" hidden>Pilih</option> --}}
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
                        <div id="file_edit"></div>
                        <sub id="sizeFile_edit"></sub>
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
@endrole

<script>
$(document).ready( function () {
    $.ajax(
        {
            url: "./spo/api/get",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                // var userID = "{{ Auth::user()->id }}";
                var adminID = "{{ Auth::user()->hasRole('it|sekretaris-direktur') }}";
                // var date = new Date().toISOString().split('T')[0];
                if(res.show.length != 0){
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = "<tr id='data"+ item.id +"'><td>" 
                                    + item.id + "</td><td>" 
                                    + item.sah + "</td><td>" 
                                    + item.judul + "</td><td>" 
                                    + item.pembuat + "</td><td>"
                                    + item.unit + "</td><td>"
                                    + item.created_at + "</td>";

                        content += "<td><center><div class='btn-group' role='group'>";
                            content += `<button type="button" class="btn btn-success btn-sm" onclick="window.location.href='spo/${item.id}';" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></button>`;
                            if (adminID) {
                                content += `<button type="button" class="btn btn-warning btn-sm" onclick="showUbah(${item.id})" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>`;
                                content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(${item.id})" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                            }
                        content += "</div></center></td></tr>";
                        $('#tampil-tbody').append(content);
                    });
                }
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
                        order: [[ 5, "desc" ]],
                        pageLength: 10
                    }
                ).columns.adjust();
            }
        }
    );
} );
function refresh() {
  $("#tampil-tbody").empty().append(`<tr><td colspan="9"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
  $.ajax(
    {
      url: "./spo/api/get",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        $('#table').DataTable().clear().destroy();
        var adminID = "{{ Auth::user()->hasRole('it|sekretaris-direktur') }}";
        if(res.show.length != 0){
            res.show.forEach(item => {
                // var updet = item.updated_at.substring(0, 10);
                content = "<tr id='data"+ item.id +"'><td>" 
                            + item.id + "</td><td>" 
                            + item.sah + "</td><td>" 
                            + item.judul + "</td><td>" 
                            + item.pembuat + "</td><td>"
                            + item.unit + "</td><td>"
                            + item.created_at + "</td>";

                content += "<td><center><div class='btn-group' role='group'>";
                    content += `<button type="button" class="btn btn-success btn-sm" onclick="window.location.href='spo/${item.id}';" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></button>`;
                    if (adminID) {
                        content += `<button type="button" class="btn btn-warning btn-sm" onclick="showUbah(${item.id})" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>`;
                        content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(${item.id})" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                    }
                content += "</div></center></td></tr>";
                $('#tampil-tbody').append(content);
            });
        }
        $('#table').DataTable(
            {
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
              order: [[ 5, "desc" ]],
              pageLength: 10
            }
        ).columns.adjust();
      }
    }
  );
}
function showUbah(id) {
    $('#ubah').modal('show');
    $.ajax(
        {
            url: "./spo/api/getubah/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                // var tgl = res.tgl + 'T' + res.waktu;
                document.getElementById('show_edit').innerHTML = "ID : "+res.show.id;
                $("#id_edit").val(res.show.id);
                $("#sah_edit").val(res.show.sah);
                $("#judul_edit").val(res.show.judul);
                $("#unit_edit").val(res.show.unit);
                $("#pembuat_edit").find('option').remove();
                res.unit.forEach(item => {
                    $("#pembuat_edit").append(`
                        <option value="${item.id}" ${item.id == res.show.pembuat? "selected":""}>${item.nama}</option>
                    `);
                });
                $("#file_edit").empty();
                $("#file_edit").append(`
                    <b><u><a href="./spo/${res.show.id}">${res.show.title}</a></u></b>
                `);
                document.getElementById('sizeFile_edit').innerHTML = "Ukuran File : "+res.sizeFile+" Mb";
            }
        }
    );
}

function ubah() {
    var id          = $("#id_edit").val();
    var sah         = $("#sah_edit").val();
    var judul       = $("#judul_edit").val();
    var pembuat     = $("#pembuat_edit").val();
    var unit        = $("#unit_edit").val();

    if (sah == "" || judul == "" || pembuat == "" || unit == "") {
        Swal.fire({
        title: 'Pesan Galat!',
        text: 'Mohon lengkapi semua data terlebih dahulu dan pastikan tidak ada yang kosong',
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
        url: './spo/api/ubah/'+id, 
        dataType: 'json', 
        data: { 
            id: id,
            sah: sah,
            judul: judul,
            pembuat: pembuat,
            unit: unit,
        }, 
        success: function(res) {
            iziToast.success({
                title: 'Sukses!',
                message: 'Ubah Regulasi SPO berhasil pada '+res,
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
      text: 'Regulasi SPO ID : '+id,
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
          url: "./spo/api/hapus/"+id,
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