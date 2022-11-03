<html lang="en" class="light-style  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../../../../../../../../assets-new/" data-template="vertical-menu-template">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Simrsmu v2 - Absensi</title>
  
  <meta name="description" content="Sistem Manajemen Rumah Sakit PKU Muhammadiyah Sukoharjo" />
  <meta name="keywords" content="simrs, simrsmu, sim rspkuskh, pkuskh, rspkuskh, sistem pku">

  <!-- Canonical SEO -->
  <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">
  
  <!-- App favicon -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/pku_ico.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/pku_ico.png') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/fonts/flag-icons.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets-new/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/typeahead-js/typeahead.css') }}" />
  <!-- Vendor -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}" />
  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/css/pages/page-auth.css') }}">
  <!-- Helpers -->
  <script src="{{ asset('assets-new/vendor/js/helpers.js') }}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="{{ asset('assets-new/vendor/js/template-customizer.js') }}"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('assets-new/js/config.js') }}"></script>
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
  <script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
  </script>
  <!-- Custom notification for demo -->
  <!-- beautify ignore:end -->

</head>

<body>
  {{-- @if ($agent->isMobile()) --}}
  <div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">

      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
        <div class="w-100 d-flex justify-content-center">
          <img src="{{ asset('assets-new/img/illustrations/boy-with-rocket-light.png') }}" class="img-fluid" alt="Login image" width="600">

        </div>
      </div>
      <!-- /Left Text -->

      <!-- Two Steps Verification -->
      <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-4 p-sm-5">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <div class="app-brand mb-4" style="justify-content:center">
            <a href="javascript:void(0);" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('img/pku_ico.png') }}" alt="">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder" style="color: #333333">&nbsp;&nbsp;simrs<b style="color: #696CFF">mu</b></span>
            </a>
          </div>
          <!-- /Logo -->
          <center><a id="jam" class="mb-0" style="font-size:2rem"></a></center>
          <div class="divider my-2">
            <div class="divider-text"><h4 style="margin-top: 15px">Absensi Karyawan</h4></div>
          </div>
          <p class="text-start mb-3">
            <span class="d-block mt-2">1. Pastikan HP terkoneksi pada jaringan Wifi Rumah Sakit</span>
          </p>
          <div class="input-group mb-3">
            <span class="input-group-text">IP Address</span>
            <input type="text" class="form-control" value="{{ Request::ip() }}" placeholder="URL" disabled/>
            <input type="text" id="ip" value="{{ Request::ip() }}" hidden>
          </div>
          <p class="text-start mb-3">
            <span class="d-block mt-2">2. Silakan Selfi wajah Anda sebagai Bukti Absensi</span>
          </p>
          <center><input type="file" class="form-control mb-4" name="photo" capture="user" accept="image/*"></center>
          <center><div class="btn-group mb-3">
            <button class="btn btn-label-secondary" onclick="window.location.href='{{ route('welcome') }}'"><i class="fas fa-chevron-left"></i></button>
            <button class="btn btn-primary btn-block" onclick="absen()">
              Validasi
            </button>
          </div></center>
          <div class="text-center">Gagal absen?
            <a href="javascript:void(0);">
              Hubungi IT
            </a>
          </div>
        </div>
      </div>
      <!-- /Two Steps Verification -->
    </div>
  </div>

  <!-- / Content -->
  
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('assets-new/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  
  <script src="{{ asset('assets-new/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  
  <script src="{{ asset('assets-new/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->
  
  <!-- Page JS -->
  <script src="{{ asset('js/iziToast.js') }}"></script>

  <!-- Vendors JS -->
  <script src="{{ asset('assets-new/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets-new/js/main.js') }}"></script>
  
  <script>
    $(document).ready( function () {
    })

    function absen() {
      var params = $("#ip").val();
      if (params === '127.0.0.1') {
        iziToast.success({
          title: 'Yeayy!',
          message: 'Absensi Berhasil pada ',
          position: 'topRight'
        });
      } else {
        iziToast.error({
          title: 'Gagal!',
          message: 'Anda tidak terkoneksi pada Jaringan Wifi RSPKUSKH.',
          position: 'topRight'
        });
      }
      // IP WIFI RS : 125.163.46.126 || 103.155.246.25 || 36.68.11.123
      // console.log(params);
    }
  </script>
  <script>
    window.onload = function() { jam(); }
   
    function jam() {
        var e = document.getElementById('jam'),
        d = new Date(), h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());
   
        e.innerHTML = h +':'+ m +':'+ s;
   
        setTimeout('jam()', 1000);
    }
   
    function set(e) {
        e = e < 10 ? '0'+ e : e;
        return e;
    }
  </script>
  {{-- @else
  <div class="text-center container container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2 mt-3">Validasi Perangkat</h2>
      <p class="mb-4 mx-2">
        Mohon maaf, Anda harus menggunakan Handphone untuk melakukan Absensi.
      </p>
      <a href="{{ route('beranda.index') }}" class="btn btn-primary mb-2"><i class="fas fa-home"></i>&nbsp;&nbsp;Kembali ke Dashboard</a>
      <div class="mt-4">
        <img src="{{ asset('assets-new/img/illustrations/girl-doing-yoga-light.png') }}" alt="girl-doing-yoga-light" width="500" class="img-fluid">
      </div>
    </div>
  </div>
  @endif --}}
</body>

</html>