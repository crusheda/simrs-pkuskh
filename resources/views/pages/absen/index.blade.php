@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  {{-- <span class="text-muted fw-light">Absensi Online /</span>   --}}
  Absensi Online
</h4>
  
{{-- <button type="button" class="btn btn-label-dark mb-3" onclick="window.location.href='{{ route('beranda.index') }}'"><i class="bx bx-chevron-left me-1"></i> Kembali</button> --}}
<div class="card mb-4">
  {{-- <h5 class="card-header"></h5> --}}
  <div class="card-body">
    <div class="leaflet-map" id="absen"></div>
  </div>
</div>

{{-- MODAL START --}}
{{-- <div class="modal fade" id="maintenance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-5">On Process</h3>
        </div>
        <center><h5>Mohon Maaf, fitur sedang dalam Perbaikan <hr>Akan segera Ada! Stay Tune!</h5></center>
      </div>
    </div>
  </div>
</div> --}}
{{-- MODAL END --}}

<script>
$(document).ready( function () {
  // var map = document.getElementById("absen");
  const n = L.map("absen",{
    minZoom: 16,
    maxZoom: 16
  }).setView([42.35, -71.08], 10);
  
  n.dragging.disable();
  n.on('locationfound', onLocationFound);
  n.locate({setView: true, watch: true, maxZoom: 16});

  L.tileLayer("https://{s}.tile.osm.org/{z}/{x}/{y}.png", {
      // attribution: '',
      maxZoom: 18
  }).addTo(n);

// FUNCTION
  function onLocationFound(e) {
    var radius = 100; // e.accuracy / 2
    var lat = e.latitude;
    var long = e.longitude;

    L.marker(e.latlng).addTo(n).bindPopup("Anda berada di Latitude " + lat + " dan Longitude " + long + ".").openPopup();
    L.circle(e.latlng, radius).addTo(n);
  }
});
</script>
@endsection