@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-light" onclick="window.location.href='{{ route('tgsperawat.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon"></i> Kembali</button>&nbsp;&nbsp;
            <h4>Penunjang Tugas <b>{{ $list['show'][0]->name }}</b></h4>
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
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>

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