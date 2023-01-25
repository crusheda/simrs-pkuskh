@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Publik /</span> Pengadaan
    </h4>

    @if (session('message'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
            <p class="mb-0">{{ session('message') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if ($errors->count() > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
            <p class="mb-0">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <div class="card card-action mb-5">
        <div class="card-header">
            <div class="card-action-title">
                <div class="btn-group">
                    <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah" value="animate__jackInTheBox">
                        <i class="bx bx-upload scaleX-n1-rtl"></i>
                        <span class="align-middle">Upload</span>
                    </a>
                    <button type="button" class="btn btn-label-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="refresh()">
                        <i class="fa-fw fas fa-sync nav-icon"></i></button>
                </div>
            </div>
            <div class="card-action-element">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <hr style="margin-top: -5px">
        <div class="collapse show">
            <div class="card-datatable table-responsive">
                <table id="table" class="table table-striped display">
                    <thead>
                        <tr>
                            <th class="cell-fit">
                                <center></center>
                            </th>
                            <th class="cell-fit">NO</th>
                            <th class="cell-fit">TGL SURAT</th>
                            <th class="cell-fit">TGL DITERIMA</th>
                            <th>ASAL/NO.SRT</th>
                            <th>DESKRIPSI</th>
                            <th>TEMPAT/ACARA</th>
                            <th>UPDATE</th>
                            <th class="cell-fit">USER</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        <tr>
                            <td colspan="9">
                                <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-whitesmoke">
                        <tr>
                            <th class="cell-fit">
                                <center></center>
                            </th>
                            <th class="cell-fit">NO</th>
                            <th class="cell-fit">TGL SURAT</th>
                            <th class="cell-fit">TGL DITERIMA</th>
                            <th>ASAL/NO.SRT</th>
                            <th>DESKRIPSI</th>
                            <th>TEMPAT/ACARA</th>
                            <th>UPDATE</th>
                            <th class="cell-fit">USER</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
