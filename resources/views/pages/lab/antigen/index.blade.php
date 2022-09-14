@extends('layouts.simrsmuv2')

@section('content')

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Lab /</span> Antigen
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

@can('antigen')

<div class="card card-action mb-4">
  <div class="card-header">
    <div class="card-action-title">
      <div class="btn-group">
        <button type="button" class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-plus bx-xs' ></i> <span>Tambah Data Antigen</span>">
          <i class="bx bx-plus scaleX-n1-rtl"></i>
          <span class="align-middle">Tambah</span>
        </button>
        <button type="button" class="btn btn-label-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon"></i></button>
        <button type="button" class="btn btn-label-info" onclick="window.location.href='{{ route('antigen.filter') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-filter bx-xs' ></i> <span>Filter Data Antigen</span>">
          <i class="bx bx-filter scaleX-n1-rtl"></i>
          <span class="align-middle">Filter</span>
        </button>
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
      <table id="table" class="dt-column-search table table-striped">
        <thead>
          <tr>
            <th>RM</th>
            <th>DOKTER PENGIRIM</th>
            <th>PASIEN</th>
            <th>JK/UMUR</th>
            <th>ALAMAT</th>
            <th>TGL</th>
            <th><center>AKSI</center></th>
          </tr>
        </thead>
        <tbody id="tampil-tbody"><tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
        <tfoot>
            <tr>
                <th>RM</th>
                <th>DOKTER PENGIRIM</th>
                <th>PASIEN</th>
                <th>JK/UMUR</th>
                <th>ALAMAT</th>
                <th>TGL</th>
                <th><center>AKSI</center></th>
            </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

