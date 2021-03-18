@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            @if (empty($list['foto']->filename))
                <img class="card-img-top img-thumbnail" src="{{ url('img/user_unknown.jpg') }}" height="300" alt="Card image cap">
            @else
                <img class="card-img-top img-thumbnail" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" height="300" alt="Card image cap">
            @endif
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
                            @if (empty($list['showuser']->nama))
                                <input type="text" class="form-control is-invalid" name="nama" id="nama" aria-label="Username" aria-describedby="basic-addon1" placeholder="e.g. Ronald Paul Soenaryo, S.Kep. Ns">
                                <div class="invalid-feedback">
                                    Tuliskan Nama Lengkap Anda.
                                </div>
                            @else
                                <input type="text" class="form-control" name="nama" value="{{ $list['showuser']->nama }}" minlength="1" aria-label="Username" aria-describedby="basic-addon1">
                            @endif
                        </div>
                    <label>Email :</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="{{ $list['user']->email }}" aria-label="Email" aria-describedby="basic-addon1">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Provinsi :</label>
                                <select class="form-control" id="province" name="province" disabled>
                                    <option value="" hidden>Pilih Provinsi</option>
                                    @foreach ($list['province'] as $item)
                                        <option value="{{ $item->province_code }}">{{ $item->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kabupaten :</label>
                                <select class="form-control" aria-label=".form-select-sm example" id="city" name="city" disabled>
                                    <option value="" hidden>Pilih Kabupaten</option>
                                    @foreach ($list['city'] as $item)
                                        <option class="city-option city-option-{{ $item->city_province_code }}" value="{{ $item->city_code }}" hidden>{{ $item->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kecamatan :</label>
                                <select class="form-control" aria-label=".form-select-sm example" id="district" name="district" disabled>
                                    <option value="" hidden>Pilih Kecamatan</option>
                                    @foreach ($list['district'] as $item)
                                        <option class="district-option district-option-{{ $item->district_city_code }}" value="{{ $item->district_code }}" hidden>{{ $item->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kelurahan :</label>
                                <select class="form-control" aria-label=".form-select-sm example" id="village" name="village" disabled>
                                    <option value="" hidden>Pilih Kelurahan</option>
                                    @foreach ($list['village'] as $item)
                                        <option class="village-option village-option-{{ $item->city_province_code }}" value="{{ $item->city_code }}" hidden>{{ $item->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <ul class="list-inline" style="float: right">
                        <li class="list-inline-item">
                            <a class="btn btn-warning text-white" href="{{ route('auth.change_password') }}">Ubah Password</a>
                        </li>
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-success">Simpan</button>
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

        // $("#province").change(function () {
        //     let province_id = this.value;
        //     $('#city').val('');
        //     $('.city-option').attr('hidden', true);
        //     $('.city-option-'+province_id).removeAttr('hidden');
        // });
        // $("#city").change(function () {
        //     let province_id = this.value;
        //     $('#district').val('');
        //     $('.district-option').attr('hidden', true);
        //     $('.district-option-'+province_id).removeAttr('hidden');
        // });
        // $("#district").change(function () {
        //     let province_id = this.value;
        //     $('#village').val('');
        //     $('.village-option').attr('hidden', true);
        //     $('.village-option-'+province_id).removeAttr('hidden');
        // });

        $('#nama').keydown(function () {
        var len = $(this).val().length;
        if (len >= 1) {
            $('#nama').removeClass('is-invalid');          
        } 
        else {
            $('#nama').addClass('is-invalid');     
        }
        });    
    });
</script>
@endsection
