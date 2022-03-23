@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-light" onclick="window.location.href='{{ route('profkpr.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon"></i> Kembali</button>&nbsp;&nbsp;
            <h4>Profesi Keperawatan <b>{{ $list['show'][0]->name }}</b></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="detailtgs" class="table table-striped">
                    <thead>
                        <th>NAMA</th>
                        <th>UNIT</th>
                        <th>PERNYATAAN</th>
                        <th>KETERANGAN</th>
                        <th>TGL</th>
                        <th>DITAMBAHKAN</th>
                        <th>DIUBAH</th>
                        <th class="text-center">LAMPIRAN</th>
                    </thead>
                    <tbody style="text-transform: capitalize">
                        @foreach($list['show'] as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->pernyataan }}</td>
                            <td>{{ $item->ket }} Kali</td>
                            <td>{{ $item->tgl }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td class="text-center">
                                @if ($item->filename == '')
                                    <button type="button" class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-folder-open nav-icon text-white"></i> Detail</button>
                                @else
                                    <button type="button" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#show{{ $item->id }}"><i class="fa-fw fas fa-folder-open nav-icon text-white"></i> Detail</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>NAMA</th>
                        <th>UNIT</th>
                        <th>PERNYATAAN</th>
                        <th>KETERANGAN</th>
                        <th>TGL</th>
                        <th>DITAMBAHKAN</th>
                        <th>DIUBAH</th>
                        <th class="text-center">LAMPIRAN</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>

@foreach($list['show'] as $item)
    <div class="modal" tabindex="-1" id="show{{ $item->id }}" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Update <b>{{ $item->updated_at }}</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @if ($item->filename != '')
                    Lampiran Dari <a style="text-transform: capitalize"><b>{{ $item->name }}</b></a>, Unit {{ $item->unit }}. <br>
                    <i class="fa-fw fas fa-angle-right nav-icon"></i>&nbsp;Nama File : {{ $item->title }} <br>
                    <i class="fa-fw fas fa-angle-right nav-icon"></i>&nbsp;Ukuran File : {{Storage::size($item->filename)}} bytes.
                @endif
            </div>
            <div class="modal-footer">
                <button onclick="window.location.href='{{ url('profkpr/'. $item->id.'/show') }}'" type="button" class="btn btn-success"><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Lampiran</button>
            </div>
        </div>
        </div>
    </div>
@endforeach

<script>
    $(document).ready( function () {
        $('#detailtgs').DataTable(
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
                order: [[ 5, "desc" ]]
            }
        );
    } );
</script>
@endsection