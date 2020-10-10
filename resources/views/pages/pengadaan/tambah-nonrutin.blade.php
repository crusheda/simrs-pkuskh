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
                                <p>nb. Mohon untuk mengisi mulai dari atas dan kosongi bila perlu.</p>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="unit">Unit</span>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang1" name="barang1" />
                                                </div>
                                                <datalist id="barang1">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang2" name="barang2" />
                                                </div>
                                                <datalist id="barang2">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang3" name="barang3" />
                                                </div>
                                                <datalist id="barang3">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang4" name="barang4" />
                                                </div>
                                                <datalist id="barang4">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang5" name="barang5" />
                                                </div>
                                                <datalist id="barang5">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang6" name="barang6" />
                                                </div>
                                                <datalist id="barang6">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang7" name="barang7" />
                                                </div>
                                                <datalist id="barang7">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang8" name="barang8" />
                                                </div>
                                                <datalist id="barang8">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang9" name="barang9" />
                                                </div>
                                                <datalist id="barang9">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang10" name="barang10" />
                                                </div>
                                                <datalist id="barang10">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang11" name="barang11" />
                                                </div>
                                                <datalist id="barang11">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang12" name="barang12" />
                                                </div>
                                                <datalist id="barang12">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang13" name="barang13" />
                                                </div>
                                                <datalist id="barang13">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang14" name="barang14" />
                                                </div>
                                                <datalist id="barang14">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang15" name="barang15" />
                                                </div>
                                                <datalist id="barang15">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang16" name="barang16" />
                                                </div>
                                                <datalist id="barang16">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang17" name="barang17" />
                                                </div>
                                                <datalist id="barang17">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang18" name="barang18" />
                                                </div>
                                                <datalist id="barang18">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang19" name="barang19" />
                                                </div>
                                                <datalist id="barang19">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="barang">Barang</span>
                                                    <input class="form-control" list="barang20" name="barang20" />
                                                </div>
                                                <datalist id="barang20">
                                                    @foreach($list as $barang => $item)
                                                        <option value="{{ $barang }}">{{ $barang }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
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

@endsection
