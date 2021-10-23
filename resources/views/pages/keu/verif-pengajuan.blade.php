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

            <i class="fa-fw fas fa-check-square nav-icon text-info">

            </i> Verifikasi Data Pengajuan Pembayaran

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses {{ Auth::user()->name }}
            </span>
            
        </div>
        <div class="card-body">
            @role('kasubag-perbendaharaan|kabag-keuangan')
                <div class="table-responsive">
                    @role('kabag-keuangan')
                        <table id="table-kabag" class="table table-striped display" style="width: 100%">
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
                                    <th>VERIF</th>
                                    <th>STATUS</th>
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
                                    <td>{{ $item->verif_kabag }}</td>
                                    <td>{{ $item->status_kabag }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn @if($item->verif_kabag == null) btn-warning @else btn-success @endif btn-sm text-white" data-toggle="modal" data-target="#verif-kabag{{ $item->id }}"><i class="fa-fw fas fa-check nav-icon"></i></button>
                                                @if($item->verif_kabag == null)
                                                    <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-square nav-icon"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#hapusverifkabag{{ $item->id }}"><i class="fa-fw fas fa-check-square nav-icon"></i></button>
                                                @endif
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    @else
                        <table id="table-kasubag" class="table table-striped display" style="width: 100%">
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
                                    <th>DISKON & RETURN</th>
                                    <th>TOTAL</th>
                                    <th>KETERANGAN</th>
                                    <th>USER</th>
                                    <th>DITAMBAHKAN</th>
                                    <th>VERIF</th>
                                    <th>STATUS</th>
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
                                    <td>@if ($item->diskon_return == null) - @else Rp. {{ number_format($item->diskon_return,0,",",".") }} @endif</td>
                                    <td>@if ($item->total == null) - @else Rp. {{ number_format($item->total,0,",",".") }} @endif</td>
                                    <td>Rp. {{ number_format($item->ket,0,",",".") }}</td>
                                    <td>{{ $item->id_user }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->verif_kasubag }}</td>
                                    <td>{{ $item->status_kasubag }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#verif-kasubag{{ $item->id }}"><i class="fa-fw fas fa-check nav-icon"></i></button>
                                                @if($item->verif_kasubag == null)
                                                    <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-square nav-icon"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#hapusverifkasubag{{ $item->id }}"><i class="fa-fw fas fa-check-square nav-icon"></i></button>
                                                @endif
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    @endrole
                </div>
            @else
                <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
            @endrole
        </div>
    </div>
</div>

{{-- VERIFIKASI KABAG --}}
@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="verif-kabag{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Verifikasi
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('pengajuan.verifikasikabag', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Verifikasi :</label>
                            <select class="form-control" name="status_kabag" id="status_kabag{{ $item->id }}" onclick="ubahStatusKabag({{ $item->id }})" required>
                                <option value="" hidden>Pilih</option>
                                <option value="DIVERIFIKASI"    @if ($item->status_kabag == 'DIVERIFIKASI') echo selected @endif>DIVERIFIKASI</option>
                                <option value="PENDING"         @if ($item->status_kabag == 'PENDING') echo selected @endif>PENDING</option>
                                <option value="LAINLAIN"        @if ($item->status_kabag == 'LAINLAIN') echo selected @endif>LAINLAIN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="lainlainkabag{{ $item->id }}" @if ($item->ket_lainlain_kabag == null) echo hidden @endif>
                            <label>Keterangan (Optional) :</label>
                            <textarea class="form-control" style="min-height: 100px" rows="5" name="ket_lainlain_kabag" id="ket_lainlain_kabag{{ $item->id }}"><?php echo htmlspecialchars($item->ket_lainlain_kabag); ?></textarea>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
                <button class="btn btn-success" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Verifikasi</button>
            {!! Form::close() !!}

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

{{-- VERIFIKASI KASUBAG --}}
@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="verif-kasubag{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Verifikasi
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('pengajuan.verifikasikasubag', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Verifikasi :</label>
                            <select class="form-control" name="status_kasubag" id="status_kasubag{{ $item->id }}" onclick="ubahStatusKasubag({{ $item->id }})" required>
                                <option value="" hidden>Pilih</option>
                                <option value="DIVERIFIKASI"    @if ($item->status_kasubag == 'DIVERIFIKASI') echo selected @endif>DIVERIFIKASI</option>
                                <option value="PENDING"         @if ($item->status_kasubag == 'PENDING') echo selected @endif>PENDING</option>
                                <option value="LAINLAIN"        @if ($item->status_kasubag == 'LAINLAIN') echo selected @endif>LAINLAIN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="lainlainkasubag{{ $item->id }}" hidden>
                            <label>Keterangan (Optional) :</label>
                            <textarea class="form-control" style="min-height: 100px" rows="5" name="ket_lainlain_kasubag" id="ket_lainlain_kasubag{{ $item->id }}"><?php echo htmlspecialchars($item->ket_lainlain_kasubag); ?></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Diskon & Return :</label>
                            <input type="text" name="diskon_return" id="rupiah_tambah" maxlength="17" value="@if ($item->diskon_return != null) Rp. {{ number_format($item->diskon_return,0,",",".") }} @endif" class="form-control" placeholder="Masukkan Diskon & Return" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Nominal (Total) :</label>
                            <input type="text" id="rupiah_nominal" value="@if ($item->total != null) Rp. {{ number_format($item->total,0,",",".") }} @endif" class="form-control" disabled>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
                <button class="btn btn-success" id="btn-simpan"><i class="fa-fw fas fa-save nav-icon"></i> Verifikasi</button>
            {!! Form::close() !!}

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

{{-- HAPUS VERIFIKASI KABAG --}}
@foreach($list['show'] as $item)
<div class="modal" id="hapusverifkabag{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Diverifikasi pada <b>{{ \Carbon\Carbon::parse($item->verif_kabag)->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin membatalkan Verifikasi untuk PBF <b>{{ $item->pbf }}</b> dengan No.Faktur <b>{{ $item->no_faktur }}</b> ?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('pengajuan.destroyverifkabag', $item->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus Verifikasi</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

{{-- HAPUS VERIFIKASI KABAG --}}
@foreach($list['show'] as $item)
<div class="modal" id="hapusverifkasubag{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Diverifikasi pada <b>{{ \Carbon\Carbon::parse($item->verif_kasubag)->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin membatalkan Verifikasi untuk PBF <b>{{ $item->pbf }}</b> dengan No.Faktur <b>{{ $item->no_faktur }}</b> ?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('pengajuan.destroyverifkasubag', $item->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus Verifikasi</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#table-kabag').DataTable(
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
                { targets: 13, visible: false },
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

    $('#table-kasubag').DataTable(
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
                { targets: 12, visible: false },
                { targets: 13, visible: false },
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
} );
</script>
<script type="text/javascript">
/* FUNCTION - FUNCTION */
    
    // RUPIAH TAMBAH
    var rupiah_tambah = document.getElementById('rupiah_tambah');
    // RUPIAH EDIT
    var rupiah_edit = document.getElementById('rupiah_nominal');

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
    
    function ubahStatusKabag(params) {
        if ($("#status_kabag"+params).val() == 'LAINLAIN') {
            $("#lainlainkabag"+params).prop('hidden', false);
        } else {
            $("#lainlainkabag"+params).prop('hidden', true);
        }
    }
    
    function ubahStatusKasubag(params) {
        if ($("#status_kasubag"+params).val() == 'LAINLAIN') {
            $("#lainlainkasubag"+params).prop('hidden', false);
        } else {
            $("#lainlainkasubag"+params).prop('hidden', true);
        }
    }
</script>
@endsection