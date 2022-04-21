@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h4>Tabel Karyawan</h4>
          <div class="card-header-action">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#riwayat-nonaktif" data-placement="bottom" title="RIWAYAT PENONAKTIFAN PEGAWAI"><i class="fa-fw fas fa-history nav-icon"></i> Riwayat Nonaktif</button>
          </div>
        </div>
        <div class="card-body">
            @can('kepegawaian')
                {{-- <div class="row">
                    <div class="col-md-12">
                        <a type="button" class="btn btn-secondary text-white disabled" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">
    
                            </i>
                            Tambah Karyawan
                        </a>
                    </div>
                </div><br> --}}
                <div class="table-responsive">
                    <table id="karyawan" class="table table-striped display table-hover">
                        <thead>
                            <tr>
                                <th>USER_ID</th>
                                <th>NIP</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>ALAMAT (KTP)</th>
                                <th>ALAMAT (DOM)</th>
                                <th>UNIT</th>
                                <th>NO.HP</th>
                                <th>MASUK KERJA</th>
                                <th>JABATAN</th>
                                <th>STATUS KAWIN</th>
                                <th>LAHIR</th>
                                <th>JK</th>
                                <th>SD</th>
                                <th>SMP</th>
                                <th>SMA</th>
                                <th>D1</th>
                                <th>D2</th>
                                <th>D3</th>
                                <th>D4</th>
                                <th>S1</th>
                                <th>S2</th>
                                <th>S3</th>
                                {{-- <th>STR</th> --}}
                                <th>UPDATE</th>
                                <th><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['showSingle']) > 0)
                            @foreach($list['showSingle'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nik }}</td>
                                <td style="text-transform: capitalize">{{ $item->nama }}</td>
                                <td>{{ $item->alamat_ktp }}</td>
                                <td>{{ $item->alamat_dom }}</td>
                                <td>@foreach ($list['user'] as $val) @if ($item->id == $val->id) <kbd>{{ $val->nama_role }}</kbd> @endif @endforeach</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->masuk_kerja }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->status_kawin }}</td>
                                <td>{{ $item->temp_lahir }}, {{ $item->tgl_lahir }}</td>
                                <td>{{ $item->jns_kelamin }}</td>
                                <td>{{ $item->sd }} ({{ $item->th_sd }})</td>
                                <td>{{ $item->smp }} ({{ $item->th_smp }})</td>
                                <td>{{ $item->sma }} ({{ $item->th_sma }})</td>
                                <td>{{ $item->d1 }} ({{ $item->th_d1 }})</td>
                                <td>{{ $item->d2 }} ({{ $item->th_d2 }})</td>
                                <td>{{ $item->d3 }} ({{ $item->th_d3 }})</td>
                                <td>{{ $item->d4 }} ({{ $item->th_d4 }})</td>
                                <td>{{ $item->s1 }} ({{ $item->th_s1 }})</td>
                                <td>{{ $item->s1 }} ({{ $item->th_s2 }})</td>
                                <td>{{ $item->s3 }} ({{ $item->th_s3 }})</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            @if (empty($item->nip) || empty($item->jabatan) || empty($item->masuk_kerja) || empty($item->no_str) || empty($item->masa_str) || empty($item->masa_sip))
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            @else
                                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            @endif
                                            <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ url('kepegawaian/karyawan/profil/'. $item->id) }}'" data-toggle="tooltip" data-placement="bottom" title="LIHAT PROFIL"><i class="fa-fw fas fa-search nav-icon"></i></button>
                                            {{-- <button type="button" class="btn btn-secondary btn-sm disabled"><i class="fa-fw fas fa-search nav-icon"></i></button> --}}
                                            {{-- <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{ url('kepegawaian/'. $item->id) }}'" disabled><i class="fa-fw fas fa-download nav-icon text-white"></i></button> --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#nonaktif{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="NONAKTIFKAN PEGAWAI"><i class="fa-fw fas fa-trash nav-icon text-white"></i></button>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @endcan
        </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          Tabel Karyawan Yang Belum Mengisi  
        </div>
        <div class="card-body">
            @can('kepegawaian')
                <div class="table-responsive">
                    <table id="karyawan2" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>USER_ID</th>
                                <th>USERNAME</th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                {{-- <th>STR</th> --}}
                                <th>UPDATE</th>
                                <th><center>AKSI</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['showSingleBelum']) > 0)
                            @foreach($list['showSingleBelum'] as $val => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td style="text-transform: capitalize">{{ $item->nama }}</td>
                                <td>@foreach ($list['user'] as $val) @if ($item->id == $val->id) <kbd>{{ $val->nama_role }}</kbd> @endif @endforeach</td>
                                {{-- @if (empty($item->no_str))
                                    <td><kbd>Belum Disi</kbd></td>
                                @else
                                    <td>{{ $item->no_str }}</td>
                                @endif --}}
                                <td>{{ $item->updated_at }}</td>
                                {{-- <td>
                                    <center>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{ url('kepegawaian/karyawan/'. $item->id) }}'" disabled><i class="fa-fw fas fa-search nav-icon"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{ url('kepegawaian/'. $item->id) }}'" disabled><i class="fa-fw fas fa-download nav-icon text-white"></i></button>
                                    </center>
                                </td> --}}
                                <td><center><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#nonaktif{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon text-white"></i></button></center></td>
                            </tr>
                            @endforeach
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
</div>

