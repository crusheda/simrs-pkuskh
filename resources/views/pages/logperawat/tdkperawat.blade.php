@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-file-text nav-icon">

                </i> Tabel Tindakan Harian Perawat

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                
            </div>
            <div class="card-body">
                @can('log_perawat')
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            @can('kabag-keperawatan')
                            <a type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#tambahtdk">
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah Tindakan Harian
                            </a>
                            @endcan
                            @can('log_perawat')
                                <?php
                                    if ($list['recent'] == '1') {
                                        ?>  <a type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#info">
                                                <i class="fa-fw fas fa-plus-square nav-icon">
                        
                                                </i>
                                                Tambah Tindakan Harian
                                            </a>
                                        <?php
                                    } elseif ($list['recent'] == '0') {
                                        ?>  <a type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#tambahtdk">
                                                <i class="fa-fw fas fa-plus-square nav-icon">
                        
                                                </i>
                                                Tambah Tindakan Harian
                                            </a>
                                        <?php
                                    }
                                ?>
                            @endcan
                        </div><br><br>
                        <div class="col-md-4">
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
                                        for ($i=2019; $i <= $list['thn']; $i++) { 
                                            echo"<option value=$i> $i </option>";
                                        }
                                        
                                    @endphp
                                </select>
                                <button class="form-control" id="submit" disabled><span class="badge">Cari</span></button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="tdkperawat" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAMA</th>
                                    <th>UNIT</th>
                                    <th>TGL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize">
                                @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->queue }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->tgl }}</td>
                                    <td>
                                        <a type="button" class="btn btn-info btn-sm" href="{{ route('tdkperawat.show', $item->queue) }}"><i class="fa-fw fas fa-search nav-icon"></i></a>
                                        <a type="button" class="btn btn-success btn-sm" href="{{ route('tdkperawat.edit', $item->queue) }}"><i class="fa-fw fas fa-edit nav-icon"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->queue }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan=5>Tidak Ada Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
                @endcan
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="tambahtdk" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Tindakan Harian Perawat
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form class="form-auth-small" action="{{ route('tdkperawat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table id="tdkperawat" class="table table-striped display">
                <thead>
                    <tr>
                        <th>PERNYATAAN</th>
                        <th>PILIHAN</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($list['tdk']) > 0)
                    @foreach($list['tdk'] as $item)
                    <tr>
                        <td><input type="text" class="form-control" style="text-transform: capitalize" name="pertanyaan[]" placeholder="" value="{{ $item->pertanyaan }}" readonly></td>
                        {{-- <td><input type="text" class="form-control" name="jawaban[]" placeholder=""></td> --}}
                        
                        <td>
                            <select class="custom-select" name="box[]" id="boxy" required>
                                <option value="0" hidden>Pilih..</option>
                                <option value="0">0 kali</option>
                                @for ($i = 0; $i < $item->box; $i++)
                                    <option value="{{ $i+1 }}">{{ $i+1 }} kali</option>
                                @endfor
                            </select>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan=4>Tidak Ada Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <center><button class="btn btn-success btn-sm"><i class="lnr lnr-trash"></i>Submit</button></center><br>
        </form>
      </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->queue }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus? 
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            @if(count($list['show']) > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>UNIT</th>
                            <th>TGL</th>
                        </thead>
                        <tbody>
                                <td>{{ $item->queue }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->tgl }}</td>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('tdkperawat.destroy', $item->queue) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach

<!-- Info Modal -->
<div class="modal fade" id="info" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Warning..!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Maaf, Anda sudah menambahkan Tindakan Harian Hari Ini.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
$(document).ready( function () {
    $('#tdkperawat').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
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