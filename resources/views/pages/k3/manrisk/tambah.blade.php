@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pelaporan / Manajemen Risiko /</span> Tambah
</h4>
    
<div class="row">

  <!-- Form Separator -->
  <div class="col-xxl">
    <div class="card mb-4">
      <h5 class="card-header">Tambah</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Jenis Risiko</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
              {{-- <div id="defaultFormControlHelp" class="form-text">We'll never share your details with anyone else.</div> --}}
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Proses Utama</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Item Kegiatan</label>
            <div class="form-group">
              <textarea rows="3" class="autosize form-control" placeholder=""></textarea>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Jenis Aktivitas</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Kode Bahaya</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Sumber Bahaya</label>
              <input type="text" id="" class="form-control" placeholder="" />
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Risiko</label>
              <input type="text" id="" class="form-control" placeholder="" />
            </div>
          </div>
          <div class="col-md-12 mb-4">
            <label for="defaultFormControlInput" class="form-label">Pengendalian yang telah diterapkan</label>
            <div class="form-group">
              <textarea rows="3" class="autosize form-control" placeholder=""></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card mb-4">
          <div class="card-body">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Dampak</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4">
          <div class="card-body">
            <div class="form-group">
              <label for="defaultFormControlInput" class="form-label">Kemungkinan / Frekuensi</label>
              <select id="" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group mb-4">
              <label for="defaultFormControlInput" class="form-label">Nilai</label>
              <div class="input-group">
                <span class="input-group-text">Hasil dari Dampak * Frekuensi</span>
                <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group mb-4">
              <label for="defaultFormControlInput" class="form-label">Tingkat Risiko</label>
              <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<script>$(document).ready( function () {
  // AUTOSIZE TEXTAREA
  autosize(document.querySelector(".autosize"));
  // SELECT2
  var t = $(".select2");
  t.length && t.each(function() {
    var e = $(this);
    e.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Pilih",
      dropdownParent: e.parent()
    })
  })
  // DATEPICKER
  $(".dob-picker").flatpickr({
    monthSelectorType: "static"
  });
} );
</script>
@endsection