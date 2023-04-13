@extends('layouts.simrsmuv2')

@section('content')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Bridging /</span> BPJS
    </h4>

    @if (session('message'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
            <p class="mb-0">{{ session('message') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if ($errors->count() > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
            <p class="mb-0">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <div class="card card-action mb-5">
        <div class="card-header">
            <div class="card-action-title">
                <div class="btn-group">
                    {{-- <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah" value="animate__jackInTheBox">
                        <i class="bx bx-upload scaleX-n1-rtl"></i>
                        <span class="align-middle">Upload</span>
                    </a> --}}
                    <button type="button" class="btn btn-label-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="ajaxBPJS()">
                        <i class="fa-fw fas fa-sync nav-icon"></i> Refresh</button>
                </div>
            </div>
            <div class="card-action-element">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    X-Cons-Id : {{ $list['consid'] }} <br>
                    X-Secret-Key : {{ $list['secretkey'] }} <br>
                    X-TimeStamp : {{ $list['timestamp'] }} <br>
                    X-Signature : {{ $list['signature'] }} <br>
                    <hr>
                    <p id="response"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("html").addClass('layout-menu-collapsed');
            ajaxBPJS();
        });

        // Show Function
        function ajaxBPJS() {
            $('#response').empty();
            $.ajax(
                {
                    url: "/api/bpjs/bridging/antrean/data",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        console.log(res);
                        $('#response').append(`Meta Data : <kbd>Kode : `+res.metacode+`, Pesan : `+res.metamessage+`</kbd><br>Response : `+res.response);
                    }
                }
            );
        }
    </script>

@endsection