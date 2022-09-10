@extends('layouts.simrsmuv2')

@section('content')
{{-- Sistem Tracking --}}
<link href="{{ asset('css/tracking.css') }}" rel="stylesheet" /> 

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Laporan / Pengaduan /</span> IPSRS
</h4>

<style>
  /* img.zoom {
    width: 350px;
    height: 200px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
  } */
  .transisi {
      -webkit-transform: scale(3.8); 
      -moz-transform: scale(3.8);
      -o-transform: scale(3.8);
      /* transform: scale(3.8); */
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
  }
</style>

@if(session('message'))
<div class="alert alert-primary alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
  <p class="mb-0">{{ session('message') }}</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if($errors->count() > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
  <p class="mb-0">
    <ul>
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif

<div class="row">
  <div class="col-md-4">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-around flex-wrap my-4 mb-5" style="margin-top:0rem !important">
          <div class="d-flex align-items-start me-4 mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
            <div>
              <span>Total</span>
              <h5 class="mb-0">{{ $list['total'] }}</h5>
            </div>
          </div>
          <div class="d-flex align-items-start mt-3 gap-3">
            <span class="badge bg-label-success p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
            <div>
              <span>Selesai</span>
              <h5 class="mb-0">{{ $list['totalselesai'] }}</h5>
            </div>
          </div>
          <div class="d-flex align-items-start mt-3 gap-3">
            <span class="badge bg-label-danger p-2 rounded"><i class='bx bx-calendar-x bx-sm'></i></span>
            <div>
              <span>Ditolak</span>
              <h5 class="mb-0">{{ $list['totalditolak'] }}</h5>
            </div>
          </div>
        </div>
        <div class="divider divider-primary" style="margin-top:-10px">
          <div class="divider-text">Form Tambah</div>
        </div>
        <div class="info-container">
          <form method="POST" id="formTambah" action="{{ route('ipsrs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Lokasi</label>
              <input type="text" name="lokasi" class="form-control typeahead-bloodhound" placeholder="Masukkan Lokasi" autocomplete="off" required/>
            </div>
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Pengaduan</label>
              <div class="form-group">
                <textarea rows="3" class="autosize1 form-control" name="pengaduan" placeholder="Deskripsi Pengaduan Anda" required></textarea>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Lampiran (Optional) : </label>
              <div class="form-group">
                <input type="file" name="file" id="imgInp" class="form-control">
                <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran foto</sub><br>
                <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan upload Foto/Gambar bukan Video, berformat <b>jpg,png,jpeg,gif</b> </sub>
                <center>
                  <div class="card" style="width: 18rem;margin-top:20px">
                    <img class="card-img-top" id="blah" src="#" alt="Tidak ada lampiran">
                  </div>
                </center>
              </div>
            </div>
          <div class="d-flex justify-content-center pt-3">
            <div class="btn-group">
              <button class="btn btn-primary" onclick="simpan()" id="btn-simpan" type="submit"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
            </form>
              <button class="btn btn-label-warning" onclick="clear()" type="button"><i class="fa-fw fas fa-eraser nav-icon"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <span class="badge bg-label-primary">Standard</span>
          <div class="d-flex justify-content-center">
            <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">$</sup>
            <h1 class="display-5 mb-0 text-primary">99</h1>
            <sub class="fs-6 pricing-duration mt-auto mb-3">/month</sub>
          </div>
        </div>
        <ul class="ps-3 g-2 my-4">
          <li class="mb-2">10 Users</li>
          <li class="mb-2">Up to 10 GB storage</li>
          <li>Basic Support</li>
        </ul>
        <div class="d-flex justify-content-between align-items-center mb-1">
          <span>Days</span>
          <span>65% Completed</span>
        </div>
        <div class="progress mb-1" style="height: 8px;">
          <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <span>4 days remaining</span>
        <div class="d-grid w-100 mt-4 pt-2">
          <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan</button>
        </div>
      </div>
    </div> --}}
  </div>
  <div class="col-md-8">
    @if(count($list['recent']) > 0)
    <div class="card card-action mb-4">
      <div class="card-header">
        <div class="card-action-title">
          <h5>
            Pengaduan Belum Terselesaikan
          </h5>
        </div>
        <div class="card-action-element">
          <ul class="list-inline mb-0">
            <li class="list-inline-item">
              <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="card-body collapse show">
        <ul class="timeline timeline-dashed mt-3">
          @for ($i = 0; $i < count($list['recent']); $i++)
          <li class="timeline-item timeline-item-dark mb-4">
            {{-- <span class="timeline-indicator timeline-indicator-info">
              <i class="bx bx-bell"></i>
            </span> --}}
            @if (!empty($list['recent'][$i]->tgl_selesai) && empty($list['recent'][$i]->ket_penolakan))
              <span class="timeline-point" style="background-color: turquoise"></span>
            @elseif (!empty($list['recent'][$i]->ket_penolakan))
              <span class="timeline-point" style="background-color: red"></span>
            @elseif (empty($list['recent'][$i]->tgl_diterima))
              <span class="timeline-point" style="background-color: rebeccapurple"></span>
            @elseif (empty($list['recent'][$i]->tgl_dikerjakan))
              <span class="timeline-point" style="background-color: salmon"></span>
            @elseif (empty($list['recent'][$i]->tgl_selesai))
              <span class="timeline-point" style="background-color: orange"></span>
            @endif
            <div class="timeline-event">
              <div class="timeline-header border-bottom mb-3">
                <h6 class="mb-0"><strong>Lokasi : {{ $list['recent'][$i]->lokasi }}</strong></h6>
                <small class="text-muted">{{ \Carbon\Carbon::parse($list['recent'][$i]->tgl_pengaduan)->isoFormat('dddd, D MMMM Y, HH:mm a') }}</small>
              </div>
              <div class="d-flex flex-sm-row flex-column">
                @if (!empty($list['recent'][$i]->filename_pengaduan))
                  <img src="{{ url('storage/'.substr($list['recent'][$i]->filename_pengaduan,7,1000)) }}" class="rounded mb-sm-0 mb-3 me-3 zoom" alt="Failed Request" height="62" width="62" />
                @endif
                <div>
                  <div class="timeline-header flex-wrap mb-2">
                    <h6 class="mb-0"><strong>Status : </strong> 
                      @if (!empty($list['recent'][$i]->tgl_selesai) && empty($list['recent'][$i]->ket_penolakan))
                        <kbd style="background-color: turquoise">Selesai</kbd>
                      @elseif (!empty($list['recent'][$i]->ket_penolakan))
                        <kbd style="background-color: red">Ditolak</kbd>
                      @elseif (empty($list['recent'][$i]->tgl_diterima))
                        <kbd style="background-color: rebeccapurple">Diverifikasi</kbd>
                      @elseif (empty($list['recent'][$i]->tgl_dikerjakan))
                        <kbd style="background-color: salmon">Diterima</kbd>
                      @elseif (empty($list['recent'][$i]->tgl_selesai))
                        <kbd style="background-color: orange">Dikerjakan</kbd>
                      @endif
                    </h6>
                  </div>
                  <p>
                    {{ $list['recent'][$i]->ket_pengaduan }}
                  </p>
                </div>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap pb-0 px-0">
                  <div class="d-flex flex-sm-row flex-column align-items-center">
                    <div class="user-info">
                      <p class="my-0"><strong>Diterima : </strong>{{ \Carbon\Carbon::parse($list['recent'][$i]->tgl_diterima)->isoFormat('D MMM Y, HH:mm a') }}</p>
                      @if(!empty($list['recent'][$i]->ket_diterima))<span class="text-muted">{{ $list['recent'][$i]->ket_diterima }}</span>@endif
                    </div>
                  </div>
                  <button class="btn btn-dark btn-sm my-sm-0 my-3" onclick="window.location.href='{{ url('/v2/laporan/pengaduan/ipsrs/detail/'.$list['recent'][$i]->id) }}'">
                    Lihat&nbsp;&nbsp;<span class="badge bg-white text-dark">ID : {{ $list['recent'][$i]->id }}</span>
                  </button>
                </li>
              </ul>
            </div>
          </li>
          <li class="timeline-end-indicator">
            <i class="bx bx-info-circle"></i>
          </li>
          @endfor
        </ul>
      </div>
    </div>
    @endif
    <div class="card card-action mb-4">
      <div class="collapse show">
        <div class="card-datatable table-responsive">
          <table id="table" class="table table-striped display">
            <thead>
              <tr>
                <th><center>ID</center></th>
                <th>LOKASI</th>
                <th>STATUS</th>
                <th>TGL PENGADUAN</th>
                <th><center>AKSI</center></th>
              </tr>
            </thead>
            <tbody style="text-transform: capitalize">
              @if(count($list['show']) > 0)
                @foreach($list['show'] as $item)
                <tr>
                  <td>
                    <center>
                      <button type="button" class="btn btn-label-primary btn-sm" data-bs-toggle="modal" data-bs-target="#track{{ $item->id }}"><i class="fa-fw fas fa-search nav-icon"></i> {{ $item->id }}</button>
                    </center>
                  </td>
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
                      <div class="btn-group">
                        @if (empty($item->tgl_selesai))
                          @if (!empty($item->tgl_diterima))
                            <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                            @if (empty($item->filename_pengaduan))
                                <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @else
                                <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @endif
                            <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                          @else
                            <button type="button" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#ubah{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                            @if (empty($item->filename_pengaduan))
                                <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @else
                                <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                            @endif
                            <button type="button" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                          @endif
                        @else
                          <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                          @if (empty($item->filename_pengaduan))
                              <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-image nav-icon"></i></button>
                          @else
                              <button type="button" class="btn btn-info btn-sm text-white" onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button>
                          @endif
                          <button type="button" class="btn btn-secondary btn-sm text-white" disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
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
      </div>
    </div>
  </div>
