@extends('layouts.simrsmuv2')

@section('content')

    <style>
        .help-center-header {
            background: url("/assets-new/img/pages/header.png");
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            min-height: 380px
        }

        .help-center-header .input-wrapper {
            position: relative;
            width: 100%;
            max-width: 55%
        }

        @media(max-width: 575.98px) {
            .help-center-header .input-wrapper {
                max-width: 70%
            }
        }

        .light-style .help-center-bg-alt {
            background-color: #f0f2f4
        }

        .dark-style .help-center-bg-alt {
            background-color: #313249
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
    </style>

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

    <div class="card mb-4" id="loading">
        <div class="help-center-header d-flex flex-column justify-content-center align-items-center">
            <center>
                <div class="sk-fold sk-primary">
                    <div class="sk-fold-cube"></div>
                    <div class="sk-fold-cube"></div>
                    <div class="sk-fold-cube"></div>
                    <div class="sk-fold-cube"></div>
                </div>
            </center>
            <br>
            <h5>Memproses Data...</h5>
        </div>
    </div>
    <div class="card mb-4" id="doneloading" hidden>
        <div class="help-center-header d-flex flex-column justify-content-center align-items-center">
            <h3 class="text-center">Regulasi apa yang Anda cari ?</h3>
            <div class="input-wrapper my-3 input-group input-group-merge">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i
                            class="bx bx-search-alt bx-xs text-muted"></i></span>
                    <input type="text" class="form-control form-control-lg" placeholder="Kolom Pencarian" width="100%"
                        aria-label="Search" aria-describedby="basic-addon1" minlength="3" id="input_cari" />
                    <button class="btn btn-label-secondary" type="button" onclick="bersih()"><i
                            class="tf-icons bx bx-eraser"></i> Bersihkan</button>
                </div>
            </div>
            <p class="text-center px-3 mb-0"><i>Kata kunci (Kebijakan, Program, Panduan, Program, SPO)</i></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 order-1">
            <div class="card card-action h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-action-title">
                        <h5 class="">Capaian Regulasi</h5>
                        <small>Total Akumulasi</small>
                    </div>
                    <div class="card-action-element">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="javascript:void(0);" class="card-collapsible"><i
                                        class="tf-icons bx bx-chevron-up"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="collapse">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3" style="margin-top:-30px">
                            <div class="d-flex flex-column gap-1">
                                {{-- <h2 class="mb-2" id="total_regulasi"><i class="fa fa-spinner fa-spin fa-fw"></i></h2> --}}
                                <span>Diagram</span>
                            </div>
                            <div id="chart"></div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i class='bx bx-book'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Kebijakan</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold" id="totkebijakan"></small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class='bx bx-book'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Pedoman</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold" id="totpedoman"></small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning"><i class='bx bx-book'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Panduan</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold" id="totpanduan"></small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger"><i class='bx bx-book'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Program</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold" id="totprogram"></small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class='bx bx-book'></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">SPO</h6>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold" id="totspo"></small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 order-0 mb-4">
            <div class="card">
                <div class="card-header">
                    <center>
                        <h5 class="vertical-center">Kami sedang dalam perbaikan sistem</h5>
                    </center>
                </div>
                <div class="table-responsive" hidden>
                    <table id="table" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>KEGIATAN</th>
                                <th>KETUA</th>
                                <th>WAKTU</th>
                                <th>LOKASI</th>
                                <th>KET</th>
                                <th>UPDATE</th>
                                <th>USER</th>
                                <th>
                                    <center>#</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody">
                            <tr>
                                <td colspan="9">
                                    <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-whitesmoke">
                            <tr>
                                <th>ID</th>
                                <th>KEGIATAN</th>
                                <th>KETUA</th>
                                <th>WAKTU</th>
                                <th>LOKASI</th>
                                <th>KET</th>
                                <th>UPDATE</th>
                                <th>USER</th>
                                <th>
                                    <center>#</center>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";
        $(document).ready(function() {
            $("html").addClass('layout-menu-collapsed');

            // AUTOCOMPLETE LOKASI
            var path = "{{ route('ac.regulasi.cari') }}";
            $('#input_cari').typeahead({
                source: function(query, process) {
                    return $.get(path, {
                        cari: query
                    }, function(data) {
                        return process(data);
                    });
                },
                afterSelect: function(data) {
                    window.location.replace('regulasi/' + data);
                }
            });

            // Showing Numb Regulasi
            $.ajax({
                url: "/api/regulasi/totalregulasi",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#total_regulasi").empty();
                    $("#total_regulasi").text(res.total);
                    $("#totkebijakan").text(res.totkebijakan);
                    $("#totpedoman").text(res.totpedoman);
                    $("#totpanduan").text(res.totpanduan);
                    $("#totprogram").text(res.totprogram);
                    $("#totspo").text(res.totspo);
                    $("#btn-tambah").prop('disabled', false);
                    $("#btn-tambah").find("i").removeClass("fa-sync fa-spin").addClass("fa-plus");

                    // CHART
                    // Initialized
                    let o, r, e, t, s, i;
                    i = (isDarkStyle ? (o = config.colors_dark.cardColor,
                        r = config.colors_dark.headingColor,
                        e = config.colors_dark.bodyColor,
                        t = config.colors_dark.textMuted,
                        config.colors_dark) : (o = config.colors.cardColor,
                        r = config.colors.headingColor,
                        e = config.colors.bodyColor,
                        t = config.colors.textMuted,
                        config.colors)).borderColor;

                    // Charting
                    var options = {
                        chart: {
                            height: 165,
                            width: 130,
                            type: "donut"
                        },
                        labels: ["Kebijakan", "Pedoman", "Panduan", "Program", "SPO"],
                        series: [res.totkebijakan, res.totpedoman, res.totpanduan, res.totprogram,
                            res.totspo
                        ],
                        colors: o,
                        stroke: {
                            width: 5,
                            colors: o
                        },
                        dataLabels: {
                            enabled: !1,
                            formatter: function(o, r) {
                                return parseInt(o)
                            }
                        },
                        legend: {
                            show: !1
                        },
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                right: 15
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: "75%",
                                    labels: {
                                        show: !0,
                                        value: {
                                            fontSize: "1.5rem",
                                            fontFamily: "Public Sans",
                                            color: r,
                                            offsetY: -15,
                                            formatter: function(o) {
                                                return parseInt(o)
                                            }
                                        },
                                        name: {
                                            offsetY: 20,
                                            fontFamily: "Public Sans"
                                        },
                                        total: {
                                            show: !0,
                                            fontSize: "0.8125rem",
                                            color: o,
                                            label: "Regulasi",
                                            // formatter: function(o) {
                                            //     return "38%"
                                            // }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();
                },
                error: function(res) {}
            });

            // If All Page 100% Loadly
            $("#loading").empty();
            $("#doneloading").prop("hidden", false);
        })

        function bersih() {
            $('#input_cari').val('');
        }
    </script>
@endsection
{{-- iziToast.error({
    title: 'Pesan Galat!',
    message: 'Mohon maaf, Anda tidak mempunyai HAK untuk menambah Laporan Bulanan',
    position: 'topRight'
}); --}}
