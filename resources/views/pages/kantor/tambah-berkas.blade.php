@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-plus-square nav-icon text-info">

            </i>
            Tambah Berkas Rapat

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kantor
            </span>

        </div>
        <div class="card-body">
            @can('berkas_rapat')
            <form class="form-auth-small" action="{{ route('rapat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <label>Kegiatan :</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="">
                        <br>
                        <label>Ketua Rapat :</label>
                        <input type="text" name="kepala" id="kepala" class="form-control" placeholder="">
                        <br>
                        <label>Tanggal :</label>
                        <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" placeholder="">
                        <br>
                        <label>Lokasi Rapat :</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                        <br>
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""></textarea>
                        <br>
                        
                    </div>
                    <div class="col-md-1">
                        <p></p>
                        <label>Undangan</label>
                        <p></p>
                        <label>Materi</label>
                        <p></p>
                        <label>Absensi</label>
                        <p></p>
                        <label>Notulen</label>
                        <p></p>
                        <label>Dokumentasi</label>
                    </div>
                    <div class="col-md-4">
                        <p></p>
                        : <input type="file" name="file1">
                        <span class="help-block text-danger">{{ $errors->first('file1') }}</span>
                        <p></p>
                        : <input type="file" name="file2">
                        <span class="help-block text-danger">{{ $errors->first('file2') }}</span>
                        <p></p>
                        : <input type="file" name="file3">
                        <span class="help-block text-danger">{{ $errors->first('file3') }}</span>
                        <p></p>
                        : <input type="file" name="file4">
                        <span class="help-block text-danger">{{ $errors->first('file4') }}</span>
                        <p></p>
                        : <input type="file" name="file5">
                        <span class="help-block text-danger">{{ $errors->first('file5') }}</span>
                    </div>
                    <br>
                </div>
                <hr>
                <button class="btn btn-primary text-white pull-right" id="submit">Submit</button>
            </form>
            @endcan
        </div>
    </div>
</div>

@endsection