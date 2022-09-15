<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default" data-assets-path="../../../../../../../../../assets-new/" data-template="vertical-menu-template">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Simrsmu v2 - {{ Auth::user()->name }}</title>
  
  <meta name="description" content="Sistem Manajemen Rumah Sakit PKU Muhammadiyah Sukoharjo" />
  <meta name="keywords" content="simrs, simrsmu, sim rspkuskh, pkuskh, rspkuskh, sistem pku, sistem informasi majemen rumah sakit">
  <meta content="Yussuf Faisal" name="author" />

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
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/flatpickr/flatpickr.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/spinkit/spinkit.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/select2/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/apex-charts/apex-charts.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/bs-stepper/bs-stepper.css') }}" />
  <!-- PICKER -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/flatpickr/flatpickr.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/pickr/pickr-themes.css') }}" />

  <!-- Row Group CSS -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">

  <!-- Form Validation -->
  <link rel="stylesheet" href="{{ asset('assets-new/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />  

  <!-- Page CSS -->
  
  <!-- Helpers -->
  <script src="{{ asset('assets-new/vendor/js/helpers.js') }}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="{{ asset('assets-new/vendor/js/template-customizer.js') }}"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('assets-new/js/config.js') }}"></script>
  {{-- <script src="{{ asset('assets-new/vendor/libs/jquery/jquery.js') }}"></script> --}}
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  
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
<style>
  .row>* {
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: 0;
    padding-left: calc(var(--bs-gutter-x)*.5);
    margin-top: var(--bs-gutter-y)
  }
  html, body, .outer { height: 100%; background: white }
  .inner { height: 100%; background:white }
</style>
<style>
  .hidden {
  display: none !important;
  visibility: hidden !important;
  }
  </style>
