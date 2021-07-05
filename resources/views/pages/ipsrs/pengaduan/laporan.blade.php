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
                Akses <b style="text-transform: uppercase">{{ Auth::user()->roles->first()->name }}</b>
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

            @role('ipsrs')
            <div class="table-responsive">
                <table id="pengaduan_ipsrs" class="table table-striped display">
                    <thead>
                        <tr>
                            <th><center>DETAIL</center></th>
                            <th>NAMA</th>
                            <th>UNIT</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                            <th>TGL</th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td><center><button onclick="window.location.href='{{ url('pengaduan/ipsrs/detail/'.$item->id) }}'" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button></center></td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->lokasi }}</td>
                            
                            @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                            @elseif (!empty($item->ket_penolakan))
                                <td><kbd style="background-color: red">Ditolak</kbd></td>
                            @elseif (empty($item->tgl_diterima))
                            <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                            @elseif (empty($item->tgl_dikerjakan))
                                <td><kbd style="background-color: salmon">Diterima</kbd></td>
                            @elseif (empty($item->tgl_selesai))
                                <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                            @endif
                            
                            <td>{{ $item->tgl_pengaduan }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            @else

            <div class="table-responsive">
                <table id="pengaduan_user" class="table table-striped display">
                    <thead>
                        <tr>
                            <th><center>DETAIL</center></th>
                            <th>NAMA</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                            <th>TGL</th>
                            <th><center>AKSI</center></th>
                        </tr>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @if(count($list['show']) > 0)
                        @foreach($list['show'] as $item)
                        <tr>
                            <td><center><button type="button" @if (!empty($item->tgl_selesai)) class="btn btn-success btn-sm" @else class="btn btn-primary btn-sm" @endif data-toggle="modal" data-target="#detail2{{ $item->id }}"><i class="fa-fw fas fa-search nav-icon"></i> Lihat</button></center></td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->lokasi }}</td>

                            @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                            @elseif (!empty($item->ket_penolakan))
                                <td><kbd style="background-color: red">Ditolak</kbd></td>
                            @elseif (empty($item->tgl_diterima))
                                <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                            @elseif (empty($item->tgl_dikerjakan))
                                <td><kbd style="background-color: salmon">Diterima</kbd></td>
                            @elseif (empty($item->tgl_selesai))
                                <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                            @endif
                            
                            <td>{{ $item->tgl_pengaduan }}</td>
                            <td>
                                <center>
                                    @if (empty($item->tgl_selesai))
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lampiran{{ $item->id }}"><i class="fa-fw fas fa-picture-o nav-icon"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lampiran{{ $item->id }}"><i class="fa-fw fas fa-picture-o nav-icon"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    @endif
                                </center>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @endrole
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
                    <table id="recent" class="table table-striped display">
                        <thead>
                            <tr>
                                <th><center>DETAIL</center></th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>LOKASI</th>
                                <th>STATUS</th>
                                <th>TGL MULAI</th>
                                <th>TGL SELESAI</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['showrecent']) > 0)
                            @foreach($list['showrecent'] as $item)
                            <tr>
                                <td>
                                    <center>
                                        <button onclick="window.location.href='{{ url('pengaduan/ipsrs/detail/'.$item->id) }}'" type="button" class="btn btn-success btn-sm"><i class="fa fa-search"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lampiranIPSRS{{ $item->id }}"><i class="fa-fw fas fa-history nav-icon"></i></button>
                                    </center>
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>
                                @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                    <kbd style="background-color: turquoise">Selesai</kbd>
                                @elseif (!empty($item->ket_penolakan))
                                    <kbd style="background-color: red">Ditolak</kbd>
                                @elseif (empty($item->tgl_diterima))
                                    <kbd style="background-color: rebeccapurple">Diverifikasi</kbd>
                                @elseif (empty($item->tgl_dikerjakan))
                                    <kbd style="background-color: salmon">Diterima</kbd>
                                @elseif (empty($item->tgl_selesai))
                                    <kbd style="background-color: orange">Dikerjakan</kbd>
                                @endif
                                </td>
                                
                                <td>{{ $item->tgl_pengaduan }}</td>
                                <td>{{ $item->tgl_selesai }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endrole

{{-- Tambah --}}
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
                    {{-- <div class="col-md-4">
                        <label>Nama : </label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->name }}" disabled><br>
                    </div>
                    <div class="col-md-4">
                        <label>Unit : </label>
                        <input type="text" name="unit" id="unit" class="form-control" value="{{ Auth::user()->roles->first()->name }}" disabled><br>
                    </div> --}}
                    <div class="col-md-12">
                        <label>Lokasi : </label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="" required><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Pengaduan :</label>
                        <textarea class="form-control" name="pengaduan" id="pengaduan1" placeholder="" maxlength="190" rows="8" required></textarea>
                        <span class="help-block">
                            <p id="maxpengaduan1" class="help-block "></p>
                        </span>
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
                        {{-- <div class="col-md-4">
                            <label>Nama : </label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->nama }}" disabled><br>
                        </div>
                        <div class="col-md-4">
                            <label>Unit : </label>
                            <input type="text" name="unit" id="unit" class="form-control" value="{{ $item->unit }}" disabled><br>
                        </div> --}}
                        <div class="col">
                            <label>Lokasi : </label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $item->lokasi }}" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Pengaduan :</label>
                            <textarea class="form-control" name="pengaduan" id="pengaduan2" placeholder="" maxlength="190" rows="8" required><?php echo htmlspecialchars($item->ket_pengaduan); ?></textarea>
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

