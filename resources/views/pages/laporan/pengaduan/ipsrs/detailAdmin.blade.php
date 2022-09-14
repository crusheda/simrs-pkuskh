@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Laporan / Pengaduan / IPSRS /</span> Detail
</h4>

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
  <div class="col-md-12">
    <a class="btn btn-label-dark mb-3" href="{{ route('ipsrs.index') }}"><i class="bx bx-chevron-left me-1"></i> Kembali</a>
  </div>
  <div class="col-md-3">
    <div class="card card-action mb-4">
      <div class="card-header">
        <div class="card-action-title">
          <h5>
            Lampiran
          </h5>
        </div>
        <div class="card-action-element">
          <span class="badge bg-primary">ID : {{ $list['show']->id }}</span>
        </div>
      </div>
      <div class="card-body">
        <center>
        @if (empty($list['show']->filename_pengaduan))
            <img class="card-img-top img-thumbnail border mb-4" src="{{ url('img/no_image.jpg') }}" style="height: 210px;width: auto" alt="Foto Pengaduan">
            <button class="btn btn-primary" disabled>Download</button>
        @else
            <img class="card-img-top img-thumbnail border mb-4" src="{{ url('storage/'.substr($list['show']->filename_pengaduan,7,1000)) }}" style="height: 210px;width: auto" alt="Foto Pengaduan">
            <button class="btn btn-primary" onclick="window.location.href='{{ url('v2/laporan/pengaduan/ipsrs/'. $list['show']->id) }}'"><i class="bx bx-download"></i> Download</button>
        @endif
        </center>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="card card-action mb-4">
      <div class="card-header">
        <div class="card-action-title">
          <h5>
            Pengaduan
          </h5>
        </div>
        <div class="card-action-element">
          <h6>{{ \Carbon\Carbon::parse($list['show']->tgl_pengaduan)->isoFormat('D MMM Y, HH:mm a') }}</h6>
        </div>
      </div>
      <div class="row card-body">
        <div class="col-md-8 order-md-0 order-0">
          <div class="mb-4">
            <h6 class="fw-semibold mb-2">Pelapor :</h6>
            <p>
              {{ $list['show']->nama }} ({{ str_replace(str_split('[]"'),'',$list['show']->unit) }})
            </p>
          </div>
          <div class="mb-4">
            <h6 class="fw-semibold mb-2">Lokasi :</h6>
            <p>{{ $list['show']->lokasi }}</p>
          </div>
          <div class="mb-4">
            <h6 class="fw-semibold mb-2">Laporan :</h6>
            <p>{{ $list['show']->ket_pengaduan }}</p>
          </div>
        </div>
        <div class="col-md-4 order-md-1 order-1">
          <div class="text-center mt-4 mx-3 mx-md-0">
            <img src="{{ asset('assets-new/img/illustrations/sitting-girl-with-laptop-light.png') }}" class="img-fluid" alt="Api Key Image" width="350" data-app-light-img="illustrations/sitting-girl-with-laptop-light.png" data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.html">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="bs-stepper wizard-vertical vertical wizard-vertical-icons-example mt-2">
      <div class="bs-stepper-header">
        <div class="step @if($list['show']->tgl_diterima == null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null && $list['show']->ket_penolakan == null) active @endif" id="step1" data-target="#verif">
          <button type="button" class="step-trigger" disabled>
            <span class="bs-stepper-circle">
              <i class="bx bx-paper-plane"></i>
            </span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Verifying</span>
              <span class="bs-stepper-subtitle">Laporan diterima / Ditolak</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null && $list['show']->ket_penolakan == null) active @endif" id="step2" data-target="#process">
          <button type="button" class="step-trigger" disabled>
            <span class="bs-stepper-circle">
              <i class="bx bx-wrench"></i>
            </span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Processing</span>
              <span class="bs-stepper-subtitle">Pengerjaan Laporan</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan != null && $list['show']->tgl_selesai == null && $list['show']->ket_penolakan == null) active @endif" id="step3" data-target="#finish">
          <button type="button" class="step-trigger" disabled>
            <span class="bs-stepper-circle">
              <i class="bx bx-check-double"></i>
            </span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Finishing</span>
              <span class="bs-stepper-subtitle">Penyelesaian Laporan</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step @if($list['show']->tgl_selesai != null) active @endif" id="step4" data-target="#result">
          <button type="button" class="step-trigger" disabled>
            <span class="bs-stepper-circle">
              <i class="bx bx-check-double"></i>
            </span>
            <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Result</span>
              <span class="bs-stepper-subtitle">Hasil Laporan</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <!-- VERIFYING -->
        <div id="verif" class="content @if($list['show']->tgl_diterima == null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null && $list['show']->ket_penolakan == null) active dstepper-block @endif">
          <div class="content-header mb-3">
            <h6 class="mb-0">Verifying</h6>
            <small>Proses Verifikasi Laporan menjadi Status <kbd style="background-color: salmon">DITERIMA</kbd></small>
          </div>
          <div class="row g-3">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Keterangan Tolak / Terima Laporan</label>
              <div class="form-group">
                <textarea rows="3" class="autosize1 form-control" name="ket" id="ket" placeholder="Tuliskan Keterangan" required></textarea>
              </div>
            </div>
            <div class="divider" style="margin-bottom:-5px">
              <div class="divider-text">Tolak / Terima Laporan</div>
            </div>
            <div class="col-12 d-flex justify-content-between">
              <a class="btn btn-danger" href="javascript:void(0);" onclick="tolak({{ $list['show']->id }})">
                <i class="fas fa-thumbs-down"></i>
                <span class="align-middle d-sm-inline-block d-none">&nbsp;Tolak</span>
              </a>
              <a class="btn btn-primary" href="javascript:void(0);" onclick="terima({{ $list['show']->id }})">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Terima&nbsp;</span>
                <i class="fas fa-thumbs-up"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- PROCESSING -->
        <div id="process" class="content @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null && $list['show']->ket_penolakan == null) active dstepper-block @endif">
          <div class="content-header mb-3">
            <h6 class="mb-0">Processing</h6>
            <small>Proses Pengerjaan Laporan menjadi status <kbd style="background-color: orange">DIKERJAKAN</kbd></small>
          </div>
          <div class="row g-3">
            <div class="col-md-8">
              <div class="form-group">
                <label for="defaultFormControlInput" class="form-label">Keterangan Awal Pengerjaan</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize1 form-control" id="ket_pengerjaan" placeholder="Masukkan Keterangan Awal Pengerjaan" required></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="defaultFormControlInput" class="form-label">Estimasi Penyelesaian</label>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Tambahkan Estimasi Waktu (Optional)" id="estimasi" />
                  <sub><strong>Nb. </strong>Untuk menambahkan Catatan Pengerjaan pada Sub Halaman Selanjutnya, Silakan klik Kerjakan di bawah ini.</sub>
                </div>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-between">
              <h6></h6>
              <button class="btn btn-label-warning" onclick="kerjakan({{ $list['show']->id }})">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Kerjakan</span>
                <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- FINISHING -->
        <div id="finish" class="content @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan != null && $list['show']->tgl_selesai == null && $list['show']->ket_penolakan == null) active dstepper-block @endif">
          <div class="content-header mb-3">
            <h6 class="mb-0">Finishing</h6>
            <small>Proses Penyelesaian Laporan Pengaduan IPSRS menjadi status  <kbd style="background-color: turquoise">SELESAI</kbd></small>
          </div>
          <div class="row g-3">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Keterangan Laporan Selesai</label>
              <div class="form-group">
                <textarea rows="3" class="autosize1 form-control" id="ket_selesai" placeholder="Tuliskan Keterangan untuk Laporan Selesai" required></textarea>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-between">
              <button class="btn btn-label-warning" data-bs-toggle="modal" data-bs-target="#catatan">
                <i class="bx bx-note bx-sm ms-sm-n2"></i>
                <span class="align-middle d-sm-inline-block d-none">Catatan Pengerjaan</span>
              </button>
              <button class="btn text-white btn-submit" style="background-color: turquoise" onclick="selesai({{ $list['show']->id }})"><i class="bx bx-check-double"></i> Laporan Selesai</button>
            </div>
          </div>
        </div>
        <!-- RESULT -->
        <div id="result" class="content @if($list['show']->tgl_selesai != null) active dstepper-block @endif">
          <div class="content-header mb-3">
            <h6 class="mb-0">Result</h6>
            <small>Hasil Laporan Pengerjaan IPSRS</small>
          </div>
          <div class="divider" style="margin-top:-10px">
            <div class="divider-text">Hasil Akhir Laporan</div>
          </div>
          <div class="row g-3" id="tampil-result"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- MODAL START --}}
<div class="modal fade" id="catatan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Catatan Pengerjaan Laporan <small><kbd>ID : {{ $list['show']->id }}</kbd></small></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          {{ Form::model($list['show'], array('route' => array('pengaduan.ipsrs.catatan', $list['show']->id), 'method' => 'POST', 'enctype' => 'multipart/form-data','id' => 'formCatatan')) }}
            @csrf
            <input type="text" name="id_pengaduan" value="{{ $list['show']->id }}" hidden>
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Tambah Catatan</label>
              <textarea rows="3" class="autosize1 form-control" name="ket_catatan" id="ket_catatan" placeholder="Masukkan Catatan" required></textarea>
            </div>
            <div class="form-group mb-3">
              <label for="defaultFormControlInput" class="form-label">Lampiran (Optional) : </label>
              <input type="file" name="file" id="imgInp" class="form-control">
            </div>
            <div class="col-12 d-flex justify-content-between">
              <h6><sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran foto</sub></h6>
              <button type="submit" class="btn btn-label-warning" id="btn-simpan-catatan"><i class="fa fa-save"></i>&nbsp;&nbsp;Tambah</button>
            </div>
          {{ Form::close() }}
          <div class="divider">
            <div class="divider-text">Daftar Catatan</div>
          </div>
          <div class="table-responsive">
              <table id="dikerjakan" class="table table-striped display">
                  <thead>
                      <tr>
                          <th>Keterangan</th>
                          <th>File</th>
                          <th>Tgl</th>
                          <th><center>AKSI</center></th>
                      </tr>
                  </thead>
                  <tbody style="text-transform: capitalize">
                      @if(count($list['catatan']) > 0)
                      @foreach($list['catatan'] as $val)
                      <tr>
                          <td>{{ $val->keterangan }}</td>
                          <td>{{ $val->title }}</td>
                          <td>{{ $val->created_at }}</td>
                          <td>
                            <center>
                              <div class="btn-group">
                                {{-- Tombol Ubah --}}
                                <button type="button" class="btn btn-warning btn-sm" data-bs-target="#ubahCatatan{{ $val->id }}" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                {{-- Tombol Download --}}
                                @if (!empty($val->title))
                                  <button class="btn btn-success btn-sm" onclick="window.location.href='{{ url('v2/laporan/pengaduan/ipsrs/catatan/'. $val->id) }}'"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                @else
                                  <button class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-download nav-icon"></i></button>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
@foreach($list['catatan'] as $item)
<div class="modal fade" id="ubahCatatan{{ $item->id }}" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="modalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalToggleLabel2">Ubah Catatan <small><kbd>ID : {{ $item->id }}</kbd></small></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      {{ Form::model($list['show'], array('route' => array('pengaduan.ipsrs.ubahCatatan', $list['show']->id), 'method' => 'POST', 'enctype' => 'multipart/form-data')) }}
      <div class="modal-body">
        @csrf
        <input type="text" name="id_catatan" value="{{ $item->id }}" hidden>
        <div class="form-group mb-3">
          <label for="defaultFormControlInput" class="form-label">Catatan</label>
          <textarea rows="3" class="autosize1 form-control" name="ket_catatan" placeholder="Masukkan Catatan" required><?php echo htmlspecialchars($item->keterangan); ?></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="defaultFormControlInput" class="form-label">Lampiran (Optional) : </label>
          <input type="file" name="file" id="imgInp" class="form-control">
        </div>
        <h6><sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran foto</sub></h6>
      </div>
      <div class="modal-footer">
        <a class="btn btn-label-secondary" href="javascript:void(0);" data-bs-target="#catatan" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Kembali</a>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@endforeach
{{-- MODAL END --}}
<script>
$(document).ready( function () {
  $.ajax(
    {
      url: "/api/laporan/pengaduan/ipsrs/result/{{ $list['show']->id }}",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        // Tampil Result setelah Selesai Laporan
        $("#tampil-result").empty();
        if (res.show[0].ket_penolakan == null) {
        res.show.forEach(item => {
          content = `<div class="col-md-8">
                      <small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Verifikasi</small>
                      <ul class="list-unstyled mb-1 mt-3">
                        <li class="d-flex align-items-center mb-2"><strong>`+item.ket_diterima+`</strong></li>
                        <li class="d-flex align-items-center mb-4"><sub>`+item.tgl_diterima+`</sub></li>
                      </ul>
                      <small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Pengerjaan</small>
                      <ul class="list-unstyled mb-1 mt-3">
                        <li class="d-flex align-items-center mb-2"><strong>`+item.ket_dikerjakan+`</strong></li>
                        <li class="d-flex align-items-center mb-4"><sub>`+item.tgl_dikerjakan+`</sub></li>
                      </ul>
                      <small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Selesai</small>
                      <ul class="list-unstyled mb-1 mt-3">
                        <li class="d-flex align-items-center mb-2"><strong>`+item.ket_selesai+`</strong></li>
                        <li class="d-flex align-items-center mb-4"><sub>`+item.tgl_selesai+`</sub></li>
                      </ul>
                    </div>`;
          })
          content += `<div class="col-md-4"><small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Catatan Pengerjaan</small>`;
          res.catatan.forEach(item => {
            content += `<ul class="list-unstyled mb-1 mt-3">
                          <li class="d-flex align-items-center mb-2"><strong>`+item.keterangan+`</strong></li>
                          <li class="d-flex align-items-center mb-4"><sub>`+item.updated_at+`</sub></li>
                        </ul>`;
          })
          content += `</div>`;
        } else {
          content = `<div class="col-md-12 mt-2">
                        <h3><kbd style="background-color: red">Laporan Ditolak</kbd></h3>
                        <h5>Alasan Penolakan :</h5>
                        <h6><i class="fas fa-chevron-right"></i> `+res.show[0].ket_penolakan+`</h6>
                      </div>`;
        }
        $('#tampil-result').append(content);
      }
    }
  );
  
  const l = document.querySelector("#estimasi");
  const c = new Date(Date.now() - 1728e5)
      , m = new Date(Date.now());
  l.flatpickr({
      dateFormat: "Y-m-d",
      disable: [{
        from: "2000-01-01",
        to: m.toISOString().split("T")[0]
      }]
  })

  $("#formCatatan").one('submit', function() {
      //stop submitting the form to see the disabled button effect
      $("#btn-simpan-catatan").attr('disabled','disabled');
      $("#btn-simpan-catatan").find("i").toggleClass("fa-save fa-spinner fa-spin");

      return true;
  });
  $("html").addClass('layout-menu-collapsed');
});

