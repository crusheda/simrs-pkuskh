@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                Tabel Pengadaan

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body">
                @can('pengadaan')
                <div class="container">
                    <center><a type="button" href="{{ route("rutin.create") }}" style="width: 150px" class="btn btn-info btn-lg text-white">Rutin</a>
                    <a type="button" href="{{ route("nonrutin.create") }}" style="width: 150px" class="btn btn-success btn-lg">Non Rutin</a></center>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection