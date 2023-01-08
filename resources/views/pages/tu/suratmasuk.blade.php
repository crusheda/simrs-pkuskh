@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Tata Usaha /</span> Surat Masuk
    </h4>

    @if (session('message'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
            <p class="mb-0">{{ session('message') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if ($errors->count() > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
            <p class="mb-0">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <div class="card card-action mb-5">
        {{-- <div class="card-alert"></div> --}}
        <div class="card-header">
            <div class="card-action-title">
                <div class="btn-group">
                    <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah" value="animate__jackInTheBox">
                        <i class="bx bx-upload scaleX-n1-rtl"></i>
                        <span class="align-middle">Upload</span>
                    </a>
                    <button type="button" class="btn btn-label-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="refresh()">
                        <i class="fa-fw fas fa-sync nav-icon"></i></button>
                </div>
                {{-- <button class="btn btn-primary">
        <i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah
      </button> --}}
            </div>
            <div class="card-action-element">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <hr style="margin-top: -5px">
        <div class="collapse show">
            <div class="card-datatable table-responsive">
                <table id="table" class="table table-striped display">
                    <thead>
                        <tr>
                            <th class="cell-fit">
                                <center>#</center>
                            </th>
                            <th class="cell-fit">NO.URUT</th>
                            <th class="cell-fit">TGL SURAT</th>
                            <th class="cell-fit">TGL DITERIMA</th>
                            <th>ASAL/NO.SRT</th>
                            <th>DESKRIPSI</th>
                            <th>TEMPAT/ACARA</th>
                            <th>UPDATE</th>
                            <th class="cell-fit">USER</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        <tr>
                            <td colspan="9">
                                <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-whitesmoke">
                        <tr>
                            <th class="cell-fit">
                                <center>#</center>
                            </th>
                            <th class="cell-fit">NO.URUT</th>
                            <th class="cell-fit">TGL SURAT</th>
                            <th class="cell-fit">TGL DITERIMA</th>
                            <th>ASAL/NO.SRT</th>
                            <th>DESKRIPSI</th>
                            <th>TEMPAT/ACARA</th>
                            <th>UPDATE</th>
                            <th class="cell-fit">USER</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade animate__animated animate__jackInTheBox" id="tambah" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form-auth-small" name="formTambah" action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Upload&nbsp;&nbsp;&nbsp;
                    </h4>
                    <div class="card-title-elements">
                      <select class="form-select form-select-sm" name="user" required>
                        <option value="" hidden>Pilih Petugas</option>
                        <option value="84">Sri Suryani, Amd</option>
                      </select>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl. Surat</label>
                                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_surat"/>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl. Diterima <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control flatpickrNull" placeholder="YYYY-MM-DD" name="tgl_diterima" required/>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nomor Surat <a class="text-danger">*</a></label>
                                    <input type="text" name="nomor" class="form-control" placeholder=". . . / . . . / . . ." autofocus required/>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Asal Surat <a class="text-danger">*</a></label>
                                    <input type="text" name="asal" class="form-control" placeholder="e.g. Perhimpunan Rumah Sakit Seluruh Indonesia" required/>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tempat</label>
                                    <input type="text" name="tempat" class="form-control" placeholder="e.g. Hotel Syariah Surakarta">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Acara</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control flatpickrrange" name="waktu" placeholder="YYYY-MM-DD to YYYY-MM-DD"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-help-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik 2x apabila hanya memilih satu tanggal saja"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea rows="3" class="form-control" name="deskripsi" placeholder="Optional"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Upload <a class="text-danger">*</a></label>
                            <input type="file" class="form-control mb-2" name="file" id="file" accept="application/pdf" required>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>20 mb</strong><br>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen Scan<br>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> Dijadikan dalam Satu file <strong>PDF</strong>
                        </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-upload nav-icon"></i> Upload</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade animate__animated animate__rubberBand" id="ubah" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Ubah&nbsp;&nbsp;&nbsp;
                    </h4>
                    <div class="card-title-elements">
                      <select class="form-select form-select-sm" id="user" required></select>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Surat</label>
                                <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tgl_surat"/>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Diterima <a class="text-danger">*</a></label>
                                <input type="text" class="form-control flatpickrNull" placeholder="YYYY-MM-DD" id="tgl_diterima" required/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nomor Surat <a class="text-danger">*</a></label>
                                <input type="text" id="nomor" class="form-control" placeholder=". . . / . . . / . . ." autofocus required/>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Asal Surat <a class="text-danger">*</a></label>
                                <input type="text" id="asal" class="form-control" placeholder="e.g. Perhimpunan Rumah Sakit Seluruh Indonesia" required/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tempat</label>
                                <input type="text" id="tempat" class="form-control" placeholder="e.g. Hotel Syariah Surakarta">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Acara</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control flatpickrrange" id="waktu" placeholder="YYYY-MM-DD to YYYY-MM-DD"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-help-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik 2x apabila hanya memilih satu tanggal saja"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea rows="3" class="form-control" id="deskripsi" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Berkas Surat Anda</label>
                        <h6 id="linksurat" class="mb-2"></h6>
                        <small><i class="fa-fw fas fa-caret-right nav-icon"></i> Apabila terdapat kesalahan File Upload, Anda dapat melakukan penghapusan lalu Input Ulang</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-simpan" onclick="updateData()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade bd-example-modal-lg" id="ubah" role="dialog"
        aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Ubah Berkas&nbsp;<kbd><a id="show_edit"></a></kbd>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" class="form-control" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Kegiatan :</label>
                                <input type="text" id="nama_edit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Ketua Rapat : </label><br>
                                <select class="form-control select2" id="kepala_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Tanggal :</label>
                                <input type="text" id="tanggal_edit" class="form-control flatpickr" placeholder="Tanggal Rapat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Lokasi Rapat :</label>
                                <input type="text" id="lokasi_edit" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Keterangan :</label>
                        <textarea rows="3" class="form-control" id="keterangan_edit" placeholder="Optional"></textarea>
                    </div>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Waktu pengubahan berkas rapat hanya berlaku pada hari saat anda mengupload</sub><br>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Periksa ulang lampiran berkas anda, apabila terdapat kesalahan upload dokumen mohon hapus dan upload ulang</sub>
                        
                </div>
                <div class="modal-footer">
                    Ditambahkan oleh&nbsp;<a id="user_edit"></a>
                    <button class="btn btn-primary" id="submit_edit" onclick="ubah()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="modal fade" tabindex="-1" id="download" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">File Berkas Rapat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <a type="button" class="btn btn-primary text-white" id="download_btn"><i class="fa fa-download"></i> Download</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- MODAL HAPUS --}}
    <div class="modal animate__animated animate__rubberBand fade" id="hapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="row">
                <h4 class="modal-title text-center mb-3">
                    Hapus Surat
                </h4>
                <div class="col-12 mb-3">
                    <p style="text-align: justify;">Anda akan menghapus berkas surat masuk tersebut. Penghapusan berkas akan menyebabkan hilangnya data/dokumen yang terhapus tersebut pada Storage Sistem.
                        Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-danger me-sm-3 me-1"><i class="fa fa-trash"></i> Hapus</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div>
        </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: e.parent()
                })
            });
            // DATEPICKER
                // DATE
                const today = new Date();
                var tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 2);
                var next = new Date(today);
                next.setDate(next.getDate() + 999999);
                const l = $('.flatpickr');
                const ln = $('.flatpickrNull');
                // const dates = new Date(Date.now());
                // const tomorow = dates.getTime();
                // const m = new Date(Date.now());
                // const c = new Date(Date.now() + 1728e5); // 3 hari kedepan
                var now = moment().locale('id').format('Y-MM-DD HH:mm');
                l.flatpickr({
                    enableTime: 0,
                    minuteIncrement: 1,
                    // monthSelectorType: "static",
                    // inline: true,
                    // defaultHour: 12,
                    // defaultMinute: "today",
                    time_24hr: true,
                    // dateFormat: "Y-m-d H:m",
                    disable: [{
                        from: tomorrow.toISOString().split("T")[0],
                        to: next.toISOString().split("T")[0]
                    }]
                })
                ln.flatpickr({
                    enableTime: 0,
                    defaultDate: now,
                    minuteIncrement: 1,
                    time_24hr: true,
                    disable: [{
                        from: tomorrow.toISOString().split("T")[0],
                        to: next.toISOString().split("T")[0]
                    }]
                })

                // DATERANGE
                $('.flatpickrrange').flatpickr({
                    mode: "range"
                });
                
                // DATETIME
                $('.flatpickrtime').flatpickr({
                    enableTime: !0,
                    dateFormat: "Y-m-d H:i"
                });
            
            $.ajax(
                {
                    url: "/api/suratmasuk/data",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#tampil-tbody").empty();
                        res.show.forEach(item => {
                            // var updet = item.updated_at.substring(0, 10);
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/suratmasuk/`+item.id+`/download')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                    + `</ul></center></td><td>`;  
                            content += item.urutan + "</td><td>" 
                                        + item.tgl_surat + "</td><td>" 
                                        + item.tgl_diterima + "</td><td>"
                                        + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate'>" + item.asal + "</h6><small class='text-truncate text-muted'>" + item.nomor + "</small></div></div></td><td>" 
                                        + item.deskripsi + "</td><td>" 
                                        + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate'>" + item.tempat + "</h6><small class='text-truncate text-muted'>" + item.tglFrom.substring(0, 10) + " - " + item.tglTo.substring(0, 10) + "</small></div></div></td><td>" 
                                        + item.updated_at + "</td><td>" 
                                        + item.user + "</td></tr>";
                            $('#tampil-tbody').append(content);
                        });
                        $('#table').DataTable(
                        {
                            order: [[8, "desc"]],
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
                                    filename: 'Berkas Surat'
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
                            }],
                            columnDefs: [
                                { targets: 0, orderable: !1,searchable: !1, },
                                { targets: 1, orderable: !1,searchable: !1, },
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
                        $("div.head-label").html('<h5 class="card-title mb-0">Berkas Surat</h5>');
                    }
                }
            );
        });
        
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

        function showUbah(id) {
            $.ajax(
            {
                url: "/api/suratmasuk/data/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#ubah').modal('show');
                    // var dt = new Date(res.show.tanggal).toJSON().slice(0,19);
                    var dt = moment(res.show.tanggal).format('Y-MM-DD HH:mm');
                    document.getElementById('linksurat').innerHTML = "<a href='/v2/suratmasuk/"+res.show.id+"/download'>"+res.show.title+"</a>";
                    $("#id_edit").val(res.show.id);
                    // $("#tgl_surat").val(res.show.tgl_surat);
                    
                    // INIT DATE
                    const today = new Date();
                    var tomorrow = new Date(today);
                    tomorrow.setDate(tomorrow.getDate() + 2);
                    var next = new Date(today);
                    next.setDate(next.getDate() + 999999);
                        // TGL SURAT EDIT
                        var a = document.querySelector("#tgl_surat");
                        var b = new Date(Date.now() - 1728e5);
                        a.flatpickr({
                            enableTime: 0,
                            minuteIncrement: 1,
                            defaultDate: res.show.tgl_surat,
                            time_24hr: true,
                            disable: [{
                                from: tomorrow.toISOString().split("T")[0],
                                to: next.toISOString().split("T")[0]
                            }]
                        })
                        // TGL DITERIMA EDIT
                        var a = document.querySelector("#tgl_diterima");
                        var b = new Date(Date.now() - 1728e5);
                        a.flatpickr({
                            enableTime: 0,
                            minuteIncrement: 1,
                            defaultDate: res.show.tgl_diterima,
                            time_24hr: true,
                            disable: [{
                                from: tomorrow.toISOString().split("T")[0],
                                to: next.toISOString().split("T")[0]
                            }]
                        })

                    $("#asal").val(res.show.asal);
                    $("#nomor").val(res.show.nomor);
                    $("#deskripsi").val(res.show.deskripsi);
                    $("#tempat").val(res.show.tempat);
                    $("#waktu").val(res.waktu);
                    $("#user").find('option').remove();
                    $("#user").append(`
                        <option value="84" ${res.show.user == '84' ? "selected":""}>Sri Suryani, Amd</option>
                    `);
                }
            }
            );
        }

        function ubah() {
            $("#btn-simpan").prop('disabled', true);
            $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
            var id          = $("#id_edit").val();
            var nama        = $("#nama_edit").val();
            var kepala      = $("#kepala_edit").val();
            var tanggal     = $("#tanggal_edit").val();
            var lokasi      = $("#lokasi_edit").val();
            var keterangan  = $("#keterangan_edit").val();

            if (nama == "" || kepala == "" || tanggal == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon lengkapi form pengisian',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/berkas/rapat/data/'+id+'/ubah', 
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
                        fresh();
                        // $("#tampil-tbody").empty();
                        // content += `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`;
                        // $('#tampil-tbody').append(content);
                        window.location.reload();
                    }
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Berkas Rapat berhasil diubah pada '+res,
                        position: 'topRight'
                    });
                }
                });
            }
            $("#submit_edit").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#submit_edit").prop('disabled', false);
        }

        function showDownload(id) {
            // $("#ubah"+id).prop('disabled', true);
            // $("#ubah"+id).find("i").toggleClass("fa-edit fa-sync fa-spin");
            $('#download').modal('show');
            $.ajax(
            {
                url: "/api/berkas/rapat/data/"+id+"/download",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-file").empty();
                    document.getElementById('tgl_upload').innerHTML = res.tgl_upload;
                    document.getElementById('download_btn').href = "/api/berkas/rapat/data/"+res.id+"/zip";
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
            $('#hapus').modal('show');
        }

        function prosesHapus() {
            $.ajax({
            url: "/api/berkas/rapat/data/"+id+"/hapus",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                iziToast.success({
                    title: 'Pesan Sukses!',
                    message: 'Berkas gagal telah berhasil dihapus',
                    position: 'topRight'
                });
                fresh();
                window.location.reload();
            },
            error: function(res) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Berkas gagal diupload',
                    position: 'topRight'
                });
            }
            });
        }

        function saveData() {
            $("#tambah").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                $("#btn-simpan").attr('disabled','disabled');
                $("#btn-simpan").find("i").removeClass("fa-upload").addClass("fa-sync fa-spin");
                return true;
            });
        }
    </script>
@endsection