{{-- Download Lampiran FOTO User --}}
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
            <h6 class="text-left">Keterangan Pengaduan :</h6>
            <div class="card">
                <div class="card-body">
                    <p>{{ $item->ket_pengaduan }}</p>
                </div>
            </div><hr>
            <h6 class="text-left">Lampiran Pengaduan :</h6>
            
            @if (empty($item->filename_pengaduan))
                <div class="card">
                    <div class="card-body">
                        <center><p><b>Tidak Ada Lampiran</b></p></center>
                    </div>
                </div>
            @else
                <center><img src="{{ url('public/storage/'.substr($item->filename_pengaduan,7,2000)) }}" style="width:400px" alt="" title="" /></center>
            @endif
        </div>
        <div class="modal-footer">
            @if (empty($item->filename_pengaduan))
                <button type="button" class="btn btn-secondary" disabled><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
            @else
                <button onclick="window.location.href='{{ url('pengaduan/ipsrs/'. $item->id) }}'" type="button" class="btn btn-success"><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
            @endif
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@role('ipsrs')
{{-- Download Lampiran FOTO IPSRS RECENT --}}
@foreach($list['showrecent'] as $item)
<div class="modal" tabindex="-1" id="lampiranIPSRS{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Detail Pengaduan&nbsp;<kbd>ID : {{ $item->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6 class="text-left">Keterangan Pengaduan :</h6>
            <div class="card">
                <div class="card-body">
                    <p>{{ $item->ket_pengaduan }}</p>
                </div>
            </div><hr>
            <h6 class="text-left">Lampiran Pengaduan :</h6>
            @if (empty($item->filename_pengaduan))
                <div class="card">
                    <div class="card-body">
                        <center><p><b>Tidak Ada Lampiran</b></p></center>
                    </div>
                </div>
            @else
                {{-- <center><img src="{{ url('public/storage/'.substr($item->filename_pengaduan,7,2000)) }}" style="width:400px" alt="" title="" /></center> --}}
                <center><img src="{{ url('storage/'.substr($item->filename_pengaduan,7,1000)) }}" style="width:400px" alt="" title="" /></center>
            @endif
        </div>
        <div class="modal-footer">
            @if (empty($item->filename_pengaduan))
                <button type="button" class="btn btn-secondary" disabled><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
            @else
                <button onclick="window.location.href='{{ url('pengaduan/ipsrs/'. $item->id) }}'" type="button" class="btn btn-success"><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach
@endrole

{{-- Tombol Lihat Proses Laporan User --}}
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
                <p><b># Klik tombol Status <kbd>DIKERJAKAN</kbd> untuk melihat detail Status.</b></p>
                @else
                    <p><b>Laporan Ditolak Pada : </b>{{ $item->tgl_selesai }}</p>
                    <p><b>Keterangan Penolakan : </b></p>
                    <textarea class="form-control" disabled><?php echo htmlspecialchars($item->ket_penolakan); ?></textarea>
                @endif
                <div class="collapse" id="collapseExample{{ $item->id }}">
                    <div class="card card-body">
                        <h5><b>Status Dikerjakan</b></h5>
                        <table class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>TGL</th>
                                    <th>KETERANGAN</th>
                                    <th><center>LAMPIRAN</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $data = \App\Models\pengaduan_ipsrs_catatan::where('pengaduan_id', $item->id)->get();
                                @endphp
                                @if(count($data) > 0)
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <center>
                                            @if (!empty($item->title))
                                                <button class="btn btn-success" onclick="window.location.href='{{ url('pengaduan/ipsrs/lampiran/catatan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                            @else
                                                <button class="btn btn-secondary" disabled><i class="fa-fw fas fa-download nav-icon"></i></button>
                                            @endif
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan=3>Tidak Ada Data</td>
                                    </tr>
                                @endif
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

@role('ipsrs')
{{-- Recent Detail Laporan --}}
@foreach($list['showrecent'] as $item)
<div class="modal" tabindex="-1" id="detail4{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Detail Laporan&nbsp;<kbd>ID : {{ $item->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6>- <b>Status Laporan :</b> 
                @if ($item->ket_penolakan == null)
                    <kbd>Laporan Selesai</kbd>
                @else
                    <kbd>Laporan Ditolak</kbd>
                @endif
            </h6>
            <h6>- <b>Tgl : </b>{{ $item->tgl_selesai }}</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach
@endrole

<script>
    $(document).ready( function () {
        $('#pengaduan_ipsrs').DataTable(
            {
                paging: true,
                searching: true,
                order: [[ 5, "desc" ]]
            }
        );
        $('#pengaduan_user').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 4, "desc" ]]
            }
        );
        $('#recent').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 5, "desc" ]]
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