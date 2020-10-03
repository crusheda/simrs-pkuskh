@extends('layouts.admin')

@section('content')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> --}}
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/> --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                Pengadaan Barang Non Rutin 

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                

            </div>
            <div class="card-body">
                @can('pengadaan')
                <div class="table-responsive">
                    <table id="pengadaan" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>UNIT</th>
                                <th>PEMOHON</th>
                                <th>TANGGAL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['getby']) > 0)
                            @foreach($list['getby'] as $item)
                            <tr>
                                <td>{{ $item->token }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->pemohon }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#lihatData" onclick="getdetail({{ $item->token }})">Lihat</button>
                                    <a type="button" class="btn btn-success btn-sm disabled" href="{{ route('nonrutin.cetak', $item->token) }}">Cetak</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData{{ $item->token }}">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan=5>Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @else
                <div class="col text-center">
                    <a type="button" class="btn btn-info text-white text-center" href="{{ route('nonrutin.create') }}" align:center>Tambah Pengadaan</a>
                </div>
                @endcan
                <table id="table_id" class="table display">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($list['getby'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusData{{ $item->token }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus? 
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>
                @if(count($list['getby']) > 0)
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <th>UNIT</th>
                                <th>PEMOHON</th>
                                <th>TANGGAL</th>
                            </thead>
                            <tbody>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->pemohon }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tbody>
                        </table>
                    </div>
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('rutin.destroy', $item->token) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach

<div class="modal fade bd-example-modal-lg" id="lihatData" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            {{-- Detail Pengadaan {{ $item->jnspengadaan }} Unit {{ $item->unit }} --}}
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="dataku" class="table table-striped">
                        <thead>
                            <th>UNIT</th>
                            <th>PEMOHON</th>
                            <th>BARANG</th>
                            <th>JUMLAH</th>
                            <th>SATUAN</th>
                            <th>HARGA</th>
                            <th>TOTAL</th>
                            <th>KETERANGAN</th>
                        </thead>
                        <tbody id="detailpgd">
                            
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
    function getdetail(munyuk) {
        $("#detailpgd").children().remove();
        $.ajax({url: "/pengadaan/nonrutin/token/" + munyuk , success: function(result){
            // $("#detailpgd").html(result);
            result.forEach(item => {
                $("#detailpgd").append('<tr>');
                $("#detailpgd").append('<td>'+item.unit+'</td>');
                $("#detailpgd").append('<td>'+item.pemohon+'</td>');
                $("#detailpgd").append('<td>'+item.barang+'</td>');
                $("#detailpgd").append('<td>'+item.jumlah+'</td>');
                $("#detailpgd").append('<td>'+item.satuan+'</td>');
                $("#detailpgd").append('<td>'+item.harga+'</td>');
                $("#detailpgd").append('<td>'+item.total+'</td>');
                $("#detailpgd").append('<td>'+item.keterangan+'</td>');
                $("#detailpgd").append('</tr>');
            });
            // console.log(result);
            // setTimeout(function(){ alert("Hello") }, 3000);
        }});
    }
</script>

<script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

@endsection
