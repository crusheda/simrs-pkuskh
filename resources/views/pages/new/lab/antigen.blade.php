@extends('layouts.newAdmin')

@section('content')
{{-- <h2 class="section-title">DataTables</h2> --}}
<p>
  Data yang ditampilkan hanya berjumlah 30 data terbaru saja, Klik <a href="#"><strong>Disini</strong></a> untuk melihat data seluruhnya.
</p>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>Tabel Antigen</h4>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-primary text-white" onclick="autoFocus()" data-toggle="modal" data-target="#tambah" data-toggle="tooltip" data-placement="bottom" title="TAMBAH HASIL ANTIGEN PASIEN">
          <i class="fa-fw fas fa-plus-square nav-icon">

          </i>
          Tambah Hasil
        </button>
        <button type="button" class="btn btn-dark pull-right" data-toggle="modal" data-target="#show" data-toggle="tooltip" data-placement="bottom" title="DATA PASIEN HARI INI"><i class="fa-fw fas fa-info nav-icon text-white"></i> Informasi</button>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped" id="tableku">
            <thead>
              <tr>
                <th>DOKTER PENGIRIM</th>
                <th>RM</th>
                <th>PASIEN</th>
                <th>JK/UMUR</th>
                <th>ALAMAT</th>
                <th>TGL</th>
                <th>HASIL</th>
                <th><center>AKSI</center></th>
              </tr>
            </thead>
            <tbody>
              @if(count($list) > 0)
                  @foreach($list['show'] as $key => $item)
                  <tr>
                      <td>
                          @php
                              echo \App\Models\dokter::where('id', $item->dr_pengirim)->pluck('nama')->first();
                          @endphp
                      </td>
                      <td><b><kbd>{{ $item->rm }}</kbd></b></td>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->jns_kelamin }} / {{ $item->umur }}</td>
                      <td>{{ $item->alamat }}</td>
                      <td>{{ $item->tgl }}</td>
                      <td>
                          @if ($item->hasil == "POSITIF")
                              <kbd style="background-color: red">{{ $item->hasil }}</kbd>
                          @else
                              <kbd style="background-color: royalblue">{{ $item->hasil }}</kbd>
                          @endif
                      </td>
                      <td>
                          <center>
                              <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-info btn-sm" target="popup" onclick="window.open('antigen/{{ $item->id }}/print','id','width=900,height=600')" data-toggle="tooltip" data-placement="left" title="PRINT"><i class="fa-fw fas fa-print nav-icon"></i></button>
                                  <a type="button" class="btn btn-success btn-sm" href="{{ route('lab.antigen.cetak', $item->id) }}" data-toggle="tooltip" data-placement="bottom" title="DOWNLOAD"><i class="fa-fw fas fa-download nav-icon"></i></a>
                                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                              </div>
                          </center>
                      </td>
                  </tr>
                  @endforeach
              @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>DOKTER PENGIRIM</th>
                    <th>RM</th>
                    <th>PASIEN</th>
                    <th>JK/UMUR</th>
                    <th>ALAMAT</th>
                    <th>TGL</th>
                    <th>HASIL</th>
                    <th><center>AKSI</center></th>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script>
  $(document).ready( function () {
    $("#tableku").dataTable({
      dom: 'Bfrtip',
        buttons: [
          // 'copyHtml5',
          // 'excelHtml5',
          // 'csvHtml5',
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
        ]
      // "columnDefs": [
      //   { "sortable": false, "targets": [0,2,3] }
      // ],
    });
  })
</script>
@endsection