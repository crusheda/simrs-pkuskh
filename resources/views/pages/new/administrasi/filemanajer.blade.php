@extends('layouts.newAdmin')

@section('content')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

{{-- <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fa-fw fas fa-sort nav-icon">

    </i> Baca Saya
</button><p></p>
<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <p><kbd>Berkas</kbd> Menyimpan file yang hanya ditujukan untuk Anda pribadi. Menggunakan direktori untuk menyimpan informasi sensitif yang tidak boleh diakses pengguna lain.</p>
        <p><kbd>File yang Dibagikan</kbd> Menyimpan file yang ingin dibagikan ke pengguna lain, termasuk media, dokumen, dan file lainnya.</p>
    </div>
</div> --}}
<div class="card" style="height: 600px">{{-- Standart: 550px --}}
    <div class="card-header">
      <button type="button" class="btn btn-light btn-sm text-dark" data-toggle="modal" data-target="#readme" data-toggle="tooltip" data-placement="bottom" title="STRUKTUR BAGIAN 2021"><i class="fa-fw fas fa-info-circle nav-icon text-dark"></i> Struktur Bagian</button>&nbsp;&nbsp;
    </div>
    <div class="card-body">
        <div style="height: 350px;width:100%;margin-top: -10px">
            <div id="fm"></div>
        </div>
    </div>
    <div class="card-footer">
        <center><i class="fa-fw fas fa-folder-open nav-icon"></i>&nbsp;&nbsp;File Manager Karyawan | &copy; 2020</center>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="readme" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Struktur Bagian 2021
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img class="card-img-top img-thumbnail" src="{{ url('img/struktur_bagian_pkuskh.jpg') }}" height="300" alt="Card image cap">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="window.location.href='{{ url('img/struktur_bagian_pkuskh.jpg') }}'"><i class="fas fa-download"></i> Download</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            {{-- <b></b> --}}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection