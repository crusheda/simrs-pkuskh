@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}"> --}}

<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTablesku.min.js') }}"></script>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-header bg-dark text-white">

            <i class="fa-fw fas fa-book nav-icon text-info">

            </i> Referensi Diagnosis Sisrute

            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Akses Publik
            </span>
            
        </div>
        <div class="card-body">
            <div class="data-table-list">
                <div class="table-responsive">
                    <table id="sisrute" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Diagnosis x ICD</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody"><tr><td colspan="6"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td></tr></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#sisrute').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            order: [[ 0, "asc" ]]
        }
    );
    $.ajax(
        {
            url: "http://sisrute.kemkes.go.id/baru/cari.php",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                $("#tampil-tbody").empty();
                res.forEach(item => {
                    $("#tampil-tbody").append(`
                        <tr>
                            <td>${item}</td>
                        </tr>
                    `);
                });
            }
        }
    );
} );
</script>

@endsection