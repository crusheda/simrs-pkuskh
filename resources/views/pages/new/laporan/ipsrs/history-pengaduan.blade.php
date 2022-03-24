@extends('layouts.newAdmin')

@section('content')
@role('ipsrs')
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('pengaduan/ipsrs') }}'"><i class="fa-fw fas fa-angle-left nav-icon"></i> Kembali</button>&nbsp;&nbsp;
              <h4>Riwayat Pengaduan IPSRS <i class="fa-fw fas fa-sort-alpha-desc nav-icon text-success"></i></h4>
            </div>
            <div class="card-body">
                {{-- <a><i class="fa-fw fas fa-caret-right nav-icon"></i> Klik tombol <kbd>Sembunyikan Kolom</kbd> untuk menampilkan kolom yang tersembunyi.</a><br><br> --}}
                <div class="table-responsive">
                    <table id="recent" class="table table-striped display" style="width: 100%;
                    word-break: break-word;">
                        <thead>
                            <tr>
                                <th><center>DETAIL</center></th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>LOKASI</th>
                                <th>STATUS</th>
                                <th>TGL PENGADUAN</th>
                                <th>KET PENGADUAN</th>
                                <th>TGL DITERIMA</th>
                                <th>KET DITERIMA</th>
                                <th>TGL DIKERJAKAN</th>
                                <th>KET DIKERJAKAN</th>
                                <th>TGL SELESAI</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            @if(count($list['showrecent']) > 0)
                            @foreach($list['showrecent'] as $item)
                            <tr>
                                <td>
                                    <center>
                                      <div class="btn-group" role="group">
                                        <button onclick="window.location.href='{{ url('pengaduan/ipsrs/detail/'.$item->id) }}'" type="button" class="btn btn-success btn-sm"><i class="fa fa-search"></i></button>
                                        @if (empty($item->filename_pengaduan))
                                            <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                        @else
                                            <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                        @endif
                                      </div>
                                    </center>
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>
                                    @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                        <kbd style="background-color: turquoise">Selesai</kbd>
                                    @elseif (!empty($item->ket_penolakan))
                                        <kbd style="background-color: red">Ditolak</kbd>
                                    @elseif (empty($item->tgl_diterima))
                                        <kbd style="background-color: rebeccapurple">Diverifikasi</kbd>
                                    @elseif (empty($item->tgl_dikerjakan))
                                        <kbd style="background-color: salmon">Diterima</kbd>
                                    @elseif (empty($item->tgl_selesai))
                                        <kbd style="background-color: orange">Dikerjakan</kbd>
                                    @endif
                                </td>
                                
                                <td>{{ $item->tgl_pengaduan }}</td>
                                <td>{{ $item->ket_pengaduan }}</td>
                                <td>{{ $item->tgl_diterima }}</td>
                                <td>{{ $item->ket_diterima }}</td>
                                <td>{{ $item->tgl_dikerjakan }}</td>
                                <td>{{ $item->ket_dikerjakan }}</td>
                                <td>{{ $item->tgl_selesai }}</td>
                                <td>
                                    @if (empty($item->ket_selesai))
                                        {{ $item->ket_penolakan }}
                                    @else
                                        {{ $item->ket_selesai }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><center>DETAIL</center></th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>LOKASI</th>
                                <th>STATUS</th>
                                <th>TGL PENGADUAN</th>
                                <th>KET PENGADUAN</th>
                                <th>TGL DITERIMA</th>
                                <th>KET DITERIMA</th>
                                <th>TGL DIKERJAKAN</th>
                                <th>KET DIKERJAKAN</th>
                                <th>TGL SELESAI</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
@endrole

<script>
    function showLampiran(id) {
        Swal.fire({
            title: 'Lampiran Supervisi '+id,
            text: 'Refresh halaman ini untuk mengupdate lampiran',
            imageUrl: './../ipsrs/'+id,
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
                window.location.href = "./../ipsrs/"+id;
            }
        })
    }
  $(document).ready( function () {
    $("body").addClass('brand-minimized sidebar-minimized');
    $('#recent').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            autoWidth: false,
            columns : [
                { width : '50px' },
                { width : '100px' },
                { width : '70px' },
                { width : '70px' },        
                { width : '80px' },
                { width : '100px' },        
                { width : '100px' },        
                { width : '100px' },        
                { width : '100px' },        
                { width : '100px' },        
                { width : '100px' },        
                { width : '100px' },        
                { width : '110px' },        
            ],
            // 'columnDefs': [
            //     { targets: 6, visible: false },
            //     { targets: 8, visible: false },
            //     { targets: 10, visible: false },
            //     { targets: 12, visible: false },
            // ],
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
            order: [[ 5, "desc" ]],
            pageLength: 20
        }
    );
  });
</script>
@endsection