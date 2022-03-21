@extends('layouts.newAdmin')

@section('content')
{{-- Sistem Tracking --}}
<link href="{{ asset('css/tracking.css') }}" rel="stylesheet" /> 

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Tabel Pengaduan IPSRS</h4>
      </div>
      <div class="card-body">
        @role('ipsrs')
        @else
          <div class="row">
            <div class="col-md-12">
              <a type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#tambah">
                <i class="fa-fw fas fa-plus-square nav-icon">

                </i>
                Tambah Pengaduan
              </a>
            </div>
          </div><hr>
        @endrole

        @role('ipsrs')
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#info" data-toggle="tooltip" data-placement="bottom" title="INFO PENGADUAN"><i class="fa-fw fas fa-question nav-icon"></i></button>
                    <button class="btn btn-dark pull-right" onclick="window.location.href='{{ url('pengaduan/ipsrs/history') }}'" data-toggle="tooltip" data-placement="right" title="REKAP PENGADUAN"><i class="fa-fw fas fa-history nav-icon"></i> REKAP</button>
                </div><br>
                <sub><i class="fa-fw fas fa-caret-right nav-icon" style="margin-top: 10px"></i> Klik tombol <b>REKAP</b> untuk menampilkan semua riwayat pengaduan</sub>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
          <table id="pengaduan_ipsrs" class="table table-striped display">
            <thead>
                <tr>
                    <th><center>DETAIL</center></th>
                    <th>NAMA</th>
                    <th>UNIT</th>
                    <th>LOKASI</th>
                    <th>STATUS</th>
                    <th>TGL PENGADUAN</th>
                </tr>
            </thead>
            <tbody style="text-transform: capitalize">
              @if(count($list['show']) > 0)
                @foreach($list['show'] as $item)
                <tr>
                  <td>
                    <center>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary text-light btn-sm" data-toggle="modal" data-target="#track{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="TRACKING"><i class="fa fa-search"></i></button>
                        @if (empty($item->filename_pengaduan))
                            <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                        @else
                            <button type="button" class="btn btn-warning btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                        @endif
                        <button onclick="window.location.href='{{ url('pengaduan/ipsrs/detail/'.$item->id) }}'" type="button" class="btn btn-danger btn-sm"><i class="fa fa-wrench"></i> Proses</button>
                      </div>
                    </center>
                  </td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->unit }}</td>
                  <td>{{ $item->lokasi }}</td>
                  
                  @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                    <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                  @elseif (!empty($item->ket_penolakan))
                    <td><kbd style="background-color: red">Ditolak</kbd></td>
                  @elseif (empty($item->tgl_diterima))
                    <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                  @elseif (empty($item->tgl_dikerjakan))
                    <td><kbd style="background-color: salmon">Diterima</kbd></td>
                  @elseif (empty($item->tgl_selesai))
                    <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                  @endif
                  
                  <td>{{ $item->tgl_pengaduan }}</td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        @else

        <div class="table-responsive">
          <table id="pengaduan_user1" class="table table-striped display">
            <thead>
              <tr>
                <th><center>DETAIL</center></th>
                <th>NAMA</th>
                <th>LOKASI</th>
                <th>STATUS</th>
                <th>TGL PENGADUAN</th>
                <th><center>AKSI</center></th>
              </tr>
            </thead>
            <tbody style="text-transform: capitalize">
              @if(count($list['shownotyet']) > 0)
                @foreach($list['shownotyet'] as $item)
                <tr>
                  <td>
                    <center>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detail2{{ $item->id }}"><i class="fa-fw fas fa-search nav-icon"></i> Tracking</button>
                    </center>
                  </td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->lokasi }}</td>

                  @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                    <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                  @elseif (!empty($item->ket_penolakan))
                    <td><kbd style="background-color: red">Ditolak</kbd></td>
                  @elseif (empty($item->tgl_diterima))
                    <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                  @elseif (empty($item->tgl_dikerjakan))
                    <td><kbd style="background-color: salmon">Diterima</kbd></td>
                  @elseif (empty($item->tgl_selesai))
                    <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                  @endif
                  
                  <td>{{ $item->tgl_pengaduan }}</td>
                  <td>
                    <center>
                      <div class="btn-group" role="group">
                        @if (empty($item->tgl_selesai))
                          @if (!empty($item->tgl_diterima))
                            <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                            @if (empty($item->filename_pengaduan))
                                <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @else
                                <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @endif
                            <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                          @else
                            <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                            @if (empty($item->filename_pengaduan))
                                <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @else
                                <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @endif
                            <button type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                          @endif
                        @else
                          <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                          @if (empty($item->filename_pengaduan))
                              <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                          @else
                              <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                          @endif
                          <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                        @endif
                      </div>
                    </center>
                  </td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        @endrole
      </div>
    </div>
  </div>

  @role('ipsrs')
  @else
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>Riwayat Pengaduan IPSRS</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="pengaduan_user2" class="table table-striped display">
            <thead>
              <tr>
                <th><center>DETAIL</center></th>
                <th>NAMA</th>
                <th>LOKASI</th>
                <th>STATUS</th>
                <th>TGL PENGADUAN</th>
                <th>TGL SELESAI</th>
                <th><center>AKSI</center></th>
              </tr>
            </thead>
            <tbody style="text-transform: capitalize">
              @if(count($list['showdone']) > 0)
              @foreach($list['showdone'] as $item)
              <tr>
                  <td>
                    <center>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detail2{{ $item->id }}"><i class="fa-fw fas fa-history nav-icon"></i> Riwayat</button>
                    </center>
                  </td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->lokasi }}</td>

                  @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                      <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                  @elseif (!empty($item->ket_penolakan))
                      <td><kbd style="background-color: red">Ditolak</kbd></td>
                  @elseif (empty($item->tgl_diterima))
                      <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                  @elseif (empty($item->tgl_dikerjakan))
                      <td><kbd style="background-color: salmon">Diterima</kbd></td>
                  @elseif (empty($item->tgl_selesai))
                      <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                  @endif
                  
                  <td>{{ $item->tgl_pengaduan }}</td>
                  <td>{{ $item->tgl_selesai }}</td>
                  <td>
                      <center>
                          <div class="btn-group" role="group">
                              @if (empty($item->tgl_selesai))
                                  @if (!empty($item->tgl_diterima))
                                      <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                      @if (empty($item->filename_pengaduan))
                                          <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                      @else
                                          <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                      @endif
                                      <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                  @else
                                      <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                      @if (empty($item->filename_pengaduan))
                                          <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                      @else
                                          <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                      @endif
                                      <button type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                  @endif
                              @else
                                  <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                  @if (empty($item->filename_pengaduan))
                                      <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                  @else
                                      <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                                  @endif
                                  <button type="button" class="btn btn-secondary btn-sm text-white disabled"><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
                <th><center>DETAIL</center></th>
                <th>NAMA</th>
                <th>LOKASI</th>
                <th>STATUS</th>
                <th>TGL PENGADUAN</th>
                <th>TGL SELESAI</th>
                <th><center>AKSI</center></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endrole
