@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <a class="btn btn-success btn-sm" href="{{ route("tdkperawat.index") }}">
                <i class="fa-fw fas fa-file-text nav-icon">

                </i> Kembali
            </a>
            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Perawat
            </span>
            

        </div>
        <div class="card-body">
            @can('log_perawat')
            <p>Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->unit }}</p>
            <p>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->name }}</p>
            <p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->tgl }}</p>
            @if ($list['recent'] == 1)
                <span class="badge badge-primary">Batas waktu pengubahan tindakan hanya sampai hari ini.</span>
            @else
                <span class="badge badge-danger">Anda sudah melewati batas waktu pengubahan yang sudah ditentukan.</span>
            @endif
            <hr>
            
            @role('kabag-keperawatan')
            <hr>
            <center><a type="button" href="{{ route('tdkperawat.cetak', $list['first']->queue) }}" class="btn btn-primary btn-sm text-white disabled">
                <i class="fa-fw fas fa-print nav-icon">

                </i>
                Cetak
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusData{{ $list['first']->queue }}">
                <i class="fa-fw fas fa-trash nav-icon">

                </i>
                Hapus
            </button></center>
            <hr>
            @endrole

            <div class="table-responsive">
                <table id="detailpgd" class="table table-striped">
                    <thead>
                        <th>PERNYATAAN</th>
                        <th>JUMLAH TINDAKAN</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($list['show'] as $item)
                        <tr>
                            <td style="text-transform: capitalize">{{ $item->pertanyaan }}</td>
                            <td>{{ $item->jawaban }} Kali</td>
                            @if ($list['recent'] == 1)
                                <td><center><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ubahtdk{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button></center></td>
                            @else
                            <td><center><button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button></center></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>PERNYATAAN</th>
                        <th>JUMLAH TINDAKAN</th>
                        <th></th>
                    </tfoot>
                </table>
            </div>
            @endcan
        </div>
    </div>
</div>

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="ubahtdk{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <i class="fa-fw fas fa-file-text nav-icon">

            </i> Ubah Tindakan Perawat Harian ( id : {{ $list['first']->queue }} )
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @can('log_perawat')
            {{ Form::model($item, array('route' => array('tdkperawat.update', $item->id), 'method' => 'PUT')) }}
            <div class="modal-body">
                @csrf
                <label>Unit :</label>
                <input type="text" value="{{ $list['first']->unit }}" class="form-control" placeholder="" style="text-transform: capitalize" disabled> <br>
                <label>Nama :</label>
                <input type="text" value="{{ $list['first']->name }}" class="form-control" placeholder="" style="text-transform: capitalize" disabled> <br>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>NAMA</th>
                    <th>UNIT</th>
                    <th>PERNYATAAN</th>
                    <th>JUMLAH TINDAKAN</th>
                    <th>TGL</th>
                </thead>
                <tbody style="text-transform: capitalize">
                    @if(count($list['show']) > 0)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->pertanyaan }}</td>
                            <td>
                                <select class="custom-select" name="jawaban" id="boxy" required>
                                    <option value="0" hidden>Pilih..</option>
                                        <option value="0" <?php if($item->jawaban == '0') { echo "selected"; }?>>0</option>
                                        <option value="1" <?php if($item->jawaban == '1') { echo "selected"; }?>>1</option>
                                        <option value="2" <?php if($item->jawaban == '2') { echo "selected"; }?>>2</option>
                                        <option value="3" <?php if($item->jawaban == '3') { echo "selected"; }?>>3</option>
                                        <option value="4" <?php if($item->jawaban == '4') { echo "selected"; }?>>4</option>
                                        <option value="5" <?php if($item->jawaban == '5') { echo "selected"; }?>>5</option>
                                </select>
                            </td>
                            <td>{{ $item->tgl }}</td>
                        </tr>
                    @else
                        <td>Maaf, Data tidak ditemukan.</td>
                    @endif
                </tbody>
            </table>
            <div class="modal-footer">
                <button class="btn btn-primary text-white" id="submit">Simpan</button>
            </div>
            {{ Form::close() }}
        @endcan
      </div>
    </div>
</div>
@endforeach

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
            <p>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->name }}</p>
            <p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;: {{ $list['first']->tgl }}</p>
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