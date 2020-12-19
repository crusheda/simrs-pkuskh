<html>
<head>
    {{-- <img src="{{ asset('img/kop.png') }}" alt=""> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">

        <style type="text/css">
            table tr td,
            table tr th{
                font-size: 12pt;
                font-family: 'Times New Roman', Times, serif;
            },
            a {
                font-family: 'Times New Roman', Times, serif;
                font-size: 12pt;
                color: black;
            }
        </style>
        <center>
            <a><b><u>SURAT KETERANGAN</u></b></a><br>
            <a><b>Nomor : {{ $no_surat }}/KET/IKP/III.6.AU/PKUSKH/2020</b></a>
        </center><br>

        <p>Telah lahir pada</p>

        <p>Hari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $hari }} <br>
        Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ \Carbon\Carbon::parse($tgl)->isoFormat('D MMMM Y') }} <br>
        Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ \Carbon\Carbon::parse($tgl)->toTimeString() }}</p>
        
        <p>Di Rumah Sakit PKU Muhammadiyah Sukoharjo seorang bayi {{ $kelamin }} hidup.</p>

        <p>Nama Ibu&nbsp;&nbsp;&nbsp;:&nbsp;{{ $ibu }} <br>Nama Ayah&nbsp;&nbsp;&nbsp;:&nbsp;{{ $ayah }} <br>Alamat&nbsp;&nbsp;&nbsp;:&nbsp;{{ $alamat }} <br>Nama Anak&nbsp;&nbsp;&nbsp;:&nbsp;{{ $anak }} <br>Berat Badan&nbsp;&nbsp;&nbsp;:&nbsp;{{ $bb }} <br>Panjang Badan&nbsp;&nbsp;&nbsp;:&nbsp;{{ $tb }}</p>
        
        <br>
        <br>
    </div>
    <div class="row">
        <div class="col-md-4"><p></p></div>
        <div class="col-md-4"><p></p></div>
        <div class="col-md-4">
            <center>
                <p>Sukoharjo, {{ \Carbon\Carbon::today()->isoFormat('D MMMM Y') }}<br>Dokter</p><br>
                {{-- <img src="{{ asset('img/kebidanan/ttd_ahmad.png') }}"><br> --}}
                <p>dr. H. Ahmad Sutamat, Sp.OG</p>
            </center>
        </div>
    </div>
</body>
</html>
