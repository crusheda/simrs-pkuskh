@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h4>Tabel Tindakan Harian Perawat</h4>
        </div>
        <div class="card-body">
            @can('log_perawat')
                <div class="row">
                    <div class="col-md-12">
                            @role('it|kabag-keperawatan')
                                <form class="form-inline" action="{{ route('tindakan-harian.cari') }}" method="GET">
                                    <span style="width: auto;margin-right:10px">Filter</span>
                                    {{-- <select onchange="submitBtn()" class="form-control" name="unit_cari" id="unit_cari" style="margin-right:10px">
                                        <option hidden>Unit</option>
                                        <option value="igd">IGD</option>
                                        <option value="icu">ICU</option>
                                        <option value="ibs">IBS</option>
                                        <option value="poli">POLIKLINIK</option>
                                        <option value="kebidanan">KEBIDANAN</option>
                                        <option value="bangsal-dewasa">BANGSAL DEWASA</option>
                                        <option value="bangsal-anak">BANGSAL ANAK</option>
                                    </select> --}}
                                    <select onchange="submitBtn()" class="form-control" name="shift_cari" id="shift_cari" style="margin-right:10px">
                                        <option hidden>Shift</option>
                                        <option value="pagi">PAGI</option>
                                        <option value="siang">SIANG</option>
                                        <option value="malam">MALAM</option>
                                    </select>
                                    <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan">
                                        <option hidden>Bulan</option>
                                        <?php
                                            $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                            $jml_bln=count($bulan);
                                            for($c=1 ; $c < $jml_bln ; $c+=1){
                                                echo"<option value=$c> $bulan[$c] </option>";
                                            }
                                        ?>
                                    </select>
                                    <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun">
                                        <option hidden>Tahun</option>
                                        @php
                                            for ($i=2020; $i <= $list['thn']; $i++) { 
                                                echo"<option value=$i> $i </option>";
                                            }
                                            
                                        @endphp
                                    </select>
                                    <button class="form-control btn btn-secondary text-white" id="submit_filter" disabled><i class="fa-fw fas fa-filter nav-icon text-white"></i> Submit</button>
                                </form>
                            @else
                                <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" @if (count($list['show']) > 0) @if (\Carbon\Carbon::parse($list['show'][0]->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['today']) @else echo disabled @endif @endif>
                                    <i class="fa-fw fas fa-plus-square nav-icon">
            
                                    </i>
                                    Tambah Tindakan <span class="badge badge-light">{{ $list['nowaday'] }}</span>
                                </button>
                                {{-- <button class="btn btn-primary text-white" disabled><i class="fa-fw fas fa-hourglass-half nav-icon"></i> Coming soon...</button> --}}
                            @endrole
                          <hr>
                          <div class="btn-group">
                            <button type="button" class="btn btn-info text-white" onclick="refreshTable()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
                            @role('it|kabag-keperawatan')
                              <button type="button" class="btn btn-warning text-white" onclick="window.location.href='{{ url('logperawat') }}'" data-toggle="tooltip" data-placement="right" title="TAMBAH INDIKATOR TINDAKAN HARIAN PERAWAT"><i class="fa-fw fas fa-plus-square nav-icon text-white"></i> Indikator</button>
                              <button class="btn btn-dark text-white pull-right" onclick="window.location.href='{{ route('tdkperawat.index') }}'"><i class="fa fa-history"></i> Data Tindakan Harian Lama</button>
                            @endrole
                          </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table datatables table-striped" id="tableku" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>SHIFT</th>
                                        <th>NAMA</th>
                                        <th>UNIT</th>
                                        <th>TGL</th>
                                        <th><center>#</center></th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">Maaf, anda tidak mempunyai <kbd>HAK AKSES</kbd> halaman ini.</p>
            @endcan
        </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Tindakan Harian
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-auth-small" name="formTambah" action="{{ route('tindakan-harian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>User :</label>
                                <h5>{{ Auth::user()->nama }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Shift :</label>
                            <select name="shift" class="form-control selectric" required>
                              <option hidden>Pilih</option>
                              <option value="pagi">PAGI</option>
                              <option value="siang">SIANG</option>
                              <option value="malam">MALAM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table id="tambah" class="table table-bordered display table-hover">
                    <thead>
                        <tr>
                            <th>PERNYATAAN</th>
                            <th style="width: 20%">PILIHAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list['pernyataan']))
                        @foreach($list['pernyataan'] as $item)
                        <tr>
                            <td hidden><input type="text" class="form-control" name="pernyataan[]" value="{{ $item->id }}"></td>
                            <td>{{ $item->pertanyaan }}</td>
                            <td>
                                <select class="form-control selectric" name="box[]" required>
                                    <option value="0"hidden>0 kali</option>
                                    @for ($i = 0; $i < $item->box; $i++)
                                        <option value="{{ $i+1 }}">{{ $i+1 }} kali</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
        
        </div>
        <div class="modal-footer">

                <a>Masukkan tindakan setelah selesai Jaga Shift</a>
                <button class="btn btn-success" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="detail" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Detail Tindakan Harian <kbd style="background-color: rgb(0, 166, 255)">ID : <a id="show_id"></a></kbd>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            {{ Form::model($item, array('route' => array('tindakan-harian.update', $item->queue), 'method' => 'PUT')) }}
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label><kbd>User</kbd></label>
                            <h5 id="nama_edit"></h5>
                            <sub style="margin-top:-30px">Diupdate pada : <a id="updated_edit"></a> </sub>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Shift :</label>
                            <select name="shift" id="shift_edit" class="form-control" required>
                              {{-- <option value="pagi"  @if($item->shift == 'pagi') echo selected @endif>PAGI</option>
                              <option value="siang" @if($item->shift == 'siang') echo selected @endif>SIANG</option>
                              <option value="malam" @if($item->shift == 'malam') echo selected @endif>MALAM</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
                <hr style="margin-top:-5px">
                <table id="tambah" class="table table-bordered display table-hover">
                    <thead>
                        <tr>
                            <th>PERNYATAAN</th>
                            <th style="width: 20%">PILIHAN</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tr"><tr id="tr-proses"><td colspan="2"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                </table>
        </div>
        <div class="modal-footer">
            
                {{-- <a>@if($item->updated_at != null) {{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('dddd, D MMMM Y') }} @endif</a> --}}
                @if (\Carbon\Carbon::parse($item->tgl)->isoFormat('YYYY/MM/DD') ==  $list['today'])
                    <button class="btn btn-success" id="btn-simpan" onclick="saveData()"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
                @else
                    <button class="btn btn-secondary text-white" disabled><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
                @endif
                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade" id="hapus{{ $item->queue }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <a class="pull-left"><kbd>ID : {{ $item->queue }}</kbd>&nbsp;</a>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus Tindakan Harian {{ $item->nama }}</b>?</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('tindakan-harian.destroy', $item->queue) }}" method="POST">
                @method('DELETE')
                @csrf
                <a>Ditambahkan <b>{{ \Carbon\Carbon::parse($item->tgl)->diffForHumans() }}</b></a>
                <button class="btn btn-danger"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    
    $.ajax(
      {
        url: "./tindakan-harian/table",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          $("#tampil-tbody").empty();
          if(res.show.length == 0){
          } else {
            res.show.forEach(item => {

                content = "<tr id='data"+ item.queue +"'><td>" + item.queue + "</td><td>" 
                + item.shift + "</td><td>" 
                + item.nama + "</td><td>"
                + $.each(JSON.parse(item.unit), function( index, value ) { value }) + "</td><td>"
                + item.tgl + "</td>"
                // + item.unit.forEach(val => { item.val })
                + "<td><center><div class='btn-group' role='group'>"
                + "<button type='button' class='btn btn-warning btn-sm' onclick='editData("+item.queue+")'><i class='fa-fw fas fa-search nav-icon text-white'></i></button>"
                + "@role('it|kabag-keperawatan')"
                + "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#hapus"+item.queue+"'><i class='fa-fw fas fa-trash nav-icon text-white'></i></button>"
                + "@endrole"
                + "</div></center></td></tr>";
                $('#tampil-tbody').append(content);

                // html = "";
                // html += "<tr id='data"+ item.queue +"'><td>" + item.queue + "</td><td>" ;
                // $.each(item.unit, function( index, value ) {
                //     html += value;
                // });
                // html += '</td></tr>';
                // $('#tampil-tbody').empty('').append(html);
            });
          }
          $('#tableku').DataTable(
            {
              paging: true,
              searching: true,
              dom: 'Bfrtip',
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
              'columnDefs': [
                //   { targets: 0, visible: false },
                //   { targets: 4, visible: false },
                //   { targets: 6, visible: false },
                //   { targets: 9, visible: false },
              ],
              order: [[ 4, "desc" ]],
              pageLength: 10
            }
          );
        }
      }
    );
    $('#table').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
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
            order: [[ 4, "desc" ]]
        }
    );
    // $("#tambah").one('submit', function() {
    //     //stop submitting the form to see the disabled button effect
    //     let x = document.forms["formTambah"]["shift"].value;
    //     if (x == "Pilih") {

    //         Swal.fire({
    //             position: 'top',
    //             title: 'Perhatian',
    //             text: 'Periksa sekali lagi data yang anda masukkan. Jangan lupa untuk memilih Shift Jaga.',
    //             icon: 'warning',
    //             showConfirmButton:false,
    //             showCancelButton:false,
    //             timer: 5000,
    //             timerProgressBar: true,
    //             backdrop: `rgba(26,27,41,0.8)`,
    //         });

    //         return false;
    //     } else {
    //         $("#btn-simpan").attr('disabled','disabled');
    //         $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

    //         return true;
    //     }
    // });
} );
</script>
<script>
    
  function refreshTable() {
        $("#tampil-tbody").empty().append(`<tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
        {
            url: "./tindakan-harian/table",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
            $("#tampil-tbody").empty();
            $('#tableku').DataTable().clear().destroy();
            if(res.show.length == 0){
            } else {
                res.show.forEach(item => {

                    content = "<tr id='data"+ item.queue +"'><td>" + item.queue + "</td><td>" 
                    + item.shift + "</td><td>" 
                    + item.nama + "</td><td>"
                    + $.each(JSON.parse(item.unit), function( index, value ) { value }) + "</td><td>"
                    + item.tgl + "</td>"
                    // + item.unit.forEach(val => { item.val })
                    + "<td><center><div class='btn-group' role='group'>"
                    + "<button type='button' class='btn btn-warning btn-sm' onclick='editData("+item.queue+")'><i class='fa-fw fas fa-search nav-icon text-white'></i></button>"
                    + "@role('it|kabag-keperawatan')"
                    + "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#hapus"+item.queue+"'><i class='fa-fw fas fa-trash nav-icon text-white'></i></button>"
                    + "@else"
                    + "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#hapus"+item.queue+"'><i class='fa-fw fas fa-trash nav-icon text-white'></i></button>"
                    + "@endrole"
                    + "</div></center></td></tr>";
                    $('#tampil-tbody').append(content);
                });
            }
            $('#tableku').DataTable(
                {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
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
                'columnDefs': [
                    //   { targets: 0, visible: false },
                    //   { targets: 4, visible: false },
                    //   { targets: 6, visible: false },
                    //   { targets: 9, visible: false },
                ],
                order: [[ 4, "desc" ]],
                pageLength: 10
                }
            );
            }
        }
        );
    }
    function submitBtn() {
        // var unit = $("#unit_cari").val();
        var shift = $("#shift_cari").val();
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();

        if ( shift != 'Shift' || bulan != 'Bulan' || tahun != 'Tahun' ) {
            $('#submit_filter').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
        }
    }
    function saveData() {
        $("#tambah").one('submit', function() {
            //stop submitting the form to see the disabled button effect
            let x = document.forms["formTambah"]["shift"].value;
            if (x == "Pilih") {

                Swal.fire({
                    position: 'top',
                    title: 'Perhatian',
                    text: 'Anda belum memasukkan Shift Jaga',
                    icon: 'warning',
                    showConfirmButton:false,
                    showCancelButton:true,
                    cancelButtonText: `<i class="fa fa-times"></i> Tutup`,
                    timer: 3000,
                    timerProgressBar: true,
                    backdrop: `rgba(26,27,41,0.8)`,
                });

                return false;
            } else {
                $("#btn-simpan").attr('disabled','disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");

                return true;
            }
        });
    }

    function editData(queue) {
        $('#detail').modal('show');
        $.ajax(
            {
                url: "./tindakan-harian/api/"+queue+"/edit",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#show_id").val(res.show[0].queue);
                    $("#nama_edit").val(res.show[0].nama);
                    $("#updated_edit").val(res.show[0].updated_at);
                    Object.entries(res.show).forEach(([key, item]) => {
                        $("#tampil-tr").append(`
                            <tr id="data${item.id}">
                                <td hidden><input type="text" class="form-control" name="pernyataan[]" value="${item.id_pernyataan}"></td>
                                <td>${item.pernyataan}</td>
                                <td id="select_ajax${item.id}"></td>
                            </tr>
                        `);
                        var html="";
                        html += '<select class="custom-select" name="box[]" required>';
                        for(var count=0; count <= item.jawaban; count++){
                            html += '<option value="'+count+'"';
                            if(item.jawaban == count){
                                html += 'selected';    
                            }
                            html += '>'+count+' Kali</option>';
                        }
                        html += '</select>';      
                        
                        $("#select_ajax"+item.id).append(html); 
                    });
                    // $('#table').DataTable().columns.adjust();
                }
            }
        );
    }
</script>
@endsection