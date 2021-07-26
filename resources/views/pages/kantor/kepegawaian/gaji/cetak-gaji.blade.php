<html>
<head>
    <title>{{ $list['show'][0]->id_user }} - {{ $list['show'][0]->nama }}</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/pku_ico.png') }}">
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
            font-family:'Times New Roman', Times, serif;
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
    <div class="" style="font-family:'Times New Roman', Times, serif;font-size: 13.5pt;margin-top:20px;margin-left:10px;margin-right:40px;margin-bottom:20px">
        <table class="table table-bordered" style="width: 100%;border:2px solid #000 !important;">
            <colgroup>
                <col span="1" style="width: 32%;">
                <col span="1" style="width: 18%;">
                <col span="1" style="width: 12%;">
                <col span="1" style="width: 18%;">
                <col span="1" style="width: 9%;">
                <col span="1" style="width: 11%;">
            </colgroup>
            <thead style="border:2px solid #000 !important;">
                <tr>
                    <th scope="col" style="border:2px solid #000 !important;vertical-align: middle;" class="text-center" rowspan="2" colspan="2">
                        <img src="{{ asset('img/kop-gaji.png') }}" width="95%">
                    </th>
                    <th scope="col" style="font-size: 15pt;border:2px solid #000 !important;vertical-align: middle;" class="text-center" colspan="4"><b>PENERIMAAN GAJI PEGAWAI</b></th>
                </tr>
                <tr>
                    <td style="border:2px solid #000 !important;">
                        Nama :<br>
                        Golongan :
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Yussuf Faisal<br>
                        IIIA
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Bulan :
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Juli 2021
                    </td>
                </tr>
            </thead>
            <tbody style="border:2px solid #000 !important;">
                <tr>
                    <td style="border:2px solid #000 !important;">
                        <b>Penerimaan :</b><br>
                        1. Gaji Pokok<br>
                        2. Tunjangan
                    </td>
                    <td style="border:2px solid #000 !important;">
                        <br>
                        Rp 2.000.000,00<br>
                        Rp 500.000,00
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        <b>Potongan :</b><br>
                        1. Saham Koperasi<br>
                        2. Tabungan Koperasi
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        <br>
                        Rp 5.000,00<br>
                        Rp 10.000,00
                    </td>
                </tr>
                <tr>
                    <td style="border:2px solid #000 !important;"><b>Total Penerimaan</b></td>
                    <td style="border:2px solid #000 !important;">Rp 2.500.000,00</td>
                    <td style="border:2px solid #000 !important;" colspan="2"><b>Total Potongan</b></td>
                    <td style="border:2px solid #000 !important;" colspan="2">Rp 15.000,00</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-7" style="font-size: 15pt;">
                <b><u>TOTAL DITERIMA : Rp 2.485.000,00</u></b>
            </div>
            <div class="col-md-5">
                <br>
                Sukoharjo, 01-04-2021<br>
                Direktur Keuangan dan Perencanaan<br><br>
                Zainal Muttaqin
            </div>
        </div>
    </div><br>
    {{-- <div class="" style="font-size: 13.5pt;margin-top:20px;margin-left:10px;margin-right:40px;margin-bottom:20px">
        <table class="table table-bordered" style="width: 100%;border:2px solid #000 !important;">
            <colgroup>
                <col span="1" style="width: 32%;">
                <col span="1" style="width: 18%;">
                <col span="1" style="width: 12%;">
                <col span="1" style="width: 18%;">
                <col span="1" style="width: 9%;">
                <col span="1" style="width: 11%;">
            </colgroup>
            <thead style="border:2px solid #000 !important;">
                <tr>
                    <th scope="col" style="border:2px solid #000 !important;vertical-align: middle;" class="text-center" rowspan="2" colspan="2">
                        <img src="{{ asset('img/kop-gaji.png') }}" width="95%">
                    </th>
                    <th scope="col" style="font-size: 15pt;border:2px solid #000 !important;vertical-align: middle;" class="text-center" colspan="4"><b>PENERIMAAN GAJI PEGAWAI</b></th>
                </tr>
                <tr>
                    <td style="border:2px solid #000 !important;">
                        Nama :<br>
                        Golongan :
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Yussuf Faisal<br>
                        IIIA
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Bulan :
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Juli 2021
                    </td>
                </tr>
            </thead>
            <tbody style="border:2px solid #000 !important;">
                <tr>
                    <td style="border:2px solid #000 !important;">
                        <b>Penerimaan :</b><br>
                        1. Gaji Pokok<br>
                        2. Tunjangan
                    </td>
                    <td style="border:2px solid #000 !important;">
                        <br>
                        Rp 2.000.000,00<br>
                        Rp 500.000,00
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        <b>Potongan</b><br>
                        1. Saham Koperasi<br>
                        2. Tabungan Koperasi
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        <br>
                        Rp 5.000,00<br>
                        Rp 10.000,00
                    </td>
                </tr>
                <tr>
                    <td style="border:2px solid #000 !important;"><b>Total Penerimaan</b></td>
                    <td style="border:2px solid #000 !important;">Rp 2.500.000,00</td>
                    <td style="border:2px solid #000 !important;" colspan="2"><b>Total Potongan</b></td>
                    <td style="border:2px solid #000 !important;" colspan="2">Rp 15.000,00</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-7" style="font-size: 15pt;">
                <b><u>TOTAL DITERIMA : Rp 2.485.000,00</u></b>
            </div>
            <div class="col-md-5">
                <br>
                Sukoharjo, 01-04-2021<br>
                Direktur Keuangan dan Perencanaan<br><br>
                Zainal Muttaqin
            </div>
        </div>
    </div><br>
    <div class="" style="font-size: 13.5pt;margin-top:20px;margin-left:10px;margin-right:40px;margin-bottom:20px">
        <table class="table table-bordered" style="width: 100%;border:2px solid #000 !important;">
            <colgroup>
                <col span="1" style="width: 32%;">
                <col span="1" style="width: 18%;">
                <col span="1" style="width: 12%;">
                <col span="1" style="width: 18%;">
                <col span="1" style="width: 9%;">
                <col span="1" style="width: 11%;">
            </colgroup>
            <thead style="border:2px solid #000 !important;">
                <tr>
                    <th scope="col" style="border:2px solid #000 !important;vertical-align: middle;" class="text-center" rowspan="2" colspan="2">
                        <img src="{{ asset('img/kop-gaji.png') }}" width="95%">
                    </th>
                    <th scope="col" style="font-size: 15pt;border:2px solid #000 !important;vertical-align: middle;" class="text-center" colspan="4"><b>PENERIMAAN GAJI PEGAWAI</b></th>
                </tr>
                <tr>
                    <td style="border:2px solid #000 !important;">
                        Nama :<br>
                        Golongan :
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Yussuf Faisal<br>
                        IIIA
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Bulan :
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Juli 2021
                    </td>
                </tr>
            </thead>
            <tbody style="border:2px solid #000 !important;">
                <tr>
                    <td style="border:2px solid #000 !important;">
                        <b>Penerimaan :</b><br>
                        1. Gaji Pokok<br>
                        2. Tunjangan
                    </td>
                    <td style="border:2px solid #000 !important;">
                        <br>
                        Rp 2.000.000,00<br>
                        Rp 500.000,00
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        <b>Potongan</b><br>
                        1. Saham Koperasi<br>
                        2. Tabungan Koperasi
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        <br>
                        Rp 5.000,00<br>
                        Rp 10.000,00
                    </td>
                </tr>
                <tr>
                    <td style="border:2px solid #000 !important;"><b>Total Penerimaan</b></td>
                    <td style="border:2px solid #000 !important;">Rp 2.500.000,00</td>
                    <td style="border:2px solid #000 !important;" colspan="2"><b>Total Potongan</b></td>
                    <td style="border:2px solid #000 !important;" colspan="2">Rp 15.000,00</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-7" style="font-size: 15pt;">
                <b><u>TOTAL DITERIMA : Rp 2.485.000,00</u></b>
            </div>
            <div class="col-md-5">
                <br>
                Sukoharjo, 01-04-2021<br>
                Direktur Keuangan dan Perencanaan<br><br>
                Zainal Muttaqin
            </div>
        </div>
    </div> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script>
        window.onload = window.print;
        // document_focus = true;
        // win = window.open();
        // Now our event handlers.
        // setInterval(function() { if (document_focus === true) { window.close(); }  }, 300);
    </script>
</body>
</html>