</div>

@role('ipsrs')
    {{-- Info Jumlah Pengaduan IPSRS --}}
    <div class="modal fade bd-example-modal-lg" id="info" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Informasi Jumlah pengaduan
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <a><i class="fa-fw fas fa-caret-right nav-icon" style="margin-top: 10px"></i> Pengaduan yang sedang berjalan : <kbd style="background-color: rgb(0, 162, 255)">@php echo count(\DB::table('pengaduan_ipsrs')->where('tgl_selesai',null)->get()); @endphp</kbd></a><br>
                <a><i class="fa-fw fas fa-caret-right nav-icon" style="margin-top: 10px"></i> Pengaduan yang diselesaikan : <kbd style="background-color: rgb(30, 255, 0)">@php echo count(\DB::table('pengaduan_ipsrs')->where('tgl_selesai','!=',null)->where('tgl_diterima','!=',null)->get()); @endphp</kbd></a><br>
                <a><i class="fa-fw fas fa-caret-right nav-icon" style="margin-top: 10px"></i> Pengaduan yang ditolak : <kbd style="background-color: rgb(255, 0, 0)">@php echo count(\DB::table('pengaduan_ipsrs')->where('tgl_selesai','!=',null)->where('tgl_diterima',null)->get()); @endphp</kbd></a><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Close</button>
            </div>
        </div>
        </div>
    </div>

    {{-- Tombol Lihat Proses Laporan User Oleh IPSRS --}}
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="track{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Proses Laporan&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bg-white p-2 border rounded px-3">
                                <div class="d-flex flex-row justify-content-between align-items-center order">
                                    <div class="d-flex flex-column order-details"><span><b>Pengaduan:</b> {{ $item->ket_pengaduan }}</span><span class="date">Dari {{ $item->nama }} Pada {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM, YYYY HH:mm A') }}</span></div>
                                    <div class="tracking-details">Status :
                                        @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                            <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                                        @elseif (!empty($item->ket_penolakan))
                                            <td><kbd style="background-color: red">Ditolak</kbd></td>
                                        @elseif (empty($item->tgl_diterima))
                                            <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                                        @elseif (empty($item->tgl_dikerjakan))
                                            <td><kbd style="background-color: salmon">Diterima</kbd></td>
                                        @elseif (empty($item->tgl_selesai))
                                            <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                                        @endif
                                    </div>
                                </div>
                                <hr class="divider mb-4">
                                
                                {{-- Selesai --}}
                                @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_dikerjakan)->isoFormat('DD MMM') }}</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_selesai)->isoFormat('DD MMM') }}</span><span>Selesai</span></div>
                                    </div>
                                {{-- Ditolak --}}
                                @elseif (!empty($item->ket_penolakan))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot-ditolak"></span>
                                        <hr class="flex-fill track-line-ditolak"><span class="dot-ditolak"></span>
                                        <hr class="flex-fill track-line-ditolak"><span class="dot-ditolak"></span>
                                        <hr class="flex-fill track-line-ditolak"><span class="d-flex justify-content-center align-items-center big-dot-ditolak dot-ditolak"><i class="fa fa-times text-white"></i></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"></div>
                                        <div class="d-flex flex-column justify-content-center"></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"></div>
                                        <div class="d-flex flex-column align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_selesai)->isoFormat('DD MMM') }}</span><span>Ditolak</span></div>
                                    </div>
                                {{-- Diverifikasi --}}
                                @elseif (empty($item->tgl_diterima))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                        <hr class="flex-fill"><span class="dot"></span>
                                        <hr class="flex-fill"><span class="dot"></span>
                                        <hr class="flex-fill"><span class="dot"></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>-</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>-</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>-</span><span>Selesai</span></div>
                                    </div>
                                {{-- Diterima --}}
                                @elseif (empty($item->tgl_dikerjakan))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                        <hr class="flex-fill"><span class="dot"></span>
                                        <hr class="flex-fill"><span class="dot"></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>-</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>-</span><span>Selesai</span></div>
                                    </div>
                                {{-- Dikerjakan --}}
                                @elseif (empty($item->tgl_selesai))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                        <hr class="flex-fill"><span class="dot"></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_dikerjakan)->isoFormat('DD MMM') }}</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>-</span><span>Selesai</span></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div><br>
                    @if ($item->ket_penolakan == null)
                    <table class="table table-striped display">
                        <thead>
                            <tr>
                                <th>STATUS</th>
                                <th>TGL</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            <tr>
                                <th><button class="btn btn-dark btn-sm" type="button" disabled>DITERIMA</button></th>
                                <td>{{ $item->tgl_diterima }}</td>
                                <td>{{ $item->ket_diterima }}</td>
                            </tr>
                            <tr>
                                <th><button class="btn btn-dark btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample{{ $item->id }}">DIKERJAKAN</button></th>
                                <td>{{ $item->tgl_dikerjakan }}</td>
                                <td>{{ $item->ket_dikerjakan }}</td>
                            </tr>
                            <tr>
                                <th><button class="btn btn-dark btn-sm" type="button" disabled>SELESAI</button></th>
                                <td>{{ $item->tgl_selesai }}</td>
                                <td>{{ $item->ket_selesai }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b># Klik tombol Status <kbd>DIKERJAKAN</kbd> untuk melihat detail Status.</b></p>
                    @else
                        <p><b>Laporan Ditolak Pada : </b>{{ $item->tgl_selesai }}</p>
                        <p><b>Keterangan Penolakan : </b></p>
                        <textarea class="form-control" disabled><?php echo htmlspecialchars($item->ket_penolakan); ?></textarea>
                    @endif
                    <div class="collapse" id="collapseExample{{ $item->id }}">
                        <div class="card card-body">
                            <h5><b>Status Dikerjakan</b></h5>
                            <table class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>TGL</th>
                                        <th>KETERANGAN</th>
                                        <th><center>LAMPIRAN</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $data = \App\Models\pengaduan_ipsrs_catatan::where('pengaduan_id', $item->id)->get();
                                    @endphp
                                    @if(count($data) > 0)
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            <center>
                                                @if (!empty($item->title))
                                                    <button class="btn btn-success" onclick="window.location.href='{{ url('pengaduan/ipsrs/lampiran/catatan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                                @else
                                                    <button class="btn btn-secondary disabled"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                                @endif
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan=3>Tidak Ada Data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
    {{-- Tambah --}}
    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                Tambah Pengaduan
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-auth-small" id="formTambah" action="{{ route('ipsrs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <label>Nama : </label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->name }}" disabled><br>
                        </div>
                        <div class="col-md-4">
                            <label>Unit : </label>
                            <input type="text" name="unit" id="unit" class="form-control" value="{{ Auth::user()->roles->first()->name }}" disabled><br>
                        </div> --}}
                        <div class="col-md-12">
                            <label>Lokasi : </label>
                            <input type="text" name="lokasi" id="lokasi1" class="form-control" placeholder="" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Pengaduan :</label>
                            <textarea class="form-control" name="pengaduan" id="pengaduan1" placeholder="" style="min-height: 100px" maxlength="190" rows="5" required></textarea>
                            <span class="help-block">
                                <p id="maxpengaduan1" class="help-block "></p>
                            </span>
                        </div>
                    </div>
                    {{-- <img class="card-img-top img-thumbnail" id="blah" src="#" alt="Lampiran" height="50" alt="Card image cap" /> --}}
                    <label>Lampiran (Optional) : </label><br>
                    <input type="file" name="file" id="imgInp"><br>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran foto</sub><br>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan upload Foto/Gambar bukan Video, berformat <b>jpg,png,jpeg,gif</b> </sub><hr>
                    <div class="card text-center" style="width: 18rem;">
                        <img class="card-img-top" id="blah" src="#" alt="Tidak ada lampiran">
                    </div>

            </div>
            <div class="modal-footer">

                    <center><button class="btn btn-primary" id="btn-simpan" type="submit"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button></center><br>
                </form>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Close</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Ubah -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="ubah{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Ubah Pengaduan&nbsp;<span class="pull-right badge badge-info text-white">ID : {{ $item->id }}</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{ Form::model($item, array('route' => array('ipsrs.update', $item->id), 'method' => 'PUT', 'id' => 'formUbah')) }}
                        @csrf
                        <input type="text" name="id" value="{{ $item->id }}" hidden> 
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <label>Nama : </label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->nama }}" disabled><br>
                            </div>
                            <div class="col-md-4">
                                <label>Unit : </label>
                                <input type="text" name="unit" id="unit" class="form-control" value="{{ $item->unit }}" disabled><br>
                            </div> --}}
                            <div class="col">
                                <label>Lokasi : </label>
                                <input type="text" name="lokasi" id="lokasi2" class="form-control" value="{{ $item->lokasi }}" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Pengaduan :</label>
                                <textarea class="form-control" name="pengaduan" id="pengaduan2" placeholder="" style="min-height: 100px" maxlength="190" rows="5" required><?php echo htmlspecialchars($item->ket_pengaduan); ?></textarea>
                                <span class="help-block">
                                    <p id="maxpengaduan2" class="help-block "></p>
                                </span>
                            </div>
                        </div>
                        <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Apabila laporan sudah <kbd style="background-color: salmon">DITERIMA</kbd> oleh IPSRS, anda tidak dapat lagi mengubah ataupun menghapus laporan ini.</sub>
                </div>
                <div class="modal-footer">
                    
                        <center><button class="btn btn-success pull-right" type="submit" id="btn-simpan2"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button></center><br>
                    </form>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Hapus -->
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Hapus Pengaduan&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;?
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus Laporan <b>{{ $item->nama }}</b> ?</p>
                    <p><b>Laporan : </b>{{ $item->ket_pengaduan }}</p>
                </div>
                <div class="modal-footer">
                    @if(count($list) > 0)
                        <form action="{{ route('ipsrs.destroy', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Tombol Lihat Proses Laporan User --}}
    @foreach($list['show'] as $item)
    <div class="modal fade bd-example-modal-lg" id="detail2{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Proses Laporan&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bg-white p-2 border rounded px-3">
                                <div class="d-flex flex-row justify-content-between align-items-center order">
                                    <div class="d-flex flex-column order-details"><span><b>Pengaduan:</b> {{ $item->ket_pengaduan }}</span><span class="date">Dari {{ $item->nama }} Pada {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM, YYYY HH:mm A') }}</span></div>
                                    <div class="tracking-details">Status :
                                        @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                            <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                                        @elseif (!empty($item->ket_penolakan))
                                            <td><kbd style="background-color: red">Ditolak</kbd></td>
                                        @elseif (empty($item->tgl_diterima))
                                            <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                                        @elseif (empty($item->tgl_dikerjakan))
                                            <td><kbd style="background-color: salmon">Diterima</kbd></td>
                                        @elseif (empty($item->tgl_selesai))
                                            <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                                        @endif
                                    </div>
                                </div>
                                <hr class="divider mb-4">
                                
                                {{-- Selesai --}}
                                @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_dikerjakan)->isoFormat('DD MMM') }}</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_selesai)->isoFormat('DD MMM') }}</span><span>Selesai</span></div>
                                    </div>
                                {{-- Ditolak --}}
                                @elseif (!empty($item->ket_penolakan))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot-ditolak"></span>
                                        <hr class="flex-fill track-line-ditolak"><span class="dot-ditolak"></span>
                                        <hr class="flex-fill track-line-ditolak"><span class="dot-ditolak"></span>
                                        <hr class="flex-fill track-line-ditolak"><span class="d-flex justify-content-center align-items-center big-dot-ditolak dot-ditolak"><i class="fa fa-times text-white"></i></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"></div>
                                        <div class="d-flex flex-column justify-content-center"></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"></div>
                                        <div class="d-flex flex-column align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_selesai)->isoFormat('DD MMM') }}</span><span>Ditolak</span></div>
                                    </div>
                                {{-- Diverifikasi --}}
                                @elseif (empty($item->tgl_diterima))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                        <hr class="flex-fill"><span class="dot"></span>
                                        <hr class="flex-fill"><span class="dot"></span>
                                        <hr class="flex-fill"><span class="dot"></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>-</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>-</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>-</span><span>Selesai</span></div>
                                    </div>
                                {{-- Diterima --}}
                                @elseif (empty($item->tgl_dikerjakan))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                        <hr class="flex-fill"><span class="dot"></span>
                                        <hr class="flex-fill"><span class="dot"></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>-</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>-</span><span>Selesai</span></div>
                                    </div>
                                {{-- Dikerjakan --}}
                                @elseif (empty($item->tgl_selesai))
                                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="dot"></span>
                                        <hr class="flex-fill track-line"><span class="d-flex justify-content-center align-items-center big-dot dot"><i class="fa fa-check text-white"></i></span>
                                        <hr class="flex-fill"><span class="dot"></span></div>
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex flex-column align-items-start"><span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span></div>
                                        <div class="d-flex flex-column justify-content-center"><span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span></div>
                                        <div class="d-flex flex-column justify-content-center align-items-center"><span>{{ \Carbon\Carbon::parse($item->tgl_dikerjakan)->isoFormat('DD MMM') }}</span><span>Dikerjakan</span></div>
                                        <div class="d-flex flex-column align-items-center"><span>-</span><span>Selesai</span></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div><br>
                    @if ($item->ket_penolakan == null)
                    <table class="table table-striped display">
                        <thead>
                            <tr>
                                <th>STATUS</th>
                                <th>TGL</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: capitalize">
                            <tr>
                                <th><button class="btn btn-dark btn-sm disabled" type="button">DITERIMA</button></th>
                                <td>{{ $item->tgl_diterima }}</td>
                                <td>{{ $item->ket_diterima }}</td>
                            </tr>
                            <tr>
                                <th><button class="btn btn-dark btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample{{ $item->id }}">DIKERJAKAN</button></th>
                                <td>{{ $item->tgl_dikerjakan }}</td>
                                <td>{{ $item->ket_dikerjakan }}</td>
                            </tr>
                            <tr>
                                <th><button class="btn btn-dark btn-sm disabled" type="button">SELESAI</button></th>
                                <td>{{ $item->tgl_selesai }}</td>
                                <td>{{ $item->ket_selesai }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b># Klik tombol Status <kbd>DIKERJAKAN</kbd> untuk melihat detail Status.</b></p>
                    @else
                        <p><b>Laporan Ditolak Pada : </b>{{ $item->tgl_selesai }}</p>
                        <p><b>Keterangan Penolakan : </b></p>
                        <textarea class="form-control" disabled><?php echo htmlspecialchars($item->ket_penolakan); ?></textarea>
                    @endif
                    <div class="collapse" id="collapseExample{{ $item->id }}">
                        <div class="card card-body">
                            <h5><b>Status Dikerjakan</b></h5>
                            <table class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>TGL</th>
                                        <th>KETERANGAN</th>
                                        <th><center>LAMPIRAN</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $data = \App\Models\pengaduan_ipsrs_catatan::where('pengaduan_id', $item->id)->get();
                                    @endphp
                                    @if(count($data) > 0)
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            <center>
                                                @if (!empty($item->title))
                                                    <button class="btn btn-success" onclick="window.location.href='{{ url('pengaduan/ipsrs/lampiran/catatan/'. $item->id) }}'"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                                @else
                                                    <button class="btn btn-secondary disabled"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                                @endif
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endrole

<script>
    function showLampiran(id) {
        Swal.fire({
            title: 'Lampiran ID : '+id,
            // text: '',
            imageUrl: './ipsrs/'+id,
            imageWidth: 400,
            // imageHeight: 200,
            imageAlt: 'Lampiran',
            reverseButtons: true,
            showDenyButton: false,
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: `<i class="fa fa-times"></i> Tutup`,
            confirmButtonText: `<i class="fa fa-download"></i> Download`,
            backdrop: `rgba(26,27,41,0.8)`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "./ipsrs/"+id;
            }
        })
    }
    $(document).ready( function () {
        $('#pengaduan_ipsrs').DataTable(
            {
                paging: true,
                searching: true,
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
        $('#pengaduan_user1').DataTable(
            {
                // paging: true,
                // searching: true,
                // dom: 'Bfrtip',
                order: [[ 4, "desc" ]],
                pageLength: 10
            }
        );
        $('#pengaduan_user2').DataTable(
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
                order: [[ 4, "desc" ]],
                pageLength: 10
            }
        );
        $('#maxpengaduan1').text('190 Limit Text');
        $('#maxpengaduan2').text('190 Limit Text');
        $('#pengaduan1').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#maxpengaduan1').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#maxpengaduan1').text(ch + ' Limit Text');     
            }
        }); 
        $('#pengaduan2').keydown(function () {
            var max = 190;
            var len = $(this).val().length;
            if (len >= max) {
                $('#maxpengaduan2').text('Anda telah mencapai Limit Maksimal.');          
            } 
            else {
                var ch = max - len;
                $('#maxpengaduan2').text(ch + ' Limit Text');     
            }
        }); 
        
        $("#formTambah").one('submit', function() {
            //stop submitting the form to see the disabled button effect
            $("#btn-simpan").attr('disabled','disabled');
            $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

            return true;
        });
    } );
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });
</script>
@endsection