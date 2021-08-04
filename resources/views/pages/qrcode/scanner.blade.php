@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>
{{-- <script src="{{ asset('js/scan_qrcode/jquery.min.js') }}"></script> --}}
<script src="{{ asset('js/scan_qrcode/instascan.min.js') }}"></script>

@php
    $agent = new Jenssegers\Agent\Agent();
@endphp

<div class="row">
    <div class="col-md-4">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-qrcode nav-icon">

                </i> Scan Barcode
                
            </div>
            <div class="card-body">
                <select class="custom-select" name="option" id="option"></select><br><br>
                <video id="preview" width="100%" height="100%"></video>
                <center><h5>WAKTU :&nbsp;<b class="text-danger"><a id="date"></a></b></h5></center>
            </div>
        </div>
        {{-- @if ($agent->isMobile()) --}}
            <div class="card" style="width: 100%">
                <div class="card-header bg-dark text-white">

                    <i class="fa-fw fas fa-qrcode nav-icon">

                    </i> Generate Barcode
                    
                </div>
                <div class="card-body">
                    <center><h6>Capture And Scan This Barcode</h6></center>
                    <div class="mb-3" id="barcode"><center>{!! DNS2D::getBarcodeHTML( \Illuminate\Support\Facades\Crypt::encryptString(rand().$list['getId']), 'QRCODE',6,6) !!}</center></div>
                </div>
            </div>
        {{-- @endif --}}
    </div>
    <div class="col-md-8">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-sort-amount-desc nav-icon text-info">

                </i> Histori Absensi

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body">
                <h6>Update Terkini : <b><a id="dateTable" class="text-danger">{{ $list['date'] }}</a></b> (Setiap 10 Detik)</h6><hr>
                <div class="table-responsive">
                    <table id="table" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA</th>
                                <th>MASUK</th>
                                <th>PULANG</th>
                                {{-- <th><center>AKSI</center></th> --}}
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tgl_masuk }}</td>
                                    <td>{{ $item->tgl_pulang }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#table').DataTable(
        {
            order: [[ 2, "desc" ]]
        }
    );
} );
</script>

<script>
    function getDateTime() {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
         return dateTime;
    }

    let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
    scanner.addListener('scan', function(content) {
        // $("#qrcode").val(content);
        $.ajax({ 
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST', 
            url: './scanner/post', 
            dataType: 'json', 
            data: { 
                qrcode: content
            }, 
            success: function(res) {
                Swal.fire({
                    title: res.title,
                    text: res.message,
                    icon: res.icon,
                    showConfirmButton:false,
                    showCancelButton:false,
                    timer: 3000,
                    timerProgressBar: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });
            }
        }); 
    });

    
    setInterval(function () {
        $.ajax({
            url: "http://localhost:8000/scanner/api/absensi",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tbody").empty();
                $("#dateTable").empty();
                res.forEach(item => {
                    $("#tbody").append(`<tr id="data${item.id}"><td>${item.id}</td> <td>${item.nama}</td> <td>${item.tgl_masuk}</td> <td>${item.tgl_pulang ? item.tgl_pulang : ''}</td></tr>`);
                });
                currentTime = getDateTime();
                document.getElementById("dateTable").innerHTML = currentTime; 
            }
        }); 
    },10000);

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            var i = cameras;
            scanner.start(cameras[0]);
                for (const [key, value] of Object.entries(cameras)) {
                    $('#option').append(`<option value="${key}">${value.name}</option>`)
                };
            $('#option').on('change',function(){
                for (const [key, value] of Object.entries(cameras)) {
                    if ($(this).val() == key) {
                        scanner.start(cameras[key]);
                    }
                };
            });
        } else {
            console.error('No Cameras Found');
        }
    }).catch(function(e) {
        console.error(e);
    })

    setInterval(function () {
        currentTime = getDateTime();
        document.getElementById("date").innerHTML = currentTime; 
    },1000); // 1 detik refresh

</script>

@endsection