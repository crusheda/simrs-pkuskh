@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrasi / Laporan /</span> Bulanan
</h4>
  
@if(session('message'))
<div class="alert alert-primary alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
  <p class="mb-0">{{ session('message') }}</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if($errors->count() > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
  <p class="mb-0">
    <ul>
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif


<div class="row">
  <div class="col-lg-10 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Laporan Digital</h5>
            <p class="mb-4">Segera <span class="fw-bold">Upload</span> laporanmu sebelum Tanggal 15 setiap bulannya</p>

            <a href="javascript:;" class="btn btn-primary" value="animate__jackInTheBox" id="btn-tambah" onclick="tambah()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Laporan Bulanan"><i class="fas fa-plus"></i>&nbsp;&nbsp;Form Upload</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{ asset('assets-new/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-2 mb-4 order-1">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="mb-0">Total Upload</h5>
        <small>Semua Unit/Bagian</small><h2></h2>
        <h3 class="text-primary card-title mb-1">{{ $list['count'] }}</h3>
        <small class="text-nowrap fw-semibold">Bulan {{ \Carbon\Carbon::now()->subMonth()->isoFormat('MMMM') }}</small>
      </div>
    </div>
  </div>
</div>

<div class="card card-action mb-4">
  <div class="card-header" style="margin-bottom: -20px">
    <div class="card-action-title">
      <div class="btn-group">
        <button class="btn btn-label-primary" id="btn-verif" onclick="verif()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Menampilkan Semua Data Laporan Bulanan Bawahan">
          <i class="fas fa-history"></i>&nbsp;
          <span class="align-middle">Laporan Bawahan</span>
        </button>
        {{-- <button class="btn btn-label-warning" data-bs-target="#info" data-bs-toggle="modal">
          <i class="fas fa-info"></i>
        </button> --}}
      </div>
    </div>
    <div class="card-action-element">
      <ul class="list-inline mb-0">
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
        </li>
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="collapse show">
    <div class="card-datatable table-responsive text-nowrap">
      <table id="table" class="table table-striped" style="width:100%">
          <thead>
              <tr>
                  <th class="cell-fit"><center>STATUS</center></th>
                  <th>DIUPDATE</th>
                  <th>JUDUL</th>
                  <th>BLN / THN</th>
                  <th>KETERANGAN</th>
                  <th class="cell-fit"><center>#</center></th>
              </tr>
          </thead>
          <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
          <tfoot>
            <th class="cell-fit"><center>STATUS</center></th>
            <th>DIUPDATE</th>
            <th>JUDUL</th>
            <th>BLN / THN</th>
            <th>KETERANGAN</th>
            <th class="cell-fit"><center>#</center></th>
          </tfoot>
      </table>
    </div>
  </div>
</div>

{{-- MODAL --}}
{{-- TAMBAH --}}
<div class="modal fade animate__animated animate__jackInTheBox" id="tambah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          Tambah Laporan Bulanan
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
          <form class="form-auth-small" name="formTambah" action="{{ route('bulanan.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <i class="fa-fw fas fa-info-circle nav-icon"></i> Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong>Hari saat Anda mengupload saja</strong><hr>
              <div class="row">
                  <div class="col-md-4">
                    <div class="form-group mb-3">
                      <label>Bulan</label>
                      <select class="select2 form-select" name="bln" id="bln-tambah" required>
                          <option value="">Bulan</option>
                          <?php
                              $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                              $jml_bln=count($bulan);
                              for($c=1 ; $c < $jml_bln ; $c+=1){
                                  echo"<option value=$c> $bulan[$c] </option>";
                              }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group mb-3">
                      <label>Tahun</label>
                      <select class="select2 form-select" name="thn" id="thn-tambah" required>
                          <option value="">Tahun</option>
                          @php
                            for ($i=2018; $i <= $list['thn']; $i++) { 
                              echo"<option value=$i> $i </option>";
                            }
                          @endphp
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group mb-3">
                      <label>Judul</label>
                      <input type="text" name="judul" class="form-control" placeholder="Laporan Bulanan Unit X" required>
                    </div>
                  </div>
              </div>
              <div class="form-group mb-3">
                <label>Keterangan</label>
                <textarea rows="3" class="form-control" id="ket" placeholder="Optional"></textarea>
              </div>
              <div class="form-group mb-3">
                <label>Dokumen</label>
                {{-- <input type="file" name="file" class="form-control mb-2" accept="application/pdf" required> --}}
                <input type="file" name="file" class="form-control mb-2" required>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen<br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>20 mb</strong>
              </div>
      </div>
      <div class="modal-footer">
              <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
          </form>

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
{{-- UBAH --}}
<div class="modal fade animate__animated animate__jackInTheBox" id="ubah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          Ubah Laporan Bulanan&nbsp;<kbd><a id="show_edit"></a></kbd>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="id_edit" class="form-control" hidden>
    
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label>Bulan</label>
                    <select class="select2 form-control" id="bln_edit" required></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    <label>Tahun</label>
                    <select class="select2 form-control" id="thn_edit" required></select>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label>Judul</label>
                <input type="text" id="judul_edit" class="form-control" placeholder="Laporan Bulanan Unit X" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label>Keterangan</label>
                <textarea rows="3" class="form-control" id="ket_edit" placeholder="Optional"></textarea>
              </div>
            </div>
            <div class="col-md-12">
                Dokumen Upload
                <div id="file_edit"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-simpan-edit" onclick="ubah()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade animate__animated animate__bounceInRight" id="info" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Informasi</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <h5 class="mb-0">Cara Setting PDF Viewer pada browser Google Chrome</h5>
        <sub>Terdapat 2 cara untuk melihat laporan bulanan PDF tanpa mendownload. Apabila anda menggunakan browser Firefox, silakan abaikan semua langkah di bawah.</sub>
        <div class="divider text-end">
          <div class="divider-text">Plugin PDF Viewer</div>
        </div>
        <p>
          <h6>1. Instal plugin untuk Google Chrome dengan membuka Link <a target="_blank" href="https://chrome.google.com/webstore/detail/pdf-viewer/oemmndcbldboiebfnladdacbdfmadadm?hl=in"><u>Disini</u></a></h6>
          <h6>2. Klik <strong>Tambahkan ke Chrome</strong></h6>
          <img src="{{ asset('img/pdf-viewer/1.jpg') }}" class="img-fluid" alt="">
          <h6>3. Klik <strong>Add extension</strong></h6>
          <img src="{{ asset('img/pdf-viewer/2.jpg') }}" class="img-fluid" alt="">
        </p>
        <div class="divider text-end">
          <div class="divider-text">Mode Incognito (Private Browser)</div>
        </div>
        <p>
          <h6>1. Masuk ke Menu Chrome dengan cara klik tombol Titik Tiga di Pojok Kanan Atas</h6>
          <img src="{{ asset('img/pdf-viewer/3.jpg') }}" class="img-fluid mb-3" alt="">
          <h6>2. Klik tombol <strong>New Incognito Window</strong> atau dengan menekan kombinasi tombol <strong>Ctrl+Shift+N</strong></h6>
          <h6>3. Masuk/Login <strong>Simrsmu</strong> kembali pada Mode Incognito tersebut dan anda sudah bisa melihat dokumen Laporan Bulanan tanpa harus mendownloadnya terlebih dahulu</h6>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
<script>$(document).ready( function () {
  // $("html").addClass('layout-menu-collapsed');
  // SELECT2
  var t = $(".select2");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  })
  
  $.ajax(
    {
      url: "/api/laporan/bulanan/table/user",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        var date = getDateTime();
        res.show.forEach(item => {
            var updet = item.updated_at.substring(0, 10);
            content = `<tr id="data`+item.id+`"><td>`;
                    if(item.tgl_verif != null) {
                      content += `<center><i class="fa-fw fas fa-check nav-icon text-primary"></i></center>`;
                    }
            content += `</td><td>`+item.updated_at+`</td>
                        <td>`+item.judul+`</td>
                        <td>`+item.bln+` / `+item.thn+`</td><td>`;
                        if (item.ket != null) {
                          content += item.ket;
                        }
            content += `</td><td><center>
                        <div class='btn-group'>
                          <button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button>
                          <ul class='dropdown-menu dropdown-menu-end'>
                            <li><a href='javascript:void(0);' class='dropdown-item text-success' onclick="window.location.href='{{ url('v2/laporan/bulanan/`+item.id+`') }}'"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>`;
                            if(item.ket_verif != null) {
                              content += `<li><a href="javascript:void(0); class='dropdown-item text-info' onclick="ketLihat(`+item.id+`)"><i class="fa-fw fas fa-sticky-note nav-icon"></i> Keterangan</a></li>`;
                            } else {
                              content += `<li><a href="javascript:void(0);" class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-sticky-note nav-icon"></i> Keterangan</a></li>`;
                            }
                            if(updet == date) {
                              content += `<li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                          <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            } else {
                              content += `<li><a href="javascript:void(0);" class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                          <li><a href='javascript:void(0);' class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            }
            content += `</ul></div></center></td></tr>`;
            $('#tampil-tbody').append(content);
        });
        $('#table').DataTable(
          {
            order: [[1, "desc"]],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [{
                extend: "collection",
                className: "btn btn-label-primary dropdown-toggle me-2",
                text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                buttons: [{
                    extend: "print",
                    text: '<i class="bx bx-printer me-2" ></i>Print',
                    className: "dropdown-item",
                    // exportOptions: {
                    //     columns: [3, 4, 5, 6, 7]
                    // }
                }, {
                    extend: "excel",
                    text: '<i class="bx bxs-spreadsheet me-2"></i>Excel',
                    className: "dropdown-item",
                    autoFilter: true,
                    attr: {id: 'exportButton'},
                    sheetName: 'data',
                    title: '',
                    filename: 'Laporan Bulanan'
                }, {
                    extend: "pdf",
                    text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                    className: "dropdown-item",
                }, {
                    extend: "copy",
                    text: '<i class="bx bx-copy me-2" ></i>Copy',
                    className: "dropdown-item",
                    // exportOptions: {
                    //     columns: [3, 4, 5, 6, 7]
                    // }
                },]
              }, 
              {
                extend: 'colvis',
                text: '<i class="bx bx-hide me-sm-2"></i> <span class="d-none d-sm-inline-block">Column</span>',
                className: "btn btn-label-primary modal me-2",
                // collectionLayout: 'dropdown-menu',
                // contentClassName: 'dropdown-item'
              }
            ],
            columnDefs: [
                { targets: 0, orderable: !1,searchable: !1, },
                { targets: 5, orderable: !1,searchable: !1, },
                // { targets: 6, visible: false },
                // { targets: 9, visible: false },
                // { targets: 10, visible: false },
                // { targets: 11, visible: false },
                // { targets: 12, visible: false },
                // { targets: 16, visible: false },
            ],
          },
        );
        $("div.head-label").html('<h5 class="card-title mb-0">Daftar Laporan Anda</h5>');
      }
    }
  );
  
});

// FUNCTION
function getDateTime() {
  var now     = new Date(); 
  var year    = now.getFullYear();
  var month   = now.getMonth()+1; 
  var day     = now.getDate();
  if(month.toString().length == 1) {
        month = '0'+month;
  }
  if(day.toString().length == 1) {
        day = '0'+day;
  } 
  var dateTime = year+'-'+month+'-'+day;   
    return dateTime;
}

function tambah() {
  $("#btn-tambah").prop('disabled', true);
  $("#btn-tambah").find("i").toggleClass("fa-plus fa-sync fa-spin");
  $.ajax(
    {
      url: "/api/laporan/bulanan/formupload",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        if (res === 1) {
          $('#tambah').modal('show');
        } else {
          iziToast.error({
            title: 'Pesan Galat!',
            message: 'Mohon maaf, Anda tidak mempunyai HAK untuk menambah Laporan Bulanan',
            position: 'topRight'
          });
        }
        $("#btn-tambah").prop('disabled', false);
        $("#btn-tambah").find("i").removeClass("fa-sync fa-spin").addClass("fa-plus");
      },
      error: function(res) {
      }
    }
  );
}

function verif() {
  $("#btn-verif").prop('disabled', true);
  $("#btn-verif").find("i").toggleClass("fa-history fa-sync fa-spin");
  $.ajax(
    {
      url: "/api/laporan/bulanan/formverif",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        if (res === 1) {
          window.location.href = "./bulanan/verif";
        } else {
          iziToast.error({
            title: 'Pesan Galat!',
            message: 'Mohon maaf, Anda tidak mempunyai HAK untuk menambah Laporan Bulanan',
            position: 'topRight'
          });
        }
        $("#btn-verif").prop('disabled', false);
        $("#btn-verif").find("i").removeClass("fa-sync fa-spin").addClass("fa-history");
      },
      error: function(res) {
      }
    }
  );
}

