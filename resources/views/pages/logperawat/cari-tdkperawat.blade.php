@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-file-text nav-icon">

                </i>Detail Tindakan Perawat Harian ( {{ $list['time'] }} )

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>

            </div>
            <div class="card-body">
                @can('log_perawat')
                <form class="form-inline" action="{{ route('tdkperawat.cari') }}" method="GET">
                    <span style="width: auto;margin-right:10px">Filter</span>
                    <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="bulan" id="bulan" required>
                        <option hidden>Bulan</option>
                        <?php
                            $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                            $jml_bln=count($bulan);
                            for($c=1 ; $c < $jml_bln ; $c+=1){
                                echo"<option value=$c> $bulan[$c] </option>";
                            }
                        ?>
                    </select>
                    <select onchange="submitBtn()" class="form-control" style="width: auto;margin-right:10px" name="tahun" id="tahun" required>
                        <option hidden selected>Tahun</option>
                        @php
                            for ($i=2019; $i <= $list['getthn']; $i++) { 
                                echo"<option value=$i> $i </option>";
                            }
                            
                        @endphp
                    </select>
                    <button class="form-control" id="submit" disabled><span class="badge">Cari</span></button>
                </form><hr>
                <div class="table-responsive">
                    <table id="detailtdk" class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>UNIT</th>
                            <th>PERNYATAAN</th>
                            <th>JUMLAH TINDAKAN</th>
                            <th>TGL</th>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->queue }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->pertanyaan }}</td>
                                <td>{{ $item->jawaban }} Kali</td>
                                <td>{{ $item->tgl }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>UNIT</th>
                            <th>PERNYATAAN</th>
                            <th>JUMLAH TINDAKAN</th>
                            <th>TGL</th>
                        </tfoot>
                    </table>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#detailtdk').DataTable(
            {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print']
            }
        );
    } );
</script>
<script>
    function submitBtn() {
        var bulan = document.getElementById("bulan").value;
        var tahun = document.getElementById("tahun").value;
        if (bulan != "Bln" && tahun != "Thn" ) {
            document.getElementById("submit").disabled = false;
        }
    }
</script>

@endsection