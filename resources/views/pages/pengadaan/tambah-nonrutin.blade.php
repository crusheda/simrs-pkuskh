@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

    <script src="{{ asset('js/fstdropdown.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                Tambah Pengadaan Barang Non Rutin 

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body">
                @can('pengadaan')<div class="container">
                    <form class="form-auth-medium" action="{{ route('nonrutin.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="container">
                            <div class="field_wrapper">
                                <p>nb. Mohon untuk mengisi mulai dari atas dan kosongi bila tidak perlu.</p>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="unit">Unit</span>
                                                </div>
                                                <select class="custom-select" name="unit" id="unit">
                                                    <option selected hidden>Pilih...</option>
                                                    @foreach($unit as $name => $item)
                                                        <option value="{{ $name }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">Pemohon</span>
                                                </div>
                                                <input type="text" name="pemohon" id="btn=pemohon" value="" class="form-control" placeholder="Isi Dengan Nama Lengkap">
                                            </div>
                                        </div>
                                    </div>

                                    <hr width="100%">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg1" name="barang1">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah1" id="jumlah1" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan1" id="satuan1" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga1" id="harga1" value="" class="form-control" placeholder="Harga"readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan1" id="keterangan1" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg2" name="barang2">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah2" id="jumlah2" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan2" id="satuan2" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga2" id="harga2" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan2" id="keterangan2" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg3" name="barang3">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah3" id="jumlah3" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan3" id="satuan3" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga3" id="harga3" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan3" id="keterangan3" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg4" name="barang4">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah4" id="jumlah4" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan4" id="satuan4" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga4" id="harga4" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan4" id="keterangan4" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg5" name="barang5">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah5" id="jumlah5" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan5" id="satuan5" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga5" id="harga5" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan5" id="keterangan5" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg6" name="barang6">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah6" id="jumlah6" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan6" id="satuan6" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga6" id="harga6" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan6" id="keterangan6" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg7" name="barang7">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah7" id="jumlah7" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan7" id="satuan7" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga7" id="harga7" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan7" id="keterangan7" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg8" name="barang8">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah8" id="jumlah8" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan8" id="satuan8" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga8" id="harga8" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan8" id="keterangan8" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg9" name="barang9">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah9" id="jumlah9" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan9" id="satuan9" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga9" id="harga9" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan9" id="keterangan9" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg10" name="barang10">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah10" id="jumlah10" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan10" id="satuan10" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga10" id="harga10" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan10" id="keterangan10" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg11" name="barang11">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah11" id="jumlah11" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan11" id="satuan11" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga11" id="harga11" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan11" id="keterangan11" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg12" name="barang12">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah12" id="jumlah12" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan12" id="satuan12" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga12" id="harga12" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan12" id="keterangan12" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg13" name="barang13">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah13" id="jumlah13" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan13" id="satuan13" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga13" id="harga13" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan13" id="keterangan13" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg14" name="barang14">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah14" id="jumlah14" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan14" id="satuan14" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga14" id="harga14" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan14" id="keterangan14" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg15" name="barang15">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah15" id="jumlah15" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan15" id="satuan15" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga15" id="harga15" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan15" id="keterangan15" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg16" name="barang16">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah16" id="jumlah16" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan16" id="satuan16" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga16" id="harga16" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan16" id="keterangan16" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg17" name="barang17">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah17" id="jumlah17" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan17" id="satuan17" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga17" id="harga17" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan17" id="keterangan17" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div><div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg18" name="barang18">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah18" id="jumlah18" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan18" id="satuan18" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga18" id="harga18" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan18" id="keterangan18" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg19" name="barang19">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah19" id="jumlah19" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan19" id="satuan19" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga19" id="harga19" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan19" id="keterangan19" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="fstdropdown-select" id="barangg20" name="barang20">
                                                <option selected="selected" value="">Pilih Barang</option>
                                                @foreach($list as $barang => $item)
                                                    <option value="{{ $barang }}">{{ $barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="jumlah20" id="jumlah20" value="" class="form-control" placeholder="Jml">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="satuan20" id="satuan20" value="" class="form-control" placeholder="Satuan" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="harga20" id="harga20" value="" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="keterangan20" id="keterangan20" value="" class="form-control" placeholder="Keterangan">
                                        </div> 
                                        <hr width="100%">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right">
                            <p>Mohon Teliti Dahulu Sebelum Menyimpan. </p>
                            <button class="btn btn-md btn-primary" type="submit">SIMPAN</button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT FOR 103.155.246.25:85 --}}
    <script>
        var hargasatuanbarang1 = 0;

        $(document).ready(function() {        
            $('#barangg1').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah1").val("");
                    $("#satuan1").val("");
                    $("#harga1").val("");
                    $('#jumlah1').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan1").val(res.satuan);
                            hargasatuanbarang1 = parseInt(res.harga);

                            
                            var jumlah1 = $("#jumlah1").val();
                            if (jumlah1 != '') {
                                var harga = jumlah1 * hargasatuanbarang1;
                                $("#harga1").val(harga);
                            }
                            $('#jumlah1').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah1').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang1;
                $("#harga1").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang2 = 0;

        $(document).ready(function() {        
            $('#barangg2').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah2").val("");
                    $("#satuan2").val("");
                    $("#harga2").val("");
                    $('#jumlah2').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan2").val(res.satuan);
                            hargasatuanbarang2 = parseInt(res.harga);

                            
                            var jumlah2 = $("#jumlah2").val();
                            if (jumlah2 != '') {
                                var harga = jumlah2 * hargasatuanbarang2;
                                $("#harga2").val(harga);
                            }
                            $('#jumlah2').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah2').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang2;
                $("#harga2").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang3 = 0;

        $(document).ready(function() {        
            $('#barangg3').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah3").val("");
                    $("#satuan3").val("");
                    $("#harga3").val("");
                    $('#jumlah3').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan3").val(res.satuan);
                            hargasatuanbarang3 = parseInt(res.harga);

                            
                            var jumlah3 = $("#jumlah3").val();
                            if (jumlah3 != '') {
                                var harga = jumlah3 * hargasatuanbarang3;
                                $("#harga3").val(harga);
                            }
                            $('#jumlah3').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah3').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang3;
                $("#harga3").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang4 = 0;

        $(document).ready(function() {        
            $('#barangg4').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah4").val("");
                    $("#satuan4").val("");
                    $("#harga4").val("");
                    $('#jumlah4').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan4").val(res.satuan);
                            hargasatuanbarang4 = parseInt(res.harga);

                            
                            var jumlah4 = $("#jumlah4").val();
                            if (jumlah4 != '') {
                                var harga = jumlah4 * hargasatuanbarang4;
                                $("#harga4").val(harga);
                            }
                            $('#jumlah4').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah4').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang4;
                $("#harga4").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang5 = 0;

        $(document).ready(function() {        
            $('#barangg5').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah5").val("");
                    $("#satuan5").val("");
                    $("#harga5").val("");
                    $('#jumlah5').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan5").val(res.satuan);
                            hargasatuanbarang5 = parseInt(res.harga);

                            
                            var jumlah5 = $("#jumlah5").val();
                            if (jumlah5 != '') {
                                var harga = jumlah5 * hargasatuanbarang5;
                                $("#harga5").val(harga);
                            }
                            $('#jumlah5').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah5').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang5;
                $("#harga5").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang6 = 0;

        $(document).ready(function() {        
            $('#barangg6').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah6").val("");
                    $("#satuan6").val("");
                    $("#harga6").val("");
                    $('#jumlah6').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan6").val(res.satuan);
                            hargasatuanbarang6 = parseInt(res.harga);

                            
                            var jumlah6 = $("#jumlah6").val();
                            if (jumlah6 != '') {
                                var harga = jumlah6 * hargasatuanbarang6;
                                $("#harga6").val(harga);
                            }
                            $('#jumlah6').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah6').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang6;
                $("#harga6").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang7 = 0;

        $(document).ready(function() {        
            $('#barangg7').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah7").val("");
                    $("#satuan7").val("");
                    $("#harga7").val("");
                    $('#jumlah7').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan7").val(res.satuan);
                            hargasatuanbarang7 = parseInt(res.harga);

                            
                            var jumlah7 = $("#jumlah7").val();
                            if (jumlah7 != '') {
                                var harga = jumlah7 * hargasatuanbarang7;
                                $("#harga7").val(harga);
                            }
                            $('#jumlah7').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah7').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang7;
                $("#harga7").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang8 = 0;

        $(document).ready(function() {        
            $('#barangg8').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah8").val("");
                    $("#satuan8").val("");
                    $("#harga8").val("");
                    $('#jumlah8').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan8").val(res.satuan);
                            hargasatuanbarang8 = parseInt(res.harga);

                            
                            var jumlah8 = $("#jumlah8").val();
                            if (jumlah8 != '') {
                                var harga = jumlah8 * hargasatuanbarang8;
                                $("#harga8").val(harga);
                            }
                            $('#jumlah8').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah8').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang8;
                $("#harga8").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang9 = 0;

        $(document).ready(function() {        
            $('#barangg9').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah9").val("");
                    $("#satuan9").val("");
                    $("#harga9").val("");
                    $('#jumlah9').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan9").val(res.satuan);
                            hargasatuanbarang9 = parseInt(res.harga);

                            
                            var jumlah9 = $("#jumlah9").val();
                            if (jumlah9 != '') {
                                var harga = jumlah9 * hargasatuanbarang9;
                                $("#harga9").val(harga);
                            }
                            $('#jumlah9').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah9').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang9;
                $("#harga9").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang10 = 0;

        $(document).ready(function() {        
            $('#barangg10').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah10").val("");
                    $("#satuan10").val("");
                    $("#harga10").val("");
                    $('#jumlah10').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan10").val(res.satuan);
                            hargasatuanbarang10 = parseInt(res.harga);

                            
                            var jumlah10 = $("#jumlah10").val();
                            if (jumlah10 != '') {
                                var harga = jumlah10 * hargasatuanbarang10;
                                $("#harga10").val(harga);
                            }
                            $('#jumlah10').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah10').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang10;
                $("#harga10").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang11 = 0;

        $(document).ready(function() {        
            $('#barangg11').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah11").val("");
                    $("#satuan11").val("");
                    $("#harga11").val("");
                    $('#jumlah11').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan11").val(res.satuan);
                            hargasatuanbarang11 = parseInt(res.harga);

                            
                            var jumlah11 = $("#jumlah11").val();
                            if (jumlah11 != '') {
                                var harga = jumlah11 * hargasatuanbarang11;
                                $("#harga11").val(harga);
                            }
                            $('#jumlah11').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah11').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang11;
                $("#harga11").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang12 = 0;

        $(document).ready(function() {        
            $('#barangg12').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah12").val("");
                    $("#satuan12").val("");
                    $("#harga12").val("");
                    $('#jumlah12').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan12").val(res.satuan);
                            hargasatuanbarang12 = parseInt(res.harga);

                            
                            var jumlah12 = $("#jumlah12").val();
                            if (jumlah12 != '') {
                                var harga = jumlah12 * hargasatuanbarang12;
                                $("#harga12").val(harga);
                            }
                            $('#jumlah12').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah12').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang12;
                $("#harga12").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang13 = 0;

        $(document).ready(function() {        
            $('#barangg13').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah13").val("");
                    $("#satuan13").val("");
                    $("#harga13").val("");
                    $('#jumlah13').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan13").val(res.satuan);
                            hargasatuanbarang13 = parseInt(res.harga);

                            
                            var jumlah13 = $("#jumlah13").val();
                            if (jumlah13 != '') {
                                var harga = jumlah13 * hargasatuanbarang13;
                                $("#harga13").val(harga);
                            }
                            $('#jumlah13').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah13').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang13;
                $("#harga13").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang14 = 0;

        $(document).ready(function() {        
            $('#barangg14').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah14").val("");
                    $("#satuan14").val("");
                    $("#harga14").val("");
                    $('#jumlah14').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan14").val(res.satuan);
                            hargasatuanbarang14 = parseInt(res.harga);

                            
                            var jumlah14 = $("#jumlah14").val();
                            if (jumlah14 != '') {
                                var harga = jumlah14 * hargasatuanbarang14;
                                $("#harga14").val(harga);
                            }
                            $('#jumlah14').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah14').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang14;
                $("#harga14").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang15 = 0;

        $(document).ready(function() {        
            $('#barangg15').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah15").val("");
                    $("#satuan15").val("");
                    $("#harga15").val("");
                    $('#jumlah15').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan15").val(res.satuan);
                            hargasatuanbarang15 = parseInt(res.harga);

                            
                            var jumlah15 = $("#jumlah15").val();
                            if (jumlah15 != '') {
                                var harga = jumlah15 * hargasatuanbarang15;
                                $("#harga15").val(harga);
                            }
                            $('#jumlah15').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah15').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang15;
                $("#harga15").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang16 = 0;

        $(document).ready(function() {        
            $('#barangg16').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah16").val("");
                    $("#satuan16").val("");
                    $("#harga16").val("");
                    $('#jumlah16').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan16").val(res.satuan);
                            hargasatuanbarang16 = parseInt(res.harga);

                            
                            var jumlah16 = $("#jumlah16").val();
                            if (jumlah16 != '') {
                                var harga = jumlah16 * hargasatuanbarang16;
                                $("#harga16").val(harga);
                            }
                            $('#jumlah16').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah16').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang16;
                $("#harga16").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang17 = 0;

        $(document).ready(function() {        
            $('#barangg17').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah17").val("");
                    $("#satuan17").val("");
                    $("#harga17").val("");
                    $('#jumlah17').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan17").val(res.satuan);
                            hargasatuanbarang17 = parseInt(res.harga);

                            
                            var jumlah17 = $("#jumlah17").val();
                            if (jumlah17 != '') {
                                var harga = jumlah17 * hargasatuanbarang17;
                                $("#harga17").val(harga);
                            }
                            $('#jumlah17').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah17').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang17;
                $("#harga17").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang18 = 0;

        $(document).ready(function() {        
            $('#barangg18').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah18").val("");
                    $("#satuan18").val("");
                    $("#harga18").val("");
                    $('#jumlah18').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan18").val(res.satuan);
                            hargasatuanbarang18 = parseInt(res.harga);

                            
                            var jumlah18 = $("#jumlah18").val();
                            if (jumlah18 != '') {
                                var harga = jumlah18 * hargasatuanbarang18;
                                $("#harga18").val(harga);
                            }
                            $('#jumlah18').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah18').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang18;
                $("#harga18").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang19 = 0;

        $(document).ready(function() {        
            $('#barangg19').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah19").val("");
                    $("#satuan19").val("");
                    $("#harga19").val("");
                    $('#jumlah19').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan19").val(res.satuan);
                            hargasatuanbarang19 = parseInt(res.harga);

                            
                            var jumlah19 = $("#jumlah19").val();
                            if (jumlah19 != '') {
                                var harga = jumlah19 * hargasatuanbarang19;
                                $("#harga19").val(harga);
                            }
                            $('#jumlah19').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah19').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang19;
                $("#harga19").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang20 = 0;

        $(document).ready(function() {        
            $('#barangg20').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah20").val("");
                    $("#satuan20").val("");
                    $("#harga20").val("");
                    $('#jumlah20').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://103.155.246.25:85/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan20").val(res.satuan);
                            hargasatuanbarang20 = parseInt(res.harga);

                            
                            var jumlah20 = $("#jumlah20").val();
                            if (jumlah20 != '') {
                                var harga = jumlah20 * hargasatuanbarang20;
                                $("#harga20").val(harga);
                            }
                            $('#jumlah20').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah20').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang20;
                $("#harga20").val(harga);
            });
        });
    </script>
{{-- END SCRIPT --}}

{{-- START SCRIPT FOR 192.168.1.2:8000 --}}
    <script>
        var hargasatuanbarang1 = 0;

        $(document).ready(function() {        
            $('#barangg1').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah1").val("");
                    $("#satuan1").val("");
                    $("#harga1").val("");
                    $('#jumlah1').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan1").val(res.satuan);
                            hargasatuanbarang1 = parseInt(res.harga);

                            
                            var jumlah1 = $("#jumlah1").val();
                            if (jumlah1 != '') {
                                var harga = jumlah1 * hargasatuanbarang1;
                                $("#harga1").val(harga);
                            }
                            $('#jumlah1').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah1').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang1;
                $("#harga1").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang2 = 0;

        $(document).ready(function() {        
            $('#barangg2').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah2").val("");
                    $("#satuan2").val("");
                    $("#harga2").val("");
                    $('#jumlah2').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan2").val(res.satuan);
                            hargasatuanbarang2 = parseInt(res.harga);

                            
                            var jumlah2 = $("#jumlah2").val();
                            if (jumlah2 != '') {
                                var harga = jumlah2 * hargasatuanbarang2;
                                $("#harga2").val(harga);
                            }
                            $('#jumlah2').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah2').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang2;
                $("#harga2").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang3 = 0;

        $(document).ready(function() {        
            $('#barangg3').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah3").val("");
                    $("#satuan3").val("");
                    $("#harga3").val("");
                    $('#jumlah3').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan3").val(res.satuan);
                            hargasatuanbarang3 = parseInt(res.harga);

                            
                            var jumlah3 = $("#jumlah3").val();
                            if (jumlah3 != '') {
                                var harga = jumlah3 * hargasatuanbarang3;
                                $("#harga3").val(harga);
                            }
                            $('#jumlah3').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah3').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang3;
                $("#harga3").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang4 = 0;

        $(document).ready(function() {        
            $('#barangg4').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah4").val("");
                    $("#satuan4").val("");
                    $("#harga4").val("");
                    $('#jumlah4').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan4").val(res.satuan);
                            hargasatuanbarang4 = parseInt(res.harga);

                            
                            var jumlah4 = $("#jumlah4").val();
                            if (jumlah4 != '') {
                                var harga = jumlah4 * hargasatuanbarang4;
                                $("#harga4").val(harga);
                            }
                            $('#jumlah4').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah4').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang4;
                $("#harga4").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang5 = 0;

        $(document).ready(function() {        
            $('#barangg5').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah5").val("");
                    $("#satuan5").val("");
                    $("#harga5").val("");
                    $('#jumlah5').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan5").val(res.satuan);
                            hargasatuanbarang5 = parseInt(res.harga);

                            
                            var jumlah5 = $("#jumlah5").val();
                            if (jumlah5 != '') {
                                var harga = jumlah5 * hargasatuanbarang5;
                                $("#harga5").val(harga);
                            }
                            $('#jumlah5').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah5').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang5;
                $("#harga5").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang6 = 0;

        $(document).ready(function() {        
            $('#barangg6').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah6").val("");
                    $("#satuan6").val("");
                    $("#harga6").val("");
                    $('#jumlah6').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan6").val(res.satuan);
                            hargasatuanbarang6 = parseInt(res.harga);

                            
                            var jumlah6 = $("#jumlah6").val();
                            if (jumlah6 != '') {
                                var harga = jumlah6 * hargasatuanbarang6;
                                $("#harga6").val(harga);
                            }
                            $('#jumlah6').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah6').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang6;
                $("#harga6").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang7 = 0;

        $(document).ready(function() {        
            $('#barangg7').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah7").val("");
                    $("#satuan7").val("");
                    $("#harga7").val("");
                    $('#jumlah7').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan7").val(res.satuan);
                            hargasatuanbarang7 = parseInt(res.harga);

                            
                            var jumlah7 = $("#jumlah7").val();
                            if (jumlah7 != '') {
                                var harga = jumlah7 * hargasatuanbarang7;
                                $("#harga7").val(harga);
                            }
                            $('#jumlah7').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah7').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang7;
                $("#harga7").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang8 = 0;

        $(document).ready(function() {        
            $('#barangg8').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah8").val("");
                    $("#satuan8").val("");
                    $("#harga8").val("");
                    $('#jumlah8').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan8").val(res.satuan);
                            hargasatuanbarang8 = parseInt(res.harga);

                            
                            var jumlah8 = $("#jumlah8").val();
                            if (jumlah8 != '') {
                                var harga = jumlah8 * hargasatuanbarang8;
                                $("#harga8").val(harga);
                            }
                            $('#jumlah8').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah8').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang8;
                $("#harga8").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang9 = 0;

        $(document).ready(function() {        
            $('#barangg9').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah9").val("");
                    $("#satuan9").val("");
                    $("#harga9").val("");
                    $('#jumlah9').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan9").val(res.satuan);
                            hargasatuanbarang9 = parseInt(res.harga);

                            
                            var jumlah9 = $("#jumlah9").val();
                            if (jumlah9 != '') {
                                var harga = jumlah9 * hargasatuanbarang9;
                                $("#harga9").val(harga);
                            }
                            $('#jumlah9').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah9').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang9;
                $("#harga9").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang10 = 0;

        $(document).ready(function() {        
            $('#barangg10').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah10").val("");
                    $("#satuan10").val("");
                    $("#harga10").val("");
                    $('#jumlah10').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan10").val(res.satuan);
                            hargasatuanbarang10 = parseInt(res.harga);

                            
                            var jumlah10 = $("#jumlah10").val();
                            if (jumlah10 != '') {
                                var harga = jumlah10 * hargasatuanbarang10;
                                $("#harga10").val(harga);
                            }
                            $('#jumlah10').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah10').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang10;
                $("#harga10").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang11 = 0;

        $(document).ready(function() {        
            $('#barangg11').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah11").val("");
                    $("#satuan11").val("");
                    $("#harga11").val("");
                    $('#jumlah11').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan11").val(res.satuan);
                            hargasatuanbarang11 = parseInt(res.harga);

                            
                            var jumlah11 = $("#jumlah11").val();
                            if (jumlah11 != '') {
                                var harga = jumlah11 * hargasatuanbarang11;
                                $("#harga11").val(harga);
                            }
                            $('#jumlah11').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah11').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang11;
                $("#harga11").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang12 = 0;

        $(document).ready(function() {        
            $('#barangg12').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah12").val("");
                    $("#satuan12").val("");
                    $("#harga12").val("");
                    $('#jumlah12').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan12").val(res.satuan);
                            hargasatuanbarang12 = parseInt(res.harga);

                            
                            var jumlah12 = $("#jumlah12").val();
                            if (jumlah12 != '') {
                                var harga = jumlah12 * hargasatuanbarang12;
                                $("#harga12").val(harga);
                            }
                            $('#jumlah12').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah12').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang12;
                $("#harga12").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang13 = 0;

        $(document).ready(function() {        
            $('#barangg13').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah13").val("");
                    $("#satuan13").val("");
                    $("#harga13").val("");
                    $('#jumlah13').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan13").val(res.satuan);
                            hargasatuanbarang13 = parseInt(res.harga);

                            
                            var jumlah13 = $("#jumlah13").val();
                            if (jumlah13 != '') {
                                var harga = jumlah13 * hargasatuanbarang13;
                                $("#harga13").val(harga);
                            }
                            $('#jumlah13').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah13').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang13;
                $("#harga13").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang14 = 0;

        $(document).ready(function() {        
            $('#barangg14').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah14").val("");
                    $("#satuan14").val("");
                    $("#harga14").val("");
                    $('#jumlah14').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan14").val(res.satuan);
                            hargasatuanbarang14 = parseInt(res.harga);

                            
                            var jumlah14 = $("#jumlah14").val();
                            if (jumlah14 != '') {
                                var harga = jumlah14 * hargasatuanbarang14;
                                $("#harga14").val(harga);
                            }
                            $('#jumlah14').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah14').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang14;
                $("#harga14").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang15 = 0;

        $(document).ready(function() {        
            $('#barangg15').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah15").val("");
                    $("#satuan15").val("");
                    $("#harga15").val("");
                    $('#jumlah15').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan15").val(res.satuan);
                            hargasatuanbarang15 = parseInt(res.harga);

                            
                            var jumlah15 = $("#jumlah15").val();
                            if (jumlah15 != '') {
                                var harga = jumlah15 * hargasatuanbarang15;
                                $("#harga15").val(harga);
                            }
                            $('#jumlah15').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah15').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang15;
                $("#harga15").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang16 = 0;

        $(document).ready(function() {        
            $('#barangg16').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah16").val("");
                    $("#satuan16").val("");
                    $("#harga16").val("");
                    $('#jumlah16').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan16").val(res.satuan);
                            hargasatuanbarang16 = parseInt(res.harga);

                            
                            var jumlah16 = $("#jumlah16").val();
                            if (jumlah16 != '') {
                                var harga = jumlah16 * hargasatuanbarang16;
                                $("#harga16").val(harga);
                            }
                            $('#jumlah16').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah16').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang16;
                $("#harga16").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang17 = 0;

        $(document).ready(function() {        
            $('#barangg17').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah17").val("");
                    $("#satuan17").val("");
                    $("#harga17").val("");
                    $('#jumlah17').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan17").val(res.satuan);
                            hargasatuanbarang17 = parseInt(res.harga);

                            
                            var jumlah17 = $("#jumlah17").val();
                            if (jumlah17 != '') {
                                var harga = jumlah17 * hargasatuanbarang17;
                                $("#harga17").val(harga);
                            }
                            $('#jumlah17').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah17').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang17;
                $("#harga17").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang18 = 0;

        $(document).ready(function() {        
            $('#barangg18').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah18").val("");
                    $("#satuan18").val("");
                    $("#harga18").val("");
                    $('#jumlah18').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan18").val(res.satuan);
                            hargasatuanbarang18 = parseInt(res.harga);

                            
                            var jumlah18 = $("#jumlah18").val();
                            if (jumlah18 != '') {
                                var harga = jumlah18 * hargasatuanbarang18;
                                $("#harga18").val(harga);
                            }
                            $('#jumlah18').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah18').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang18;
                $("#harga18").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang19 = 0;

        $(document).ready(function() {        
            $('#barangg19').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah19").val("");
                    $("#satuan19").val("");
                    $("#harga19").val("");
                    $('#jumlah19').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan19").val(res.satuan);
                            hargasatuanbarang19 = parseInt(res.harga);

                            
                            var jumlah19 = $("#jumlah19").val();
                            if (jumlah19 != '') {
                                var harga = jumlah19 * hargasatuanbarang19;
                                $("#harga19").val(harga);
                            }
                            $('#jumlah19').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah19').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang19;
                $("#harga19").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang20 = 0;

        $(document).ready(function() {        
            $('#barangg20').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah20").val("");
                    $("#satuan20").val("");
                    $("#harga20").val("");
                    $('#jumlah20').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://192.168.1.2:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan20").val(res.satuan);
                            hargasatuanbarang20 = parseInt(res.harga);

                            
                            var jumlah20 = $("#jumlah20").val();
                            if (jumlah20 != '') {
                                var harga = jumlah20 * hargasatuanbarang20;
                                $("#harga20").val(harga);
                            }
                            $('#jumlah20').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah20').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang20;
                $("#harga20").val(harga);
            });
        });
    </script>
{{-- END SCRIPT --}}

{{-- START SCRIPT FOR localhost:8000 --}}
    <script>
        var hargasatuanbarang1 = 0;

        $(document).ready(function() {        
            $('#barangg1').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah1").val("");
                    $("#satuan1").val("");
                    $("#harga1").val("");
                    $('#jumlah1').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan1").val(res.satuan);
                            hargasatuanbarang1 = parseInt(res.harga);

                            
                            var jumlah1 = $("#jumlah1").val();
                            if (jumlah1 != '') {
                                var harga = jumlah1 * hargasatuanbarang1;
                                $("#harga1").val(harga);
                            }
                            $('#jumlah1').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah1').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang1;
                $("#harga1").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang2 = 0;

        $(document).ready(function() {        
            $('#barangg2').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah2").val("");
                    $("#satuan2").val("");
                    $("#harga2").val("");
                    $('#jumlah2').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan2").val(res.satuan);
                            hargasatuanbarang2 = parseInt(res.harga);

                            
                            var jumlah2 = $("#jumlah2").val();
                            if (jumlah2 != '') {
                                var harga = jumlah2 * hargasatuanbarang2;
                                $("#harga2").val(harga);
                            }
                            $('#jumlah2').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah2').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang2;
                $("#harga2").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang3 = 0;

        $(document).ready(function() {        
            $('#barangg3').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah3").val("");
                    $("#satuan3").val("");
                    $("#harga3").val("");
                    $('#jumlah3').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan3").val(res.satuan);
                            hargasatuanbarang3 = parseInt(res.harga);

                            
                            var jumlah3 = $("#jumlah3").val();
                            if (jumlah3 != '') {
                                var harga = jumlah3 * hargasatuanbarang3;
                                $("#harga3").val(harga);
                            }
                            $('#jumlah3').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah3').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang3;
                $("#harga3").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang4 = 0;

        $(document).ready(function() {        
            $('#barangg4').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah4").val("");
                    $("#satuan4").val("");
                    $("#harga4").val("");
                    $('#jumlah4').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan4").val(res.satuan);
                            hargasatuanbarang4 = parseInt(res.harga);

                            
                            var jumlah4 = $("#jumlah4").val();
                            if (jumlah4 != '') {
                                var harga = jumlah4 * hargasatuanbarang4;
                                $("#harga4").val(harga);
                            }
                            $('#jumlah4').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah4').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang4;
                $("#harga4").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang5 = 0;

        $(document).ready(function() {        
            $('#barangg5').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah5").val("");
                    $("#satuan5").val("");
                    $("#harga5").val("");
                    $('#jumlah5').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan5").val(res.satuan);
                            hargasatuanbarang5 = parseInt(res.harga);

                            
                            var jumlah5 = $("#jumlah5").val();
                            if (jumlah5 != '') {
                                var harga = jumlah5 * hargasatuanbarang5;
                                $("#harga5").val(harga);
                            }
                            $('#jumlah5').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah5').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang5;
                $("#harga5").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang6 = 0;

        $(document).ready(function() {        
            $('#barangg6').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah6").val("");
                    $("#satuan6").val("");
                    $("#harga6").val("");
                    $('#jumlah6').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan6").val(res.satuan);
                            hargasatuanbarang6 = parseInt(res.harga);

                            
                            var jumlah6 = $("#jumlah6").val();
                            if (jumlah6 != '') {
                                var harga = jumlah6 * hargasatuanbarang6;
                                $("#harga6").val(harga);
                            }
                            $('#jumlah6').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah6').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang6;
                $("#harga6").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang7 = 0;

        $(document).ready(function() {        
            $('#barangg7').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah7").val("");
                    $("#satuan7").val("");
                    $("#harga7").val("");
                    $('#jumlah7').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan7").val(res.satuan);
                            hargasatuanbarang7 = parseInt(res.harga);

                            
                            var jumlah7 = $("#jumlah7").val();
                            if (jumlah7 != '') {
                                var harga = jumlah7 * hargasatuanbarang7;
                                $("#harga7").val(harga);
                            }
                            $('#jumlah7').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah7').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang7;
                $("#harga7").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang8 = 0;

        $(document).ready(function() {        
            $('#barangg8').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah8").val("");
                    $("#satuan8").val("");
                    $("#harga8").val("");
                    $('#jumlah8').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan8").val(res.satuan);
                            hargasatuanbarang8 = parseInt(res.harga);

                            
                            var jumlah8 = $("#jumlah8").val();
                            if (jumlah8 != '') {
                                var harga = jumlah8 * hargasatuanbarang8;
                                $("#harga8").val(harga);
                            }
                            $('#jumlah8').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah8').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang8;
                $("#harga8").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang9 = 0;

        $(document).ready(function() {        
            $('#barangg9').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah9").val("");
                    $("#satuan9").val("");
                    $("#harga9").val("");
                    $('#jumlah9').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan9").val(res.satuan);
                            hargasatuanbarang9 = parseInt(res.harga);

                            
                            var jumlah9 = $("#jumlah9").val();
                            if (jumlah9 != '') {
                                var harga = jumlah9 * hargasatuanbarang9;
                                $("#harga9").val(harga);
                            }
                            $('#jumlah9').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah9').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang9;
                $("#harga9").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang10 = 0;

        $(document).ready(function() {        
            $('#barangg10').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah10").val("");
                    $("#satuan10").val("");
                    $("#harga10").val("");
                    $('#jumlah10').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan10").val(res.satuan);
                            hargasatuanbarang10 = parseInt(res.harga);

                            
                            var jumlah10 = $("#jumlah10").val();
                            if (jumlah10 != '') {
                                var harga = jumlah10 * hargasatuanbarang10;
                                $("#harga10").val(harga);
                            }
                            $('#jumlah10').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah10').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang10;
                $("#harga10").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang11 = 0;

        $(document).ready(function() {        
            $('#barangg11').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah11").val("");
                    $("#satuan11").val("");
                    $("#harga11").val("");
                    $('#jumlah11').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan11").val(res.satuan);
                            hargasatuanbarang11 = parseInt(res.harga);

                            
                            var jumlah11 = $("#jumlah11").val();
                            if (jumlah11 != '') {
                                var harga = jumlah11 * hargasatuanbarang11;
                                $("#harga11").val(harga);
                            }
                            $('#jumlah11').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah11').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang11;
                $("#harga11").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang12 = 0;

        $(document).ready(function() {        
            $('#barangg12').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah12").val("");
                    $("#satuan12").val("");
                    $("#harga12").val("");
                    $('#jumlah12').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan12").val(res.satuan);
                            hargasatuanbarang12 = parseInt(res.harga);

                            
                            var jumlah12 = $("#jumlah12").val();
                            if (jumlah12 != '') {
                                var harga = jumlah12 * hargasatuanbarang12;
                                $("#harga12").val(harga);
                            }
                            $('#jumlah12').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah12').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang12;
                $("#harga12").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang13 = 0;

        $(document).ready(function() {        
            $('#barangg13').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah13").val("");
                    $("#satuan13").val("");
                    $("#harga13").val("");
                    $('#jumlah13').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan13").val(res.satuan);
                            hargasatuanbarang13 = parseInt(res.harga);

                            
                            var jumlah13 = $("#jumlah13").val();
                            if (jumlah13 != '') {
                                var harga = jumlah13 * hargasatuanbarang13;
                                $("#harga13").val(harga);
                            }
                            $('#jumlah13').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah13').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang13;
                $("#harga13").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang14 = 0;

        $(document).ready(function() {        
            $('#barangg14').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah14").val("");
                    $("#satuan14").val("");
                    $("#harga14").val("");
                    $('#jumlah14').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan14").val(res.satuan);
                            hargasatuanbarang14 = parseInt(res.harga);

                            
                            var jumlah14 = $("#jumlah14").val();
                            if (jumlah14 != '') {
                                var harga = jumlah14 * hargasatuanbarang14;
                                $("#harga14").val(harga);
                            }
                            $('#jumlah14').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah14').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang14;
                $("#harga14").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang15 = 0;

        $(document).ready(function() {        
            $('#barangg15').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah15").val("");
                    $("#satuan15").val("");
                    $("#harga15").val("");
                    $('#jumlah15').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan15").val(res.satuan);
                            hargasatuanbarang15 = parseInt(res.harga);

                            
                            var jumlah15 = $("#jumlah15").val();
                            if (jumlah15 != '') {
                                var harga = jumlah15 * hargasatuanbarang15;
                                $("#harga15").val(harga);
                            }
                            $('#jumlah15').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah15').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang15;
                $("#harga15").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang16 = 0;

        $(document).ready(function() {        
            $('#barangg16').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah16").val("");
                    $("#satuan16").val("");
                    $("#harga16").val("");
                    $('#jumlah16').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan16").val(res.satuan);
                            hargasatuanbarang16 = parseInt(res.harga);

                            
                            var jumlah16 = $("#jumlah16").val();
                            if (jumlah16 != '') {
                                var harga = jumlah16 * hargasatuanbarang16;
                                $("#harga16").val(harga);
                            }
                            $('#jumlah16').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah16').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang16;
                $("#harga16").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang17 = 0;

        $(document).ready(function() {        
            $('#barangg17').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah17").val("");
                    $("#satuan17").val("");
                    $("#harga17").val("");
                    $('#jumlah17').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan17").val(res.satuan);
                            hargasatuanbarang17 = parseInt(res.harga);

                            
                            var jumlah17 = $("#jumlah17").val();
                            if (jumlah17 != '') {
                                var harga = jumlah17 * hargasatuanbarang17;
                                $("#harga17").val(harga);
                            }
                            $('#jumlah17').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah17').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang17;
                $("#harga17").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang18 = 0;

        $(document).ready(function() {        
            $('#barangg18').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah18").val("");
                    $("#satuan18").val("");
                    $("#harga18").val("");
                    $('#jumlah18').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan18").val(res.satuan);
                            hargasatuanbarang18 = parseInt(res.harga);

                            
                            var jumlah18 = $("#jumlah18").val();
                            if (jumlah18 != '') {
                                var harga = jumlah18 * hargasatuanbarang18;
                                $("#harga18").val(harga);
                            }
                            $('#jumlah18').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah18').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang18;
                $("#harga18").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang19 = 0;

        $(document).ready(function() {        
            $('#barangg19').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah19").val("");
                    $("#satuan19").val("");
                    $("#harga19").val("");
                    $('#jumlah19').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan19").val(res.satuan);
                            hargasatuanbarang19 = parseInt(res.harga);

                            
                            var jumlah19 = $("#jumlah19").val();
                            if (jumlah19 != '') {
                                var harga = jumlah19 * hargasatuanbarang19;
                                $("#harga19").val(harga);
                            }
                            $('#jumlah19').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah19').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang19;
                $("#harga19").val(harga);
            });
        });
    </script>

    <script>
        var hargasatuanbarang20 = 0;

        $(document).ready(function() {        
            $('#barangg20').change(function() { 
            // console.log(this.value);
            
                if (this.value == '') {
                    $("#jumlah20").val("");
                    $("#satuan20").val("");
                    $("#harga20").val("");
                    $('#jumlah20').attr('required', false);
                } else {
                    $.ajax({
                        url: "http://localhost:8000/pengadaan/api/barang/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            // console.log(res.satuan);
                            // console.log(res.harga);
                            $("#satuan20").val(res.satuan);
                            hargasatuanbarang20 = parseInt(res.harga);

                            
                            var jumlah20 = $("#jumlah20").val();
                            if (jumlah20 != '') {
                                var harga = jumlah20 * hargasatuanbarang20;
                                $("#harga20").val(harga);
                            }
                            $('#jumlah20').attr('required', true);
                        }
                    });
                }
            });
            $('#jumlah20').change(function() { 
                console.log(this.value);
                
                var harga = this.value * hargasatuanbarang20;
                $("#harga20").val(harga);
            });
        });
    </script>
{{-- END SCRIPT --}}

@endsection