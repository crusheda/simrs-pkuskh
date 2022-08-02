@extends('layouts.admin.layout1')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Berita Terkini</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Posting</li>
                            <li class="breadcrumb-item">Artikel</li>
                            <li class="breadcrumb-item">Berita Terkini</li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="hstack gap-3">
                            <button type="button" class="btn btn-dark" onclick="window.location='{{ route('admin.berita.index') }}'"><i class="mdi mdi-chevron-left"></i> Kembali</button>
                        </div>
                    </div>
                    <form class="form-auth-small" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input class="form-control" type="text" name="judul" placeholder="Tuliskan Judul" autofocus required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Penulis</label>
                                        <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap Penulis" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Thumbnail</label><br>
                                        <input type="file" name="file" class="form-control-file" required>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <label class="form-label">Deskripsi Berita</label>
                                    <textarea class="ckeditor" name="deskripsi"></textarea>
                                </div> --}}
                                <hr>
                                <div class="col-md-12">
                                    <center><label class="form-label">Deskripsi Artikel Berita</label></center>
                                    <textarea class="textarea" name="deskripsi"></textarea>
                                    {{-- <textarea class="form-control" name="summernote" id="summernote"></textarea> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-end mb-3" type="submit"><i class="mdi mdi-content-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection