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

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Kebijakan</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">21,459</h4>
                                <small class="text-success">(+29%)</small>
                            </div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Panduan</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">4,567</h4>
                                <small class="text-success">(+18%)</small>
                            </div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pedoman</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">19,860</h4>
                                <small class="text-danger">(-14%)</small>
                            </div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Program</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">237</h4>
                                <small class="text-success">(+42%)</small>
                            </div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>SPO</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">237</h4>
                                <small class="text-success">(+42%)</small>
                            </div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>PPK</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">237</h4>
                                <small class="text-success">(+42%)</small>
                            </div>
                            <small>Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Filter</h5>
            <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-3">
                    <label class="form-label">Jenis Regulasi <a class="text-danger">*</a></label>
                    <select class="form-control select2" id="search_regulasi" style="width: 100%" required>
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
                        <button type="button" class="btn btn-primary mt-4" onclick="cari()">Submit</button>
                        <button type="button" class="btn btn-label-secondary mt-4" onclick="bersih()">Clear</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive" id="show_table" hidden>
            <table class="datatables-users table border-top" id="table">
                <thead>
                    <tr>
                        <th class="cell-fit"></th>
                        <th class="cell-fit">ID</th>
                        <th>DISAHKAN</th>
                        <th>JUDUL</th>
                        <th>UNIT PEMBUAT</th>
                        <th>UNIT TERKAIT</th>
                        <th>UPDATE</th>
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
                        <th>DISAHKAN</th>
                        <th>JUDUL</th>
                        <th>UNIT PEMBUAT</th>
                        <th>UNIT TERKAIT</th>
                        <th>UPDATE</th>
                    </tr>
                </tfoot>
            </table>
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
        })

        function cari() {
            $("#tampil-tbody").empty();
            $("#show_table").prop('hidden', false);
            var regulasi    = $("#search_regulasi").val();
            var waktu       = $("#search_waktu").val();
            var pembuat     = $("#search_pembuat").val();
            if (regulasi == null) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Kolom Pilihan Regulasi wajib diisi',
                    position: 'topRight'
                });
            } else {
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
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Data pencarian ditemukan',
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
                                        + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                                        + `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/v2/regulasi/`+item.id+`/download')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>`
                                        + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                        + `</ul></center></td><td>`; 
                                        // if (item.user == '84') { content += 'Sri Suryani, Amd'; }
                                content += item.id + "</td><td>"
                                            + item.sah + "</td><td>"
                                            + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate text-primary'>" + item.judul + "</h6><small class='text-truncate text-muted'>"
                                            if (item.unit) {
                                                content += item.unit;  
                                            } else {
                                                content += '-';
                                            }
                                content += "</small></div></div></td><td>"
                                            + item.pembuat + "</td><td>"
                                            + item.unit + "</td><td>"
                                            + item.updated_at + "</td></tr>";
                                $('#tampil-tbody').append(content);
                            });
                            $('#table').DataTable(
                            {
                                order: [[6, "desc"]],
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
        }

        function bersih() {
            $('#search_regulasi').val('').trigger('change');
            $('#search_waktu').val('');
            $('#search_pembuat').val('').trigger('change');
            $("#show_table").prop('hidden', true);
        }
    </script>
@endsection
