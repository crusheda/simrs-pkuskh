@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

@role('ibs')
<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-leaf nav-icon text-info">

            </i> Supervisi IBS

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses IBS
            </span>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group pull-left" role="group">
                        <button class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">

                            </i>
                            Mulai
                        </button>
                        <button class="btn btn-dark text-white" onclick="window.location.href='{{ route('ibs.refsupervisi.index') }}'">
                            <i class="fa-fw fas fa-gears nav-icon">

                            </i>
                            Ref
                        </button>
                        <button class="btn btn-light" data-toggle="modal" data-target="#readme" style="border-color: black"><i class="fa-fw fas fa-info nav-icon"></i></button>
                    </div>
                    <form class="form-inline pull-right" action="{{ route('ibs.supervisi.cari') }}" method="GET">
                        <span style="width: auto;margin-right:10px">Filter</span>
                        <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan">
                            <option hidden>Bulan</option>
                            <?php
                                $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                $jml_bln=count($bulan);
                                for($c=1 ; $c < $jml_bln ; $c+=1){
                                    echo"<option value=$c> $bulan[$c] </option>";
                                }
                            ?>
                        </select>
                        <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun">
                            <option hidden>Tahun</option>
                            @php
                                for ($i=2021; $i <= $list['thn']; $i++) { 
                                    echo"<option value=$i> $i </option>";
                                }
                                
                            @endphp
                        </select>
                        <button class="form-control btn btn-warning text-white" id="submitCari" disabled><i class="fa-fw fas fa-search nav-icon"></i> Cari</button>
                    </form>
                </div>
            </div><br>
            {{-- <img src="{{ asset('storage/it/log/yussuf.jpg') }}" alt=""> --}}
            <div class="table-responsive">
                <table id="supervisi" class="table table-striped display table-hover">
                    <thead>
                        <tr>
                            <th>TIM</th>
                            <th>Shift</th>
                            <th>Status</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->tim }}</td>
                            <td>{{ $item->shift }}</td>
                            <td>                
                                <?php
                                    $countAll = App\Models\ibs\ibs_supervisi::where('id_tim', $item->tim)->count();
                                    $countNull = App\Models\ibs\ibs_supervisi::where('id_tim', $item->tim)->whereNull('kondisi')->count();
                                    $countNotNull = App\Models\ibs\ibs_supervisi::where('id_tim', $item->tim)->whereNotNull('kondisi')->count();
                                ?>
                                @if (!empty($countAll))
                                    @if ($countAll == $countNotNull)
                                        <span class="badge badge-success text-white">Selesai</span>
                                    @endif
                                    @if ($countAll != $countNotNull)
                                        <span class="badge badge-warning text-white">Belum Selesai</span>
                                    @endif
                                    @if ($countAll == $countNull)
                                        <span class="badge badge-danger text-white">Belum Dikerjakan</span>
                                    @endif
                                @endif
                            </td>
                            <td>{{ $item->tgl_mulai }}</td>
                            <td>@if ($item->tgl_selesai == null) <span class="badge badge-dark">Belum Diselesaikan</span> @else {{ $item->tgl_selesai }} @endif</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if ($item->tgl_selesai == null)
                                        <form class="form-auth-small" action="{{ route('ibs.supervisi.pushtim') }}" method="GET" enctype="multipart/form-data">
                                            <input type="number" name="kodetim" value="{{ $item->tim }}" hidden>
                                            <input type="text" name="shift" value="{{ $item->shift }}" hidden>
                                            <button class="btn btn-danger btn-sm text-white">
                                                <i class="fa-fw fas fa-share nav-icon"></i> tersisa
                                                @foreach($list['minus'] as $yoi)
                                                    @if ($item->tim == $yoi->tim)
                                                        @if ($yoi->jumlah > 0)
                                                            <span class="badge badge-light">{{ $yoi->jumlah }}</span>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#recent{{ $item->tim }}" data-toggle="tooltip" data-placement="bottom" title="RIWAYAT PENGECEKAN"><i class="fa-fw fas fa-history nav-icon text-white"></i></button>
                                    @endif
                                    <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#lihatTim{{ $item->tim }}" data-toggle="tooltip" data-placement="bottom" title="LIHAT TIM"><i class="fa-fw fas fa-group nav-icon text-white"></i></button>
                                    {{-- <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="PDF"><i class="fa-fw fas fa-download nav-icon text-white"></i></button> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="card" style="width: 100%">
        <div class="card-body">
            <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Data yang ditampilkan hanya berjumlah 20 data terbaru saja, Klik tombol <b>LIHAT</b> untuk melihat data seluruhnya</a>
            <button class="btn btn-dark pull-right" onclick="window.location.href='{{ url('it/supervisi/all') }}'"><i class="fa-fw fas fa-server nav-icon"></i> LIHAT</button>
        </div>
    </div> --}}
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endrole

