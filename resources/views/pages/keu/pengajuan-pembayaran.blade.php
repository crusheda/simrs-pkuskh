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
                            @role('kasubag-perbendaharaan|kabag-keuangan')
                                <button type="button" class="btn btn-dark text-white" onclick="window.location.href='{{ route('pengajuan.showverif') }}'">
                                    <i class="fa-fw fas fa-check-square nav-icon">
            
                                    </i>
                                    Verifikasi
                                </button>
                                <button type="button" class="btn btn-warning text-white" onclick="window.location.href='{{ route('pbf.index') }}'">
                                    <i class="fa-fw fas fa-sort-amount-asc nav-icon">
            
                                    </i>
                                    PBF
                                </button>
                            @endrole
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
                                <th>PEMBELIAN</th>
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
                                <td>{{ \Carbon\Carbon::parse($item->tgl_pembelian)->isoFormat('dddd, D MMM Y') }}</td>
                                <td><kbd>{{ $item->no_faktur }}</kbd></td>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_jatuh_tempo)->isoFormat('dddd, D MMM Y') }}</td>
                                <td>{{ $item->transaksi }}</td>
                                <td>@if ($item->bank == null) - @else {{ $item->bank }} @endif</td>
                                <td>@if ($item->bank == null) - @else {{ $item->no_rek }} @endif</td>
                                <td>Rp. {{ number_format($item->nominal,0,",",".") }}</td>
                                <td>{{ $item->id_user }}</td>
                                <td>{{ $item->created_at }}</td>
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
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Pengubahan / Penghapusan data hanya berlaku pada <strong>Hari saat Anda mengupload saja</strong> !!<hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis :</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="jenis" id="jenis_tambah" required>
                                    <option value="" hidden>Pilih</option>
                                    @foreach($list['jenis'] as $key => $item)
                                        <option value="{{ $item->jenis }}"><label>{{ $item->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>PBF :</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="pbf" id="pbf_tambah" disabled required>
                                    <option value="" hidden>Pilih</option>
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
                            <input type="date" name="tgl_pembelian" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime(\Carbon\Carbon::now())); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tgl Jatuh Tempo :</label>
                            <input type="date" name="tgl_jatuh_tempo" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime(\Carbon\Carbon::now())); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Transaksi :</label>
                            <select name="transaksi" id="transaksi_tambah" class="form-control" required>
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
                            <input type="text" name="nominal" id="rupiah_tambah" maxlength="17" class="form-control" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                </div>
                <div class="row" id="transfer_tambah" hidden>
                    <div class="col">
                        <div class="form-group">
                            <label>Bank :</label>
                            <input type="text" name="bank" id="bank_tambah" class="form-control" placeholder="Masukkan Nama Bank">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nomor Rekening :</label>
                            <input type="text" name="no_rek" id="no_rek_tambah" class="form-control" placeholder="Masukkan Nomor Rekening">
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
                User :&nbsp;<strong>{{ Auth::user()->nama }}</strong> 
                <button class="btn btn-success" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis :</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="jenis" id="jenis_edit" required>
                                    <option value="" hidden>Pilih</option>
                                    @foreach($list['jenis'] as $key => $items)
                                        <option value="{{ $items->jenis }}" @if ($items->jenis == $item->jenis) echo selected @endif><label>{{ $items->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>PBF :</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="pbf" id="pbf_edit" disabled required>
                                    <option value="" hidden>Pilih</option>
                                    @foreach($list['pbf'] as $key => $items)
                                        <option value="{{ $items->id }}" @if ($items->id == $item->pbf) echo selected @endif><label>{{ $items->pbf }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Faktur :</label>
                            <input type="text" name="no_faktur" value="{{ $item->no_faktur }}" class="form-control" placeholder="Masukkan Nomor Faktur" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tgl Pembelian :</label>
                            <input type="date" name="tgl_pembelian" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl_pembelian)); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tgl Jatuh Tempo :</label>
                            <input type="date" name="tgl_jatuh_tempo" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($item->tgl_jatuh_tempo)); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Transaksi :</label>
                            <select name="transaksi" id="transaksi_edit{{ $item->id }}" class="form-control" onclick="ubahTransaksi({{ $item->id }})" required>
                                <option hidden>Pilih Transaksi</option>
                                <option value="TRANSFER"    @if ($item->transaksi == 'TRANSFER') echo selected @endif>TRANSFER</option>
                                <option value="CEK"         @if ($item->transaksi == 'CEK') echo selected @endif>CEK</option>
                                <option value="CASH"        @if ($item->transaksi == 'CASH') echo selected @endif>CASH</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nominal :</label>
                            <input type="text" name="nominal" id="rupiah_edit" maxlength="17" value="Rp. {{ number_format($item->nominal,0,",",".") }}" class="form-control" placeholder="Masukkan Nominal" required>
                        </div>
                    </div>
                </div>
                <div class="row" id="transfer_edit{{ $item->id }}" @if ($item->bank == null && $item->no_rek == null) echo hidden @endif>
                    <div class="col">
                        <div class="form-group">
                            <label>Bank :</label>
                            <input type="text" name="bank" id="bank_edit{{ $item->id }}" value="{{ $item->bank }}" class="form-control" placeholder="Masukkan Nama Bank" @if ($item->bank != null) echo required @endif>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nomor Rekening :</label>
                            <input type="text" name="no_rek" id="no_rek_edit{{ $item->id }}" value="{{ $item->no_rek }}" class="form-control" placeholder="Masukkan Nomor Rekening" @if ($item->no_rek != null) echo required @endif>
                        </div>
                    </div>
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
                { targets: 0, visible: false },
                { targets: 7, visible: false },
                { targets: 8, visible: false },
                { targets: 10, visible: false },
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 11, "desc" ]]
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
    
    $("#tambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

        return true;
    });

    $('#transaksi_tambah').change(function() { 
        if (this.value == 'TRANSFER') {
            $("#bank_tambah").val("").prop('required', true);
            $("#no_rek_tambah").val("").prop('required', true);
            $('#transfer_tambah').prop('hidden', false);
        } else {
            $("#bank_tambah").val("").prop('required', false);
            $("#no_rek_tambah").val("").prop('required', false);
            $('#transfer_tambah').prop('hidden', true);
        }
    });

    $('#jenis_tambah').change(function() { 
        $('#pbf_tambah').prop('disabled', false);

        $.ajax({
            url: "./pbf/api/"+this.value,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#pbf_tambah").val("").find('option').remove();
                $("#pbf_tambah").append('<option value="" hidden>Pilih</option>');

                var len = res.length;   
                var sel = document.getElementById('pbf_tambah');
                for(var i = 0; i < len; i++) {
                    var opt = document.createElement('option');
                    opt.innerHTML = res[i]['pbf'];
                    opt.value = res[i]['id'];
                    sel.appendChild(opt);
                }
                // res.forEach(item => {
                //     $("#pbf_tambah").append(`
                //         <option value="${item.id}" hidden>${item.pbf}</option>
                //     `);
                // });
            }
        });
    });

    // $('#transaksi_edit').change(function() { 
    //     if (this.value == 'TRANSFER') {
    //         $("#bank_edit").val("").prop('required', true);
    //         $("#no_rek_edit").val("").prop('required', true);
    //         $('#transfer_edit').prop('hidden', false);
    //     } else {
    //         $("#bank_edit").val("").prop('required', false);
    //         $("#no_rek_edit").val("").prop('required', false);
    //         $('#transfer_edit').prop('hidden', true);
    //     }
    // });

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

    function ubahTransaksi(params) {
        if ($("#transaksi_edit"+params).val() == 'TRANSFER') {
            $("#bank_edit"+params).val("").prop('required', true);
            $("#no_rek_edit"+params).val("").prop('required', true);
            $('#transfer_edit'+params).prop('hidden', false);
        } else {
            $("#bank_edit"+params).val("").prop('required', false);
            $("#no_rek_edit"+params).val("").prop('required', false);
            $('#transfer_edit'+params).prop('hidden', true);
        }
    }

</script>
@endsection