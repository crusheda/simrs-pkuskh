@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">
<style>
    
</style>
<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-list-alt nav-icon text-info">

                </i> Laporan Kecelakaan Kerja

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses K3
                </span>
                
            </div>
            <div class="card-body">
                @can('accident_report')
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambahbayi">
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah Laporan
                            </a>
                        </div>
                    </div><br>
                    <div class="table-responsive">
                        <table id="skl" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KORBAN</th>
                                    <th>UNIT</th>
                                    <th>LOKASI</th>
                                    <th>TGL</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['show']) > 0)
                                <div hidden>{{ $id = 1 }}</div>
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $id++ }}</td>
                                    <td>{{ $item->korban }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ $item->tgl }}</td>
                                    <td>
                                        <center>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                            <a type="button" class="btn btn-warning btn-sm disabled">
                                                <i class="fa-fw fas fa-print nav-icon"></i>
                                            </a>
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
</div>

<div class="modal fade bd-example-modal-lg" id="tambahbayi" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Laporan Kecelakaan Kerja <span class="badge badge-primary">Accident Report</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('accidentreport.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="container">
                        <h4>A. Identifikasi Kecelakaan</h4><hr>
                        <div class="row">
                            <div class="col">
                                <label>Waktu :</label>
                                <input type="datetime-local" name="tgl" id="tgl" class="form-control" placeholder="">
                            </div>
                            <div class="col">
                                <label>Lokasi : </label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Jenis Kecelakaan : </label>
                                <select onchange="jenisBtn()" class="custom-select" name="jenis" id="jenis">
                                    <option hidden>Pilih</option>
                                    <option value="1">Menabrak</option>
                                    <option value="2">Tertabrak</option>
                                    <option value="3">Terperangkap</option>
                                    <option value="4">Terbentur / Terpukul</option>
                                    <option value="5">Tergelincir</option>
                                    <option value="6">Terjepit</option>
                                    <option value="7">Tersangkut</option>
                                    <option value="8">Tertimbun</option>
                                    <option value="9">Terhirup</option>
                                    <option value="10">Tenggelam</option>
                                    <option value="11">Jatuh dari ketinggian yang sama</option>
                                    <option value="12">Jatuh dari ketinggian yang berbeda</option>
                                    <option value="13">Lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div id="lainlain" class="row" hidden>
                            <div class="col">
                                <label>Lain-lain :</label>
                                <textarea class="form-control" name="lain1" id="lain1" placeholder=""></textarea><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Kronologi Kecelakaan :</label>
                                <textarea class="form-control" name="kronologi" id="kronologi" placeholder=""></textarea>
                            </div>
                        </div>
                        <hr><h4>B. Kerugian</h4><hr>
                        <div class="row">
                            <div class="col">
                                <label>Kerugian Pada Manusia : </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa-fw fas fa-question nav-icon text-light"></i>
                                        </button>
                                    </div>
                                    <select onchange="infoBtn()" class="custom-select" name="kerugian" id="kerugian">
                                        <option hidden>Pilih</option>
                                        <option value="1">Tak Cedera</option>
                                        <option value="2">Cedera Ringan</option>
                                        <option value="3">Cedera Sedang</option>
                                        <option value="4">Cedera Berat</option>
                                        <option value="5">Meninggal/Fatal</option>
                                    </select>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <p>
                                            - <b>Tak Cedera</b> (Tidak ada cedera dan tidak ada hilang hari kerja) <br>
                                            - <b>Cedera Ringan</b> (Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang hari kerja) <br>
                                            - <b>Cedera Sedang</b> (Mengalami cedera yang memerlukan pertolongan medis tapi adanya hilang hari kerja) <br>
                                            - <b>Cedera Berat</b> (Mengalami cedera yang memerlukan pertolongan medis dan atau rujukan medis, cacat sementara dan adanya hilang hari kerja) <br>
                                            - <b>Meninggal/Fatal</b> (Mengalami cacat permanen atau kematian)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Nama Korban : </label>
                                <input type="text" name="korban" id="korban" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir :</label>
                                <input type="date" name="lahir" id="lahir" class="form-control" placeholder="">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-control">
                                      <option hidden>Pilih</option>
                                      <option value="laki-laki">Laki-laki</option>
                                      <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label>Unit :</label>
                                <select class="custom-select" name="unit" id="unit" required>
                                    <option hidden>Pilih</option>
                                    @foreach($list['unit'] as $name => $item)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label>Bila cedera / cacat, anggota tubuh mana yang terkena? </label>
                        <input type="text" name="cedera" id="cedera" class="form-control" placeholder="" required>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>Kerugian Aset/Material/Proses : </label>
                                <input type="text" name="k_aset" id="k_aset" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Kerugian Lingkungan : </label>
                                <input type="text" name="k_lingkungan" id="k_lingkungan" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <hr><h4>C. Investigasi Kecelakaan</h4><hr>
                        <h5>1. Penyebab Langsung</h5>
                        <div class="row">
                            <div class="col">
                                <label>Tindakan Tidak Aman <i>(Unsafe Action)</i> : </label>
                                <input type="text" name="tta" id="tta" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Kondisi Tidak Aman <i>(Unsafe Condition)</i> : </label>
                                <input type="text" name="kta" id="kta" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <br>
                        <h5>2. Penyebab Dasar</h5>
                        <div class="row">
                            <div class="col">
                                <label>Faktor Personal : </label>
                                <input type="text" name="f_personal" id="f_personal" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Faktor Pekerjaan : </label>
                                <input type="text" name="f_pekerjaan" id="f_pekerjaan" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <br>
                        <h5>3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Peralatan Kerja : </label>
                                <input type="text" name="p_kerja" id="p_kerja" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Benda Bergerak : </label>
                                <input type="text" name="benda_bergerak" id="benda_bergerak" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Mesin : </label>
                                <input type="text" name="mesin" id="mesin" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Bejana Tekan : </label>
                                <input type="text" name="bejana_tekan" id="bejana_tekan" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Material : </label>
                                <input type="text" name="material" id="material" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Alat Listrik : </label>
                                <input type="text" name="alat_listrik" id="alat_listrik" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Alat Berat : </label>
                                <input type="text" name="alat_berat" id="alat_berat" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Radiasi : </label>
                                <input type="text" name="radiasi" id="radiasi" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Kendaraan : </label>
                                <input type="text" name="kendaraan" id="kendaraan" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label>Binatang : </label>
                                <input type="text" name="binatang" id="binatang" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-md-12">
                                <label>Lain-lain : </label>
                                <textarea class="form-control" name="lain2" id="lain2" placeholder=""></textarea>
                            </div>
                        </div>
                        <hr><h4>D. Rencana Tindakan Perbaikan</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Rencana Tindakan : </label>
                                <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder=""></textarea>
                            </div>
                            <div class="col-md-3">
                                <label>Target Waktu : </label>
                                <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder=""></textarea>
                            </div>
                            <div class="col-md-3">
                                <label>Wewenang : </label>
                                <textarea class="form-control" name="wewenang" id="wewenang" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#skl').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ],
            order: [[ 1, "desc" ]]
        }
    );
} );
</script>
<script>
    function jenisBtn() {
        var val = document.getElementById("jenis").value;
        if (val != 13) {
            document.getElementById("lainlain").hidden = true;
        }else{
            document.getElementById("lainlain").hidden = false;
        }
    }
</script>
@endsection