<div class="modal fade bd-example-modal-lg" id="readme" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Baca Saya !
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan anda menggunakan Browser Google Chrome <br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Anda dapat memulai pengecekan dengan klik tombol Mulai, setelah itu masukkan Shift dan Anggota TIM <br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Khusus untuk <kbd>Shift Malam</kbd> diharuskan memulai pengecekan pada saat awal masuk shift <br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Penarikan data harian untuk Pengecekan Alat dan BHP ini dilakukan mulai <kbd>Pukul 00.01 - 23.59 WIB</kbd> <br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan lagi setelah anda melakukan pengecekan untuk mengisi Kondisi Alat maupun menambahkan Keterangan jika diperlukan <br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Jangan lupa klik tombol Simpan (Pojok kanan bawah) setelah semuanya terisi <br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Anda dapat membatalkan pengecekan apabila masih pada hari yang sama <br>
                <i class="fa-fw fas fa-caret-right nav-icon"></i> Gunakan dengan Hati-hati untuk kemudahan bersama 
            </div>
            <div class="modal-footer">
               <b>TTD <i>Adik Budi Santoso, A.Md.Kep</i></b>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Tim
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('ibs.supervisi.pushtim') }}" method="GET" enctype="multipart/form-data">
                @csrf
                <input type="number" name="kodetim" value="{{ $list['kodetim'] }}" hidden>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Mulai Cek :</label>
                            <input type="datetime-local" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list['today'])); ?>" disabled>
                            <input type="datetime-local" name="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list['today'])); ?>" hidden>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Shift</label>
                            <select name="shift" class="form-control" id="shift" required>
                              <option hidden>Pilih</option>
                              <option value="pagi">Pagi</option>
                              <option value="siang">Siang</option>
                              <option value="malam">Malam</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Anggota Tim :</label>
                    <div class="input-group mb-3">
                        <select name="tim[]" class="form-control select2" multiple="multiple" required>
                            @foreach($list['user'] as $key => $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <button class="btn btn-success" id="submit"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>

{{-- LIHAT TIM --}}
@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-xl" id="lihatTim{{ $item->tim }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Detail TIM - <kbd>ID : {{ $item->tim }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped display table-hover">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>Akun</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['showtim']) > 0)
                            @foreach($list['showtim'] as $val)
                                @if ($val->id_tim == $item->tim)
                                    @if ($val->shift == $item->shift)
                                        <tr>
                                            <td>{{ $val->id }}</td>
                                            <td>{{ $val->name }}</td>
                                            <td>{{ $val->nama }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- LIHAT HISTORY --}}
@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-xl" id="recent{{ $item->tim }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Detail PENGECEKAN - <kbd>TIM : {{ $item->tim }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped display table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pengecekan Alat Dan Kelengkapan BHP</th>
                            <th>Ruang</th>
                            <th>Kondisi</th>
                            <th>Keterangan</th>
                            <th>Update</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @foreach($list['getdata'] as $val)
                            @if ($val->kodetim == $item->tim)
                                <tr>
                                    <td>{{ $val->id_supervisi }}</td>
                                    <td>{{ $val->nama_supervisi }}</td>
                                    <td>{{ $val->nama_ruang }}</td>
                                    <td>
                                        @if ($val->kondisi == '1')
                                            <span class="badge badge-success">Baik</span>
                                        @endif
                                        @if ($val->kondisi == '0')
                                            <span class="badge badge-danger">Rusak</span>
                                        @endif
                                    </td>
                                    <td>{{ $val->ket }}</td>
                                    <td>{{ $val->tgl }}</td>
                                    <td>
                                        @foreach($list['user'] as $lol)
                                            @if ($lol->id == $val->id_user)
                                                {{ $lol->nama }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#supervisi').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf','colvis'
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 2, "desc" ]]
        }
    );
} );

function submitBtn() {
    var bulan = document.getElementById("bulan").value;
    var tahun = document.getElementById("tahun").value;
    if (bulan != "Bulan" && tahun != "Tahun" ) {
        document.getElementById("submitCari").disabled = false;
    }
}
</script>

@endsection