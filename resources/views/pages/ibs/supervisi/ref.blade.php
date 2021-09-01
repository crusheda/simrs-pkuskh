@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

@role('ibs')
<div class="row">
    <div class="col-md-4">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-plus nav-icon text-success">

                </i> Tambah Supervisi
                
            </div>
            <div class="card-body">
                    <form class="form-auth-small" action="{{ route('ibs.refsupervisi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Supervisi :</label>
                            <input type="text" name="supervisi" class="form-control" placeholder="e.g. Pengecekan Alat/Mesin" autofocus required>
                        </div>
                        <div class="form-group">
                            <label>Ruang</label>
                            <select name="ruang" class="form-control" required>
                              <option hidden>Pilih</option>
                              <option value="Ruang Resusitasi Bayi">Ruang Resusitasi Bayi</option>
                              <option value="Ruang OK 1">Ruang OK 1</option>
                              <option value="Ruang OK 2">Ruang OK 2</option>
                              <option value="Ruang Cuci Tangan Bedah">Ruang Cuci Tangan Bedah</option>
                              <option value="Ruang Instrumen">Ruang Instrumen</option>
                              <option value="Ruang Cuci Alat">Ruang Cuci Alat</option>
                              <option value="Ruang BHP">Ruang BHP</option>
                              <option value="Ruang Recovery">Ruang Recovery</option>
                              <option value="Ruang Pre Operasi">Ruang Pre Operasi</option>
                              <option value="Ruang Counter Perawat">Ruang Counter Perawat</option>
                            </select>
                        </div>
                        <button class="btn btn-success text-white pull-right" id="submit"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                    </form>
                    <button class="btn btn-dark text-white pull-left" onclick="window.location.href='{{ route('ibs.supervisi.index') }}'"><i class="fa-fw fas fa-chevron-left nav-icon"></i> Kembali</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">

                <i class="fa-fw fas fa-sort-amount-desc nav-icon text-info">

                </i> Tabel Pengecekan Alat Dan Kelengkapan BHP

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses IBS
                </span>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Supervisi</th>
                                <th>Ruang</th>
                                <th>Tgl</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->supervisi }}</td>
                                    <td>{{ $item->ruang }}</td>
                                    <td>{{ $item->tgl }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endrole

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus?
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            @if(count($list) > 0)
                Keterangan : <b>{{ $item->ket }}</b><br>
                Nominal : <b>Rp. {{ $item->nominal }},-</b><br>
                Ditambahkan pada : <b>{{ $item->created_at }}</b>
            @endif
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('kepegawaian.struktural.destroy', $item->id) }}" method="POST">
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

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="edit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('kepegawaian.struktural.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label>Keterangan :</label>
            <input type="text" name="ket" value="{{ $item->ket }}" class="form-control" placeholder="e.g. Direktur Utama" autofocus required>
            <br>
            <label>Nominal :</label>
            <input type="number" name="nominal" value="{{ $item->nominal }}" class="form-control" required>
            <br>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary text-white btn-block" id="submit">Submit</button>
        </div>
        {{ Form::close() }}
        @endif
      </div>
    </div>
</div>
@endforeach

<script>
$(document).ready( function () {
    $('#table').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'colvis'
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 3, "desc" ]]
        }
    );
} );
</script>

@endsection