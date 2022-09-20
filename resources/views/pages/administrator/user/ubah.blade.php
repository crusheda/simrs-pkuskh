@extends('layouts.simrsmuv2')

@section('content')
@hasrole('it|administrator')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Administrator / User /</span> Ubah 
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
      <h5 class="mb-2 me-2">Form Ubah Akun</h5>
      <small class="text-muted">User ID : <span class="badge bg-primary">{{ $list['user']->id }}</span></small>
    </div>
  </h5>
  {{ Form::model($list['user'], array('route' => array('user.update', $list['user']->id), 'method' => 'PUT', 'id' => 'formUbah')) }}
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Username</label>
          <input type="text" name="name" value="{{ $list['user']->name }}" class="form-control" placeholder="" required/>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Email</label>
          <input type="text" name="email" value="{{ $list['user']->email }}" class="form-control" placeholder="" required/>
        </div>
      </div>
      <div class="col-md-12 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Role</label>
          <div class="select2-dark">
            <select id="role" name="role[]" class="select2 form-select" data-bs-auto-close="outside" required multiple>
              @if (count($list['role']) > 0)
                @foreach ($list['role'] as $item)
                  <option value="{{ $item->id }}" @if (count($list['model']) > 0) @foreach ($list['model'] as $val) @if ($item->id == $val->role_id) selected @endif @endforeach @endif>{{ $item->name }}</option>
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
            <input type="password" name="password" class="form-control" id="password1" minlength="8" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" onpaste="return false" />
            <span id="open-password1" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
          <sub>Masukkan password minimal 8 karakter</sub>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Retype Password</label>
          <div class="input-group">
            <input type="password" name="repassword" class="form-control" id="password2" minlength="8" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" onpaste="return false" />
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
        <button class="btn btn-primary" id="btn-simpan" onclick="saveData()">
          <i class="fas fa-save fa-md"></i>&nbsp;&nbsp;
          <span class="align-middle d-sm-inline-block d-none me-sm-1">Simpan</span>
        </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>
@endhasrole
<script>
$(document).ready( function () {
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
  $("#formUbah").one('submit', function() {
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
</script>
@endsection