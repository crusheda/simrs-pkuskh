@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@can('imut_it')
<div class="card" style="width: 100%">
    <div class="card-header bg-dark text-white">

        <i class="fa-fw fas fa-database nav-icon text-info">

        </i> Hapus Kunjungan Pilar

        <span class="pull-right badge badge-warning" style="margin-top:4px">
            Akses IT
        </span>
        
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-inline pull-left">
                    <div class="form-group mb-2">
                        <label style="margin-top: -20px">No. Rekam Medik :</label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-warning text-white" onclick="hapusTable()"><i class="fa-fw fas fa-eraser nav-icon"></i></button>
                            </div>
                            <input type="number" name="rm" id="rm" max="99999999" class="form-control" placeholder="" autofocus required>
                            <div class="input-group-append">
                                <button class="btn btn-success text-white" id="btnshow" onclick="showRM()"><i class="fa-fw fas fa-search nav-icon"></i> Show</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#readme" data-toggle="tooltip" data-placement="bottom" title="BACA SAYA"><i class="fa-fw fas fa-question nav-icon text-white"></i> Readme</button>
                </div>
            </div>
        </div>
        <hr style="margin-top: -6px">
        <div class="data-table-list">
            <div class="table-responsive">
                <small><kbd>Data Pasien</kbd> yang ditampilkan diurutkan berdasarkan <b>Tanggal Keluar</b> terakhir.</small><br><br>
                <table id="pilar" class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>RM</th>
                            <th>No.Pemeriksaan</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Keluar</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="8">Tidak ada data ditemukan.</td></tr></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endcan

<div class="modal fade bd-example-modal-lg" id="readme" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Baca Saya !
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<script>
    // $(document).ready( function () {
    //     $('#pilar').DataTable();
    // } );

    $("body").addClass('brand-minimized sidebar-minimized');

    // VALIDASI INPUT NUMBER
    $('input[type=number][max]:not([max=""])').on('input', function(ev) {
        var $this = $(this);
        var maxlength = $this.attr('max').length;
        var value = $this.val();
        if (value && value.length >= maxlength) {
        $this.val(value.substr(0, maxlength));
        }
    });

    function showRM() {
        $('#btnshow').prop('disabled', true); 
        var getrm = $("#rm").val();
        if (getrm.length == 4) {
            var rm = '0000'+getrm;
        }
        if (getrm.length == 5) {
            var rm = '000'+getrm;
        } 
        if (getrm.length == 6) {
            var rm = '00'+getrm;
        }
        if (getrm.length < 4) {
            var rm = getrm;
        }
        $("#rm").val(rm);
        $.ajax({
            url: "http://192.168.1.3:8000/api/pilar/"+rm,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                // $("#dateTable").empty();
                res.show.forEach(item => {
                    var e = parseFloat(item.REG_KUNJUNGANPASIEN);
                    $("#tampil-tbody").append(`
                        <tr id="data${item.REG_KUNJUNGANPASIEN}">
                            <td>${item.DAT_PASIEN}</td> 
                            <td>${item.REG_KUNJUNGANPASIEN}</td> 
                            <td>${item.NAMAPASIEN}</td> <td>${item.UMUR}</td> 
                            <td>${item.JNSKELAMIN}</td> <td>${item.TGL_REGISTRASI}</td> 
                            <td>${item.TGL_DISCHARGE ? item.TGL_DISCHARGE : '<span class="badge badge-dark">NULL</span>'}</td> 
                            <td>
                                <button class="btn btn-danger text-white" onclick="batalPeriksa(${e})">
                                    <i class="fa-fw fas fa-trash nav-icon"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
                // for (var i = 0, len = res.length; i < len; i++) {
                //     $("#tampil-tbody").append(`res[i]`);
                // }
                Swal.fire({
                    title: res.title,
                    text: res.msg,
                    icon: res.icon,
                    showConfirmButton:false,
                    showCancelButton:false,
                    timer: 3000,
                    timerProgressBar: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
            }
        }); 
    }

    function batalPeriksa(id) {
        // var num = id;
        var convID = id.toString();
        if (convID.length == 9) {
            var goal = '000'+convID; 
        } else {
            var goal = '00'+convID; 
        }
        var rm_pasien = goal.substr(0,8);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Hapus Kunjungan Pasien Sesuai Kode : '+goal,
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Hapus`,
            denyButtonText: `Batal`,
            backdrop: `rgba(26,27,41,0.8)`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "http://192.168.1.3:8000/api/pilar/batalperiksa/"+goal,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        // $("#antrian").empty();
                        // console.log(res);
                        Swal.fire({
                            title: res.title,
                            text: res.msg,
                            icon: res.icon,
                            showConfirmButton:false,
                            showCancelButton:false,
                            timer: 5000,
                            timerProgressBar: true,
                            backdrop: `rgba(26,27,41,0.8)`,
                        });
                        // location.reload();
                        if (res.icon == 'success') {
                            window.setTimeout(function(){location.reload()},5000);
                        }
                    },
                    // error: function(data){
                    //     Swal.fire({
                    //         title: 'Maaf!!',
                    //         text: 'Data RM tidak ditemukan.',
                    //         icon: 'danger',
                    //         showConfirmButton:false,
                    //         showCancelButton:false,
                    //         timer: 3000,
                    //         timerProgressBar: true,
                    //         backdrop: `rgba(26,27,41,0.8)`,
                    //     });
                    // }
                }); 
            } else if (result.isDenied) {
                Swal.fire({
                    title: 'Ah.. Okay!',
                    text: 'Penghapusan dibatalkan dan tidak ada perubahan.',
                    icon: 'info',
                    showConfirmButton:false,
                    showCancelButton:false,
                    timer: 3000,
                    timerProgressBar: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
            }
        })
        // var getid = $("#hapus"+id).val();
        // alert(getid);
        // console.log(getid);
        // $("#cek").val(getid);
        // var id  = $(e).res("REG_KUNJUNGANPASIEN");
        // var todo  = $("#todo_"+id+" td:nth-child(2)").html();
        // alert(goal);
        // console.log(goal+" - "+convID);
        // $("#cek").val(id);
    }

    function hapusTable() {
        $("#rm").val("").empty();
        $("#tampil-tbody").empty();
        $('#btnshow').prop('disabled', false); 
        $("#tampil-tbody").append(`<tr><td colspan="8">Tidak ada data ditemukan.</td></tr>`);
    }
</script>

@endsection

{{-- 
<input type="text" class="form-control" id="aik" value="" name="aik">
<button onclick="myFunction()">Click me</button>

<p id="demo"></p>

<script>
function myFunction() {
	var data = $("#aik").val();
  	document.getElementById("demo").innerHTML = data;
}
</script> 
--}}

