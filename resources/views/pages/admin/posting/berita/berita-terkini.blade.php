@extends('layouts.admin.layout1')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Berita Terkini</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Posting</li>
                            <li class="breadcrumb-item">Artikel</li>
                            <li class="breadcrumb-item active">Berita Terkini</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="hstack gap-3">
                            <button type="button" class="btn btn-primary" onclick="window.location='{{ route('admin.berita.create') }}'"><i class="mdi mdi-plus-thick"></i> Tambah</button>
                            <div class="vr"></div>
                            <div class="btn-group">
                                <button type="reset" class="btn btn-info" disabled><i class="mdi mdi-information-outline"></i> Informasi</button>
                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Tgl</th>
                                <th>Nama</th>
                                <th>Diperbarui</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>

<script>
    $(document).ready( function () {
        $.ajax(
            {
                url: "./berita/api/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.show.forEach(item => {
                        $("#tampil-tbody").append(`
                            <tr id="data${item.id}">
                                <td><kbd>${item.id}</kbd></td>
                                <td>${item.judul}</td>
                                <td>${item.tgl}</td>
                                <td>${item.nama}</td>
                                <td>${item.updated_at}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-success btn-sm text-white" onclick="showLampiran(${item.id})"><i class="fa-fw fas fa-image nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="window.location='{{ url('admin/posting/berita/${item.id}/edit') }}'"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus(${item.id})"><i class="fa-fw fas fa-trash nav-icon"></i></button>                                        
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                    $('#table').DataTable(
                        {
                            paging: true,
                            searching: true,
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    className: 'btn-light',
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
                            order: [[ 4, "desc" ]],
                            pageLength: 10
                        }
                    ).columns.adjust();
                }
            }
        );
    });
</script>

<script>
    function refresh() {
        $("#tampil-tbody").empty().append(`<tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
            {
                url: "./berita/api/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    if(res.show.length == 0){
                        $("#tampil-tbody").append(`<tr><td colspan="6"><center>No data available in table</center></td></tr>`);
                    } else {
                        res.show.forEach(item => {
                            $("#tampil-tbody").append(`
                                <tr id="data${item.id}">
                                    <td><kbd>${item.id}</kbd></td>
                                    <td>${item.judul}</td>
                                    <td>${item.tgl}</td>
                                    <td>${item.nama}</td>
                                    <td>${item.updated_at}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-success btn-sm text-white" onclick="showLampiran(${item.id})"><i class="fa-fw fas fa-image nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus(${item.id})"><i class="fa-fw fas fa-trash nav-icon"></i></button>                                        
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                }
            }
        );
    }
    function showLampiran(id) {
        Swal.fire({
            title: 'Thumbnail ID : '+id,
            // text: '',
            imageUrl: './berita/'+id,
            imageWidth: 400,
            // imageHeight: 200,
            imageAlt: 'Thumbnail',
            reverseButtons: true,
            showDenyButton: false,
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: `<i class="fa fa-times"></i> Tutup`,
            confirmButtonText: `<i class="fa fa-download"></i> Download`,
            backdrop: `rgba(26,27,41,0.8)`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "./berita/"+id;
            }
        })
    }
    function hapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Hapus Artikel ID : '+id,
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
                url: "./berita/api/data/hapus/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Aksi Hapus berhasil pada '+res,
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