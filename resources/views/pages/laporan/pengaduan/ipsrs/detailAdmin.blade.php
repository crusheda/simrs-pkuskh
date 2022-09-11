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
    <a class="btn btn-dark mb-3" href="{{ route('ipsrs.index') }}"><i class="bx bx-chevron-left me-1"></i> Kembali</a>
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
            <button class="btn btn-primary" onclick="window.location.href='{{ url('v2/laporan/pengaduan/ipsrs/'. $list['show']->id) }}'">Download</button>
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
        <div class="step @if($list['show']->tgl_diterima == null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null) active @endif" id="step1" data-target="#verif">
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
        <div class="step @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null) active @endif" id="step2" data-target="#process">
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
        <div class="step @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan != null && $list['show']->tgl_selesai == null) active @endif" id="step3" data-target="#finish">
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
      </div>
      <div class="bs-stepper-content">
        <!-- Account Details -->
        <div id="verif" class="content @if($list['show']->tgl_diterima == null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null) active dstepper-block @endif">
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
        <!-- Personal Info -->
        <div id="process" class="content @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan == null && $list['show']->tgl_selesai == null) active dstepper-block @endif">
          <div class="content-header mb-3">
            <h6 class="mb-0">Processing</h6>
            <small>Proses Pengerjaan Laporan menjadi status <kbd style="background-color: orange">DIKERJAKAN</kbd></small>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group">
                <label for="defaultFormControlInput" class="form-label">Keterangan Awal Pengerjaan</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize1 form-control" name="ket" id="ket" placeholder="Tambahkan Keterangan Awal Pengerjaan" required></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="defaultFormControlInput" class="form-label">Keterangan Tolak / Terima Laporan</label>
                <div class="form-group">
                  <textarea rows="3" class="autosize1 form-control" name="ket" id="ket" placeholder="Tuliskan Keterangan" required></textarea>
                </div>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-between">
              <button class="btn btn-primary btn-prev">
                <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
              </button>
              <button class="btn btn-primary btn-next">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- Social Links -->
        <div id="finish" class="content @if($list['show']->tgl_diterima != null && $list['show']->tgl_dikerjakan != null && $list['show']->tgl_selesai == null) active dstepper-block @endif">
          <div class="content-header mb-3">
            <h6 class="mb-0">Social Links</h6>
            <small>Enter Your Social Links.</small>
          </div>
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label" for="twitter1">Twitter</label>
              <input type="text" id="twitter1" class="form-control" placeholder="https://twitter.com/abc" />
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="facebook1">Facebook</label>
              <input type="text" id="facebook1" class="form-control" placeholder="https://facebook.com/abc" />
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="google1">Google+</label>
              <input type="text" id="google1" class="form-control" placeholder="https://plus.google.com/abc" />
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="linkedin1">Linkedin</label>
              <input type="text" id="linkedin1" class="form-control" placeholder="https://linkedin.com/abc" />
            </div>
            <div class="col-12 d-flex justify-content-between">
              <button class="btn btn-primary btn-prev">
                <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                <span class="align-middle d-sm-inline-block d-none">Previous</span>
              </button>
              <button class="btn btn-success btn-submit">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- MODAL START --}}
{{-- MODAL END --}}
<script>
$(document).ready( function () {
  // if ("{{ $list['show']->tgl_diterima }}" !== null) {
  //   $("#step1").removeClass('active');
  //   $("#verif").removeClass('active dstepper-block');
  //   $("#step2").addClass('active');
  //   $("#process").addClass('active dstepper-block');
  //     console.log('VERIF');
  // } else {
  //     console.log('PROCESS');
  //   if ("{{ $list['show']->tgl_dikerjakan }}" !== null) {
  //     $("#step1").removeClass('active');
  //     $("#verif").removeClass('active dstepper-block');
  //     $("#step3").addClass('active');
  //     $("#finish").addClass('active dstepper-block');
  //   } else {
  //     console.log('FINISH!');
  //   }
  // }

  // const t = document.querySelector(".wizard-vertical-icons-example");
  // if (t,
  // null !== t) {
  //   const o = [].slice.call(t.querySelectorAll(".btn-next"))
  //     , s = [].slice.call(t.querySelectorAll(".btn-prev"))
  //     , d = t.querySelector(".btn-submit")
  //     , u = new Stepper(t,{
  //       linear: !1
  //   });
  //   o && o.forEach(e=>{
  //       e.addEventListener("click", e=>{
  //           u.next()
  //       }
  //       )
  //   }
  //   ),
  //   s && s.forEach(e=>{
  //       e.addEventListener("click", e=>{
  //           u.previous()
  //       }
  //       )
  //   }
  //   ),
  //   d && d.addEventListener("click", e=>{
  //       alert("Submitted..!!")
  //   }
  //   )
  // }
  // const l = document.querySelector(".wizard-modern-icons-example");
    
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
  alert(ket);
}
</script>
@endsection