@extends('layouts.newAdmin')

@section('content')
@role('sekretaris-direktur|it')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4>Table</h4>
              {{-- <div class="card-header-action">
                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="HISTORY"><i class="fa-fw fas fa-history nav-icon text-white"></i> History</button>
              </div> --}}
            </div>
            <div class="card-body">
              <div class="btn-group">
                  <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location='{{ route('rekap.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i></button>
                  {{-- <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="INFORMASI" onclick="window.location='{{ route('rekapAll.index') }}'"><i class="fa-fw fas fa-database nav-icon text-white"></i> Rekap Keseluruhan</button>
                  <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="INFORMASI"><i class="fa-fw fas fa-question nav-icon text-white"></i> Informasi</button> --}}
              </div>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered display" style="font-size: 13px;width: 100%;/* word-break: break-word; */">
                  <thead>
                    <tr>
                      <th rowspan="2">IDB</th>
                      <th rowspan="2">BARANG</th>
                      <th rowspan="2">HARGA</th>
                      <th rowspan="2">SATUAN</th>
                      @foreach($list['unit'] as $item)
                        <th colspan="2">{{ str_replace("","",$item->unit) }}</th>
                        {{-- <th colspan="2">{{ $item->unit }}</th> --}}
                      @endforeach
                    </tr>
                    <tr>
                      @foreach($list['unit'] as $item)
                        <th>JML</th><th>NOM</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($list['barang'] as $item)
                    <tr>
                        <td>{{ $item->id_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->harga_barang }}</td>
                        <td>{{ $item->satuan_barang }}</td>
                        @foreach ($list['unit'] as $val1)
                          @php
                              $getDB = App\Models\pengadaan\detail_pengadaan::
                                          join('pengadaan','detail_pengadaan.id_pengadaan','=','pengadaan.id_pengadaan')
                                          ->select('detail_pengadaan.jumlah','detail_pengadaan.total')
                                          ->where('detail_pengadaan.id_pengadaan', $val1->id_pengadaan)
                                          ->where('detail_pengadaan.id_barang', $item->id_barang)
                                          // ->orderBy('detail_pengadaan.id','desc')
                                          ->get();
                              // dd($getDB);
                              // print_r($getDB);
                              // die();
                          @endphp
                          @foreach ($getDB as $loop)
                            <td>{{ $loop->jumlah }}</td>
                            {{-- <td>{{ $loop->total }}</td> --}}
                          @endforeach
                        @endforeach
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            {{-- <div class="card-footer text-right">
            </div> --}}
        </div>
    </div>
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endrole

<script>
$(document).ready( function () {

});
</script>
@endsection