<?php
Route::resource('/', 'WelcomeController');
// Route::get('/', 'maintenance\maintenanceController@index')->name('maintenance');

Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');
// Route::resource('/antrian', 'queuePoliController');
// Route::get('/demos', function () {
//     return view('index');
// });
Route::get('/vaksin', function () {
    return view('pages.vaksin.index');
});
Route::get('/vaksin2', function () {
    return view('pages.butterfly.inner-page');
});
// Route::resource('/lokasi', 'other\lokasiController');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
Route::post('edit_akun/{id}', 'Admin\UsersController@ubahData')->name('ubah.akun');
// Route::get('/forgot_password', function () {
//     return view('auth.passwords.reset');
// })->middleware('guest')->name('password.request');

// Other
Route::get('/home', 'HomeController@index')->name('home');

// MANAGER FILE
Route::get('/home/file-manager', 'HomeController@fileManager')->name('managerfile');

// PROFIL KARYAWAN
Route::resource('user', 'Admin\profilController');
Route::post('/user/foto', 'Admin\profilController@storeImg');

// Route::post('/antrian/poli/antrian', 'queueController@tambahAntrianSaatIni')->name('antriansaatini');
// Route::get('/', 'HomeController@index'); //file manager

// NEW SIMRSMU.COM
Route::get('/welcome', 'HomeController@newIndex')->name('welcome');
Route::get('/kunjungan', 'kunjunganController@kunjungan')->name('kunjungan');
    
    //Profil
    Route::resource('profil', 'Admin\profilController');
    Route::post('/profil/foto', 'Admin\profilController@storeImg');



// Admin
Route::get('api/notif', 'notifController@apiNotif')->name('api.notif');
Route::resource('notif', 'notifController');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    Route::resource('unit', 'Admin\UnitController');
    Route::resource('karyawan', 'Admin\karyawanController');
});

// Other
Route::get('/sisrute/diagnosis', function () {
    return view('pages.sisrute.diagnosis');
})->name('sisrute.diagnosis');

// IT
Route::group(['middleware' => ['auth'], 'prefix' => 'it', 'as' => 'it.'], function () {
    // Route::get('home', 'it\itController@index')->name('it.home');
    // Route::get('user-activity', 'it\itController@getActivity')->name('user_activity');
    Route::get('supervisi/all','it\log\logController@showAll')->name('logit.all');  
    // Route::get('supervisi/lampiran/{id}', 'it\log\logController@getLampiran');
    // Route::get('supervisi/lampiran/{id}/download', 'it\log\logController@unduhLampiran');
    Route::resource('supervisi', 'it\log\logController');
    Route::get('/user-activity', function () {
        return view('pages.it.user-activity');
    })->name('user.activity');

    Route::resource('roleuser', 'it\setUserRoleController');
    
    // Antrian Poli
    Route::resource('/antrian/poli', 'queue\admin\setQueuePoliController');

    // Dokter
    Route::resource('/dokter', 'Admin\dokterController');

    // Imut
        // Pilar
        Route::post('/imut/pilar/{id}', 'it\imut\pilarController@pilarClear')->name('pilar.selesai');
        Route::get('/imut/pilar/all','it\imut\pilarController@showAll')->name('pilar.all');  
        Route::resource('/imut/pilar', 'it\imut\pilarController');
        // CPU
        Route::post('/imut/cpu/{id}', 'it\imut\cpuController@cpuClear')->name('cpu.selesai');
        Route::resource('/imut/cpu', 'it\imut\cpuController');
        // Jaringan
        Route::post('/imut/jaringan/{id}', 'it\imut\jaringanController@jaringanClear')->name('jaringan.selesai');
        Route::resource('/imut/jaringan', 'it\imut\jaringanController');
        // Printer
        Route::post('/imut/printer/{id}', 'it\imut\printerController@printerClear')->name('printer.selesai');
        Route::resource('/imut/printer', 'it\imut\printerController');
    
    // Pilar
        // Revisi
        Route::resource('/pilar/rev', 'it\pilar\revisiPilarController');

});

