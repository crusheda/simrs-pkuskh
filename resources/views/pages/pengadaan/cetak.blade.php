<html>
<head>
    <title>Pengadaan - {{ $tgl }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
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
            <a><b>FORM PENGADAAN BARANG {{ $jnspengadaan }}</b></a><br>
            <a><b>KEBUTUHAN UNIT {{ $unit }}</b></a>
        </center><br>

        <a>Tgl : {{ $tgl }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pemohon : {{ $pemohon }}</a>
        <br>

        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">BARANG</th>
                <th scope="col">JUMLAH</th>
                <th scope="col">SATUAN</th>
                <th scope="col">HARGA</th>
                <th scope="col">TOTAL</th>
                <th scope="col">KETERANGAN</th>
              </tr>
            </thead>
            <tbody>
                @if($barang1 != null)
                <tr>
                    <td>1</td>
                    <th scope="row">{{ $barang1 }}</th>
                    <td>{{ $jumlah1 }}</td>
                    <td>{{ $satuan1 }}</td>
                    <td>{{ $harga1 }}</td>
                    <td>{{ $total1 }}</td>
                    <td>{{ $keterangan1 }}</td>
                </tr>
                @endif
                @if($barang2 != null)
                <tr>
                    <td>2</td>
                    <th scope="row">{{ $barang2 }}</th>
                    <td>{{ $jumlah2 }}</td>
                    <td>{{ $satuan2 }}</td>
                    <td>{{ $harga2 }}</td>
                    <td>{{ $total2 }}</td>
                    <td>{{ $keterangan2 }}</td>
                </tr>
                @endif
                @if($barang3 != null)
                <tr>
                    <td>3</td>
                    <th scope="row">{{ $barang3 }}</th>
                    <td>{{ $jumlah3 }}</td>
                    <td>{{ $satuan3 }}</td>
                    <td>{{ $harga3 }}</td>
                    <td>{{ $total3 }}</td>
                    <td>{{ $keterangan3 }}</td>
                </tr>
                @endif
                @if($barang4 != null)
                <tr>
                    <td>4</td>
                    <th scope="row">{{ $barang4 }}</th>
                    <td>{{ $jumlah4 }}</td>
                    <td>{{ $satuan4 }}</td>
                    <td>{{ $harga4 }}</td>
                    <td>{{ $total4 }}</td>
                    <td>{{ $keterangan4 }}</td>
                </tr>
                @endif
                @if($barang5 != null)
                <tr>
                    <td>5</td>
                    <th scope="row">{{ $barang5 }}</th>
                    <td>{{ $jumlah5 }}</td>
                    <td>{{ $satuan5 }}</td>
                    <td>{{ $harga5 }}</td>
                    <td>{{ $total5 }}</td>
                    <td>{{ $keterangan5 }}</td>
                </tr>
                @endif
                @if($barang6 != null)
                <tr>
                    <td>6</td>
                    <th scope="row">{{ $barang6 }}</th>
                    <td>{{ $jumlah6 }}</td>
                    <td>{{ $satuan6 }}</td>
                    <td>{{ $harga6 }}</td>
                    <td>{{ $total6 }}</td>
                    <td>{{ $keterangan6 }}</td>
                </tr>
                @endif
                @if($barang7 != null)
                <tr>
                    <td>7</td>
                    <th scope="row">{{ $barang7 }}</th>
                    <td>{{ $jumlah7 }}</td>
                    <td>{{ $satuan7 }}</td>
                    <td>{{ $harga7 }}</td>
                    <td>{{ $total7 }}</td>
                    <td>{{ $keterangan7 }}</td>
                </tr>
                @endif
                @if($barang8 != null)
                <tr>
                    <td>8</td>
                    <th scope="row">{{ $barang8 }}</th>
                    <td>{{ $jumlah8 }}</td>
                    <td>{{ $satuan8 }}</td>
                    <td>{{ $harga8 }}</td>
                    <td>{{ $total1 }}</td>
                    <td>{{ $keterangan8 }}</td>
                </tr>
                @endif
                @if($barang9 != null)
                <tr>
                    <td>9</td>
                    <th scope="row">{{ $barang9 }}</th>
                    <td>{{ $jumlah9 }}</td>
                    <td>{{ $satuan9 }}</td>
                    <td>{{ $harga9 }}</td>
                    <td>{{ $total9 }}</td>
                    <td>{{ $keterangan9 }}</td>
                </tr>
                @endif
                @if($barang10 != null)
                <tr>
                    <td>10</td>
                    <th scope="row">{{ $barang10 }}</th>
                    <td>{{ $jumlah10 }}</td>
                    <td>{{ $satuan10 }}</td>
                    <td>{{ $harga10 }}</td>
                    <td>{{ $total10 }}</td>
                    <td>{{ $keterangan10 }}</td>
                </tr>
                @endif
                @if($barang11 != null)
                <tr>
                    <td>11</td>
                    <th scope="row">{{ $barang11 }}</th>
                    <td>{{ $jumlah11 }}</td>
                    <td>{{ $satuan11 }}</td>
                    <td>{{ $harga11 }}</td>
                    <td>{{ $total11 }}</td>
                    <td>{{ $keterangan11 }}</td>
                </tr>
                @endif
                @if($barang12 != null)
                <tr>
                    <td>12</td>
                    <th scope="row">{{ $barang12 }}</th>
                    <td>{{ $jumlah12 }}</td>
                    <td>{{ $satuan12 }}</td>
                    <td>{{ $harga12 }}</td>
                    <td>{{ $total12 }}</td>
                    <td>{{ $keterangan12 }}</td>
                </tr>
                @endif
                @if($barang13 != null)
                <tr>
                    <td>13</td>
                    <th scope="row">{{ $barang13 }}</th>
                    <td>{{ $jumlah13 }}</td>
                    <td>{{ $satuan13 }}</td>
                    <td>{{ $harga13 }}</td>
                    <td>{{ $total13 }}</td>
                    <td>{{ $keterangan13 }}</td>
                </tr>
                @endif
                @if($barang14 != null)
                <tr>
                    <td>14</td>
                    <th scope="row">{{ $barang14 }}</th>
                    <td>{{ $jumlah14 }}</td>
                    <td>{{ $satuan14 }}</td>
                    <td>{{ $harga14 }}</td>
                    <td>{{ $total14 }}</td>
                    <td>{{ $keterangan14 }}</td>
                </tr>
                @endif
                @if($barang15 != null)
                <tr>
                    <td>15</td>
                    <th scope="row">{{ $barang15 }}</th>
                    <td>{{ $jumlah15 }}</td>
                    <td>{{ $satuan15 }}</td>
                    <td>{{ $harga15 }}</td>
                    <td>{{ $total15 }}</td>
                    <td>{{ $keterangan15 }}</td>
                </tr>
                @endif
                @if($barang16 != null)
                <tr>
                    <td>16</td>
                    <th scope="row">{{ $barang16 }}</th>
                    <td>{{ $jumlah16 }}</td>
                    <td>{{ $satuan16 }}</td>
                    <td>{{ $harga16 }}</td>
                    <td>{{ $total16 }}</td>
                    <td>{{ $keterangan16 }}</td>
                </tr>
                @endif
                @if($barang17 != null)
                <tr>
                    <td>17</td>
                    <th scope="row">{{ $barang17 }}</th>
                    <td>{{ $jumlah17 }}</td>
                    <td>{{ $satuan17 }}</td>
                    <td>{{ $harga17 }}</td>
                    <td>{{ $total17 }}</td>
                    <td>{{ $keterangan17 }}</td>
                </tr>
                @endif
                @if($barang18 != null)
                <tr>
                    <td>18</td>
                    <th scope="row">{{ $barang18 }}</th>
                    <td>{{ $jumlah18 }}</td>
                    <td>{{ $satuan18 }}</td>
                    <td>{{ $harga18 }}</td>
                    <td>{{ $total18 }}</td>
                    <td>{{ $keterangan18 }}</td>
                </tr>
                @endif
                @if($barang19 != null)
                <tr>
                    <td>19</td>
                    <th scope="row">{{ $barang19 }}</th>
                    <td>{{ $jumlah19 }}</td>
                    <td>{{ $satuan19 }}</td>
                    <td>{{ $harga19 }}</td>
                    <td>{{ $total19 }}</td>
                    <td>{{ $keterangan19 }}</td>
                </tr>
                @endif
                @if($barang20 != null)
                <tr>
                    <td>20</td>
                    <th scope="row">{{ $barang20 }}</th>
                    <td>{{ $jumlah20 }}</td>
                    <td>{{ $satuan20 }}</td>
                    <td>{{ $harga20 }}</td>
                    <td>{{ $total20 }}</td>
                    <td>{{ $keterangan20 }}</td>
                </tr>
                @endif
            </tbody>
        </table>
        @if ($jnspengadaan == 'rutin')
            <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketua Tim Pengadaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Kepala Sub Bagian</a><br><br><br><br>
            <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(_______________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                (_______________________)</a>
        @else
            <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wadir......................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Bagian&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;Kepala Sub Bagian</a><br><br><br><br>
            <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(______________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(______________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(______________________)</a>
            <br><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mengetahui,</a><br>
            <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketua Tim Pengadaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wadir Keuangan&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direktur</a><br><br><br><br>
            <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(______________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(______________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(______________________)</a><br><br>
        @endif
</body>
</html>
