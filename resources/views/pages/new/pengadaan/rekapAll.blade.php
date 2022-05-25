@extends('layouts.newAdmin')

@section('content')
@role('sekretaris-direktur|it')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h4>Table</h4>
              <div class="card-header-action">
                <h4><kbd>Bulan {{ $list['bln'] }} - Tahun {{ $list['tahun'] }}</kbd></h4>
              </div>
            </div>
            <div class="card-body">
              <div class="btn-group">
                  <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location='{{ route('rekap.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i></button>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#rekapAll" title="REKAP KESELURUHAN"><i class="fa-fw fas fa-database nav-icon text-white"></i> Rekap Keseluruhan</button>
              </div>
              <hr>
              <div class="table-responsive">
                <table id="table" class="table table-bordered display" style="font-size: 13px;width: 100%;/* white-space: nowrap;*/ /* word-break: break-word; */">
                  <thead>
                    <tr>
                      <th rowspan="2">IDB</th>
                      <th rowspan="2">BARANG</th>
                      <th rowspan="2">HARGA</th>
                      <th rowspan="2">SATUAN</th>
                      @foreach($list['unit'] as $item)
                        <th colspan="2" style="text-transform:uppercase">{{ str_replace('","'," , ",(str_replace("-"," ",(str_replace(['["','"]'],"",$item->unit))))) }}</th>
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
                            $jumlah = App\Models\pengadaan\detail_pengadaan::
                                        join('pengadaan','detail_pengadaan.id_pengadaan','=','pengadaan.id_pengadaan')
                                        ->select('detail_pengadaan.jumlah')
                                        ->where('detail_pengadaan.id_pengadaan', $val1->id_pengadaan)
                                        ->where('detail_pengadaan.id_barang', $item->id_barang)
                                        ->first();
                            $total = App\Models\pengadaan\detail_pengadaan::
                                        join('pengadaan','detail_pengadaan.id_pengadaan','=','pengadaan.id_pengadaan')
                                        ->select('detail_pengadaan.total')
                                        ->where('detail_pengadaan.id_pengadaan', $val1->id_pengadaan)
                                        ->where('detail_pengadaan.id_barang', $item->id_barang)
                                        ->first();
                            // $totalAll[] = $total->total;
                          @endphp
                          <td>@if(!empty($jumlah)) {{ str_replace(['{"jumlah":','}'],"",$jumlah) }} @endif</td>
                          <td style="white-space: nowrap;">@if(!empty($total))Rp. {{ number_format((int)(str_replace(['{"total":','}'],"",$total)),2,",",".") }} @endif</td>
                          {{-- <td>{{ $totalAll }}</td> --}}
                        @endforeach
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <th colspan="4"><kbd>TOTAL</kbd></th>
                    @foreach ($list['total'] as $item)
                      <th colspan="2">
                        @if(!empty($item))Rp. {{ number_format((int)(str_replace(['{"total":','}'],"",$item)),2,",",".") }} @endif    
                      </th>
                    @endforeach
                  </tfoot>
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

<div class="modal fade bd-example-modal-lg" id="rekapAll" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">
      Rekap Keseluruhan
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <form action="{{ route('rekapAll.index') }}" method="GET">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group" style="width: 100%">
              <select onchange="submitBtnAll()" class="form-control mb-2 mr-sm-2" name="bulan" id="bulan_all">
                  <option hidden>Pilih Bulan</option>
                  <option value="01"> Januari</option>
                  <option value="02"> Februari</option>
                  <option value="03"> Maret</option>
                  <option value="04"> April</option>
                  <option value="05"> Mei</option>
                  <option value="06"> Juni</option>
                  <option value="07"> Juli</option>
                  <option value="08"> Agustus</option>
                  <option value="09"> September</option>
                  <option value="10"> Oktober</option>
                  <option value="11"> November</option>
                  <option value="12"> Desember</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group" style="width: 100%">
              <select onchange="submitBtnAll()" class="form-control" name="tahun" id="tahun_all">
                  <option hidden>Pilih Tahun</option>
                  @php
                      for ($i=2022; $i <= \Carbon\Carbon::now()->isoFormat('Y'); $i++) { 
                          echo"<option value=$i> $i </option>";
                      }
                  @endphp
              </select>
            </div>
          </div>
        </div>

    </div>
    <div class="modal-footer">

        <button class="btn btn-secondary text-white" id="submit_filterAll" disabled><i class="fa-fw fas fa-filter nav-icon text-white"></i> Submit</button>
      </form>
      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
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
      scrollX: true,
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
        {
          extend: 'colvis',
          className: 'btn-dark',
          text: 'Sembunyikan Kolom',
          exportOptions: {
              columns: ':visible'
          }
        }
      ],
      // columnDefs: [
      //     { width: 200, targets: 0 }
      // ],
      // fixedColumns: true,
      // fixedColumns: {
      //     left: 4,
      //     // right: 1
      // },
      order: [[ 1, "asc" ]],
      pageLength: 20
    }
  ).columns.adjust();
});

function submitBtnAll() {
    // var unit = $("#unit_cari").val();
    var bulan = $("#bulan_all").val();
    var tahun = $("#tahun_all").val();

    if ( bulan != 'Pilih Bulan' && tahun != 'Pilih Tahun' ) {
        $('#submit_filterAll').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
    }
}
</script>
@endsection