@extends('layouts.admin')

@section('content')
<div class="row">
  {{-- ISI PROFIL --}}
  @if ($list['user']->nik == null)   
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
              <i class="fa-fw fas fa-warning nav-icon text-danger">

              </i> <b>PENGUMUMAN</b>
          </div>
          <div class="card-body">
              <h6>Dimohon kepada seluruh karyawan untuk segera melengkapi Dokumen Profil Karyawan pada <b>Halaman Profil</b> setiap masing-masing akun. Apabila ditemukan kesalahan maupun kesulitan, silakan hubungi IT. Terima Kasih.</h6>
          </div>
          <div class="card-footer">
              <a class="btn btn-dark pull-right" href="user">Lengkapi Sekarang</a>
          </div>
      </div>
    </div>
  @endif
  <div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <i class="fa-fw fas fa-upload nav-icon text-primary">

            </i> <b>Upload Dokumen RKA</b>
        </div>
        <div class="card-body">
            <h6>Upload Rencana Kerja dan Anggaran 2022 Rumah Sakit PKU muhammadiyah Sukoharjo</h6>
        </div>
        <div class="card-footer">
            <a class="btn btn-success pull-right" href="perencanaan">Upload Sekarang</a>
        </div>
    </div>
  </div>

  {{-- LOG PERAWAT --}}
  @role('kabag-keperawatan')
  @else
    @can('log_perawat')
    <div class="col-md-3">
      @if ($list['recentLogPerawat'] == 0)
        <div class="card">
          <div class="card-header">
              <i class="fa-fw fas fa-check nav-icon text-success">

              </i> <b>Tindakan Harian Perawat</b>
          </div>
          <div class="card-body">
              <h6>Anda <kbd>Sudah Mengisi</kbd> Tindakan Hari Ini.</h6>
          </div>
          <div class="card-footer">
              <button class="btn btn-secondary pull-right" disabled>Masukkan Tindakan</button>
          </div>
        </div>
      @elseif ($list['recentLogPerawat'] == 1)
        <div class="card">
          <div class="card-header">
              <i class="fa-fw fas fa-warning nav-icon text-danger">

              </i> <b>Tindakan Harian Perawat</b>
          </div>
          <div class="card-body">
              <h6>Anda <kbd style="background-color: rgb(223, 29, 29)">Belum Mengisi</kbd> Tindakan Hari Ini.</h6>
          </div>
          <div class="card-footer">
              <a class="btn btn-primary pull-right" href="{{ route('tdkperawat.index') }}">Masukkan Tindakan</a>
          </div>
        </div>
      @elseif ($list['recentLogPerawat'] == 2)
      @endif
    </div>
    @endcan
  @endrole
</div>
    {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('img/slide/slide1.jpg') }}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/slide/slide2.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/slide/slide3.jpg') }}" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div> --}}

<script>
    $(document).ready( function () {
        $('#tablebug').DataTable(
            {
                paging: true,
                searching: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[ 4, "desc" ]]
            }
        );
        $('.carousel').carousel();
    } );
</script>

@endsection
