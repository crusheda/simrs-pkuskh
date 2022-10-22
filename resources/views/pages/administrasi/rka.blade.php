@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrasi /</span> RKA
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

<div class="card card-action mb-4">
  <div class="d-flex align-items-end row">
    <div class="col-sm-6">
      <div class="card-body">
        <h5 class="card-title text-primary">Rencana Kerja Anggaran</h5>
        <p class="mb-4">Segera <span class="fw-bold">Upload</span> dokumen RKA Anda sebelum 22 Oktober 2022</p>

        <button type="button" class="btn btn-label-primary" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary" value="animate__jackInTheBox">
          <span class="tf-icon bx bx-upload"></span>&nbsp;&nbsp;Upload Berkas
        </button>
      </div>
    </div>
    <div class="col-sm-6 text-center text-sm-left">
      <div class="card-body pb-0 px-0 px-md-4">
        <img src="{{ asset('assets-new/img/illustrations/shopping-girl-light.png') }}" height="140" alt="View Badge User">
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-datatable table-responsive text-nowrap" style="margin-top: -15px">
    <table class="table table-hover table-stripped" id="table">
      <thead>
          <tr>
              <th class="cell-fit">ID</th>
              <th>NAMA</th>
              <th>FILE</th>
              <th>TGL</th>
              <th class="cell-fit"></th>
          </tr>
      </thead>&nbsp;
      <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
    </table>
  </div>
</div>

<div class="modal fade animate__animated animate__jackInTheBox" data-bs-backdrop="static" id="tambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Upload Berkas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="form-auth-small" id="tambah" name="formTambah" action="{{ route('rka.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
            <input type="file" name="file" class="form-control mb-2" accept=".xls,.xlsx,.pdf" required>
            <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berformat XLS/XLSX/PDF
            {{-- <div class="button-wrapper">
              <form action="{{ route('rka.store') }}" method="POST" class="dropzone needsclick" id="dropzone" enctype="multipart/form-data">
                @csrf
                <div class="dz-message needsclick">
                  Drag & Drop file Anda disini
                  <span class="note needsclick">File berformat XLS/XLSX/PDF</span>
                </div>
                <div class="fallback">
                  <input name="file" type="file" />
                </div>
              </form>
            </div> --}}
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-upload nav-icon"></i> Upload</button>
        </form>
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
<br><br><br>
<p id="tampilkan"></p>

<div class="modal fade animate__animated animate__bounceInRight" id="hapus" data-bs-backdrop="static" id="hapus" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-5">Hapus Berkas</h3>
        </div>
        <input type="text" id="tampungHapus" hidden>
        <h6>Apakah sudah yakin ingin menghapus Berkas RKA Anda?</h6>
        <p>File yang sudah anda Upload akan terhapus oleh Sistem. Anda hanya memiliki kesempatan menghapus pada Hari saat Anda mengupload file tersebut.</p>
        <div class="col-12">
          <button type="submit" class="btn btn-danger me-sm-3 me-1" onclick="hapus()"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
        </div>
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

  // DROPZONE
  // var adrop = `<div class="dz-preview dz-file-preview">
  //   <div class="dz-details">
  //     <div class="dz-thumbnail">
  //       <img data-dz-thumbnail>
  //       <span class="dz-nopreview">No preview</span>
  //       <div class="dz-success-mark"></div>
  //       <div class="dz-error-mark"></div>
  //       <div class="dz-error-message"><span data-dz-errormessage></span></div>
  //       <div class="progress">
  //         <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
  //       </div>
  //     </div>
  //     <div class="dz-filename" data-dz-name></div>
  //     <div class="dz-size" data-dz-size></div>
  //   </div>
  //   </div>`;
  // Dropzone.autoDiscover = false;
  // new Dropzone("#dropzone",{
  //   url: "{{ route('rka.store') }}",
  //   success: function(file){
  //     // console.log(file);
  //   },
  //   previewTemplate: adrop,
  //   parallelUploads: 1,
  //   maxFilesize: 5,
  //   addRemoveLinks: !0,
  //   maxFiles: 1,
  //   acceptedFiles: ".xls,.xlsx,.pdf",
  // });

  // var uploadedDocumentMap = {}
  // Dropzone.options.documentDropzone = {
  //     url: '',
  //     maxFilesize: 2, // MB
  //     addRemoveLinks: true,
  //     acceptedFiles: ".jpeg,.jpg,.png,.gif",
  //     headers: {
  //       'X-CSRF-TOKEN': "{{ csrf_token() }}"
  //     },
  //     success: function(file, response) {
  //       $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
  //       uploadedDocumentMap[file.name] = response.name
  //     },
  //     removedfile: function(file) {
  //       file.previewElement.remove()
  //       var name = ''
  //       if (typeof file.file_name !== 'undefined') {
  //           name = file.file_name
  //       } else {
  //           name = uploadedDocumentMap[file.name]
  //       }
  //       $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
  //     }
  // }

  // myDropzone.on("sending", function(file, xhr, formData) {
  //   formData.append("_token", CSRF_TOKEN);
  // }); 
  
  $.ajax(
    {
      url: "/api/rka/table",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        var date = getDateTime();
        var userID = "{{ Auth::user()->id }}";
        var adminID = "{{ Auth::user()->hasRole('administrator') }}";
        var downloader = "{{ Auth::user()->hasRole('it|kabag-perencanaan|kasubag-perencanaan-it') }}";
        res.forEach(item => {
          if(item.unit) {
            try {
              var un = JSON.parse(item.unit);
            } catch(e) {
              var un = item.unit;
            }
          }
          if (un !== null) {
            un = un.toString().replaceAll(',',', ').replaceAll('-',' ');
          } else {
            un = '';
          }
          // console.log(item.foto_profil);
          if(item.foto_profil) {
            try {
              var foto = `<img src="/storage/`+item.foto_profil.substr(7,1000)+`" alt="Avatar" class="rounded-circle">`;
            } catch(e) {
              var foto = `<img src="/img/user.png" alt="Avatar" class="rounded-circle">`;
            }
          } else {
            var foto = `<img src="/img/user.png" alt="Avatar" class="rounded-circle">`;
          }
          if(item.nama) {
            var namamu = item.nama;
          } else {
            var namamu = '';
          }
          var updet = item.updated_at.substring(0, 10);
          content = `<tr id="data`+item.id+`">`;
          content += `<td>`+item.id+`</td>`;
          content += `<td>
                        <div class="d-flex justify-content-start align-items-center">
                          <div class="avatar me-2">`+foto+`</div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-0 text-truncate">`+namamu+`</h6><small class="text-truncate text-muted">`+un+`</small>
                          </div>
                        </div>
                      </td>`;
          content += `<td>`+item.title+`&nbsp;&nbsp;<span class="badge bg-label-dark rounded-pill text-uppercase">`+item.tahun+`</span></td>`;
          content += `<td>`+item.updated_at+`</td>`;
          content += `<td>
                        <div class="d-flex align-items-center">
                          <div class="dropdown"><a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0 btn-icon" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">`;
                            if (downloader) {
                                content += `<a href="./rka/`+item.id+`" class="dropdown-item text-info">Download</a>`;
                                if (item.id_user == userID) {
                                  if (updet == date) {
                                    content += `<a href="javascript:;" onclick="showHapus(`+item.id+`)" class="dropdown-item text-danger">Hapus</a>`;
                                  } else {
                                    content += `<a href="javascript:;" class="dropdown-item disabled">Hapus</a>`;
                                  }
                                } else {
                                  content += `<a href="javascript:;" class="dropdown-item disabled">Hapus</a>`;
                                }
                            } else {
                              if (adminID) {
                                content += `<a href="./rka/`+item.id+`" class="dropdown-item text-info">Download</a>
                                            <a href="javascript:;" onclick="showHapus(`+item.id+`)" class="dropdown-item text-danger">Hapus</a>`;
                              } else {
                                if (item.id_user == userID) {
                                  content += `<a href="./rka/`+item.id+`" class="dropdown-item text-info">Download</a>`;
                                  if (updet == date) {
                                    content += `<a href="javascript:;" onclick="showHapus(`+item.id+`)" class="dropdown-item text-danger">Hapus</a>`;
                                  } else {
                                    content += `<a href="javascript:;" class="dropdown-item disabled">Hapus</a>`;
                                  }
                                } else {
                                  content += `<a href="javascript:;" class="dropdown-item disabled">Download</a>
                                              <a href="javascript:;" class="dropdown-item disabled">Hapus</a>`;
                                }
                              }
                            }
          content +=      `</div>
                          </div>
                        </div>
                      </td></tr>`;
          $('#tampil-tbody').append(content);
        });
        $('#table').DataTable(
          {
            order: [[3, "desc"]],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 10,
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
                    filename: 'Table'
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
                // { targets: 0, orderable: !1,searchable: !1, },
                // { targets: 5, orderable: !1,searchable: !1, },
                // { targets: 6, visible: false },
                // { targets: 9, visible: false },
                // { targets: 10, visible: false },
                // { targets: 11, visible: false },
                // { targets: 12, visible: false },
                // { targets: 16, visible: false },
            ],
          },
        );
        $("div.head-label").html('<h5 class="card-title mb-0">Table</h5>');
      }
    }
  );
  
});

function saveData() {
  $("#tambah").one('submit', function() {
    $("#btn-simpan").attr('disabled','disabled');
    $("#btn-simpan").find("i").toggleClass("fa-upload fa-sync fa-spin");
    return true;
  });
}

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

function showHapus(params) {
  $('#tampungHapus').val(params);
  $('#hapus').modal('show');
}

function hapus() {
  var idHapus = $('#tampungHapus').val();
  $.ajax({
      url: "/api/rka/hapus/"+idHapus,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
          iziToast.success({
            title: 'Sukses!',
            message: 'Hapus Dokumen RKA berhasil pada '+res,
            position: 'topRight'
          });
          window.location.reload();
      },
      error: function(res) {
        iziToast.error({
          title: 'Pesan Galat!',
          message: 'Mohon maaf, Hapus berkas Gagal!',
          position: 'topRight'
        });
      }
  }); 
}
</script>
@endsection