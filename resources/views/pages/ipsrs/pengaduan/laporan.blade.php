@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-wrench nav-icon text-info">
        
            </i> Tabel Pengaduan IPSRS

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            
        </div>
        <div class="card-body">
            @role('ipsrs')
            @else
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                            <i class="fa-fw fas fa-plus-square nav-icon">

                            </i>
                            Tambah Pengaduan
                        </a>
                    </div>
                </div><br>
            @endrole
            <div class="table-responsive">
                <table id="pengaduan" class="table table-striped display">
                    <thead>
                        <tr>
                            <th><center>DETAIL</center></th>
                            <th>NAMA</th>
                            <th>UNIT</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                            <th>TGL</th>
                            @role('ipsrs')
                            @else
                                <th><center>AKSI</center></th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            @role('ipsrs')
                                @if (empty($item->tgl_diterima) && empty($item->tgl_selesai))
                                    <td><center><button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#detail1{{ $item->id }}"><i class="fa-fw fas fa-check-square nav-icon"></i> Verifikasi</button></center></td>
                                @elseif (empty($item->tgl_dikerjakan) && empty($item->tgl_selesai ))
                                    <td><center><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kerjakan{{ $item->id }}"><i class="fa-fw fas fa-wrench nav-icon"></i> Kerjakan Sekarang</button></center></td>
                                @elseif (empty($item->tgl_selesai))
                                    <td><center><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#selesai{{ $item->id }}"><i class="fa-fw fas fa-thumbs-o-up nav-icon"></i> Selesai</button></center></td>
                                @endif
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>ON PROGRESS</td>
                                <td>{{ $item->tgl_pengaduan }}</td>
                            @else
                                <td><center><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detail2{{ $item->id }}"><i class="fa-fw fas fa-search nav-icon"></i> Lihat</button></center></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->lokasi }}</td>

                                @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                    <td><kbd>Laporan Selesai</kbd></td>
                                @elseif (!empty($item->ket_penolakan))
                                    <td><kbd>Laporan Ditolak</kbd></td>
                                @elseif (empty($item->tgl_diterima))
                                    <td><kbd>Laporan Diverifikasi</kbd></td>
                                @elseif (empty($item->tgl_dikerjakan))
                                    <td><kbd>Laporan Diterima</kbd></td>
                                @elseif (empty($item->tgl_selesai))
                                    <td><kbd>Sedang Dikerjakan</kbd></td>
                                @endif
                                
                                <td>{{ $item->tgl_pengaduan }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lampiran{{ $item->id }}"><i class="fa-fw fas fa-picture-o nav-icon"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    </center>
                                </td>
                            @endrole
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                @role('ipsrs')
                                    <td colspan=6>Tidak Ada Data</td>
                                @else
                                    <td colspan=7>Tidak Ada Data</td>
                                @endrole
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@role('ipsrs')
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-sort-alpha-desc nav-icon text-success">
            
                </i> History Pengaduan IPSRS
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pengaduan" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>DETAIL</th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>LOKASI</th>
                                <th>STATUS</th>
                                <th>TGL</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['showrecent']) > 0)
                            @foreach($list['showrecent'] as $item)
                            <tr>
                                <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detail1{{ $item->id }}">Lihat</button></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>ON PROGRESS</td>
                                <td>{{ $item->tgl_pengaduan }}</td>
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
            </div>
        </div>
    </div>
@endrole

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Pengaduan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('ipsrs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Nama : </label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->name }}" disabled><br>
                    </div>
                    <div class="col-md-4">
                        <label>Unit : </label>
                        <input type="text" name="unit" id="unit" class="form-control" value="{{ Auth::user()->roles->first()->name }}" disabled><br>
                    </div>
                    <div class="col-md-4">
                        <label>Lokasi : </label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder=""><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Pengaduan :</label>
                        <textarea class="form-control" name="pengaduan" id="pengaduan1" placeholder="" maxlength="190" rows="8"></textarea>
                        <span class="help-block">
                            <p id="maxpengaduan1" class="help-block "></p>
                        </span><br>
                    </div>
                </div>
                <label>Lampiran (Optional) : </label><br>
                <input type="file" name="file">

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>

<!-- Ubah -->
@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Pengaduan&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('ipsrs.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <input type="text" name="id" value="{{ $item->id }}" hidden> 
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama : </label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->nama }}" disabled><br>
                        </div>
                        <div class="col-md-4">
                            <label>Unit : </label>
                            <input type="text" name="unit" id="unit" class="form-control" value="{{ $item->unit }}" disabled><br>
                        </div>
                        <div class="col-md-4">
                            <label>Lokasi : </label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $item->lokasi }}"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Pengaduan :</label>
                            <textarea class="form-control" name="pengaduan" id="pengaduan2" placeholder="" maxlength="190" rows="8"><?php echo htmlspecialchars($item->ket_pengaduan); ?></textarea>
                            <span class="help-block">
                                <p id="maxpengaduan2" class="help-block "></p>
                            </span><br>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                
                    <center><button class="btn btn-success pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Hapus -->
