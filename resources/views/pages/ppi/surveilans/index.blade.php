@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Laporan / PPI /</span> Surveilans
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
                    <a class="btn btn-primary text-white" href="{{ route('surveilans.create') }}">
                        <i class="bx bx-plus scaleX-n1-rtl"></i>
                        <span class="align-middle">Tambah</span>
                    </a>
                    {{-- <button type="button" class="btn btn-label-warning" data-bs-toggle="tooltip" data-bs-offset="0,4"
                        data-bs-placement="bottom" data-bs-html="true"
                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="refresh()">
                        <i class="fa-fw fas fa-sync nav-icon"></i></button> --}}
                </div>
                <small>&nbsp;&nbsp;Sistem masih dalam tahap Uji Coba oleh Developer</small>
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
        <hr style="margin-top:-5px">
        <div class="collapse show" style="margin-top:-20px">
            <div class="card-datatable table-responsive">
                <table id="table" class="table table-striped display">
                    <thead>
                        <tr>
                            <th class="cell-fit">
                                <center></center>
                            </th>
                            <th class="cell-fit">ID</th>
                            <th>RM</th>
                            <th>NAMA</th>
                            <th>TGL MASUK</th>
                            <th>JENIS SURVEILANS</th>
                            <th>UPDATE</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary text-white" onclick="getData({{ $item->id }})">
                                    <i class="fa-fw fas fa-search nav-icon"></i> 
                                </button>
                            </td>
                            <td>{{ $item->id_surveilans }}</td>
                            <td>{{ $item->rm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tgl_masuk }}</td>
                            @if ($item->jns_surveilans == '1')
                                <td>PHLEBITIS</td>
                            @endif
                            @if ($item->jns_surveilans == '2')
                                <td>CAUTI</td>
                            @endif
                            @if ($item->jns_surveilans == '3')
                                <td>VAP</td>
                            @endif
                            @if ($item->jns_surveilans == '4')
                                <td>IDO</td>
                            @endif
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot class="bg-whitesmoke">
                        <tr>
                            <th class="cell-fit">
                                <center></center>
                            </th>
                            <th class="cell-fit">ID</th>
                            <th>RM</th>
                            <th>NAMA</th>
                            <th>TGL MASUK</th>
                            <th>JENIS SURVEILANS</th>
                            <th>UPDATE</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade animate__animated animate__lightSpeedIn" id="showData" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered modal-lg">
        <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center">
              <h5>JSON VIEWER</h5>
            </div>
            <hr>
            <p id="showJson"></p>
          </div>
        </div>
      </div>
    </div>

    <script>
        $(document).ready(function() {
            // $("html").addClass('layout-menu-collapsed');

            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "",
                    dropdownParent: e.parent()
                })
            });
            
            $('#table').DataTable(
                {
                    order: [[6, "desc"]],
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
                            filename: 'Daftar Surveilans'
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
                        // { targets: 0, orderable: !1,searchable: !1, },
                        // { targets: 4, orderable: !1 },
                        // { targets: 16, visible: false },
                    ],
                },
            );
            $("div.head-label").html('<h5 class="card-title mb-0">Daftar Surveilans</h5>');
        })
        

        // FUNCTION-FUNTCION
        function saveData() {
            $("#tambah").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                // $('#tambah').modal('hide');
                // fresh();
                // refresh();
                return true;
            });
        }

        function getData(id) {
            // AJAX GET DATA SHOW
            $.ajax(
            {
                url: "/api/laporan/ppi/surveilans/getdata/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#showData').modal('show');
                    $("#showJson").text(JSON.stringify(res,null,4));
                }
            })
        }
    </script>
@endsection
