@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

    @role('it')
        <div class="card">
            <iframe src="{{url('ashidu328yrbew9bfay8dsbfy32byrfey9fb8aywbyb3ybfesugn9fsiuagd/user-activity')}}" frameborder="0" height="600px" width="100%"></iframe>
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
