@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-light" onclick="window.location.href='{{ route('tindakan-harian.index') }}'" style="margin-right: 7px"><i class="fa-fw fas fa-angle-left nav-icon"></i> Kembali</button>
            <h4>Tindakan Harian Perawat Lama</h4>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-hover display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                {{-- <th>SHIFT</th> --}}
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>TGL</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->queue }}</td>
                                {{-- <td>{{ $item->shift }}</td> --}}
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->unit }}</td>
                                {{-- <td>
                                    @foreach (json_decode($item->unit) as $key => $value)
                                        <kbd>{{ $value }}</kbd>
                                    @endforeach
                                </td> --}}
                                <td>{{ $item->tgl }}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning btn-sm" onclick="editData({{ $item->queue }})"><i class="fa-fw fas fa-search nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-secondary btn-sm disabled"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="detail{{ $item->queue }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Detail Tindakan Harian <kbd style="background-color: rgb(0, 166, 255)">ID : {{ $item->queue }}</kbd>
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
                            <h5>{{ $item->name }}</h5>
                            {{-- @if($item->updated_at != null) <sub style="margin-top:-30px">Diupdate pada : {{ $item->updated_at }} </sub> @endif --}}
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label>Shift :</label>
                            <select name="shift" id="shift" class="form-control" required>
                              <option value="pagi"  @if($item->shift == 'pagi') echo selected @endif>PAGI</option>
                              <option value="siang" @if($item->shift == 'siang') echo selected @endif>SIANG</option>
                              <option value="malam" @if($item->shift == 'malam') echo selected @endif>MALAM</option>
                            </select>
                        </div>
                    </div> --}}
                </div>
                <table id="tambah" class="table table-bordered display table-hover">
                    <thead>
                        <tr>
                            <th>PERNYATAAN</th>
                            <th style="width: 20%">PILIHAN</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tr{{ $item->queue }}"><tr id="tr-proses"><td colspan="2"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
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
@endforeach

{{-- @foreach($list['show_all'] as $item)
<div class="modal fade" id="hapus{{ $item->queue }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <a class="pull-left"><kbd>ID : {{ $item->id }}</kbd>&nbsp;</a>
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
@endforeach --}}

<script>
$(document).ready( function () {
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
            order: [[ 3, "desc" ]]
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
                $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

                return true;
            }
        });
    }

    function editData(queue) {
        $('#detail'+queue).modal('show');
        $.ajax(
            {
                url: "./tindakan-harian/api/"+queue+"/edit",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tr"+queue).empty();
                    Object.entries(res).forEach(([key, item]) => {
                        $("#tampil-tr"+queue).append(`
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
                        console.log(key);
                    });
                    // $('#table').DataTable().columns.adjust();
                }
            }
        );
    }
</script>
@endsection