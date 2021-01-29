@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <img class="card-img-top img-thumbnail" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" height="300" alt="Card image cap">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Username : <b>{{ $list['user']->name }}</b></li>
              <li class="list-group-item">Email : <b>{{ $list['user']->email }}</b></li>
            </ul>
            <div class="card-body">
                <center><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ubahFoto">Ubah Foto Profil</button></center>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <h5 class="card-header">Profil User<kbd style="float: right">ID : {{ $list['user']->id }}</kbd></h5>
            <div class="card-body">
                <form class="form-auth-small" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="number" name="id" value="{{ $list['user']->id }}" hidden>
                <div class="container">
                    <label>Username :</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" value="{{ $list['user']->name }}" aria-label="Name" aria-describedby="basic-addon1">
                    </div>
                    <label>Nama :</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" value="{{ $list['data_user']->nama }}" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <label>Email :</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="{{ $list['user']->email }}" aria-label="Email" aria-describedby="basic-addon1">
                    </div>
                    <ul class="list-inline" style="float: right">
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-warning text-white" href="{{ route('auth.change_password') }}">Ubah Password</a>
                        </li>
                    </ul>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ubah Foto Profil -->
<div class="modal fade" id="ubahFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Ubah Foto Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-auth-small" action="{{ action('Admin\profilController@storeImg') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            <div class="modal-body">
                <input type="file" name="file">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
      </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#tablebug').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 4, "desc" ]]
            }
        );
    } );
</script>

@endsection
