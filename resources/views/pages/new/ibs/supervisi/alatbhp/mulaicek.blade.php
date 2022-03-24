@extends('layouts.newAdmin')

@section('content')
@hasanyrole('ibs|karu-ibs|spv')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Supervisi</h4>
        </div>
        <div class="card-body">
            <div class="btn-group" role="group">
                <button class="btn btn-dark text-white pull-left" onclick="window.location.href='{{ route('ibs.supervisi.index') }}'"><i class="fa-fw fas fa-chevron-left nav-icon"></i></button>
                <button class="btn btn-primary text-white pull-left" data-toggle="modal" data-target="#lihatTim">
                    <i class="fa-fw fas fa-user-friends nav-icon">

                    </i>
                    Lihat Tim
                </button>
            @if (Carbon\Carbon::parse($list['cekdata']->tgl_mulai)->isoFormat('YYYY-MM-DD') == Carbon\Carbon::now()->isoFormat('YYYY-MM-DD'))
                <button class="btn btn-danger text-white pull-right" onclick="batalCek()">
                    <i class="fa-fw fas fa-trash nav-icon">

                    </i>
                    Batal Cek
                </button>
            @else
                @role('karu-ibs')
                    <button class="btn btn-danger text-white pull-right" onclick="batalCek()">
                        <i class="fa-fw fas fa-trash nav-icon">

                        </i>
                        Batal Cek
                    </button>
                @else
                    <button class="btn btn-danger text-white pull-right" disabled><i class="fa-fw fas fa-trash nav-icon"></i> Batal Cek</button>
                @endrole
              </div>
            @endif
            <hr>
            <h5 class="text-center">DAFTAR CEK LIST RUTIN PENGECEKAN FUNGSI DAN KELENGKAPAN BHP<br>INSTALASI BEDAH SENTRAL<br>2021</h5><hr>
            <div class="data-table-list">
                <div class="table-responsive">
                    <table id="pilar" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th><center>#</center></th>
                                <th>Pengecekan Alat Dan Kelengkapan BHP</th>
                                <th>Ruang</th>
                                <th>Kondisi</th>
                                <th>Keterangan</th>
                                <th>Lampiran</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke">
          <a type="button" class="btn btn-success text-white" onclick="selesai()" data-toggle="tooltip" data-placement="bottom" title="PENGECEKAN SELESAI"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</a>&nbsp;
          <sub>Anda login sebagai <kbd>{{ Auth::user()->nama }}</kbd></sub>
          {{-- href="{{ route('ibs.supervisi.selesai', $list['tim']) }}" --}}
        </div>
    </div>
  </div>
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endcan

<div class="modal fade bd-example-modal-lg" id="lihatTim" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tim Pengecekan <kbd>ID : {{ $list['tim'] }}</kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <h6>Shift : <kbd>{{ $list['shift'] }}</kbd></h6>
            <h6>Tgl Mulai Cek : <kbd>{{ $list['showtim'][0]->tgl_mulai }}</kbd></h6>
            <div class="table-responsive">
                <table class="table table-striped display table-hover">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>Akun</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['showtim']) > 0)
                        @foreach($list['showtim'] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nama }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>

<script>
$(document).ready( function () {
    setInterval(function () {
        $.ajax(
            {
                url: "./api/{{ $list['tim'] }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.show.forEach(item => {
                        $("#tampil-tbody").append(`
                            <tr id="data${item.id}">
                                <td>
                                    <center><div class="btn-group" role="group">
                                        <button class="btn btn-dark text-white btn-sm" onclick="lampiran(${item.id})">
                                            <i class="fa-fw fas fa-camera nav-icon"></i>
                                        </button>
                                        <button class="btn btn-warning text-white btn-sm" onclick="ket(${item.id})">
                                            <i class="fa-fw fas fa-edit nav-icon"></i> Ket
                                        </button>
                                        <button class="btn btn-info text-white btn-sm" onclick="kondisi(${item.id})">
                                            <i class="fa-fw fas fa-check nav-icon"></i> Kondisi
                                        </button>
                                    </div></center>
                                </td>
                                <td>${item.nama_supervisi}</td> 
                                <td>${item.nama_ruang}</td> 
                                <td>${item.kondisi == true ? '<span class="badge badge-success">Baik</span>' : ''}${item.kondisi == false ? '<span class="badge badge-danger">Rusak</span>' : ''}</td> 
                                <td>${item.ket? item.ket : ''}</td>
                                <td>${item.title != null ? '<button type="button" class="btn btn-primary btn-sm" onclick="showLampiran('+item.id+')">'+item.title+'</button>':''}</td>
                            </tr>
                        `);
                    });
                }
            }
        );
    },1000);
} );

