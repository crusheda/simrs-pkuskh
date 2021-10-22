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

            <i class="fa-fw fas fa-bar-chart nav-icon text-info">

            </i> Data Pendapatan / Penerimaan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kasir
            </span>
            
        </div>
        <div class="card-body">
            @role('kasir|kabag-keuangan|it')
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah
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
                                <th>POLI</th>
                                <th>CARA BAYAR</th>
                                <th>BANK</th>
                                <th>SHIFT</th>
                                <th>NOMINAL</th>
                                <th>TGL</th>
                                <th>KET</th>
                                <th>USER</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><kbd>{{ $item->rm }}</kbd></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->poli }}</td>
                                <td>{{ $item->cara_bayar }}</td>
                                <td>{{ $item->bank }}</td>
                                <td>{{ $item->shift }}</td>
                                <td>Rp. {{ number_format($item->nominal,0,",",".") }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tgl)->isoFormat('dddd, D MMM Y') }}</td>
                                <td>{{ $item->ket }}</td>
                                <td>{{ $item->id_user }}</td>
                                <td>
                                    <center>
                                        @role('kabag-keuangan|it')
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                            </div>
                                        @else
                                            <div class="btn-group" role="group">
                                                @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') == \Carbon\Carbon::now()->isoFormat('YYYY/MM/DD'))
                                                    <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                    <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
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

