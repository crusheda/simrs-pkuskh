@extends('layouts.newAdmin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
          <div class="card-header">
              <h4>Data Rawat Inap <span class="badge badge-danger">HARI INI</span></h4>
          </div>
            <div class="card-body">
                <div class="data-table-list">
                    <div class="table-responsive">
                        {{-- <small><kbd>Data Pasien</kbd> yang ditampilkan diurutkan berdasarkan <b>Tanggal Keluar</b> terakhir.</small><br><br> --}}
                        <table id="pilar" class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Ruang</th>
                                    <th>Jumlah (Pasien)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bangsal Lt.3</td>
                                    <td id="lt3"></td>
                                </tr>
                                <tr>
                                    <td>Bangsal Lt.4</td>
                                    <td id="lt4"></td>
                                </tr>
                                <tr>
                                    <td>Kebidanan</td>
                                    <td id="keb"></td>
                                </tr>
                                <tr>
                                    <td>Perinatologi</td>
                                    <td id="perin"></td>
                                </tr>
                                <tr>
                                    <td>Isolasi</td>
                                    <td id="iso"></td>
                                </tr>
                                <tr>
                                    <td>ICU</td>
                                    <td id="icu"></td>
                                </tr>
                            </tbody>
                            <tfoot style="background-color:#F5F5F5">
                                <tr>
                                    <th>Total</th>
                                    <th id="total"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <table id="pilar" class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Pasien Pulang Rawat Inap</th>
                            <th>Jumlah (Pasien)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Umum</td>
                            <td id="umum"></td>
                        </tr>
                        <tr>
                            <td>Bpjs</td>
                            <td id="bpjs"></td>
                        </tr>
                    </tbody>
                </table>
                <table id="pilar" class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Jumlah (Pasien)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Laborat</td>
                            <td id="lab"></td>
                        </tr>
                        <tr>
                            <td>Radiologi</td>
                            <td id="rad"></td>
                        </tr>
                        <tr>
                            <td>Pasien Inap</td>
                            <td id="inap"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 100%">
          <div class="card-header">
              <h4>Data Kunjungan Rawat Jalan <span class="badge badge-info">KEMARIN</span></kbd></h4>
          </div>
            <div class="card-body">
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="pilar" class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Jumlah (Pasien)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rawat Darurat (IGD)</td>
                                    <td id="kd_igd"></td>
                                </tr>
                                <tr>
                                    <td>Poli Anak</td>
                                    <td id="kd_anak"></td>
                                </tr>
                                <tr>
                                    <td>Poli Bedah</td>
                                    <td id="kd_bedah"></td>
                                </tr>
                                <tr>
                                    <td>Poli Gigi</td>
                                    <td id="kd_gigi"></td>
                                </tr>
                                <tr>
                                    <td>Poli Dalam</td>
                                    <td id="kd_dalam"></td>
                                </tr>
                                <tr>
                                    <td>Poli Ortopedi</td>
                                    <td id="kd_ortopedi"></td>
                                </tr>
                                <tr>
                                    <td>Poli Jiwa</td>
                                    <td id="kd_jiwa"></td>
                                </tr>
                                <tr>
                                    <td>Poli Kulit & Kelamin</td>
                                    <td id="kd_kulit"></td>
                                </tr>
                                <tr>
                                    <td>Poli THT</td>
                                    <td id="kd_tht"></td>
                                </tr>
                                <tr>
                                    <td>Poli Paru</td>
                                    <td id="kd_paru"></td>
                                </tr>
                                <tr>
                                    <td>Poli Syaraf</td>
                                    <td id="kd_syaraf"></td>
                                </tr>
                                <tr>
                                    <td>Poli Rehabilitasi Medik</td>
                                    <td id="kd_rehab"></td>
                                </tr>
                                <tr>
                                    <td>Poli Kebidanan</td>
                                    <td id="kd_kebidanan"></td>
                                </tr>
                                <tr>
                                    <td>Poli Mata</td>
                                    <td id="kd_mata"></td>
                                </tr>
                            </tbody>
                            <tfoot style="background-color:#F5F5F5">
                                <tr>
                                    <th>Total</th>
                                    <th id="kd_total"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>   
    $(document).ready(function() { 
        $.ajax(
            {
                url: "http://192.168.1.3:8000/api/kunjungan/",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res.akomodasi.now)
                    var datenow = res.akomodasi.now;
                    var date = new Date(datenow);
                    // console.log(date);  // Wed Jan 01 2014 13:28:56 GMT-1000 (Hawaiian Standard Time)
                    $("#tglnow").append(date);
                    $("#tglyest").append(res.kunjungan.yest);
                    
                    // Data Rekap Kunjungan Pasien
                        $.each(res.kunjungan.igd, function(index, el) {
                            $("#kd_igd").append(el.jumlah);
                        });
                        $.each(res.kunjungan.anak, function(index, el) {
                            $("#kd_anak").append(el.jumlah);
                        });
                        $.each(res.kunjungan.bedah, function(index, el) {
                            $("#kd_bedah").append(el.jumlah);
                        });
                        $.each(res.kunjungan.gigi, function(index, el) {
                            $("#kd_gigi").append(el.jumlah);
                        });
                        $.each(res.kunjungan.dalam, function(index, el) {
                            $("#kd_dalam").append(el.jumlah);
                        });
                        $.each(res.kunjungan.orto, function(index, el) {
                            $("#kd_ortopedi").append(el.jumlah);
                        });
                        $.each(res.kunjungan.jiwa, function(index, el) {
                            $("#kd_jiwa").append(el.jumlah);
                        });
                        $.each(res.kunjungan.kulit, function(index, el) {
                            $("#kd_kulit").append(el.jumlah);
                        });
                        $.each(res.kunjungan.tht, function(index, el) {
                            $("#kd_tht").append(el.jumlah);
                        });
                        $.each(res.kunjungan.paru, function(index, el) {
                            $("#kd_paru").append(el.jumlah);
                        });
                        $.each(res.kunjungan.syaraf, function(index, el) {
                            $("#kd_syaraf").append(el.jumlah);
                        });
                        $.each(res.kunjungan.rehab, function(index, el) {
                            $("#kd_rehab").append(el.jumlah);
                        });
                        $.each(res.kunjungan.keb, function(index, el) {
                            $("#kd_kebidanan").append(el.jumlah);
                        });
                        $.each(res.kunjungan.mata, function(index, el) {
                            $("#kd_mata").append(el.jumlah);
                        });
                        $.each(res.kunjungan.total, function(index, el) {
                            $("#kd_total").append(el.jumlah);
                        });
                        $.each(res.kunjungan.umum, function(index, el) {
                            $("#umum").append(el.jumlah);
                        });
                        $.each(res.kunjungan.bpjs, function(index, el) {
                            $("#bpjs").append(el.jumlah);
                        });
                        $.each(res.kunjungan.inap, function(index, el) {
                            $("#inap").append(el.jumlah);
                        });
                        $("#lab").append(Object.keys(res.kunjungan.lab).length);
                        $("#rad").append(Object.keys(res.kunjungan.rad).length);
                    // Data Rawat Inap Pasien
                    // console.log(res.akomodasi);
                    // res.akomodasi.forEach(function (item) {
                    //     $('#halo').append('<p>' + item + '</p>');
                    // })
                        $.each(res.akomodasi.lt3, function(index, el) {
                            $("#lt3").append(el.jumlah);
                        });
                        $.each(res.akomodasi.lt4, function(index, el) {
                            $("#lt4").append(el.jumlah);
                        });
                        $.each(res.akomodasi.keb, function(index, el) {
                            $("#keb").append(el.jumlah);
                        });
                        $.each(res.akomodasi.per, function(index, el) {
                            $("#perin").append(el.jumlah);
                        });
                        $.each(res.akomodasi.iso, function(index, el) {
                            $("#iso").append(el.jumlah);
                        });
                        $.each(res.akomodasi.icu, function(index, el) {
                            $("#icu").append(el.jumlah);
                        });
                        $.each(res.akomodasi.total, function(index, el) {
                            $("#total").append(el.jumlah);
                        });
                }
            }
        );
        $.ajax(
            {
                url: "http://103.155.246.25:8000/api/kunjungan/",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res.akomodasi.now)
                    var datenow = res.akomodasi.now;
                    var date = new Date(datenow);
                    // console.log(date);  // Wed Jan 01 2014 13:28:56 GMT-1000 (Hawaiian Standard Time)
                    $("#tglnow").append(date);
                    $("#tglyest").append(res.kunjungan.yest);
                    
                    // Data Rekap Kunjungan Pasien
                        $.each(res.kunjungan.igd, function(index, el) {
                            $("#kd_igd").append(el.jumlah);
                        });
                        $.each(res.kunjungan.anak, function(index, el) {
                            $("#kd_anak").append(el.jumlah);
                        });
                        $.each(res.kunjungan.bedah, function(index, el) {
                            $("#kd_bedah").append(el.jumlah);
                        });
                        $.each(res.kunjungan.gigi, function(index, el) {
                            $("#kd_gigi").append(el.jumlah);
                        });
                        $.each(res.kunjungan.dalam, function(index, el) {
                            $("#kd_dalam").append(el.jumlah);
                        });
                        $.each(res.kunjungan.orto, function(index, el) {
                            $("#kd_ortopedi").append(el.jumlah);
                        });
                        $.each(res.kunjungan.jiwa, function(index, el) {
                            $("#kd_jiwa").append(el.jumlah);
                        });
                        $.each(res.kunjungan.kulit, function(index, el) {
                            $("#kd_kulit").append(el.jumlah);
                        });
                        $.each(res.kunjungan.tht, function(index, el) {
                            $("#kd_tht").append(el.jumlah);
                        });
                        $.each(res.kunjungan.paru, function(index, el) {
                            $("#kd_paru").append(el.jumlah);
                        });
                        $.each(res.kunjungan.syaraf, function(index, el) {
                            $("#kd_syaraf").append(el.jumlah);
                        });
                        $.each(res.kunjungan.rehab, function(index, el) {
                            $("#kd_rehab").append(el.jumlah);
                        });
                        $.each(res.kunjungan.keb, function(index, el) {
                            $("#kd_kebidanan").append(el.jumlah);
                        });
                        $.each(res.kunjungan.mata, function(index, el) {
                            $("#kd_mata").append(el.jumlah);
                        });
                        $.each(res.kunjungan.total, function(index, el) {
                            $("#kd_total").append(el.jumlah);
                        });
                    // Data Rawat Inap Pasien
                    // console.log(res.akomodasi);
                    // res.akomodasi.forEach(function (item) {
                    //     $('#halo').append('<p>' + item + '</p>');
                    // })
                        $.each(res.akomodasi.lt3, function(index, el) {
                            console.log(el.jumlah);
                            $("#lt3").append(el.jumlah);
                        });
                        $.each(res.akomodasi.lt4, function(index, el) {
                            console.log(el.jumlah);
                            $("#lt4").append(el.jumlah);
                        });
                        $.each(res.akomodasi.keb, function(index, el) {
                            console.log(el.jumlah);
                            $("#keb").append(el.jumlah);
                        });
                        $.each(res.akomodasi.per, function(index, el) {
                            console.log(el.jumlah);
                            $("#perin").append(el.jumlah);
                        });
                        $.each(res.akomodasi.iso, function(index, el) {
                            console.log(el.jumlah);
                            $("#iso").append(el.jumlah);
                        });
                        $.each(res.akomodasi.icu, function(index, el) {
                            console.log(el.jumlah);
                            $("#icu").append(el.jumlah);
                        });
                        $.each(res.akomodasi.total, function(index, el) {
                            console.log(el.jumlah);
                            $("#total").append(el.jumlah);
                        });
                }
            }
        );
    })
</script>
@endsection