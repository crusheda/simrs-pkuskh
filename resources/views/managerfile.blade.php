@extends('layouts.admin')

@section('content')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

    <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa-fw fas fa-sort nav-icon">
    
        </i> Baca Saya
    </button><p></p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p><kbd>Berkas</kbd> Menyimpan file yang hanya ditujukan untuk Anda pribadi. Menggunakan direktori untuk menyimpan informasi sensitif yang tidak boleh diakses pengguna lain.</p>
            <p><kbd>File yang Dibagikan</kbd> Menyimpan file yang ingin dibagikan ke pengguna lain, termasuk media, dokumen, dan file lainnya.</p>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-white" style="background-color:#2F353A">
            File Manager Karyawan
        </div>
        <div class="card-body">
            <div style="height: 700px;width:100%;margin-top: -10px">
                <div id="fm"></div>
            </div>
        </div>

    </div>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

@endsection
