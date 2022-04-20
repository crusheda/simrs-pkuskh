@extends('layouts.newAdmin')

@section('content')
{{-- SweetAlert2 for Button Ajukan --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css" rel="stylesheet"/>

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
    <form class="form-auth-small" id="formTambah" action="{{ route('pengadaan.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return submitForm(this);">
      @csrf
      <div class="table-responsive">
        <table id="table" class="table table-bordered display" style="table-layout: fixed;width: 100%;word-break: break-word;">
          <thead>
            <tr>
              <th style="width:27%">Nama</th>
              <th style="width:10%">Jumlah</th>
              <th style="width:15%">Harga</th>
              <th style="width:15%">Total</th>
              <th style="width:25%">Keterangan</th>
              <th style="width:8%"></th>
            </tr>
          </thead>
          <tbody style="text-transform: capitalize" id="tbody">
            <tr id="data1">
              <td hidden><input type="text" name="satuan[]" id="satuan1" class="form-control"></td>
              <td>
                <select name="barang[]" id="barang1" class="form-control select2" disabled required>
                  <option hidden>Memproses Data Barang...</option>
                </select>
              </td>
              <td>
                <input type="text" name="jumlah[]" id="jumlah1" class="form-control" placeholder="" disabled required>
              </td>
              <td>
                <input type="text" name="harga[]" id="harga1" class="form-control" placeholder="" readonly>
              </td>
              <td>
                <input type="text" name="total[]" id="total1" class="form-control" placeholder="" readonly>
              </td>
              <td>
                <input type="text" name="ket[]" id="ket1" class="form-control" placeholder="" disabled>
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
  </div>
  <div class="card-footer text-right">
    <div class="btn-group">
      <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('pengadaan.index') }}'" data-toggle="tooltip" data-placement="bottom" title="KEMBALI KE TABEL PENGADAAN"><i class="fa-fw fas fa-caret-left nav-icon"></i> Kembali</button>
      {{-- <button type="button" class="btn btn-primary" title="VALIDASI FORM" id="btn-submit" type="submit"><i class="fa-fw fas fa-save nav-icon"></i> Validasi</button> --}}
      <input type="submit" class="btn btn-primary fas fa-save" data-toggle="tooltip" data-placement="bottom" title="VALIDASI FORM" value="&#xf0c7; Ajukan"/>
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
          $("#barang1").find('option').remove();
          $('#barang1').append(`
              <option hidden>Pilih</option>
          `);
          res.show.forEach(item => {
            $("#barang1").append(`
                <option value="${item.id}">${item.nama} (${item.satuan})</option>
            `);
          });
          $("#barang1").prop('disabled', false);
        }
      }
    );

    $("#barang1").on('change', function() {
      $("#jumlah1").val("");
      $("#total1").val("");
      if (this.value == 'Pilih') {
        $("#jumlah1").prop('disabled', true); 
        $("#ket1").prop('disabled', true); 
        $("#harga1").val("");
        $("#satuan1").val("");
        $("#total1").val("");
      } else {
        $.ajax({
          url: "./tambah/api/barang/detail/"+this.value,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            $("#jumlah1").prop('disabled', false); 
            $("#ket1").prop('disabled', false); 
            $("#harga1").val("Rp. "+res.harga.toLocaleString().replace(/[,]/g,'.'));
            $("#satuan1").val(res.satuan);
          }
        });
      }
    });
    $('#jumlah1').keyup(function() {
      var dInput = this.value;
      var valHarga = $("#harga1").val().replace("Rp. ", "");
      valHarga = valHarga.replace(".","");
      var valTotal = $("#total1").val("Rp. "+(valHarga * dInput).toLocaleString().replace(/[,]/g,'.'));

    });
    
    // // Add Rupiah
    // var harga1 = document.getElementById('harga1');
    // if (harga1) { harga1.addEventListener('keyup', function(e){ ongkos1.value = formatRupiah(this.value, 'Rp. '); }); }
    $("#formTambah").one('submit', function() {
        //stop submitting the form to see the disabled button effect
        $("#btn-simpan").attr('disabled','disabled');
        $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
        
        return true;
    });
    // $('#btn-submit').on('click',function(e){
    //   e.preventDefault();
    //   // var form = $(this).parents('form');
    //   swal({
    //       title: "Are you sure?",
    //       text: "You will not be able to recover this imaginary file!",
    //       type: "warning",
    //       showCancelButton: true,
    //       confirmButtonColor: "#DD6B55",
    //       confirmButtonText: "Yes, delete it!",
    //       // closeOnConfirm: false
    //   }, function(isConfirm){
    //       if (isConfirm) $("#formTambah").submit();
    //   });
    // });
  });
