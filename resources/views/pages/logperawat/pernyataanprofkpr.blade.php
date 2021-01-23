@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-address-book nav-icon text-info">

            </i> Tabel Pernyataan

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Kabag Keperawatan
            </span>
            
        </div>
        @hasrole('kabag-keperawatan')
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <center><h4>Tambah Profesi Keperawatan Perawat</h4></center><br>
                    <form class="form-auth-small" action="{{ route('logprofkpr.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <select class="custom-select" name="unit" id="unit" required>
                            <option selected hidden>Pilih Unit</option>
                            <option value="bangsal-dewasa">Bangsal Dewasa</option>
                            <option value="bangsal-anak">Bangsal Anak</option>
                            <option value="ibs">IBS</option>
                            <option value="icu">ICU</option>
                            <option value="igd">IGD</option>
                            <option value="poli">Poliklinik</option>
                            <option value="kebidanan">Kebidanan</option>
                        </select>
                        <p></p>
                        <label>Pernyataan :</label>
                        <textarea class="form-control" name="pernyataan" id="pernyataan" placeholder="" required></textarea>
                        <br>
                        <center><button class="btn btn-primary text-white" id="submit">Tambah</button></center>
                        <br>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table id="logprofkpr" class="table table-striped display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PERNYATAAN</th>
                                    <th>UNIT</th>
                                    <th>TGL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->pernyataan }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
                </div>
            </div>
        </div>
        @else
        <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
        @endhasrole
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapusLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
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
                @if(count($list) > 0)
                Unit : {{ $item->unit }} <br>
                Pernyataan : <b>{{ $item->pernyataan }}</b> <br>
                Ditambahkan pada {{ $item->created_at }} <br>
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('logprofkpr.destroy', $item->id) }}" method="POST">
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
<div class="modal fade bd-example-modal-lg" id="editLog{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('logprofkpr.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <label>Unit :</label>
            <select class="custom-select" name="unit" id="unit" required>
                <option selected hidden>Pilih Unit</option>
                <option value="bangsal-dewasa"  <?php if($item->unit == 'bangsal-dewasa') { echo "selected";} ?>    >Bangsal Dewasa</option>
                <option value="bangsal-anak"    <?php if($item->unit == 'bangsal-anak') { echo "selected";} ?>      >Bangsal Anak</option>
                <option value="ibs"             <?php if($item->unit == 'ibs') { echo "selected";} ?>               >IBS</option>
                <option value="icu"             <?php if($item->unit == 'icu') { echo "selected";} ?>               >ICU</option>
                <option value="igd"             <?php if($item->unit == 'igd') { echo "selected";} ?>               >IGD</option>
                <option value="poli"            <?php if($item->unit == 'poli') { echo "selected";} ?>              >Poliklinik</option>
                <option value="kebidanan"       <?php if($item->unit == 'kebidanan') { echo "selected";} ?>         >Kebidanan</option>
            </select>
            <br>
            <label for="keterangan">Pernyataan :</label>
            <textarea class="form-control" name="pernyataan" id="pernyataan" placeholder="" required><?php echo htmlspecialchars($item->pernyataan); ?></textarea>
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
    $('#logprofkpr').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            order: [[ 3, "desc" ]]
        }
    );
} );
</script>

@endsection