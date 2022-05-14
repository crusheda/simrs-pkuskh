@extends('layouts.newAdmin')

@section('content')
@role('sekretaris-direktur|it')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              <h4>Tambah</h4>
            </div>
            <div class="card-body">
              <form class="form-auth-small" action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" class="form-control" autofocus required>
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" class="form-control" placeholder="e.g. Pcs" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga" id="harga_add" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="ref_barang" class="form-control selectric" required>
                        <option hidden>Pilih</option>
                        @foreach($list['ref'] as $key)
                            <option value="{{ $key->id }}">{{ $key->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Lampiran (Optional) : </label><br>
                    <input type="file" name="file" id="imgInp"><br>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran foto</sub><br>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan upload Foto/Gambar bukan Video, berformat <b>jpg,png,jpeg,gif</b></sub>
                </div>
            </div>
            <div class="card-footer text-right">
              <div class="btn-group">
                <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="KEMBALI" onclick="window.location='{{ route('pengadaan.index') }}'"><i class="fa-fw fas fa-angle-left nav-icon text-white"></i> Kembali</button>
                <button class="btn btn-primary text-white" type="submit"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
              </div>
              </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Tabel</h4>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="REFRESH TABEL" onclick="refresh()"><i class="fa-fw fas fa-sync nav-icon text-white"></i> Refresh</button>
                <hr>
                <div class="table-responsive">
                    <table id="table" class="table table-striped display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Jenis</th>
                                <th>Ditambahkan</th>
                                <th><center>#</center></th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody"><tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                        {{-- <tbody>
                            @if(count($list['show']) > 0)
                                @foreach($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>Rp. {{ number_format($item->harga,2,",",".") }}</td>
                                    <td>{{ $item->ref }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#edit{{ $item->id }}"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus{{ $item->id }}"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>    
    </div>
</div>
@else
    <p class="text-center">Maaf, anda tidak punya HAK untuk mengakses halaman ini.</p>
@endrole

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="hapus{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Yakin ingin Menghapus?
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            @if(count($list) > 0)
                Nama Barang : <b>{{ $item->nama }}</b><br>
                Ditambahkan pada : <b>{{ $item->created_at }}</b><br>
                Update pada : <b>{{ $item->updated_at }}</b>
            @endif
        </div>
        <div class="modal-footer">
            @if(count($list) > 0)
                <form action="{{ route('barang.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
                </form>
            @endif
        </div>
      </div>
    </div>
</div>
@endforeach

@foreach($list['show'] as $item)
<div class="modal fade bd-example-modal-lg" id="edit{{ $item->id }}" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            Ubah data
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @if(count($list) > 0)
        {{ Form::model($item, array('route' => array('barang.update', $item->id), 'method' => 'PUT')) }}
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" autofocus required>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name="satuan" value="{{ $item->satuan }}" class="form-control" placeholder="e.g. Pcs" required>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" id="harga_add" value="{{ $item->harga }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="ref_barang" class="form-control selectric" required>
                    <option hidden>Pilih</option>
                    @foreach($list['ref'] as $key)
                        <option value="{{ $key->id }}" @if ($item->ref_barang == $key->id) echo selected @endif>{{ $key->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary text-white" id="submit"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
        </div>
        {{ Form::close() }}
        @endif
      </div>
    </div>
</div>
@endforeach

{{-- <script src="{{ asset('assets/modules/jquery.min.js') }}"></script> --}}
<script>
$(document).ready( function () {
    $.ajax(
        {
            url: "./api/barang",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                // var date = new Date().toISOString().split('T')[0];
                if(res.length == 0){
                    $("#tampil-tbody").append(`<tr><td colspan="7"><center><i class="fas fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
                } else {
                    res.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = "<tr id='data"+ item.id +"'><td>" 
                                    + item.id + "</td><td>" 
                                    + item.nama + "</td><td>" 
                                    + item.satuan + "</td><td>" 
                                    + "Rp. " + item.harga.toLocaleString().replace(/[,]/g,'.') + "</td><td>"
                                    + item.ref + "</td><td>"
                                    + item.updated_at + "</td>";

                        content += "<td><center><div class='btn-group' role='group'>";
                            // content += `<button type="button" class="btn btn-warning btn-sm" onclick="edit(${item.id})" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>`;
                            content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                        content += "</div></center></td></tr>";
                        $('#tampil-tbody').append(content);
                    });
                }
                $('#table').DataTable(
                    {
                        paging: true,
                        searching: true,
                        dom: 'Bfrtip',
                        buttons: [
                            {
                            extend: 'copyHtml5',
                            className: 'btn-info',
                            text: 'Salin Baris',
                            download: 'open',
                            },
                            {
                            extend: 'excelHtml5',
                            className: 'btn-success',
                            text: 'Export Excell',
                            download: 'open',
                            },
                            {
                            extend: 'pdfHtml5',
                            className: 'btn-warning',
                            text: 'Cetak PDF',
                            download: 'open',
                            },
                            {
                                extend: 'colvis',
                                className: 'btn-dark',
                                text: 'Sembunyikan Kolom',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                        ],
                        order: [[ 5, "desc" ]]
                    }
                ).columns.adjust();
            }
        }
    );

    // RUPIAH TAMBAH
    var rupiah_tambah_harga = document.getElementById('harga_add');
    // RUPIAH EDIT
    var rupiah_edit_harga = document.getElementById('harga_edit');

    if (rupiah_tambah_harga) {
        rupiah_tambah_harga.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah_tambah_harga.value = formatRupiah(this.value, 'Rp. ');
        });
    }
    if (rupiah_edit_harga) {
        rupiah_edit_harga.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah_edit_harga.value = formatRupiah(this.value, 'Rp. ');
        });
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    
} );
</script>
<script>
    
    function refresh() {
        $("#tampil-tbody").empty().append(`<tr><td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr>`);
        $.ajax(
        {
            url: "./api/barang",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
            $("#tampil-tbody").empty();
              $('#table').DataTable().clear().destroy();
            // var date = new Date().toISOString().split('T')[0];

            if(res.length == 0){
                $("#tampil-tbody").append(`<tr><td colspan="7"><center><i class="fas fa-frown fa-fw"></i> Tidak ada data yang masuk...</center></td></tr>`);
            } else {
                res.forEach(item => {
                    // var updet = item.updated_at.substring(0, 10);
                    content = "<tr id='data"+ item.id +"'><td>" 
                                + item.id + "</td><td>" 
                                + item.nama + "</td><td>" 
                                + item.satuan + "</td><td>" 
                                + "Rp. " + item.harga.toLocaleString().replace(/[,]/g,'.') + "</td><td>"
                                + item.ref + "</td><td>"
                                + item.updated_at + "</td>";

                    content += "<td><center><div class='btn-group' role='group'>";
                        // content += `<button type="button" class="btn btn-warning btn-sm" onclick="edit(${item.id})" data-toggle="tooltip" data-placement="bottom" title="UBAH"><i class="fa-fw fas fa-edit nav-icon text-white"></i></button>`;
                        content += `<button type="button" class="btn btn-danger btn-sm" onclick="hapus(`+item.id+`)" data-toggle="tooltip" data-placement="bottom" title="HAPUS"><i class="fa-fw fas fa-trash nav-icon"></i></button>`;
                    content += "</div></center></td></tr>";
                    $('#tampil-tbody').append(content);
                });
            }
            $('#table').DataTable(
                {
                    paging: true,
                    searching: true,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                        extend: 'copyHtml5',
                        className: 'btn-info',
                        text: 'Salin Baris',
                        download: 'open',
                        },
                        {
                        extend: 'excelHtml5',
                        className: 'btn-success',
                        text: 'Export Excell',
                        download: 'open',
                        },
                        {
                        extend: 'pdfHtml5',
                        className: 'btn-warning',
                        text: 'Cetak PDF',
                        download: 'open',
                        },
                        {
                            extend: 'colvis',
                            className: 'btn-dark',
                            text: 'Sembunyikan Kolom',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                    ],
                    order: [[ 5, "desc" ]]
                }
            ).columns.adjust();
            }
        }
        );
    }

    function hapus(id) {
        Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Ingin menghapus Barang ID : '+id,
        icon: 'warning',
        reverseButtons: false,
        showDenyButton: false,
        showCloseButton: false,
        showCancelButton: true,
        focusCancel: true,
        confirmButtonColor: '#FF4845',
        confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
        cancelButtonText: `<i class="fa fa-times"></i> Batal`,
        backdrop: `rgba(26,27,41,0.8)`,
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: "./api/barang/hapus/"+id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                Swal.fire({
                title: `Barang berhasil dihapus!`,
                text: 'Pada '+res,
                icon: `success`,
                showConfirmButton:false,
                showCancelButton:false,
                allowOutsideClick: true,
                allowEscapeKey: false,
                timer: 3000,
                timerProgressBar: true,
                backdrop: `rgba(26,27,41,0.8)`,
                });
                refresh();
            },
            error: function(res) {
                Swal.fire({
                title: `Barang gagal di hapus!`,
                text: 'Pada '+res,
                icon: `error`,
                showConfirmButton:false,
                showCancelButton:false,
                allowOutsideClick: true,
                allowEscapeKey: true,
                timer: 3000,
                timerProgressBar: true,
                backdrop: `rgba(26,27,41,0.8)`,
                });
            }
            }); 
        }
        })
    }
</script>
@endsection