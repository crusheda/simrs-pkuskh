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

    <style>
        .big-checkbox {width: 20px; height: 20px;}
    </style>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="bs-stepper wizard-numbered mt-2">
                <form id="tambah" class="form-auth-small" action="{{ route('surveilans.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
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
                                            <a class="btn btn-outline-dark" type="button" href="javascript:void(0);" id="btn-ubahrm" onclick="ubahrm()">Ubah</a>
                                            <input type="number" id="rm" name="rm" class="form-control" placeholder="Masukkan Nomor RM Pasien" onkeydown="return (event.keyCode!=13);" required/>
                                        </div>
                                        <small>Tekan tombol <strong>TAB</strong> untuk submit Nomor Rekam Medik</small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <input type="text" id="jns_kelamin_show" class="form-control" placeholder="Terisi Otomatis" disabled/>
                                        <input type="text" id="jns_kelamin" name="jns_kelamin" class="form-control" hidden/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Umur</label>
                                        <input type="text" id="umur_show" class="form-control" placeholder="Terisi Otomatis" disabled/>
                                        <input type="text" id="umur" name="umur" class="form-control" hidden/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Nama Pasien</label>
                                        <input type="text" id="nama_show" class="form-control" placeholder="Terisi Otomatis" disabled/>
                                        <input type="text" id="nama" name="nama" class="form-control" hidden/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Asal Pemasangan <a class="text-danger">*</a></label>
                                        <select class="form-control select2" name="asal_pasang" style="width: 100%" required>
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
                                    <a class="btn btn-label-dark text-white" href="javascript:void(0);" onclick="window.location='{{ route('surveilans.index') }}'">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                                    </a>
                                    <a class="align-middle mt-3"><small><b class="text-danger">*</b> Wajib Disi</small></a>
                                    <a class="btn btn-primary btn-tampil2 text-white">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1" href="javascript:void(0);">Selanjutnya</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </a>
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
                                        <textarea name="diagnosa" class="form-control" placeholder="e.g. Pasien Bronkitis, Pneumonia (PNE), Gastritis, etc" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a class="btn btn-primary btn-tampil1 text-white" href="javascript:void(0);">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                    </a>
                                    <a class="align-middle mt-3"><small><b class="text-danger">*</b> Wajib Disi</small></a>
                                    <a class="btn btn-primary btn-tampil3 text-white">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1" href="javascript:void(0);">Selanjutnya</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- STEP 3 -->
                        <div class="content" id="tampil3">
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
                                <div class="col-sm-12" style="margin-top: -5px" id="formSurveilans">
                                    <div id="surveilans1" hidden>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Pemasangan <a class="text-danger">*</a></label>
                                                    <select class="inp selectpicker w-100" data-style="btn-default" name="jns_pemasangan_ph" required>
                                                        <option value="" hidden selected>Pilih</option>
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
                                                        <select class="inp select2 form-select" name="tujuan_pemasangan_ph[]" data-allow-clear="true" data-bs-auto-close="outside" required multiple>
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
                                                    <select class="inp selectpicker w-100" data-style="btn-default" name="lokasi_ph" required>
                                                        <option value="" hidden selected>Pilih</option>
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
                                                    <input type="text" class="inp form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_pemasangan_ph" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Infeksi <a class="text-danger">*</a></label>
                                                    <input type="text" class="inp form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_infeksi_ph" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tanda-tanda Infeksi</label>
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="tanda_infeksi_ph[]" data-allow-clear="true" data-bs-auto-close="outside" required multiple>
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
                                                <small>Pilih opsi yang tersedia, dapat memilih opsi lebih dari satu. Memilih berarti menjawab Ya [<strong>√</strong>].</small>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="bundles_ph[]" data-allow-clear="true" data-bs-auto-close="outside" multiple required>
                                                            <option value="1">Kebersihan tangan sebelum dan sesudah pemasangan</option>
                                                            <option value="2">Evaluasi IV kateter masih diperlukan atau tidak</option>
                                                            <option value="3">Melepas IV kateter bila ada keluhan/peradangan</option>
                                                            <option value="4">Pengecekan balutan pemasangan/dressing</option>
                                                            <option value="5">Pengecekan tempat pemasangan</option>
                                                            <option value="6">Penggantian IV kateter bila lebih dari 72 jam</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="surveilans2" hidden>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Pemasangan <a class="text-danger">*</a></label>
                                                    <select class="inp selectpicker w-100" data-style="btn-default" name="jns_pemasangan_cauti" required>
                                                        <option value="" hidden selected>Pilih</option>
                                                        <option value="1">SPP</option>
                                                        <option value="2">Dauer</option>
                                                        <option value="3">Intermitten</option>
                                                        <option value="4">Kondom</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Pemasangan <a class="text-danger">*</a></label>
                                                    <input type="text" class="inp form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_pemasangan_cauti" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Infeksi <a class="text-danger">*</a></label>
                                                    <input type="text" class="inp form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_infeksi_cauti" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanda-tanda Infeksi</label>
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="tanda_infeksi_cauti[]" data-allow-clear="true" data-bs-auto-close="outside" multiple>
                                                            <option value="1">Demam (>38⁰C)</option>
                                                            <option value="2">Urgensi</option>
                                                            <option value="3">Frekuensi</option>
                                                            <option value="4">Disuria</option>
                                                            <option value="5">Nyeri Supra Publik</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="content-header" style="margin-top: -2px">
                                                <h6 class="mb-1">Bundles CAUTI <a class="text-danger">*</a></h6>
                                                <small>Pilih opsi yang tersedia, dapat memilih opsi lebih dari satu. Memilih berarti menjawab Ya [<strong>√</strong>].</small>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="bundles_cauti[]" data-allow-clear="true" data-bs-auto-close="outside" multiple required>
                                                            <option value="1">Kaji kebutuhan/ alasan pemasangan kateter</option>
                                                            <option value="2">Kebersihan tangan sebelum dan sesudah pemasangan</option>
                                                            <option value="3">Memasang dengan metode aspetic</option>
                                                            <option value="4">Pemeliharaan kateter</option>
                                                            <option value="5">Perawatan kateter</option>
                                                            <option value="6">Melepas kateter bila tidak ada indikasi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="surveilans3" hidden>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nomor Ventilator <a class="text-danger">*</a></label>
                                                    <input type="text" name="no_ventilator_vap" class="inp form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Pemasangan <a class="text-danger">*</a></label>
                                                    <input type="text" class="inp form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_pemasangan_vap" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Infeksi <a class="text-danger">*</a></label>
                                                    <input type="text" class="inp form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_infeksi_vap" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanda-tanda Infeksi</label>
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="tanda_infeksi_vap[]" data-allow-clear="true" data-bs-auto-close="outside" multiple>
                                                            <option value="1">Demam (Lebih dari 38⁰C)</option>
                                                            <option value="2">Tanpa ditemui penyebab lainnya</option>
                                                            <option value="3">Leukopenia (Kurang dari 4000 WBC/mm3) atau Leukositosis (Lebih dari 12000 SDP/mm3)</option>
                                                            <option value="4">Timbulnya onset baru sputum purulen atau perubahan sifat sputum</option>
                                                            <option value="5">Peningkatan Fraksi inspirasi Oksigen > 0,2 dari FiO2 sebelumnya</option>
                                                            <option value="5">Peningkatan PEEP setiap hari sebesar > 3cmH2O dari PEEP sebelumnya selama 2 hari bertutur-turut</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="content-header" style="margin-top: -2px">
                                                <h6 class="mb-1">Bundles VAP <a class="text-danger">*</a></h6>
                                                <small>Pilih opsi yang tersedia, dapat memilih opsi lebih dari satu. Memilih berarti menjawab Ya [<strong>√</strong>].</small>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="bundles_vap[]" data-allow-clear="true" data-bs-auto-close="outside" multiple required>
                                                            <option value="1">Kebersihan tangan sebelum dan sesudah kontak pasien</option>
                                                            <option value="2">Posisikan 30-45⁰ (kecuali kontra indikasi)</option>
                                                            <option value="3">Lakukan kebersihan mulut setiap 4 jam</option>
                                                            <option value="4">Manajemen sekresi oropharyngeal dan tracheal</option>
                                                            <option value="5">Peptic ulcer disease (PUD) prophylaxis</option>
                                                            <option value="6">Kaji "sedasi dan ekstubasi" setiap hari</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="surveilans4" hidden>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Tindakan Operasi <a class="text-danger">*</a></label>
                                                    <textarea name="tindakan_operasi_ido" class="inp form-control" placeholder="e.g. Hernia, Open Reduction Internal/External Fixation (ORIF/OREF), Sectio Caesarea (SC), Apendiktomi, etc" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Dokter Operator <a class="text-danger">*</a></label>
                                                    <select class="inp form-control select2" name="dr_operator_ido" style="width: 100%" required>
                                                        <option value="">Pilih</option>
                                                        @if ($list['dokter'] != null)
                                                            @foreach($list['dokter'] as $key => $item)
                                                                <option value="{{ $item->id }}"><label><b>{{ $item->jabatan }}</b></label> - {{ $item->nama }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis Operasi <a class="text-danger">*</a></label>
                                                    <select class="inp selectpicker w-100" data-style="btn-default" name="jns_operasi_ido" required>
                                                        <option value="" hidden selected>Pilih</option>
                                                        <option value="1">Bersih</option>
                                                        <option value="2">Bersih Tercemar</option>
                                                        <option value="3">Tercemar</option>
                                                        <option value="4">Kotor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Infeksi <a class="text-danger">*</a></label>
                                                    <input type="text" class="inp form-control flatpickr" placeholder="YYYY-MM-DD" name="tgl_infeksi_ido" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tanda-tanda Infeksi</label>
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="tanda_infeksi_ido[]" data-allow-clear="true" data-bs-auto-close="outside" multiple>
                                                            <option value="1">Nyeri</option>
                                                            <option value="2">Bengkak</option>
                                                            <option value="3">Kemerahan atau Panas</option>
                                                            <option value="4">Adanya Cairan Purulent</option>
                                                            <option value="5">Ditemukan Abses</option>
                                                            <option value="6">Adanya Peningkatan Suhu Tubuh > 38⁰C</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="content-header" style="margin-top: -2px">
                                                <h6 class="mb-1">Bundles IDO <a class="text-danger">*</a></h6>
                                                <small>Pilih opsi yang tersedia, dapat memilih opsi lebih dari satu. Memilih berarti menjawab Ya [<strong>√</strong>].</small>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="select2-dark">
                                                        <select class="inp select2 form-select" name="bundles_ido[]" data-allow-clear="true" data-bs-auto-close="outside" multiple required>
                                                            <option value="1">Pencukuran Daerah Operasi</option>
                                                            <option value="2">Personal Hygiene Pasien</option>
                                                            <option value="3">Pemberian Antibiotic</option>
                                                            <option value="4">Kebersihan Tangan Bedah Sebelum Tindakan</option>
                                                            <option value="5">Preparasi Kulit Pasien</option>
                                                            <option value="6">Pasien Normothermia, Saturasi > 95%, GDS < 180mg</option>
                                                            <option value="7">Tambah Antibiotic Profilaksis Sesuai Indikasi</option>
                                                            <option value="8">Luka Operasi Dibalut Sebelum Mengangkat Drape</option>
                                                            <option value="9">Petugas Yang Sakit Tidak Masuk Kamar Operasi</option>
                                                            <option value="10">Petugas Tidak Memakai Perhiasan Tangan, Kuku Panjang, Dan Berkutek</option>
                                                            <option value="11">Petugas Bekerja Dengan Teknik Aseptic</option>
                                                            <option value="12">Gunakan Sandal/Sepatu Khusus Kamar Bedah</option>
                                                            <option value="13">Gunakan APD Sebelum Masuk Kamar Bedah</option>
                                                            <option value="14">Perawatan Luka Setelah 48 Jam</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a class="btn btn-primary btn-tampil2 text-white" href="javascript:void(0);">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Sebelumnya</span>
                                    </a>
                                    <a class="align-middle mt-3"><small><b class="text-danger">*</b> Wajib Disi</small></a>
                                    <button class="btn btn-outline-info btn-submit" type="submit" id="btn-simpan" onclick="saveData()"><i class="fa fa-save"></i>
                                        <span class="align-middle d-sm-inline-block d-none">&nbsp;&nbsp;Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // SELECT2 & SELECTPICKER
            const e = $(".select2")
            , t = $(".selectpicker");
            t.length && t.selectpicker(),
            e.length && e.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>'),
                e.select2({
                    placeholder: "Pilih",
                    dropdownParent: e.parent()
                })
            })

            // DISABLE ENTER IN INPUT RM
            // var el = document.getElementById("#rm");
            // el.addEventListener("keypress", function(event) {
            //     if (event.key === "Enter") {
            //         alert(event.key  + " " + event.which);
            //         event.preventDefault();
            //     }
            // });

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
                    // defaultDate: now,
                    time_24hr: true,
                })
            // SELECT VALUE JENIS SURVEILANS
            $('#jns_surveilans').on('change', function() {
                if (this.value == '1') {
                    document.getElementById("surveilans1").hidden = false;
                } else {
                    document.getElementById("surveilans1").hidden = true;
                    $('.inp').val("").trigger('change');
                    $('.inp').prop('checked',false);
                    $(".opd").prop('disabled', true);
                }
                if (this.value == '2') {
                    document.getElementById("surveilans2").hidden = false;
                } else {
                    document.getElementById("surveilans2").hidden = true;
                    $('.inp').val("").trigger('change');
                    $('.inp').prop('checked',false);
                    $(".opd").prop('disabled', true);
                }
                if (this.value == '3') {
                    document.getElementById("surveilans3").hidden = false;
                } else {
                    document.getElementById("surveilans3").hidden = true;
                    $('.inp').val("").trigger('change');
                    $('.inp').prop('checked',false);
                    $(".opd").prop('disabled', true);
                }
                if (this.value == '4') {
                    document.getElementById("surveilans4").hidden = false;
                } else {
                    document.getElementById("surveilans4").hidden = true;
                    $('.inp').val("").trigger('change');
                    $('.inp').prop('checked',false);
                    $(".opd").prop('disabled', true);
                }
            });
            // SELECT VALUE OF BUNDLES EXCEPT IDO
            $('.opsi').on('change', function() {
                $(".opd").prop('disabled', false);
            })
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

        // function clearValue() {
        //     $('.inp').val("").trigger('change');
        //     $('.inp').prop('checked',false);
        //     $(".opd").prop('disabled', true);
        // }

        function ubahrm() {
            $('#rm').val('');
            $('#jns_kelamin').val('');
            $('#jns_kelamin_show').val('');
            $('#umur').val('');
            $('#umur_show').val('');
            $('#nama').val('');
            $('#nama_show').val('');
        }

        function saveData() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled','disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-spinner fa-spin");
                return true;
            });
        }

    </script>
@endsection
