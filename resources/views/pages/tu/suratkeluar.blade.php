@extends('layouts.simrsmuv2')

@section('content')
@can('tu')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Tata Usaha /</span> Surat Keluar
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
                            <th>TGL</th>
                            <th>NO. SURAT</th>
                            <th>ISI RINGKASAN</th>
                            <th>DITUJUKAN KEPADA</th>
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
                            <th>TGL</th>
                            <th>NO. SURAT</th>
                            <th>ISI RINGKASAN</th>
                            <th>DITUJUKAN KEPADA</th>
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
                <form class="form-auth-small" name="formTambah" action="{{ route('suratkeluar.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form&nbsp;&nbsp;&nbsp;
                    </h4>
                    <div class="card-title-elements">
                      <select class="form-select form-select-sm" name="user" autofocus required>
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
                            <div class="col-md-12" style="margin-bottom: -20px">
                                <div class="form-group">
                                    <label class="form-label mb-2">Nomor Surat</label>
                                    {{-- <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="tgl_surat" readonly/> --}}
                                    <h5>{{ $list['urutan'] }}/<a id="kd_get" class="text-danger"> . . . </a>/DIR/III.6.AU/PKUSKH/{{ $list['year'] }}</h5>
                                </div>
                            </div>
                            <div class="divider text-end">
                              <div class="divider-text">Form Pengisian&nbsp;&nbsp;&nbsp;</div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Kode/Jenis <a class="text-danger">*</a></label>
                                <select class="form-control select2" name="kode" id="kd_push" style="width: 100%" required>
                                    <option value="">Pilih</option>
                                    @if(count($list['kode']) > 0)
                                        @foreach($list['kode'] as $item)
                                            <option value="{{ $item->id }}"><b>{{ $item->nama }}</b></option>
                                        @endforeach
                                    @endif
                                </select>
                                {{-- <div class="form-group">
                                    <label class="form-label">Kode Surat <a class="text-danger">*</a></label>
                                    <input type="text" name="nomor" class="form-control" placeholder=". . . / . . . / . . ." autofocus required/>
                                </div> --}}
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl" required/>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="select2Dark" class="form-label">Ditujukan Kepada <a class="text-danger">*</a></label>
                                    <button class="btn btn-xs btn-outline-dark" type="button" onclick="ubahTujuan()" id="btn-manual">Manual</button>
                                    <div class="select2-dark" id="tujuan1_add">
                                        <select class="select2users form-select" name="tujuan[]" data-allow-clear="true" data-bs-auto-close="outside" required multiple>
                                            {{-- <option value="all">Seluruh Karyawan</option> --}}
                                            @if(count($list['users']) > 0)
                                                @foreach($list['users'] as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <input type="text" name="tujuan2" id="tujuan2_add" class="form-control" placeholder="e.g. Universitas Islam Negeri Sunan Kalijaga Yogyakarta" hidden required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Isi Surat</label>
                                    <textarea rows="3" class="form-control" name="isi" placeholder="Optional"></textarea>
                                </div>
                            </div>
                            <div class="divider text-end">
                              <div class="divider-text">Form Upload&nbsp;&nbsp;&nbsp;</div>
                            </div>
                            <div class="col-md-12" style="margin-top: -8px">
                                <div class="form-group">
                                    <label class="form-label">Upload</label>
                                    <input type="file" class="form-control mb-2" name="file" accept="application/pdf">
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>20 mb</strong><br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen Scan<br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Dijadikan dalam Satu file <strong>PDF</strong>
                                </div>
                            </div>
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
                        Form&nbsp;&nbsp;&nbsp;
                    </h4>
                    <div class="card-title-elements">
                      <select class="form-select form-select-sm" id="user" required></select>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: -20px">
                            <div class="form-group">
                                <label class="form-label mb-2">Nomor Surat</label>
                                {{-- <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="tgl_surat" readonly/> --}}
                                <h5><a id="push_urutan"></a>/<a id="push_kode" class="text-danger"> . . . </a>/DIR/III.6.AU/PKUSKH/<a id="push_year"></a></h5>
                            </div>
                        </div>
                        <div class="divider text-end">
                          <div class="divider-text">Form Pengisian&nbsp;&nbsp;&nbsp;</div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Kode/Jenis <a class="text-danger">*</a></label>
                            <select class="form-control select2" id="kode_edit" style="width: 100%" required></select>
                            {{-- <div class="form-group">
                                <label class="form-label">Kode Surat <a class="text-danger">*</a></label>
                                <input type="text" name="nomor" class="form-control" placeholder=". . . / . . . / . . ." autofocus required/>
                            </div> --}}
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tanggal <a class="text-danger">*</a></label>
                                <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tgl_edit" required/>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="select2Dark" class="form-label">Ditujukan Kepada <a class="text-danger">*</a></label>
                                <div class="select2-dark" id="tujuan1_edit">
                                    <select class="select2users form-select" id="tujuan1_editselect" data-allow-clear="true" data-bs-auto-close="outside" required multiple></select>
                                </div>
                                <input type="text" name="tujuan2" id="tujuan2_edit" class="form-control" placeholder="e.g. Universitas Islam Negeri Sunan Kalijaga Yogyakarta" hidden required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Isi Surat</label>
                                <textarea rows="3" class="form-control" id="isi_edit" placeholder="Optional"></textarea>
                            </div>
                        </div>
                        <div class="divider text-end">
                          <div class="divider-text">Form Upload&nbsp;&nbsp;&nbsp;</div>
                        </div>
                        <div class="col-md-12" style="margin-top: -8px">
                            <div class="form-group">
                                <label class="form-label">Berkas Surat Anda <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="verifberkas" hidden>
                                <div id="linksurat"></div>
                                <small><i class="fa-fw fas fa-caret-right nav-icon"></i> Apabila terdapat kesalahan File Upload, Anda dapat melakukan Input Ulang</small>
                            </div>
                        </div>
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
                    <p style="text-align: justify;">Anda akan menghapus berkas surat keluar tersebut. Penghapusan berkas akan menyebabkan hilangnya data/dokumen yang terhapus tersebut pada Storage Sistem.
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

            // SELECT2 USERS
            var te = $(".select2users");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "",
                    dropdownParent: es.parent()
                })
            });

            // DATEPICKER
                // DATE
                const l = $('.flatpickr');
                var now = moment().locale('id').format('Y-MM-DD HH:mm');
                l.flatpickr({
                    enableTime: 0,
                    minuteIncrement: 1,
                    defaultDate: now,
                    time_24hr: true,
                })
            
            // KODE SURAT
            $('#kd_push').change(function() {
                $.ajax(
                {
                    url: "/api/suratkeluar/getkode/"+$(this).val(),
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $('#kd_get').text(res);
                    }
                })
            });
            
            // <th class="cell-fit">NO</th>
            // <th class="cell-fit">TGL</th>
            // <th class="cell-fit">NO. SURAT</th>
            // <th>ISI RINGKASAN</th>
            // <th>DITUJUKAN KPD</th>
            // <th>UPDATE</th>
            // <th>USER</th>
            
            $.ajax(
                {
                    url: "/api/suratkeluar/data",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#tampil-tbody").empty();
                        res.show.forEach(item => {
                            // VALIDASI TUJUAN FROM JSON
                            var us = JSON.parse(res.user);
                            // var updet = item.updated_at.substring(0, 10);
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`;
                                    if (item.filename != null) {
                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/suratmasuk/`+item.id+`/download')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                                    }
                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                    + `</ul></center></td><td>`;  
                            content += item.urutan + "</td><td>"
                                        + item.tgl + "</td><td>"
                                        + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'>" + item.nomor + "</h6><small class='text-truncate text-muted'>" + item.kode_jenis + "&nbsp;-&nbsp;" + item.jenis + "</small></div></div></td><td>";
                                        + item.nomor + "</td><td>";
                                        if (item.isi) {
                                            content += item.isi;  
                                        } else {
                                            content += '-';
                                        }
                            content += "</td><td><ul class='list-unstyled mt-2'>";
                                        if (item.tujuan2 != null) {
                                            content += "<li>" + item.tujuan2 + "</li>";
                                        } else {
                                            var un = JSON.parse(item.tujuan);
                                            for(i = 0; i < un.length; i++){
                                                for(u = 0; u < us.length; u++){
                                                    if (un[i] == us[u].id) {
                                                        content += "<li>- " + us[u].nama + "</li>";
                                                    }
                                                }
                                            }
                                        }
                            content += "</ul></td><td>" + item.updated_at + "</td><td>";
                                        if (item.user == '84') { content += 'Sri Suryani, Amd'; }
                                        if (item.user == '293') { content += 'Zia Nuswantara pahlawan, S.H'; }
                                        if (item.user == '88') { content += 'Siti Dewi Sholikhah'; }
                                        if (item.user == '82') { content += 'Salis Annisa Hafiz, Amd.Kom'; }
                            content += "</td></tr>";
                            $('#tampil-tbody').append(content);
                        });
                        $('#table').DataTable(
                        {
                            order: [[5, "desc"]],
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
        function ubahTujuan() {
            $("#btn-manual").prop('hidden', true);
            $("#tujuan1_add").prop('hidden', true);
            $("#tujuan2_add").prop('hidden', false);
        }

        function refresh() {
            // fresh();
            $("#tampil-tbody").empty().append(`<tr><td colspan="9"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
            $.ajax(
                {
                    url: "/api/suratkeluar/data",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#tampil-tbody").empty();
                        $('#table').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            // VALIDASI TUJUAN FROM JSON
                            var us = JSON.parse(res.user);
                            // var updet = item.updated_at.substring(0, 10);
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`;
                                    if (item.filename != null) {
                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/suratmasuk/`+item.id+`/download')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                                    }
                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                    + `</ul></center></td><td>`;  
                            content += item.urutan + "</td><td>"
                                        + item.tgl + "</td><td>"
                                        + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'>" + item.nomor + "</h6><small class='text-truncate text-muted'>" + item.kode_jenis + "&nbsp;-&nbsp;" + item.jenis + "</small></div></div></td><td>";
                                        + item.nomor + "</td><td>";
                                        if (item.isi) {
                                            content += item.isi;  
                                        } else {
                                            content += '-';
                                        }
                            content += "</td><td><ul class='list-unstyled mt-2'>";
                                        if (item.tujuan2 != null) {
                                            content += "<li>" + item.tujuan2 + "</li>";
                                        } else {
                                            var un = JSON.parse(item.tujuan);
                                            for(i = 0; i < un.length; i++){
                                                for(u = 0; u < us.length; u++){
                                                    if (un[i] == us[u].id) {
                                                        content += "<li>- " + us[u].nama + "</li>";
                                                    }
                                                }
                                            }
                                        }
                            content += "</ul></td><td>" + item.updated_at + "</td><td>";
                                        if (item.user == '84') { content += 'Sri Suryani, Amd'; }
                                        if (item.user == '293') { content += 'Zia Nuswantara pahlawan, S.H'; }
                                        if (item.user == '88') { content += 'Siti Dewi Sholikhah'; }
                                        if (item.user == '82') { content += 'Salis Annisa Hafiz, Amd.Kom'; }
                            content += "</td></tr>";
                            $('#tampil-tbody').append(content);
                        });
                        $('#table').DataTable(
                        {
                            order: [[5, "desc"]],
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
                url: "/api/suratkeluar/data/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#ubah').modal('show');
                    var un = JSON.parse(res.show.tujuan);
                    // var dt = new Date(res.show.tanggal).toJSON().slice(0,19);
                    var dt = moment(res.show.tgl).format('Y-MM-DD HH:mm');
                    if (res.show.filename != null) {
                        $("#verifberkas").val(0);
                        document.getElementById('linksurat').innerHTML = "<h6 class='mb-2'><a href='/v2/suratkeluar/"+res.show.id+"/download'>"+res.show.title+"</a></h6>";
                    } else {
                        $("#verifberkas").val(1);
                        // document.getElementById('linksurat').innerHTML = "<input type='file' class='form-control mb-2' name='filesusulan' id='filesusulan' accept='application/pdf'>";
                        document.getElementById('linksurat').innerHTML = `<input type='file' id="filex" name='filex' class="form-control mb-2" accept="application/pdf">`;
                    }
                    $("#id_edit").val(res.show.id);
                    
                    // INIT DATE
                        // TGL SURAT EDIT
                        var a = document.querySelector("#tgl_edit");
                        a.flatpickr({
                            enableTime: 0,
                            minuteIncrement: 1,
                            time_24hr: true,
                            defaultDate: res.show.tgl,
                        })

                    $("#push_urutan").text(res.urutan);
                    $("#push_kode").text(res.kode);
                    $("#push_year").text(res.year);
                    if (res.show.tujuan2 !== null) {
                        $("#tujuan1_edit").prop('hidden', true);
                        $("#tujuan2_edit").prop('hidden', false);
                        $("#tujuan2_edit").val(res.show.tujuan2);
                    } else {
                        $("#tujuan1_editselect").find('option').remove();
                        $("#tujuan1_edit").prop('hidden', false);
                        $("#tujuan2_edit").prop('hidden', true);
                        res.users.forEach(pounch => {
                            $("#tujuan1_editselect").append(`
                                <option value="${pounch.id}">${pounch.nama}</option>
                            `);
                        });
                        $("#tujuan1_editselect").val(un).change();
                    }
                    $("#isi_edit").val(res.show.isi);
                    $("#kode_edit").find('option').remove();
                    res.refkode.forEach(item => {
                        $("#kode_edit").append(`
                            <option value="${item.id}" ${item.id == res.show.kode? "selected":""}>${item.nama}</option>
                        `);
                    });
                    $('#kode_edit').change(function() {
                        $.ajax(
                        {
                            url: "/api/suratkeluar/getkode/"+$(this).val(),
                            type: 'GET',
                            dataType: 'json', // added data type
                            success: function(bowl) {
                                $('#push_kode').text(bowl);
                            }
                        })
                    });
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

        function ubahAjx() {   
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");
            
            var fd = new FormData();

            // Get the selected file
            if ($("#verifberkas").val() == 1) {
                var files = $('#filex')[0].files;
                fd.append('file',files[0]);
            }

            fd.append('id_edit',$("#id_edit").val());
            fd.append('kode',$("#kode_edit").val());
            if ($("#tujuan2_edit").val() != null) {
                fd.append('tujuan2',$("#tujuan2_edit").val());
            } else {
                fd.append('tujuan',$("#tujuan1_editselect").val());
            }
            fd.append('tgl',$("#tgl_edit").val());
            fd.append('isi',$("#isi_edit").val());
            fd.append('user',$("#user").val());

            // AJAX request 
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('suratkeluar.ubah')}}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Surat Keluar berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        $('#ubah').modal('hide');
                        refresh();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                }
            });
            
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
                    url: "/api/suratkeluar/"+id,
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