// FUNCTION-FUNCTION 
function terima(id) {
  var ket = $("#ket").val();
  if (ket == "") {
      iziToast.error({
        title: 'Pesan Galat!',
        message: 'Keterangan Wajib Diisi',
        position: 'topRight'
      });
  } else {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: '/api/laporan/pengaduan/ipsrs/verif/'+id, 
      dataType: 'json', 
      data: { 
        id: id,
        ket: ket,
      }, 
      success: function(res) {
        iziToast.success({
          title: 'Sukses!',
          message: 'Verifikasi Laporan Berhasil Diterima Oleh '+res,
          position: 'topRight'
        });
        $("#step1").removeClass('active');
        $("#verif").removeClass('active dstepper-block');
        $("#step2").addClass('active');
        $("#process").addClass('active dstepper-block');
      }
    });
  }
}

function tolak(id) {
  var ket = $("#ket").val();
  if (ket == "") {
      iziToast.error({
        title: 'Pesan Galat!',
        message: 'Keterangan Wajib Diisi',
        position: 'topRight'
      });
  } else {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: '/api/laporan/pengaduan/ipsrs/unverif/'+id, 
      dataType: 'json', 
      data: { 
        id: id,
        ket: ket,
      }, 
      success: function(res) {
        iziToast.success({
          title: 'Sukses!',
          message: 'Verifikasi Laporan Berhasil Ditolak Oleh '+res.name,
          position: 'topRight'
        });
        $("#step1").removeClass('active');
        $("#verif").removeClass('active dstepper-block');
        $("#step4").addClass('active');
        $("#result").addClass('active dstepper-block');

        // Tampil Result setelah Selesai Laporan
        $("#tampil-result").empty();
        content = `<div class="col-md-12 mt-4">
                      <h3><kbd style="background-color: red">Laporan Ditolak</kbd></h3>
                      <h5>Alasan Penolakan :</h5>
                      <h6><i class="fas fa-chevron-right"></i> `+res.tolak+`</h6>
                    </div>`;
        $('#tampil-result').append(content);
      }
    });
  }
}

