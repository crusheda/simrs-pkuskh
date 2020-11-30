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

                <a class="btn btn-success rounded-pill btn-sm" href="{{ route("tdkperawat.index") }}">Kembali</a>
                <i class="fa-fw fas fa-file-text nav-icon" style="margin-left:10px">

                </i> Detail Tindakan Perawat Harian ( {{ $list['first']->tgl }} )

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                

            </div>
            <div class="card-body">
                @can('log_perawat')
                <p>Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->unit }}</p>
                <p>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->name }}</p>
                <p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->tgl }}</p><hr>
                <div class="row">
                    <div class="col-md-6">
                    <a type="button" href="{{ route('tdkperawat.edit', $list['first']->queue) }}" class="btn btn-success btn-lg btn-block text-white">
                            <i class="fa-fw fas fa-edit nav-icon">

                            </i>
                            Ubah Data
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a type="button" href="{{ route('tdkperawat.cetak', $list['first']->queue) }}" class="btn btn-primary btn-lg btn-block text-white disabled">
                            <i class="fa-fw fas fa-print nav-icon">

                            </i>
                            Cetak
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#hapusData{{ $list['first']->queue }}">
                            <i class="fa-fw fas fa-trash nav-icon">

                            </i>
                            Hapus
                        </button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="detailpgd" class="table table-striped">
                        <thead>
                            <th>PERNYATAAN</th>
                            <th>JUMLAH TINDAKAN</th>
                        </thead>
                        <tbody>
                            @foreach($list['show'] as $item)
                            <tr>
                                <td style="text-transform: capitalize">{{ $item->pertanyaan }}</td>
                                <td>{{ $item->jawaban }} Kali</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>PERNYATAAN</th>
                            <th>JUMLAH TINDAKAN</th>
                        </tfoot>
                    </table>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="hapusData{{ $list['first']->queue }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus? 
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->unit }}</p>
            <p>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->name }}</p>
            <p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->tgl }}</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('tdkperawat.destroy', $list['first']->queue) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-sm"><i class="lnr lnr-trash"></i>Hapus</button>
            </form>
        </div>
      </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#detailpgd').DataTable();
    } );
</script>

@endsection