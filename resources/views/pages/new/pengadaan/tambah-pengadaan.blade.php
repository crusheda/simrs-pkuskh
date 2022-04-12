@extends('layouts.newAdmin')

@section('content')
<div class="card">
  <div class="card-header">
    <button type="button" class="btn btn-dark" onclick="window.location='{{ route('pengadaan.index') }}'" data-toggle="tooltip" data-placement="bottom" title="KEMBALI KE TABEL PENGADAAN"><i class="fa-fw fas fa-caret-left nav-icon"></i> Kembali</button>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col">
        <label>Pemohon :</label><br>
        <h5 style="margin-bottom:-3px">{{ Auth::user()->nama }}</h5>
        <sub>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</sub>
      </div>
      <div class="col text-right">
        <a>Tuliskan (CITO) pada kolom keterangan, bila Darurat <i class="fa-fw fas fa-caret-left nav-icon"></i></a><br>
        <a>Mohon untuk menyertakan gambarnya <i class="fa-fw fas fa-caret-left nav-icon"></i></a>
      </div>
    </div>
    <hr>
    <form class="form-auth-small" action="{{ route('pengadaan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="table-responsive">
        <table id="table" class="table table-bordered display" style="table-layout: fixed;width: 100%;word-break: break-word;">
          <thead>
            <tr>
              <th style="width:40%">Nama</th>
              <th style="width:15%">Jumlah</th>
              <th style="width:15%">Satuan</th>
              <th style="width:20%">Harga</th>
              <th style="width:20%">Total</th>
              <th style="width:10%"></th>
            </tr>
          </thead>
          <tbody style="text-transform: capitalize">
            <tr>
              <td>
                <select name="barang" class="form-control select2">
                  <option hidden>Pilih</option>
                </select>
              </td>
              <td>
                <input type="text" class="form-control" placeholder="">
              </td>
              <td>
                <input type="text" class="form-control" placeholder="">
              </td>
              <td>
                <input type="text" class="form-control" placeholder="">
              </td>
              <td>
                <input type="text" class="form-control" placeholder="">
              </td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-info" onclick="tambahBaris()"><i class="fa-fw fas fa-plus-square nav-icon"></i></button>
                  <button class="btn btn-danger" onclick="hapusBaris()"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      {{-- <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Nama Barang</label>
            <select name="barang" class="form-control select2 mx-sm-3" style="width: 100%">
              <option hidden>Pilih</option>
            </select>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" class="form-control" placeholder="">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Satuan</label>
            <input type="text" class="form-control" placeholder="" readonly>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" placeholder="" readonly>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Total</label>
            <input type="text" class="form-control" placeholder="">
          </div>
        </div>
      </div> --}}
  </div>
  <div class="card-footer text-right">
    <div class="btn-group">

      <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('pengadaan.index') }}'" data-toggle="tooltip" data-placement="bottom" title="KEMBALI KE TABEL PENGADAAN"><i class="fa-fw fas fa-caret-left nav-icon"></i> Kembali</button>
      <button class="btn btn-primary" type="submit" data-toggle="tooltip" data-placement="bottom" title="AJUKAN SEKARANG"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
    </div>
    </form>
  </div>
</div>
<script>
  $(document).ready( function () {

  });
</script>
@endsection
