@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">

    @can('gaji')

    <div class="col-md-10">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-money nav-icon text-danger">
            
                </i>
                Detail Gaji Karyawan <b>{{ $list['bln'] }} {{ $list['thn'] }}</b>

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Kepegawaian
                </span>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group pull-left" role="group">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#validasi" data-toggle="tooltip" data-placement="bottom" title="Validasi Gaji Sekarang">
                                <i class="fa-fw fas fa-legal nav-icon">

                                </i>
                                Validasi
                            </button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#check" data-toggle="tooltip" data-placement="bottom" title="Data Gagal Masuk"><i class="fa-fw fas fa-info nav-icon text-white"></i></button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#print" data-toggle="tooltip" data-placement="bottom" title="Print Gaji"><i class="fa-fw fas fa-print nav-icon"></i></button>
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#hapus" data-toggle="tooltip" data-placement="bottom" title="Hapus Gaji Bulan Ini"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                        </div>
                        {{-- <form class="form-inline" action="{{ route('kepegawaian.final.validasi') }}" method="GET">
                            @csrf
                            <button class="btn btn-success" id="btn-validasi"><i class="fa-fw fas fa-print nav-icon"></i></button>
                        </form> --}}
                        {{-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#notyet" data-toggle="tooltip" data-placement="bottom" title="DATA BELUM MASUK"><i class="fa-fw fas fa-info nav-icon text-white"></i></button> --}}
                        <div class="pull-right">
                            <form class="form-inline" action="{{ route('cari.log') }}" method="GET">
                                <select class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulanFilter">
                                    <option hidden>Bln</option>
                                    @php
                                        $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        $jml_bln=count($bulan);
                                        for($c=1 ; $c < $jml_bln ; $c+=1){
                                            echo"<option value=$c> $bulan[$c] </option>";
                                        }
                                    @endphp
                                </select>
                                <select class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahunFilter">
                                    <option hidden>Thn</option>
                                    @php
                                        for ($i=2021; $i <= $list['thn']; $i++) { 
                                            echo"<option value=$i> $i </option>";
                                        }
                                        
                                    @endphp
                                </select>
                                {{-- <button class="form-control text-white" style="background-color: palevioletred" id="submit"><span class="badge">Filter</span></button> --}}
                                <button class="form-control btn-secondary text-white" id="submit" disabled><span class="badge">Filter</span></button>
                            </form>
                        </div>    
                    </div>
                </div><hr>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="data-table-list">
                                    <div class="table-responsive">
                                        <table id="kepegawaian" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>NAMA</th>
                                                    <th>UNIT</th>
                                                    <th>GOL</th>
                                                    <th>KOTOR</th>
                                                    <th>BERSIH</th>
                                                    <th><center>AKSI</center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($list['gaji']) > 0)
                                                    @foreach($list['gaji'] as $key => $item)
                                                    <tr>
                                                        <td><b>{{ $item->id }}</b></td>
                                                        <td>{{ $item->nama_user }}</td>
                                                        <td>@foreach ($list['user'] as $val) @if ($item->id_user == $val->id) {{ $val->nama_role }} @endif @endforeach</td>
                                                        <td>{{ $item->nama_golongan }}</td>
                                                        <td>Rp. {{ number_format($item->total_kotor,2,",",".") }}</td>
                                                        <td>Rp. {{ number_format($item->total_bersih,2,",",".") }}</td>
                                                        <td>
                                                            <center>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ url('kepegawaian/gaji/final/'. $item->id.'/detail') }}'" data-toggle="tooltip" data-placement="bottom" title="DETAIL GAJI"><i class="fa-fw fas fa-search nav-icon text-white"></i></button>
                                                                    <a type="button" class="btn btn-success btn-sm" href="{{ route('kepegawaian.final.cetak', $item->id) }}" data-toggle="tooltip" data-placement="bottom" title="PRINT GAJI"><i class="fa-fw fas fa-print nav-icon"></i></a>
                                                                    {{-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="UBAH DATA"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button> --}}
                                                                    {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="HAPUS DATA"><i class="fa-fw fas fa-trash nav-icon"></i></button> --}}
                                                                </div>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>NAMA</th>
                                                    <th>UNIT</th>
                                                    <th>GOL</th>
                                                    <th>KOTOR</th>
                                                    <th>BERSIH</th>
                                                    <th><center>AKSI</center></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-reply nav-icon text-success">

                </i> Histori
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Bln/Thn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['recent']) > 0)
                                @foreach($list['recent'] as $key => $item)
                                <tr>
                                    <td><button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#recent{{ $item->tgl }}" data-toggle="tooltip" data-placement="bottom" title="DETAIL DATA">{{ Carbon\Carbon::parse($item->tgl)->isoFormat('MMMM Y') }}</button></td>
                                </tr>
                                @endforeach
                            @endif
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

