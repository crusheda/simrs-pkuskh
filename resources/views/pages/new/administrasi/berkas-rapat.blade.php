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
                <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" title="TAMBAH BERKAS RAPAT">
                    <i class="fa-fw fas fa-plus-square nav-icon">
    
                    </i>
                    Tambah
                </button>
                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
                @role('it|sekretaris-direktur')
                    <button type="button" class="btn btn-danger disabled" data-toggle="tooltip" data-placement="bottom" title="RESTORE BERKAS RAPAT" disabled><i class="fa-fw fas fa-history nav-icon text-white"></i> Riwayat Penghapusan</button>
                @endrole
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-hover" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>KEGIATAN</th>
                                                <th>KETUA</th>
                                                <th>WAKTU</th>
                                                <th>LOKASI</th>
                                                <th>KET</th>
                                                <th>UPDATE</th>
                                                <th>USER</th>
                                                <th><center>#</center></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampil-tbody"><tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
                                        {{-- <tbody>
                                            @if(count($list) > 0)
                                            @foreach($list['show'] as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>
                                                    @foreach($list['user'] as $key => $val)
                                                        @if ($val->id == $item->kepala) {{ $val->nama }} @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMM Y, HH:mm a') }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->nama_user }}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group" role="group">
                                                            @if ($item->title1 != null)
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#lihatFile{{ $item->id }}"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>   
                                                            @else
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#download{{ $item->id }}"><i class="fa-fw fas fa-download nav-icon text-white"></i></button>   
                                                            @endif
                                                            @hasanyrole('it|kantor|pelayanan')
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusFile{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                            @else
                                                                @if (\Carbon\Carbon::parse($item->created_at)->isoFormat('YYYY/MM/DD') ==  $list['today'])
                                                                    @if(Auth::user()->id == $item->id_user)
                                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubahFile{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusFile{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                                    @endif
                                                                @endif
                                                            @endhasanyrole
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody> --}}
                                        <tfoot class="bg-whitesmoke">
                                            <tr>
                                                <th>ID</th>
                                                <th>KEGIATAN</th>
                                                <th>KETUA</th>
                                                <th>WAKTU</th>
                                                <th>LOKASI</th>
                                                <th>KET</th>
                                                <th>UPDATE</th>
                                                <th>USER</th>
                                                <th><center>#</center></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Tambah Berkas Rapat
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-auth-small" name="formTambah" action="{{ route('rapat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Kegiatan :</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="e.g. Rapat Rutin Unit ***" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Ketua Rapat : </label><br>
                                <select class="form-control select2" id="kepala" name="kepala" required style="width: 100%">
                                    <option value="Pilih" selected hidden>Pilih</option>
                                    @foreach($list['user'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal :</label>
                                <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list['tgl'])); ?>" required>
                                {{-- <input class="form-control" id="flatpickr" name="tanggal" type="text" placeholder="Pilih Tgl" style="background-color:#FDFDFF">
                                <a class="input-button" title="toggle" data-toggle>
                                    <i class="icon-calendar"></i>
                                </a> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Lokasi Rapat :</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Ruang ***" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan : (Optional)</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="" maxlength="190" rows="8"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <p>Upload <b>(Bisa lebih dari satu file)</b></p>
                        <input type="file" name="file2[]" id="file2" multiple required><br>
                        <sub>Berkas : Undangan / Materi / Absensi / Notulen / Dokumentasi.</sub><br>
                        <span class="help-block text-danger">{{ $errors->first('file2') }}</span>
                    </div>
            </div>
            <div class="modal-footer">

                    <button class="btn btn-success" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
                Ubah Rapat&nbsp;<kbd><a id="show_edit"></a></kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_edit" class="form-control" hidden>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Kegiatan :</label>
                            <input type="text" id="nama_edit" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Ketua Rapat : </label><br>
                            <select class="form-control select2" id="kepala_edit" style="width: 100%" required></select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal :</label>
                            <input type="datetime-local" id="tanggal_edit" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Lokasi Rapat :</label>
                            <input type="text" id="lokasi_edit" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan :</label>
                    <textarea class="form-control" id="keterangan_edit" maxlength="190" rows="8"></textarea>
                </div>
                <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Waktu pengubahan berkas rapat hanya berlaku pada hari saat anda mengupload</sub><br>
                <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Periksa ulang lampiran berkas anda, apabila terdapat kesalahan upload dokumen mohon hapus dan upload ulang</sub>
                    
            </div>
            <div class="modal-footer">
                Ditambahkan oleh&nbsp;<a id="user_edit"></a>
                <button class="btn btn-primary pull-right" id="submit_edit" onclick="ubah()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="download" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Deskripsi Berkas
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><i class="fa-fw fas fa-sort-numeric-down nav-icon"></i> Nama File</th>
                                <th>Perkiraan Ukuran</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-file"><tr><td colspan="2"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
                    </table>
                </div>
                <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> File download akan digabungkan dan dikonversikan dalam bentuk <kbd>ZIP FILE</kbd></sub>
            </div>
            <div class="modal-footer">
                Diupload&nbsp;<a id="tgl_upload"></a>
                <a type="button" class="btn btn-success text-white" id="download_btn"><i class="fa fa-download"></i> Download</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>

<script>
    $(document).ready( function () {
        $.ajax(
            {
                url: "./rapat/api/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var date = new Date().toISOString().split('T')[0];
                    var userID = "{{ Auth::user()->id }}";
                    var adminID = "{{ Auth::user()->hasRole('it') }}";
                    var date = new Date().toISOString().split('T')[0];
                    // $('#table').DataTable().clear().destroy();
                    // console.log(res.show);
                    if(res.show.length == 0){
                        $("#tampil-tbody").append(`<tr><td colspan="9"><center>No Data Available In Table</center></td></tr>`);
                    } else {
                        // console.log(res.show);
                        res.show.forEach(item => {
                            var updet = item.updated_at.substring(0, 10);
                            content = "<tr id='data"+ item.id +"'><td>" 
                                        + item.id + "</td><td>" 
                                        + item.nama + "</td><td>" 
                                        + item.nama_kepala + "</td><td>" 
                                        + item.tanggal + "</td><td>" 
                                        + item.lokasi + "</td><td>" 
                                        + item.keterangan + "</td><td>" 
                                        + item.updated_at + "</td><td>" 
                                        + item.nama_user + "</td>";
                            content += "<td><center><div class='btn-group' role='group'>";
                            if (adminID) {
                                content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS BERKAS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                            } else {
                                if (item.user_id == userID) {
                                    if (updet == date) {
                                        content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                        content += `<button type="button" class="btn btn-warning btn-sm" id="ubah`+item.id+`" onclick="showUbah(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="UBAH BERKAS"><i class="fas fa-edit"></i></button>`;
                                        content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS BERKAS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                                    } else {
                                        content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                        content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fas fa-edit"></i></button>`;
                                        content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                                    }
                                } else {
                                    content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                    content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fas fa-edit"></i></button>`;
                                    content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                                }
                            } 
                            content += "</div></center></td></tr>";
                            $('#tampil-tbody').append(content);
                        });
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
                                order: [[ 6, "desc" ]],
                                pageLength: 10
                            }
                        ).columns.adjust();
                    }
                }
            }
        );
        $("#flatpickr").flatpickr({
            enableTime: true,
            minDate: "today",
            maxDate: new Date().fp_incr(14) // 14 days from now
        });
    } );
    
    function refresh() {
        $("#tampil-tbody").empty().append(`<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
        $.ajax(
            {
                url: "./rapat/api/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var date = new Date().toISOString().split('T')[0];
                    var userID = "{{ Auth::user()->id }}";
                    var adminID = "{{ Auth::user()->hasRole('it') }}";
                    var date = new Date().toISOString().split('T')[0];
                    if(res.show.length == 0){
                        $("#tampil-tbody").append(`<tr><td colspan="9"><center>No Data Available In Table</center></td></tr>`);
                    } else {
                        $('#table').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            var updet = item.updated_at.substring(0, 10);
                            content = "<tr id='data"+ item.id +"'><td>" 
                                        + item.id + "</td><td>" 
                                        + item.nama + "</td><td>" 
                                        + item.nama_kepala + "</td><td>" 
                                        + item.tanggal + "</td><td>" 
                                        + item.lokasi + "</td><td>" 
                                        + item.keterangan + "</td><td>" 
                                        + item.updated_at + "</td><td>" 
                                        + item.nama_user + "</td>";
                            content += "<td><center><div class='btn-group' role='group'>";
                            if (adminID) {
                                content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS BERKAS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                            } else {
                                if (item.user_id == userID) {
                                    if (updet == date) {
                                        content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                        content += `<button type="button" class="btn btn-warning btn-sm" onclick="showUbah(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="UBAH BERKAS"><i class="fas fa-edit"></i></button>`;
                                        content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS BERKAS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                                    } else {
                                        content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                        content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fas fa-edit"></i></button>`;
                                        content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                                    }
                                } else {
                                    content += `<button type="button" class="btn btn-success btn-sm" onclick="download(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD BERKAS"><i class="fas fa-download"></i></button>`;
                                    content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fas fa-edit"></i></button>`;
                                    content += `<button type="button" class="btn btn-secondary btn-sm disabled" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                                }
                            } 
                            content += "</div></center></td></tr>";
                            $('#tampil-tbody').append(content);
                        });
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
                            order: [[ 6, "desc" ]],
                            pageLength: 10
                        }
                        ).columns.adjust();
                    }
                }
            }
        );
    }

    function showUbah(id) {
        $("#ubah"+id).prop('disabled', true);
        $("#ubah"+id).find("i").toggleClass("fa-edit fa-sync fa-spin");
        $.ajax(
        {
            url: "./rapat/api/data/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $('#ubah').modal('show');
                var dt = new Date(res.show.tanggal).toJSON().slice(0,19);
                // console.log(dt);
                document.getElementById('show_edit').innerHTML = "ID : "+res.show.id;
                document.getElementById('user_edit').innerHTML = res.show.user_nama;
                $("#id_edit").val(res.show.id);
                $("#nama_edit").val(res.show.nama);
                $("#tanggal_edit").val(dt);
                $("#lokasi_edit").val(res.show.lokasi);
                $("#keterangan_edit").val(res.show.keterangan);
                $("#kepala_edit").find('option').remove();
                res.kepala.forEach(item => {
                    $("#kepala_edit").append(`
                        <option value="${item.id}" ${item.id == res.show.kepala? "selected":""}>${item.nama}</option>
                    `);
                });
                $("#ubah"+id).find("i").removeClass("fa-sync fa-spin").addClass("fa-edit");
                $("#ubah"+id).prop('disabled', false);
            }
        }
        );
    }

    function ubah() {
        $("#submit_edit").prop('disabled', true);
        $("#submit_edit").find("i").toggleClass("fa-save fa-sync fa-spin");
        var id          = $("#id_edit").val();
        var nama        = $("#nama_edit").val();
        var kepala      = $("#kepala_edit").val();
        var tanggal     = $("#tanggal_edit").val();
        var lokasi      = $("#lokasi_edit").val();
        var keterangan  = $("#keterangan_edit").val();

        if (nama == "" || kepala == "" || tanggal == "") {
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
            url: './rapat/api/data/ubah/'+id, 
            dataType: 'json', 
            data: { 
                id: id,
                nama: nama,
                kepala: kepala,
                tanggal: tanggal,
                lokasi: lokasi,
                keterangan: keterangan,
            }, 
            success: function(res) {
                if (res) {
                    $('#ubah').modal('hide');
                    refresh();
                }
                iziToast.success({
                    title: 'Sukses!',
                    message: 'Ubah Berkas Rapat berhasil pada '+res,
                    position: 'topRight'
                });
            }
            });
        }
        $("#submit_edit").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
        $("#submit_edit").prop('disabled', false);
    }

    function download(id) {
        // $("#ubah"+id).prop('disabled', true);
        // $("#ubah"+id).find("i").toggleClass("fa-edit fa-sync fa-spin");
        $('#download').modal('show');
        $.ajax(
        {
            url: "./rapat/api/data/file/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody-file").empty();
                document.getElementById('tgl_upload').innerHTML = res.tgl_upload;
                document.getElementById('download_btn').href = "./rapat/zip/"+res.id;
                content = "";
                res.file.forEach(item => {
                    content += "<tr>";
                    content += "<td>" + item.nama + "</td>";
                    content += "<td>" + item.size + " Mb</td>";
                    content += "</tr>";
                });
                $('#tampil-tbody-file').append(content);
            }
        }
        );
    }

    function hapus(id) {
        Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Ingin menghapus Berkas Rapat ID : '+id,
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
            url: "./rapat/api/data/hapus/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                Swal.fire({
                title: `Berkas Rapat berhasil dihapus!`,
                text: 'Pada '+res,
                icon: `success`,
                showConfirmButton:false,
                showCancelButton:false,
                allowOutsideClick: true,
                allowEscapeKey: false,
                timer: 3000,
                timerProgressBar: true,
                backdrop: `rgba(26,27,41,0.8)`,
                });
                refresh();
            },
            error: function(res) {
                Swal.fire({
                title: `Berkas Rapat gagal di hapus!`,
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
        $("#tambah").one('submit', function() {
            //stop submitting the form to see the disabled button effect
            let x = document.forms["formTambah"]["kepala"].value;
            if (x == "Pilih") {

                Swal.fire({
                    position: 'top',
                    title: 'Perhatian',
                    text: 'Mohon untuk memilih Ketua Rapat',
                    icon: 'warning',
                    showConfirmButton:false,
                    showCancelButton:true,
                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                    timer: 3000,
                    timerProgressBar: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });

                return false;
            } else {
                $("#btn-simpan").attr('disabled','disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

                return true;
            }
        });
    }
</script>
@endsection