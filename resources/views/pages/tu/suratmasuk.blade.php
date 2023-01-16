@extends('layouts.simrsmuv2')

@section('content')
@can('tu')
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
                                <center></center>
                            </th>
                            <th class="cell-fit">NO</th>
                            <th class="cell-fit">TGL SURAT</th>
                            <th class="cell-fit">TGL DITERIMA</th>
                            <th>ASAL/NO.SRT</th>
                            <th>DESKRIPSI</th>
                            <th>TEMPAT/ACARA</th>
                            <th>UPDATE</th>
                            <th>USER</th>
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
                                <center></center>
                            </th>
                            <th class="cell-fit">NO</th>
                            <th class="cell-fit">TGL SURAT</th>
                            <th class="cell-fit">TGL DITERIMA</th>
                            <th>ASAL/NO.SRT</th>
                            <th>DESKRIPSI</th>
                            <th>TEMPAT/ACARA</th>
                            <th>UPDATE</th>
                            <th>USER</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
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
                        <option value="84" selected>Sri Suryani, Amd</option>
                        <option value="293">Zia Nuswantara pahlawan, S.H</option>
                        <option value="88">Siti Dewi Sholikhah</option>
                        <option value="82">Salis Annisa Hafiz, Amd.Kom</option>
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
                            <label class="form-label">Upload</label>
                            <input type="file" class="form-control mb-2" name="file" accept="application/pdf">
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

    {{-- MODAL UBAH --}}
    <div class="modal fade animate__animated animate__rubberBand" id="ubah" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
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
                        <div id="linksurat"></div>
                        <small><i class="fa-fw fas fa-caret-right nav-icon"></i> Apabila terdapat kesalahan File Upload, Anda dapat melakukan Input Ulang</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-ubah" onclick="ubahAjx()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal animate__animated animate__rubberBand fade" id="hapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="row">
                <h4 class="modal-title text-center mb-3">
                    Hapus Surat
                </h4>
                <div class="col-12 mb-3">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus berkas surat masuk tersebut. Penghapusan berkas akan menyebabkan hilangnya data/dokumen yang terhapus tersebut pada Storage Sistem.
                        Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash"></i> Hapus</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div>
        </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("html").addClass('layout-menu-collapsed');
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
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`;
                                    if (item.filename != null) {
                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/suratmasuk/`+item.id+`/download')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                                    }
                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                    + `</ul></center></td><td>`;  
                            content += item.urutan + "</td><td>";
                                        if (item.tgl_surat != null) {
                                            content += item.tgl_surat;  
                                        } else {
                                            content += '-';
                                        }
                            content += "</td><td>" + item.tgl_diterima + "</td><td>"
                                        + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate'>" + item.asal + "</h6><small class='text-truncate text-muted'>" + item.nomor + "</small></div></div></td><td>";
                                        if (item.deskripsi) {
                                            content += item.deskripsi;  
                                        } else {
                                            content += '-';
                                        }
                            content += "</td><td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate'>";
                                        if (item.tempat != null) {
                                            content += item.tempat;   
                                        } else {
                                            content += '-';
                                        }
                            content += "</h6><small class='text-truncate text-muted'>";
                                        if (item.tglTo == null) {
                                            if (item.tglFrom == null) {
                                                content += '-';
                                            } else {
                                                content += item.tglFrom.substring(0, 10);
                                            }
                                        } else {
                                            content += item.tglFrom.substring(0, 10) + " - " + item.tglTo.substring(0, 10);
                                        } 
                            content += "</small></div></div></td><td>" 
                                        + item.updated_at + "</td><td>";
                                        if (item.user == '84') { content += 'Sri Suryani, Amd'; }
                                        if (item.user == '293') { content += 'Zia Nuswantara pahlawan, S.H'; }
                                        if (item.user == '88') { content += 'Siti Dewi Sholikhah'; }
                                        if (item.user == '82') { content += 'Salis Annisa Hafiz, Amd.Kom'; }
                            content += "</td></tr>";
                            $('#tampil-tbody').append(content);
                        });
                        $('#table').DataTable(
                        {
                            order: [[7, "desc"]],
                            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                            displayLength: 10,
                            lengthMenu: [10, 25, 50, 75, 100],
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
                                { targets: 5, orderable: !1 },
                                { targets: 6, orderable: !1 },
                                // { targets: 1, orderable: !1,searchable: !1, },
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
        
        // FUNCTION-FUNCTION
        function refresh() {
            // fresh();
            $("#tampil-tbody").empty().append(`<tr><td colspan="9"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
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
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`;
                                    if (item.filename != null) {
                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/suratmasuk/`+item.id+`/download')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                                    }
                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                    + `</ul></center></td><td>`;  
                            content += item.urutan + "</td><td>";
                                        if (item.tgl_surat != null) {
                                            content += item.tgl_surat;  
                                        } else {
                                            content += '-';
                                        }
                            content += "</td><td>" + item.tgl_diterima + "</td><td>"
                                        + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate'>" + item.asal + "</h6><small class='text-truncate text-muted'>" + item.nomor + "</small></div></div></td><td>";
                                        if (item.deskripsi) {
                                            content += item.deskripsi;  
                                        } else {
                                            content += '-';
                                        }
                            content += "</td><td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate'>";
                                        if (item.tempat != null) {
                                            content += item.tempat;   
                                        } else {
                                            content += '-';
                                        }
                            content += "</h6><small class='text-truncate text-muted'>";
                                        if (item.tglTo == null) {
                                            if (item.tglFrom == null) {
                                                content += '-';
                                            } else {
                                                content += item.tglFrom.substring(0, 10);
                                            }
                                        } else {
                                            content += item.tglFrom.substring(0, 10) + " - " + item.tglTo.substring(0, 10);
                                        } 
                            content += "</small></div></div></td><td>" 
                                        + item.updated_at + "</td><td>";
                                        if (item.user == '84') { content += 'Sri Suryani, Amd'; }
                                        if (item.user == '293') { content += 'Zia Nuswantara pahlawan, S.H'; }
                                        if (item.user == '88') { content += 'Siti Dewi Sholikhah'; }
                                        if (item.user == '82') { content += 'Salis Annisa Hafiz, Amd.Kom'; }
                            content += "</td></tr>";
                            $('#tampil-tbody').append(content);
                        });
                    }
                }
            );
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
                    if (res.show.filename != null) {
                        document.getElementById('linksurat').innerHTML = "<h6 class='mb-2'><a href='/v2/suratmasuk/"+res.show.id+"/download'>"+res.show.title+"</a></h6>";
                    } else {
                        // document.getElementById('linksurat').innerHTML = "<input type='file' class='form-control mb-2' name='filesusulan' id='filesusulan' accept='application/pdf'>";
                        document.getElementById('linksurat').innerHTML = `<input type='file' id="filex" name='filex' class="form-control mb-2" accept="application/pdf">`;
                    }
                    $("#id_edit").val(res.show.id);
                    
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
                        <option value="293" ${res.show.user == '293' ? "selected":""}>Zia Nuswantara pahlawan, S.H</option>
                        <option value="88" ${res.show.user == '88' ? "selected":""}>Siti Dewi Sholikhah</option>
                        <option value="82" ${res.show.user == '82' ? "selected":""}>Salis Annisa Hafiz, Amd.Kom</option>
                    `);
                }
            }
            );
        }

        // function ubah() {
        //     $("#btn-ubah").prop('disabled', true);
        //     $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");

        //     var id              = $("#id_edit").val();
        //     var tgl_surat       = $("#tgl_surat").val();
        //     var tgl_diterima    = $("#tgl_diterima").val();
        //     var asal            = $("#asal").val();
        //     var nomor           = $("#nomor").val();
        //     var deskripsi       = $("#deskripsi").val();
        //     var tempat          = $("#tempat").val();
        //     var waktu           = $("#waktu").val();
        //     var user            = $("#user").val();

        //     // console.log(file);
        //     if (user == "" || tgl_diterima == "" || nomor == "" || asal == "") {
        //         iziToast.error({
        //             title: 'Pesan Galat!',
        //             message: 'Mohon lengkapi kolom pengisian wajib *',
        //             position: 'topRight'
        //         });
        //     } else {
        //         $.ajax({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             method: 'PUT',
        //             url: '/api/suratmasuk/'+id, 
        //             // dataType: 'json', 
        //             data: { 
        //                 id: id,
        //                 tgl_surat: tgl_surat,
        //                 tgl_diterima: tgl_diterima,
        //                 asal: asal,
        //                 nomor: nomor,
        //                 deskripsi: deskripsi,
        //                 tempat: tempat,
        //                 waktu: waktu,
        //                 user: user,
        //             },
        //             // data: formData, 
        //             // cache: false,
        //             // processData: false,
        //             // contentType: false,
        //             // enctype: 'multipart/form-data',
        //             success: function(res) {
        //                 iziToast.success({
        //                     title: 'Pesan Sukses!',
        //                     message: 'Surat Masuk berhasil diperbarui pada '+res,
        //                     position: 'topRight'
        //                 });
        //                 if (res) {
        //                     $('#ubah').modal('hide');
        //                     fresh();
        //                     refresh();
        //                     // window.location.reload();
        //                 }
        //             }
        //         });
        //     }
        //     $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
        //     $("#btn-ubah").prop('disabled', false);
        // }

        function ubahAjx() {   
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");
            
            if (user == "" || tgl_diterima == "" || nomor == "" || asal == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon lengkapi kolom pengisian wajib *',
                    position: 'topRight'
                });
            } else {
                // Get the selected file
                var files = $('#filex')[0].files;
                
                var fd = new FormData();

                fd.append('id_edit',$("#id_edit").val());
                fd.append('tgl_surat',$("#tgl_surat").val());
                fd.append('tgl_diterima',$("#tgl_diterima").val());
                fd.append('asal',$("#asal").val());
                fd.append('nomor',$("#nomor").val());
                fd.append('deskripsi',$("#deskripsi").val());
                fd.append('tempat',$("#tempat").val());
                fd.append('waktu',$("#waktu").val());
                fd.append('user',$("#user").val());

                if(files.length > 0){

                    // Append data 
                    fd.append('file',files[0]);
                    // fd.append('_token',CSRF_TOKEN);

                    // Hide alert 
                    // $('#responseMsg').hide();

                    // AJAX request 
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{route('suratmasuk.ubah')}}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(res){
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Surat Masuk berhasil diperbarui pada '+res,
                                position: 'topRight'
                            });
                            if (res) {
                                $('#ubah').modal('hide');
                                fresh();
                                refresh();
                                // window.location.reload();
                            }
                        },
                        error: function(res){
                            console.log("error : " + JSON.stringify(res) );
                        }
                    });
                }else{
                    alert("Please select a file.");
                }
            }
            $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-ubah").prop('disabled', false);
        }

        function hapus(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#hapus').modal('show');
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penghapusan berkas',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    url: "/api/suratmasuk/"+id,
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Berkas telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        refresh();
                        // window.location.reload();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Berkas gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function saveData() {
            $("#tambah").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                $("#btn-simpan").attr('disabled','disabled');
                $("#btn-simpan").find("i").removeClass("fa-upload").addClass("fa-sync fa-spin");
                // $('#tambah').modal('hide');
                // fresh();
                // refresh();
                return true;
            });
        }
    </script>
@endcan
@endsection
