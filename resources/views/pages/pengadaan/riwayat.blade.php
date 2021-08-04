@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-shopping-basket nav-icon">

                </i>
                Pengadaan Barang Rutin dan Non Rutin

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Pengadaan
                </span>
            </div>
            <div class="card-body">
                @can('pengadaan')
                <center>
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#tambahData">
                        <i class="fa-fw fas fa-plus-square nav-icon">

                        </i>
                        Tambah Pengadaan
                    </button>
                </center><hr>
                <div class="table-responsive">
                    <table id="pengadaan" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>UNIT</th>
                                <th>PEMOHON</th>
                                <th>JENIS</th>
                                <th>TANGGAL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->pemohon }}</td>
                                <td>{{ $item->jnspengadaan }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a type="button" class="btn btn-info btn-sm" href="{{ route('all.show', $item->id) }}"><i class="fa-fw fas fa-search nav-icon"></i></a>
                                    <a type="button" class="btn btn-success btn-sm" href="{{ route('all.edit', $item->id) }}"><i class="fa-fw fas fa-edit nav-icon"></i></a>
                                    <a type="button" href="{{ route('pengadaan.cetak', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-fw fas fa-print nav-icon"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData{{ $item->id }}">
                                        <i class="fa-fw fas fa-trash nav-icon"></i>
                                    </button>
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
                <div class="col text-center">
                    Mohon maaf, Anda tidak mempunyai ijin akses halaman ini. Hubungi Admin IT untuk mendapatkan akses.
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusData{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus? 
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <p>
                @if(count($list['show']) > 0)
                    <div class="table-responsive">
                        <table id="detail-rutin" class="table table-striped">
                            <thead>
                                <th>UNIT</th>
                                <th>PEMOHON</th>
                                <th>TANGGAL</th>
                            </thead>
                            <tbody>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->pemohon }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tbody>
                        </table>
                    </div>
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('rutin.destroy', $item->id) }}" method="POST">
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

<div class="modal fade bd-example-modal-lg" id="tambahData" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Tambah Pengadaan
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <center><a type="button" href="{{ route("rutin.create") }}" style="width: 150px" class="btn btn-info btn-lg text-white">Rutin</a>
            <a type="button" href="{{ route("nonrutin.create") }}" style="width: 150px" class="btn btn-success btn-lg">Non Rutin</a></center>
        </div>
      </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#pengadaan').DataTable(
            {
                order: [[ 3, "desc" ]]
            }
        );
    } );
</script>

@endsection