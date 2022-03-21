@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>Tabel Antigen Keseluruhan</h4>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambahbayi">
            <i class="fa-fw fas fa-plus-square nav-icon">

            </i>
            Tambah Identitas Bayi
        </button><br>
        <sub>Disarankan untuk menggunakan Browser <b>Google Chrome</b>.</sub><hr>
        <div class="table-responsive">
          <table id="table" class="table table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TGL</th>
                    <th>IBU</th>
                    <th>AYAH</th>
                    <th>ANAK</th>
                    <th>ALAMAT</th>
                    <th><center>#</center></th>
                </tr>
            </thead>
            <tbody style="text-transform: capitalize">
                @if(count($list['show']) > 0)
                @foreach($list['show'] as $item)
                <tr>
                    <td>{{ $item->no_surat }}</td>
                    <td>{{ $item->tgl }}</td>
                    <td>{{ $item->ibu }}</td>
                    <td>{{ $item->ayah }}</td>
                    <td>{{ $item->anak }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <center>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning btn-sm" target="popup" onclick="window.open('skl/{{ $item->id }}/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon text-white"></i></button>
                            <a type="button" href="{{ route('skl.cetak', $item->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubahskl{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusskl{{ $item->id }}" data-toggle="tooltip" data-placement="right" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
                          <select class="custom-select" id="dr" name="dr" required>
                              <option selected="selected" value="" hidden>Pilih</option>
                              <option value="1">dr. Gede Sri Dhyana, Sp.OG</option>
                              <option value="2">dr. H. Ahmad Sutamat, Sp.OG</option>
                              <option value="3">dr. Febrian Andhika Adiyana, Sp.OG</option>
                          </select>
                      </div>
                      <label>Alamat :</label>
                      <textarea class="form-control" style="min-height: 100px" maxlength="190" rows="5" name="alamat" id="alamat" placeholder=""></textarea>
                  </div>
              </div>

      </div>
      <div class="modal-footer">

              <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
          </form>

          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
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
          Ubah Identitas Bayi&nbsp;<span class="pull-right badge badge-info text-white">{{ $item->updated_at->diffForHumans() }}</span>
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
                      <select class="custom-select" id="dr" name="dr" required>
                          <option selected="selected" value="" hidden>Pilih</option>
                          <option value="1" @if ($item->dr == '1') echo selected @endif>dr. Gede Sri Dhyana, Sp.OG</option>
                          <option value="2" @if ($item->dr == '2') echo selected @endif>dr. H. Ahmad Sutamat, Sp.OG</option>
                          <option value="3" @if ($item->dr == '3') echo selected @endif>dr. Febrian Andhika Adiyana, Sp.OG</option>
                      </select>
                  </div>
                  <label>Alamat :</label>
                  <textarea class="form-control" name="alamat" id="alamat"><?php echo htmlspecialchars($item->alamat); ?></textarea>
              </div>

      </div>
      <div class="modal-footer">
          
              <center><button class="btn btn-primary pull-right"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
          </form>

          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
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
              stateSave: true,
              buttons: [
                {
                  extend: 'copyHtml5',
                  className: 'btn-info',
                  text: 'Salin Baris',
                  download: 'open',
                },
                {
                  extend: 'excelHtml5',
                  className: 'btn-success',
                  text: 'Export Excell',
                  download: 'open',
                },
                {
                  extend: 'pdfHtml5',
                  className: 'btn-warning',
                  text: 'Cetak PDF',
                  download: 'open',
                },
              ],
              order: [[ 1, "desc" ]],
              pageLength: 10
          }
      );
  } );
  </script>

@endsection