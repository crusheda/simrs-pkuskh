@extends('layouts.simrsmuv2')

@section('content')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Administrasi / Regulasi /</span> Tambah
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

    <!-- Table -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Filter</h5>
            <div class="dropdown">
                <button class="btn p-0" type="button" id="employeeList" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="employeeList">
                    <a class="dropdown-item" href="javascript:void(0);" onclick="showTotal()">Total Regulasi</a>
                    <a class="dropdown-item" href="{{ route('regulasi.tambah') }}">Tambah Regulasi</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive" style="margin-top: -20px">
                <table class="datatables-users table border-top" id="table">
                    <thead>
                        <tr>
                            <th class="cell-fit"></th>
                            <th class="cell-fit">ID</th>
                            <th style="width: 90px">DISAHKAN</th>
                            <th>JUDUL - UNIT TERKAIT</th>
                            <th class="cell-fit">UNIT PEMBUAT</th>
                            <th style="width: 170px">UPDATE</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        <tr>
                            <td colspan="9">
                                <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="cell-fit"></th>
                            <th class="cell-fit">ID</th>
                            <th style="width: 90px">DISAHKAN</th>
                            <th>JUDUL - UNIT TERKAIT</th>
                            <th class="cell-fit">UNIT PEMBUAT</th>
                            <th style="width: 170px">UPDATE</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>

@endsection
