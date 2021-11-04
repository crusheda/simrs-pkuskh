@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-file-text nav-icon">

            </i> Tindakan Harian Perawat <span class="badge badge-light">Baru</span>

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Pribadi
            </span>
            
        </div>
        <div class="card-body">
            @can('log_perawat')
                <div class="row">
                    <div class="col-md-12">
                        @role('it|kabag-keperawatan')
                            <form class="form-inline" action="{{ route('tdkperawat.cari') }}" method="GET">
                                <span style="width: auto;margin-right:10px">Filter</span>
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
                                <button class="form-control btn btn-warning text-white" id="submit" disabled>Filter</button>
                            </form>
                        @else
                            {{-- <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah" @if (count($list['show']) > 0) @if (\Carbon\Carbon::parse($list['show'][0]->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['today']) @else echo disabled @endif @endif>
                                <i class="fa-fw fas fa-plus-square nav-icon">
        
                                </i>
                                Tambah Tindakan
                            </button> --}}
                            <button class="btn btn-primary text-white" disabled><i class="fa-fw fas fa-hourglass-half nav-icon"></i> Coming soon...</button>
                        @endrole
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-hover display">
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
                                <tbody style="text-transform: capitalize">
                                    @if(count($list['show']) > 0)
                                    @foreach($list['show'] as $item)
                                    <tr>
                                        <td>{{ $item->queue }}</td>
                                        <td>{{ $item->shift }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            @foreach (json_decode($item->unit) as $key => $value)
                                                <kbd>{{ $value }}</kbd>
                                            @endforeach
                                        </td>
                                        <td>{{ $item->tgl }}</td>
                                        <td>
                                            <center>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail{{ $item->id }}"><i class="fa-fw fas fa-search nav-icon text-white"></i></button>
                                                    @role('it|kabag-keperawatan')
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}" @if (\Carbon\Carbon::parse($item->updated_at)->isoFormat('YYYY/MM/DD') ==  $list['today']) echo disabled @endif><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                    @endrole
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
            @else
                <p class="text-center">Maaf, anda tidak mempunyai <kbd>HAK AKSES</kbd> halaman ini.</p>
            @endcan
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                            <select name="shift" class="form-control" required>
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
                                <select class="custom-select" name="box[]" required>
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
                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal"><i class="fa-fw fas fa-close nav-icon"></i> Tutup</button>
            </form>
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
                'excel', 'pdf','colvis'
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
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
    function submitBtn() {
        var bulan = document.getElementById("bulan").value;
        var tahun = document.getElementById("tahun").value;
        if (bulan != "Bln" && tahun != "Thn" ) {
            document.getElementById("submit").disabled = false;
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
                    cancelButtonText: `<i class="fa fa-close"></i> Batal`,
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
</script>

@endsection