// IBS
Route::group(['middleware' => ['auth'], 'prefix' => 'ibs', 'as' => 'ibs.'], function () {
    Route::get('supervisi/cari', 'ibs\supervisi\ceklistAlatBHPController@cari')->name('supervisi.cari');
    Route::get('supervisi/cek', 'ibs\supervisi\ceklistAlatBHPController@pushTim')->name('supervisi.pushtim');
    Route::get('supervisi/api/{tim}', 'ibs\supervisi\ceklistAlatBHPController@kondisiAlat')->name('supervisi.kondisiAlat');
    Route::get('supervisi/api/{tim}/batal', 'ibs\supervisi\ceklistAlatBHPController@batalCek');
    Route::get('supervisi/api/{tim}/selesai', 'ibs\supervisi\ceklistAlatBHPController@selesaiCek');
    Route::post('supervisi/api/lampiran','ibs\supervisi\ceklistAlatBHPController@lampiran');
    Route::post('supervisi/api/kondisi','ibs\supervisi\ceklistAlatBHPController@kondisi');
    Route::post('supervisi/api/kondisi/ket','ibs\supervisi\ceklistAlatBHPController@ket');
    Route::resource('supervisi', 'ibs\supervisi\ceklistAlatBHPController');
    Route::resource('refsupervisi', 'ibs\supervisi\refAlatBHPController');
});

// PERENCANAAN
Route::get('perencanaan/table', 'perencanaan\rkaController@table')->name('api.perencanaan.table');
Route::post('perencanaan/upload','perencanaan\rkaController@upload')->name('api.perencanaan.upload');
Route::get('perencanaan/hapus/{id}', 'perencanaan\rkaController@hapus')->name('api.perencanaan.hapus');
Route::resource('perencanaan', 'perencanaan\rkaController');

// Finger
Route::get('insentif/finger/{id}/null','excell\fingerController@nullID')->name('setNull.finger');  
Route::resource('insentif/finger', 'excell\fingerController');
Route::get('insentif/kehadiran/export', 'excell\insentifController@export')->name('export.insentif');
Route::get('insentif/kehadiran', 'excell\insentifController@index')->name('insentif.kehadiran');
Route::post('insentif/kehadiran/import', 'excell\insentifController@import')->name('import.insentif');

// Keuangan
Route::resource('pendapatan', 'keuangan\pengajuan_pengeluaran\pendapatanKasirController');
Route::get('pengajuan/verifikasi', 'keuangan\pengajuan_pengeluaran\pengajuanPembayaranController@showVerif')->name('pengajuan.showverif');
Route::put('pengajuan/verifikasi/kabag/{post}','keuangan\pengajuan_pengeluaran\pengajuanPembayaranController@verifikasikabag')->name('pengajuan.verifikasikabag');
Route::delete('pengajuan/verifikasi/kabag/hapus/{post}','keuangan\pengajuan_pengeluaran\pengajuanPembayaranController@destroyVerifKabag')->name('pengajuan.destroyverifkabag');
Route::put('pengajuan/verifikasi/kasubag/{post}','keuangan\pengajuan_pengeluaran\pengajuanPembayaranController@verifikasikasubag')->name('pengajuan.verifikasikasubag');
Route::delete('pengajuan/verifikasi/kasubag/hapus/{post}','keuangan\pengajuan_pengeluaran\pengajuanPembayaranController@destroyVerifKasubag')->name('pengajuan.destroyverifkasubag');
Route::resource('pengajuan', 'keuangan\pengajuan_pengeluaran\pengajuanPembayaranController');
Route::get('pbf/api/{jenis}', 'keuangan\pengajuan_pengeluaran\pbfController@apiPbf')->name('api.pbf');
Route::resource('pbf', 'keuangan\pengajuan_pengeluaran\pbfController');

