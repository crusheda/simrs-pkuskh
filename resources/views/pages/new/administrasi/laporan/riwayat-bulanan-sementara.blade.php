<?PHP
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMRS | {{ Auth::user()->name }}</title>
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/datatables/buttons.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/datatables/select.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/coreui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />--}}
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/pku_ico.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/pku_ico.png') }}">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

    <!-- 1. Addchat css -->
    {{-- <link href=" echo asset('assets/addchat/css/addchat.css') ?>" rel="stylesheet"> --}}

    {{-- SweetAlert2 --}}
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">

    {{-- DATA TABLES --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>
    
    @yield('styles')
    @yield('css-styles')
    @FilemanagerScript
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show brand-minimized sidebar-minimized" id="body">
  {{-- GO TO TOP JS --}}
  <a name="top" class="top"></a> 

    <div class="app-body">
        <main class="main">

            <div style="padding-top: 20px" class="container-fluid">
                @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        </div>
                    </div>
                @endif
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if( Session::has('status') )
                  <p class="feedback-success">{{ Session::get('status') }}</p>
                @endif
                @if (session('alert'))
                  <div class="alert alert-success">
                      {{ session('alert') }}
                  </div>
                @endif
                
                <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
                {{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

                <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
                <script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

                @can('laporan')
                    <div class="card" style="width: 100%">
                        <div class="card-header bg-dark text-white">
                            
                            <i class="fa-fw fas fa-history nav-icon text-success">

                            </i> Riwayat Laporan Bulanan Terverifikasi

                            <span class="pull-right badge badge-warning" style="margin-top:4px">
                                Akses Publik
                            </span>
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-dark text-white" onclick="window.location.href='{{ route('bulan.index') }}'">
                                                <i class="fa-fw fas fa-caret-left nav-icon"></i> Kembali
                                            </button>
                                            <button class="btn btn-warning text-white" onclick="refresh()">
                                                <i class="fa-fw fas fa-refresh nav-icon"></i> Refresh
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pull-right">

                                    </div>
                                </div>
                            </div>
                            <sub>Data yang ditampilkan adalah data laporan yang sudah diverifikasi</sub>
                            <hr>
                            <div class="table-responsive">
                                <table id="table" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>DIUPDATE</th>
                                            <th>JUDUL</th>
                                            <th>USER</th>
                                            <th>UNIT</th>
                                            <th>BLN / THN</th>
                                            <th>KETERANGAN</th>
                                            <th><center>AKSI</center></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tampil-tbody"><tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endcan

                <script>
                    $(document).ready( function () {
                        $.ajax(
                            {
                                url: "./riwayat/table",
                                type: 'GET',
                                dataType: 'json', // added data type
                                success: function(res) {
                                    $("#tampil-tbody").empty();
                                    res.show.forEach(item => {
                                        if(item.unit) {
                                            try {
                                                var un = JSON.parse(item.unit);
                                            } catch(e) {
                                                var un = item.unit;
                                            }
                                        }
                                        $("#tampil-tbody").append(`
                                            <tr id="data${item.id}">
                                                <td>${item.id} ${item.tgl_verif != null ? '<i class="fa-fw fas fa-check nav-icon"></i>' : '' }</td>
                                                <td>${item.updated_at}</td>
                                                <td>${item.judul}</td>
                                                <td>${item.nama}</td>
                                                <td>${un}</td>
                                                <td>${item.bln} / ${item.thn}</td>
                                                <td>${item.ket}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-danger text-white btn-sm" onclick="hapusVerif(${item.id})"><i class="fa-fw fas fa-check-square nav-icon"></i></button>
                                                            ${item.ket_verif == null ?
                                                                '<button class="btn btn-dark text-white btn-sm" onclick="ket('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                                            :
                                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapus('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                                            }
                                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        `);
                                    });
                                    $('#table').DataTable(
                                        {
                                            paging: true,
                                            searching: true,
                                            dom: 'Bfrtip',
                                            buttons: [
                                                'excel', 'pdf','colvis'
                                            ],
                                            select: {
                                                style: 'single'
                                            },
                                            'columnDefs': [
                                                // { targets: 0, visible: false },
                                                // { targets: 3, visible: false },
                                                // { targets: 6, visible: false },
                                                // { targets: 8, visible: false },
                                            ],
                                            language: {
                                                buttons: {
                                                    colvis: 'Sembunyikan Kolom',
                                                    excel: 'Jadikan Excell',
                                                    pdf: 'Jadikan PDF',
                                                }
                                            },
                                            order: [[ 1, "desc" ]],
                                            pageLength: 10
                                        }
                                    ).columns.adjust();
                                }
                            }
                        );
                        $("body").addClass('brand-minimized sidebar-minimized');
                    } );
                </script>
                <script>
                    // FUNCTION - FUNCTION
                    function refresh() {
                        $("#tampil-tbody").empty().append(`<tr><td colspan="8"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
                        $.ajax(
                            {
                                url: "./riwayat/table",
                                type: 'GET',
                                dataType: 'json', // added data type
                                success: function(res) {
                                    $("#tampil-tbody").empty();
                                    $('#table').DataTable().clear().destroy();
                                    res.show.forEach(item => {
                                        if(item.unit) {
                                            try {
                                                var un = JSON.parse(item.unit);
                                            } catch(e) {
                                                var un = item.unit;
                                            }
                                        }
                                        $("#tampil-tbody").append(`
                                            <tr id="data${item.id}">
                                                <td>${item.id} ${item.tgl_verif != null ? '<i class="fa-fw fas fa-check nav-icon"></i>' : '' }</td>
                                                <td>${item.updated_at}</td>
                                                <td>${item.judul}</td>
                                                <td>${item.nama}</td>
                                                <td>${un}</td>
                                                <td>${item.bln} / ${item.thn}</td>
                                                <td>${item.ket}</td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-danger text-white btn-sm" onclick="hapusVerif(${item.id})"><i class="fa-fw fas fa-check-square nav-icon"></i></button>
                                                            ${item.ket_verif == null ?
                                                                '<button class="btn btn-dark text-white btn-sm" onclick="ket('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                                            :
                                                                '<button class="btn btn-info text-white btn-sm" onclick="ketHapus('+item.id+')"><i class="fa-fw fas fa-sticky-note nav-icon"></i></button>'
                                                            }
                                                            <a type="button" class="btn btn-success btn-sm text-white" onclick="window.location.href='{{ url('laporan/bulan/${item.id}') }}'"><i class="fa-fw fas fa-download nav-icon text-white"></i></a>
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        `);
                                    });
                                    $('#table').DataTable(
                                        {
                                            paging: true,
                                            searching: true,
                                            dom: 'Bfrtip',
                                            buttons: [
                                                'excel', 'pdf','colvis'
                                            ],
                                            select: {
                                                style: 'single'
                                            },
                                            'columnDefs': [
                                                // { targets: 0, visible: false },
                                                // { targets: 3, visible: false },
                                                // { targets: 6, visible: false },
                                                // { targets: 8, visible: false },
                                            ],
                                            language: {
                                                buttons: {
                                                    colvis: 'Sembunyikan Kolom',
                                                    excel: 'Jadikan Excell',
                                                    pdf: 'Jadikan PDF',
                                                }
                                            },
                                            order: [[ 1, "desc" ]],
                                            pageLength: 10
                                        }
                                    ).columns.adjust();
                                }
                            }
                        );
                    }
                    
                    function hapusVerif(id) {
                        $.ajax({
                            method: 'GET',
                            url: './api/'+id+'/verified', 
                            dataType: 'json', 
                            data: { 
                                id: id
                            }, 
                            success: function(res) {
                                Swal.fire({
                                    title: 'Hapus Verifikasi ID : '+id+' ?',
                                    text: 'Laporan ini diverifikasi oleh '+res.nama+' Pada '+res.tgl_verif,
                                    icon: `warning`,
                                    focusCancel: true,
                                    showConfirmButton:true,
                                    confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                                    confirmButtonColor: '#FF4845',
                                    showCancelButton: true,
                                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                                    showCloseButton: true,
                                    backdrop: `rgba(26,27,41,0.8)`,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            method: 'GET',
                                            url: './verif/'+id+'/hapus', 
                                            dataType: 'json', 
                                            data: { 
                                                id: id
                                            }, 
                                            success: function(val) {
                                                Swal.fire({
                                                    title: 'Verifikasi berhasil dihapus!',
                                                    text: val.text,
                                                    icon: val.icon,
                                                    showConfirmButton:false,
                                                    showCancelButton:false,
                                                    timer: 3000,
                                                    timerProgressBar: true,
                                                    backdrop: `rgba(26,27,41,0.8)`,
                                                });
                                                if (val) {
                                                    refresh();
                                                }
                                            }
                                        }); 
                                    }
                                })
                            }
                        }); 
                    }

                    function ket(id) {
                        Swal.fire({
                            title: 'Keterangan Verifikasi',
                            text: 'ID : '+id,
                            input: 'textarea',
                            reverseButtons: true,
                            showDenyButton: false,
                            showCloseButton: true,
                            showCancelButton: true,
                            confirmButtonText: `<i class="fa fa-send"></i> Kirim`,
                            backdrop: `rgba(26,27,41,0.8)`,
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Pengisian keterangan tidak boleh kosong!'
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    method: 'POST',
                                    url: './api/ket', 
                                    dataType: 'json', 
                                    data: { 
                                        id: id,
                                        ket: result.value,
                                    }, 
                                    success: function(res) {
                                        Swal.fire({
                                            title: `Keterangan Ditambahkan!`,
                                            text: res,
                                            icon: `success`,
                                            showConfirmButton:false,
                                            showCancelButton:false,
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            backdrop: `rgba(26,27,41,0.8)`,
                                        });
                                        if (res) {
                                            refresh();
                                        }
                                    }
                                }); 
                            }
                        })
                    }

                    function ketHapus(id) {
                        $.ajax({
                            method: 'GET',
                            url: './api/ket/'+id, 
                            dataType: 'json', 
                            data: { 
                                id: id
                            }, 
                            success: function(res) {
                                Swal.fire({
                                    title: 'Keterangan',
                                    text: res.ket_verif,
                                    focusCancel: true,
                                    showConfirmButton:true,
                                    confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                                    confirmButtonColor: '#FF4845',
                                    showCancelButton: true,
                                    cancelButtonText: `<i class="fa fa-close"></i> Tutup`,
                                    showCloseButton: true,
                                    backdrop: `rgba(26,27,41,0.8)`,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            method: 'GET',
                                            url: './api/ket/'+id+'/hapus', 
                                            dataType: 'json', 
                                            data: { 
                                                id: id
                                            }, 
                                            success: function(val) {
                                                Swal.fire({
                                                    title: 'Keterangan berhasil dihapus!',
                                                    text: val.text,
                                                    icon: val.icon,
                                                    showConfirmButton:false,
                                                    showCancelButton:false,
                                                    timer: 3000,
                                                    timerProgressBar: true,
                                                    backdrop: `rgba(26,27,41,0.8)`,
                                                });
                                                if (val) {
                                                    refresh();
                                                }
                                            }
                                        }); 
                                    }
                                })
                            }
                        }); 
                    }
                </script>
                
            </div>
        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

      <!-- 3. AddChat JS -->
      <!-- Modern browsers -->
      {{-- <script type="module" src="echo asset('assets/addchat/js/addchat.min.js') ?>"></script> --}}
      <!-- Fallback support for Older browsers -->
      {{-- <script nomodule src="echo asset('assets/addchat/js/addchat-legacy.min.js') ?>"></script> --}}

    <a id="goTop" class="btn btn-dark text-white" style="
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 15px;
      opacity: 70%;
      border-radius: 15px;
      ">
      <i class="fa-fw fas fa-caret-up nav-icon"></i>
    </a>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'colvis',
        className: 'btn-default',
        text: colvisButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
  $('.c-notification').change(function() { 
    Swal.fire({
      title: 'sadsadsa',
      text: 'asdsadsadsd',
      icon: 'OK',
      showConfirmButton:false,
      showCancelButton:false,
      timer: 3000,
      timerProgressBar: true,
      backdrop: `rgba(26,27,41,0.8)`,
    });
  });
  
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
});

    </script>
    @yield('scripts')
    @yield('js-scripts')
</body>

</html>