function saveData() {
  $("#tambah").one('submit', function() {
    $("#btn-simpan").attr('disabled','disabled');
    $("#btn-simpan").find("i").toggleClass("fa-save fa-spinner fa-spin");
    return true;
  });
}

function showUbah(id) {
  $('#ubah').modal('show');
  $.ajax(
    {
      url: "/api/laporan/bulanan/getubah/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        // var tgl = res.tgl + 'T' + res.waktu;
        document.getElementById('show_edit').innerHTML = "ID : "+res.show.id;
        $("#id_edit").val(res.show.id);
        $("#judul_edit").val(res.show.judul);
        $("#ket_edit").val(res.show.ket);
        $("#bln_edit").find('option').remove();
        $("#thn_edit").find('option').remove();
        for(c=1 ; c < res.jml_bulan ; c++){
            $("#bln_edit").append(`
                <option value="${c}" ${c == res.show.bln? "selected":""}>`+res.bulan[c]+`</option>
            `);
        }
        for (i=2018; i <= res.tahun; i++) { 
            $("#thn_edit").append(`
                <option value="${i}" ${i == res.show.thn? "selected":""}>${i}</option>
            `);
        }
        $("#file_edit").empty();
        $("#file_edit").append(`
            <b><u><a href="./bulanan/${res.show.id}">${res.show.title}</a></u>&nbsp(${res.sizeFile} Mb)</b>
        `);
        // document.getElementById('tgl_edit').innerHTML = res.sizeFile;
      }
    }
  );
}

function ubah() {
  $("#btn-simpan-edit").attr('disabled','disabled');
  $("#btn-simpan-edit").find("i").toggleClass("fa-save fa-spinner fa-spin");
  
  var id          = $("#id_edit").val();
  var judul       = $("#judul_edit").val();
  var ket         = $("#ket_edit").val();
  var bln         = $("#bln_edit").val();
  var thn         = $("#thn_edit").val();
  
  $.ajax({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  method: 'POST',
  url: '/api/laporan/bulanan/ubah/'+id, 
  dataType: 'json', 
  data: { 
      id: id,
      judul: judul,
      ket: ket,
      bln: bln,
      thn: thn,
    }, 
    success: function(res) {
      $('#ubah').modal('hide');
      fresh();
      window.location.reload();
    }
  });
}

function hapus(id) {
    Swal.fire({
    title: 'Apakah anda yakin?',
    text: 'Hapus Laporan Bulanan ID : '+id,
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
        url: "/api/laporan/bulanan/hapus/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          iziToast.success({
            title: 'Sukses!',
            message: 'Hapus Dokumen Laporan Bulanan berhasil pada '+res,
            position: 'topRight'
          });
          fresh();
          window.location.reload();
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