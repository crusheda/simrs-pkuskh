@extends('layouts.newAdmin')

@section('content')
{{-- <h2 class="section-title">DataTables</h2> --}}
<p>
</p>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>Tabel Antigen</h4>
      </div>
      <div class="card-body">
        <div class="btn-group">
            <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" data-toggle="tooltip" data-placement="bottom" title="TAMBAH HASIL ANTIGEN PASIEN">
            <i class="fa-fw fas fa-plus-square nav-icon">

            </i>
            Tambah Hasil
            </button>
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#show" data-toggle="tooltip" data-placement="bottom" title="DATA PASIEN HARI INI"><i class="fa-fw fas fa-info nav-icon text-white"></i> Informasi</button><br>
        </div><br>
        <sub>Data yang ditampilkan hanya berjumlah 30 data terbaru saja, Klik <a href="#" onclick="window.location.href='{{ url('lab/antigen/all') }}'"><strong><u>Disini</u></strong></a> untuk melihat data seluruhnya.</sub>
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

@can('antigen')
    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Tambah Hasil Antigen
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-auth-small" action="{{ route('lab.antigen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label>RM :</label>
                            <input type="number" name="rm" id="rm" max="99999999" class="form-control" placeholder="" required><br>
                        </div>
                        <div class="col-md-5">
                            <label>Pemeriksa :</label>
                            <input type="text" name="pemeriksa" id="pemeriksa" class="form-control" placeholder="Optional"><br>
                        </div>
                        <div class="col-md-4">
                            <label>Tgl :</label>
                            <input type="datetime-local" name="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($list['now'])); ?>" required><br>
                        </div>
                        <div class="col-md-8">
                            <label>Dokter Pengirim :</label>
                            <select class="form-control select2" name="dr_pengirim" id="dr_pengirim" style="width: 100%" required>
                                <option value="" hidden>Pilih</option>
                                    @foreach($list['dokter'] as $key => $item)
                                        <option value="{{ $item->id }}"><label><b>{{ $item->jabatan }}</b></label> - {{ $item->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Hasil :</label>
                            <select class="form-control selectric" name="hasil" id="hasil" style="width: 100%" required>
                                <option value="" hidden>Pilih</option>
                                <option value="POSITIF">POSITIF</option>
                                <option value="NEGATIF">NEGATIF</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Nama :</label>
                            <input type="text" name="nama" id="nama1" class="form-control" placeholder="" hidden>
                            <input type="text" id="nama2" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Jenis Kelamin :</label>
                            <input type="text" name="jns_kelamin" id="jns_kelamin1" class="form-control" hidden>
                            <input type="text" id="jns_kelamin2" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Umur :</label>
                            <input type="text" name="umur" id="umur1" class="form-control" hidden>
                            <input type="text" id="umur2" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-12">
                            <label>Alamat :</label>
                            <input type="text" name="des" id="des" class="form-control" hidden>
                            <input type="text" name="kec" id="kec" class="form-control" hidden>
                            <input type="text" name="kab" id="kab" class="form-control" hidden>
                            <textarea class="form-control" name="alamat" id="alamat1" placeholder="" maxlength="190" rows="8" hidden></textarea>
                            <textarea class="form-control" style="min-height: 100px" id="alamat2" placeholder="" maxlength="190" rows="5" disabled></textarea>
                        </div>
                    </div><br>
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan <kbd>Nomor RM</kbd> sesuai dengan Database Pilar.</a>

            </div>
            <div class="modal-footer">

                    <center><button class="btn btn-success"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </div>
        </div>
        </div>
    </div>

    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Ubah Hasil Antigen&nbsp;<span class="pull-right badge badge-info text-white">ID : {{ $item->id }}</span>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::model($item, array('route' => array('lab.antigen.update', $item->id), 'method' => 'PUT')) }}
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label>RM :</label>
                            <input type="number" name="rm" max="999999" value="{{ $item->rm }}" class="form-control" hidden><br>
                            <input type="number" value="{{ $item->rm }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-5">
                            <label>Pemeriksa :</label>
                            <input type="text" name="pemeriksa" value="{{ $item->pemeriksa }}" class="form-control" placeholder="Optional"><br>
                        </div>
                        <div class="col-md-4">
                            <label>Tgl :</label>
                            <input type="datetime-local" name="tgl" class="form-control" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->tgl)); ?>"><br>
                        </div>
                        <div class="col-md-8">
                            <label>Dokter Pengirim :</label>
                            <select class="form-control select2" style="width: 100%" name="dr_pengirim" required>
                                <option value="" hidden>Pilih</option>
                                @foreach($list['dokter'] as $key)
                                    <option value="{{ $key->id }}" @if ($item->dr_pengirim == $key->id) echo selected @endif><label>{{ $key->jabatan }}</label> - {{ $key->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Hasil :</label>
                            <select class="form-control selectric" name="hasil" style="width: 100%" required>
                                <option value="" hidden>Pilih</option>
                                <option value="POSITIF" @if ($item->hasil == 'POSITIF') echo selected @endif>POSITIF</option>
                                <option value="NEGATIF" @if ($item->hasil == 'NEGATIF') echo selected @endif>NEGATIF</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Nama :</label>
                            <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" placeholder="" hidden required>
                            <input type="text" value="{{ $item->nama }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Jenis Kelamin :</label>
                            <input type="text" name="jns_kelamin" value="{{ $item->jns_kelamin }}" class="form-control" hidden>
                            <input type="text" value="{{ $item->jns_kelamin }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-3">
                            <label>Umur :</label>
                            <input type="text" name="umur" value="{{ $item->umur }}" class="form-control" hidden>
                            <input type="text" value="{{ $item->umur }}" class="form-control" disabled><br>
                        </div>
                        <div class="col-md-12">
                            <label>Alamat :</label>
                            <textarea class="form-control" style="min-height: 100px" name="alamat3" placeholder="" maxlength="190" rows="5" hidden><?php echo htmlspecialchars($item->alamat); ?></textarea>
                            <textarea class="form-control" disabled><?php echo htmlspecialchars($item->alamat); ?></textarea>
                        </div>
                    </div><br>
                    <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Jika terdapat kesalahan pada penulisan <kbd>Nomor RM</kbd> , silakan Hapus data dan Input ulang kembali</a>
                    
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
    <div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    ID : {{ $item->id }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        @if(count($list) > 0)
                            <a>Apakah anda yakin ingin menghapus Hasil Antigen Pasien a/n {{ $item->nama }} dengan Nomer RM : <kbd>{{ $item->rm }}</kbd> ?</a>
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    @if(count($list) > 0)
                        <form action="{{ route('lab.antigen.destroy', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    <div class="modal fade bd-example-modal-lg" id="show" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Data Pasien Antigen Hari Ini
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @if(!empty($list['getpos'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN POSITIF (HARI INI) : <kbd style="background-color: red">{{ $list['getpos'][0]->jumlah }} Pasien</kbd></a> <br><br>
                    @endif
                    @if(!empty($list['getneg'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> ANTIGEN NEGATIF (HARI INI) : <kbd style="background-color: royalblue">{{ $list['getneg'][0]->jumlah }} Pasien</kbd></a> <br><br>
                    @endif
                    @if(!empty($list['gettoday'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN HARI INI : <kbd style="background-color: rgba(134, 19, 87, 0.45)">{{ $list['gettoday'][0]->jumlah }} Pasien</kbd></a> <br><br>
                    @endif
                    @if(!empty($list['getmont'][0]->jumlah))
                        <a><i class="fa-fw fas fa-caret-right nav-icon"></i> TOTAL ANTIGEN BULAN INI : <kbd style="background-color: rgb(23, 106, 4)">{{ $list['getmont'][0]->jumlah }} Pasien</kbd></a>
                    @endif
                </div>
                <div class="modal-footer">
                    <a class="pull-left"><b># Updated {{ \Carbon\Carbon::parse($list['now'])->isoFormat('DD MMMM YYYY') }}</b></a>
                </div>
            </div>
        </div>
    </div>
@endcan

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
      ],
      order: [[ 5, "desc" ]],
      pageLength: 10
      // "columnDefs": [
      //   { "sortable": false, "targets": [0,2,3] }
      // ],
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
    $('#rm').change(function() { 
        if (this.value == '') {
            $("#nama1").val("");
            $("#nama2").val("");
            $("#jns_kelamin1").val("");
            $("#jns_kelamin2").val("");
            $("#umur2").val("");
            $("#umur1").val("");
            $("#alamat1").val("");
            $("#alamat2").val("");
            $("#des").val("");
            $("#kec").val("");
            $("#kab").val("");
        } else {
            if (this.value.length == 4) {
                this.value = '0000'+this.value;
            }
            if (this.value.length == 5) {
                this.value = '000'+this.value;
            } 
            if (this.value.length == 6) {
                this.value = '00'+this.value;
            }
            if (this.value.length < 4) {
                this.value = this.value;
            }
            $.ajax({
                url: "http://192.168.1.3:8000/api/all/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res);
                    $("#nama1").val(res.NAMAPASIEN);
                    $("#nama2").val(res.NAMAPASIEN);
                    $("#jns_kelamin1").val(res.JNSKELAMIN);
                    $("#jns_kelamin2").val(res.JNSKELAMIN);
                    $("#umur1").val(res.UMUR);
                    $("#umur2").val(res.UMUR);
                    $("#alamat1").val(res.ALAMAT);
                    $("#alamat2").val(res.ALAMAT);
                    
                    $("#des").val(res.DESA);
                    $("#kec").val(res.KECAMATAN);
                    $("#kab").val(res.NAMA_KABKOTA);
                    // $('#jumlah20').attr('required', true);
                }
            });
            $.ajax({
                url: "http://103.155.246.25:8000/api/all/"+this.value,
                // url: "http://192.168.1.3:8000/api/all/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res);
                    $("#nama1").val(res.NAMAPASIEN);
                    $("#nama2").val(res.NAMAPASIEN);
                    $("#jns_kelamin1").val(res.JNSKELAMIN);
                    $("#jns_kelamin2").val(res.JNSKELAMIN);
                    $("#umur1").val(res.UMUR);
                    $("#umur2").val(res.UMUR);
                    $("#alamat1").val(res.ALAMAT);
                    $("#alamat2").val(res.ALAMAT);

                    $("#des").val(res.DESA);
                    $("#kec").val(res.KECAMATAN);
                    $("#kab").val(res.NAMA_KABKOTA);
                    // $('#jumlah20').attr('required', true);
                }
            });
        }
    });
  })
</script>
@endsection