</div>

{{-- MODAL START --}}
@foreach($list['show'] as $item)
<div class="modal fade" id="ubah{{ $item->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data <kbd>ID : {{ $item->id }}</kbd></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        {{ Form::model($item, array('route' => array('ipsrs.update', $item->id), 'method' => 'PUT', 'id' => 'formUbah')) }}
        @csrf
        <input type="text" name="id" value="{{ $item->id }}" hidden> 
        <div class="form-group mb-3">
          <label for="defaultFormControlInput" class="form-label">Lokasi</label>
          <input type="text" name="lokasi" class="form-control typeahead-bloodhound" value="{{ $item->lokasi }}" placeholder="Masukkan Lokasi" autocomplete="off" required/>
        </div>
        <div class="form-group mb-3">
          <label for="defaultFormControlInput" class="form-label">Pengaduan</label>
          <div class="form-group">
            <textarea rows="3" class="autosize1 form-control" name="pengaduan" placeholder="Deskripsi Pengaduan Anda" required><?php echo htmlspecialchars($item->ket_pengaduan); ?></textarea>
          </div>
        </div>
        {{-- <div class="form-group mb-3">
          <label for="defaultFormControlInput" class="form-label">Lampiran (Optional) : </label>
          <div class="form-group">
            <input type="file" name="file" id="imgInp" class="form-control">
            <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran foto</sub><br>
            <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan upload Foto/Gambar bukan Video, berformat <b>jpg,png,jpeg,gif</b> </sub>
            <center>
              <div class="card" style="width: 18rem;margin-top:20px">
                <img class="card-img-top" id="blah" src="#" alt="Tidak ada lampiran">
              </div>
            </center>
          </div>
        </div> --}}
        <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Apabila laporan sudah berada pada status <kbd style="background-color: salmon">DITERIMA</kbd> oleh IPSRS, anda tidak dapat lagi mengubah ataupun menghapus laporan ini.</sub>
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary pull-right" type="submit"><i class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
        {!! Form::close() !!}
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="track{{ $item->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tracking <kbd>ID : {{ $item->id }}</kbd></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-2 border rounded px-3">
                    <div class="d-flex flex-row justify-content-between align-items-center order">
                        <div class="d-flex flex-column order-details"><span><b>Pengaduan :</b> <br>{{ $item->ket_pengaduan }}</span><span class="date">Pada tgl {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM, YYYY HH:mm A') }}</span></div>
                    </div>                    
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
                    <th><button class="btn btn-label-dark btn-sm disabled" type="button">DITERIMA</button></th>
                    <td>{{ $item->tgl_diterima }}</td>
                    <td>{{ $item->ket_diterima }}</td>
                </tr>
                <tr>
                    <th><button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $item->id }}">DIKERJAKAN</button></th>
                    <td>{{ $item->tgl_dikerjakan }}</td>
                    <td>{{ $item->ket_dikerjakan }}</td>
                </tr>
                <tr>
                    <th><button class="btn btn-label-dark btn-sm disabled" type="button">SELESAI</button></th>
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
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Pengaduan&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><b>Laporan : </b>{{ $item->ket_pengaduan }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        @if(count($list) > 0)
          <form action="{{ route('ipsrs.destroy', $item->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus</button>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- MODAL END --}}
<script>$(document).ready( function () {
  $("html").addClass('layout-menu-collapsed');

  // AUTOCOMPLETE LOKASI
  var path = "{{ route('ac.ipsrs.lokasi') }}";
  $('.typeahead-bloodhound').typeahead({
    source:  function (query, process) {
    return $.get(path, { lokasi: query }, function (data) {
        return process(data);
      });
    }
  });

  $('.zoom').hover(function() {
    $(this).addClass('transisi');
  }, function() {
    $(this).removeClass('transisi');
  });

  $('#table').DataTable(
    {
      order: [[3, "desc"]],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [{
          extend: "collection",
          className: "btn btn-label-primary dropdown-toggle me-2",
          text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [{
              extend: "print",
              text: '<i class="bx bx-printer me-2" ></i>Print',
              className: "dropdown-item",
              // exportOptions: {
              //     columns: [3, 4, 5, 6, 7]
              // }
          }, {
              extend: "excel",
              text: '<i class="bx bxs-spreadsheet me-2"></i>Excel',
              className: "dropdown-item",
              autoFilter: true,
              attr: {id: 'exportButton'},
              sheetName: 'data',
              title: '',
              filename: 'Daftar Risiko K3'
          }, {
              extend: "pdf",
              text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
              className: "dropdown-item",
          }, {
              extend: "copy",
              text: '<i class="bx bx-copy me-2" ></i>Copy',
              className: "dropdown-item",
              // exportOptions: {
              //     columns: [3, 4, 5, 6, 7]
              // }
          },]
        }, 
        {
          extend: 'colvis',
          text: '<i class="bx bx-hide me-sm-2"></i> <span class="d-none d-sm-inline-block">Column</span>',
          className: "btn btn-label-primary modal me-2",
          // collectionLayout: 'dropdown-menu',
          // contentClassName: 'dropdown-item'
        }
      ],
      'columnDefs': [
          // { targets: 3, visible: false },
          // { targets: 5, visible: false },
          // { targets: 6, visible: false },
          // { targets: 9, visible: false },
          // { targets: 10, visible: false },
          // { targets: 11, visible: false },
          // { targets: 12, visible: false },
          // { targets: 16, visible: false },
      ],
    },
  );
  $("div.head-label").html('<h5 class="card-title mb-0">Daftar Pengaduan</h5>');

});

// FUNCTION
function showLampiran(id) {
  Swal.fire({
    // title: 'Lampiran ID : '+id,
    // text: '',
    imageUrl: '/v2/laporan/pengaduan/ipsrs/'+id,
    // imageWidth: 400,
    imageHeight: 275,
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
      window.location.href = "/v2/laporan/pengaduan/ipsrs/"+id;
    }
  })
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

function simpan() {
  $("#formTambah").one('submit', function() {
    //stop submitting the form to see the disabled button effect
    $("#btn-simpan").attr('disabled','disabled');
    $("#btn-simpan").find("i").toggleClass("fa-save fa-refresh fa-spin");

    return true;
  });
}

function clear() {
  
}

$("#imgInp").change(function(){
    readURL(this);
});
</script>
@endsection