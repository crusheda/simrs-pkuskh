@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
        <div class="card-header">
          <h6>Pengaduan IPSRS Sudah Tersedia !!</h6>
        </div>
        <div class="card-body">
            <p>Instalasi yang melaksanakan tugas pokok dan fungsi dalam hal pemeliharaan Sarana Rumah Sakit</p>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary pull-right" href="{{ route('ipsrs.index') }}"><i class="fas fa-wrench"></i>&nbsp;&nbsp;Buka Pengaduan Sekarang</a>
        </div>
    </div>
  </div>
</div>
@endsection