function kerjakan(id) {
  var ket_pengerjaan = $("#ket_pengerjaan").val();
  var estimasi = $("#estimasi").val();
  
  if (ket_pengerjaan == "") {
      iziToast.error({
        title: 'Pesan Galat!',
        message: 'Keterangan Pengerjaan Wajib Diisi',
        position: 'topRight'
      });
  } else {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: '/api/laporan/pengaduan/ipsrs/process/'+id, 
      dataType: 'json', 
      data: { 
        id: id,
        ket_pengerjaan: ket_pengerjaan,
        estimasi: estimasi,
      }, 
      success: function(res) {
        iziToast.success({
          title: 'Sukses!',
          message: 'Laporan Mulai Dikerjakan Oleh '+res,
          position: 'topRight'
        });
        $("#step2").removeClass('active');
        $("#process").removeClass('active dstepper-block');
        $("#step3").addClass('active');
        $("#finish").addClass('active dstepper-block');
      }
    });
  }
}

function selesai(id) {
  var ket_selesai = $("#ket_selesai").val();
  
  if (ket_selesai == "") {
      iziToast.error({
        title: 'Pesan Galat!',
        message: 'Keterangan Selesai Laporan Wajib Diisi',
        position: 'topRight'
      });
  } else {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: '/api/laporan/pengaduan/ipsrs/finish/'+id, 
      dataType: 'json', 
      data: { 
        id: id,
        ket_selesai: ket_selesai,
      }, 
      success: function(res) {
        iziToast.success({
          title: 'Selamat!',
          message: 'Laporan Berhasil Diselesaikan Oleh '+res.name,
          position: 'topRight'
        });
        $("#step3").removeClass('active');
        $("#finish").removeClass('active dstepper-block');
        $("#step4").addClass('active');
        $("#result").addClass('active dstepper-block');

        // Tampil Result setelah Selesai Laporan
        $("#tampil-result").empty();
        res.show.forEach(item => {
          content = `<div class="col-md-8">
                      <small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Verifikasi</small>
                      <ul class="list-unstyled mb-3 mt-3">
                        <li class="d-flex align-items-center"><strong>`+item.ket_diterima+`</strong></li>
                        <li class="d-flex align-items-center"><small>`+item.tgl_diterima+`</small></li>
                      </ul>
                      <small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Pengerjaan</small>
                      <ul class="list-unstyled mb-3 mt-3">
                        <li class="d-flex align-items-center"><strong>`+item.ket_dikerjakan+`</strong></li>
                        <li class="d-flex align-items-center"><small>`+item.tgl_dikerjakan+`</small></li>
                      </ul>
                      <small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Selesai</small>
                      <ul class="list-unstyled mb-3 mt-3">
                        <li class="d-flex align-items-center"><strong>`+item.ket_selesai+`</strong></li>
                        <li class="d-flex align-items-center"><small>`+item.tgl_selesai+`</small></li>
                      </ul>
                    </div>`;
        })
        content += `<div class="col-md-4"><small class="text-muted text-uppercase"><i class="fas fa-chevron-right"></i> Catatan Pengerjaan</small>`;
        res.catatan.forEach(item => {
          content += `<ul class="list-unstyled mb-3 mt-3">
                        <li class="d-flex align-items-center"><strong>`+item.keterangan+`</strong></li>
                        <li class="d-flex align-items-center"><small>`+item.updated_at+`</small></li>
                      </ul>`;
        })
        content += `</div>`;
        $('#tampil-result').append(content);
      }
    });
  }
}
</script>
@endsection