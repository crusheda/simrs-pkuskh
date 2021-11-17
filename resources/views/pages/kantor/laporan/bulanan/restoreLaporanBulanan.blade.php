@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@can('admin-laporan')
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">
            
            <i class="fa-fw fas fa-history nav-icon text-success">

            </i> Riwayat Penghapusan Laporan Bulanan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Rahasia
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
            <sub>Data yang ditampilkan adalah data laporan yang sudah terhapus oleh User. Halaman ini digunakan untuk melihat Laporan Bulanan yang dengan tidak sengaja terhapus oleh Pengguna.</sub>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TERHAPUS</th>
                            <th>JUDUL</th>
                            <th>USER</th>
                            <th>UNIT</th>
                            <th>BLN / THN</th>
                            <th>KETERANGAN</th>
                            {{-- <th><center>AKSI</center></th> --}}
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                </table>
            </div>
        </div>
    </div>
@endcan

<script>
    $(document).ready( function () {
        $.ajax(
            {
                url: "./restore/table/hapus",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.forEach(item => {
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
                                <td>${item.deleted_at}</td>
                                <td>${item.judul}</td>
                                <td>${item.nama}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket}</td>
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
        $("#tampil-tbody").empty().append(`<tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
            {
                url: "./restore/table/hapus",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#table').DataTable().clear().destroy();
                    res.forEach(item => {
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
                                <td>${item.deleted_at}</td>
                                <td>${item.judul}</td>
                                <td>${item.nama}</td>
                                <td>${un}</td>
                                <td>${item.bln} / ${item.thn}</td>
                                <td>${item.ket}</td>
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
    
    function batalHapus(id) {
        Swal.fire({
            title: 'Batalkan Hapus ID : '+id+' ?',
            text: 'Laporan ini akan di restore kembali setelah anda konfirmasi',
            icon: `warning`,
            focusCancel: true,
            showConfirmButton:true,
            confirmButtonText: `<i class="fa fa-thumbs-up"></i> Konfirmasi`,
            confirmButtonColor: '#ADFF2F',
            showCancelButton: true,
            cancelButtonText: `<i class="fa fa-close"></i> Batal`,
            showCloseButton: true,
            backdrop: `rgba(26,27,41,0.8)`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'GET',
                    url: './restore/table/hapus/'+id+'/batal', 
                    dataType: 'json', 
                    data: { 
                        id: id
                    }, 
                    success: function(val) {
                        Swal.fire({
                            title: 'Sukses!',
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
</script>
@endsection