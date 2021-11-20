@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="col-md-4">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">
                
                <i class="fa-fw fas fa-plus-square nav-icon text-success">

                </i> Tambah Supplier
    
                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body" id="tambah">
                <form class="form-auth-small" action="{{ route('pbf.store') }}" method="POST" enctype="multipart/form-data" id="formTambah">
                    @csrf
                    <div class="form-group">
                        <label>Nama Supplier :</label>
                        <input type="text" name="pbf" class="form-control" placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis :</label>
                        <select name="jenis" id="jenis" class="form-control" required>
                            <option hidden>Pilih</option>
                            <option value="obat">OBAT</option>
                            <option value="lab">LAB</option>
                            <option value="cs">CS</option>
                            <option value="alkes">ALKES</option>
                            <option value="sanitasi">SANITASI</option>
                            <option value="laundry">LAUNDRY</option>
                            <option value="rm">RM</option>
                            <option value="atk">ATK</option>
                            <option value="lainlain">LAIN-LAIN</option>
                        </select>
                    </div>
            </div>
            <div class="card-footer" style="background-color: #2F353A">

                    <button class="btn btn-success btn-sm text-white pull-right" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                    <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ route('pengajuan.index') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-sort-amount-asc nav-icon text-info">

                </i> Tabel Supplier
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-hover display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA SUPPLIER</th>
                                <th>JENIS</th>
                                <th>DITAMBAHKAN</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->pbf }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ditambahkan pada <b>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</b>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Data <b>{{ $item->pbf }}</b>?</p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('pbf.destroy', $item->id) }}" method="POST">
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
<div class="modal fade bd-example-modal-lg" id="edit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Supplier
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('pbf.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Supplier :</label>
                        <input type="text" name="pbf" value="{{ $item->pbf }}" class="form-control" placeholder="Masukkan nama PBF" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Jenis :</label>
                        <select name="jenis" class="form-control" required>
                            <option hidden>Pilih</option>
                            <option value="obat"        @if ($item->jenis == 'obat') echo selected @endif>OBAT</option>
                            <option value="lab"         @if ($item->jenis == 'lab') echo selected @endif>LAB</option>
                            <option value="cs"          @if ($item->jenis == 'cs') echo selected @endif>CS</option>
                            <option value="alkes"       @if ($item->jenis == 'alkes') echo selected @endif>ALKES</option>
                            <option value="sanitasi"    @if ($item->jenis == 'sanitasi') echo selected @endif>SANITASI</option>
                            <option value="laundry"     @if ($item->jenis == 'laundry') echo selected @endif>LAUNDRY</option>
                            <option value="rm"          @if ($item->jenis == 'rm') echo selected @endif>RM</option>
                            <option value="atk"         @if ($item->jenis == 'atk') echo selected @endif>ATK</option>
                            <option value="lainlain"    @if ($item->jenis == 'lainlain') echo selected @endif>LAIN-LAIN</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @foreach ($list['user'] as $us)
                @if ($item->id_user == $us->id)
                    <a>{{ $us->nama }}</a>
                @endif
            @endforeach
            <button class="btn btn-success text-white"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button>
        </div>
        {{ Form::close() }}
        @endif
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#table').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            order: [[ 3, "desc" ]]
        }
    );
    $("#tambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

        return true;
    });
} );

function saveData() {
    $("#formTambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        let x = $('#jenis').val();
        if (x == "Pilih") {

            Swal.fire({
                position: 'top',
                title: 'Perhatian',
                text: 'Anda belum memilih Jenis',
                icon: 'warning',
                showConfirmButton:false,
                showCancelButton:true,
                cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                timer: 3000,
                timerProgressBar: true,
                backdrop: `rgba(26,27,41,0.8)`,
            });

            return false;
        } else {
            $("#btn-simpan").attr('disabled','disabled');
            $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

            return true;
        }
    });
}
</script>

@endsection