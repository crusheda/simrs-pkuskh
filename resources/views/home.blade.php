@extends('layouts.admin')

@section('content')

    @if ($list['user']->nik == null)   
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
    @endif
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
