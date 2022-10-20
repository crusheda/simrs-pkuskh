@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrasi /</span> RKA
</h4>
  
@if(session('message'))
<div class="alert alert-primary alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
  <p class="mb-0">{{ session('message') }}</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if($errors->count() > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
  <p class="mb-0">
    <ul>
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif

<div class="card card-action mb-4">
  <div class="d-flex align-items-end row">
    <div class="col-sm-6">
      <div class="card-body">
        <h5 class="card-title text-primary">Rencana Kerja Anggaran</h5>
        <p class="mb-4">Segera <span class="fw-bold">Upload</span> RKA anda sebelum Tanggal 22 Oktober 2022</p>

        <a href="javascript:;" class="btn btn-primary" value="animate__jackInTheBox" id="btn-tambah" onclick="tambah()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Laporan Bulanan"><i class="fas fa-plus"></i>&nbsp;&nbsp;Form Upload</a>
      </div>
    </div>
    <div class="col-sm-6 text-center text-sm-left">
      <div class="card-body pb-0 px-0 px-md-4">
        <img src="{{ asset('assets-new/img/illustrations/shopping-girl-light.png') }}" height="140" alt="View Badge User">
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5 col-lg-5 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Payment Data</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="paymentDataList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="paymentDataList">
            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
            <a class="dropdown-item" href="javascript:void(0);">Last Week</a>
            <a class="dropdown-item" href="javascript:void(0);">24 Hours</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <small class="text-muted">Price</small>
        <div class="d-flex align-items-center mb-3">
          <h5 class="text-primary me-3 mb-0">$455.60</h5>
          <span class="badge bg-label-primary">35% OFF</span>
        </div>
        <form id="paymentMethodForm" class="row g-3" onsubmit="return false">
          <div class="col-12">
            <small class="text-muted d-block mb-2">Choose payment method:</small>
            <div class="row gy-3 text-nowrap">
              <div class="col">
                <div class="form-check custom-option custom-option-basic">
                  <label class="form-check-label custom-option-content py-2" for="customRadioPaypal">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioPaypal" checked />
                    <span class="custom-option-header pb-0">
                      <span>Paypal</span>
                    </span>
                  </label>
                </div>
              </div>
              <div class="col">
                <div class="form-check custom-option custom-option-basic">
                  <label class="form-check-label custom-option-content py-2" for="customRadioCC">
                    <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioCC" />
                    <span class="custom-option-header pb-0">
                      <span>Credit Card</span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label w-100" for="paymentAddCard">Card Number</label>
            <div class="input-group input-group-merge">
              <input id="paymentAddCard" name="paymentAddCard" class="form-control credit-card-payment" type="text" placeholder="1356 3215 6548 7898" aria-describedby="paymentAddCard2" />
              <span class="input-group-text cursor-pointer p-1" id="paymentAddCard2"><span class="card-payment-type"></span></span>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="paymentAddCardExpiryDate">Exp. Date</label>
            <input type="text" id="paymentAddCardExpiryDate" class="form-control expiry-date-payment" placeholder="MM/YY" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="paymentAddCardCvv">CVV Code</label>
            <div class="input-group input-group-merge">
              <input type="text" id="paymentAddCardCvv" class="form-control cvv-code-payment" maxlength="3" placeholder="654" />
              <span class="input-group-text cursor-pointer" id="paymentAddCardCvv2"><i class="bx bx-help-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Card Verification Value"></i></span>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label" for="paymentAddCardName">Name</label>
            <input type="text" id="paymentAddCardName" class="form-control" placeholder="John Doe" />
          </div>
          <div class="col-12">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="defaultCheck3">
              <label class="form-check-label" for="defaultCheck3">Save card?</label>
            </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary w-100 d-grid">Add Card</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-7 col-lg-7 mb-md-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Team Members</h5>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="teamMemberList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th>Name</th>
              <th>Project</th>
              <th>Task</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="../../assets/img/avatars/17.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Nathan Wagner</h6><small class="text-truncate text-muted">iOS Developer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-primary rounded-pill text-uppercase">Zipcar</span></td>
              <td><small class="fw-semibold">87/135</small></td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="dropdown"><a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                      <a href="javascript:;" class="dropdown-item">Duplicate</a>
                      <div class="dropdown-divider"></div>
                      <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="../../assets/img/avatars/8.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Emma Bowen</h6><small class="text-truncate text-muted">UI/UX Designer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-danger rounded-pill text-uppercase">Bitbank</span></td>
              <td><small class="fw-semibold">320/440</small></td>
              <td>
                <div class="chart-progress" data-color="danger" data-series="85"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded-circle bg-label-warning">AM</span>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Adrian McGuire</h6><small class="text-truncate text-muted">PHP Developer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-warning rounded-pill text-uppercase">Payers</span></td>
              <td><small class="fw-semibold">50/82</small></td>
              <td>
                <div class="chart-progress" data-color="warning" data-series="73"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Alma Gonzalez</h6><small class="text-truncate text-muted">Product Manager</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-info rounded-pill text-uppercase">Brandi</span></td>
              <td><small class="fw-semibold">98/260</small></td>
              <td>
                <div class="chart-progress" data-color="info" data-series="61"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="../../assets/img/avatars/11.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Allan kristian</h6><small class="text-truncate text-muted">Frontend Designer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill text-uppercase">Crypter</span></td>
              <td><small class="fw-semibold">690/760</small></td>
              <td>
                <div class="chart-progress" data-color="success" data-series="77"></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>$(document).ready( function () {
  // $("html").addClass('layout-menu-collapsed');

  // SELECT2
  var t = $(".select2");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  })
  
  $.ajax(
    {
      url: "/api/rka/table",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        $("#tampil-tbody").empty();
        var date = getDateTime();
        res.show.forEach(item => {
            var updet = item.updated_at.substring(0, 10);
            content = `<tr id="data`+item.id+`"><td>`;
                    if(item.tgl_verif != null) {
                      content += `<center><i class="fa-fw fas fa-check nav-icon text-primary"></i></center>`;
                    }
            content += `</td><td>`+item.updated_at+`</td>
                        <td>`+item.judul+`</td>
                        <td>`+item.bln+` / `+item.thn+`</td><td>`;
                        if (item.ket != null) {
                          content += item.ket;
                        }
            content += `</td><td><center>
                        <div class='btn-group'>
                          <button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button>
                          <ul class='dropdown-menu dropdown-menu-end'>
                            <li><a href='javascript:void(0);' class='dropdown-item text-success' onclick="window.location.href='{{ url('v2/laporan/bulanan/`+item.id+`') }}'"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>`;
                            if(item.ket_verif != null) {
                              content += `<li><a href="javascript:void(0); class='dropdown-item text-info' onclick="ketLihat(`+item.id+`)"><i class="fa-fw fas fa-sticky-note nav-icon"></i> Keterangan</a></li>`;
                            } else {
                              content += `<li><a href="javascript:void(0);" class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-sticky-note nav-icon"></i> Keterangan</a></li>`;
                            }
                            if(updet == date) {
                              content += `<li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                          <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            } else {
                              content += `<li><a href="javascript:void(0);" class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                          <li><a href='javascript:void(0);' class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                            }
            content += `</ul></div></center></td></tr>`;
            $('#tampil-tbody').append(content);
        });
        $('#table').DataTable(
          {
            order: [[1, "desc"]],
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
                    filename: 'Laporan Bulanan'
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
            columnDefs: [
                { targets: 0, orderable: !1,searchable: !1, },
                { targets: 5, orderable: !1,searchable: !1, },
                // { targets: 6, visible: false },
                // { targets: 9, visible: false },
                // { targets: 10, visible: false },
                // { targets: 11, visible: false },
                // { targets: 12, visible: false },
                // { targets: 16, visible: false },
            ],
          },
        );
        $("div.head-label").html('<h5 class="card-title mb-0">Daftar Laporan Anda</h5>');
      }
    }
  );
  
});
</script>
@endsection