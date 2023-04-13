@extends('layouts.simrsmuv2')

@section('content')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Bridging /</span> BPJS
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
                <h5>Daftar Antrean Pasien</h5>
            </div>
            <div class="card-action-element">
                <div class="btn-group">
                    <a type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#bridging">
                        <i class="fa-fw fas fa-info nav-icon"></i>
                    </a>
                    <button type="button" class="btn btn-label-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="ajaxBPJS()" disabled>
                        <i class="fa-fw fas fa-sync nav-icon"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Pilih Tanggal Pemeriksaan</label>
                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tglAntrean" />

                </div>
            </div>
            {{-- <button type="button" class="btn btn-label-primary mt-4" id="btn-cari-show" onclick="cari()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Tampilkan Data Antrean"><i class="fa-fw fas fa-search nav-icon"></i> Submit</button> --}}
            {{-- <button type="button" class="btn btn-label-secondary mt-4" onclick="bersih()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Bersihkan Kolom Pencarian"><i class="fa-fw fas fa-eraser nav-icon"></i></button> --}}
            <div class="card-datatable table-responsive text-nowrap" id="show_table" hidden>
                <hr style="margin-top: -15px">
                <table class="table table-hover table-stripped" id="table">
                    <thead>
                        <tr>
                            <th>NO RM</th>
                            <th>kode booking</th>
                            <th>poli - antrean</th>
                            <th>Kepesertaan</th>
                            <th>Status Pasien</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                </table>
            </div>
            {{-- <p id="response"></p> --}}
        </div>
    </div>
    {{-- class="cell-fit" --}}

    {{-- MODAL --}}
    <div class="modal fade" id="bridging" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Bridging BPJS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            Cons ID : {{ $list['consid'] }} <br>
                            Secret Key : {{ $list['secretkey'] }} <br>
                            User Key : {{ $list['userkey'] }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-label-secondary" href="javascript:void(0);" data-bs-dismiss="modal"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // $("html").addClass('layout-menu-collapsed');
            changeDate();
            // DATEPICKER
            const l = $('.flatpickr');
            var now = moment().locale('id').format('Y-MM-DD HH:mm');
            l.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                defaultDate: now,
                time_24hr: true,
            })
            
            // ajaxBPJS();
            $('#tglAntrean').change(function() { 
                $("#show_table").prop('hidden', false);
                // $('#response').empty();
                console.log(this.value);
                $.ajax(
                    {
                        url: "/api/bpjs/bridging/antrean/antreanbytgl/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            console.log(res);
                            $("#tampil-tbody").empty();
                            $('#table').DataTable().clear().destroy();
                            if (res.length > 0) {
                                res.forEach(item => {
                                    // var createdtime = new Date(item.createdtime * 1000).toString();
                                    content = ``;
                                    if (item.status == 'Selesai dilayani') {
                                        content += `<tr style="background-color: rgb(158, 255, 171)">`;
                                    } else {
                                        if (item.status == 'Belum dilayani') {
                                            content += `<tr style="background-color: rgb(252, 248, 169)">`;
                                        } else {
                                            if (item.status == 'Sedang dilayani') {
                                                content += `<tr style="background-color: rgb(136, 225, 255)">`;
                                            } else {
                                                if (item.status == 'Batal') {
                                                    content += `<tr style="background-color: rgb(249, 195, 195)">`;
                                                }
                                            }
                                        }
                                    }
                                    content += `
                                            <td>`+item.norekammedis+`</td>
                                            <td>`+item.kodebooking+`</td>
                                            <td>`+item.kodepoli+ ` <kbd>` +item.noantrean+ `</kbd></td>
                                            <td>`+item.ispeserta+ ` <kbd>` +item.sumberdata+ `</kbd></td>
                                            <td>`+item.status+`</td>
                                        </tr>
                                    `;
                                    $('#tampil-tbody').append(content);
                                });
                                $('#table').DataTable(
                                {
                                    order: [[3, "desc"]],
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
                                            filename: 'Berkas'
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
                                        // { targets: 0, orderable: !1,searchable: !1, },
                                        // { targets: 1, orderable: !1,searchable: !1, },
                                        // { targets: 5, orderable: !1,searchable: !1, },
                                        // { targets: 6, visible: false },
                                    ],
                                });
                                $("div.head-label").html('<h5 class="card-title mb-0">Tabel Pasien</h5>');
                            } else {
                                
                            }
                        }
                    }
                );
            });
        });

        // Show Function
        function ajaxBPJS() {
            $('#response').empty();
            $.ajax(
                {
                    url: "/api/bpjs/bridging/antrean/data",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        console.log(res);

                        $('#response').append(content);
                    }
                }
            );
        }

        function changeDate() {
            var a = new Date(1675323360000 * 1000);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
            console.log(time);
        }
    </script>
@endsection