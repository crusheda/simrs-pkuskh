@extends('layouts.newAdmin')

@section('content')
@hasrole('it')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('it/supervisi/') }}'"><i class="fa-fw fas fa-angle-left nav-icon"></i> Kembali</button>&nbsp;
            <h4>Tabel</h4>
        </div>
        <div class="card-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="table-responsive">
                                    <table id="logit" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>NAMA</th>
                                                <th>KEGIATAN</th>
                                                <th>LOKASI</th>
                                                <th>KETERANGAN</th>
                                                <th>TGL</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-transform: capitalize">
                                            @if(count($list['show']) > 0)
                                            @foreach($list['show'] as $item)
                                            <tr>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->kegiatan }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group" role="group">
                                                            @if ($item->filename != '')
                                                                <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                                            @else
                                                                <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-image nav-icon"></i></button>
                                                            @endif
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>NAMA</th>
                                                <th>KEGIATAN</th>
                                                <th>LOKASI</th>
                                                <th>KETERANGAN</th>
                                                <th>TGL</th>
                                                <th><center>AKSI</center></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@else
<p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endhasrole

<script>
    function showLampiran(id) {
        Swal.fire({
            title: 'Lampiran Supervisi '+id,
            text: 'Refresh halaman ini untuk mengupdate lampiran',
            imageUrl: '.././supervisi/lampiran/'+id,
            imageWidth: 400,
            // imageHeight: 200,
            imageAlt: 'Lampiran',
            reverseButtons: true,
            showDenyButton: false,
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonText: `<i class="fa fa-download"></i> Download`,
            backdrop: `rgba(26,27,41,0.8)`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = ".././supervisi/lampiran/"+id+"/download";
            }
        })
    }
    $(document).ready( function () {
        $('#logit').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    // 'copyHtml5',
                    // 'excelHtml5',
                    // 'csvHtml5',
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
                order: [[ 4, "desc" ]],
                pageLength: 50
            }
        );
    } );
</script>
@endsection