@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                Pengadaan Barang Rutin

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
                                <th>UNIT</th>
                                <th>PEMOHON</th>
                                <th>TANGGAL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->pemohon }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#lihatData" onclick="getdetail({{ $item->id }})">Lihat</button>
                                    {{-- <a type="button" class="btn btn-success btn-sm disabled" href="{{ route('nonrutin.cetak', $item->token) }}">Cetak</a> --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData{{ $item->id }}">Hapus</button>
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
                    <a type="button" class="btn btn-info text-white text-center" href="{{ route('rutin.create') }}" align:center>Tambah Pengadaan</a>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusData{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                @if(count($list['show']) > 0)
                    <div class="table-responsive">
                        <table id="detail-rutin" class="table table-striped">
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
                <form action="{{ route('rutin.destroy', $item->id) }}" method="POST">
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
            Detail Pengadaan <b>{{ $item->jnspengadaan }}</b> Unit <b>{{ $item->unit }}</b> dengan Pemohon <b>{{ $item->pemohon }}</b>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="detail-rutin" class="table table-striped display">
                        <thead>
                            <th>BARANG</th>
                            <th>JUMLAH</th>
                            <th>SATUAN</th>
                            <th>HARGA</th>
                            <th>TOTAL</th>
                            <th>KETERANGAN</th>
                        </thead>
                        <tbody id="detailpgd">
                            @if($item->barang1 != null)
                            <tr>
                                <td>{{ $item->barang1 }}</td>
                                <td>{{ $item->jumlah1 }}</td>
                                <td>{{ $item->satuan1 }}</td>
                                <td>{{ $item->harga1 }}</td>
                                <td>{{ $item->total1 }}</td>
                                <td>{{ $item->keterangan1 }}</td>
                            </tr>
                            @endif
                            @if($item->barang2 != null)
                            <tr>
                                <td>{{ $item->barang2 }}</td>
                                <td>{{ $item->jumlah2 }}</td>
                                <td>{{ $item->satuan2 }}</td>
                                <td>{{ $item->harga2 }}</td>
                                <td>{{ $item->total2 }}</td>
                                <td>{{ $item->keterangan2 }}</td>
                            </tr>
                            @endif
                            @if($item->barang3 != null)
                            <tr>
                                <td>{{ $item->barang3 }}</td>
                                <td>{{ $item->jumlah3 }}</td>
                                <td>{{ $item->satuan3 }}</td>
                                <td>{{ $item->harga3 }}</td>
                                <td>{{ $item->total3 }}</td>
                                <td>{{ $item->keterangan3 }}</td>
                            </tr>
                            @endif
                            @if($item->barang4 != null)
                            <tr>
                                <td>{{ $item->barang4 }}</td>
                                <td>{{ $item->jumlah4 }}</td>
                                <td>{{ $item->satuan4 }}</td>
                                <td>{{ $item->harga4 }}</td>
                                <td>{{ $item->total4 }}</td>
                                <td>{{ $item->keterangan4 }}</td>
                            </tr>
                            @endif
                            @if($item->barang5 != null)
                            <tr>
                                <td>{{ $item->barang5 }}</td>
                                <td>{{ $item->jumlah5 }}</td>
                                <td>{{ $item->satuan5 }}</td>
                                <td>{{ $item->harga5 }}</td>
                                <td>{{ $item->total5 }}</td>
                                <td>{{ $item->keterangan5 }}</td>
                            </tr>
                            @endif
                            @if($item->barang6 != null)
                            <tr>
                                <td>{{ $item->barang6 }}</td>
                                <td>{{ $item->jumlah6 }}</td>
                                <td>{{ $item->satuan6 }}</td>
                                <td>{{ $item->harga6 }}</td>
                                <td>{{ $item->total6 }}</td>
                                <td>{{ $item->keterangan6 }}</td>
                            </tr>
                            @endif
                            @if($item->barang7 != null)
                            <tr>
                                <td>{{ $item->barang7 }}</td>
                                <td>{{ $item->jumlah7 }}</td>
                                <td>{{ $item->satuan7 }}</td>
                                <td>{{ $item->harga7 }}</td>
                                <td>{{ $item->total7 }}</td>
                                <td>{{ $item->keterangan7 }}</td>
                            </tr>
                            @endif
                            @if($item->barang8 != null)
                            <tr>
                                <td>{{ $item->barang8 }}</td>
                                <td>{{ $item->jumlah8 }}</td>
                                <td>{{ $item->satuan8 }}</td>
                                <td>{{ $item->harga8 }}</td>
                                <td>{{ $item->total1 }}</td>
                                <td>{{ $item->keterangan8 }}</td>
                            </tr>
                            @endif
                            @if($item->barang9 != null)
                            <tr>
                                <td>{{ $item->barang9 }}</td>
                                <td>{{ $item->jumlah9 }}</td>
                                <td>{{ $item->satuan9 }}</td>
                                <td>{{ $item->harga9 }}</td>
                                <td>{{ $item->total9 }}</td>
                                <td>{{ $item->keterangan9 }}</td>
                            </tr>
                            @endif
                            @if($item->barang10 != null)
                            <tr>
                                <td>{{ $item->barang10 }}</td>
                                <td>{{ $item->jumlah10 }}</td>
                                <td>{{ $item->satuan10 }}</td>
                                <td>{{ $item->harga10 }}</td>
                                <td>{{ $item->total10 }}</td>
                                <td>{{ $item->keterangan10 }}</td>
                            </tr>
                            @endif
                            @if($item->barang11 != null)
                            <tr>
                                <td>{{ $item->barang11 }}</td>
                                <td>{{ $item->jumlah11 }}</td>
                                <td>{{ $item->satuan11 }}</td>
                                <td>{{ $item->harga11 }}</td>
                                <td>{{ $item->total11 }}</td>
                                <td>{{ $item->keterangan11 }}</td>
                            </tr>
                            @endif
                            @if($item->barang12 != null)
                            <tr>
                                <td>{{ $item->barang12 }}</td>
                                <td>{{ $item->jumlah12 }}</td>
                                <td>{{ $item->satuan12 }}</td>
                                <td>{{ $item->harga12 }}</td>
                                <td>{{ $item->total12 }}</td>
                                <td>{{ $item->keterangan12 }}</td>
                            </tr>
                            @endif
                            @if($item->barang13 != null)
                            <tr>
                                <td>{{ $item->barang13 }}</td>
                                <td>{{ $item->jumlah13 }}</td>
                                <td>{{ $item->satuan13 }}</td>
                                <td>{{ $item->harga13 }}</td>
                                <td>{{ $item->total13 }}</td>
                                <td>{{ $item->keterangan13 }}</td>
                            </tr>
                            @endif
                            @if($item->barang14 != null)
                            <tr>
                                <td>{{ $item->barang14 }}</td>
                                <td>{{ $item->jumlah14 }}</td>
                                <td>{{ $item->satuan14 }}</td>
                                <td>{{ $item->harga14 }}</td>
                                <td>{{ $item->total14 }}</td>
                                <td>{{ $item->keterangan14 }}</td>
                            </tr>
                            @endif
                            @if($item->barang15 != null)
                            <tr>
                                <td>{{ $item->barang15 }}</td>
                                <td>{{ $item->jumlah15 }}</td>
                                <td>{{ $item->satuan15 }}</td>
                                <td>{{ $item->harga15 }}</td>
                                <td>{{ $item->total15 }}</td>
                                <td>{{ $item->keterangan15 }}</td>
                            </tr>
                            @endif
                            @if($item->barang16 != null)
                            <tr>
                                <td>{{ $item->barang16 }}</td>
                                <td>{{ $item->jumlah16 }}</td>
                                <td>{{ $item->satuan16 }}</td>
                                <td>{{ $item->harga16 }}</td>
                                <td>{{ $item->total16 }}</td>
                                <td>{{ $item->keterangan16 }}</td>
                            </tr>
                            @endif
                            @if($item->barang17 != null)
                            <tr>
                                <td>{{ $item->barang17 }}</td>
                                <td>{{ $item->jumlah17 }}</td>
                                <td>{{ $item->satuan17 }}</td>
                                <td>{{ $item->harga17 }}</td>
                                <td>{{ $item->total17 }}</td>
                                <td>{{ $item->keterangan17 }}</td>
                            </tr>
                            @endif
                            @if($item->barang18 != null)
                            <tr>
                                <td>{{ $item->barang18 }}</td>
                                <td>{{ $item->jumlah18 }}</td>
                                <td>{{ $item->satuan18 }}</td>
                                <td>{{ $item->harga18 }}</td>
                                <td>{{ $item->total18 }}</td>
                                <td>{{ $item->keterangan18 }}</td>
                            </tr>
                            @endif
                            @if($item->barang19 != null)
                            <tr>
                                <td>{{ $item->barang19 }}</td>
                                <td>{{ $item->jumlah19 }}</td>
                                <td>{{ $item->satuan19 }}</td>
                                <td>{{ $item->harga19 }}</td>
                                <td>{{ $item->total19 }}</td>
                                <td>{{ $item->keterangan19 }}</td>
                            </tr>
                            @endif
                            @if($item->barang20 != null)
                            <tr>
                                <td>{{ $item->barang20 }}</td>
                                <td>{{ $item->jumlah20 }}</td>
                                <td>{{ $item->satuan20 }}</td>
                                <td>{{ $item->harga20 }}</td>
                                <td>{{ $item->total20 }}</td>
                                <td>{{ $item->keterangan20 }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#pengadaan').DataTable();
} );
</script>


@endsection
