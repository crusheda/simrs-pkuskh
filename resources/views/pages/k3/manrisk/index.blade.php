@extends('layouts.simrsmuv2')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">DataTables /</span> Basic
</h4>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive">
    <table class="datatables-basic table border-top">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th>id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Date</th>
          <th>Salary</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<script>
  $(document).ready( function () {
    $('#datatable').DataTable(
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
        ],
        order: [[ 3, "desc" ]],
      }
    );
  } );
</script>
@endsection