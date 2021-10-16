<?php header('Access-Control-Allow-Origin: *'); ?>
@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-list-alt nav-icon text-info">

            </i> Daftar Bantu VAP (Ventilator Associated Pneumonia)

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Pribadi
            </span>
            
        </div>
        <div class="card-body">
            @can('surveilans-ppi')
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah
                            </button>
                            @role('ppi')
                                <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#formula">
                                    <i class="fa-fw fas fa-calculator nav-icon">
            
                                    </i>
                                    Formula
                                </button>
                            @endrole
                            <button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#kamus" data-toggle="tooltip" data-placement="bottom" title="Kamus Indikator"><i class="fa-fw fas fa-feed nav-icon"></i></button>
                        </div>
                    </div>
                </div><hr>
                <div class="table-responsive">
                    <table id="table" class="table table-striped display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NO RM</th>
                                <th>NAMA</th>
                                <th>UMUR</th>
                                <th>TGL PENCATATAN</th>
                                <th>DIAGNOSIS</th>
                                <th>TANDA / GEJALA</th>
                                <th>HASIL BACAAN RO THORAX</th>
                                <th>TGL DITAMBAHKAN</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->rm }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->umur }}</td>
                                <td>{{ $item->tgl_dicatat }}</td>
                                <td>{{ $item->diagnosis }}</td>
                                <td>{{ $item->gejala }}</td>
                                <td>{{ $item->hasil }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <center>
                                        @role('ppi|it')
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                            </div>
                                        @else
                                            <div class="btn-group" role="group">
                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') == \Carbon\Carbon::now()->isoFormat('YYYY/MM/DD'))
                                                    <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                    <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                @endif
                                            </div>
                                        @endrole
                                    </center>
                                </td>
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

@can('surveilans-ppi')
<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('vap.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="rm">*No. Rekam Medik</label>
                                <div class="input-group mx-sm-3">
                                    <input type="number" name="rm" id="rm_save" class="form-control" hidden>
                                    <input type="number" id="rm" max="99999999" class="form-control" placeholder="" aria-describedby="helprm" autofocus required>
                                    <div class="input-group-prepend">
                                        <button class="btn btn-warning text-white" id="clearfx" onclick="hapusRm()"><i class="fa-fw fas fa-eraser nav-icon"></i></button>
                                    </div>
                                </div>
                                <small id="helprm" class="text-muted">
                                    Apabila RM Pasien sesuai, Nama dan Umur pasien akan muncul otomatis.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nama Pasien :</label>
                            <input type="text" name="nama" id="nama" class="form-control" hidden>
                            <input type="text" id="nama_show" class="form-control" placeholder="..." disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Umur :</label>
                            <input type="text" name="umur" id="umur" class="form-control" hidden>
                            <input type="text" id="umur_show" class="form-control" placeholder="..." disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>*Tgl Pencatatan :</label>
                            <input type="date" name="tgl_dicatat" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Diagnosis :</label>
                            <input type="text" name="diagnosis" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Tanda / Gejala :</label>
                            <input type="text" name="gejala" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>*Hasil Bacaan RO Thorax :</label>
                    <textarea class="form-control" rows="5" name="hasil" required></textarea>
                </div>

        </div>
        <div class="modal-footer">
                User :&nbsp;<strong>{{ Auth::user()->nama }}</strong> 
                <button class="btn btn-secondary" id="btn-simpan" disabled><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
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
            Ubah Data&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">{{ $item->updated_at->diffForHumans() }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('vap.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label><kbd>Rekam Medik</kbd></label>
                            <input type="text" value="{{ $item->rm }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nama :</label>
                            <input type="text" value="{{ $item->nama }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Umur :</label>
                            <input type="text" value="{{ $item->umur }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>*Tgl Pencatatan :</label>
                            <input type="date" name="tgl_dicatat" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl_dicatat)); ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Diagnosis :</label>
                            <input type="text" name="diagnosis" value="{{ $item->diagnosis }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Tanda / Gejala :</label>
                            <input type="text" name="gejala" value="{{ $item->gejala }}" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>*Hasil Bacaan RO Thorax :</label>
                    <textarea class="form-control" rows="5" name="hasil" required><?php echo htmlspecialchars($item->hasil); ?></textarea>
                </div>

        </div>
        <div class="modal-footer">
            
                <button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan pada <b>{{ $item->updated_at->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Data <b>{{ $item->nama }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('vap.destroy', $item->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<div class="modal" id="kamus" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
              Kamus Indikator
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover table-bordered display" style="width: 100%">
                    <tbody>
                        <tr>
                            <th class="table-warning">Judul Indikator</th>
                            <td>Infeksi <i>Ventilator Associated Pneumonia</i> (VAP)</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Kategori Indikator</th>
                            <td>Tindakan Pengendalian Infeksi RS</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Sasaran Strategis</th>
                            <td>Terwujudnya penyelenggaraan sistem pelayanan keperawatan berbasis mutu dan keselamatan pasien dalam pencegahan dan pengendalian infeksi rumah sakit</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Dimensi Mutu</th>
                            <td>Efektifitas dan keselamatan pasien</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Tujuan</th>
                            <td>Menurunnya kejadian infeksi <i>Ventilator Associated Pneumonia</i> (VAP)</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Definisi Operasional</th>
                            <td>
                                <i>Ventilator Associated Pneumonia</i> (VAP) adalah infeksi saluran napas bawah yang mengenai parenkim paru setelah pemakaian ventilasi mekanik ≥ 48 jam, dan sebelumnya tidak ditemukan tanda-tanda infeksi saluran napas.<br>
                                Kriteria : <br>
                                <b>a.</b> Ditemukan minimal dari tanda dan gejala klinis : Demam (≥ 38 C) tanpa ditemui penyebab lainnya<br>
                                <b>b.</b> Leukopenia (< 4.000 WBC/mm3) atau Leukositosis (≥ 12.000 SDP/mm3) <br>
                                Untuk penderita berumur ≥ 70 tahun, adanya perubahan status mental yang tidak ditemui penyebab lainnya. <br><br>
                                Minimal disertai 2 dari tanda berikut : <br>
                                - Timbulnya onset baru sputum purulen atau perubahan sifat sputum <br>
                                - Munculnya tanda atau terjadinya batuk yang memburuk atau dyspnea (Sesak Napas) atau Tachypnea <br>
                                - Ronki basah atau suara napas bronchial <br>
                                - Memburuknya pertukaran gas, misalnya desaturasi O2 (PaO2/FiO2 ≤ 240), peningkatan kebutuhan oksigen, atau perlunya peningkatan ventilator. Dasar diagnosis : Adanya bukti secara radiologis adalah jika ditemukan > 2 foto serial : Infiltrat baru atau progresif yang menetap ; Konsolidasi ; Kavitasi ; Pneumatoceles pada bayi berumur < 1 tahun
                            </td>
                        </tr>
                        <tr>
                            <th class="table-warning">Frekuensi Pengumpulan Data</th>
                            <td>Bulanan</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Numerator</th>
                            <td>Jumlah kasus Infeksi <i>Ventilator Associated Pneumonia</i> (VAP)</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Denumerator</th>
                            <td>Jumlah yang menggunakan Ventilator ≥ 48 jam</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Inklusi</th>
                            <td>Pasien dengan riwayat Pneumonia Sebelumnya</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Eksklusi</th>
                            <td>Pasien dengan riwayat Pneumonia Sebelumnya</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Formula</th>
                            <td>(Jumlah kasus VAP / Jumlah hari pemakaian ETT atau terpasang Ventilator) / 1000</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Sumber Data</th>
                            <td>Rekam Medis</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Standart</th>
                            <td>≤ 5,8 %</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Kriteria Penilaian</th>
                            <td>
                                Hasil ≤ 5,8 % → Skor = 100 <br>
                                5,8 % < Hasil ≤ 8,3 % → Skor = 75 <br>
                                8,3 % < Hasil ≤ 10,8 % → Skor = 50 <br>
                                10,8 % < Hasil ≤ 13,6 % → Skor = 25 <br>
                                Hasil > 13,6 % → Skor = 0
                            </td>
                        </tr>
                        <tr>
                            <th class="table-warning">PIC</th>
                            <td>IPCLN dan IPCN</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Referensi</th>
                            <td>
                                1. CDC NHSN, Maret 2011 <br>
                                2. Buku pedoman PPI Th 2011 <br>
                                3. Buku pedoman surveilance infeksi RS Kemkes 2011 <br>
                                4. Center for Healthcare related infections surveilance and prevention
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <h6>Surveilans PPI</h6>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="formula" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Formula Bulanan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('vap.formula') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="rm">Jumlah Kasus per Bulan</label>
                                <div class="input-group mx-sm-3">
                                    <input type="number" name="jumlah_kasus" max="99999999" class="form-control" placeholder="" aria-describedby="help" autofocus required>
                                </div>
                                <small id="help" class="text-muted">
                                    Jumlah hari semua pasien yang terpasang <strong>Kateter Intravena</strong>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <label>Bulan</label>
                        <select onchange="submitBtn()" class="form-control" name="bln" required>
                            <option hidden>Pilih</option>
                            <?php
                                $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                $jml_bln=count($bulan);
                                for($c=1 ; $c < $jml_bln ; $c+=1){
                                    echo"<option value=$c> $bulan[$c] </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label>Tahun</label>
                        <select onchange="submitBtn()" class="form-control" name="thn" required>
                            <option hidden selected>Pilih</option>
                            @php
                                for ($i=2021; $i <= \Carbon\Carbon::now()->isoFormat('YYYY'); $i++) { 
                                    echo"<option value=$i> $i </option>";
                                }
                            @endphp
                        </select>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
                User :&nbsp;<strong>{{ Auth::user()->nama }}</strong> 
                <button class="btn btn-success" id="btn-simpan-formula"><i class="fa-fw fas fa-calculator nav-icon"></i> Hitung</button>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endcan

<script>
function hapusRm() {
    $("#rm").val("").empty(); 
    $("#rm_save").val("").empty(); 
    $("#nama").val("");
    $("#nama_show").val("");
    $("#umur").val("");
    $("#umur_show").val("");
    $('#btn-simpan').prop('disabled', true).removeClass('btn-success').addClass('btn-secondary'); 
    $('#rm').prop('disabled', false);  
}
$(document).on('keypress',function(e) {
    if(e.which == 13) {
        hapusRm();
    }
});
$(document).ready( function () {
    $('#table').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            stateSave: true,
            buttons: [
                'excel', 'pdf','colvis'
            ],
            'columnDefs': [
                { targets: 0, visible: false },
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 8, "desc" ]]
        }
    );

    $("body").addClass('brand-minimized sidebar-minimized');

    // VALIDASI INPUT NUMBER
    $('input[type=number][max]:not([max=""])').on('input', function(ev) {
        var $this = $(this);
        var maxlength = $this.attr('max').length;
        var value = $this.val();
        if (value && value.length >= maxlength) {
        $this.val(value.substr(0, maxlength));
        }
    });
    
    $('#rm').change(function() { 
        if (this.value == '') {
            $("#rm_save").val("");
            $("#nama").val("");
            $("#nama_show").val("");
            $("#umur").val("");
            $("#umur_show").val("");
        } else {
            if (this.value.length == 4) {
                this.value = '0000'+this.value;
            }
            if (this.value.length == 5) {
                this.value = '000'+this.value;
            } 
            if (this.value.length == 6) {
                this.value = '00'+this.value;
            }
            if (this.value.length < 4) {
                this.value = this.value;
            }
            $('#rm').prop('disabled', true); 
            $("#rm_save").val(this.value);
            $.ajax({
                url: "http://192.168.1.3:8000/api/rm/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#nama").val(res.data.NAMAPASIEN);
                    $("#nama_show").val(res.data.NAMAPASIEN);
                    $("#umur").val(res.data.UMUR);
                    $("#umur_show").val(res.data.UMUR);
                    if (res.logic == 1) {
                        $('#btn-simpan').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success'); 
                    }
                }
            });
            $.ajax({
                url: "http://103.155.246.25:8000/api/rm/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#nama").val(res.data.NAMAPASIEN);
                    $("#nama_show").val(res.data.NAMAPASIEN);
                    $("#umur").val(res.data.UMUR);
                    $("#umur_show").val(res.data.UMUR);
                    if (res.logic == 1) {
                        $('#btn-simpan').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success'); 
                    }
                }
            });
        }
    });
    
    $("#tambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

        return true;
    });
    
    $("#formula").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan-formula").attr('disabled','disabled');
        $("#btn-simpan-formula").find("i").toggleClass("fa-save fa-refresh fa-spin");

        return true;
    });
} );
</script>
@endsection