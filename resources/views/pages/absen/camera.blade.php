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
    <div class="col-md-3">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">
    
                <i class="fa-fw fas fa-camera nav-icon text-info">
    
                </i> Absen dengan Kamera
                
            </div>
            <div class="card-body">
                <form class="form-auth-small" method="POST" action="{{ route('absen.store') }}" enctype="multipart/form-data">
                    <center>
                        <div id="my_camera"></div>
                        <br>
                        <input type="button" class="btn btn-primary btn-lg" value="Ambil Gambar" onClick="take_snapshot()">
                        <input type="hidden" name="image" class="image-tag">
                    </center>
                    <hr>
                    <center>
                        <div id="results">Hasil Foto absen anda akan muncul disini</div>
                        <br>
                        <button class="btn btn-success btn-lg"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">
    
                <i class="fa-fw fas fa-camera nav-icon text-info">
    
                </i> Riwayat Absensi
    
                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA</th>
                                {{-- <th>ROLE</th> --}}
                                <th>TGL</th>
                                <th><center>FOTO</center></th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody"><tr><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    $("body").addClass('brand-minimized sidebar-minimized');

    Webcam.set({
        width: 290,
        height: 190,
        // dest_width: 490,
        // dest_height: 390,
        // width: 400,
        // height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'" width="250" height="190"/>';
        } );
    }
</script>
@endsection