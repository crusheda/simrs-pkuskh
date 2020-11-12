@extends('layouts.landing')

@section('content')
<!-- Page top Section -->
<section class="page-top-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto text-white">
                <h2>Data Kunjungan Pasien</h2>
                <span class="badge badge-pill badge-light text-dark" id="tglnow"></span>
            </div>
        </div>
    </div>
</section>
<section class="classes-page-section spad overflow-hidden" style="padding-bottom: 30px">
    <div class="container">
        <div class="row">
            <h4>Rekap Kunjungan Pasien <span class="badge badge-pill badge-warning" id="tglyest"></span></h4>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Rawat Darurat (IGD)</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_igd"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Anak</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_anak"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Bedah</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_bedah"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Gigi</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_gigi"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Dalam</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_dalam"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Ortopedi</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_ortopedi"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Jiwa</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_jiwa"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Kulit/Kelamin</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_kulit"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli THT</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_tht"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Paru</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_paru"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Syaraf</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_syaraf"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Rehabilitasi Medik</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_rehab"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Kebidanan</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_kebidanan"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="classes-item-warp">
                            <div class="classes-item">
                                <div class="ci-text">
                                    <h5>Poli Mata</h5><hr>
                                    <div class="ci-metas">
                                        <div class="ci-meta"><h6 id="kd_mata"></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="overflow-hidden">
    <div class="container">
        <h4>Data Rawat Inap Pasien <a class="text-warning"><b>Hari Ini</b></a></h4><br>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-bordered display">
                    <thead>
                        <tr>
                            <th scope="col">RUANG</th>
                            <th scope="col">JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Bangsal Lt.3</th>
                            <td id="lt3"></td>
                        </tr>
                        <tr>
                            <th scope="row">Bangsal Lt.4</th>
                            <td id="lt4"></td>
                        </tr>
                        <tr>
                            <th scope="row">Kebidanan</th>
                            <td id="keb"></td>
                        </tr>
                        <tr>
                            <th scope="row">Perinatologi</th>
                            <td id="perin"></td>
                        </tr>
                        <tr>
                            <th scope="row">Isolasi</th>
                            <td id="iso"></td>
                        </tr>
                        <tr>
                            <th scope="row">ICU</th>
                            <td id="icu"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">TOTAL</th>
                            <th scope="col" id="total"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-lg-6">
                This Sistem is under contruction.
            </div>
        </div>
    </div>
</section>
<!-- Classes Section end -->

<script src="{{ asset('css-landing/js/vendor/jquery-3.2.1.min.js') }}"></script>
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
<script>   
$(document).ready(function() { 
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