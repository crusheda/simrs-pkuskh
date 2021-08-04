@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

    @role('it')
        <div class="card">
            <iframe src="{{url('ashidu328yrbew9bfay8dsbfy32byrfey9fb8aywbyb3ybfesugn9fsiuagd/user-activity')}}" frameborder="0" height="500px" width="100%"></iframe>
        </div>
    @else
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
    @endrole

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
    } );
</script>

@endsection
