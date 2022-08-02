<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex">

    <div class="logo mr-auto">
      <h1 class="text-light">
        {{-- <a href="index.html"><span>Scaffold</span></a> --}}
        <img src="{{ asset('img/logo/pku/logo-1-sm-green.png') }}" style="margin-top: -5px" alt="">
        {{-- <img src="img/logo/pku/logo-admin.png" alt=""> --}}
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li><a href="{{ route('portal') }}">Beranda</a></li>
        <li class="drop-down"><a href="">Profil</a>
          <ul>
            <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
            <li><a href="{{ route('visimisi') }}">Visi & Misi</a></li>
            <li class="drop-down"><a href="#">Struktur Organisasi</a>
              <ul>
                <li><a href="#">Struktur Organisasi</a></li>
                <li><a href="#">Direksi</a></li>
                <li><a href="#">Satuan Pengawas Internal</a></li>
                <li><a href="#">Supervisor</a></li>
                <li><a href="#">Komite</a></li>
              </ul>
            </li>
            <li><a href="#about">Sumber Daya Manusia</a></li>
          </ul>
        </li>
        <li class="drop-down"><a href="">Informasi</a>
          <ul>
            <li><a href="#about">Jadwal Pelayanan</a></li>
            <li><a href="#team">Dokter Spesialis</a></li>
            <li><a href="#testimonials">Indikator Mutu</a></li>
            <li><a href="#testimonials">PPI</a></li>
            <li class="drop-down"><a href="#">PKRS</a>
              <ul>
                <li><a href="#">Poster Kesehatan</a></li>
                <li><a href="#">Mutiara Hikmah</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="drop-down"><a href="">Fasilitas</a>
          <ul>
            <li><a href="#about">Fasilitas Medik</a></li>
            <li><a href="#team">Fasilitas Penunjang</a></li>
            <li class="drop-down"><a href="#">Kamar Perawatan</a>
              <ul>
                <li><a href="#">Dewasa</a></li>
                <li><a href="#">Anak</a></li>
                <li><a href="#">Kebidanan</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="#pricing">Lowongan Kerja</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>

      </ul>
    </nav><!-- .nav-menu -->

    <div class="header-social-links">
      <a type="button" class="btn btn-danger btn-sm text-white mx-2" href="tel:0271593979">&nbsp;<i class="fas fa-phone"></i>&nbsp;&nbsp;IGD 24 JAM&nbsp;&nbsp;</a>
      {{-- <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
      <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
      <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
      <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a> --}}
    </div>

  </div>
</header><!-- End Header -->