function kondisi(id) {
    Swal.fire({
        title: 'Bagaimana Kondisinya?',
        text: 'Supervisi ID : '+id,
        icon: 'info',
        reverseButtons: true,
        focusConfirm: true,
        showDenyButton: true,
        showCloseButton: true,
        showCancelButton: false,
        confirmButtonText: `<i class="fa fa-thumbs-up"></i> Baik`,
        denyButtonText: `<i class="fa fa-thumbs-down"></i> Rusak`,
        backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: "./api/kondisi", 
                dataType: 'json', 
                data: { 
                    id: id,
                    kondisi: 1,
                }, 
                success: function(res) {
                    Swal.fire({
                        title: `Supervisi diperbarui!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                },
                failure: function(res) {
                    Swal.fire({
                        title: `Supervisi gagal diperbarui!`,
                        text: res,
                        icon: `error`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                }
            }); 
        } else if (result.isDenied) {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: "./api/kondisi", 
                dataType: 'json', 
                data: { 
                    id: id,
                    kondisi: 0,
                }, 
                success: function(res) {
                    Swal.fire({
                        title: `Supervisi diperbarui!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                },
                failure: function(res) {
                    Swal.fire({
                        title: `Supervisi gagal diperbarui!`,
                        text: res,
                        icon: `error`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                }
            }); 
        }
    })
}

function lampiran(id) {
    Swal.fire({
        title: 'Tambah Lampiran',
        text: 'Supervisi ID : '+id,
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
        confirmButtonText: `<i class="fa fa-save"></i> Simpan`,
        backdrop: `rgba(26,27,41,0.8)`,
        inputValidator: (value) => {
            if (!value) {
                return 'Upload Foto lampiran anda terlebih dahulu!'
            }
        },
        inputAttributes: {
            'accept': 'image/*',
            'aria-label': 'Upload Foto lampiran'
        },
    }).then((file) => {
        if (file.value) {
            var formData = new FormData();
            var file = $('.swal2-file')[0].files[0];
            formData.append("fileToUpload", file);
            formData.append("id", id);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                method: 'post',
                url: "./api/lampiran",  
                dataType: 'json', 
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    Swal.fire({
                        title: `Lampiran berhasil di Upload!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                },
                error: function() {
                    Swal.fire({
                        title: `Lampiran gagal di Upload!`,
                        text: res,
                        icon: `error`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                }
            })
        }
    })
}

function showLampiran(id) {
    Swal.fire({
        title: 'Lampiran Supervisi '+id,
        text: 'Refresh halaman ini untuk mengupdate lampiran',
        imageUrl: './'+id,
        imageWidth: 400,
        // imageHeight: 200,
        imageAlt: 'Lampiran',
        reverseButtons: true,
        showDenyButton: false,
        showCloseButton: true,
        showCancelButton: false,
        confirmButtonText: `<i class="fa fa-download"></i> Download`,
        backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "./"+id;
        }
    })
}

function ket(id) {
    Swal.fire({
        title: 'Tambah Keterangan',
        text: 'Supervisi ID : '+id,
        input: 'textarea',
        reverseButtons: true,
        showDenyButton: false,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: `<i class="fa fa-save"></i> Simpan`,
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
                url: "./api/kondisi/ket", 
                dataType: 'json', 
                data: { 
                    id: id,
                    ket: result.value,
                }, 
                success: function(res) {
                    Swal.fire({
                        title: `Supervisi diperbarui!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                },
                failure: function(res) {
                    Swal.fire({
                        title: `Supervisi gagal diperbarui!`,
                        text: res,
                        icon: `error`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                }
            }); 
        }
    })
}

function selesai() {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Untuk menyelesaikan pengecekan rutin alat dan kelengkapan BHP',
        icon: 'question',
        reverseButtons: true,
        showDenyButton: false,
        showCloseButton: false,
        showCancelButton: true,
        confirmButtonText: `<i class="fa fa-check"></i> Selesai`,
        cancelButtonText: `<i class="fa fa-close"></i> Batal`,
        backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "./api/{{ $list['tim'] }}/selesai",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    Swal.fire({
                        title: `Supervisi diselesaikan!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                    if (res) {
                        window.setTimeout(function(){location.href = "./"},2000);
                    }
                },
                failure: function(res) {
                    Swal.fire({
                        title: `Supervisi gagal diselesaikan!`,
                        text: res,
                        icon: `error`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                }
            }); 
        }
    })
}

function batalCek() {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Untuk membatalkan pengecekan rutin alat dan kelengkapan BHP',
        icon: 'warning',
        reverseButtons: true,
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
                url: "./api/{{ $list['tim'] }}/batal",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    Swal.fire({
                        title: `Supervisi dibatalkan!`,
                        text: res,
                        icon: `success`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000,
                        timerProgressBar: true,
                        backdrop: `rgba(26,27,41,0.8)`,
                    });
                    if (res) {
                        window.setTimeout(function(){location.href = "./"},2000);
                    }
                },
                failure: function(res) {
                    Swal.fire({
                        title: `Supervisi gagal dibatalkan!`,
                        text: res,
                        icon: `error`,
                        showConfirmButton:false,
                        showCancelButton:false,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        timer: 2000,
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