@extends('layouts.admin')

@section('content')

@can('administrasi')
    <div class="card">
        <iframe src="{{url('admin/filemanager')}}" frameborder="0" height="500px" width="100%"></iframe>
    </div>
@else
    <div class="card">
        <div class="container">
            <center><p>Maaf, anda tidak mempunyai hak akses untuk halaman ini. Silakan Hubungi <b>Staff IT</b>. Terima Kasih.</p></center>
        </div>
    </div>

@endcan

@endsection