</head>
{{-- <td>
  <div class="d-flex align-items-center">
    <div class="dropdown"><a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
      <div class="dropdown-menu dropdown-menu-end">
        <a href="javascript:void(0);" class="dropdown-item">Edit</a>
        <a href="javascript:;" class="dropdown-item">Duplicate</a>
        <div class="dropdown-divider"></div>
        <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
      </div>
    </div>
  </div>
</td> --}}
<?php
date_default_timezone_set("Asia/jakarta");
?>
<body>
  <div class="row" style="margin-right:0;padding-right:0">
    <div class="col-md-12">
      {{-- <marquee behavior="" direction=""></marquee> --}}
      <div class="card card-action" style="position: fixed;width:100%">
        <div class="card-header">
          <div class="card-action-title">
            <h1 class="mb-1"><strong>ANTRIAN OBAT <u onclick="window.location='{{ route('antrol.index') }}'">APOTEK BPJS</u></strong></h1>
            <small><strong>UPDATE OTOMATIS SETIAP 5 DETIK</strong></small>
          </div>
          <div class="card-action-element">
            <a id="jam" style="font-size:2.8rem"></a>
          </div>
        </div>
      </div>
      <div class="table-responsive" style="margin-top:118px">
        <table class="invoice-list-table table table-hover table-striped border-top" style="height: 100%">
          <thead>
            <tr>
              <th style="font-size:1rem" class="cell-fit"><center><kbd>REKAM MEDIK</kbd></center></th>
              <th style="font-size:1rem" class="cell-fit">NAMA</th>
              <th style="font-size:1rem">Status</th>
              <th style="font-size:1rem">Update</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0" id="tampil-tbody"></tbody>
        </table>
      </div>
    </div>
  </div>
  
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  {{-- <script src="{{ asset('assets-new/vendor/libs/jquery/jquery.js') }}"></script> --}}
  <script src="{{ asset('assets-new/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  
  <script src="{{ asset('assets-new/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/i18n/i18n.js') }}"></script>
  {{-- <script src="{{ asset('assets-new/vendor/libs/typeahead-js/typeahead.js') }}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
  
  <script src="{{ asset('assets-new/vendor/js/menu.js') }}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
  <script src="{{ asset('assets-new/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
  <script src="{{ asset('assets-new/vendor/libs/jszip/jszip.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/pdfmake/pdfmake.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/select2/select2.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/bloodhound/bloodhound.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/tagify/tagify.js') }}"></script>
  <script src="{{ asset('js/iziToast.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets-new/vendor/libs/apex-charts/apexcharts.js') }}"></script>

  <!-- Flat Picker -->
  <script src="{{ asset('assets-new/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/flatpickr/flatpickr.js') }}"></script>
  <!-- Row Group JS -->
  <script src="{{ asset('assets-new/vendor/libs/datatables-rowgroup/datatables.rowgroup.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.js') }}"></script>
  <!-- Form Validation -->
  <script src="{{ asset('assets-new/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/block-ui/block-ui.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/sortablejs/sortable.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/autosize/autosize.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
  <!-- PICKER -->
  <script src="{{ asset('assets-new/vendor/libs/moment/moment.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/flatpickr/flatpickr.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
  <script src="{{ asset('assets-new/vendor/libs/pickr/pickr.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets-new/js/main.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('assets-new/js/cards-actions.js') }}"></script>
  {{-- <script src="{{ asset('assets-new/js/forms-pickers.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets-new/js/tables-datatables-basic.js') }}"></script> --}}

  {{-- SCRIPT-SCRIPT JAVASCRIPT / JQUERY --}}
  <script type="text/javascript">
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

  <script>
    // INIT
    $.ajax({
      url: "http://192.168.1.3:8000/api/antrol/display",
      type: 'GET',
      dataType: 'json', // added data type
      success: function(res) {
        // console.log(res);
        if (res) {
          $("#tampil-tbody").empty();
          res.forEach(item => {
            content = `<tr>
                        <td><h3 class="mt-2"><strong>`+item.DAT_PASIEN+`</strong></h3></td>
                        <td>
                          <div class="d-flex justify-content-start align-items-center">
                            <div class="d-flex flex-column">
                              <h3 class="text-body text-truncate fw-semibold mb-1">`+item.NAMAPASIEN+`</h3>
                              <small class="text-truncate text-muted">`+item.ALAMAT+`</small>
                            </div>
                          </div>
                        </td>`;
                        if (item.TASKID_06) {
                          if (item.TASKID_07) {
                          content += `<td><h4 class="mt-2">SELESAI</h4></td>
                                      <td><h4 class="mt-2">`+item.TASKID_07+`</h4></td>`;
                          } else {
                          content += `<td><h4 class="mt-2">OBAT SEDANG DISIAPKAN</h4></td>
                                      <td><h4 class="mt-2">`+item.TASKID_06+`</h4></td>`;
                          }
                        }
            content += `</tr>`;
            $('#tampil-tbody').append(content);
          });
        }
      }
    });
    // AUTOMATION
    setInterval(function () {
      $.ajax({
        url: "http://192.168.1.3:8000/api/antrol/display",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
          // console.log(res);
          if (res) {
            $("#tampil-tbody").empty();
            res.forEach(item => {
              content = `<tr>
                          <td><h3 class="mt-2"><strong>`+item.DAT_PASIEN+`</strong></h3></td>
                          <td>
                            <div class="d-flex justify-content-start align-items-center">
                              <div class="d-flex flex-column">
                                <h3 class="text-body text-truncate fw-semibold mb-1">`+item.NAMAPASIEN+`</h3>
                                <small class="text-truncate text-muted">`+item.ALAMAT+`</small>
                              </div>
                            </div>
                          </td>`;
                          if (item.TASKID_07) {
                            content += `<td><h4 class="mt-2">SELESAI</h4></td>
                                        <td><h4 class="mt-2">`+item.TASKID_07+`</h4></td>`;
                          } else {
                            content += `<td><h4 class="mt-2">OBAT SEDANG DISIAPKAN</h4></td>
                                        <td><h4 class="mt-2">`+item.TASKID_06+`</h4></td>`;
                          }
              content += `</tr>`;
              $('#tampil-tbody').append(content);
            });
          }
        }
      });
    },5000); // 5 DETIK
  </script>

  {{-- <script>
    // Getting a reference to html. The way you did it in the loop
    // is slow because it has to get access to it every time.
    const main = $('html');

    // The scrollTop function
    // scrolls to the top
    function scrollTop() {
        console.log('scrolling to top')
        main.animate({scrollTop: 0},20000,"linear",scrollBottom /* this is a callback it means when we are done scrolling to the top, scroll to the bottom */)
    }

    function scrollBottom() {
        console.log('scrolling to bottom')
        main.animate({scrollTop: document.body.offsetHeight},20000,"linear",scrollTop /* this is a callback it means when we are done scrolling to the bottom, scroll to the top */)
    }

    // this kicks it off
    // again only running $(document).ready once to increase performance.
    // Once scrollTop completes, it calls scrollBottom, which in turn calls scrollTop and so on
    $(document).ready(scrollTop);
  </script> --}}

</body>
</html>
