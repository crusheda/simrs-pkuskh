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
        <kbd>{{ $list['ref']->nama }}</kbd><br>
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
              <th style="width:45%">Nama</th>
              <th style="width:15%">Jumlah</th>
              <th style="width:25%">Harga</th>
              <th style="width:25%">Total</th>
              <th style="width:10%"></th>
            </tr>
          </thead>
          <tbody style="text-transform: capitalize" id="tbody">
            <tr id="data1">
              <td>
                <select name="barang[]" id="barang1" class="form-control select2" required>
                  <option hidden>Pilih</option>
                </select>
              </td>
              <td>
                <input type="text" name="jumlah[]" id="jumlah1" class="form-control" placeholder="" required>
              </td>
              <td>
                <input type="text" name="harga[]" id="harga1" class="form-control" placeholder="">
              </td>
              <td>
                <input type="text" name="total[]" id="total1" class="form-control" placeholder="">
              </td>
              <td>
                <div class="btn-group">
                  <a type="button" id="tambah1" class="btn btn-info" href="javascript:void(0)" onclick="tambahBaris(1)" data-toggle="tooltip" data-placement="left" title="TAMBAH BARIS"><i class="fa-fw fas fa-plus-square nav-icon"></i></a>
                  {{-- <a type="button" id="hapus1" class="btn btn-danger" href="javascript:void(0)" onclick="hapusBaris(1)" hidden><i class="fa-fw fas fa-trash nav-icon"></i></a> --}}
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
    $.ajax(
      {
        url: "./tambah/api/barang/{{ $list['ref']->id }}",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          // $("#barang1").find('option').remove();
          res.show.forEach(item => {
            $("#barang1").append(`
                <option value="${item.id}">${item.nama} (${item.satuan})</option>
            `);
          });
        }
      }
    );

    // const elements = document.querySelectorAll('.barang');
    $('select').on('change', function() {
    // $('#barang2').change(function() { 
    // elements.change(function() { 
    console.log(this.value);
    
      if (this.value == '') {
        // $("#jumlah1").val("");
        // $("#satuan1").val("");
        // $("#harga1").val("");
        // $('#jumlah1').attr('required', false);
      } else {
        $.ajax({
          url: "./tambah/api/barang/detail/"+this.value,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            $("#harga1").val(res.harga);
          }
        });
      }
    });
    $('input').keyup(function() {
      var dInput = this.value;
      console.log(dInput);
    });
  });
</script>
<script>
  function tambahBaris(val) {
    $('#tambah'+val).find("i").toggleClass("fa-plus-square fa-sync fa-spin");
    $.ajax(
      {
        url: "./tambah/api/barang/{{ $list['ref']->id }}",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          // <i class="fa fa-spinner fa-spin fa-fw"></i> 
          // $('#tambah'+val).prop('disabled', true);
          // $("#barang1").find('option').remove();
          var addVal = val + 1;
          content = "<tr id='data"+ addVal +"'>"
                  + "<td><select name='barang[]' id='barang"+addVal+"' class='form-control select2 barang' required>"
                  + "<option hidden>Pilih</option></select></td>" 
                  + "<td><input type='text' name='jumlah[]' class='form-control' placeholder='' required></td>" 
                  + "<td><input type='text' name='harga[]' class='form-control' placeholder=''></td>" 
                  + "<td><input type='text' name='total[]' class='form-control' placeholder=''></td>" 
                  + "<td><div class='btn-group'>"
                    + "<a type='button' id='tambah"+addVal+"' class='btn btn-info' href='javascript:void(0)' onclick='tambahBaris("+addVal+")' data-toggle='tooltip' data-placement='left' title='TAMBAH BARIS'><i class='fa-fw fas fa-plus-square nav-icon'></i></a>"
                    + "<a type='button' id='hapus"+addVal+"' class='btn btn-danger' href='javascript:void(0)' onclick='hapusBaris("+addVal+")' data-toggle='tooltip' data-placement='bottom' title='HAPUS BARIS'><i class='fa-fw fas fa-trash nav-icon'></i></a>"
                  + "</div></td></tr>";
          $('#tbody').append(content);
          $("#barang"+addVal).select2();
                    
          res.show.forEach(item => {
            $("#barang"+addVal).append(
              `<option value="${item.id}">${item.nama} (${item.satuan})</option>`
            );
          })
          
          $('#tambah'+val).prop('hidden', true); 
          $('#hapus'+val).prop('hidden', true);
          $('#tambah'+val).find("i").removeClass("fa-sync fa-spin").addClass("fa-plus-square");
        }
      }
    );
    // $("#tampil-tbody").empty();
  }

  function hapusBaris(val) {
    var minVal = val - 1;
    // if (minVal == 1) {
    //   $('#data'+val).remove();
    //   if (val > 2) {
    //     $('#tambah'+minVal).prop('hidden', false);
    //     $('#hapus'+minVal).prop('hidden', true);
    //   } else {
    //     $('#tambah'+minVal).prop('hidden', true);
    //     $('#hapus'+minVal).prop('hidden', false);
    //   }
    // } else {
    //   $('#data'+val).remove();
    //   $('#tambah'+minVal).prop('hidden', false); 
    // }
    $('#data'+val).remove();
    if (minVal == 1) {
      $('#tambah'+minVal).prop('hidden', false);
    } else {
      $('#tambah'+minVal).prop('hidden', false);
      $('#hapus'+minVal).prop('hidden', false);
    }
  }
</script>
@endsection
