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

                <a class="btn btn-success rounded-pill" href="{{ route("all.index") }}">Kembali</a>
                <i class="fa-fw fas fa-cart-arrow-down nav-icon" style="margin-left:10px">

                </i> Detail Pengadaan ( id : {{ $list->id }} )

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Pengadaan
                </span>
                

            </div>
            <div class="card-body">
                @can('pengadaan')
                {{ Form::model($list, array('route' => array('all.update', $list->id), 'method' => 'PUT')) }}
                <div class="modal-body">
                    @csrf
                    {{-- <label>Nama Unit :</label>
                    <select class="custom-select" name="unit" id="unit">
                        <option selected hidden>Pilih...</option>
                        @foreach($unit as $name => $item)
                            <option value="{{ $name }}" {{ $name == $list->unit ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select> --}}
                    <label>Nama Unit :</label>
                    <input type="text" name="unit" id="unit" value="{{ $list->unit }}" class="form-control" placeholder="" disabled> <br>
                    <label>Nama Pemohon :</label>
                    <input type="text" name="pemohon" id="pemohon" value="{{ $list->pemohon }}" class="form-control" placeholder=""> <br>
                    <label>Tanggal :</label>
                    <input type="datetime-local" name="tgl" id="tgl" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list->tgl)); ?>" class="form-control" placeholder="">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white btn-block" id="submit">Submit</button>
                </div>
                {{ Form::close() }}
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection