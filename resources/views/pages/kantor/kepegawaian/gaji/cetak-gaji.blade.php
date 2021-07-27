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
                        {{ $list['show'][0]->nama }}<br>
                        {{ $list['show'][0]->nama_golongan }}
                    </td>
                    <td style="border:2px solid #000 !important;">
                        Bulan :<br>
                        Tahun :
                    </td>
                    <td style="border:2px solid #000 !important;">
                        {{ $list['bulan'] }}<br>
                        {{ $list['tahun'] }}
                    </td>
                </tr>
            </thead>
            <tbody style="border:2px solid #000 !important;">
                <tr>
                    <td style="border:2px solid #000 !important;">
                        <b>Penerimaan :</b><br>
                        1. Gaji Pokok<br>
                        2. Tunjangan Struktural<br>
                        3. Tunjangan Fungsional<br>
                        4. Insentif Kehadiran
                    </td>
                    <td style="border:2px solid #000 !important;">
                        <br>
                        {{ number_format($list['show'][0]->gapok,0,"",".") }}<br>
                        {{ number_format($list['show'][0]->struktural,0,"",".") }}<br>
                        {{ number_format($list['show'][0]->fungsional,0,"",".") }}<br>
                        {{ number_format($list['show'][0]->insentif,0,"",".") }}
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        <b>Potongan :</b><br>
                        @if ($list['show'][0]->iuran_pokok == true)
                            1. Koperasi / Iuran Pokok
                        @else
                            1. Koperasi / Iuran Wajib
                        @endif
                        @php $i = 2; @endphp
                        @foreach($list['ref_potong'] as $key => $item)
                            @foreach($list['potongHas'] as $value) 
                                @if ($value->id_potong == $item->id)
                                    <br>{{ $i++ }}. {{ $item->kriteria }}
                                @endif 
                            @endforeach
                        @endforeach
                        <br>{{ $i }}. Infaq
                    </td>
                    <td style="border:2px solid #000 !important;" colspan="2">
                        @if ($list['show'][0]->iuran_pokok == true)
                            <br>100.000    
                        @else
                            <br>5.000    
                        @endif
                        @foreach($list['ref_potong'] as $key => $item)
                            @foreach($list['potongHas'] as $value) 
                                @if ($value->id_potong == $item->id)
                                    <br>{{ number_format( $value->nominal,0,"",".") }}
                                @endif 
                            @endforeach
                        @endforeach
                        <br>{{ number_format( $list['show'][0]->infaq,0,"",".") }}
                    </td>
                </tr>
                <tr>
                    <td style="border:2px solid #000 !important;"><b>Total Penerimaan</b></td>
                    <td style="border:2px solid #000 !important;">Rp {{ number_format($list['show'][0]->total_kotor,2,",",".") }}</td>
                    <td style="border:2px solid #000 !important;" colspan="2"><b>Total Potongan</b></td>
                    <td style="border:2px solid #000 !important;" colspan="2">Rp {{ number_format($list['show'][0]->total_potong,2,",",".") }}</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-7" style="font-size: 15pt;">
                <b><u>TOTAL DITERIMA : Rp {{ number_format($list['show'][0]->total_bersih,2,",",".") }}</u></b>
            </div>
            <div class="col-md-5">
                <br>
                Sukoharjo, {{ $list['tgl'] }}<br>
                Direktur Keuangan dan Perencanaan<br><br>
                {{ $list['ttd'] }}
            </div>
        </div>
    </div>
    
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
