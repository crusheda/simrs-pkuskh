@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">System /</span> Update
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

    <div class="card card-action mb-4">
        <div class="card-header">
            <div class="card-action-title">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<span>Tambah Data</span>">
                        <i class="bx bx-plus scaleX-n1-rtl"></i>
                        <span class="align-middle">Tambah</span>
                    </button>
                    <button type="button" class="btn btn-label-warning" onclick="refresh()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<span>Segarkan Table</span>">
                        <i class="fas fa-sync"></i>
                        <span class="align-middle">&nbsp;&nbsp;Segarkan</span>
                    </button>
                </div>
            </div>
            <div class="card-action-element">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse show">
            <div class="card-datatable table-responsive text-nowrap">
                <table id="table" class="dt-column-search table table-striped">
                    <thead>
                        <tr>
                            <th class="cell-fit"></th>
                            <th class="cell-fit">RM</th>
                            <th>DOKTER PENGIRIM</th>
                            <th>PASIEN</th>
                            <th>JK/UMUR</th>
                            <th>ALAMAT</th>
                            <th>TGL</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        <tr>
                            <td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="cell-fit"></th>
                            <th class="cell-fit">RM</th>
                            <th>DOKTER PENGIRIM</th>
                            <th>PASIEN</th>
                            <th>JK/UMUR</th>
                            <th>ALAMAT</th>
                            <th>TGL</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
