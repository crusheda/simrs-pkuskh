<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default" data-assets-path="../../../../../../../../../assets-new/" data-template="vertical-menu-template">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Simrsmu v2 - {{ Auth::user()->name }}</title>
  
  <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

  <!-- App favicon -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/pku_ico.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/pku_ico.png') }}">

  <!-- Canonical SEO -->
  <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">

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
  

  <!-- Page CSS -->
  
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
  <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
      <div class="layout-container">
      
        @include('inc.simrsmuv2.sidebar')

        <!-- Layout container -->
        <div class="layout-page">

          @include('inc.simrsmuv2.navbar')

          <!-- Content wrapper -->
          <div class="content-wrapper">

            <!-- Content -->        
              <div class="container-fluid flex-grow-1 container-p-y">

                {{-- CONTENT HERE --}}
                @yield('content')

              </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © <script>
                  document.write(new Date().getFullYear())
                  </script>
                  , made with ❤️
                   {{-- by <a href="https://themeselection.com/" target="_blank" class="footer-link fw-bolder">ThemeSelection</a> --}}
                </div>
                {{-- <div>
                  
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                  
                  <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                  
                  
                  <a href="https://themeselection.com/support/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                  
                </div> --}}
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
          
        </div>
        <!-- / Layout page -->

      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>    
      
      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
      
    </div>
    <!-- / Layout wrapper -->
    
    <div class="buy-now">
      <a href="{{ route('welcome') }}" class="btn btn-dark btn-buy-now">Simrsmu v1</a>
    </div> 
    
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
  
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
  
    <!-- Vendors JS -->
  
    <!-- Main JS -->
    <script src="{{ asset('assets-new/js/main.js') }}"></script>
  
    <!-- Page JS -->
    
  </body>
  </html>
  