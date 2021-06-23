@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-male nav-icon text-info">
        
            </i> Tabel Karyawan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kepegawaian
            </span>
            
        </div>
        <div class="card-body">
            @can('kepegawaian')
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" class="btn btn-secondary text-white disabled" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">
    
                            </i>
                            Tambah Karyawan
                        </a>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table id="karyawan" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>USER_ID</th>
                                <th>NIP</th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                {{-- <th>STR</th> --}}
                                <th>UPDATE</th>
                                <th><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nama_role }}</td>
                                {{-- @if (empty($item->no_str))
                                    <td><kbd>Belum Disi</kbd></td>
                                @else
                                    <td>{{ $item->no_str }}</td>
                                @endif --}}
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                        <button type="button" class="btn btn-dark btn-sm" onclick="window.location.href='{{ url('kepegawaian/karyawan/'. $item->id) }}'"><i class="fa-fw fas fa-search nav-icon"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{ url('kepegawaian/'. $item->id) }}'" disabled><i class="fa-fw fas fa-download nav-icon text-white"></i></button>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan=6>Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
            @endcan
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Dokumen Kepegawaian
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('kepegawaian.karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="number" class="form-control" name="id" value="{{ $item->id }}" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <label>NIP :</label>
                        <div class="input-group mb-3">
                            @if (empty($item->nip))
                                <input type="text" class="form-control is-invalid" name="nip" id="nip" placeholder="e.g. 11.1x.xxx" required>
                                <div class="invalid-feedback">
                                    Tuliskan Nomor Induk Pegawai Anda.
                                </div>
                            @else
                                <input type="text" class="form-control" name="nip" value="{{ $item->nip }}" minlength="1" required>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Jabatan :</label>
                        <div class="input-group mb-3">
                            @if (empty($item->jabatan))
                                <input type="text" class="form-control is-invalid" name="jabatan" id="jabatan" placeholder="e.g. Staff">
                                <div class="invalid-feedback">
                                    Tuliskan Jabatan Anda.
                                </div>
                            @else
                                <input type="text" class="form-control" name="jabatan" value="{{ $item->jabatan }}" minlength="1">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masuk Kerja :</label>
                        <div class="input-group mb-3">
                            @if (empty($item->masuk_kerja))
                                <input type="date" name="masuk_kerja" class="form-control">
                            @else
                                <input type="date" name="masuk_kerja" value="<?php echo strftime('%Y-%m-%d', strtotime($item->masuk_kerja)); ?>" class="form-control">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Nomor STR :</label>
                        <div class="input-group mb-3">
                            @if (empty($item->no_str))
                                <input type="text" class="form-control is-invalid" name="no_str" id="no_str" placeholder="e.g. 11 1x xxx-xx">
                                <div class="invalid-feedback">
                                    Tuliskan Nomor Surat Tanda Registrasi Anda.
                                </div>
                            @else
                                <input type="text" class="form-control" name="no_str" value="{{ $item->no_str }}" minlength="1">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masa STR :</label>
                        <div class="input-group mb-3">
                            @if (empty($item->masa_str))
                                <input type="date" name="masa_str" class="form-control">
                            @else
                                <input type="date" name="masa_str" value="<?php echo strftime('%Y-%m-%d', strtotime($item->masa_str)); ?>" class="form-control">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masa SIP :</label>
                        <div class="input-group mb-3">
                            @if (empty($item->masa_sip))
                                <input type="date" name="masa_sip" class="form-control">
                            @else
                                <input type="date" name="masa_sip" value="<?php echo strftime('%Y-%m-%d', strtotime($item->masa_sip)); ?>" class="form-control">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pengalaman_kerja" class="control-label">Pengalaman Kerja :</label>
                            <textarea class="form-control" name="pengalaman_kerja" id="pengalaman_kerja" placeholder="" disabled><?php echo htmlspecialchars($item->pengalaman_kerja); ?></textarea>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready( function () {
        $('#karyawan').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 5, "desc" ]],
            }
        );
        
        // VALIDASI INPUT NUMBER
        $('input[type=number][max]:not([max=""])').on('input', function(ev) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
            $this.val(value.substr(0, maxlength));
            }
        });

        // VALIDASI INPUT FORMULIR BIODATA
        $('#nip').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#nip').removeClass('is-invalid');          
            } 
            else {
                $('#nip').addClass('is-invalid');     
            }
        });
        $('#jabatan').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#jabatan').removeClass('is-invalid');          
            } 
            else {
                $('#jabatan').addClass('is-invalid');     
            }
        });
        $('#no_str').keydown(function () {
            var len = $(this).val().length;
            if (len >= 1) {
                $('#no_str').removeClass('is-invalid');          
            } 
            else {
                $('#no_str').addClass('is-invalid');     
            }
        });
    } );
</script>
{{-- <script>
    function submitBtn() {
        var bulan = document.getElementById("bulan").value;
        var tahun = document.getElementById("tahun").value;
        if (bulan != "Bln" && tahun != "Thn" ) {
            document.getElementById("submit").disabled = false;
        }
    }
</script> --}}

@endsection