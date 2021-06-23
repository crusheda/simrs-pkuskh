@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
    @can('kepegawaian')
    <div class="col-md-3">
        <div class="card">
            @if (empty($list['show'][0]->filename))
                <img class="card-img-top img-thumbnail" src="{{ url('img/user_unknown.jpg') }}" height="300" alt="Card image cap">
            @else
                <img class="card-img-top img-thumbnail" src="{{ url('storage/'.substr($list['show'][0]->filename,7,1000)) }}" height="300" alt="Card image cap">
            @endif
            <div class="card-body">
                <center><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ubahFoto" disabled><i class="fa-fw fas fa-download nav-icon"></i> Download</button></center>
            </div>
        </div>
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fa-fw fas fa-plus nav-icon"></i> Ditembahkan Pada : <b>{{ $list['show'][0]->created_at }}</b></li>
                <li class="list-group-item"><i class="fa-fw fas fa-history nav-icon"></i> Diupdate Pada : <b>{{ \Carbon\Carbon::parse($list['show'][0]->updated_at)->diffForHumans() }}</b></li>
            </ul>
        </div>
        <div class="card card-body">
            <form class="form-auth-small" action="{{ route('kepegawaian.karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="number" class="form-control" name="id" value="{{ $list['show'][0]->id }}" hidden>
                <h6 class="text-center"><b>Dokumen Kepegawaian</b></h6><br>
                <div class="row">
                    <div class="col-md-12">
                        <label>NIP :</label>
                        <div class="input-group mb-3">
                            @if (empty($list['show'][0]->nip))
                                <input type="text" class="form-control is-invalid" name="nip" id="nip" placeholder="e.g. 11.1x.xxx" required>
                                <div class="invalid-feedback">
                                    Tuliskan Nomor Induk Pegawai Anda.
                                </div>
                            @else
                                <input type="text" class="form-control" name="nip" value="{{ $list['show'][0]->nip }}" minlength="1" required>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Jabatan :</label>
                        <div class="input-group mb-3">
                            @if (empty($list['show'][0]->jabatan))
                                <input type="text" class="form-control is-invalid" name="jabatan" id="jabatan" placeholder="e.g. Staff">
                                <div class="invalid-feedback">
                                    Tuliskan Jabatan Anda.
                                </div>
                            @else
                                <input type="text" class="form-control" name="jabatan" value="{{ $list['show'][0]->jabatan }}" minlength="1">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masuk Kerja :</label>
                        <div class="input-group mb-3">
                            @if (empty($list['show'][0]->masuk_kerja))
                                <input type="date" name="masuk_kerja" class="form-control">
                            @else
                                <input type="date" name="masuk_kerja" value="<?php echo strftime('%Y-%m-%d', strtotime($list['show'][0]->masuk_kerja)); ?>" class="form-control">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Nomor STR :</label>
                        <div class="input-group mb-3">
                            @if (empty($list['show'][0]->no_str))
                                <input type="text" class="form-control is-invalid" name="no_str" id="no_str" placeholder="e.g. 11 1x xxx-xx">
                                <div class="invalid-feedback">
                                    Tuliskan Nomor Surat Tanda Registrasi Anda.
                                </div>
                            @else
                                <input type="text" class="form-control" name="no_str" value="{{ $list['show'][0]->no_str }}" minlength="1">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masa STR :</label>
                        <div class="input-group mb-3">
                            @if (empty($list['show'][0]->masa_str))
                                <input type="date" name="masa_str" class="form-control">
                            @else
                                <input type="date" name="masa_str" value="<?php echo strftime('%Y-%m-%d', strtotime($list['show'][0]->masa_str)); ?>" class="form-control">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masa SIP :</label>
                        <div class="input-group mb-3">
                            @if (empty($list['show'][0]->masa_sip))
                                <input type="date" name="masa_sip" class="form-control">
                            @else
                                <input type="date" name="masa_sip" value="<?php echo strftime('%Y-%m-%d', strtotime($list['show'][0]->masa_sip)); ?>" class="form-control">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pengalaman_kerja" class="control-label">Pengalaman Kerja :</label>
                            <textarea class="form-control" name="pengalaman_kerja" id="pengalaman_kerja" placeholder="" disabled><?php echo htmlspecialchars($list['show'][0]->pengalaman_kerja); ?></textarea>
                        </div>
                    </div>
                </div>
                <center><button type="submit" class="btn btn-success">SIMPAN</button></center>
            </form>
        </div>
    </div>

    {{-- batas --}}

    <div class="col-md-9">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <a class="btn btn-primary btn-sm" href="{{ route("kepegawaian.karyawan.index") }}">
                    Kembali
                </a>&nbsp;&nbsp;&nbsp;Detail Karyawan

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Kepegawaian
                </span>
                
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-sm btn-danger text-white pull-left" disabled><i class="fa-fw fas fa-check-square nav-icon"></i> LIHAT STATUS</button>
                <button type="button" class="btn btn-sm btn-warning text-white pull-right" onclick="window.location.href='{{ url('kepegawaian/karyawan/cetak/'. $list['show'][0]->id) }}'" disabled><i class="fa-fw fas fa-print nav-icon"></i> CETAK DOKUMEN</button><br><br>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DETAIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><kbd>ID</kbd></th>
                                <td>{{ $list['show'][0]->id }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $list['show'][0]->nik }}</td>
                            </tr>
                            <tr>
                                <th>NAMA</th>
                                <td>{{ $list['show'][0]->nama }}</td>
                            </tr>
                            <tr>
                                <th>PANGGILAN</th>
                                <td>{{ $list['show'][0]->nick }}</td>
                            </tr>
                            <tr>
                                <th>TTL</th>
                                <td>{{ $list['show'][0]->temp_lahir }}, {{ $list['show'][0]->tgl_lahir }}</td>
                            </tr>
                            <tr>
                                <th>JENIS KELAMIN</th>
                                <td>{{ $list['show'][0]->jns_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>STATUS KAWIN</th>
                                <td>{{ $list['show'][0]->status_kawin }}</td>
                            </tr>
                            <tr>
                                <th>EMAIL</th>
                                <td>{{ $list['show'][0]->email }}</td>
                            </tr>
                            <tr>
                                <th>NO HP</th>
                                <td>{{ $list['show'][0]->no_hp }}</td>
                            </tr>
                            <tr>
                                <th>INSTAGRAM</th>
                                <td>{{ $list['show'][0]->ig }}</td>
                            </tr>
                            <tr>
                                <th>FACEBOOK</th>
                                <td>{{ $list['show'][0]->fb }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th><kbd>ALAMAT KTP</kbd></th>
                                <td>{{ $list['show'][0]->alamat_ktp }}</td>
                            </tr>
                            <tr>
                                <th>PROVINSI</th>
                                <td>{{ $list['show'][0]->ktp_provinsi }}</td>
                            </tr>
                            <tr>
                                <th>KABUPATEN</th>
                                <td>{{ $list['show'][0]->ktp_kabupaten }}</td>
                            </tr>
                            <tr>
                                <th>KECAMATAN</th>
                                <td>{{ $list['show'][0]->ktp_kecamatan }}</td>
                            </tr>
                            <tr>
                                <th>KELURAHAN</th>
                                <td>{{ $list['show'][0]->ktp_kelurahan }}</td>
                            </tr>
                            <tr>
                                <th><kbd>ALAMAT DOMISILI</kbd></th>
                                <td>{{ $list['show'][0]->alamat_dom }}</td>
                            </tr>
                            <tr>
                                <th>PROVINSI</th>
                                <td>{{ $list['show'][0]->dom_provinsi }}</td>
                            </tr>
                            <tr>
                                <th>KABUPATEN</th>
                                <td>{{ $list['show'][0]->dom_kabupaten }}</td>
                            </tr>
                            <tr>
                                <th>KECAMATAN</th>
                                <td>{{ $list['show'][0]->dom_kecamatan }}</td>
                            </tr>
                            <tr>
                                <th>KELURAHAN</th>
                                <td>{{ $list['show'][0]->dom_kelurahan }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>TAHUN LULUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><kbd>SD</kbd></th>
                                <td>{{ $list['show'][0]->sd }}</td>
                                <td>{{ $list['show'][0]->th_sd }}</td>
                            </tr>
                            <tr>
                                <th><kbd>SMP</kbd></th>
                                <td>{{ $list['show'][0]->smp }}</td>
                                <td>{{ $list['show'][0]->th_smp }}</td>
                            </tr>
                            <tr>
                                <th><kbd>SMA</kbd></th>
                                <td>{{ $list['show'][0]->sma }}</td>
                                <td>{{ $list['show'][0]->th_sma }}</td>
                            </tr>
                            <tr>
                                <th><kbd>D1</kbd></th>
                                <td>{{ $list['show'][0]->d1 }}</td>
                                <td>{{ $list['show'][0]->th_d1 }}</td>
                            </tr>
                            <tr>
                                <th><kbd>D2</kbd></th>
                                <td>{{ $list['show'][0]->d2 }}</td>
                                <td>{{ $list['show'][0]->th_d2 }}</td>
                            </tr>
                            <tr>
                                <th><kbd>D3</kbd></th>
                                <td>{{ $list['show'][0]->d3 }}</td>
                                <td>{{ $list['show'][0]->th_d3 }}</td>
                            </tr>
                            <tr>
                                <th><kbd>D4</kbd></th>
                                <td>{{ $list['show'][0]->d4 }}</td>
                                <td>{{ $list['show'][0]->th_d4 }}</td>
                            </tr>
                            <tr>
                                <th><kbd>S1</kbd></th>
                                <td>{{ $list['show'][0]->s1 }}</td>
                                <td>{{ $list['show'][0]->th_s1 }}</td>
                            </tr>
                            <tr>
                                <th><kbd>S2</kbd></th>
                                <td>{{ $list['show'][0]->s2 }}</td>
                                <td>{{ $list['show'][0]->th_s2 }}</td>
                            </tr>
                            <tr>
                                <th><kbd>S3</kbd></th>
                                <td>{{ $list['show'][0]->s3 }}</td>
                                <td>{{ $list['show'][0]->th_s3 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>RIWAYAT PENYAKIT</th>
                                <td>{{ $list['show'][0]->riwayat_penyakit }}</td>
                            </tr>
                            <tr>
                                <th>RIWAYAT PENYAKIT KELUARGA</th>
                                <td>{{ $list['show'][0]->riwayat_penyakit_keluarga }}</td>
                            </tr>
                            <tr>
                                <th>RIWAYAT OPERASI</th>
                                <td>{{ $list['show'][0]->riwayat_operasi }}</td>
                            </tr>
                            <tr>
                                <th>RIWAYAT PENGGUNAAN OBAT</th>
                                <td>{{ $list['show'][0]->riwayat_penggunaan_obat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
    @endcan
</div>

<script>
    $(document).ready( function () {
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
        
        // $('#max_pengalaman_kerja').text('190 Limit Text');
        // $('#pengalaman_kerja').keydown(function () {
        //     var max = 190;
        //     var len = $(this).val().length;
        //     if (len >= max) {
        //         $('#max_pengalaman_kerja').text('Anda telah mencapai Limit Maksimal.');          
        //     } 
        //     else {
        //         var ch = max - len;
        //         $('#max_pengalaman_kerja').text(ch + ' Limit Text');     
        //     }
        // });
    });
</script>

{{-- <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Karyawan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('kepegawaian.karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <select class="fstdropdown-select" name="id" id="karyawan">
                                <option selected hidden>Pilih Karyawan</option>
                                @foreach ($list['show'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <label>Kegiatan : </label>
                        <input type="text" name="kegiatan" id="kegiatan" class="form-control" placeholder="" required>
                        <br>
                        <label>Lokasi :</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                        <br>
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""></textarea>
                        <br>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div> --}}

{{-- <script>
    $(document).ready( function () {
        $('#karyawan').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 0, "desc" ]],
            }
        );
    } );
</script> --}}
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