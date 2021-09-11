@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<script src="{{ asset('js/fstdropdown.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">

@role('ipsrs')
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header bg-dark text-white">
              <button type="button" class="btn btn-sm btn-light pull-left" onclick="window.location.href='{{ url('pengaduan/ipsrs') }}'"><i class="fa-fw fas fa-hand-o-left nav-icon"></i> Kembali</button>
              <div class="pull-right">
                History Pengaduan IPSRS <i class="fa-fw fas fa-sort-alpha-desc nav-icon text-success"></i>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="recent" class="table table-striped display">
                        <thead>
                            <tr>
                                <th><center>DETAIL</center></th>
                                <th>NAMA</th>
                                <th>UNIT</th>
                                <th>LOKASI</th>
                                <th>STATUS</th>
                                <th>TGL MULAI</th>
                                <th>TGL SELESAI</th>
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
                                        <button type="button" class="btn btn-info text-white btn-sm" data-toggle="modal" data-target="#lampiranIPSRS{{ $item->id }}"><i class="fa-fw fas fa-history nav-icon"></i></button>
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
                                <td>{{ $item->tgl_selesai }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endrole

@role('ipsrs')
{{-- Download Lampiran FOTO IPSRS RECENT --}}
@foreach($list['showrecent'] as $item)
<div class="modal" tabindex="-1" id="lampiranIPSRS{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Detail Pengaduan&nbsp;<kbd>ID : {{ $item->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6 class="text-left">Keterangan Pengaduan :</h6>
            <div class="card">
                <div class="card-body">
                    <p>{{ $item->ket_pengaduan }}</p>
                </div>
            </div><hr>
            <h6 class="text-left">Lampiran Pengaduan :</h6>
            @if (empty($item->filename_pengaduan))
                <div class="card">
                    <div class="card-body">
                        <center><p><b>Tidak Ada Lampiran</b></p></center>
                    </div>
                </div>
            @else
                {{-- <center><img src="{{ url('public/storage/'.substr($item->filename_pengaduan,7,2000)) }}" style="width:400px" alt="" title="" /></center> --}}
                <center><img src="{{ url('storage/'.substr($item->filename_pengaduan,7,1000)) }}" style="width:400px" alt="" title="" /></center>
            @endif
        </div>
        <div class="modal-footer">
            @if (empty($item->filename_pengaduan))
                <button type="button" class="btn btn-secondary" disabled><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
            @else
                <button onclick="window.location.href='{{ url('pengaduan/ipsrs/'. $item->id) }}'" type="button" class="btn btn-success"><i class="fa fa-download"></i>&nbsp;&nbsp;Download</button>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach
{{-- Recent Detail Laporan --}}
@foreach($list['showrecent'] as $item)
<div class="modal" tabindex="-1" id="detail4{{ $item->id }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Detail Laporan&nbsp;<kbd>ID : {{ $item->id }}</kbd>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h6>- <b>Status Laporan :</b> 
                @if ($item->ket_penolakan == null)
                    <kbd>Laporan Selesai</kbd>
                @else
                    <kbd>Laporan Ditolak</kbd>
                @endif
            </h6>
            <h6>- <b>Tgl : </b>{{ $item->tgl_selesai }}</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-remove"></i> Tutup</button>
        </div>
      </div>
    </div>
</div>
@endforeach
@endrole

<script>
  $(document).ready( function () {
    $('#recent').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf','colvis'
            ],
            language: {
                buttons: {
                    colvis: 'Sembunyikan Kolom',
                    excel: 'Jadikan Excell',
                    pdf: 'Jadikan PDF',
                }
            },
            order: [[ 5, "desc" ]]
        }
    );
  });
</script>
@endsection