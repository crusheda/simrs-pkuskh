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

            </i> Daftar Bantu Plebitis

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
                            <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#api">
                                <i class="fa-fw fas fa-podcast nav-icon">
        
                                </i>
                                API
                            </button>
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
                                <th>TGL PASANG</th>
                                <th>ASAL PASANG</th>
                                <th>TGL DITEMUKAN</th>
                                <th>KETERANGAN</th>
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
                                <td>{{ $item->tgl_pasang }}</td>
                                <td>{{ $item->asal_pasang }}</td>
                                <td>{{ $item->tgl_ditemukan }}</td>
                                <td>{{ $item->ket }}</td>
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
            <form class="form-auth-small" action="{{ route('plebitis.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label>*Tgl Awal Pasang Infus :</label>
                            <input type="date" name="tgl_pasang" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Asal Pasang : </label>
                            <select name="asal_pasang" class="form-control" required>
                                <option hidden>Pilih</option>
                                <option value="igd">IGD</option>
                                <option value="poli">POLIKLINIK</option>
                                <option value="bangsal3">BANGSAL LT 3</option>
                                <option value="bangsal4">BANGSAL LT 4</option>
                                <option value="kebidanan">KEBIDANAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Tgl Ditemukan : </label>
                            <input type="date" name="tgl_ditemukan" value="<?php echo strftime('%Y-%m-%d', strtotime($list['now'])); ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan (Tanda dan Gejala) :</label>
                    <textarea class="form-control" rows="5" name="ket"></textarea>
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
            {{ Form::model($item, array('route' => array('plebitis.update', $item->id), 'method' => 'PUT')) }}
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
                            <label>*Tgl Awal Pasang Infus : </label>
                            <input type="date" name="tgl_pasang" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl_pasang)); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Asal Pasang : </label>
                            <select name="asal_pasang" class="form-control">
                                <option value="igd"         @if ($item->asal_pasang == 'igd') echo selected @endif>IGD</option>
                                <option value="poli"        @if ($item->asal_pasang == 'poli') echo selected @endif>POLIKLINIK</option>
                                <option value="bangsal3"    @if ($item->asal_pasang == 'bangsal3') echo selected @endif>BANGSAL LT 3</option>
                                <option value="bangsal4"    @if ($item->asal_pasang == 'bangsal4') echo selected @endif>BANGSAL LT 4</option>
                                <option value="kebidanan"   @if ($item->asal_pasang == 'kebidanan') echo selected @endif>KEBIDANAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>*Tgl Ditemukan : </label>
                            <input type="date" name="tgl_ditemukan" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl_ditemukan)); ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan (Tanda dan Gejala) :</label>
                    <textarea class="form-control" rows="5" name="ket"><?php echo htmlspecialchars($item->ket); ?></textarea>
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
            <form action="{{ route('plebitis.destroy', $item->id) }}" method="POST">
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

<div class="modal fade bd-example-modal-lg" id="api" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
              API Problems
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            Bagaimana jika Nomer Rekam Medik yang sudah diinputkan akan tetapi tidak muncul otomatis data Pasiennya padahal Data sudah benar / valid? Ada 2 tahapan yang harus dilakukan, khusus anda yang memakai Browser <kbd>Google Chrome</kbd> . <br>
            <hr>
            <h5>Tahap 1</h5>
            <i class="fa-fw fas fa-caret-right nav-icon"></i> Tulis pada Bilah Alamat (Address Bar), <a><strong>chrome://flags</strong></a> <br>
            <i class="fa-fw fas fa-caret-right nav-icon"></i> Setelah itu akan muncul tampilan seperti gambar di bawah ini <br><br>
            <img class="img-fluid rounded" src="{{ url('img/API-problems/url.png') }}"><br><br>
            <h5>Tahap 2</h5>
            <i class="fa-fw fas fa-caret-right nav-icon"></i> Ketik <strong>Block insecure private network requests</strong> pada kolom pencarian <br>
            <i class="fa-fw fas fa-caret-right nav-icon"></i> Ubah pilihan dari <kbd style="background-color: #8AB4F8">Default</kbd> menjadi <kbd style="background-color: #8AB4F8">Disabled</kbd> <br><br>
            <img class="img-fluid rounded" src="{{ url('img/API-problems/search.png') }}">
        </div>
        <div class="modal-footer">
            <a></a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

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
                            <td>Infeksi Darah Perifer / Phlebitis</td>
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
                            <td>Menurunnya kejadian infeksi aliran darah perifer (Plebitis)</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Definisi Operasional</th>
                            <td>Phlebitis merupakan inflamaasi pada vena, yang ditandai dengan adanya daerah yang merah, nyeri dan pembengkakan di daerah penusukan atau sepanjang vena</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Frekuensi Pengumpulan Data</th>
                            <td>Bulanan</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Numerator</th>
                            <td>Jumlah kasus Phlebitis</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Denumerator</th>
                            <td>Seluruh pasien yang terpasang Kateter Intravena</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Inklusi</th>
                            <td>Pasien rawat inap yang terpasang Kateter Intravena</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Formula</th>
                            <td>(Jumlah kasus / Jumlah hari semua pasien yang terpasang Kateter Intravena) x 1000</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Sumber Data</th>
                            <td>Instalasi Rawat Inap</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Standart</th>
                            <td>≤ 5 %</td>
                        </tr>
                        <tr>
                            <th class="table-warning">Kriteria Penilaian</th>
                            <td>
                                Hasil ≤ 5 % → Skor = 100 <br>
                                5 % < Hasil ≤ 10 % → Skor = 75 <br>
                                10 % < Hasil ≤ 15 % → Skor = 50 <br>
                                15 % < Hasil ≤ 20 % → Skor = 25 <br>
                                Hasil > 20 % → Skor = 0
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
            <form class="form-auth-small" action="{{ route('plebitis.formula') }}" method="POST" enctype="multipart/form-data">
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