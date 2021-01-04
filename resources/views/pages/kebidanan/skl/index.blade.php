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

                <i class="fa-fw fas fa-list-alt nav-icon text-info">

                </i> Surat Keterangan Lahir

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Kebidanan
                </span>
                
            </div>
            <div class="card-body">
                @can('skl')
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambahbayi">
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah Identitas Bayi
                            </a>
                        </div>
                    </div><br>
                    <div class="table-responsive">
                        <table id="skl" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>NO SURAT</th>
                                    <th>TGL</th>
                                    <th>IBU</th>
                                    <th>ANAK</th>
                                    <th>ALAMAT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->no_surat }}</td>
                                    <td>{{ $item->tgl }}</td>
                                    <td>{{ $item->ibu }}</td>
                                    <td>{{ $item->anak }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>
                                        <center><a type="button" href="{{ route('skl.cetak', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa-fw fas fa-print nav-icon"></i>
                                        </a>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubahskl{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button><hr></center>
                                        <center><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusskl{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button></center>
                                    </td>
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
                @else
                    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
                @endcan
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambahbayi" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Identitas Bayi
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" action="{{ route('skl.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <label>No Surat : </label>
                                <input type="number" name="no_surat" id="no_surat" value="{{ $list['nomer'] }}" class="form-control" placeholder="" disabled>
                                <input type="number" name="no_surat" id="no_surat" value="{{ $list['nomer'] }}" class="form-control" placeholder="" hidden>
                            </div>
                            <div class="col">
                                <label>Waktu :</label>
                                <input type="datetime-local" name="tgl" id="tgl" class="form-control" placeholder="">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Nama Ibu : </label>
                                <input type="text" name="ibu" id="ibu" class="form-control" placeholder="" required>
                            </div>
                            <div class="col">
                                <label>Nama Ayah : </label>
                                <input type="text" name="ayah" id="ayah" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <br>
                        <label>Nama Anak : </label>
                        <input type="text" name="anak" id="anak" class="form-control" placeholder="">
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>Berat Badan : </label>
                                <input type="number" name="bb" id="bb" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" class="form-control" placeholder="gram" required>
                            </div>
                            <div class="col">
                                <label>Tinggi Badan : </label>
                                <input type="number" name="tb" id="tb" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" class="form-control" placeholder="cm" required>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select id="kelamin" name="kelamin" class="form-control">
                                      <option hidden>Pilih</option>
                                      <option value="laki-laki">Laki-laki</option>
                                      <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Dokter : </label>
                            <select class="fstdropdown-select" id="dr" name="dr" required>
                                <option selected="selected" value="" hidden>Pilih</option>
                                <option value="1">dr. Gede Sri Dhyana, Sp.OG</option>
                                <option value="2">dr. H. Ahmad Sutamat, Sp.OG</option>
                            </select>
                        </div>
                        <label>Alamat :</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder=""></textarea>
                    </div>
                </div>

        </div>
        <div class="modal-footer">

                <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubahskl{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah Identitas Bayi&nbsp;<span class="pull-right badge badge-info text-white" style="margin-top:5px">{{ $item->updated_at->diffForHumans() }}</span>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('skl.update', $item->id), 'method' => 'PUT')) }}
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <label>No Surat : </label>
                            <input type="number" value="{{ $item->no_surat }}" class="form-control" disabled>
                            <input type="number" id="no_surat" name="no_surat" value="{{ $item->no_surat }}" hidden>
                        </div>
                        <div class="col">
                            <label>Waktu :</label>
                            <input type="datetime-local" name="tgl" id="tgl" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->tgl)); ?>" class="form-control" placeholder="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label>Nama Ibu : </label>
                            <input type="text" name="ibu" id="ibu" value="{{ $item->ibu }}" class="form-control" placeholder="" required>
                        </div>
                        <div class="col">
                            <label>Nama Ayah : </label>
                            <input type="text" name="ayah" id="ayah" value="{{ $item->ayah }}" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <br>
                    <label>Nama Anak : </label>
                    <input type="text" name="anak" id="anak" value="{{ $item->anak }}" class="form-control" placeholder="">
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Berat Badan : </label>
                            <input type="number" name="bb" id="bb" value="{{ $item->bb }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" class="form-control" placeholder="gram" required>
                        </div>
                        <div class="col">
                            <label>Tinggi Badan : </label>
                            <input type="number" name="tb" id="tb" value="{{ $item->tb }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" class="form-control" placeholder="cm" required>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="kelamin" name="kelamin" class="form-control">
                                  <option hidden>Pilih</option>
                                  <option value="laki-laki" @if ($item->kelamin == 'laki-laki') echo selected @endif>Laki-laki</option>
                                  <option value="perempuan" @if ($item->kelamin == 'perempuan') echo selected @endif>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Dokter : </label>
                        <select class="fstdropdown-select" id="dr" name="dr" required>
                            <option selected="selected" value="" hidden>Pilih</option>
                            <option value="1" @if ($item->dr == '1') echo selected @endif>dr. Gede Sri Dhyana, Sp.OG</option>
                            <option value="2" @if ($item->dr == '2') echo selected @endif>dr. H. Ahmad Sutamat, Sp.OG</option>
                        </select>
                    </div>
                    <label>Alamat :</label>
                    <textarea class="form-control" name="alamat" id="alamat"><?php echo htmlspecialchars($item->alamat); ?></textarea>
                </div>

        </div>
        <div class="modal-footer">
            
                <center><button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
            </form>

            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal" id="hapusskl{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ditambahkan <b>{{ $item->updated_at->diffForHumans() }}</b>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Identitas Bayi <b>Ny. {{ $item->ibu }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('skl.destroy', $item->id) }}" method="POST">
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

<script>
$(document).ready( function () {
    $('#skl').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ],
            order: [[ 2, "desc" ]]
        }
    );
} );
</script>
@endsection