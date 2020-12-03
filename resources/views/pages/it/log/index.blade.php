@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-leaf nav-icon text-info">

                </i> Tabel Supervisi Unit IT

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses IT
                </span>
                
            </div>
            <div class="card-body">
                @can('log_it')
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambahlog">
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah Kegiatan
                            </a>
                        </div>
                    </div><br>
                    <div class="table-responsive">
                        <table id="logit" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NAMA</th>
                                    <th>KEGIATAN</th>
                                    <th>LOKASI</th>
                                    <th>KETERANGAN</th>
                                    <th>FILE</th>
                                    <th>TGL</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>
                                        @if ($item->filename == '')
                                        @else
                                            <center><a onclick="window.location.href='{{ url('it/supervisi/'. $item->id) }}'" class="btn btn-success btn-sm text-white"><i class="fa fa-download"></i></a></center>
                                        @endif
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        @if ($item->filename == '')
                                        @else
                                        {{ substr((Storage::size($item->filename) / 1048576),0,5) }} mb
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubahLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan=7>Tidak Ada Data</td>
                                    </tr>
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
</div>

<div class="modal fade bd-example-modal-lg" id="tambahlog" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Kegiatan Supervisi IT
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('supervisi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        {{-- <label>Nama : </label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="" required autofocus> --}}
                        <div>
                            <select class="fstdropdown-select" id="nama" name="nama" required>
                                <option selected="selected" value="" hidden>Pilih Nama...</option>
                                <option value="novi setiyawan">Novi Setiyawan</option>
                                <option value="yussuf faisal">Yussuf Faisal</option>
                                <option value="muhammad arizal yusuf hermawan">Muhammad Arizal Yusuf Hermawan</option>
                            </select>
                        </div>
                        <hr>
                        <label>Kegiatan : </label>
                        <input type="text" name="kegiatan" id="kegiatan" class="form-control" placeholder="" required>
                        <br>
                        <label>Lokasi :</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="">
                        <br>
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""></textarea>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label>Upload Lampiran</label>
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="file">
                        <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                    </div>
                    <br>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-primary"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubahLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Kegiatan Supervisi IT&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">{{ $item->updated_at->diffForHumans() }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('supervisi.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label>Nama : </label>
                        <input type="text" name="nama" id="nama" value="{{ $item->nama }}" class="form-control" placeholder="" disabled>
                        {{-- <div>
                            <select class="fstdropdown-select" id="nama" name="nama" required>
                                <option selected="selected" value="" hidden>Pilih Nama...</option>
                                <option value="novi setiyawan">Novi Setiyawan</option>
                                <option value="yussuf faisal">Yussuf Faisal</option>
                                <option value="muhammad arizal yusuf hermawan">Muhammad Arizal Yusuf Hermawan</option>
                            </select>
                        </div> --}}
                        <hr> 
                        <label>Kegiatan : </label>
                        <input type="text" name="kegiatan" id="kegiatan" value="{{ $item->kegiatan }}" class="form-control" placeholder="" required>
                        <br>
                        <label>Lokasi :</label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ $item->lokasi }}" class="form-control" placeholder="">
                        <br>
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder=""><?php echo htmlspecialchars($item->keterangan); ?></textarea>
                        <br>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <label>Detail Dokumen : </label>
                        @if ($item->filename == '')
                        -
                        @else
                           <b>{{ $item->title }}</b> ({{Storage::size($item->filename)}} bytes)
                        @endif
                    </div>
                    <br>
                </div>

        </div>
        <div class="modal-footer">
            
                <center><button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus?
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>
                @if(count($list) > 0)
                {{ $item->nama }}'s Files. <br>
                    @if ($item->filename == '')
                    Dokumen : - <br>
                    @else
                    Dokumen  : {{ $item->title }} ({{Storage::size($item->filename)}} bytes) <br>
                    @endif
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('supervisi.destroy', $item->id) }}" method="POST">
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
    <div class="modal fade bd-example-modal-lg" id="lihatLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                {{ $item->nama }}'s Files
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <p>
                
            </p>
            </div>
            <div class="modal-footer">
                <p class="pull-left"><td>{{ $item->updated_at->diffForHumans() }}</td></p>
            </div>
        </div>
        </div>
    </div>
@endforeach

<script>
$(document).ready( function () {
    $('#logit').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            order: [[ 6, "desc" ]]
        }
    );
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