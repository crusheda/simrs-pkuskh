@extends('layouts.admin.layout1')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Berita Terkini</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Posting</li>
                            <li class="breadcrumb-item">Artikel</li>
                            <li class="breadcrumb-item">Berita Terkini</li>
                            <li class="breadcrumb-item active">Ubah</li>
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
                    <form class="form-auth-small" action="{{ route('admin.berita.update', $list->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input class="form-control" type="text" name="judul" value="{{ $list->judul }}" placeholder="Tuliskan Judul" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Penulis</label>
                                        <input class="form-control" type="text" name="nama" value="{{ $list->nama }}" placeholder="Nama Lengkap Penulis" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Ubah Thumbnail</label><br>
                                        <input type="file" name="file" value="{{ $list->filename }}" class="form-control-file">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <center><label class="form-label">Deskripsi Artikel Berita</label></center>
                                    <textarea class="textarea" name="deskripsi">{{ $list->deskripsi }}</textarea>
                                    {{-- <textarea class="form-control" name="summernote" id="summernote"></textarea> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-end mb-3" type="submit"><i class="mdi mdi-content-save"></i> Simpan Perubahan</button>
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