@can('gaji')

    {{-- VALIDASI DATA --}}
    <div class="modal fade bd-example-modal-lg" id="validasi" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Apakah anda yakin ingin Validasi Sekarang ?
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered display">
                        <tbody>
                            <tr>
                                <th><i class="fa-fw fas fa-chevron-right nav-icon"></i> Status Bulan ini</th>
                                <td>
                                    @if ($list['status'] == 0)
                                        <kbd>Belum Divalidasi</kbd>
                                    @elseif ($list['status'] == 1)
                                        <kbd style="background-color: #E83A67">Sudah Divalidasi</kbd>
                                    @elseif ($list['status'] == 2)
                                        <kbd>Unknown</kbd>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fa-fw fas fa-chevron-right nav-icon"></i> Terakhir Divalidasi</th>
                                <td>
                                    @if (!empty($list['lastGaji']))
                                        <b>{{ Carbon\Carbon::parse($list['lastGaji']->tgl)->isoFormat('dddd, D MMMM Y') }}</b>
                                    @else
                                        <kbd>Unknown</kbd>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <sub>nb. Proses <kbd>Validasi</kbd> mungkin akan sedikit memakan waktu, mohon bersabar menunggu proses validasi berjalan sampai selesai. Mohon pastikan koneksi internet sedang dalam keadaan stabil untuk mencegah terjadinya <i>crash</i> saat proses berlangsung. Terima Kasih</sub>
                </div>
                <div class="modal-footer">
                    <form class="form-inline" action="{{ route('kepegawaian.final.validasi') }}" method="GET">
                        @csrf
                        <button class="btn btn-danger" id="btn-validasi"><i class="fa-fw fas fa-legal nav-icon"></i> Submit</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- PRINT SEMUA DATA --}}
    <div class="modal fade bd-example-modal-lg" id="print" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Cetak Semua Data Gaji Pada Bulan <b>{{ $list['bln'] }}</b> Tahun <b>{{ $list['thn'] }}</b>?
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Data yang akan di cetak berjumlah <b>{{ count($list['gaji']) }}</b> data.</a><br>
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Slip gaji yang dicetak berjumlah <b>3</b> slip setiap Halaman.</a>
                    </p>
                </div>
                <div class="modal-footer">
                    @if(count($list) > 0)
                        <form class="form-inline" action="{{ route('kepegawaian.final.cetakAll') }}" method="GET">
                            @csrf
                            <button class="btn btn-success"><i class="fa-fw fas fa-print nav-icon"></i> Cetak</button>
                        </form>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- HAPUS DATA --}}
    <div class="modal fade bd-example-modal-lg" id="hapus" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Hapus Validasi Data Gaji
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        <a>Apakah anda yakin ingin menghapus Validasi Gaji bulan <b>{{ $list['bln'] }}</b> Tahun <b>{{ $list['thn'] }}</b> ?</a>
                    </p>
                </div>
                <div class="modal-footer">
                    @if(count($list) > 0)
                        <form class="form-inline" action="{{ route('kepegawaian.final.hapus') }}" method="GET">
                            @csrf
                            <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
                        </form>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- RECENT DATA --}}
    @foreach($list['recent'] as $key => $item)
    @php
        $detailRecent = DB::table('gaji')
                ->join('gaji_terima', 'gaji_terima.id', '=', 'gaji.id_terima')
                ->join('users', 'users.id', '=', 'gaji.id_user')
                // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->where('gaji.status',true)
                ->where('gaji.tgl',$item->tgl)
                ->select('users.nama as nama_user','users.name as akun_user','users.nip as nip_user','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.struktural','gaji_terima.fungsional','gaji_terima.gapok','gaji_terima.insentif','gaji_terima.potong','gaji_terima.infaq','gaji.*')
                ->get();
        $countRecent = count($detailRecent);
    @endphp
    <div class="modal fade bd-example-modal-xl" id="recent{{ $item->tgl }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Rekap Gaji Karyawan <kbd>{{ Carbon\Carbon::parse($item->tgl)->isoFormat('MMMM Y') }}</kbd>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table id="recentGaji" class="table table-hover display">
                        <thead>
                            <tr>
                                <th>USER ID</th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>GOL</th>
                                <th>KOTOR</th>
                                <th>BERSIH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $countRecent; $i++)
                                <tr>
                                    <td>{{ $detailRecent[$i]->id_user }}</td>
                                    <td>{{ $detailRecent[$i]->nama_user }}</td>
                                    <td>@foreach ($list['user'] as $val) @if ($detailRecent[$i]->id_user == $val->id) {{ $val->nama_role }} @endif @endforeach</td>
                                    <td>{{ $detailRecent[$i]->nama_golongan }}</td>
                                    <td>Rp. {{ number_format($detailRecent[$i]->total_kotor,2,",",".") }}</td>
                                    <td>Rp. {{ number_format($detailRecent[$i]->total_bersih,2,",",".") }}</td>
                                </tr>
                            @endfor
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

@endcan

<script>
    $(document).ready( function () {
        $('#kepegawaian').DataTable(
            {
                // paging: true,
                // searching: true,
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                order: [[ 2, "asc" ]],
            }
        );

        $("body").addClass('brand-minimized sidebar-minimized');

        $( "#btn-validasi" ).click(function() {
            $(this).find("i").toggleClass("fa-legal fa-refresh fa-spin");
        });

        // VALIDASI INPUT NUMBER
        $('input[type=number][max]:not([max=""])').on('input', function(ev) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
            $this.val(value.substr(0, maxlength));
            }
        });
    });
</script>

@endsection