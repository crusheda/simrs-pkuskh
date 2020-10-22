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

                <i class="fa-fw fas fa-cart-arrow-down nav-icon">

                </i>Detail Pengadaan ( {{ $list->created_at->diffForHumans() }} )

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Pengadaan
                </span>
                

            </div>
            <div class="card-body">
                @can('pengadaan')
                <div class="row">
                    <div class="col-md-8">
                        <p>Nama Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list->unit }}</p>
                        <p>Pemohon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list->pemohon }}</p>
                        <p>Jenis Pengadaan&nbsp;: {{ $list->jnspengadaan }}</p>
                        <p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list->tgl }}</p>
                        @if ($list->created_at != $list->updated_at)
                            <span class="badge badge-dark">
                                Diperbarui : {{ $list->updated_at }}
                            </span>
                        @else
                        @endif
                    </div>
                    <div class="col-md-4">
                        <center>
                            <a type="button" href="{{ route('all.edit', $list->id) }}" class="btn btn-success btn-lg btn-block text-white">
                                <i class="fa-fw fas fa-edit nav-icon">

                                </i>
                                Ubah Data
                            </a><hr>
                            <a type="button" href="{{ route('pengadaan.cetak', $list->id) }}" class="btn btn-primary btn-lg btn-block text-white">
                                <i class="fa-fw fas fa-print nav-icon">

                                </i>
                                Cetak
                            </a><hr>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData{{ $list->id }}">
                                <i class="fa-fw fas fa-trash nav-icon">

                                </i>
                                Hapus
                            </button>
                        </center>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="detailpgd" class="table table-striped">
                        <thead>
                            <th>BARANG</th>
                            <th>JUMLAH</th>
                            <th>SATUAN</th>
                            <th>HARGA</th>
                            <th>TOTAL</th>
                            <th>KETERANGAN</th>
                        </thead>
                        <tbody>
                            @if($list->barang1 != null)
                            <tr>
                                <td>{{ $list->barang1 }}</td>
                                <td>{{ $list->jumlah1 }}</td>
                                <td>{{ $list->satuan1 }}</td>
                                <td>{{ $list->harga1 }}</td>
                                <td>{{ $list->total1 }}</td>
                                <td>{{ $list->keterangan1 }}</td>
                            </tr>
                            @endif
                            @if($list->barang2 != null)
                            <tr>
                                <td>{{ $list->barang2 }}</td>
                                <td>{{ $list->jumlah2 }}</td>
                                <td>{{ $list->satuan2 }}</td>
                                <td>{{ $list->harga2 }}</td>
                                <td>{{ $list->total2 }}</td>
                                <td>{{ $list->keterangan2 }}</td>
                            </tr>
                            @endif
                            @if($list->barang3 != null)
                            <tr>
                                <td>{{ $list->barang3 }}</td>
                                <td>{{ $list->jumlah3 }}</td>
                                <td>{{ $list->satuan3 }}</td>
                                <td>{{ $list->harga3 }}</td>
                                <td>{{ $list->total3 }}</td>
                                <td>{{ $list->keterangan3 }}</td>
                            </tr>
                            @endif
                            @if($list->barang4 != null)
                            <tr>
                                <td>{{ $list->barang4 }}</td>
                                <td>{{ $list->jumlah4 }}</td>
                                <td>{{ $list->satuan4 }}</td>
                                <td>{{ $list->harga4 }}</td>
                                <td>{{ $list->total4 }}</td>
                                <td>{{ $list->keterangan4 }}</td>
                            </tr>
                            @endif
                            @if($list->barang5 != null)
                            <tr>
                                <td>{{ $list->barang5 }}</td>
                                <td>{{ $list->jumlah5 }}</td>
                                <td>{{ $list->satuan5 }}</td>
                                <td>{{ $list->harga5 }}</td>
                                <td>{{ $list->total5 }}</td>
                                <td>{{ $list->keterangan5 }}</td>
                            </tr>
                            @endif
                            @if($list->barang6 != null)
                            <tr>
                                <td>{{ $list->barang6 }}</td>
                                <td>{{ $list->jumlah6 }}</td>
                                <td>{{ $list->satuan6 }}</td>
                                <td>{{ $list->harga6 }}</td>
                                <td>{{ $list->total6 }}</td>
                                <td>{{ $list->keterangan6 }}</td>
                            </tr>
                            @endif
                            @if($list->barang7 != null)
                            <tr>
                                <td>{{ $list->barang7 }}</td>
                                <td>{{ $list->jumlah7 }}</td>
                                <td>{{ $list->satuan7 }}</td>
                                <td>{{ $list->harga7 }}</td>
                                <td>{{ $list->total7 }}</td>
                                <td>{{ $list->keterangan7 }}</td>
                            </tr>
                            @endif
                            @if($list->barang8 != null)
                            <tr>
                                <td>{{ $list->barang8 }}</td>
                                <td>{{ $list->jumlah8 }}</td>
                                <td>{{ $list->satuan8 }}</td>
                                <td>{{ $list->harga8 }}</td>
                                <td>{{ $list->total1 }}</td>
                                <td>{{ $list->keterangan8 }}</td>
                            </tr>
                            @endif
                            @if($list->barang9 != null)
                            <tr>
                                <td>{{ $list->barang9 }}</td>
                                <td>{{ $list->jumlah9 }}</td>
                                <td>{{ $list->satuan9 }}</td>
                                <td>{{ $list->harga9 }}</td>
                                <td>{{ $list->total9 }}</td>
                                <td>{{ $list->keterangan9 }}</td>
                            </tr>
                            @endif
                            @if($list->barang10 != null)
                            <tr>
                                <td>{{ $list->barang10 }}</td>
                                <td>{{ $list->jumlah10 }}</td>
                                <td>{{ $list->satuan10 }}</td>
                                <td>{{ $list->harga10 }}</td>
                                <td>{{ $list->total10 }}</td>
                                <td>{{ $list->keterangan10 }}</td>
                            </tr>
                            @endif
                            @if($list->barang11 != null)
                            <tr>
                                <td>{{ $list->barang11 }}</td>
                                <td>{{ $list->jumlah11 }}</td>
                                <td>{{ $list->satuan11 }}</td>
                                <td>{{ $list->harga11 }}</td>
                                <td>{{ $list->total11 }}</td>
                                <td>{{ $list->keterangan11 }}</td>
                            </tr>
                            @endif
                            @if($list->barang12 != null)
                            <tr>
                                <td>{{ $list->barang12 }}</td>
                                <td>{{ $list->jumlah12 }}</td>
                                <td>{{ $list->satuan12 }}</td>
                                <td>{{ $list->harga12 }}</td>
                                <td>{{ $list->total12 }}</td>
                                <td>{{ $list->keterangan12 }}</td>
                            </tr>
                            @endif
                            @if($list->barang13 != null)
                            <tr>
                                <td>{{ $list->barang13 }}</td>
                                <td>{{ $list->jumlah13 }}</td>
                                <td>{{ $list->satuan13 }}</td>
                                <td>{{ $list->harga13 }}</td>
                                <td>{{ $list->total13 }}</td>
                                <td>{{ $list->keterangan13 }}</td>
                            </tr>
                            @endif
                            @if($list->barang14 != null)
                            <tr>
                                <td>{{ $list->barang14 }}</td>
                                <td>{{ $list->jumlah14 }}</td>
                                <td>{{ $list->satuan14 }}</td>
                                <td>{{ $list->harga14 }}</td>
                                <td>{{ $list->total14 }}</td>
                                <td>{{ $list->keterangan14 }}</td>
                            </tr>
                            @endif
                            @if($list->barang15 != null)
                            <tr>
                                <td>{{ $list->barang15 }}</td>
                                <td>{{ $list->jumlah15 }}</td>
                                <td>{{ $list->satuan15 }}</td>
                                <td>{{ $list->harga15 }}</td>
                                <td>{{ $list->total15 }}</td>
                                <td>{{ $list->keterangan15 }}</td>
                            </tr>
                            @endif
                            @if($list->barang16 != null)
                            <tr>
                                <td>{{ $list->barang16 }}</td>
                                <td>{{ $list->jumlah16 }}</td>
                                <td>{{ $list->satuan16 }}</td>
                                <td>{{ $list->harga16 }}</td>
                                <td>{{ $list->total16 }}</td>
                                <td>{{ $list->keterangan16 }}</td>
                            </tr>
                            @endif
                            @if($list->barang17 != null)
                            <tr>
                                <td>{{ $list->barang17 }}</td>
                                <td>{{ $list->jumlah17 }}</td>
                                <td>{{ $list->satuan17 }}</td>
                                <td>{{ $list->harga17 }}</td>
                                <td>{{ $list->total17 }}</td>
                                <td>{{ $list->keterangan17 }}</td>
                            </tr>
                            @endif
                            @if($list->barang18 != null)
                            <tr>
                                <td>{{ $list->barang18 }}</td>
                                <td>{{ $list->jumlah18 }}</td>
                                <td>{{ $list->satuan18 }}</td>
                                <td>{{ $list->harga18 }}</td>
                                <td>{{ $list->total18 }}</td>
                                <td>{{ $list->keterangan18 }}</td>
                            </tr>
                            @endif
                            @if($list->barang19 != null)
                            <tr>
                                <td>{{ $list->barang19 }}</td>
                                <td>{{ $list->jumlah19 }}</td>
                                <td>{{ $list->satuan19 }}</td>
                                <td>{{ $list->harga19 }}</td>
                                <td>{{ $list->total19 }}</td>
                                <td>{{ $list->keterangan19 }}</td>
                            </tr>
                            @endif
                            @if($list->barang20 != null)
                            <tr>
                                <td>{{ $list->barang20 }}</td>
                                <td>{{ $list->jumlah20 }}</td>
                                <td>{{ $list->satuan20 }}</td>
                                <td>{{ $list->harga20 }}</td>
                                <td>{{ $list->total20 }}</td>
                                <td>{{ $list->keterangan20 }}</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <th>BARANG</th>
                            <th>JUMLAH</th>
                            <th>SATUAN</th>
                            <th>HARGA</th>
                            <th>TOTAL</th>
                            <th>KETERANGAN</th>
                        </tfoot>
                    </table>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="hapusData{{ $list->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                <p>Nama Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list->unit }}</p>
                <p>Pemohon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list->pemohon }}</p>
                <p>Jenis Pengadaan&nbsp;: {{ $list->jnspengadaan }}</p>
                <p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list->created_at->diffForHumans() }}</p>
                @if ($list->created_at != $list->updated_at)
                    <p>Diperbarui  : {{ $list->updated_at }}</p>
                @else
                @endif
            </p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('all.destroy', $list->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
            </form>
        </div>
      </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#detailpgd').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            }
        );
    } );
</script>

@endsection