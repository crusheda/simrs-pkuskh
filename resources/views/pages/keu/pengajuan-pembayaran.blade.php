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

            <i class="fa-fw fas fa-area-chart nav-icon text-info">

            </i> Data Pengajuan Pembayaran

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Pribadi
            </span>
            
        </div>
        <div class="card-body">
            @can('pengajuan-pengeluaran')
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
                                <th>JENIS</th>
                                <th>PBF</th>
                                <th>TGL PEMBELIAN</th>
                                <th>NO. FAKTUR</th>
                                <th>JATUH TEMPO</th>
                                <th>TRANSAKSI</th>
                                <th>BANK</th>
                                <th>NO. REK</th>
                                <th>NOMINAL</th>
                                <th>USER</th>
                                <th>DITAMBAHKAN</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->pbf }}</td>
                                <td>{{ $item->tgl_pembelian }}</td>
                                <td><kbd>{{ $item->no_faktur }}</kbd></td>
                                <td>{{ $item->tgl_jatuh_tempo }}</td>
                                <td>{{ $item->transaksi }}</td>
                                <td>{{ $item->bank }}</td>
                                <td>{{ $item->no_rek }}</td>
                                <td>Rp. {{ number_format($item->nominal,0,",",".") }}</td>
                                <td>{{ $item->id_user }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMM Y') }}</td>
                                <td>
                                    <center>
                                        @role('kabag-keuangan|it')
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

@can('pengajuan-pengeluaran')
<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis :</label>
                            <div class="input-group mb-3">
                                <select class="fstdropdown-select" name="jenis" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="TRANSFER">TRANSFER</option>
                                    <option value="CEK">CEK</option>
                                    <option value="CASH">CASH</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>PBF :</label>
                            <div class="input-group mb-3">
                                <select class="fstdropdown-select" name="pbf" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="TRANSFER">TRANSFER</option>
                                    <option value="CEK">CEK</option>
                                    <option value="CASH">CASH</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Faktur :</label>
                            <input type="text" name="no_faktur" class="form-control" placeholder="Masukkan Nomor Faktur" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tgl Pembelian :</label>
                            <input type="date" name="tgl_pembelian" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime(\Carbon\Carbon::now())); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tgl Jatuh Tempo :</label>
                            <input type="date" name="tgl_jatuh_tempo" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime(\Carbon\Carbon::now()->addDay(5))); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Transaksi :</label>
                            <select name="transaksi" class="form-control" required>
                                <option hidden>Pilih Transaksi</option>
                                <option value="TRANSFER">TRANSFER</option>
                                <option value="CEK">CEK</option>
                                <option value="CASH">CASH</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nominal :</label>
                            <input type="text" name="nominal" id="rupiah_tambah" class="form-control" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                </div>
                <div class="row" id="transfer" hidden>
                    <div class="col">
                        <div class="form-group">
                            <label>Bank :</label>
                            <input type="text" name="bank" class="form-control" placeholder="Masukkan Nama Bank" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nomor Rekening :</label>
                            <input type="text" name="no_rek" class="form-control" placeholder="Masukkan Nomor Rekening" required>
                        </div>
                    </div>
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
            {{ Form::model($item, array('route' => array('pengajuan.update', $item->id), 'method' => 'PUT')) }}
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
            Ditambahkan pada <b>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Data <b>{{ $item->nama }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('pengajuan.destroy', $item->id) }}" method="POST">
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
@endcan

<script>
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
                // { targets: 0, visible: false },
                // { targets: 9, visible: false },
                // { targets: 10, visible: false },
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
    
    $("#tambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

        return true;
    });
} );
</script>
<script type="text/javascript">
    
    // RUPIAH TAMBAH
        var rupiah = document.getElementById('rupiah_tambah');
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

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
    
    // RUPIAH EDIT
        var rupiah = document.getElementById('rupiah_edit');
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

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
</script>
<script>
    function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
@endsection