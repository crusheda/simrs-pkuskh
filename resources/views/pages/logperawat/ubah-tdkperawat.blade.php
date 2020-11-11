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

                Ubah Tindakan Perawat Harian ( id : {{ $list['first']->queue }} )

                <span class="pull-right badge badge-warning" style="margin-top:4px">
                    Akses Publik
                </span>
                

            </div>
            <div class="card-body">
                @can('log_perawat')
                {{ Form::model($list, array('route' => array('tdkperawat.update', $list['first']->queue), 'method' => 'PUT')) }}
                {{-- <form action="{{route('tdkperawat.update', $list['first']->queue)}}" method="PUT"> --}}
                <div class="modal-body">
                    @csrf
                    <label>Unit :</label>
                    <input type="text" name="unit" id="unit" value="{{ $list['first']->unit }}" class="form-control" placeholder="" style="text-transform: capitalize" disabled> <br>
                    <label>Nama :</label>
                    <input type="text" name="pemohon" id="pemohon" value="{{ $list['first']->name }}" class="form-control" placeholder="" style="text-transform: capitalize" disabled> <br>
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
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->pertanyaan }}</td>
                            <td>
                                <select class="custom-select" name="jawaban[]" id="boxy" required>
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
                        @endforeach
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white" id="submit">Simpan</button>
                </div>
                {{-- </form> --}}
                {{ Form::close() }}
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection