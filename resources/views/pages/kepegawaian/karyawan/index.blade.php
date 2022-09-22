@extends('layouts.simrsmuv2')

@section('content')
@can('kepegawaian')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Kepegawaian /</span> Karyawan
</h4>
  
@if(session('message'))
<div class="alert alert-primary alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
  <p class="mb-0">{{ session('message') }}</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if($errors->count() > 0)
<div class="alert alert-danger alert-dismissible" role="alert">
  <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
  <p class="mb-0">
    <ul>
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif

<div class="card card-action mb-4">
  <div class="card-header">
    <div class="card-action-title">
      <div class="btn-group">
      {{-- <button class="btn btn-primary" onclick="window.location.href='{{ url('v2/kepegawaian/karyawan/nonaktif') }}'"><i class="fas fa-user-slash"></i>&nbsp;&nbsp;Riwayat Nonaktif</button><br> --}}
      <button class="btn btn-secondary" disabled><i class="fas fa-user-slash"></i>&nbsp;&nbsp;Riwayat Nonaktif</button><br>
      <button class="btn btn-warning" data-bs-target="#karyawanmin" data-bs-toggle="modal"><i class="fas fa-user-minus"></i>&nbsp;&nbsp;Belum Lengkap</button></div><br>
      <sub>Tombol <strong>Export Excell</strong> untuk penarikan Data Keseluruhan</sub>
    </div>
    <div class="card-action-element">
      <ul class="list-inline mb-0">
        <li class="list-inline-item">
          <a href="javascript:void(0);" class="card-expand"><i class="tf-icons bx bx-fullscreen"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="card-datatable table-responsive text-nowrap" style="margin-top: -20px">
    <table id="table" class="dt-column-search table table-striped table-hover">
      <thead>
        <tr>
          <th class="cell-fit">ID</th>
          <th>NIP</th>
          <th>NIK</th>
          <th>NAMA</th>
          <th>PANGGILAN</th>
          <th class="cell-fit">JABATAN</th>
          <th>TMPT/TGL LAHIR</th>
          <th>JENIS KELAMIN</th>
          <th>STATUS KAWIN</th>
          <th>EMAIL</th>
          <th>HP</th>
          <th>FB</th>
          <th>IG</th>
          <th>KELURAHAN (KTP)</th>
          <th>KECAMATAN (KTP)</th>
          <th>KABUPATEN (KTP)</th>
          <th>PROVINSI (KTP)</th>
          <th class="cell-fit">ALAMAT (KTP)</th>
          <th>KELURAHAN (DOM)</th>
          <th>KECAMATAN (DOM)</th>
          <th>KABUPATEN (DOM)</th>
          <th>PROVINSI (DOM)</th>
          <th class="cell-fit">ALAMAT (DOM)</th>
          <th>SD</th>
          <th>SMP</th>
          <th>SMA</th>
          <th>D1</th>
          <th>D2</th>
          <th>D3</th>
          <th>D4</th>
          <th>S1</th>
          <th>S2</th>
          <th>S3</th>
          <th class="cell-fit">PENGALAMAN KERJA</th>
          <th>RIWAYAT PENYAKIT</th>
          <th>RIWAYAT PENYAKIT KELUARGA</th>
          <th>RIWAYAT OPERASI</th>
          <th>RIWAYAT PENGGUNAAN OBAT</th>
          <th class="cell-fit">UPDATE</th>
          <th class="cell-fit">#</th>
        </tr>
      </thead>
      <tbody>
        @if(count($list['show']) > 0)
        @foreach($list['show'] as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nip }}</td>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->nick }}</td>
            <td>
              @foreach($list['role'] as $val)
                @if ($item->id == $val->id_user)
                    <kbd>{{ $val->nama_role }}</kbd>
                @endif
              @endforeach
            </td>
            <td>{{ $item->temp_lahir }}, {{ $item->tgl_lahir }}</td>
            <td>{{ $item->jns_kelamin }}</td>
            <td>{{ $item->status_kawin }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->fb }}</td>
            <td>{{ $item->ig }}</td>
            <td>{{ $item->ktp_kelurahan }}</td>
            <td>{{ $item->ktp_kecamatan }}</td>
            <td>{{ $item->ktp_kabupaten }}</td>
            <td>{{ $item->ktp_provinsi }}</td>
            <td>{{ $item->alamat_ktp }}</td>
            <td>{{ $item->dom_kelurahan }}</td>
            <td>{{ $item->dom_kecamatan }}</td>
            <td>{{ $item->dom_kabupaten }}</td>
            <td>{{ $item->dom_provinsi }}</td>
            <td>{{ $item->alamat_dom }}</td>
            <td>{{ $item->sd }} @if($item->th_sd)({{ $item->th_sd }})@endif</td>
            <td>{{ $item->smp }} @if($item->th_smp) ({{ $item->th_smp }})@endif</td>
            <td>{{ $item->sma }} @if($item->th_sma) ({{ $item->th_sma }})@endif</td>
            <td>{{ $item->d1 }} @if($item->th_d1) ({{ $item->th_d1 }})@endif</td>
            <td>{{ $item->d2 }} @if($item->th_d2) ({{ $item->th_d2 }})@endif</td>
            <td>{{ $item->d3 }} @if($item->th_d3) ({{ $item->th_d3 }})@endif</td>
            <td>{{ $item->d4 }} @if($item->th_d4) ({{ $item->th_d4 }})@endif</td>
            <td>{{ $item->s1 }} @if($item->th_s1) ({{ $item->th_s1 }})@endif</td>
            <td>{{ $item->s2 }} @if($item->th_s2) ({{ $item->th_s2 }})@endif</td>
            <td>{{ $item->s3 }} @if($item->th_s3) ({{ $item->th_s3 }})@endif</td>
            <td>{{ $item->pengalaman_kerja }}</td>
            <td>{{ $item->riwayat_penyakit }}</td>
            <td>{{ $item->riwayat_penyakit_keluarga }}</td>
            <td>{{ $item->riwayat_operasi }}</td>
            <td>{{ $item->riwayat_penggunaan_obat }}</td>
            <td>{{ $item->updated_at }}</td>
            <td>
              <center>
              <div class='btn-group'>
                <button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class='bx bx-dots-vertical-rounded'></i></button>
                <ul class='dropdown-menu dropdown-menu-end'>
                  <li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="window.location.href='{{ url('v2/kepegawaian/karyawan/'.$item->id.'') }}'"><i class="fa-fw fas fa-search nav-icon"></i> Lihat</a></li>
                  <li>
                    <form method="POST" action="/v2/kepegawaian/karyawan/{{$item->id}}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <a href='javascript:void(0);' type="submit" class='dropdown-item text-danger delete-user'><i class="fa-fw fas fa-trash nav-icon"></i> Nonaktifkan</a>
                    </form>
                  </li>
                </ul>
              </div>
              </center>
            </td>
        </tr>
        @endforeach
        @endif
      </tbody>
      <tfoot>
          <tr>
            <th class="cell-fit">ID</th>
            <th>NIP</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>PANGGILAN</th>
            <th class="cell-fit">JABATAN</th>
            <th>TMPT/TGL LAHIR</th>
            <th>JENIS KELAMIN</th>
            <th>STATUS KAWIN</th>
            <th>EMAIL</th>
            <th>HP</th>
            <th>FB</th>
            <th>IG</th>
            <th>KELURAHAN (KTP)</th>
            <th>KECAMATAN (KTP)</th>
            <th>KABUPATEN (KTP)</th>
            <th>PROVINSI (KTP)</th>
            <th class="cell-fit">ALAMAT (KTP)</th>
            <th>KELURAHAN (DOM)</th>
            <th>KECAMATAN (DOM)</th>
            <th>KABUPATEN (DOM)</th>
            <th>PROVINSI (DOM)</th>
            <th class="cell-fit">ALAMAT (DOM)</th>
            <th>SD</th>
            <th>SMP</th>
            <th>SMA</th>
            <th>D1</th>
            <th>D2</th>
            <th>D3</th>
            <th>D4</th>
            <th>S1</th>
            <th>S2</th>
            <th>S3</th>
            <th class="cell-fit">PENGALAMAN KERJA</th>
            <th>RIWAYAT PENYAKIT</th>
            <th>RIWAYAT PENYAKIT KELUARGA</th>
            <th>RIWAYAT OPERASI</th>
            <th>RIWAYAT PENGGUNAAN OBAT</th>
            <th class="cell-fit">UPDATE</th>
            <th class="cell-fit">#</th>
          </tr>
      </tfoot>
    </table>
  </div>
</div>

<div class="modal fade animate__animated animate__bounceInRight" id="karyawanmin" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Karyawan yang belum lengkap</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive text-nowrap">
          <table class="dt-column-search table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>JABATAN</th>
                <th>UPDATE</th>
              </tr>
            </thead>
            <tbody>
              @if(count($list['showMin']) > 0)
              @foreach($list['showMin'] as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                  @foreach($list['role'] as $val)
                    @if ($item->id == $val->id_user)
                        <kbd>{{ $val->nama_role }}</kbd>
                    @endif
                  @endforeach
                </td>
                <td>{{ $item->updated_at }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
          <sub>Mohon segera dihimbau untuk melakukan pengisian Data Profil Karyawan pada masing-masing akun di bawah ini. Terima Kasih.</sub>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
@endcan
<script>$(document).ready( function () {
  $('.delete-user').click(function(e){
      e.preventDefault() // Don't post the form, unless confirmed
      if (confirm('Anda yakin ingin menonaktifkan Karyawan tersebut?')) {
          // Post the form
          $(e.target).closest('form').submit() // Post the surrounding form
      }
  });
  
  $('#table').DataTable(
    {
      order: [[3, "asc"]],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [{
          extend: "collection",
          className: "btn btn-label-primary dropdown-toggle me-2",
          text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [{
              extend: "print",
              text: '<i class="bx bx-printer me-2" ></i>Print',
              className: "dropdown-item",
              // exportOptions: {
              //     columns: [3, 4, 5, 6, 7]
              // }
          }, {
              extend: "excel",
              text: '<i class="bx bxs-spreadsheet me-2"></i>Excel',
              className: "dropdown-item",
              autoFilter: true,
              attr: {id: 'exportButton'},
              sheetName: 'data',
              title: '',
              filename: 'Data Seluruh Karyawan'
              // exportOptions: {
              //     columns: [3, 4, 5, 6, 7]
              // }
          }, {
              extend: "pdf",
              text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
              className: "dropdown-item",
          }, {
              extend: "copy",
              text: '<i class="bx bx-copy me-2" ></i>Copy',
              className: "dropdown-item",
              // exportOptions: {
              //     columns: [3, 4, 5, 6, 7]
              // }
          },]
        }, 
        {
          extend: 'colvis',
          text: '<i class="bx bx-hide me-sm-2"></i> <span class="d-none d-sm-inline-block">Column</span>',
          className: "btn btn-label-primary modal me-2",
          // collectionLayout: 'dropdown-menu',
          // contentClassName: 'dropdown-item'
        }
      ],
      columnDefs: [
          { targets: 13, visible: false },
          { targets: 14, visible: false },
          { targets: 15, visible: false },
          { targets: 16, visible: false },
          { targets: 18, visible: false },
          { targets: 19, visible: false },
          { targets: 20, visible: false },
          { targets: 21, visible: false },
          { targets: 23, visible: false },
          { targets: 24, visible: false },
          { targets: 25, visible: false },
          { targets: 26, visible: false },
          { targets: 27, visible: false },
          { targets: 28, visible: false },
          { targets: 29, visible: false },
          { targets: 30, visible: false },
          { targets: 31, visible: false },
          { targets: 32, visible: false },
          { targets: 34, visible: false },
          { targets: 35, visible: false },
          { targets: 36, visible: false },
          { targets: 37, visible: false },
      ],
    },
  );
  $("div.head-label").html('<h5 class="card-title mb-0">Data Kepegawaian</h5>');
})
</script>
@endsection