@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">

            <button type="button" class="btn btn-sm btn-light" onclick="window.location.href='{{ route('tindakan-harian.index') }}'" style="margin-right: 7px"><i class="fa-fw fas fa-angle-left nav-icon"></i> Kembali</button>
            <h4>Filter Tindakan Harian Perawat</h4>
        </div>
        <div class="card-body">
            @role('it|kabag-keperawatan')
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-inline" action="{{ route('tindakan-harian.cari') }}" method="GET">
                            <span style="width: auto;margin-right:10px">Filter</span>
                            <select onchange="submitBtn()" class="form-control" name="shift_cari" id="shift_cari" style="margin-right:10px">
                                <option hidden          @if ($list['shift'] == '') echo selected @endif>Shift</option>
                                <option value="pagi"    @if ($list['shift'] == 'pagi') echo selected @endif>PAGI</option>
                                <option value="siang"   @if ($list['shift'] == 'siang') echo selected @endif>SIANG</option>
                                <option value="malam"   @if ($list['shift'] == 'malam') echo selected @endif>MALAM</option>
                            </select>
                            <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan">
                                <option hidden>Bulan</option>
                                <?php
                                    $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                    $jml_bln=count($bulan);
                                    for($c=1 ; $c < $jml_bln ; $c+=1){
                                        if($list['bulan'] == $c) {
                                            echo"<option value=$c selected> $bulan[$c] </option>";
                                        } else {
                                            echo"<option value=$c> $bulan[$c] </option>";
                                        }
                                    }
                                ?>
                            </select>
                            <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun">
                                <option hidden>Tahun</option>
                                @php
                                    for ($i=2020; $i <= $list['thn']; $i++) { 
                                        if($list['tahun'] == $i) {
                                            echo"<option value=$i selected> $i </option>";
                                        } else {
                                            echo"<option value=$i> $i </option>";
                                        }
                                    }
                                    
                                @endphp
                            </select>
                            <button class="form-control btn btn-secondary text-white" id="submit_filter" disabled><i class="fa-fw fas fa-filter nav-icon text-white"></i> Submit</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-hover display">
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>UNIT</th>
                                        <th>PERNYATAAN</th>
                                        <th>TOTAL JAWABAN</th>
                                        {{-- <th><center>#</center></th> --}}
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['show']) > 0)
                                    @foreach($list['show'] as $item)
                                        {{-- @foreach($val as $item) --}}
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                @foreach (json_decode($item->unit) as $key => $value)
                                                    <kbd>{{ $value }}</kbd>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->pertanyaan }}</td>
                                            <td>{{ $item->total_jawaban }}</td>
                                        </tr>
                                        {{-- <td>
                                            <center>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-warning btn-sm" onclick="editData({{ $item->queue }})"><i class="fa-fw fas fa-search nav-icon text-white"></i></button>
                                                </div>
                                            </center>
                                        </td> --}}
                                        {{-- @endforeach --}}
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">Maaf, anda tidak mempunyai <kbd>HAK AKSES</kbd> halaman ini.</p>
            @endrole
        </div>
    </div>
  </div>
</div>

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
            order: [[ 1, "asc" ]]
        }
    );
} );
function submitBtn() {
    // var unit = $("#unit_cari").val();
    var shift = $("#shift_cari").val();
    var bulan = $("#bulan").val();
    var tahun = $("#tahun").val();

    if ( shift != 'Shift' || bulan != 'Bulan' || tahun != 'Tahun' ) {
        $('#submit_filter').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
    }
}
</script>
@endsection