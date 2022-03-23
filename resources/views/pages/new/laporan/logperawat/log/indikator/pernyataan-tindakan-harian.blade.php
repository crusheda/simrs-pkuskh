@extends('layouts.newAdmin')

@section('content')
@hasrole('kabag-keperawatan')
<div class="row mt-sm-4">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-light" onclick="window.location.href='{{ route('tindakan-harian.index') }}'" style="margin-right: 7px"><i class="fa-fw fas fa-angle-left nav-icon"></i> Kembali</button>
                <h4>Form Tambah</h4>
            </div>
            <div class="card-body">
                <form class="form-auth-small" action="{{ route('logperawat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <select class="form-control selectric" name="unit" id="unit" required>
                            <option selected hidden>Pilih Unit</option>
                            <option value="bangsal-dewasa">Bangsal Dewasa</option>
                            <option value="bangsal-anak">Bangsal Anak</option>
                            <option value="ibs">IBS</option>
                            <option value="icu">ICU</option>
                            <option value="igd">IGD</option>
                            <option value="poli">Poliklinik</option>
                            <option value="kebidanan">Kebidanan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pernyataan :</label>
                        <textarea class="form-control" name="pertanyaan" id="pertanyaan" placeholder="" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Pilihan Jawaban :</label>
                        <input type="number" min="1" max="5" class="form-control" name="box" id="box" value="1" required>
                    </div>
                    <center><button class="btn btn-primary text-white" id="submit"><i class="fa-fw fas fa-plus-square nav-icon text-white"></i> Tambah</button></center>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Indikator</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="logperawat" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PERNYATAAN</th>
                                <th>UNIT</th>
                                <th>JAWABAN</th>
                                <th>TGL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($list['show']) > 0)
                            @foreach($list['show'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->pertanyaan }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->box }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editLog{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusLog{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                    </div>
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
            </div>
        </div>
    </div>
</div>
@endhasrole

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
                Pernyataan : <b>{{ $item->pertanyaan }}</b> <br>
                Ditambahkan pada {{ $item->created_at }} <br>
                @endif
            </p>
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('logperawat.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>Hapus</button>
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
        {{ Form::model($item, array('route' => array('logperawat.update', $item->id), 'method' => 'PUT')) }}
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
            <textarea class="form-control" name="pertanyaan" id="pertanyaan" placeholder="" required><?php echo htmlspecialchars($item->pertanyaan); ?></textarea>
            <br>
            <label>Pilihan Jawaban :</label>
            <input type="number" class="form-control" value="{{ $item->box }}" min="0" max="5" name="box" id="box" required>
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
    $('#logperawat').DataTable(
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
} );
</script>
@endsection