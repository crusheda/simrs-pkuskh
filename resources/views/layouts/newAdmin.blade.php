<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIMRSMU - {{ Auth::user()->name }}</title>

  {{-- Logo PKU --}}
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/pku_ico.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/pku_ico.png') }}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <a name="top" class="top"></a> 
    <div class="main-wrapper main-wrapper-1">
      
      @include('pages.new.inc.navbar')
      @include('pages.new.inc.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            {{-- BREADCRUMB --}}
            @include('pages.new.inc.breadcrumb')
          </div>

          <div class="section-body">

            @yield('content')
          
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Develop By <a href="#">Yussuf Faisal</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  {{-- GOTO TOP --}}
  <a id="goTop" class="btn btn-dark text-white" style="
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 10px;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 15px;
    opacity: 100%;
    border-radius: 15px;
    background-color:#6777EF;
  ">
  <i class="fas fa-chevron-up"></i></a>
  <script>
    //Get the button
    var mybutton = document.getElementById("goTop");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    $('#goTop').on('click', function(e){
      $("html, body").animate({scrollTop: $(".top").offset().top}, 500);
    });
  </script>
</body>
</html>