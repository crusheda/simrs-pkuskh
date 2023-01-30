@extends('layouts.simrsmuv2')

@section('content')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Administrasi /</span> Regulasi
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

    <!-- Table -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Filter</h5>
            <div class="dropdown">
                <button class="btn p-0" type="button" id="employeeList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="employeeList">
                    @if (Auth::user()->hasRole('it|sekretaris-direktur|administrator'))
                        <a class="dropdown-item" href="javascript:void(0);" onclick="tambah()">Tambah Regulasi</a>
                    @endif
                    <a class="dropdown-item" href="javascript:void(0);" onclick="showTotal()">Total Regulasi</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-3">
                    <label class="form-label">Jenis Regulasi</label>
                    <select class="form-control select2" id="search_regulasi" style="width: 100%">
                        <option value="">Pilih</option>
                        <option value="1">Kebijakan</option>
                        <option value="2">Panduan</option>
                        <option value="3">Pedoman</option>
                        <option value="4">Program</option>
                        <option value="5">SPO</option>
                        <option value="6">PPK</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Waktu Pengesahan</label>
                    <input type="month" class="form-control" value="" placeholder="Tgl" id="search_waktu" />
                </div>
                <div class="col-md-4">
                    <label class="form-label">Unit Pembuat</label>
                    <select class="form-control select2" id="search_pembuat" style="width: 100%">
                        <option value="">Pilih</option>
                        @foreach($list['unit'] as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="btn-group" style="width: 100%">
                        <button type="button" class="btn btn-primary mt-4" id="btn-cari-show" onclick="cari()"><i class="fa-fw fas fa-search nav-icon"></i> Submit</button>
                        <button type="button" class="btn btn-label-secondary mt-4" onclick="bersih()"><i class="fa-fw fas fa-eraser nav-icon"></i> Clear</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive" id="show_table" style="margin-top: -20px" hidden>
            <table class="datatables-users table border-top table-hover" id="table">
                <thead>
                    <tr>
                        <th class="cell-fit"></th>
                        <th class="cell-fit">ID</th>
                        <th style="width: 90px">DISAHKAN</th>
                        <th>JUDUL - UNIT TERKAIT</th>
                        <th class="cell-fit">UNIT PEMBUAT</th>
                        <th style="width: 170px">UPDATE</th>
                    </tr>
                </thead>
                <tbody id="tampil-tbody">
                    <tr>
                        <td colspan="9">
                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="cell-fit"></th>
                        <th class="cell-fit">ID</th>
                        <th style="width: 90px">DISAHKAN</th>
                        <th>JUDUL - UNIT TERKAIT</th>
                        <th class="cell-fit">UNIT PEMBUAT</th>
                        <th style="width: 170px">UPDATE</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="tambah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Regulasi
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Regulasi <a class="text-danger">*</a></label>
                                <select class="form-select select2" id="jns_regulasi">
                                    <option value="" hidden>Pilih</option>
                                    <option value="1">Kebijakan</option>
                                    <option value="2">Panduan</option>
                                    <option value="3">Pedoman</option>
                                    <option value="4">Program</option>
                                    <option value="5">SPO</option>
                                    <option value="6">PPK</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Pengesahan <a class="text-danger">*</a></label>
                                <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tgl"/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Unit Pembuat <a class="text-danger">*</a></label>
                                <select class="form-select select2" id="pembuat">
                                    <option value="" hidden>Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Judul Dokumen <a class="text-danger">*</a></label>
                                <input type="text" id="judul" class="form-control" placeholder="e.g. PROSEDUR PERMINTAAN DARAH KEADAAN KHUSUS/CITO"/>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Unit Terkait <a class="text-danger">*</a></label>
                                <input type="text" id="unit" class="form-control" placeholder="e.g. BDRS, RAWAT INAP, KEBIDANAN, ICU, IBS"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upload <a class="text-danger">*</a></label>
                        <input type="file" class="form-control mb-2" id="filex" name="filex" accept="application/pdf">
                        <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>20 mb</strong><br>
                        <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen Scan (PDF)
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-upload" onclick="prosesTambah()"><i class="fa-fw fas fa-upload nav-icon"></i> Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade animate__animated animate__rubberBand" id="ubah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Ubah Regulasi
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Regulasi <a class="text-danger">*</a></label>
                                <select class="form-select select2" id="jns_regulasi_edit">
                                    <option value="" hidden>Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Pengesahan <a class="text-danger">*</a></label>
                                <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tgl_edit"/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Unit Pembuat <a class="text-danger">*</a></label>
                                <select class="form-select select2" id="pembuat_edit">
                                    <option value="" hidden>Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Judul Dokumen <a class="text-danger">*</a></label>
                                <input type="text" id="judul_edit" class="form-control" placeholder="e.g. PROSEDUR PERMINTAAN DARAH KEADAAN KHUSUS/CITO"/>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Unit Terkait <a class="text-danger">*</a></label>
                                <input type="text" id="unit_edit" class="form-control" placeholder="e.g. BDRS, RAWAT INAP, KEBIDANAN, ICU, IBS"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <small><i class="fa-fw fas fa-caret-right nav-icon mb-3"></i> Apabila terdapat kesalahan File Upload, Anda dapat melakukan <b>Input Dokumen Ulang</b> di bawah ini</small><br>
                        <div class="mb-3" id="upload_ulang"></div>
                        <small class="mb-4">
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> Hubungi Admin untuk dilakukan penghapusan berkas<br>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>20 mb</strong><br>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen Scan (<b>PDF</b>)
                        </small><hr>
                        <label class="form-label">Berkas Regulasi Terupload</label>
                        <div id="berkas_regulasi"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-upload nav-icon"></i> Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade animate__animated animate__jackInTheBox" id="info" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Total Regulasi
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <table class="table-responsive table border-top table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>JENIS REGULASI</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody">
                            <tr>
                                <th>Kebijakan</th>
                                <td id="count_kebijakan"></td>
                            </tr>
                            <tr>
                                <th>Panduan</th>
                                <td id="count_panduan"></td>
                            </tr>
                            <tr>
                                <th>Pedoman</th>
                                <td id="count_pedoman"></td>
                            </tr>
                            <tr>
                                <th>Program</th>
                                <td id="count_program"></td>
                            </tr>
                            <tr>
                                <th>SPO</th>
                                <td id="count_spo"></td>
                            </tr>
                            <tr>
                                <th>PPK</th>
                                <td id="count_ppk"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>TOTAL KESELURUHAN</th>
                                <td id="count_total"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
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
                    Hapus Regulasi
                </h4>
                <div class="col-12 mb-3">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus berkas Regulasi tersebut. Penghapusan Regulasi akan menyebabkan hilangnya data/dokumen yang terhapus tersebut pada Storage Sistem.
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
            // $("html").addClass('layout-menu-collapsed');

            // TGL ADD
            // const l = document.querySelector("#search_waktu");
            // const c = new Date(Date.now() - 1728e5)
            //     , m = new Date(Date.now());
            // var today = moment().locale('id').format('Y-MM-DD HH:mm');
            // console.log(today);
            // l.flatpickr({
            //     enableTime: !0,
            //     defaultDate: today,
            //     minuteIncrement: 1,
            //     // inline: true,
            //     // defaultHour: 12,
            //     // defaultMinute: "today",
            //     time_24hr: true,
            //     // dateFormat: "Y-m-d H:m",
            //     disable: [{
            //         from: "2000-01-01",
            //         to: c.toISOString().split("T")[0]
            //     }]
            // })

            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    allowClear: true,
                    dropdownParent: e.parent()
                })
            });
            
            // DATE
            const l = $('.flatpickr');
            var now = moment().locale('id').format('Y-MM-DD HH:mm');
            l.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                // defaultDate: now,
                time_24hr: true,
            })
        })

        function cari() {
            // $("#btn-cari").append('&nbsp;&nbsp;<span class="spinner-border" role="status" aria-hidden="true"></span>');
            $("#tampil-tbody").empty();
            $("#show_table").prop('hidden', false);
            $("#tampil-tbody").empty().append(`<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            var regulasi    = $("#search_regulasi").val();
            var waktu       = $("#search_waktu").val();
            var pembuat     = $("#search_pembuat").val();
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/regulasi/filter",
                    type: 'POST',
                    dataType: 'json', // added data type
                    data: { 
                        regulasi: regulasi,
                        waktu: waktu,
                        pembuat: pembuat,
                    }, 
                    success: function(res) {
                        var editorID = "{{ Auth::user()->hasRole('it|sekretaris-direktur|administrator') }}";
                        var adminID = "{{ Auth::user()->hasRole('administrator') }}";
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: res.count+' data pencarian ditemukan',
                            position: 'topRight'
                        });
                        $("#tampil-tbody").empty();
                        $('#table').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            // VALIDASI TUJUAN FROM JSON
                            // var us = JSON.parse(res.user);
                            // var updet = item.updated_at.substring(0, 10);
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/regulasi/`+item.id+`/download')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`;
                                    if (editorID) {
                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`;
                                        if (adminID) {
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`;
                                        }
                                    }
                            content += `</ul></center></td><td>`; 
                            content += item.id + "</td><td>"
                                        + item.sah + "</td><td style='white-space: normal !important;word-wrap: break-word;'>"
                                        + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-primary'><u><a href='/v2/regulasi/" + item.id + "/download' target='_blank'>" + item.judul + "</a></u></h6><small class='text-truncate text-muted' style='white-space: normal !important;word-wrap: break-word;'>"
                                        if (item.unit) {
                                            content += item.unit;  
                                        } else {
                                            content += '-';
                                        }
                            content += "</small></div></div></td><td>";
                                        for(i = 0; i < res.unit.length; i++){
                                            if (res.unit[i].id == item.pembuat) {
                                                content += res.unit[i].nama;
                                            }
                                        }
                            content += "</td><td>" + item.updated_at + "</td></tr>";
                            $('#tampil-tbody').append(content);
                        });
                        $('#table').DataTable(
                        {
                            order: [[5, "desc"]],
                            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                            displayLength: 10,
                            lengthMenu: [10, 25, 50, 75, 100, 200, 500, 1000],
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
                                    filename: 'Regulasi'
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
                            ],
                        },
                        );
                        $("div.head-label").html('<h5 class="card-title mb-0">Hasil Pencarian Regulasi</h5>');
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Data pencarian tidak ditemukan, ulangi sekali lagi.',
                            position: 'topRight'
                        });
                        $("#tampil-tbody").append(`<tr><td colspan="7"><center>No data available in table</center></td></tr>`);
                    }
                }
            );
        }

        function tambah() {
            $('jns_regulasi').val('').select2().change();
            $("#tgl").val('');
            $('pembuat').val('').select2().change();
            $("#judul").val('');
            $("#unit").val('');
            $("#filex").val('');
            $.ajax(
            {
                url: "/api/regulasi/showtambah",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    res.forEach(item => {
                        $("#pembuat").append(`
                            <option value="${item.id}">${item.nama}</option>
                        `);
                    });
                }
            });
            $('#tambah').modal('show');
        }
        
        function prosesTambah() {
            $("#btn-upload").prop('disabled', true);
            $("#btn-upload").find("i").toggleClass("fa-save fa-sync fa-spin");
            
            var jns_regulasi    = $("#jns_regulasi").val();
            var tgl             = $("#tgl").val();
            var pembuat         = $("#pembuat").val();
            var judul           = $("#judul").val();
            var unit            = $("#unit").val();
            var filex           = $('#filex')[0].files.length;

            if (jns_regulasi == "" || tgl == "" || pembuat == "" || judul == "" || unit == "" || filex == 0) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon lengkapi semua data terlebih dahulu dan pastikan tidak ada yang kosong',
                    position: 'topRight'
                });
            } else {
                var fd = new FormData();
    
                // Get the selected file
                var files = $('#filex')[0].files;
                console.log(files);
                var judul = $("#judul").val();
                fd.append('file',files[0]);
    
                fd.append('jns_regulasi',$("#jns_regulasi").val());
                fd.append('tgl',$("#tgl").val());
                fd.append('pembuat',$("#pembuat").val());
                fd.append('judul',judul);
                fd.append('unit',$("#unit").val());
    
                // AJAX request 
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('regulasi.tambah')}}",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res){
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'REGULASI - '+judul+' berhasil ditambah',
                            position: 'topRight'
                        });
                        if (res) {
                            $('#tambah').modal('hide');
                            cari();
                        }
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                        iziToast.error({
                            title: 'Error '+res.status+' - '+res.statusText+'!',
                            message: res.responseJSON,
                            position: 'topRight'
                        });
                    }
                });
            }
            
            $("#btn-upload").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-upload").prop('disabled', false);
        }

        function showUbah(id) {
            $.ajax(
            {
                url: "/api/regulasi/showubah/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // var dt = new Date(res.show.tanggal).toJSON().slice(0,19);
                    var sah = moment(res.show.sah).format('Y-MM-DD');
                    document.getElementById('berkas_regulasi').innerHTML = "<h6><a href='/v2/regulasi/"+res.show.id+"/download' target='_blank'>"+res.show.title+"</a></h6>";
                    document.getElementById('upload_ulang').innerHTML = `<input type='file' id="filex_edit" name='filex_edit' class="form-control" accept="application/pdf">`;
                    $("#id_edit").val(res.show.id);
                    
                    // INIT DATE EDIT
                    var a = document.querySelector("#tgl_edit");
                    // var tgl_push = moment(res.show.sah).format('Y-MM-DD');
                    a.flatpickr({
                        enableTime: 0,
                        minuteIncrement: 1,
                        defaultDate: res.show.sah,
                        time_24hr: true,
                    })

                    $("#judul_edit").val(res.show.judul);
                    $("#unit_edit").val(res.show.unit);
                    $("#jns_regulasi_edit").find('option').remove();
                    $("#jns_regulasi_edit").append(`
                        <option value="1" ${res.show.jns_regulasi == 1 ? "selected":""}>Kebijakan</option>
                        <option value="2" ${res.show.jns_regulasi == 2 ? "selected":""}>Panduan</option>
                        <option value="3" ${res.show.jns_regulasi == 3 ? "selected":""}>Pedoman</option>
                        <option value="4" ${res.show.jns_regulasi == 4 ? "selected":""}>Program</option>
                        <option value="5" ${res.show.jns_regulasi == 5 ? "selected":""}>SPO</option>
                        <option value="6" ${res.show.jns_regulasi == 6 ? "selected":""}>PPK</option>
                    `);
                    $("#pembuat_edit").find('option').remove();
                    res.unit.forEach(pounch => {
                        $("#pembuat_edit").append(`
                            <option value="${pounch.id}" ${res.show.pembuat == pounch.id ? "selected":""}>${pounch.nama}</option>
                        `);
                    });
                    $('#ubah').modal('show');
                }
            });
        }

        function prosesUbah() {
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");
            
            var id_edit         = $("#id_edit").val();
            var jns_regulasi    = $("#jns_regulasi_edit").val();
            var tgl             = $("#tgl_edit").val();
            var pembuat         = $("#pembuat_edit").val();
            var judul           = $("#judul_edit").val();
            var unit            = $("#unit_edit").val();
            var filex           = $('#filex_edit')[0].files.length;
            
            if (jns_regulasi == "" || tgl == "" || pembuat == "" || judul == "" || unit == "") {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon lengkapi kolom pengisian wajib *',
                    position: 'topRight'
                });
            } else {
                var fd = new FormData();

                if (filex == 0) {
                    fd.append('file',null);
                } else {
                    // Get the selected file
                    var files = $('#filex_edit')[0].files;
                    console.log(files);
                    var judul = $("#judul_edit").val();
                    fd.append('file',files[0]);
                }
    
                fd.append('id_edit',$("#id_edit").val());
                fd.append('jns_regulasi',$("#jns_regulasi_edit").val());
                fd.append('tgl',$("#tgl_edit").val());
                fd.append('pembuat',$("#pembuat_edit").val());
                fd.append('judul',judul);
                fd.append('unit',$("#unit_edit").val());

                // AJAX request 
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('regulasi.ubah') }}",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res){
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'REGULASI ' + judul + ' berhasil diperbarui pada '+res,
                            position: 'topRight'
                        });
                        if (res) {
                            $('#ubah').modal('hide');
                            cari();
                        }
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                    }
                });
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
                    url: "/api/regulasi/"+id,
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Berkas telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        cari();
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

        function bersih() {
            $('#search_regulasi').val('').trigger('change');
            $('#search_waktu').val('');
            $('#search_pembuat').val('').trigger('change');
            $("#show_table").prop('hidden', true);
        }
        
        function showTotal() {
        $('#info').modal('show');
        $.ajax(
            {
            url: "/api/regulasi/totalregulasi",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#count_kebijakan").text(res.totkebijakan);
                $("#count_panduan").text(res.totpanduan);
                $("#count_pedoman").text(res.totpedoman);
                $("#count_program").text(res.totprogram);
                $("#count_spo").text(res.totspo);
                // $("#count_ppk").text(res.ppk);
                $("#count_total").text(res.total);
            }
            }
        );
        }
    </script>
@endsection
