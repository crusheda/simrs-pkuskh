@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@can('laporan')
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">
            
            <i class="fa-fw fas fa-history nav-icon text-success">

            </i> Riwayat Laporan Bulanan Terverifikasi

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <div class="btn-group" role="group">
                            <button class="btn btn-dark text-white" onclick="window.location.href='{{ route('bulan.index') }}'">
                                <i class="fa-fw fas fa-caret-left nav-icon"></i> Kembali
                            </button>
                            <button class="btn btn-warning text-white" onclick="refresh()">
                                <i class="fa-fw fas fa-refresh nav-icon"></i> Refresh
                            </button>
                        </div>
                    </div>
                    <div class="pull-right">

                    </div>
                </div>
            </div>
            <sub>Data yang ditampilkan adalah data laporan yang sudah diverifikasi</sub>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DIUPDATE</th>
                            <th>JUDUL</th>
                            <th>USER</th>
                            <th>UNIT</th>
                            <th>BLN / THN</th>
                            <th>KETERANGAN</th>
                            <th><center>AKSI</center></th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                </table>
            </div>
        </div>
    </div>
@endcan

<script>
    $(document).ready( function () {
        $.ajax(
            {
                url: "./riwayat/table",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.show.forEach(item => {
                        if(item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch(e) {
                                var un = item.unit;
                            }
                        }
                        $("#tampil-tbody").append(`
                            <tr id="data${item.id}">
                                <td>${item.id} ${item.tgl_verif != null ? '<i class="fa-fw fas fa-check nav-icon"></i>' : '' }</td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${item.nama}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-danger text-white btn-sm" onclick="hapusVerif(${item.id})"><i class="fa-fw fas fa-check-square nav-icon"></i></button>
                                            ${item.ket_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="ket('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapus('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            }
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
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
                                'excel', 'pdf','colvis'
                            ],
                            select: {
                                style: 'single'
                            },
                            'columnDefs': [
                                // { targets: 0, visible: false },
                                // { targets: 3, visible: false },
                                // { targets: 6, visible: false },
                                // { targets: 8, visible: false },
                            ],
                            language: {
                                buttons: {
                                    colvis: 'Sembunyikan Kolom',
                                    excel: 'Jadikan Excell',
                                    pdf: 'Jadikan PDF',
                                }
                            },
                            order: [[ 1, "desc" ]],
                            pageLength: 10
                        }
                    ).columns.adjust();
                }
            }
        );
        $("body").addClass('brand-minimized sidebar-minimized');
    } );
</script>
<script>
    // FUNCTION - FUNCTION
    function refresh() {
        $("#tampil-tbody").empty().append(`<tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
            {
                url: "./riwayat/table",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#table').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        if(item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch(e) {
                                var un = item.unit;
                            }
                        }
                        $("#tampil-tbody").append(`
                            <tr id="data${item.id}">
                                <td>${item.id} ${item.tgl_verif != null ? '<i class="fa-fw fas fa-check nav-icon"></i>' : '' }</td>
                                <td>${item.updated_at}</td>
                                <td>${item.judul}</td>
                                <td>${item.nama}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-danger text-white btn-sm" onclick="hapusVerif(${item.id})"><i class="fa-fw fas fa-check-square nav-icon"></i></button>
                                            ${item.ket_verif == null ?
                                                '<button class="btn btn-dark text-white btn-sm" onclick="ket('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            :
                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapus('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                            }
                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
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
                                'excel', 'pdf','colvis'
                            ],
                            select: {
                                style: 'single'
                            },
                            'columnDefs': [
                                // { targets: 0, visible: false },
                                // { targets: 3, visible: false },
                                // { targets: 6, visible: false },
                                // { targets: 8, visible: false },
                            ],
                            language: {
                                buttons: {
                                    colvis: 'Sembunyikan Kolom',
                                    excel: 'Jadikan Excell',
                                    pdf: 'Jadikan PDF',
                                }
                            },
                            order: [[ 1, "desc" ]],
                            pageLength: 10
                        }
                    ).columns.adjust();
                }
            }
        );
    }
    
    function hapusVerif(id) {
        $.ajax({
            method: 'GET',
            url: './api/'+id+'/verified', 
            dataType: 'json', 
            data: { 
                id: id
            }, 
            success: function(res) {
                Swal.fire({
                    title: 'Hapus Verifikasi ID : '+id+' ?',
                    text: 'Laporan ini diverifikasi oleh '+res.nama+' Pada '+res.tgl_verif,
                    icon: `warning`,
                    focusCancel: true,
                    showConfirmButton:true,
                    confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                    confirmButtonColor: '#FF4845',
                    showCancelButton: true,
                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                    showCloseButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: './verif/'+id+'/hapus', 
                            dataType: 'json', 
                            data: { 
                                id: id
                            }, 
                            success: function(val) {
                                Swal.fire({
                                    title: 'Verifikasi berhasil dihapus!',
                                    text: val.text,
                                    icon: val.icon,
                                    showConfirmButton:false,
                                    showCancelButton:false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    backdrop: `rgba(26,27,41,0.8)`,
                                });
                                if (val) {
                                    refresh();
                                }
                            }
                        }); 
                    }
                })
            }
        }); 
    }

    function ket(id) {
        Swal.fire({
            title: 'Keterangan Verifikasi',
            text: 'ID : '+id,
            input: 'textarea',
            reverseButtons: true,
            showDenyButton: false,
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: `<i class="fa fa-send"></i> Kirim`,
            backdrop: `rgba(26,27,41,0.8)`,
            inputValidator: (value) => {
                if (!value) {
                    return 'Pengisian keterangan tidak boleh kosong!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: './api/ket', 
                    dataType: 'json', 
                    data: { 
                        id: id,
                        ket: result.value,
                    }, 
                    success: function(res) {
                        Swal.fire({
                            title: `Keterangan Ditambahkan!`,
                            text: res,
                            icon: `success`,
                            showConfirmButton:false,
                            showCancelButton:false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            timer: 3000,
                            timerProgressBar: true,
                            backdrop: `rgba(26,27,41,0.8)`,
                        });
                        if (res) {
                            refresh();
                        }
                    }
                }); 
            }
        })
    }

    function ketHapus(id) {
        $.ajax({
            method: 'GET',
            url: './api/ket/'+id, 
            dataType: 'json', 
            data: { 
                id: id
            }, 
            success: function(res) {
                Swal.fire({
                    title: 'Keterangan',
                    text: res.ket_verif,
                    focusCancel: true,
                    showConfirmButton:true,
                    confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                    confirmButtonColor: '#FF4845',
                    showCancelButton: true,
                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                    showCloseButton: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'GET',
                            url: './api/ket/'+id+'/hapus', 
                            dataType: 'json', 
                            data: { 
                                id: id
                            }, 
                            success: function(val) {
                                Swal.fire({
                                    title: 'Keterangan berhasil dihapus!',
                                    text: val.text,
                                    icon: val.icon,
                                    showConfirmButton:false,
                                    showCancelButton:false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    backdrop: `rgba(26,27,41,0.8)`,
                                });
                                if (val) {
                                    refresh();
                                }
                            }
                        }); 
                    }
                })
            }
        }); 
    }
</script>
@endsection