// Lab
Route::group(['middleware' => ['auth'], 'prefix' => 'lab', 'as' => 'lab.'], function () {
    // Route::get('/karyawan/cetak/{id}', 'kantor\kepegawaianController@generatePDF')->name('karyawan.cetak');
    Route::get('antigen/all/api','lab\antigenController@apiShowAll')->name('antigen.apiall');  
    Route::get('antigen/all','lab\antigenController@showAll')->name('antigen.all');  
    Route::get('antigen/api/get','lab\antigenController@apiGet')->name('antigen.apiget');  
    Route::post('antigen/api/ubah/{id}', 'lab\antigenController@ubah')->name('antigen.ubah');
    Route::get('antigen/api/getubah/{id}', 'lab\antigenController@getubah')->name('antigen.getubah');
    Route::get('antigen/api/hapus/{id}', 'lab\antigenController@hapus')->name('antigen.hapus');
    Route::resource('/antigen', 'lab\antigenController');
    Route::get('antigen/{id}/cetak','lab\antigenController@cetak')->name('antigen.cetak');  
    Route::get('antigen/{id}/print','lab\antigenController@print')->name('antigen.print');  
});

// Kepegawaian
Route::group(['middleware' => ['auth'], 'prefix' => 'kepegawaian', 'as' => 'kepegawaian.'], function () {
    Route::get('/karyawan/cetak/{id}', 'kantor\kepegawaianController@generatePDF')->name('karyawan.cetak');
    Route::get('/karyawan/nonaktif/{id}', 'kantor\kepegawaianController@nonaktif')->name('karyawan.nonaktif');
    Route::resource('/karyawan', 'kantor\kepegawaianController');

    // Penggajian Karyawan
    Route::resource('gaji/struktural', 'kantor\gaji\strukturalController');
    Route::resource('gaji/fungsional', 'kantor\gaji\fungsionalController');
    // Route::resource('gaji/set', 'kantor\gaji\setGajiController');
    Route::get('gaji/terima/{id}/detail', 'kantor\gaji\terimaController@detail')->name('detail.terima');
    Route::resource('gaji/terima', 'kantor\gaji\terimaController');
    Route::resource('gaji/potong', 'kantor\gaji\potongController');
    Route::resource('gaji/golongan', 'kantor\gaji\golonganController');
    Route::get('gaji/final/validasi', 'kantor\gaji\gajiController@validasi')->name('final.validasi');
    Route::get('gaji/final/hapus', 'kantor\gaji\gajiController@hapus')->name('final.hapus');
    Route::get('gaji/final/print', 'kantor\gaji\gajiController@printAll')->name('final.cetakAll');
    Route::get('gaji/final/{id}/detail', 'kantor\gaji\gajiController@detail')->name('detail.gaji');
    Route::get('gaji/final/{id}/print', 'kantor\gaji\gajiController@print')->name('final.cetak');
    Route::resource('gaji/final', 'kantor\gaji\gajiController');
});

    // Pengadaan
        // Route::get('/pengadaan/log/', 'perawat\tdkPerawatController@cariLog')->name('tdkperawat.cari');
        Route::get('/pengadaan/log/cari', 'it\pengadaan\logPengadaanController@showLog')->name('cari.log');
        Route::resource('/pengadaan/log', 'it\pengadaan\logPengadaanController');
        Route::resource('/pengadaan/all', 'it\pengadaan\pengadaanAllController');
        Route::resource('pengadaan/rutin', 'it\pengadaan\pengadaanController');
        Route::resource('pengadaan/nonrutin', 'it\pengadaan\pengadaanNonRutinController');
        // Route::get('/pengadaan/jenis-pengadaan', 'it\pengadaan\pengadaanController@linkToPengadaan')->name('pengadaan.pilih');
        Route::resource('barang', 'it\pengadaan\barangPengadaanController');
        // Route::resource('pengadaan/rutin', 'it\pengadaan\rutinController');
        // Route::get('pengadaan/nonrutin/token/{token}','it\pengadaan\nonrutinController@getbyapi')->name('api.nonrutin');
        // Route::get('pengadaan/rutin/cetak/{token}','it\pengadaan\rutinController@generatePDF')->name('rutin.cetak');
        // Route::get('pengadaan/nonrutin/cetak/{token}','it\pengadaan\nonrutinController@generatePDF')->name('nonrutin.cetak');
        Route::get('/pengadaan/api/barang/{id}', 'it\pengadaan\barangPengadaanController@apifile')->name('barang.api');
        Route::get('pengadaan/all/{id}/cetak','it\pengadaan\pengadaanAllController@generatePDF')->name('pengadaan.cetak');

    // Kantor Route
        Route::post('absensi/{id}/tambah', 'kantor\absensiController@tambahKehadiran')->name('absensi.hadir');
        Route::post('absensi/{id}/edit', 'kantor\absensiController@ubahKehadiran')->name('absensi.edit');
        Route::post('absensi/{id}/hapus', 'kantor\absensiController@hapusKehadiran')->name('absensi.hapus');
        Route::resource('absensi', 'kantor\absensiController');
        Route::resource('rapat', 'kantor\rapatController');
        Route::get('/rapat/zip/{id}', 'kantor\rapatController@showAll');
        Route::get('/rapat/show/{id}', 'kantor\rapatController@show');
        Route::get('/rapat/show2/{id}', 'kantor\rapatController@show2');
        Route::get('/rapat/show2all/{id}', 'kantor\rapatController@show2all');
        Route::get('/rapat/show3/{id}', 'kantor\rapatController@show3');
        Route::get('/rapat/show4/{id}', 'kantor\rapatController@show4');
        Route::get('/rapat/show5/{id}', 'kantor\rapatController@show5');
        Route::put('regulasi/note/{post}','kantor\regulasiController@addNote')->name('regulasi.note');
        Route::resource('regulasi', 'kantor\regulasiController');

        // Laporan Bulanan OLD
        Route::get('/laporan/bulanan/filter', 'kantor\laporanBulananController@filter')->name('bulanan.filter');
        Route::post('laporan/bulanan/api/','kantor\laporanBulananController@verifikasi'); // API
        Route::post('laporan/bulanan/api/ket/','kantor\laporanBulananController@ket'); // API
        Route::get('laporan/bulanan/api/{id}/verified', 'kantor\laporanBulananController@verified'); // API
        Route::get('laporan/bulanan/old', 'kantor\laporanBulananController@old')->name('bulanan.old');
        Route::resource('laporan/bulanan', 'kantor\laporanBulananController');
        
        // Laporan Bulanan NEW
        Route::post('laporan/bulan/api','kantor\laporanBulananNewController@verifikasi'); // API
        Route::get('laporan/bulan/api/ket/{id}/hapus','kantor\laporanBulananNewController@ketHapus'); // API
        Route::get('laporan/bulan/api/ket/{id}','kantor\laporanBulananNewController@ketGet'); // API
        Route::post('laporan/bulan/api/ket','kantor\laporanBulananNewController@ket'); // API
        Route::get('laporan/bulan/api/{id}/verified', 'kantor\laporanBulananNewController@verified'); // API
        Route::get('laporan/bulan/tableverif', 'kantor\laporanBulananNewController@tableVerifikasi');
        Route::get('laporan/bulan/table', 'kantor\laporanBulananNewController@table')->name('api.laporan.bulan');
        Route::get('laporan/bulan/tableadmin', 'kantor\laporanBulananNewController@tableadmin');
        Route::get('laporan/bulan/verif/{id}/hapus', 'kantor\laporanBulananNewController@hapusVerif');
        Route::get('laporan/bulan/restore/table/hapus/{id}/batal', 'kantor\laporanBulananNewController@batalHapus');
        Route::get('laporan/bulan/restore/table/hapus', 'kantor\laporanBulananNewController@tableRiwayatTerhapus');
        Route::get('laporan/bulan/restore', 'kantor\laporanBulananNewController@tampilRiwayatTerhapus')->name('restore.laporan.bulanan');
        Route::get('laporan/bulan/riwayat/table', 'kantor\laporanBulananNewController@tableRiwayatVerifikasi');
        Route::get('laporan/bulan/riwayat', 'kantor\laporanBulananNewController@riwayatVerifikasi')->name('riwayat.laporan.bulanan');
        Route::resource('laporan/bulan', 'kantor\laporanBulananNewController');

    // Log Perawat
        // Pernyataan Log
            Route::resource('logperawat', 'perawat\logPerawatController');
            Route::resource('logtgsperawat', 'perawat\logTgsPerawatController');
            Route::resource('logprofkpr', 'perawat\logProfKprController');

        // Tindakan Harian
            // API
                // Route::get('/tindakan-harian/hapus/{id}', 'perawat\tindakan_harian\tindakanHarianController@hapus')->name('pu.hapus');
                // Route::post('/tindakan-harian/ubah/{id}', 'perawat\tindakan_harian\tindakanHarianController@ubah')->name('pu.ubah');
                // Route::get('/tindakan-harian/getubah/{id}', 'perawat\tindakan_harian\tindakanHarianController@getubah')->name('pu.getubah');
                // Route::post('/tindakan-harian/tambah', 'perawat\tindakan_harian\tindakanHarianController@tambah')->name('pu.tambah');
                Route::get('tindakan-harian/table', 'perawat\tindakan_harian\tindakanHarianController@table')->name('th.table');
            Route::get('tindakan-harian/cari', 'perawat\tindakan_harian\tindakanHarianController@cari')->name('tindakan-harian.cari');
            Route::get('tindakan-harian/api/{id}/edit', 'perawat\tindakan_harian\tindakanHarianController@getDataEdit')->name('tindakan-harian.api.edit'); 
            Route::resource('tindakan-harian', 'perawat\tindakan_harian\tindakanHarianController');
            Route::get('/tdkperawat/cari', 'perawat\tdkPerawatController@cariLog')->name('tdkperawat.cari');
            Route::resource('tdkperawat', 'perawat\tdkPerawatController');
            Route::get('tdkperawat/{id}/cetak','perawat\tdkPerawatController@generatePDF')->name('tdkperawat.cetak');

        // Log Profesi Keperawatan
            Route::resource('profkpr', 'perawat\profKprController');
            Route::get('profkpr/{id}/show', 'perawat\profKprController@download')->name('profkpr.download'); 

        // Log Penunjang Tugas Perawat
            Route::resource('tgsperawat', 'perawat\tgsPerawatController');

    // Kebidanan
        Route::resource('kebidanan/skl', 'kebidanan\sklController');
        Route::get('kebidanan/skl/{id}/cetak','kebidanan\sklController@cetak')->name('skl.cetak');  
        Route::get('kebidanan/skl/{id}/print','kebidanan\sklController@print')->name('skl.print');  
        // Route::get('cetak/word', 'kebidanan\sklController@word');

    // K3
    Route::resource('k3/accidentreport', 'k3\accidentReportController');
    Route::post('/k3/accidentreport/{id}/check', 'k3\accidentReportController@verifikasi')->name('accidentreport.check');
    Route::get('k3/accidentreport/{id}/show', 'k3\accidentReportController@show')->name('accidentreport.show'); 
    Route::get('k3/accidentreport/{id}/cetak','k3\accidentReportController@cetak')->name('accidentreport.cetak');  
    
    Route::group(['prefix' => 'token/jasnidh2qu8hnf3298r0fewniongisdng0f32hr0fiwdondnsajdn1283hr420hrwnoi', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

// Antrian Poli
Route::get('/history/poli', 'queue\admin\setQueuePoliController@tampilHistory')->name('show.history');
Route::group(['middleware' => ['auth'], 'prefix' => 'queue', 'as' => 'queue.'], function () {   
        
    // INFORMASI
        Route::resource('/informasi', 'queue\informasi\queuePoliController');
        
    // RM
        Route::resource('/rm', 'queue\rm\queuePoliController');

    // POLI
        Route::resource('/poli', 'queue\poli\queuePoliController');
        // Route::post('/poli/{id}', 'queue\poli\queuePoliController@show')->name('detail.antrian'); 

    // PASIEN
}); 

// API Antrian Poli
    // Route::get('api/queue/poli/pasien/{id}', 'queue\pasien\queuePoliController@apiFindQueue')->name('cari.antrian');
    Route::get('api/queue/poli/status/', 'queue\informasi\queuePoliController@apiStatusAntrian')->name('status.antrian');
    Route::get('api/queue/poli/{id}', 'queue\poli\queuePoliController@apiQueue')->name('api.antrian');
    Route::get('api/queue/poli/{id}/hapus', 'queue\poli\queuePoliController@hapusQueue')->name('hapus.antrian');
    
// API Profil Simrsku
    Route::get('api/provinsi/{id}', 'Admin\profilController@apiProvinsi')->name('api.provinsi');
    Route::get('api/kota/{id}', 'Admin\profilController@apiKota')->name('api.kota');
    Route::get('api/kecamatan/{id}', 'Admin\profilController@apiKecamatan')->name('api.kecamatan');

// IPSRS
    Route::post('pengaduan/ipsrs/selesai', 'ipsrs\pengaduan\pengaduanController@selesai')->name('pengaduan.ipsrs.selesai');
    Route::post('pengaduan/ipsrs/tambahketerangan', 'ipsrs\pengaduan\pengaduanController@tambahketerangan')->name('pengaduan.ipsrs.tambahketerangan');
    Route::post('pengaduan/ipsrs/ubahketerangan', 'ipsrs\pengaduan\pengaduanController@ubahketerangan')->name('pengaduan.ipsrs.ubahketerangan');
    Route::post('pengaduan/ipsrs/kerjakan', 'ipsrs\pengaduan\pengaduanController@kerjakan')->name('pengaduan.ipsrs.kerjakan');
    Route::post('pengaduan/ipsrs/kerjakan/ubah', 'ipsrs\pengaduan\pengaduanController@ubahKerjakan')->name('pengaduan.ipsrs.ubah.kerjakan');
    Route::post('pengaduan/ipsrs/terima', 'ipsrs\pengaduan\pengaduanController@terima')->name('pengaduan.ipsrs.terima');
    Route::post('pengaduan/ipsrs/terima/ubah', 'ipsrs\pengaduan\pengaduanController@ubahTerima')->name('pengaduan.ipsrs.ubah.terima');
    Route::post('pengaduan/ipsrs/tolak', 'ipsrs\pengaduan\pengaduanController@tolak')->name('pengaduan.ipsrs.tolak');
    Route::get('pengaduan/ipsrs/detail/{id}', 'ipsrs\pengaduan\pengaduanController@detail')->name('pengaduan.ipsrs.detail');
    Route::get('pengaduan/ipsrs/lampiran/catatan/{id}', 'ipsrs\pengaduan\pengaduanController@showCatatan')->name('pengaduan.ipsrs.lampiran.catatan');
    Route::get('pengaduan/ipsrs/history', 'ipsrs\pengaduan\pengaduanController@history')->name('pengaduan.ipsrs.history');
    // START API
        // Route::get('pengaduan/ipsrs/lampiran/{id}', 'ipsrs\pengaduan\pengaduanController@getLampiran')->name('pengaduan.ipsrs.lampiran');
    // END API
    Route::resource('pengaduan/ipsrs', 'ipsrs\pengaduan\pengaduanController');

// MAIL
    Route::get('/kirimemail','Mail\InsentifDokterController@index');

// QR CODE
    Route::get('scanner/api/absensi', 'qrcode\ScannerController@apiAbsensi')->name('api.absensi');
    Route::post('scanner/post','qrcode\ScannerController@simpan');
    Route::resource('scanner', 'qrcode\ScannerController');

// LiveMessageApp
Addchat::routes();

//loginAndroid
// Route::post('/loginandroid', 'android\APIcontroller@loginAndroid');

// PPI
    Route::post('surveilans/ppi/plebitis/formula','ppi\PlebitisController@formula')->name('plebitis.formula');
    Route::resource('surveilans/ppi/plebitis', 'ppi\PlebitisController');
    Route::post('surveilans/ppi/ido/formula','ppi\IdoController@formula')->name('ido.formula');
    Route::resource('surveilans/ppi/ido', 'ppi\IdoController');
    Route::post('surveilans/ppi/isk/formula','ppi\IskController@formula')->name('isk.formula');
    Route::resource('surveilans/ppi/isk', 'ppi\IskController');
    Route::post('surveilans/ppi/decubitus/formula','ppi\DecubitusController@formula')->name('decubitus.formula');
    Route::resource('surveilans/ppi/decubitus', 'ppi\DecubitusController');
    Route::post('surveilans/ppi/vap/formula','ppi\VapController@formula')->name('vap.formula');
    Route::resource('surveilans/ppi/vap', 'ppi\VapController');

// ABSEN
Route::resource('absen', 'absen\cameraController');

