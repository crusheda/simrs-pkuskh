@extends('layouts.simrsmuv2')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Laporan / PPI / Surveilans /</span> Tambah
    </h4>

    @if (session('message'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Berhasil!</h6>
            <p class="mb-0">{{ session('message') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if ($errors->count() > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Proses Gagal!</h6>
            <p class="mb-0">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif


    <div class="row">
        <div class="col-12 mb-4">
            <div class="bs-stepper wizard-numbered mt-2">
                <div class="bs-stepper-header">
                    <div class="step active" data-target="#account-details" id="step1">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">Data Pasien</span>
                                <span class="bs-stepper-subtitle">Step 1</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="bx bx-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#personal-info" id="step2">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">Informasi Keadaan</span>
                                <span class="bs-stepper-subtitle">Step 2</span>
                            </span>

                        </button>
                    </div>
                    <div class="line">
                        <i class="bx bx-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#social-links" id="step3">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">Data Pemasangan</span>
                                <span class="bs-stepper-subtitle">Step 3</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                        <!-- STEP 1 -->
                        <div class="content active dstepper-block" id="tampil1">
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Nomor Rekam Medik <a class="text-danger">*</a></label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-dark" type="button" id="btn-ubahrm" onclick="ubahrm()">Ubah</button>
                                            <input type="number" id="rm" name="rm" class="form-control" placeholder="Masukkan Nomor RM Pasien" required/>
                                        </div>
                                        <small>Tekan tombol ENTER / TAB untuk submit Nomor Rekam Medik</small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <input type="text" id="jns_kelamin_show" class="form-control" disabled/>
                                        <input type="text" id="jns_kelamin2" name="jns_kelamin" class="form-control" hidden/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Umur</label>
                                        <input type="text" id="umur_show" class="form-control" disabled/>
                                        <input type="text" id="umur" name="umur" class="form-control" hidden/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Nama Pasien</label>
                                        <input type="text" id="nama_show" class="form-control" disabled/>
                                        <input type="text" id="nama" name="nama" class="form-control" hidden/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Asal Pemasangan <a class="text-danger">*</a></label>
                                        <select class="form-control select2" name="asal_dipasang" style="width: 100%" required>
                                            <option value="">Pilih</option>
                                            <option value="1">IGD</option>
                                            <option value="2">POLIKLINIK</option>
                                            <option value="3">BANGSAL DEWASA</option>
                                            <option value="4">BANGSAL ANAK</option>
                                            <option value="5">ICU</option>
                                            <option value="6">KEBIDANAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Asal Ditemukan <a class="text-danger">*</a></label>
                                        <select class="form-control select2" name="asal_ditemukan" style="width: 100%" required>
                                            <option value="">Pilih</option>
                                            <option value="1">IGD</option>
                                            <option value="2">POLIKLINIK</option>
                                            <option value="3">BANGSAL DEWASA</option>
                                            <option value="4">BANGSAL ANAK</option>
                                            <option value="5">ICU</option>
                                            <option value="6">KEBIDANAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-label-dark" onclick="window.location='{{ route('surveilans.index') }}'">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                                    </button>
                                    <button class="btn btn-primary btn-tampil2">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Selanjutnya</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- STEP 2 -->
                        <div class="content" id="tampil2">
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Masuk <a class="text-danger">*</a></label>
                                        <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_masuk" required/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Diagnosa Masuk <a class="text-danger">*</a></label>
                                        <textarea name="diagnosa" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-primary btn-tampil1">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                    </button>
                                    <button class="btn btn-primary btn-tampil3">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Selanjutnya</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- STEP 3 -->
                        <div class="content" id="tampil3">
                            {{-- <div class="content-header mb-3">
                                <h6 class="mb-0">Social Links</h6>
                                <small>Enter Your Social Links.</small>
                            </div> --}}
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Jenis Surveilans <a class="text-danger">*</a></label>
                                        <select class="form-control select2" id="jns_surveilans" name="jns_surveilans" style="width: 100%" required>
                                            <option value="">Pilih</option>
                                            <option value="1">Phlebitis</option>
                                            <option value="2">Catheter Associated Urinary Tract Infection (CAUTI)</option>
                                            <option value="3">Ventilator Associated Pneumonia (VAP)</option>
                                            <option value="4">Infeksi Daerah Operasi (IDO)</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-12" style="margin-top: -5px">
                                    <div id="surveilans1" hidden>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Pemasangan <a class="text-danger">*</a></label>
                                                    <select class="form-control select2" name="jns_pemasangan" style="width: 100%" required>
                                                        <option value="">Pilih</option>
                                                        <option value="1">Kateter Vena Perifier</option>
                                                        <option value="2">Umbilical</option>
                                                        <option value="3">Double Lumen</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tujuan Pemasangan <a class="text-danger">*</a></label>
                                                    <div class="select2-dark">
                                                        <select class="select2 form-select" name="tujuan_pemasangan[]" data-allow-clear="true" data-bs-auto-close="outside" required multiple>
                                                            <option value="">Pilih</option>
                                                            <option value="1">Pemberian Obat</option>
                                                            <option value="2">Transfusi</option>
                                                            <option value="3">Nutrisi Parental</option>
                                                            <option value="4">Terapi Cairan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Lokasi <a class="text-danger">*</a></label>
                                                    <select class="form-control select2" name="lokasi" style="width: 100%" required>
                                                        <option value="">Pilih</option>
                                                        <option value="1">Tangan Kanan</option>
                                                        <option value="2">Tangan Kiri</option>
                                                        <option value="3">Kaki Kanan</option>
                                                        <option value="4">Kaki Kiri</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Pemasangan <a class="text-danger">*</a></label>
                                                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_pemasangan" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Infeksi <a class="text-danger">*</a></label>
                                                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_infeksi" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tanda-tanda Infeksi</label>
                                                    <div class="select2-dark">
                                                        <select class="select2 form-select" name="tanda_infeksi[]" data-allow-clear="true" data-bs-auto-close="outside" required multiple>
                                                            <option value="">Pilih</option>
                                                            <option value="1">Pembengkakan</option>
                                                            <option value="2">Kemerahan</option>
                                                            <option value="3">Panas Area Insersi</option>
                                                            <option value="4">Adanya Rasa Nyeri</option>
                                                            <option value="5">Venous Cord Teraba</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="content-header" style="margin-top: -2px">
                                                <h6 class="mb-1">Bundles Phlebitis <a class="text-danger">*</a></h6>
                                                <small>Pilih salah satu opsi lalu memilih jawaban Ya atau Tidak.</small>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <select class="form-control select2" name="opsi" style="width: 100%" required>
                                                        <option value="">Pilih</option>
                                                        <option value="1">Kebersihan tangan sebelum dan sesudah pemasangan</option>
                                                        <option value="2">Evaluasi IV kateter masih diperlukan atau tidak</option>
                                                        <option value="3">Melepas IV kateter bila ada keluhan/peradangan</option>
                                                        <option value="4">Pengecekan balutan pemasangan/dressing</option>
                                                        <option value="5">Pengecekan tempat pemasangan</option>
                                                        <option value="6">Penggantian IV kateter bila lebih dari 72 jam</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <select class="form-control select2" name="jawaban" style="width: 100%" disabled>
                                                        <option value="">Pilih</option>
                                                        <option value="1">Ya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="surveilans2" hidden>
                                        Ini CAUTI
                                    </div>
                                    <div id="surveilans3" hidden>
                                        Ini VAP
                                    </div>
                                    <div id="surveilans4" hidden>
                                        Ini IDO
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-primary btn-tampil2">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                    </button>
                                    <button class="btn btn-outline-success btn-submit">
                                        <i class="bx bx-save bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: e.parent()
                })
            });
            // BUTTON STEPPER
            $("#step1").click(function(){
                $("#step1").addClass('active');
                $("#step2").removeClass('active');
                $("#step3").removeClass('active');
                $("#tampil1").addClass('active dstepper-block');
                $("#tampil2").removeClass('active dstepper-block');
                $("#tampil3").removeClass('active dstepper-block');
            });
            $("#step2").click(function(){
                $("#step1").removeClass('active');
                $("#step2").addClass('active');
                $("#step3").removeClass('active');
                $("#tampil1").removeClass('active dstepper-block');
                $("#tampil2").addClass('active dstepper-block');
                $("#tampil3").removeClass('active dstepper-block');
            });
            $("#step3").click(function(){
                $("#step1").removeClass('active');
                $("#step2").removeClass('active');
                $("#step3").addClass('active');
                $("#tampil1").removeClass('active dstepper-block');
                $("#tampil2").removeClass('active dstepper-block');
                $("#tampil3").addClass('active dstepper-block');
            });
            // BUTTON TAMPIL SEBELUM / SELANJUTNYA
            $(".btn-tampil1").click(function(){
                $("#step1").addClass('active');
                $("#step2").removeClass('active');
                $("#step3").removeClass('active');
                $("#tampil1").addClass('active dstepper-block');
                $("#tampil2").removeClass('active dstepper-block');
                $("#tampil3").removeClass('active dstepper-block');
            });
            $(".btn-tampil2").click(function(){
                $("#step1").removeClass('active');
                $("#step2").addClass('active');
                $("#step3").removeClass('active');
                $("#tampil1").removeClass('active dstepper-block');
                $("#tampil2").addClass('active dstepper-block');
                $("#tampil3").removeClass('active dstepper-block');
            });
            $(".btn-tampil3").click(function(){
                $("#step1").removeClass('active');
                $("#step2").removeClass('active');
                $("#step3").addClass('active');
                $("#tampil1").removeClass('active dstepper-block');
                $("#tampil2").removeClass('active dstepper-block');
                $("#tampil3").addClass('active dstepper-block');
            });
            // DATEPICKER
                // DATE
                const l = $('.flatpickr');
                var now = moment().locale('id').format('Y-MM-DD HH:mm');
                l.flatpickr({
                    enableTime: 0,
                    minuteIncrement: 1,
                    defaultDate: now,
                    time_24hr: true,
                })
            // SELECT VALUE JENIS SURVEILANS
            $('#jns_surveilans').on('change', function() {
                if (this.value == '1') {
                    document.getElementById("surveilans1").hidden = false;
                } else {
                    document.getElementById("surveilans1").hidden = true;
                }
                if (this.value == '2') {
                    document.getElementById("surveilans2").hidden = false;
                } else {
                    document.getElementById("surveilans2").hidden = true;
                }
                if (this.value == '3') {
                    document.getElementById("surveilans3").hidden = false;
                } else {
                    document.getElementById("surveilans3").hidden = true;
                }
                if (this.value == '4') {
                    document.getElementById("surveilans4").hidden = false;
                } else {
                    document.getElementById("surveilans4").hidden = true;
                }
            });
            // GET RM
            $('#rm').change(function() { 
                if (this.value == '') {
                    $("#nama1").val("");
                    $("#nama2").val("");
                    $("#jns_kelamin1").val("");
                    $("#jns_kelamin2").val("");
                    $("#umur2").val("");
                    $("#umur1").val("");
                    $("#alamat1").val("");
                    $("#alamat2").val("");
                    $("#des").val("");
                    $("#kec").val("");
                    $("#kab").val("");
                } else {
                    if (this.value.length == 4) {
                        this.value = '0000'+this.value;
                    }
                    if (this.value.length == 5) {
                        this.value = '000'+this.value;
                    } 
                    if (this.value.length == 6) {
                        this.value = '00'+this.value;
                    }
                    if (this.value.length < 4) {
                        this.value = this.value;
                    }
                    $.ajax({
                        // url: "http://192.168.1.3:8000/api/all/"+this.value,
                        url: "/api/laporan/ppi/surveilans/getpasien/"+this.value,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            // console.log(res);
                            $("#nama_show").val(res.NAMAPASIEN);
                            $("#nama").val(res.NAMAPASIEN);
                            $("#jns_kelamin_show").val(res.JNSKELAMIN);
                            $("#jns_kelamin").val(res.JNSKELAMIN);
                            $("#umur_show").val(res.UMUR);
                            $("#umur").val(res.UMUR);
                        }
                    });
                }
            });
            // const e = document.querySelector(".wizard-numbered"),
            // t = [].slice.call(e.querySelectorAll(".btn-next")),
            // l = [].slice.call(e.querySelectorAll(".btn-prev")),
            // phone = document.querySelectorAll(".phone");
            // if (e, null !== e) {
            //     const i = new Stepper(e, {
            //         linear: !1
            //     });
            //     t && t.forEach(e => {
            //         e.addEventListener("click", e => {
            //             i.next()
            //         })
            //     }),
            //     l && l.forEach(e => {
            //         e.addEventListener("click", e => {
            //             i.previous()
            //         })
            //     })
            // }
        });
    </script>
@endsection
