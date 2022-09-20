@extends('layouts.simrsmuv2')

@section('content')
@hasrole('it|administrator')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrator / User /</span> Tambah 
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
  <h5 class="card-header d-flex align-items-center justify-content-between">
    <button class="btn btn-label-dark" onclick="window.location='{{ route('user.index') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<i class='bx bx-chevron-left bx-xs' ></i> <span>Kembali ke Halaman Sebelumnya</span>"><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Kembali</button>
    <div class="card-title mb-0" style="text-align: right;">
      <h5 class="mb-2 me-2">Form Tambah Akun</h5>
    </div>
  </h5>
  <form class="form-auth-small" name="formTambah" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Username</label>
          <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" placeholder="" required/>
            <button class="btn btn-outline-primary" type="button" onclick="verifName()">Check</button>
          </div>
          <sub>Klik Check untuk validasi ketersediaan Username</sub>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="" required/>
        </div>
      </div>
      <div class="col-md-12 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Role</label>
          <div class="select2-dark">
            <select id="role" name="role[]" class="select2 form-select" data-bs-auto-close="outside" required multiple>
              @if (count($role) > 0)
                @foreach ($role as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Password</label>
          <div class="input-group">
            <input type="password" name="password" class="form-control" id="password1" minlength="8" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" onpaste="return false" required/>
            <span id="open-password1" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
          <sub>Masukkan password minimal 8 karakter</sub>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Retype Password</label>
          <div class="input-group">
            <input type="password" name="repassword" class="form-control" id="password2" minlength="8" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" onpaste="return false" required/>
            <span id="open-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <div class="row">
      <div class="col-12 d-flex justify-content-between">
        <small><b>Bcrypt Hash Password Laravel</b></small>
        <button class="btn btn-primary" id="btn-simpan" onclick="saveData()" disabled>
          <i class="fas fa-save fa-md"></i>&nbsp;&nbsp;
          <span class="align-middle d-sm-inline-block d-none me-sm-1">Simpan</span>
        </button>
      </div>
    </div>
  </div>
  </form>
</div>
@endhasrole
<script>
$(document).ready( function () {
  $('#name').keypress(function() {
    $("#btn-simpan").prop('disabled',true);
  }).on('keydown', function(e) {
   if (e.keyCode==8)
    $("#btn-simpan").prop('disabled',true);
 });

  $('#role').select2({});
  $("#open-password1").on( "click", function() {
    var x = $("#password1");
    if (x[0].type === "password") {
      x[0].type = "text";
    } else {
      x[0].type = "password";
    }
  });
  $("#open-password2").on( "click", function() {
    var x = $("#password2");
    if (x[0].type === "password") {
      x[0].type = "text";
    } else {
      x[0].type = "password";
    }
  });
  
})

// FUNCTION
function saveData() {
  var pas1 = $("#password1").val();
  var pas2 = $("#password2").val();
  $("#formTambah").one('submit', function() {
    if (pas1 == '' && pas2 != '') {
      iziToast.error({
        title: 'Pesan Galat!',
        message: 'Mohon untuk melengkapi pengisian Password',
        position: 'topRight'
      });
      return false;
    } else {
      if (pas1 != '' && pas2 == '') {
        iziToast.error({
          title: 'Pesan Galat!',
          message: 'Mohon untuk melengkapi pengisian Password',
          position: 'topRight'
        });
        return false;
      } else {
        if (pas1 === pas2) {
          $("#btn-simpan").attr('disabled','disabled');
          $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
          return true;
        } else {
          iziToast.error({
            title: 'Pesan Galat!',
            message: 'Mohon maaf, kombinasi password tidak cocok',
            position: 'topRight'
          });
          return false;
        }
      }
    }
  });
}

function verifName() {
  var name = $("#name").val();
  $.ajax(
    {
      url: "/api/admin/user/"+name,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        if (res === 1) {
          iziToast.error({
            title: 'Pesan Galat!',
            message: 'Mohon maaf, username sudah ada, silakan coba lagi dengan username yang berbeda',
            position: 'topRight'
          });
        } else {
          iziToast.success({
            title: 'Pesan Sukses!',
            message: 'Username dapat digunakan',
            position: 'topRight'
          });
          $("#btn-simpan").prop('disabled',false);
        }
      },
      error: function(res) {
        iziToast.error({
          title: 'Pesan Galat!',
          message: 'Mohon maaf, username sudah ada, silakan coba lagi dengan username yang berbeda',
          position: 'topRight'
        });
      }
    }
  );
}
</script>
@endsection