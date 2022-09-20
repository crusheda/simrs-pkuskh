@extends('layouts.simrsmuv2')

@section('content')
@hasrole('it|administrator')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrator /</span> User
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
  <div class="card-header">
    <div class="card-action-title">
      <button class="btn btn-primary" onclick="window.location.href='{{ url('v2/admin/user/create') }}'"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</button>
    </div>
    <div class="card-action-element">
      <ul class="list-inline mb-0">
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="card-datatable table-responsive text-nowrap">
    <table id="table" class="dt-column-search table table-striped">
      <thead>
        <tr>
          <th class="cell-fit">ID</th>
          <th class="cell-fit">USERNAME</th>
          <th>NAMA</th>
          <th>ROLE</th>
          <th class="cell-fit">UPDATE</th>
          <th class="cell-fit">#</th>
        </tr>
      </thead>
      <tbody>
        @if(count($list['user']) > 0)
        @foreach($list['user'] as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->nama }}</td>
            <td>
              @foreach($list['role'] as $val)
                @if ($item->id == $val->id_user)
                    <kbd>{{ $val->nama_role }}</kbd>
                @endif
              @endforeach
            </td>
            <td>{{ $item->updated_at }}</td>
            <td>
              <center>
              <div class='btn-group'>
                <button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button>
                <ul class='dropdown-menu dropdown-menu-end'>
                  <li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="window.location.href='{{ url('v2/admin/user/'.$item->id.'') }}'"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                  <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus({{ $item->id }})"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>
                </ul>
              </div>
              </center>
            </td>
        </tr>
        @endforeach
        @endif
      </tbody>
      <tfoot>
          <tr>
            <th class="cell-fit">ID</th>
            <th class="cell-fit">USERNAME</th>
            <th>NAMA</th>
            <th>ROLE</th>
            <th class="cell-fit">UPDATE</th>
            <th class="cell-fit">#</th>
          </tr>
      </tfoot>
    </table>
  </div>
</div>
@endhasrole
<script>$(document).ready( function () {
  
  $('#table').DataTable(
    {
      order: [[2, "asc"]],
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
              filename: 'User Account'
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
          // { targets: 6, visible: false },
          // { targets: 9, visible: false },
          // { targets: 10, visible: false },
          // { targets: 11, visible: false },
          // { targets: 12, visible: false },
          // { targets: 16, visible: false },
      ],
    },
  );
  $("div.head-label").html('<h5 class="card-title mb-0">Data Akun User Simrsmu</h5>');
})

function hapus(id) {
    Swal.fire({
    title: 'Apakah anda yakin?',
    text: 'Hapus Akun Pengguna ID : '+id,
    icon: 'warning',
    reverseButtons: false,
    showDenyButton: false,
    showCloseButton: false,
    showCancelButton: true,
    focusCancel: true,
    confirmButtonColor: '#FF4845',
    confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
    cancelButtonText: `<i class="fa fa-times"></i> Batal`,
    backdrop: `rgba(26,27,41,0.8)`,
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/api/admin/user/hapus/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          iziToast.success({
            title: 'Sukses!',
            message: 'Hapus Akun berhasil pada '+res,
            position: 'topRight'
          });
          window.location.reload();
        },
        error: function(res) {
          Swal.fire({
          title: `Gagal di hapus!`,
          text: 'Pada '+res,
          icon: `error`,
          showConfirmButton:false,
          showCancelButton:false,
          allowOutsideClick: true,
          allowEscapeKey: true,
          timer: 3000,
          timerProgressBar: true,
          backdrop: `rgba(26,27,41,0.8)`,
          });
        }
      }); 
    }
    })
}
</script>
@endsection