{{-- MODAL START --}}
<div class="modal fade" id="tambah" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="form-auth-small" action="{{ route('antigen.store') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group mb-4">
                        <label>RM :</label>
                        <input type="number" name="rm" id="rm" max="99999999" class="form-control" placeholder="Rekam Medik PX" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group mb-4">
                        <label>Pemeriksa :</label>
                        <input type="text" name="pemeriksa" id="pemeriksa" class="form-control" placeholder="Optional">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-4">
                        <label>Tgl :</label>
                        <input type="text" class="form-control" name="tgl" value="<?php echo strftime('%Y-%m-%dT%H:%i', strtotime($list['now'])); ?>" placeholder="Tgl Antigen" id="tgl_add" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group mb-4">
                        <label>Dokter Pengirim :</label>
                        <select class="form-control select2" name="dr_pengirim" id="dr_pengirim" style="width: 100%" required>
                            <option value="">Pilih</option>
                                @foreach($list['dokter'] as $key => $item)
                                    <option value="{{ $item->id }}"><label><b>{{ $item->jabatan }}</b></label> - {{ $item->nama }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-4">
                        <label>Hasil :</label>
                        <select class="form-control select2" name="hasil" id="hasil" style="width: 100%" required>
                            <option value="">Pilih</option>
                            <option value="POSITIF">POSITIF</option>
                            <option value="NEGATIF">NEGATIF</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label>Nama :</label>
                        <input type="text" name="nama" id="nama1" class="form-control" placeholder="" hidden>
                        <input type="text" id="nama2" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-4">
                        <label>Jenis Kelamin :</label>
                        <input type="text" name="jns_kelamin" id="jns_kelamin1" class="form-control" hidden>
                        <input type="text" id="jns_kelamin2" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-4">
                        <label>Umur :</label>
                        <input type="text" name="umur" id="umur1" class="form-control" hidden>
                        <input type="text" id="umur2" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label>Alamat :</label>
                        <input type="text" name="des" id="des" class="form-control" hidden>
                        <input type="text" name="kec" id="kec" class="form-control" hidden>
                        <input type="text" name="kab" id="kab" class="form-control" hidden>
                        <textarea class="form-control" name="alamat" id="alamat1" placeholder="" maxlength="190" rows="8" hidden></textarea>
                        <textarea class="form-control" style="min-height: 100px" id="alamat2" placeholder="" maxlength="190" rows="5" disabled></textarea>
                    </div>
                </div>
            </div>
            <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan <kbd>Nomor RM</kbd> sesuai dengan Database Pilar.</a>
      </div>
      <div class="modal-footer">
        <a class="btn btn-label-secondary" href="javascript:void(0);" data-bs-dismiss="modal"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="ubah" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data <small><kbd>ID : <a id="show_id"></a></kbd></small></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="id_edit" hidden>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group mb-4">
                    <label>RM :</label>
                    <input type="number" id="rm_edit" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group mb-4">
                    <label>Pemeriksa :</label>
                    <input type="text" id="pemeriksa_edit" class="form-control" placeholder="Optional">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <label>Tgl :</label>
                    <input type="text" class="form-control" name="tgl" value="" placeholder="Tgl Antigen" id="tgl_edit" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group mb-4">
                    <label>Dokter Pengirim :</label>
                    <select class="form-control select2" style="width: 100%" id="dr_pengirim_edit" required></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-4">
                    <label>Hasil :</label>
                    <select class="form-control select2" id="hasil_edit" style="width: 100%" required></select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label>Nama :</label>
                    <input type="text" class="form-control" id="nama_edit" disabled>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-4">
                    <label>Jenis Kelamin :</label>
                    <input type="text" class="form-control" id="jns_kelamin_edit" disabled>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-4">
                    <label>Umur :</label>
                    <input type="text" class="form-control" id="umur_edit" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label>Alamat :</label>
                    <textarea class="form-control" id="alamat_edit" disabled></textarea>
                </div>
            </div>
        </div>
        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Jika terdapat kesalahan pada penulisan <kbd>Nomor RM</kbd> , silakan Hapus data dan Input ulang kembali</a>
      </div>
      <div class="modal-footer">
        <a class="btn btn-label-secondary" href="javascript:void(0);" data-bs-dismiss="modal"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
        <button class="btn btn-primary" type="submit" id="submit_edit" onclick="ubah()"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
      </div>
    </div>
  </div>
</div>
{{-- MODAL END --}}
  
@endcan

<script>$(document).ready( function () {
  $("html").addClass('layout-menu-collapsed');

  // TGL ADD
  const l = document.querySelector("#tgl_add");
  const c = new Date(Date.now() - 1728e5)
      , m = new Date(Date.now());
  var today = moment().locale('id').format('Y-MM-DD HH:mm');
  console.log(today);
  l.flatpickr({
      enableTime: !0,
      defaultDate: today,
      minuteIncrement: 1,
      // inline: true,
      // defaultHour: 12,
      // defaultMinute: "today",
      time_24hr: true,
      // dateFormat: "Y-m-d H:m",
      disable: [{
        from: "2000-01-01",
        to: c.toISOString().split("T")[0]
      }]
  })

  // SELECT PICKER
  var t = $(".select2");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  })

  // AJAX TABLE GET
    $.ajax(
        {
            url: "/api/antigen/get",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                // var date = new Date().toISOString().split('T')[0];
                if(res.show.length == 0){
                    $("#tampil-tbody").append(`<tr><td colspan="7"><center><i class="fas fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
                } else {
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = "<tr id='data"+ item.id +"'><td>"; 
                                    if (item.hasil == "POSITIF")
                                        content += "<kbd style='background-color: red'>P</kbd>&nbsp;";
                                    else
                                        content += "<kbd style='background-color: royalblue'>N</kbd>&nbsp;";
                        content += item.rm + "</td><td>" 
                                + item.dr_nama + "</td><td>" 
                                + item.nama + "</td><td>"
                                + item.jns_kelamin + " / " + item.umur + "</td><td>"
                                + item.alamat + "</td><td>"
                                + item.tgl + "</td>";

                        content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/v2/lab/antigen/`+item.id+`/print','id','width=900,height=600')"><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/lab/antigen/`+item.id+`/cetak')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                  + `</ul></center></td></tr>`;
                        $('#tampil-tbody').append(content);
                    });
                }
                $('#table').DataTable(
                  {
                    order: [[5, "desc"]],
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
                            filename: 'Daftar Antigen'
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
                    'columnDefs': [
                        // { targets: 3, visible: false },
                        // { targets: 5, visible: false },
                        // { targets: 6, visible: false },
                        // { targets: 9, visible: false },
                        // { targets: 10, visible: false },
                        // { targets: 11, visible: false },
                        // { targets: 12, visible: false },
                        // { targets: 16, visible: false },
                    ],
                  },
                );
                $("div.head-label").html('<h5 class="card-title mb-0">Daftar Antigen</h5>');
            }
        }
    );
    
    // VALIDASI INPUT NUMBER
    $('input[type=number][max]:not([max=""])').on('input', function(ev) {
        var $this = $(this);
        var maxlength = $this.attr('max').length;
        var value = $this.val();
        if (value && value.length >= maxlength) {
        $this.val(value.substr(0, maxlength));
        }
    });
    $('#rm').change(function() { 
        if (this.value == '') {
            $("#nama1").val("");
            $("#nama2").val("");
            $("#jns_kelamin1").val("");
            $("#jns_kelamin2").val("");
            $("#umur2").val("");
            $("#umur1").val("");
            $("#alamat1").val("");
            $("#alamat2").val("");
            $("#des").val("");
            $("#kec").val("");
            $("#kab").val("");
        } else {
            if (this.value.length == 4) {
                this.value = '0000'+this.value;
            }
            if (this.value.length == 5) {
                this.value = '000'+this.value;
            } 
            if (this.value.length == 6) {
                this.value = '00'+this.value;
            }
            if (this.value.length < 4) {
                this.value = this.value;
            }
            $.ajax({
                url: "http://192.168.1.3:8000/api/all/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res);
                    $("#nama1").val(res.NAMAPASIEN);
                    $("#nama2").val(res.NAMAPASIEN);
                    $("#jns_kelamin1").val(res.JNSKELAMIN);
                    $("#jns_kelamin2").val(res.JNSKELAMIN);
                    $("#umur1").val(res.UMUR);
                    $("#umur2").val(res.UMUR);
                    $("#alamat1").val(res.ALAMAT);
                    $("#alamat2").val(res.ALAMAT);
                    
                    $("#des").val(res.DESA);
                    $("#kec").val(res.KECAMATAN);
                    $("#kab").val(res.NAMA_KABKOTA);
                    // $('#jumlah20').attr('required', true);
                }
            });
            $.ajax({
                url: "http://103.155.246.25:8000/api/all/"+this.value,
                // url: "http://192.168.1.3:8000/api/all/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res);
                    $("#nama1").val(res.NAMAPASIEN);
                    $("#nama2").val(res.NAMAPASIEN);
                    $("#jns_kelamin1").val(res.JNSKELAMIN);
                    $("#jns_kelamin2").val(res.JNSKELAMIN);
                    $("#umur1").val(res.UMUR);
                    $("#umur2").val(res.UMUR);
                    $("#alamat1").val(res.ALAMAT);
                    $("#alamat2").val(res.ALAMAT);

                    $("#des").val(res.DESA);
                    $("#kec").val(res.KECAMATAN);
                    $("#kab").val(res.NAMA_KABKOTA);
                    // $('#jumlah20').attr('required', true);
                }
            });
        }
    });

});

// FUNCTION
function tambah() {
  $('#tambah').modal('show');
}
function refresh() {
  $("#tampil-tbody").empty().append(`<tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
  $.ajax(
    {
      url: "/api/antigen/get",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        $('#table').DataTable().clear().destroy();
        if(res.show.length == 0){
            $("#tampil-tbody").append(`<tr><td colspan="7"><center><i class="fa fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
        } else {
            res.show.forEach(item => {
                // var updet = item.updated_at.substring(0, 10);
                content = "<tr id='data"+ item.id +"'><td>"; 
                            if (item.hasil == "POSITIF")
                                content += "<kbd style='background-color: red'>P</kbd>&nbsp;";
                            else
                                content += "<kbd style='background-color: royalblue'>N</kbd>&nbsp;";
                content += item.rm + "</td><td>" 
                        + item.dr_nama + "</td><td>" 
                        + item.nama + "</td><td>"
                        + item.jns_kelamin + " / " + item.umur + "</td><td>"
                        + item.alamat + "</td><td>"
                        + item.tgl + "</td>";

                content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                    + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                    + `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/v2/lab/antigen/`+item.id+`/print','id','width=900,height=600')"><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>`
                    + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/lab/antigen/`+item.id+`/cetak')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                    + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                  + `</ul></center></td></tr>`;
                $('#tampil-tbody').append(content);
            });
        }
        $('#table').DataTable(
          {
            order: [[5, "desc"]],
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
                    filename: 'Daftar Risiko K3'
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
            'columnDefs': [
                // { targets: 3, visible: false },
                // { targets: 5, visible: false },
                // { targets: 6, visible: false },
                // { targets: 9, visible: false },
                // { targets: 10, visible: false },
                // { targets: 11, visible: false },
                // { targets: 12, visible: false },
                // { targets: 16, visible: false },
            ],
          },
        );
        $("div.head-label").html('<h5 class="card-title mb-0">Daftar Antigen</h5>');
      }
    }
  );
}
function showUbah(id) {
    $('#ubah').modal('show');
    $.ajax(
        {
            url: "/api/antigen/getubah/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                // $("#tgl_edit").val(tgl); // yyyy-MM-ddThh:mm
                // var tgl = res.tgl + ' ' + res.waktu;
                var finalTgl = moment(res.show.tgl).format('Y-MM-DD HH:mm');
                console.log(finalTgl);
                // TGL EDIT
                var a = document.querySelector("#tgl_edit");
                var b = new Date(Date.now() - 1728e5);
                a.flatpickr({
                    enableTime: !0,
                    minuteIncrement: 1,
                    defaultDate: finalTgl,
                    time_24hr: true,
                    // disable: [{
                    //   from: "2000-01-01",
                    //   to: b.toISOString().split("T")[0]
                    // }]
                })
                document.getElementById('show_id').innerHTML = res.show.id;
                $("#id_edit").val(res.show.id);
                $("#rm_edit").val(res.show.rm);
                $("#pemeriksa_edit").val(res.show.pemeriksa);
                // document.getElementById('tgl_edit').value = tgl;
                $("#nama_edit").val(res.show.nama);
                $("#jns_kelamin_edit").val(res.show.jns_kelamin);
                $("#umur_edit").val(res.show.umur);
                $("#alamat_edit").val(res.show.alamat);
                $("#dr_pengirim_edit").find('option').remove();
                $("#hasil_edit").find('option').remove();
                res.dokter.forEach(item => {
                    $("#dr_pengirim_edit").append(`
                        <option value="${item.id}" ${item.id == res.show.dr_pengirim? "selected":""}>${item.nama} (${item.jabatan})</option>
                    `);
                });
                $("#hasil_edit").append(`
                    <option value="POSITIF" ${res.show.hasil == 'POSITIF'? "selected":""}>POSITIF</option>
                    <option value="NEGATIF" ${res.show.hasil == 'NEGATIF'? "selected":""}>NEGATIF</option>
                `);
            }
        }
    );
}

function ubah() {
    var id          = $("#id_edit").val();
    var pemeriksa   = $("#pemeriksa_edit").val();
    var tgl         = $("#tgl_edit").val();
    var dr_pengirim = $("#dr_pengirim_edit").val();
    var hasil       = $("#hasil_edit").val();

    if (pemeriksa == "" || tgl == "") {
        Swal.fire({
        title: 'Pesan Galat!',
        text: 'Mohon lengkapi semua data terlebih dahulu',
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
        url: '/api/antigen/ubah/'+id, 
        dataType: 'json', 
        data: { 
            id: id,
            pemeriksa: pemeriksa,
            tgl: tgl,
            dr_pengirim: dr_pengirim,
            hasil: hasil,
        }, 
        success: function(res) {
            iziToast.success({
                title: 'Sukses!',
                message: 'Ubah hasil Antigen berhasil pada '+res,
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
      text: 'Hasil Antigen ID : '+id,
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
          url: "/api/antigen/hapus/"+id,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            iziToast.success({
                title: 'Sukses!',
                message: 'Hapus hasil Antigen berhasil pada '+res,
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