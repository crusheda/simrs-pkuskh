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

                Tambah Pengadaan Barang Rutin

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body">
                @can('pengadaan')<div class="container">
                    <form class="form-auth-medium" action="{{ route('rutin.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="container">
                            <div class="field_wrapper">
                                <p>nb. Mohon untuk mengisi mulai dari atas dan kosongi bila perlu.</p>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon3">Unit</span>
                                                </div>
                                                <select class="custom-select" name="unit" id="unit">
                                                    <option selected disabled>Pilih...</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon3">Pemohon</span>
                                                </div>
                                                <input type="text" name="pemohon" id="pemohon" value="" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr width="100%">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang1" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah1" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan1" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga1" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan1" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang2" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah2" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan2" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga2" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan2" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang3" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah3" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan3" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga3" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan3" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang4" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah4" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan4" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga4" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan4" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang4" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah4" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan4" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga4" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan4" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang5" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah5" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan5" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga5" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan5" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang6" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah6" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan6" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga6" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan6" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang7" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah7" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan7" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga7" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan7" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang8" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah8" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan8" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga8" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan8" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang9" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah9" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan9" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga9" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan9" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang10" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah10" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan10" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga10" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan10" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang11" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah11" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan11" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga11" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan11" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang12" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah12" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan12" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga12" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan12" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang13" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah13" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan13" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga13" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan13" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang14" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah14" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan14" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga14" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan14" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang15" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah15" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan15" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga15" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan15" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang16" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah16" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan16" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga16" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan16" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang17" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah17" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan17" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga17" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan17" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang18" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah18" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan18" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga18" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan18" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang19" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah19" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan19" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga19" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan19" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="barang20" id="barang" value="" class="form-control" placeholder="Nama Barang">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah20" id="jumlah" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan20" id="satuan" value="" class="form-control" placeholder="Satuan">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga20" id="harga" value="" class="form-control" placeholder="Harga">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan20" id="keterangan" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-md btn-primary" type="submit">SIMPAN</button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
                    


{{-- @foreach($list['getby'] as $item)
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
                <form action="{{ route('pengadaan.destroy', $item->token) }}" method="POST">
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

{{-- <div class="modal fade bd-example-modal-lg" id="lihatData" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Detail Pengadaan {{ $item->jnspengadaan }} Unit {{ $item->unit }} 
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
</div> --}}

<script>
$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

@endsection
