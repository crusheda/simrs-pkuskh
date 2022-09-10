@extends('layouts.simrsmuv2')

@section('content')
{{-- Sistem Tracking --}}
<link href="{{ asset('css/tracking.css') }}" rel="stylesheet" /> 

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Laporan / Pengaduan /</span> IPSRS
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
  <div class="d-flex justify-content-around flex-wrap my-4 mb-5">
    <div class="d-flex align-items-start me-4 mt-3 gap-3">
      <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
      <div>
        <span>Total</span>
        <h5 class="mb-0">{{ $list['total'] }}</h5>
      </div>
    </div>
    <div class="d-flex align-items-start mt-3 gap-3">
      <span class="badge p-2 rounded" style="background-color: rebeccapurple"><i class='bx bx-calendar-week bx-sm'></i></span>
      <div>
        <span>Diverifikasi</span>
        <h5 class="mb-0">{{ $list['totalmasukpengaduan'] }}</h5>
      </div>
    </div>
    <div class="d-flex align-items-start mt-3 gap-3">
      <span class="badge p-2 rounded" style="background-color: salmon"><i class='bx bx-calendar-check bx-sm'></i></span>
      <div>
        <span>Diterima</span>
        <h5 class="mb-0">{{ $list['totaldiverifikasi'] }}</h5>
      </div>
    </div>
    <div class="d-flex align-items-start mt-3 gap-3">
      <span class="badge p-2 rounded" style="background-color: orange"><i class='bx bx-wrench bx-sm'></i></span>
      <div>
        <span>Dikerjakan</span>
        <h5 class="mb-0">{{ $list['totaldikerjakan'] }}</h5>
      </div>
    </div>
    <div class="d-flex align-items-start mt-3 gap-3">
      <span class="badge p-2 rounded" style="background-color: turquoise"><i class='bx bx-coffee bx-sm'></i></span>
      <div>
        <span>Selesai</span>
        <h5 class="mb-0">{{ $list['totalselesai'] }}</h5>
      </div>
    </div>
    <div class="d-flex align-items-start mt-3 gap-3">
      <span class="badge p-2 rounded" style="background-color: red"><i class='bx bx-calendar-x bx-sm'></i></span>
      <div>
        <span>Ditolak</span>
        <h5 class="mb-0">{{ $list['totalditolak'] }}</h5>
      </div>
    </div>
  </div>
</div>
<div class="card card-action mb-4">
  <div class="card-header">
    <div class="card-action-title">
      <div class="btn-group">
        <a class="btn btn-primary" href="{{ route('ipsrs.history') }}" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-history bx-xs' ></i> <span>Menampilkan Semua Data Pengaduan IPSRS</span>">
          <i class="bx bx-history scaleX-n1-rtl"></i>
          <span class="align-middle">Riwayat</span>
        </a>
        {{-- <a class="btn btn-info text-white" onclick="info()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-info-circle bx-xs' ></i> <span>Informasi Tambahan</span>">
          <i class="bx bx-info-circle scaleX-n1-rtl"></i>
        </a>
        <a class="btn btn-dark text-white" onclick="berulang()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<i class='bx bx-refresh bx-xs' ></i> <span>Tambah Risiko Berulang</span>">
          <i class="bx bx-refresh scaleX-n1-rtl"></i>
          <span class="align-middle">Risiko Berulang</span>
        </a> --}}
      </div>
    </div>
    <div class="card-action-element">
      <ul class="list-inline mb-0">
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
        </li>
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="collapse show">
    <div class="card-datatable table-responsive text-nowrap">
      <table id="table" class="dt-column-search table table-striped">
        <thead>
          <tr>
            <th><center>#</center></th>
            <th>NAMA</th>
            <th>UNIT</th>
            <th>LOKASI</th>
            <th>STATUS</th>
            <th>TGL PENGADUAN</th>
          </tr>
        </thead>
        <tbody style="text-transform: capitalize">
          @if(count($list['show']) > 0)
            @foreach($list['show'] as $item)
            <tr>
              <td>
                <center>
                  <div class="btn-group" role="group">
                    {{-- <button type="button" class="btn btn-primary text-white btn-sm" data-toggle="modal" data-target="#track{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="TRACKING"><i class="fa fa-search"></i></button> --}}
                    @if (empty($item->filename_pengaduan))
                        <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                    @else
                        <button type="button" class="btn btn-warning btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                    @endif
                    <button onclick="window.location.href='{{ url('v2/laporan/pengaduan/ipsrs/detail/'.$item->id) }}'" type="button" class="btn btn-danger btn-sm"><i class="fa fa-wrench"></i></button>
                  </div>
                </center>
              </td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->unit }}</td>
              <td>{{ $item->lokasi }}</td>
              
              @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                <td><kbd style="background-color: turquoise">Selesai</kbd></td>
              @elseif (!empty($item->ket_penolakan))
                <td><kbd style="background-color: red">Ditolak</kbd></td>
              @elseif (empty($item->tgl_diterima))
                <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
              @elseif (empty($item->tgl_dikerjakan))
                <td><kbd style="background-color: salmon">Diterima</kbd></td>
              @elseif (empty($item->tgl_selesai))
                <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
              @endif
              
              <td>{{ $item->tgl_pengaduan }}</td>
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- MODAL START --}}
{{-- MODAL END --}}
<script>$(document).ready( function () {
  $("html").addClass('layout-menu-collapsed');

  $('#table').DataTable(
    {
      order: [[5, "desc"]],
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
              filename: 'Daftar Risiko K3'
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
          // { targets: 3, visible: false },
          // { targets: 5, visible: false },
          // { targets: 6, visible: false },
          // { targets: 9, visible: false },
          // { targets: 10, visible: false },
          // { targets: 11, visible: false },
          // { targets: 12, visible: false },
          // { targets: 16, visible: false },
      ],
    },
  );
  $("div.head-label").html('<h5 class="card-title mb-0">Pengaduan Berjalan</h5>');
});

// FUNCTION
function showLampiran(id) {
  Swal.fire({
    // title: 'Lampiran ID : '+id,
    // text: '',
    imageUrl: '/v2/laporan/pengaduan/ipsrs/'+id,
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
      window.location.href = "/v2/laporan/pengaduan/ipsrs/"+id;
    }
  })
}
</script>
@endsection