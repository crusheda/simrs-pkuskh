@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

    <div class="card">
        <div class="card-header bg-dark text-white">

            <a class="btn btn-success btn-sm" href="{{ route("queue.poli.index") }}">Kembali</a>
            <i class="fa-fw fas fa-sort-amount-asc nav-icon" style="margin-left:10px">

            </i> Antrian Poliklinik

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Poli
            </span>

        </div>
        <div class="card-body">
            <h5>Terakhir Update : <kbd id="date">{{ \Carbon\Carbon::now()->toTimeString() }}</kbd></h5><hr>
            <div class="table-responsive">
                <table class="table table-striped display" id="queue">
                    <thead>
                        <tr>
                            <th class="text-center">AKSI</th>
                            <th>RM</th>
                            <th>NAMA</th>
                            <th>POLI</th>
                            <th>KODE ANTRIAN</th>
                            <th>TGL ANTRIAN</th>
                        </tr>
                    </thead>
                    <tbody id="antrian">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>
                                {{-- <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubahLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></a> --}}
                                <center><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-check nav-icon"></i>{{ $item->id }}</button></center>
                            </td>
                            <td>{{ $item->no_rm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nama_queue }}</td>
                            <td>{{ $item->queue }}</td>
                            <td>{{ $item->tgl_queue }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Hapus -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Hapus <kbd>ID : {{ $item->id }}</kbd> dari daftar Antrian?
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    @if(count($list) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>RM</th>
                                    <th>NAMA</th>
                                    <th>POLI</th>
                                    <th>KODE ANTRIAN</th>
                                    <th>TGL ANTRIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $item->no_rm }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nama_queue }}</td>
                                    <td>{{ $item->queue }}</td>
                                    <td>{{ $item->tgl_queue }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                @if(count($list) > 0)
                    <button class="btn btn-primary" onclick="hapus({{ $item->id }})"><i class="lnr lnr-trash"></i>Submit</button>
                @endif
            </div>
        </div>
        </div>
    </div>
    @endforeach

    <script>
        $(document).ready( function () {
            $('#queue').DataTable(
                {
                    paging: true,
                    searching: true,
                    
                    order: [ 4, "asc" ]
                }
            );
            // var id = url.substring(url.lastIndexOf('poli/') + 1);
            // console.log(id);

            // Development
                // setInterval(function () {
                //     $.ajax({
                //         url: "http://localhost:8000/api/queue/poli/{{ $list['kode'] }}",
                //         type: 'GET',
                //         dataType: 'json', // added data type
                //         success: function(res) {
                //             $("#antrian").empty();
                //             // console.log(res);
                //             var d = new Date();
                //             var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
                //             document.getElementById("date").innerHTML = time;
                //             res.forEach(item => {
                //                 $("#antrian").append(`<tr id="data${item.id}"><td><center><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#hapusLog${item.id}"><i class="fa-fw fas fa-check nav-icon"></i>${item.id}</button></center></td> <td>${item.no_rm}</td> <td>${item.nama}</td> <td>${item.nama_queue}</td> <td>${item.queue}</td> <td>${item.tgl_queue ? item.tgl_queue : ''}</td></tr>`);
                //             });
                //         }
                //     }); 
                // },10000);

            // Hostinger
            setInterval(function () {
                $.ajax({
                    url: "http://simrsku.com/api/queue/poli/{{ $list['kode'] }}",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#antrian").empty();
                        // console.log(res);
                        var d = new Date();
                        var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
                        document.getElementById("date").innerHTML = time;
                        res.forEach(item => {
                            $("#antrian").append(`<tr id="data${item.id}"><td><center><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#hapusLog${item.id}"><i class="fa-fw fas fa-check nav-icon"></i>${item.id}</button></center></td> <td>${item.no_rm}</td> <td>${item.nama}</td> <td>${item.nama_queue}</td> <td>${item.queue}</td> <td>${item.tgl_queue ? item.tgl_queue : ''}</td></tr>`);
                        });
                    }
                }); 
            },10000);
        } );

        // Development
            // function hapus(id){
            //     $.ajax({
            //         url: "http://localhost:8000/api/queue/poli/"+id+"/hapus",
            //         type: 'GET',
            //         dataType: 'json', // added data type
            //         success: function(res) {
            //             // $("#antrian").empty();
            //             console.log(res);
            //             if (res.success) {
            //                 $("#data"+res.id).remove();
            //             }
            //             $('#hapusLog'+res.id).modal('hide');
            //             location.reload();
            //         }
            //     }); 
            // }

        // Hostinger
        function hapus(id){
            $.ajax({
                url: "http://simrsku.com/api/queue/poli/"+id+"/hapus",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // $("#antrian").empty();
                    console.log(res);
                    if (res.success) {
                        $("#data"+res.id).remove();
                    }
                    $('#hapusLog'+res.id).modal('hide');
                    location.reload();
                }
            }); 
        }
    </script>

@endsection