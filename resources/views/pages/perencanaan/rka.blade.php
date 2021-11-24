@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-puzzle-piece nav-icon text-info">

            </i> Tabel RKA (Rencana Kerja dan Anggaran)

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="pull-left">
                        <div class="btn-group" role="group">
                            <button class="btn btn-primary text-white" onclick="upload()">
                                <i class="fa-fw fas fa-upload nav-icon">
                
                                </i>
                                Upload
                            </button>
                            <button class="btn btn-warning text-white" onclick="refresh()">
                                <i class="fa-fw fas fa-refresh nav-icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped display" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>ROLE</th>
                            <th>FILE</th>
                            <th>TGL</th>
                            <th><center>DOWNLOAD</center></th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- content = "<tr><td>" + element.name + "</td><td>" 
    + element.time + "</td><td>" 
    + element.type + "</td><td>"
    + element.change_in_balance + "</td><td>"
    + element.method + "</td><td>";
if (element.status == 'New Transaction')
content += "<td><button type='button' class='tooltips btn-u btn-u-xs btn-u-purple' data-toggle='tooltip' data-placement='right' title='Your transaction is currently being processed'>Pending</button></td></tr>";
$('#overviewlist tbody').append(content); --}}

<script>
$(document).ready( function () {
    $.ajax(
        {
            url: "./perencanaan/table",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                var date = new Date().toISOString().split('T')[0];
                res.forEach(item => {
                    var updet = item.updated_at.substring(0, 10);
                    var userID = "{{ Auth::user()->id }}";
                    $("#tampil-tbody").append(`
                        <tr id="data${item.id}">
                            <td>${item.id}</td> 
                            <td>${item.nama}</td>  
                            <td>${JSON.parse(item.unit)}</td>  
                            <td>${item.title}</td>  
                            <td>${item.tgl}</td>  
                            <td>
                                <center>
                                    <div class="btn-group" role="group">
                                        @role('it|kabag-perencanaan|kasubag-perencanaan-it')
                                            <a type="button" href="./perencanaan/${item.id}" class="btn btn-success btn-sm"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                            <button type="button" onclick="hapus(${item.id})" class="btn btn-danger btn-sm"><i class="fa-fw fas fa-trash nav-icon text-white"></i></button>
                                        @else
                                            ${updet == date ?
                                                '<a type="button" href="./perencanaan/'+item.id+'" class="btn btn-success btn-sm"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>' : '<button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-download nav-icon text-white"></i></button>'
                                            }
                                        @endrole
                                    </div>
                                </center>
                            </td>
                        </tr>
                    `);
                });
                $('#table').DataTable().columns.adjust();
            }
        }
    );
} );

function upload() {
    Swal.fire({
        title: 'Upload Dokumen RKA',
        text: 'Format dokumen yang direkomendasikan : .doc/.docx/.xls/.xlsx/.pdf/.ppt',
        icon: 'info',
        input: 'file',
        onBeforeOpen: () => {
            $(".swal2-file").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                }
            });
        },
        reverseButtons: true,
        showDenyButton: false,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: `<i class="fa fa-upload"></i> Upload`,
        cancelButtonText: `<i class="fa fa-close"></i> Batal`,
        backdrop: `rgba(26,27,41,0.8)`,
        inputValidator: (value) => {
            if (!value) {
                return 'Pastikan anda sudah memilih File yang akan diupload'
            }
        },
        inputAttributes: {
            'accept': 'application/pdf,application/vnd.ms-powerpoint,application/msword,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'aria-label': 'Upload Dokumen RKA'
        },
    }).then((file) => {
        if (file.value) {
            var formData = new FormData();
            var file = $('.swal2-file')[0].files[0];
            formData.append("fileToUpload", file);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                method: 'post',
                url: "./perencanaan/upload",  
                dataType: 'json', 
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    Swal.fire({
                        title: `Dokumen berhasil di Upload!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        timer: 3000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                    refresh();
                },
                error: function(res) {
                    Swal.fire({
                        title: `Dokumen gagal di Upload!`,
                        text: res,
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
            })
        }
    })
}

function hapus(id) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Untuk menghapus RKA ID : '+id,
        icon: 'warning',
        reverseButtons: false,
        showDenyButton: false,
        showCloseButton: false,
        showCancelButton: true,
        focusCancel: true,
        confirmButtonColor: '#FF4845',
        confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
        cancelButtonText: `<i class="fa fa-close"></i> Close`,
        backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "./perencanaan/hapus/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    Swal.fire({
                        title: `RKA berhasil dihapus!`,
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
                        title: `RKA gagal di hapus!`,
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

function refresh() {
    // var table = $('#myTable').DataTable().destroy();
    $("#tampil-tbody").empty().append(`<tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
    $.ajax(
        {
            url: "./perencanaan/table",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                var date = new Date().toISOString().split('T')[0];
                if(res.length == 0){
                    $("#tampil-tbody").append(`<tr><td colspan="6"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
                } else {
                    res.forEach(item => {
                        var updet = item.updated_at.substring(0, 10);
                        var userID = "{{ Auth::user()->id }}";
                        $("#tampil-tbody").append(`
                            <tr id="data${item.id}">
                                <td>${item.id}</td> 
                                <td>${item.nama}</td>  
                                <td>${JSON.parse(item.unit)}</td>  
                                <td>${item.title}</td>  
                                <td>${item.tgl}</td>  
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            @role('it|kabag-perencanaan|kasubag-perencanaan-it')
                                                <a type="button" href="./perencanaan/${item.id}" class="btn btn-success btn-sm"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                                <button type="button" onclick="hapus(${item.id})" class="btn btn-danger btn-sm"><i class="fa-fw fas fa-trash nav-icon text-white"></i></button>
                                            @else
                                                ${updet == date ?
                                                    '<a type="button" href="./perencanaan/'+item.id+'" class="btn btn-success btn-sm"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>' : '<button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-download nav-icon text-white"></i></button>'
                                                }
                                            @endrole
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        `);
                    });
                }
                $('#table').DataTable().columns.adjust();
            }
        }
    );
}
</script>

@endsection