@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Laporan / PPI /</span> Surveilans
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
                    <a class="btn btn-primary text-white" href="{{ route('surveilans.create') }}">
                        <i class="bx bx-plus scaleX-n1-rtl"></i>
                        <span class="align-middle">Tambah</span>
                    </a>
                    {{-- <button type="button" class="btn btn-label-warning" data-bs-toggle="tooltip" data-bs-offset="0,4"
                        data-bs-placement="bottom" data-bs-html="true"
                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="refresh()">
                        <i class="fa-fw fas fa-sync nav-icon"></i></button> --}}
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
        {{-- <hr style="margin-top: -5px">
        <div class="collapse show">
            <div class="card-datatable table-responsive">
                <table id="table" class="table table-striped display">
                    <thead>
                        <tr>
                            <th class="cell-fit">
                                <center></center>
                            </th>
                            <th class="cell-fit">ID</th>
                            <th>ROLE</th>
                            <th>ACCEPTED</th>
                            <th>UPDATE</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">

                    </tbody>
                    <tfoot class="bg-whitesmoke">
                        <tr>
                            <th class="cell-fit">
                                <center></center>
                            </th>
                            <th class="cell-fit">ID</th>
                            <th>ROLE</th>
                            <th>ACCEPTED</th>
                            <th>UPDATE</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div> --}}
    </div>

    <script>
        $(document).ready(function() {
            // $("html").addClass('layout-menu-collapsed');

            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "",
                    dropdownParent: e.parent()
                })
            });
        })

        // FUNCTION-FUNTCION
        function saveData() {
            $("#tambah").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").removeClass("fa-save").addClass("fa-sync fa-spin");
                // $('#tambah').modal('hide');
                // fresh();
                // refresh();
                return true;
            });
        }
    </script>
@endsection