<div class="modal fade bd-example-modal-lg" id="riwayat-nonaktif" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">
          Riwayat Penonaktifan Pegawai
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="nonaktif" class="table table-bordered table-hover display">
                    <thead>
                        <tr>
                            <th>USER ID</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>UNIT</th>
                            <th><center>#</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($list['nonaktif']) > 0)
                            @foreach($list['nonaktif'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>@foreach ($list['user'] as $val) @if ($item->id == $val->id) <kbd>{{ $val->nama_role }}</kbd> @endif @endforeach</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-sm text-white"><i class="fa-fw fas fa-user-check nav-icon text-white"></i> AKTIFKAN</button>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">  
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
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
                          <input type="text" class="form-control" name="nip" value="{{ $item->nip }}" minlength="1" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Jabatan :</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="jabatan" value="{{ $item->jabatan }}" minlength="1">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masuk Kerja :</label>
                        <div class="input-group mb-3">
                          <input type="date" name="masuk_kerja" value="<?php echo strftime('%Y-%m-%d', strtotime($item->masuk_kerja)); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Nomor STR :</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="no_str" value="{{ $item->no_str }}" minlength="1">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masa STR :</label>
                        <div class="input-group mb-3">
                          <input type="date" name="masa_str" value="<?php echo strftime('%Y-%m-%d', strtotime($item->masa_str)); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masa SIP :</label>
                        <div class="input-group mb-3">
                          <input type="date" name="masa_sip" value="<?php echo strftime('%Y-%m-%d', strtotime($item->masa_sip)); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="pengalaman_kerja" class="control-label">Pengalaman Kerja :</label>
                          <textarea class="form-control" name="pengalaman_kerja" placeholder="" disabled><?php echo htmlspecialchars($item->pengalaman_kerja); ?></textarea>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
{{-- NONAKTIF KARYAWAN --}}
<div class="modal fade bd-example-modal-lg" id="nonaktif{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Nonaktif Karyawan ID: {{ $item->id }}
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    <a>Apakah anda yakin ingin menonaktifkan karyawan a/n <b>{{ $item->nama }}</b> ?</a><br><br>
                    <a>
                        <b>CATATAN : </b><br>
                        Penonaktifan pegawai hanya bertujuan untuk mengubah status pegawai menjadi nonaktif, tidak untuk menghapus Akun Pengguna. Apabila ingin melakukan <strong>Penghapusan Akun & Hak Akses Pengguna</strong> silakan Hubungi IT. 
                    </a>
                </p>
            </div>
            <div class="modal-footer">
                @if(count($list) > 0)
                <form action="{{ route('kepegawaian.karyawan.nonaktif', $item->id) }}" method="GET">
                  @csrf
                  <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
                </form>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
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
                  {
                    extend: 'copyHtml5',
                    className: 'btn-info',
                    text: 'Salin Baris',
                    download: 'open',
                  },
                  {
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    text: 'Export Excell',
                    download: 'open',
                  },
                  {
                    extend: 'pdfHtml5',
                    className: 'btn-warning',
                    text: 'Cetak PDF',
                    download: 'open',
                  },
                  {
                    extend: 'colvis',
                    className: 'btn-dark',
                    text: 'Sembunyikan Kolom',
                    exportOptions: {
                        columns: ':visible'
                    }
                  },
                ],
                'columnDefs': [
                    { targets: 0, visible: false },
                    { targets: 2, visible: false },
                    { targets: 5, visible: false },
                    { targets: 7, visible: false },
                    { targets: 8, visible: false },
                    { targets: 9, visible: false },
                    { targets: 10, visible: false },
                    { targets: 12, visible: false },
                    { targets: 13, visible: false },
                    { targets: 14, visible: false },
                    { targets: 15, visible: false },
                    { targets: 16, visible: false },
                    { targets: 17, visible: false },
                    { targets: 18, visible: false },
                    { targets: 19, visible: false },
                    { targets: 20, visible: false },
                    { targets: 21, visible: false },
                    { targets: 22, visible: false },
                ],
                order: [[ 24, "desc" ]],
                pageLength: 20
            }
        );
        $('#karyawan2').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                  {
                    extend: 'copyHtml5',
                    className: 'btn-info',
                    text: 'Salin Baris',
                    download: 'open',
                  },
                  {
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    text: 'Export Excell',
                    download: 'open',
                  },
                  {
                    extend: 'pdfHtml5',
                    className: 'btn-warning',
                    text: 'Cetak PDF',
                    download: 'open',
                  },
                  {
                    extend: 'colvis',
                    className: 'btn-dark',
                    text: 'Sembunyikan Kolom',
                    exportOptions: {
                        columns: ':visible'
                    }
                  },
                ],
                order: [[ 3, "desc" ]],
            }
        );
        $('#nonaktif').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                  {
                    extend: 'copyHtml5',
                    className: 'btn-info',
                    text: 'Salin Baris',
                    download: 'open',
                  },
                  {
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    text: 'Export Excell',
                    download: 'open',
                  },
                  {
                    extend: 'pdfHtml5',
                    className: 'btn-warning',
                    text: 'Cetak PDF',
                    download: 'open',
                  },
                  {
                    extend: 'colvis',
                    className: 'btn-dark',
                    text: 'Sembunyikan Kolom',
                    exportOptions: {
                        columns: ':visible'
                    }
                  },
                ],
                order: [[ 1, "asc" ]],
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
@endsection