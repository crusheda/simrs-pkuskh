@extends('layouts.simrsmuv2')

@section('content')
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
  <h5 class="card-header d-flex align-items-center justify-content-between">
    <button class="btn btn-label-dark" onclick="window.location='{{ route('user.index') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<i class='bx bx-chevron-left bx-xs' ></i> <span>Kembali ke Halaman Sebelumnya</span>"><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Kembali</button>
    <div class="card-title mb-0" style="text-align: right;">
      <h5 class="mb-2 me-2">Form Ubah Akun</h5>
      <small class="text-muted">User ID : <span class="badge bg-primary">{{ $list['user']->id }}</span></small>
    </div>
  </h5>
  <div class="card-body">
    {{ Form::model($list['user'], array('route' => array('user.update', $list['user']->id), 'method' => 'PUT')) }}
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
            <select id="role" name="role" class="select2 form-select" data-allow-clear="true" data-bs-auto-close="outside" required multiple>
              @if (count($list['role']) > 0)
                @foreach ($list['role'] as $item)
                  <option value="{{ $item->id_role }}" @if ($item->id_user == $list['user']->id) selected @endif>{{ $item->nama_role }}</option>
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
            <input type="password" name="password" class="form-control" id="password1" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password2" />
            <span id="open-password1" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="form-group">
          <label for="defaultFormControlInput" class="form-label">Retype Password</label>
          <div class="input-group">
            <input type="password" name="repassword" class="form-control" id="password2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="basic-default-password2" />
            <span id="open-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>

<script>$(document).ready( function () {
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
</script>
@endsection