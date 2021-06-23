<html>
<head>
    <title>{{ $now }}</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
    </style>
    <center>
        <h4>Dokumen Kepegawaian</h4>
        <p>Update: {{ $user[0]->updated_at }}</p>
    </center>
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>DETAIL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $user[0]->ID }}</td>
            </tr>
            <tr>
                <td>FOTO</td>
                <td><img src="{{ storage_path().'/app/'.$user[0]->filename }}" height="100"></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>{{ $user[0]->nik }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>NAMA</th>
                <th>TAHUN LULUS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>SD</td>
                <td>{{ $user[0]->sd }}</td>
                <td>{{ $user[0]->th_sd }}</td>
            </tr>
        </tbody>
    </table>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>