</script>
<script>
  function submitForm(form) {
    swal({
        title: "Apakah anda sudah yakin?",
        text: "Periksa sekali lagi untuk memastikan data sudah terisi dengan benar",
        // icon: "info",
        // buttons: true,
        // dangerMode: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        timer: 5000,
        // timerProgressBar: true,
        focusCancel: true,
        showCancelButton: true,
        confirmButtonColor: '#6777EF',
        confirmButtonText: `<i class="fa fa-save"></i> Ajukan`,
        cancelButtonText: `<i class="fa fa-times"></i> Batal`,
        // backdrop: `rgba(26,27,41,0.8)`,
    })
    .then(function (isOkay) {
        if (isOkay) {
            form.submit();
        }
    });
    return false;
  }
  function tambahBaris(val) {
    $('#tambah'+val).prop('disabled', true).addClass("disabled"); 
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
                  + "<td hidden><input type='text' name='satuan[]' id='satuan"+addVal+"' class='form-control'></td>"
                  + "<td><select name='barang[]' id='barang"+addVal+"' class='form-control select2 barang' required>"
                  + "<option hidden>Pilih</option></select></td>" 
                  + "<td><input type='text' id='jumlah"+addVal+"' name='jumlah[]' class='form-control' placeholder='' disabled required></td>" 
                  + "<td><input type='text' id='harga"+addVal+"' name='harga[]' class='form-control' placeholder='' readonly></td>" 
                  + "<td><input type='text' id='total"+addVal+"' name='total[]' class='form-control' placeholder='' readonly></td>" 
                  + "<td><input type='text' id='ket"+addVal+"' name='ket[]' class='form-control' placeholder='' disabled></td>" 
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
          
          $('#jumlah'+addVal).keyup(function() {
            var dInput = this.value;
            var valHarga = $("#harga"+addVal).val().replace("Rp. ", "");
            valHarga = valHarga.replace(".","");
            var valTotal = $("#total"+addVal).val("Rp. "+(valHarga * dInput).toLocaleString().replace(/[,]/g,'.'));
          });
          $("#barang"+addVal).on('change', function() {
            $('#jumlah'+addVal).val("")
            $('#total'+addVal).val("");
            if (this.value == 'Pilih') {
              $('#jumlah'+addVal).prop('disabled', true); 
              $('#ket'+addVal).prop('disabled', true); 
              $('#harga'+addVal).val("");
              $('#satuan'+addVal).val("");
              $('#total'+addVal).val("");
            } else {
              $.ajax({
                url: "./tambah/api/barang/detail/"+this.value,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                  $('#jumlah'+addVal).prop('disabled', false); 
                  $('#ket'+addVal).prop('disabled', false); 
                  $("#harga"+addVal).val("Rp. "+res.harga.toLocaleString().replace(/[,]/g,'.'));
                  $('#satuan'+addVal).val(res.satuan);
                }
              });
            }
          });
          $('#tambah'+val).prop('hidden', true); 
          $('#hapus'+val).prop('hidden', true);
          $('#tambah'+val).find("i").removeClass("fa-sync fa-spin").addClass("fa-plus-square");

          iziToast.success({
            title: 'Baris '+addVal,
            message: 'berhasil ditambahkan',
            position: 'topRight'
          });
        }
      }
    );
    // $("#tampil-tbody").empty();
  }

  function hapusBaris(val) {
    var minVal = val - 1;
    $('#tambah'+minVal).prop('disabled', false).removeClass("disabled"); 
    $('#data'+val).remove();
    if (minVal == 1) {
      $('#tambah'+minVal).prop('hidden', false);
    } else {
      $('#tambah'+minVal).prop('hidden', false);
      $('#hapus'+minVal).prop('hidden', false);
    }
    iziToast.error({
      title: 'Baris '+val,
      message: 'berhasil dihapus',
      position: 'topRight'
    });
  }
  
  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
</script>
@endsection
