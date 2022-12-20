@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Bridging / </span>Pilar
    </h4>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <h5 class="card-header">Masukkan Data Pasien</h5>
                <div class="row">
                    <div class="col-md-12 order-md-1 order-1">
                        <div class="card-body">
                            <form id="formAccountSettingsApiKey" method="POST" onsubmit="return false">
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="apiAccess" class="form-label">Jenis Pencarian</label>
                                        <select id="apiAccess" class="select2 form-select">
                                            <option value="">Pilih</option>
                                            <option value="1">Pelayanan Akomodasi Terakhir</option>
                                            <option value="2">Transaksi Pembayaran</option>
                                            <option value="3">Riwayat Kunjung Pasien</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="apiKey" class="form-label">Nomor Rekam Medik</label>
                                        <input type="text" class="form-control" id="rm"
                                            placeholder="Masukkan No. RM Pasien" />
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-2 w-100"><i class="fas fa-stethoscope"></i>&nbsp;&nbsp;Tampilkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 order-md-0 order-0">
                        <div class="text-center mt-4 mx-3 mx-md-0">
                            <img src="{{ asset('assets-new/img/illustrations/sitting-girl-with-laptop-light.png') }}"
                                class="img-fluid" alt="Api Key Image" width="350"
                                data-app-light-img="illustrations/sitting-girl-with-laptop-light.png"
                                data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.html">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            {{-- <button type="button" class="btn btn-label-primary mb-3"
                onclick="window.location.href='{{ route('ipsrs.index') }}'"><i class="bx bx-stats me-1"></i>
                Status</button> --}}
            <div class="card card-action mb-4">
                <div class="card-header">
                    <div class="card-action-title">
                        <h6>Kami sedang dalam proses pengembangan...</h6>
                    </div>
                    <div class="card-action-element">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="javascript:void(0);" class="card-expand"><i
                                        class="tf-icons bx bx-fullscreen"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-datatable table-responsive text-nowrap">
                    {{-- <table id="table" class="dt-column-search table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <center>AKSI</center>
                                </th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>LOKASI</th>
                                <th>TGL PENGADUAN</th>
                                <th>KET PENGADUAN</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody">
                            <tr>
                                <td colspan="13">
                                    <center>No data available in table</center>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    <center>AKSI</center>
                                </th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>LOKASI</th>
                                <th>TGL PENGADUAN</th>
                            </tr>
                        </tfoot>
                    </table> --}}
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
            })
            $("#filter").daterangepicker({
                ranges: {
                    Today: [moment(), moment().add(1, 'days')],
                    Yesterday: [moment().subtract(1, "days"), moment()],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1,
                        "month").endOf("month")]
                },
                opens: isRtl ? "left" : "right"
            });
        });

        // FUNCTION
        function filterRiwayat() {
            var getFilter = $("#filter").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/laporan/pengaduan/ipsrs/filter',
                dataType: 'json',
                data: {
                    filter: getFilter,
                },
                success: function(res) {
                    if (res) {
                        $("#tampil-tbody").empty();
                        $('#table').DataTable().clear().destroy();
                        res.forEach(item => {
                            if (item.unit) {
                                try {
                                    var un = JSON.parse(item.unit);
                                } catch (e) {
                                    var un = item.unit;
                                }
                            }
                            content =
                                `<tr id='data"+ item.id +"'><td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>` +
                                `<li><a class='dropdown-item text-warning' href='/v2/laporan/pengaduan/ipsrs/detail/` +
                                item.id + `'><i class='bx bx-edit scaleX-n1-rtl'></i> Lihat</a></li>` +
                                `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="showLampiran(` +
                                item.id +
                                `)"><i class='bx bx-image scaleX-n1-rtl'></i> Lampiran</a></li>` +
                                `</ul></div</center></td><td>`;
                            content += item.nama + "</td><td>" +
                                un + "</td><td>" +
                                item.lokasi + "</td><td>" +
                                item.tgl_pengaduan + "</td><td>" +
                                item.ket_pengaduan + "</td><td>" +
                                item.tgl_diterima + "</td><td>" +
                                item.estimasi + "</td><td>" +
                                item.ket_diterima + "</td><td>" +
                                item.tgl_dikerjakan + "</td><td>" +
                                item.ket_dikerjakan + "</td><td>" +
                                item.tgl_selesai + "</td><td>";
                            if (item.ket_penolakan != null) {
                                content += item.ket_penolakan;
                            } else {
                                content += item.ket_selesai;
                            }
                            content += `</td></tr>`;
                            $('#tampil-tbody').append(content);
                        });
                        $('#table').DataTable({
                            order: [
                                [0, "desc"]
                            ],
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
                                        attr: {
                                            id: 'exportButton'
                                        },
                                        sheetName: 'data',
                                        title: '',
                                        filename: 'Data Pasien PILAR'
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
                                    }, ]
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
                        }, );
                        $("div.head-label").html(
                            '<h5 class="card-title mb-0">Hasil Filter Pengaduan IPSRS</h5>');
                    }
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Data Laporan Berhasil Di Filter',
                        position: 'topRight'
                    });
                }
            });
        }

        function showLampiran(id) {
            Swal.fire({
                // title: 'Lampiran ID : '+id,
                // text: '',
                imageUrl: '/v2/laporan/pengaduan/ipsrs/' + id,
                // imageWidth: 400,
                imageHeight: 275,
                imageAlt: 'Lampiran',
                reverseButtons: true,
                showDenyButton: false,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: `<i class="fa fa-times"></i> Tutup`,
                confirmButtonText: `<i class="fa fa-download"></i> Download`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/v2/laporan/pengaduan/ipsrs/" + id;
                }
            })
        }
    </script>
@endsection
