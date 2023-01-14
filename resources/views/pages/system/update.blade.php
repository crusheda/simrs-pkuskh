@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">System /</span> Update
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

    <div class="card card-action mb-4">
        <div class="card-header" style="margin-bottom: -20px">
            <div class="card-action-title">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah" value="animate__jackInTheBox">
                        <i class="bx bx-plus scaleX-n1-rtl"></i>
                        <span class="align-middle">Tambah</span>
                    </button>
                    <button type="button" class="btn btn-label-warning" onclick="refresh()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<span>Segarkan Table</span>">
                        <i class="fas fa-sync"></i>
                        <span class="align-middle">&nbsp;&nbsp;Segarkan</span>
                    </button>
                </div>
            </div>
            <div class="card-action-element">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse show">
            <div class="card-datatable table-responsive text-nowrap">
                <table id="table" class="dt-column-search table table-striped">
                    <thead>
                        <tr>
                            <th class="cell-fit"></th>
                            <th class="cell-fit">ID</th>
                            <th>STATUS</th>
                            <th>SUBJECT</th>
                            <th>ROLE</th>
                            <th>DESCRIPTION</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        <tr>
                            <td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="cell-fit"></th>
                            <th class="cell-fit">ID</th>
                            <th>STATUS</th>
                            <th>SUBJECT</th>
                            <th>ROLE</th>
                            <th>DESCRIPTION</th>
                            <th>DATE</th>
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
                <form class="form-auth-small" name="formTambah" action="{{ route('update.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Update Form&nbsp;&nbsp;&nbsp;
                    </h4>
                    <div class="card-title-elements">
                      <select class="form-select form-select-sm" name="user" required>
                        <option value="" hidden>Select Developer</option>
                        <option value="232">Yussuf Faisal</option>
                      </select>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Subject <a class="text-danger">*</a></label>
                                    <input type="text" name="judul" class="form-control" placeholder="Subject of Update News" autofocus required/>
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Role <a class="text-danger">*</a></label>
                                    <input type="text" name="role" class="form-control" placeholder="Please input who will get this" required/>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Status <a class="text-danger">*</a></label>
                                    <select class="form-control select2" name="status" required>
                                      <option value="" hidden>Select Status</option>
                                      <option value="1">Planning</option>
                                      <option value="2">Development</option>
                                      <option value="3">Pending</option>
                                      <option value="4">Complete</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea rows="3" class="form-control" name="deskripsi" placeholder="Optional"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Upload</label>
                            <input type="file" class="form-control mb-2" name="file" accept="application/pdf" disabled>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong>20 mb</strong><br>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen Scan<br>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> Dijadikan dalam Satu file <strong>PDF</strong>
                        </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Publish</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    $(document).ready( function () {
        // $("html").addClass('layout-menu-collapsed');
    
        // SELECT PICKER
        var t = $(".select2");
        t.length && t.each(function() {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>').select2({
                placeholder: "Select Status",
                dropdownParent: e.parent()
            })
        })

        // AJAX        
        $.ajax(
            {
                url: "/api/system/update/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = "<tr id='data"+ item.id +"'>";
                        content += `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-end'>`
                                + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                                + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                + `</ul></center></td><td>`
                                + item.id + `</td><td>`;
                                if (item.status == '1') { content += 'Planning'; }
                                if (item.status == '2') { content += 'Development'; }
                                if (item.status == '3') { content += 'Pending'; }
                                if (item.status == '4') { content += 'Complete'; }
                        content += "</td><td><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0 text-truncate'>" + item.judul + "</h6><small class='text-truncate text-muted'>" + item.user + "</small></div></div></td><td>";
                        content += item.deskripsi + "</td><td>"
                                + item.date + "</td><td>";
                        content += "</td></tr>";
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
                            // { targets: 5, orderable: !1 },
                            // { targets: 6, orderable: !1 },
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
    })
    </script>
@endsection
