<html>
<head>
    {{-- <title>{{ $now }}</title> --}}
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    {{-- <style type="text/css">
		table tr td,
		table tr th{
			font-size: 12pt;
		}
    </style> --}}
    <style type="text/css">
            table th, table td {
            border:1px solid #000;
            padding:0.5em;
			font-size: 13.5pt;
        }
        @media print 
        {
            @page {
            size: F4; 
            margin:0;
            /* size: 210mm 297mm;  */
            /* Chrome sets own margins, we change these printer settings */
            margin: 3mm 0mm 0mm 3mm; 
            }
        }
    </style>
    <center>
        {{-- <h4>Dokumen Kepegawaian</h4>
        <p>Update: {{ $user[0]->updated_at }}</p> --}}
        {{-- <img src="{{ public_path().'/img/kop.png' }}" height="100"> --}}
        <img src="{{ asset('img/kop.png') }}" width="100%">
    </center>
    <div class="container" style="font-size: 13.5pt">
        
        <p class="text-center" style="margin-top: -20px"><b>INSTALASI LABORATORIUM</b></p>
        
        <br>
        
        <div class="row">
            <div class="col-md-5">
                Penanggung Jawab : <br> dr. Endang Tri Peterani, Sp.PK
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-4">
                        Dokter Pengirim <br>
                    </div>
                    <div class="col-md-8">
                        : {{ $list['show']->dr_nama }} <br>
                    </div>
                    <div class="col-md-4">
                        No RM <br>
                        Nama Pasien <br>
                    </div>
                    <div class="col-md-8">
                        : {{ $list['show']->rm }} <br>
                        : {{ $list['show']->nama }} <br>
                    </div>
                    <div class="col-md-4">
                        Jk / Umur <br>
                        Alamat
                    </div>
                    <div class="col-md-8">
                        : {{ $list['show']->jns_kelamin }} / {{ $list['show']->umur }} <br>
                        : {{ $list['show']->alamat }}
                    </div>
                    <div class="col-md-4">
                        Tanggal/ Pukul
                    </div>
                    <div class="col-md-8">
                        : {{ $list['tgl'] }}
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        
        <p class="text-center"><b>HASIL PEMERIKSAAN</b></p>

        <table class="table table-bordered" style="width: 100%;border:2px solid #000 !important;">
            
            <colgroup>
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 30%;">
            </colgroup>

            <thead style="border:2px solid #000 !important;">
                <tr>
                    <th scope="col" style="border:2px solid #000 !important;vertical-align: middle;" class="text-center">NAMA TES</th>
                    <th scope="col" style="border:2px solid #000 !important;vertical-align: middle;" class="text-center">HASIL</th>
                    <th scope="col" style="border:2px solid #000 !important;vertical-align: middle;" class="text-center">NILAI<br>NORMAL</th>
                    <th scope="col" style="border:2px solid #000 !important;vertical-align: middle;" class="text-center">KET</th>
                </tr>
            </thead>
            <tbody style="border:2px solid #000 !important;">
                <tr>
                    <td style="border:2px solid #000 !important;">Antigen SARS-CoV-2<br><br><br></td>
                        @if ($list['show']->hasil == 'POSITIF')
                            <td style="border:2px solid #000 !important;" class="text-danger">
                                <b>{{ $list['show']->hasil }}</b>
                            </td>
                        @else
                            <td style="border:2px solid #000 !important;">
                                <b>{{ $list['show']->hasil }}</b>
                            </td>
                        @endif
                    <td style="border:2px solid #000 !important;">NEGATIF</td>
                    <td style="border:2px solid #000 !important;"></td>
                </tr>
                <tr style="border:2px solid #000 !important;">
                    <td style="border:2px solid #000 !important;">CATATAN</td>
                    <td colspan="3" style="border:2px solid #000 !important;text-align: justify;">
                        @if ($list['show']->hasil == 'POSITIF')
                            Pemeriksaan konfirmasi dengan pemeriksaan RT-PCR <br>
                            -> Lakukan karantina atau isolasi sesuai dengan kriteria <br>
                            -> Menerapkan PHBS (perilaku hidup bersih dan sehat : mencuci tangan, menerapkan etika batuk, menggunakan masker saat sakit, menjaga stamina) dan phisical distancing <br><br><br>                        
                        @else
                            -> Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih beresiko menularkan ke orang lain, disarankan tes ulang atau tes konfirmasi dengan RT PCR, bila probabilitas pretes relatif tinggi, terutama bila pasien bergejala atau diketahui memiliki banyak kontak dengan orang yang terkonfirmasi COVID-19 <br>
                            -> Hasil negatif dapat terjadi pada kuantitas antigen pada spesimen di bawah level deteksi alat <br><br><br>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <p class="text-center">Pemeriksa</p><br><br><br>
                <p class="text-center">{{ $list['show']->pemeriksa }}</p>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script>
        window.onload = window.print;
    </script>
</body>
</html>
