@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
{{-- <style type="text/css">
    #results { padding:20px; border:1px solid; background:#ccc; }
</style> --}}

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-camera nav-icon text-info">

            </i> Absen dengan Kamera

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            
        </div>
        <div class="card-body">
            <form class="form-auth-small" method="POST" action="{{ route('absen.store') }}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <div class="jumbotron" style="height: 100%;width: 100%;margin-bottom: -30px;">
                            <center>
                                <div id="my_camera" style="margin-top: -30px;"></div>
                                <br>
                                <input type="button" class="btn btn-primary btn-lg" value="Ambil Gambar" onClick="take_snapshot()">
                                <input type="hidden" name="image" class="image-tag">
                            </center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="jumbotron" style="height: 100%;width: 100%;margin-bottom: -30px;">
                            <center>
                                <div id="results" style="margin-top: -30px;">Hasil Foto absen anda akan muncul disini</div>
                                <br>
                                <button class="btn btn-success btn-lg"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    $("body").addClass('brand-minimized sidebar-minimized');

    Webcam.set({
        width: 490,
        height: 390,
        // width: 400,
        // height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
@endsection