@role('kasir|kabag-keuangan|it')
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
            <form class="form-auth-small" action="{{ route('pendapatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Pengubahan / Penghapusan data hanya berlaku pada <strong>Hari saat Anda mengupload saja</strong> !!<hr>
                <div class="row">
                    <div class="col">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="rm">*No. Rekam Medik</label>
                                <div class="input-group mx-sm-3">
                                    <input type="number" name="rm" id="rm_save" class="form-control" hidden>
                                    <input type="text" id="rm" class="form-control" maxlength="8" minlength="6" placeholder="e.g. 222222" aria-describedby="helprm" onkeypress="return onlyNumberKey(event)" autofocus required>
                                    <div class="input-group-prepend">
                                        <button class="btn btn-warning text-white" id="clearfx" onclick="hapusRm()"><i class="fa-fw fas fa-eraser nav-icon"></i></button>
                                    </div>
                                </div>
                                <small id="helprm" class="text-muted">
                                    Klik <kbd>TAB</kbd> Apabila RM Pasien sesuai, Data pasien akan muncul otomatis.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Nama Pasien :</label>
                            <input type="text" name="nama" id="nama" class="form-control" hidden>
                            <input type="text" id="nama_show" class="form-control" placeholder="..." disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Poliklinik :</label>
                            <select name="poli" id="poli" class="form-control" required disabled>
                                <option hidden>...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cara Bayar :</label>
                            <select name="cara_bayar" id="cara_bayar" class="form-control" required disabled>
                                <option hidden>...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Nominal :</label>
                            <input type="text" name="nominal" id="rupiah_tambah" class="form-control" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bank :</label>
                            <select name="bank" class="form-control" required>
                                <option hidden>Pilih</option>
                                <option value="CASH">CASH</option>
                                <option value="ASB">ASB</option>
                                <option value="BRI">BRI</option>
                                <option value="MANDIRI">MANDIRI</option>
                                <option value="PIUTANG">PIUTANG</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Shift :</label>
                            <select name="shift" class="form-control" required>
                                <option hidden>Pilih</option>
                                <option value="PAGI">PAGI</option>
                                <option value="MIDDLE">MIDDLE</option>
                                <option value="SIANG">SIANG</option>
                                <option value="MALAM">MALAM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan (Tanda / Gejala) :</label>
                    <textarea class="form-control" style="min-height: 100px" rows="5" name="ket"></textarea>
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
            Ubah Data&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('pendapatan.update', $item->id), 'method' => 'PUT')) }}
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
                            <label>Poliklinik :</label>
                            <input type="text" value="{{ $item->poli }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Cara Bayar :</label>
                            <input type="text" value="{{ $item->cara_bayar }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Nominal :</label>
                            <input type="text" name="nominal" id="rupiah_edit" value="Rp. {{ number_format($item->nominal,0,",",".") }}" class="form-control" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bank :</label>
                            <select name="bank" class="form-control" required>
                                <option hidden>Pilih</option>
                                <option value="CASH"    @if ($item->bank == 'CASH') echo selected @endif>CASH</option>
                                <option value="ASB"     @if ($item->bank == 'ASB') echo selected @endif>ASB</option>
                                <option value="BRI"     @if ($item->bank == 'BRI') echo selected @endif>BRI</option>
                                <option value="MANDIRI" @if ($item->bank == 'MANDIRI') echo selected @endif>MANDIRI</option>
                                <option value="PIUTANG" @if ($item->bank == 'PIUTANG') echo selected @endif>PIUTANG</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Shift :</label>
                            <select name="shift" class="form-control" required>
                                <option hidden>Pilih</option>
                                <option value="PAGI"    @if ($item->shift == 'PAGI') echo selected @endif>PAGI</option>
                                <option value="MIDDLE"  @if ($item->shift == 'MIDDLE') echo selected @endif>MIDDLE</option>
                                <option value="SIANG"   @if ($item->shift == 'SIANG') echo selected @endif>SIANG</option>
                                <option value="MALAM"   @if ($item->shift == 'MALAM') echo selected @endif>MALAM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan (Tanda / Gejala) :</label>
                    <textarea class="form-control" style="min-height: 100px" rows="5" name="ket"><?php echo htmlspecialchars($item->ket); ?></textarea>
                </div>

        </div>
        <div class="modal-footer">
            
                <button class="btn btn-success pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
            Ditambahkan pada <b>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Data <b>{{ $item->nama }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('pendapatan.destroy', $item->id) }}" method="POST">
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
@endrole

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
    $("#poli").find('option').remove();
    $("#poli").append('<option value="" hidden>...</option>'); 
    $('#poli').prop('disabled', true);
    $("#cara_bayar").find('option').remove();
    $("#cara_bayar").append('<option value="" hidden>...</option>'); 
    $('#cara_bayar').prop('disabled', true);
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
                { targets: 9, visible: false },
                { targets: 10, visible: false },
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
    
    // Set modal form input to autofocus when autofocus attribute is set
    $("#tambah").on('shown.bs.modal', function () {
        // $(this).find($.attr('autofocus')).focus();
        $(this).find('[autofocus]').focus();
    });

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
            $('#poli').prop('disabled', true);
            $('#cara_bayar').prop('disabled', true);
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
                url: "http://192.168.1.3:8000/api/rmpoli/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#nama").val(res.data.NAMAPASIEN);
                    $("#nama_show").val(res.data.NAMAPASIEN);
                    $("#poli").find('option').remove();
                    $("#poli").append('<option value="" hidden>Pilih</option>');
                    $('#poli').prop('disabled', false);
                    $("#cara_bayar").find('option').remove();
                    $("#cara_bayar").append('<option value="" hidden>Pilih</option>');
                    $('#cara_bayar').prop('disabled', false);
                    res.poli.forEach(item => {
                        $("#poli").append(`
                            <option value="${item.SUBINSTALASI}">${item.SUBINSTALASI}</option>
                        `);
                    });
                    res.bayar.forEach(item => {
                        $("#cara_bayar").append(`
                            <option value="${item.CARABAYAR}">${item.CARABAYAR}</option>
                        `);
                    });
                    if (res.logic == 1) {
                        $('#btn-simpan').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success'); 
                    }
                }
            });
            $.ajax({
                url: "http://103.155.246.25:8000/api/rmpoli/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#nama").val(res.data.NAMAPASIEN);
                    $("#nama_show").val(res.data.NAMAPASIEN);
                    $("#poli").find('option').remove();
                    $("#poli").append('<option value="" hidden>Pilih</option>');
                    $('#poli').prop('disabled', false);
                    res.poli.forEach(item => {
                        $("#poli").append(`
                            <option value="${item.SUBINSTALASI}">${item.SUBINSTALASI}</option>
                        `);
                    });
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
} );
</script>
<script type="text/javascript">
/* FUNCTION - FUNCTION */
    
    // RUPIAH TAMBAH
    var rupiah_tambah = document.getElementById('rupiah_tambah');
    // RUPIAH EDIT
    var rupiah_edit = document.getElementById('rupiah_edit');

    if (rupiah_tambah) {
        rupiah_tambah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah_tambah.value = formatRupiah(this.value, 'Rp. ');
        });
    }
    if (rupiah_edit) {
        rupiah_edit.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah_edit.value = formatRupiah(this.value, 'Rp. ');
        });
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    
    function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

</script>
@endsection