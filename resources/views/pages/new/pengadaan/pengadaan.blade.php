@extends('layouts.newAdmin')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title">Statistik
        </div>
        <div class="card-stats-items">
          <div class="card-stats-item">
            <div class="card-stats-item-count">*</div>
            <div class="card-stats-item-label">Pending</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">*</div>
            <div class="card-stats-item-label">Shipping</div>
          </div>
          <div class="card-stats-item">
            <div class="card-stats-item-count">*</div>
            <div class="card-stats-item-label">Completed</div>
          </div>
        </div>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-archive"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengadaan</h4>
        </div>
        <div class="card-body">
          *
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card card-statistic-2">
      <div class="card-chart">
        <canvas id="balance-chart" height="80"></canvas>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengeluaran</h4>
        </div>
        <div class="card-body">
          Rp. -
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h4>Table Pengadaan</h4>
    <div class="card-header-action">
      <button type="button" class="btn btn-primary" onclick="window.location='{{ route('barang.index') }}'"><i class="fa-fw fas fa-shopping-bag nav-icon"></i> Data Barang</button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="table" class="table table-hover display" style="width: 100%;word-break: break-word;">
        <thead>
          <tr>
            <th><center>DETAIL</center></th>
            <th>NAMA</th>
            <th>UNIT</th>
          </tr>
        </thead>
        <tbody style="text-transform: capitalize">
          <tr>
            <td>a</td>
            <td>b</td>
            <td>c</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="{{ asset('assets/modules/chart.min.js') }}"></script>
<script>
  $(document).ready( function () {
    $('#table').DataTable(
        {
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            autoWidth: false,
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
            order: [[ 1, "desc" ]],
            pageLength: 10
        }
    );

    var balance_chart = document.getElementById("balance-chart").getContext('2d');
    
    var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
    balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
    balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');
    
    var myChart = new Chart(balance_chart, {
      type: 'line',
      data: {
        labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
        datasets: [{
          label: 'Balance',
          data: [50, 61, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50, 62],
          backgroundColor: balance_chart_bg_color,
          borderWidth: 3,
          borderColor: 'rgba(63,82,227,1)',
          pointBorderWidth: 0,
          pointBorderColor: 'transparent',
          pointRadius: 3,
          pointBackgroundColor: 'transparent',
          pointHoverBackgroundColor: 'rgba(63,82,227,1)',
        }]
      },
      options: {
        layout: {
          padding: {
            bottom: -1,
            left: -1
          }
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              beginAtZero: true,
              display: false
            }
          }],
          xAxes: [{
            gridLines: {
              drawBorder: false,
              display: false,
            },
            ticks: {
              display: false
            }
          }]
        },
      }
    });
  });
</script>
@endsection