@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Hapus Pengaduan&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;?
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus Laporan <b>{{ $item->nama }}</b> ?</p><br>
                <p><b>Laporan : </b>{{ $item->ket_pengaduan }}</p>
            </div>
            <div class="modal-footer">
                @if(count($list) > 0)
                    <form action="{{ route('ipsrs.destroy', $item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal" tabindex="-1" id="detail1{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Verifikasi Laporan&nbsp;<kbd>ID : {{ $item->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="accordion">
                    <a type="button" class="btn btn-success btn-block text-white" data-toggle="collapse" data-target="#terimapengaduan{{ $item->id }}">Terima</a><br>
                    {{ Form::model($item, array('route' => array('pengaduan.ipsrs.terima', $item->id), 'method' => 'POST')) }}
                    <div class="accordion-item">
                        <div class="row">
                            <div class="col">
                                <div class="collapse" id="terimapengaduan{{ $item->id }}" data-parent="#accordion">
                                    <div class="card card-body">
                                        <input type="text" class="form-control" name="id" value="{{ $item->id }}" hidden>
                                        <input type="text" class="form-control" name="ket"><br>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    </div>
                    {{ Form::close() }}
                    <a type="button" class="btn btn-dark btn-block text-white" data-toggle="collapse" data-target="#tolakpengaduan{{ $item->id }}">Tolak</a><br>
                    {{ Form::model($item, array('route' => array('pengaduan.ipsrs.tolak', $item->id), 'method' => 'POST')) }}
                    <div class="accordion-item">
                        <div class="row">
                            <div class="col">
                                <div class="collapse" id="tolakpengaduan{{ $item->id }}" data-parent="#accordion">
                                    <div class="card card-body">
                                        <input type="text" class="form-control" name="id" value="{{ $item->id }}" hidden>
                                        <input type="text" class="form-control" name="ket"><br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal" tabindex="-1" id="lampiran{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Lampiran Foto Pengaduan&nbsp;<kbd>ID : {{ $item->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center><img src="{{ url('public/storage/'.substr($item->filename_pengaduan,7,2000)) }}" style="width:400px" alt="" title="" /></center>
        </div>
        <div class="modal-footer">
          <button onclick="window.location.href='{{ url('pengaduan/ipsrs/'. $item->id) }}'" type="button" class="btn btn-success"><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="detail2{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Proses Laporan&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @if ($item->ket_penolakan == null)
                <table class="table table-striped display">
                    <thead>
                        <tr>
                            <th>STATUS</th>
                            <th>TGL</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        <tr>
                            <th><button class="btn btn-dark btn-sm" type="button" disabled>DITERIMA</button></th>
                            <td>{{ $item->tgl_diterima }}</td>
                            <td>{{ $item->ket_diterima }}</td>
                        </tr>
                        <tr>
                            <th><button class="btn btn-dark btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample{{ $item->id }}">DIKERJAKAN</button></th>
                            <td>{{ $item->tgl_dikerjakan }}</td>
                            <td>{{ $item->ket_dikerjakan }}</td>
                        </tr>
                        <tr>
                            <th><button class="btn btn-dark btn-sm" type="button" disabled>SELESAI</button></th>
                            <td>{{ $item->tgl_selesai }}</td>
                            <td>{{ $item->ket_selesai }}</td>
                        </tr>
                    </tbody>
                </table>
                @else
                    <p><b>Laporan Ditolak Pada : </b>{{ $item->selesai }}</p><br>
                    <p><b>Keterangan Penolakan : </b>{{ $item->ket_penolakan }}</p>
                @endif
                <p><b># Klik tombol Status Dikerjakan untuk melihat detail Status.</b></p>
                <div class="collapse" id="collapseExample{{ $item->id }}">
                    <div class="card card-body">
                        <h5><b>Status Dikerjakan</b></h5>
                        <table class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>TGL</th>
                                    <th>KETERANGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2021-19-29</td>
                                    <td>Alat sedang di ajukan dananya.</td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>
                </div>
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
        $('#pengaduan').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 0, "desc" ]]
            }
        );
        $('#maxpengaduan1').text('190 Limit Text');
        $('#maxpengaduan2').text('190 Limit Text');
        $('#pengaduan1').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#maxpengaduan1').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#maxpengaduan1').text(ch + ' Limit Text');     
            }
        }); 
        $('#pengaduan2').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#maxpengaduan2').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#maxpengaduan2').text(ch + ' Limit Text');     
            }
        }); 
    } );
</script>
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