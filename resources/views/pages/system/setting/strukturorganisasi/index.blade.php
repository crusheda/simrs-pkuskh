@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">System / Setting /</span> Struktur Organisasi
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
                    <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambah"
                        value="animate__jackInTheBox">
                        <i class="bx bx-upload scaleX-n1-rtl"></i>
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
        <hr style="margin-top: -5px">
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
                        @if (count($list['show']) > 0)
                            @foreach ($list['show'] as $item)
                                <tr>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#ubah{{ $item->id }}"><i
                                                        class="fa-fw fas fa-edit nav-icon"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapus{{ $item->id }}"><i
                                                        class="fa-fw fas fa-trash nav-icon"
                                                        value="animate__rubberBand"></i></button>
                                            </div>
                                        </center>
                                    </td>
                                    <td>{{ $item->id }}</td>
                                    <td><kbd>{{ $item->role_id }}</kbd>&nbsp;{{ $item->role_name }}</td>
                                    <td>
                                        <ul>
                                            @foreach (json_decode($item->accepted) as $i => $key)
                                                @foreach ($list['role'] as $rl)
                                                    @if ($key == $rl->id)
                                                        <li>{{ $rl->name }}</li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                            @endforeach
                        @endif
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
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="tambah" role="dialog"
        aria-labelledby="confirmFormLabel"aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form class="form-auth-small" name="formTambah" action="{{ route('strukturorganisasi.store') }}"
                    method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Form Tambah
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Atasan</label>
                                    <select class="form-select select2" name="role" required>
                                        <option value="">Pilih Role</option>
                                        @if (count($list['role']) > 0)
                                            @foreach ($list['role'] as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Bawahan</label>
                                    <select class="select2 form-select" name="accepted[]" data-allow-clear="true"
                                        data-bs-auto-close="outside" required multiple>
                                        @if (count($list['role']) > 0)
                                            @foreach ($list['role'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i
                                class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                </form>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @if (count($list['show']) > 0)
        @foreach ($list['show'] as $item)
            {{-- MODAL HAPUS --}}
            <div class="modal fade animate__animated animate__rubberBand" id="hapus{{ $item->id }}" role="dialog">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Hapus Struktur <kbd>ID : {{ $item->id }}</kbd>
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input type="text" id="id_hapus" hidden>
                                    <p style="text-align: justify;">Anda akan menghapus berkas surat masuk tersebut.
                                        Penghapusan berkas akan menyebabkan hilangnya data/dokumen yang terhapus tersebut pada
                                        Storage Sistem.
                                        Maka dari itu, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan
                                        penghapusan.</p>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1"><i
                                            class="fa fa-trash"></i> Hapus</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close"><i class="fa fa-times"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

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
