<?php
Route::resource('/', 'WelcomeController'); //->middleware("throttle:1,1")
// Route::get('/', 'maintenance\maintenanceController@index')->name('maintenance');

Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');

// LAKON WEB
Route::get('/lakonweb', 'lakonwebController@index')->name('lakonweb.index');

// Route::resource('/antrian', 'queuePoliController');
// Route::get('/reservasi', function () {
//     return view('pages.reservasi');
// });
// Route::get('/vaksin', function () {
//     return view('pages.vaksin.index');
// });
// Route::get('/vaksin2', function () {
//     return view('pages.butterfly.inner-page');
// });
// Route::resource('/lokasi', 'other\lokasiController');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
// Route::post('edit_akun/{id}', 'Admin\UsersController@ubahData')->name('ubah.akun');
// Route::get('/forgot_password', function () {
//     return view('auth.passwords.reset');
// })->middleware('guest')->name('password.request');

// Other
Route::get('/home', 'HomeController@index')->name('home');

// ADMINISTRASI
    // LAPORAN BULANAN
    Route::post('laporan/bulan/api','kantor\laporanBulananNewController@verifikasi'); // API
    Route::get('laporan/bulan/api/getubah/{id}','kantor\laporanBulananNewController@getUbah'); // API
    Route::post('laporan/bulan/api/ubah/{id}','kantor\laporanBulananNewController@ubah'); // API
    Route::post('laporan/bulan/api','kantor\laporanBulananNewController@verifikasi'); // API
    Route::get('laporan/bulan/api/hapus/{id}','kantor\laporanBulananNewController@hapusLaporan'); // API
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

// MANAGER FILE
Route::get('/home/file-manager', 'HomeController@fileManager')->name('managerfile');

// Route::post('/antrian/poli/antrian', 'queueController@tambahAntrianSaatIni')->name('antriansaatini');
// Route::get('/', 'HomeController@index'); //file manager

// NEW SIMRSMU.COM
Route::get('/welcome', 'HomeController@newIndex')->name('welcome');
Route::get('/kunjungan', 'kunjunganController@kunjungan')->name('kunjungan');
Route::get('/kalender', 'calendarController@index')->name('kalender');
    

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

// IT
Route::group(['middleware' => ['auth'], 'prefix' => 'it', 'as' => 'it.'], function () {
    // Route::get('home', 'it\itController@index')->name('it.home');
    // Route::get('user-activity', 'it\itController@getActivity')->name('user_activity');
    Route::get('supervisi/old','it\log\logController@showOld')->name('logit.old');  
    Route::get('supervisi/all','it\log\logController@showAll')->name('logit.all');  
    // Route::get('supervisi/lampiran/{id}', 'it\log\logController@getLampiran');
    // Route::get('supervisi/lampiran/{id}/download', 'it\log\logController@unduhLampiran');
    Route::get('supervisi/api/ref/kategori/{id}', 'it\log\refLogController@getKegiatan');
    Route::resource('refsupervisi', 'it\log\refLogController');
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
// Route::group(['middleware' => ['auth'], 'prefix' => 'lab', 'as' => 'lab.'], function () {
//     // Route::get('/karyawan/cetak/{id}', 'kantor\kepegawaianController@generatePDF')->name('karyawan.cetak');
//     Route::get('antigen/all/api','lab\antigenController@apiShowAll')->name('antigen.apiall');  
//     Route::get('antigen/all','lab\antigenController@showAll')->name('antigen.all');  
//     Route::get('antigen/api/get','lab\antigenController@apiGet')->name('antigen.apiget');  
//     Route::post('antigen/api/ubah/{id}', 'lab\antigenController@ubah')->name('antigen.ubah');
//     Route::get('antigen/api/getubah/{id}', 'lab\antigenController@getubah')->name('antigen.getubah');
//     Route::get('antigen/api/hapus/{id}', 'lab\antigenController@hapus')->name('antigen.hapus');
//     Route::resource('/antigen', 'lab\antigenController');
//     Route::get('antigen/{id}/cetak','lab\antigenController@cetak')->name('antigen.cetak');  
//     Route::get('antigen/{id}/print','lab\antigenController@print')->name('antigen.print');  
// });

// Kepegawaian
Route::get('kepegawaian/karyawan/profil/{id}', 'kantor\kepegawaian\profilController@showProfil')->name('kepegawaian.karyawan.profil');
Route::group(['middleware' => ['auth'], 'prefix' => 'kepegawaian', 'as' => 'kepegawaian.'], function () {
    Route::get('karyawan/cetak/{id}', 'kantor\kepegawaianController@generatePDF')->name('karyawan.cetak');
    Route::get('karyawan/nonaktif/{id}', 'kantor\kepegawaianController@nonaktif')->name('karyawan.nonaktif');
    Route::resource('karyawan', 'kantor\kepegawaianController');

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
        // // Route::get('/pengadaan/log/', 'perawat\tdkPerawatController@cariLog')->name('tdkperawat.cari');
        // Route::get('/pengadaan/log/cari', 'it\pengadaan\logPengadaanController@showLog')->name('cari.log');
        // Route::resource('/pengadaan/log', 'it\pengadaan\logPengadaanController');
        // Route::resource('/pengadaan/all', 'it\pengadaan\pengadaanAllController');
        // Route::resource('pengadaan/rutin', 'it\pengadaan\pengadaanController');
        // Route::resource('pengadaan/nonrutin', 'it\pengadaan\pengadaanNonRutinController');
        // // Route::get('/pengadaan/jenis-pengadaan', 'it\pengadaan\pengadaanController@linkToPengadaan')->name('pengadaan.pilih');
        // Route::resource('barang', 'it\pengadaan\barangPengadaanController');
        // // Route::resource('pengadaan/rutin', 'it\pengadaan\rutinController');
        // // Route::get('pengadaan/nonrutin/token/{token}','it\pengadaan\nonrutinController@getbyapi')->name('api.nonrutin');
        // // Route::get('pengadaan/rutin/cetak/{token}','it\pengadaan\rutinController@generatePDF')->name('rutin.cetak');
        // // Route::get('pengadaan/nonrutin/cetak/{token}','it\pengadaan\nonrutinController@generatePDF')->name('nonrutin.cetak');
        // Route::get('/pengadaan/api/barang/{id}', 'it\pengadaan\barangPengadaanController@apifile')->name('barang.api');
        // Route::get('pengadaan/all/{id}/cetak','it\pengadaan\pengadaanAllController@generatePDF')->name('pengadaan.cetak');

    // Kantor Route
        Route::post('absensi/{id}/tambah', 'kantor\absensiController@tambahKehadiran')->name('absensi.hadir');
        Route::post('absensi/{id}/edit', 'kantor\absensiController@ubahKehadiran')->name('absensi.edit');
        Route::post('absensi/{id}/hapus', 'kantor\absensiController@hapusKehadiran')->name('absensi.hapus');
        Route::resource('absensi', 'kantor\absensiController');

        // BERKAS RAPAT
        // Route::get('rapat/api/data', 'kantor\rapatController@getRapat')->name('rapat.api.data');
        // Route::get('rapat/api/data/{id}', 'kantor\rapatController@detailRapat')->name('rapat.api.detailData');
        // Route::get('rapat/api/data/file/{id}', 'kantor\rapatController@getFile')->name('rapat.api.detailFile');
        // Route::post('rapat/api/data/ubah/{id}', 'kantor\rapatController@ubah')->name('rapat.api.ubahData');
        // Route::get('rapat/api/data/hapus/{id}', 'kantor\rapatController@hapusRapat')->name('rapat.api.hapusData');
        // Route::resource('rapat', 'kantor\rapatController');
        // Route::get('/rapat/zip/{id}', 'kantor\rapatController@showAll');
        // Route::get('/rapat/show/{id}', 'kantor\rapatController@show');
        // Route::get('/rapat/show2/{id}', 'kantor\rapatController@show2');
        // Route::get('/rapat/show2all/{id}', 'kantor\rapatController@show2all');
        // Route::get('/rapat/show3/{id}', 'kantor\rapatController@show3');
        // Route::get('/rapat/show4/{id}', 'kantor\rapatController@show4');
        // Route::get('/rapat/show5/{id}', 'kantor\rapatController@show5');

        // Laporan Bulanan OLD
        Route::get('/laporan/bulanan/filter', 'kantor\laporanBulananController@filter')->name('bulanan.filter');
        Route::post('laporan/bulanan/api/','kantor\laporanBulananController@verifikasi'); // API
        Route::post('laporan/bulanan/api/ket/','kantor\laporanBulananController@ket'); // API
        Route::get('laporan/bulanan/api/{id}/verified', 'kantor\laporanBulananController@verified'); // API
        Route::get('laporan/bulanan/old', 'kantor\laporanBulananController@old')->name('bulanan.old');
        Route::resource('laporan/bulanan', 'kantor\laporanBulananController');
        
        // Laporan Bulanan NEW
        // Route::post('laporan/bulan/api','kantor\laporanBulananNewController@verifikasi'); // API
        // Route::get('laporan/bulan/api/getubah/{id}','kantor\laporanBulananNewController@getUbah'); // API
        // Route::post('laporan/bulan/api/ubah/{id}','kantor\laporanBulananNewController@ubah'); // API
        // Route::post('laporan/bulan/api','kantor\laporanBulananNewController@verifikasi'); // API
        // Route::get('laporan/bulan/api/hapus/{id}','kantor\laporanBulananNewController@hapusLaporan'); // API
        // Route::get('laporan/bulan/api/ket/{id}/hapus','kantor\laporanBulananNewController@ketHapus'); // API
        // Route::get('laporan/bulan/api/ket/{id}','kantor\laporanBulananNewController@ketGet'); // API
        // Route::post('laporan/bulan/api/ket','kantor\laporanBulananNewController@ket'); // API
        // Route::get('laporan/bulan/api/{id}/verified', 'kantor\laporanBulananNewController@verified'); // API
        // Route::get('laporan/bulan/tableverif', 'kantor\laporanBulananNewController@tableVerifikasi');
        // Route::get('laporan/bulan/table', 'kantor\laporanBulananNewController@table')->name('api.laporan.bulan');
        // Route::get('laporan/bulan/tableadmin', 'kantor\laporanBulananNewController@tableadmin');
        // Route::get('laporan/bulan/verif/{id}/hapus', 'kantor\laporanBulananNewController@hapusVerif');
        // Route::get('laporan/bulan/restore/table/hapus/{id}/batal', 'kantor\laporanBulananNewController@batalHapus');
        // Route::get('laporan/bulan/restore/table/hapus', 'kantor\laporanBulananNewController@tableRiwayatTerhapus');
        // Route::get('laporan/bulan/restore', 'kantor\laporanBulananNewController@tampilRiwayatTerhapus')->name('restore.laporan.bulanan');
        // Route::get('laporan/bulan/riwayat/table', 'kantor\laporanBulananNewController@tableRiwayatVerifikasi');
        // Route::get('laporan/bulan/riwayat', 'kantor\laporanBulananNewController@riwayatVerifikasi')->name('riwayat.laporan.bulanan');
        // Route::resource('laporan/bulan', 'kantor\laporanBulananNewController');

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
                Route::get('tindakan-harian/api/{id}/hapus', 'perawat\tindakan_harian\tindakanHarianController@apiHapus')->name('th.hapus');
                Route::post('tindakan-harian/table/update', 'perawat\tindakan_harian\tindakanHarianController@apiUpdate')->name('th.update');
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
        // Route::get('kebidanan/skl/all','kebidanan\sklController@showAll')->name('skl.all');
        // Route::get('kebidanan/skl/all/api','kebidanan\sklController@apiAll')->name('skl.apiall');  
        // Route::get('kebidanan/skl/{id}/cetak','kebidanan\sklController@cetak')->name('skl.cetak');  
        // Route::get('kebidanan/skl/{id}/print','kebidanan\sklController@print')->name('skl.print');  
        // Route::resource('kebidanan/skl', 'kebidanan\sklController');
        // Route::get('cetak/word', 'kebidanan\sklController@word');

    // K3
    // Route::resource('k3/accidentreport', 'k3\accidentReportController');
    // Route::post('/k3/accidentreport/{id}/check', 'k3\accidentReportController@verifikasi')->name('accidentreport.check');
    // Route::get('k3/accidentreport/{id}/show', 'k3\accidentReportController@show')->name('accidentreport.show'); 
    // Route::get('k3/accidentreport/{id}/cetak','k3\accidentReportController@cetak')->name('accidentreport.cetak');  
    
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
    // Route::post('pengaduan/ipsrs/selesai', 'ipsrs\pengaduan\pengaduanController@selesai')->name('pengaduan.ipsrs.selesai');
    // Route::post('pengaduan/ipsrs/tambahketerangan', 'ipsrs\pengaduan\pengaduanController@tambahketerangan')->name('pengaduan.ipsrs.tambahketerangan');
    // Route::post('pengaduan/ipsrs/ubahketerangan', 'ipsrs\pengaduan\pengaduanController@ubahketerangan')->name('pengaduan.ipsrs.ubahketerangan');
    // Route::post('pengaduan/ipsrs/kerjakan', 'ipsrs\pengaduan\pengaduanController@kerjakan')->name('pengaduan.ipsrs.kerjakan');
    // Route::post('pengaduan/ipsrs/kerjakan/ubah', 'ipsrs\pengaduan\pengaduanController@ubahKerjakan')->name('pengaduan.ipsrs.ubah.kerjakan');
    // Route::post('pengaduan/ipsrs/terima', 'ipsrs\pengaduan\pengaduanController@terima')->name('pengaduan.ipsrs.terima');
    // Route::post('pengaduan/ipsrs/terima/ubah', 'ipsrs\pengaduan\pengaduanController@ubahTerima')->name('pengaduan.ipsrs.ubah.terima');
    // Route::post('pengaduan/ipsrs/tolak', 'ipsrs\pengaduan\pengaduanController@tolak')->name('pengaduan.ipsrs.tolak');
    // Route::get('pengaduan/ipsrs/detail/{id}', 'ipsrs\pengaduan\pengaduanController@detail')->name('pengaduan.ipsrs.detail');
    // Route::get('pengaduan/ipsrs/lampiran/catatan/{id}', 'ipsrs\pengaduan\pengaduanController@showCatatan')->name('pengaduan.ipsrs.lampiran.catatan');
    // Route::get('pengaduan/ipsrs/history', 'ipsrs\pengaduan\pengaduanController@history')->name('pengaduan.ipsrs.history');
    // Route::resource('pengaduan/ipsrs', 'ipsrs\pengaduan\pengaduanController');

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

// Pengadaan
Route::get('pengadaan', 'publik\pengadaan\pengadaanController@index')->name('pengadaan.index');
Route::get('pengadaan/api/data', 'publik\pengadaan\pengadaanController@getPengadaan')->name('pengadaan.api.data');
Route::get('pengadaan/api/data/{id}', 'publik\pengadaan\pengadaanController@detailPengadaan')->name('pengadaan.api.detailData');
Route::get('pengadaan/api/data/hapus/{id}', 'publik\pengadaan\pengadaanController@hapusPengadaan')->name('pengadaan.api.hapus');
Route::get('pengadaan/tambah/api/barang/detail/{id}', 'publik\pengadaan\pengadaanController@getBarangDetail')->name('pengadaan.api.barangDetail');
Route::get('pengadaan/tambah/api/barang/{id}', 'publik\pengadaan\pengadaanController@getBarang')->name('pengadaan.api.barang');
Route::post('pengadaan/tambah', 'publik\pengadaan\pengadaanController@create')->name('pengadaan.create');
Route::post('pengadaan', 'publik\pengadaan\pengadaanController@store')->name('pengadaan.store');
Route::get('pengadaan/api/barang', 'publik\pengadaan\barangPengadaanController@apiGet')->name('barang.api.get');
Route::get('pengadaan/api/barang/hapus/{id}', 'publik\pengadaan\barangPengadaanController@apiHapus')->name('barang.api.hapus');
Route::resource('pengadaan/barang', 'publik\pengadaan\barangPengadaanController');
    // Rekap Pengadaan
    Route::get('pengadaan/rekap', 'publik\pengadaan\pengadaanController@indexRekap')->name('rekap.index');
    Route::get('pengadaan/rekap/all', 'publik\pengadaan\pengadaanController@RekapAll')->name('rekapAll.index');
    Route::get('pengadaan/rekap/api/data/bulan/{bulan}/tahun/{tahun}', 'publik\pengadaan\pengadaanController@getRekap')->name('rekap.api.data');
    Route::get('pengadaan/rekap/api/data/barang/addfield/{barang}', 'publik\pengadaan\pengadaanController@addField')->name('rekap.api.dataBarangAddField');

// ADMINISTRASI
    // REGULASI
        Route::resource('regulasi/kebijakan', 'administrasi\regulasi\kebijakanController');
        Route::resource('regulasi/panduan', 'administrasi\regulasi\panduanController');
        Route::resource('regulasi/pedoman', 'administrasi\regulasi\pedomanController');
        Route::resource('regulasi/program', 'administrasi\regulasi\programController');
        // SPO
            Route::get('regulasi/spo/api/get','administrasi\regulasi\spoController@apiGet')->name('spo.apiGet');  
            Route::get('regulasi/spo/api/getubah/{id}', 'administrasi\regulasi\spoController@getubah')->name('spo.apiGetUbah');
            Route::post('regulasi/spo/api/ubah/{id}', 'administrasi\regulasi\spoController@ubah')->name('spo.apiUbah');
            Route::get('regulasi/spo/api/hapus/{id}', 'administrasi\regulasi\spoController@hapus')->name('spo.apiHapus');
            Route::resource('regulasi/spo', 'administrasi\regulasi\spoController');
    
    // JADWAL DINAS
        Route::get('administrasi/jadwaldinas', 'administrasi\jadwalDinasController@index')->name('jadwal.dinas.index');
        Route::get('administrasi/jadwaldinas/ubah/{id}', 'administrasi\jadwalDinasController@showUbah')->name('jadwal.dinas.showUbah');
        Route::get('administrasi/jadwaldinas/api/cek', 'administrasi\jadwalDinasController@cek')->name('jadwal.dinas.cek');
        Route::put('administrasi/jadwaldinas/api/ubah/{id}', 'administrasi\jadwalDinasController@ubah')->name('jadwal.dinas.ubah');
        Route::get('administrasi/jadwaldinas/api/detail/{id}', 'administrasi\jadwalDinasController@showDetail')->name('jadwal.dinas.show');
        Route::get('administrasi/jadwaldinas/api/hapus/{id}', 'administrasi\jadwalDinasController@hapus')->name('jadwal.dinas.hapus');
        Route::post('administrasi/jadwaldinas/create', 'administrasi\jadwalDinasController@create')->name('jadwal.dinas.create');
        Route::get('administrasi/jadwaldinas/create/api/data', 'administrasi\jadwalDinasController@getDataCreate');
        Route::post('administrasi/jadwaldinas', 'administrasi\jadwalDinasController@store')->name('jadwal.dinas.store');
        Route::get('administrasi/jadwaldinas/staf', 'administrasi\jadwalDinasController@indexStaf')->name('staf.jadwal.dinas.index');
        Route::post('administrasi/jadwaldinas/staf', 'administrasi\jadwalDinasController@storeStaf')->name('staf.jadwal.dinas.store');
        Route::put('administrasi/jadwaldinas/staf/api/ubah/{id}', 'administrasi\jadwalDinasController@ubahStaf')->name('staf.jadwal.dinas.ubah');
        Route::get('administrasi/jadwaldinas/staf/api/hapus/{id}', 'administrasi\jadwalDinasController@hapusStaf')->name('staf.jadwal.dinas.hapus');
        Route::get('administrasi/jadwaldinas/ref', 'administrasi\jadwalDinasController@indexRef')->name('ref.jadwal.dinas.index');
        Route::post('administrasi/jadwaldinas/ref', 'administrasi\jadwalDinasController@storeRef')->name('ref.jadwal.dinas.store');
        Route::put('administrasi/jadwaldinas/ref/api/ubah/{id}', 'administrasi\jadwalDinasController@ubahRef')->name('ref.jadwal.dinas.ubah');
        Route::get('administrasi/jadwaldinas/ref/api/hapus/{id}', 'administrasi\jadwalDinasController@hapusRef')->name('ref.jadwal.dinas.hapus');
        
////////////////////////////////////////////////////////////////////////////////////////////////   SIMRSMU V.2  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
////////////////////////////////////////////////////////////////////////////////////////////////    RESOURCE    \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::group(['middleware' => ['auth'], 'prefix' => 'v2', 'as' => ''], function () {

// ADMIN -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
    // USER ACCOUNT
        Route::resource('admin/user', 'administrator\user\userController');

    // ABSENSI
        Route::resource('absen', 'absen\absenController');
        Route::resource('attendance', 'attendance\attendanceController');

    // LAPORAN BULANAN
        Route::resource('admin/laporan/bulananadm', 'laporan\bulanan\bulananAdminController');

// USER --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // BERANDA
        Route::get('beranda', 'simrsmuv2Controller@index')->name('beranda.index');

    // ANTROL
        Route::get('antrol/display', 'antrol\allController@display')->name('antrol.display'); 
        Route::resource('antrol', 'antrol\allController');

    // PROFIL KARYAWAN
        Route::get('profil/ubahpassword', 'Auth\ChangePasswordController@showChangePasswordForm')->name('profil.ubahpassword');
        Route::patch('profil/ubahpassword', 'Auth\ChangePasswordController@changePassword');
        Route::post('profil/foto', 'Admin\profilController@storeImg');
        Route::resource('profil', 'Admin\profilController');

    // K3
        // MANAJEMEN RESIKO
            Route::post('k3/manrisk/save/berulang', 'k3\manriskController@saveBerulang')->name('manrisk.residual');
            // Route::get('api/k3/manrisk/data', 'k3\manriskController@apiData');
            Route::resource('k3/manrisk', 'k3\manriskController');
        // ACCIDENT REPORT
            Route::post('k3/accidentreport/{id}/check', 'k3\accidentReportController@verifikasi')->name('accidentreport.check');
            Route::get('k3/accidentreport/{id}/show', 'k3\accidentReportController@show')->name('accidentreport.show');
            Route::get('k3/accidentreport/{id}/cetak','k3\accidentReportController@cetak')->name('accidentreport.cetak');
            Route::resource('k3/accidentreport', 'k3\accidentReportController');
    
    // LAPORAN
        // BULANAN
            // Route::post('laporan/bulan/api','kantor\laporanBulananNewController@verifikasi'); // API
            // Route::get('laporan/bulan/api/getubah/{id}','kantor\laporanBulananNewController@getUbah'); // API
            // Route::post('laporan/bulan/api/ubah/{id}','kantor\laporanBulananNewController@ubah'); // API
            // Route::post('laporan/bulan/api','kantor\laporanBulananNewController@verifikasi'); // API
            // Route::get('laporan/bulan/api/hapus/{id}','kantor\laporanBulananNewController@hapusLaporan'); // API
            // Route::get('laporan/bulan/api/ket/{id}/hapus','kantor\laporanBulananNewController@ketHapus'); // API
            // Route::get('laporan/bulan/api/ket/{id}','kantor\laporanBulananNewController@ketGet'); // API
            // Route::post('laporan/bulan/api/ket','kantor\laporanBulananNewController@ket'); // API
            // Route::get('laporan/bulan/api/{id}/verified', 'kantor\laporanBulananNewController@verified'); // API
            // Route::get('laporan/bulan/tableverif', 'kantor\laporanBulananNewController@tableVerifikasi');
            // Route::get('laporan/bulan/table', 'kantor\laporanBulananNewController@table')->name('api.laporan.bulan');
            // Route::get('laporan/bulan/tableadmin', 'kantor\laporanBulananNewController@tableadmin');
            // Route::get('laporan/bulan/verif/{id}/hapus', 'kantor\laporanBulananNewController@hapusVerif');
            // Route::get('laporan/bulan/restore/table/hapus/{id}/batal', 'kantor\laporanBulananNewController@batalHapus');
            // Route::get('laporan/bulan/restore/table/hapus', 'kantor\laporanBulananNewController@tableRiwayatTerhapus');
            // Route::get('laporan/bulan/restore', 'kantor\laporanBulananNewController@tampilRiwayatTerhapus')->name('restore.laporan.bulanan');
            // Route::get('laporan/bulan/riwayat/table', 'kantor\laporanBulananNewController@tableRiwayatVerifikasi');
            // Route::get('laporan/bulan/riwayat', 'kantor\laporanBulananNewController@riwayatVerifikasi')->name('riwayat.laporan.bulanan');

            // USER
            // Route::get('laporan/bulanan/download/{id}', 'laporan\bulanan\bulananUserController@download')->name('bulanan.download');
            Route::get('laporan/bulanan/verif', 'laporan\bulanan\bulananUserController@showVerif')->name('bulanan.verif');
            Route::resource('laporan/bulanan', 'laporan\bulanan\bulananUserController');

        // IPSRS
            // Route::post('laporan/pengaduan/ipsrs/selesai', 'ipsrs\pengaduan\pengaduanController@selesai')->name('pengaduan.ipsrs.selesai');
            // Route::post('laporan/pengaduan/ipsrs/tambahketerangan', 'ipsrs\pengaduan\pengaduanController@tambahketerangan')->name('pengaduan.ipsrs.tambahketerangan');

            Route::post('laporan/pengaduan/ipsrs/catatan', 'ipsrs\pengaduan\pengaduanController@catatan')->name('pengaduan.ipsrs.catatan');
            Route::post('laporan/pengaduan/ipsrs/catatan/ubah', 'ipsrs\pengaduan\pengaduanController@ubahCatatan')->name('pengaduan.ipsrs.ubahCatatan');

            // Route::post('laporan/pengaduan/ipsrs/kerjakan', 'ipsrs\pengaduan\pengaduanController@kerjakan')->name('pengaduan.ipsrs.kerjakan');
            // Route::post('laporan/pengaduan/ipsrs/kerjakan/ubah', 'ipsrs\pengaduan\pengaduanController@ubahKerjakan')->name('pengaduan.ipsrs.ubah.kerjakan');
            // Route::post('laporan/pengaduan/ipsrs/terima', 'ipsrs\pengaduan\pengaduanController@terima')->name('pengaduan.ipsrs.terima');
            // Route::post('laporan/pengaduan/ipsrs/terima/ubah', 'ipsrs\pengaduan\pengaduanController@ubahTerima')->name('pengaduan.ipsrs.ubah.terima');
            // Route::post('laporan/pengaduan/ipsrs/tolak', 'ipsrs\pengaduan\pengaduanController@tolak')->name('pengaduan.ipsrs.tolak');
            Route::get('laporan/pengaduan/ipsrs/detail/{id}', 'ipsrs\pengaduan\pengaduanController@detail')->name('ipsrs.detail');
            // Route::get('laporan/pengaduan/ipsrs/catatan/{id}', 'ipsrs\pengaduan\pengaduanController@downloadCatatan');
            // Route::get('laporan/pengaduan/ipsrs/history', 'ipsrs\pengaduan\pengaduanController@history')->name('ipsrs.history');
            Route::get('laporan/pengaduan/ipsrs/riwayat', 'ipsrs\pengaduan\pengaduanController@riwayat')->name('ipsrs.riwayat');
            Route::resource('laporan/pengaduan/ipsrs', 'ipsrs\pengaduan\pengaduanController');
        
        // PPI
            Route::resource('laporan/ppi/surveilans', 'ppi\surveilansController');

    // Kebidanan
        Route::get('kebidanan/skl/all','kebidanan\sklController@showAll')->name('skl.all');
        Route::get('kebidanan/skl/{id}/cetak','kebidanan\sklController@cetak')->name('skl.cetak');  
        Route::get('kebidanan/skl/{id}/print','kebidanan\sklController@print')->name('skl.print');  
        Route::resource('kebidanan/skl', 'kebidanan\sklController');

    // Lab
        // Route::get('lab/antigen/all','lab\antigenController@showAll')->name('antigen.all');  
        Route::get('lab/antigen/filter','lab\antigenController@filter')->name('antigen.filter');  
        Route::get('lab/antigen/{id}/cetak','lab\antigenController@cetak')->name('antigen.cetak');  
        Route::get('lab/antigen/{id}/print','lab\antigenController@print')->name('antigen.print');  
        Route::resource('/lab/antigen', 'lab\antigenController');

    // REGULASI
        Route::get('regulasi', 'administrasi\regulasiController@index')->name('regulasi.index');
        Route::get('regulasi/{id}/download', 'administrasi\regulasiController@download')->name('regulasi.download');

    // BERKAS
        // RAPAT
            Route::resource('berkas/rapat', 'berkas\berkasRapatController');

    // KEPEGAWAIAN
        // KARYAWAN
            Route::resource('kepegawaian/karyawan', 'kepegawaian\karyawanController');

    // PERENCANAAN
        // RKA
            Route::post('rka/fileupload', 'administrasi\rkaController@fileupload')->name('rka.upload');
            Route::resource('rka', 'administrasi\rkaController');

    // BRIDGING
        // PILAR
            Route::get('bridging/pilar', 'pilar\pasienController@index')->name('pilar.pasien');

    // TATA USAHA
        // SURAT MASUK
            Route::get('suratmasuk', 'tu\suratMasukController@index')->name('suratmasuk.index');
            Route::get('suratmasuk/{id}/download', 'tu\suratMasukController@download');
            Route::post('suratmasuk', 'tu\suratMasukController@store')->name('suratmasuk.store');
        // SURAT KELUAR
            Route::get('suratkeluar', 'tu\suratKeluarController@index')->name('suratkeluar.index');
            Route::get('suratkeluar/{id}/download', 'tu\suratKeluarController@download');
            Route::post('suratkeluar', 'tu\suratKeluarController@store')->name('suratkeluar.store');

    // NEW PENGADAAN
        Route::get('pengadaan', 'pengadaan\pengadaanController@index')->name('pengadaanv2.index');
        Route::get('pengadaan/tambah', 'pengadaan\pengadaanController@showTambah')->name('pengadaanv2.tambah');

    // SYSTEM
        // SETTING
            Route::resource('system/setting/strukturorganisasi', 'system\setting\strukturOrganisasiController');
        // UPDATE
            Route::resource('system/update', 'system\updateController');
});
////////////////////////////////////////////////////////////////////////////////////////////////    API    \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::group(['middleware' => ['auth'], 'prefix' => 'api', 'as' => ''], function () {

    // ADMIN -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // USER ACCOUNT
        Route::get('admin/user/{id}', 'administrator\user\userController@verifName')->name('admin.verif');
        Route::get('admin/user/hapus/{id}', 'administrator\user\userController@hapus')->name('admin.hapus');

    // USER --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // PROFIL
        Route::get('provinsi/{id}', 'Admin\profilController@apiProvinsi');
        Route::get('kota/{id}', 'Admin\profilController@apiKota');
        Route::get('kecamatan/{id}', 'Admin\profilController@apiKecamatan');
    
    // REGULASI
        Route::get('regulasi/showtambah', 'administrasi\regulasiController@showTambah');
        Route::post('regulasi/tambah', 'administrasi\regulasiController@tambah')->name('regulasi.tambah');
        Route::get('regulasi/showubah/{id}', 'administrasi\regulasiController@showUbah');
        Route::post('regulasi/ubah', 'administrasi\regulasiController@ubah')->name('regulasi.ubah');
        Route::delete('regulasi/{id}', 'administrasi\regulasiController@hapus');
        Route::post('regulasi/filter', 'administrasi\regulasiController@cariRegulasi');
        Route::get('regulasi/totalregulasi', 'administrasi\regulasiController@apiTotalRegulasi');

    // MANRISK
        Route::get('k3/manrisk/berulang/validasi/{id}', 'k3\manriskController@apiValidasiBerulang');
        Route::get('k3/manrisk/berulang/{id}', 'k3\manriskController@apiBerulang');
        Route::post('k3/manrisk/simpan', 'k3\manriskController@apiSimpan');
        Route::get('k3/manrisk/role', 'k3\manriskController@apiRole');
        Route::get('k3/manrisk/data', 'k3\manriskController@apiData');
        Route::get('k3/manrisk/hapus/{id}', 'k3\manriskController@apiHapus');

    // PENGADUAN IPSRS
        Route::get('laporan/pengaduan/ipsrs/lokasi', 'ipsrs\pengaduan\pengaduanController@autocompleteLokasi')->name('ac.ipsrs.lokasi');
        Route::post('laporan/pengaduan/ipsrs/verif/{id}', 'ipsrs\pengaduan\pengaduanController@verif')->name('ipsrs.verif');
        Route::post('laporan/pengaduan/ipsrs/unverif/{id}', 'ipsrs\pengaduan\pengaduanController@unverif')->name('ipsrs.unverif');
        Route::post('laporan/pengaduan/ipsrs/process/{id}', 'ipsrs\pengaduan\pengaduanController@process')->name('ipsrs.process');
        Route::post('laporan/pengaduan/ipsrs/finish/{id}', 'ipsrs\pengaduan\pengaduanController@finish')->name('ipsrs.finish');
        Route::get('laporan/pengaduan/ipsrs/result/{id}', 'ipsrs\pengaduan\pengaduanController@result')->name('ipsrs.result');
        Route::post('laporan/pengaduan/ipsrs/filter', 'ipsrs\pengaduan\pengaduanController@filter')->name('ipsrs.filter');
    
    // SKL
        Route::get('kebidanan/skl/get','kebidanan\sklController@apiGet');
        Route::get('kebidanan/skl/all','kebidanan\sklController@apiAll');
        Route::get('kebidanan/skl/getubah/{id}', 'kebidanan\sklController@getubah');
        Route::get('kebidanan/skl/hapus/{id}', 'kebidanan\sklController@hapus');
        Route::post('kebidanan/skl/ubah/{id}', 'kebidanan\sklController@ubah');
    
    // LAB
        // ANTIGEN
            Route::get('antigen/all','lab\antigenController@apiShowAll')->name('antigen.apiall');  
            Route::get('antigen/get','lab\antigenController@apiGet')->name('antigen.apiget');  
            Route::post('antigen/filter', 'lab\antigenController@apiFilter')->name('antigen.apifilter');
            // Route::get('antigen/filter/{id}', 'lab\antigenController@apiFilter')->name('antigen.apiFilter');
            Route::post('antigen/ubah/{id}', 'lab\antigenController@ubah')->name('antigen.ubah');
            Route::get('antigen/getubah/{id}', 'lab\antigenController@getubah')->name('antigen.getubah');
            Route::get('antigen/hapus/{id}', 'lab\antigenController@hapus')->name('antigen.hapus');
            Route::get('antigen/getpasien/{id}', 'lab\antigenController@getPasien');
    
    // LAPORAN
        // BULANAN
            Route::get('laporan/bulanan/formverif', 'laporan\bulanan\bulananUserController@formVerif');
            Route::get('laporan/bulanan/formupload', 'laporan\bulanan\bulananUserController@formUpload');
            Route::get('laporan/bulanan/table/verif', 'laporan\bulanan\bulananUserController@tableVerif');
            Route::get('laporan/bulanan/table/user', 'laporan\bulanan\bulananUserController@table');
            Route::get('laporan/bulanan/getubah/{id}','laporan\bulanan\bulananUserController@getUbah');
            Route::get('laporan/bulanan/hapus/{id}','laporan\bulanan\bulananUserController@hapus');
            Route::post('laporan/bulanan/ubah/{id}','laporan\bulanan\bulananUserController@ubah');
    
    // BERKAS
        // RAPAT
            Route::get('berkas/rapat/data', 'berkas\berkasRapatController@getRapat');
            Route::get('berkas/rapat/data/{id}', 'berkas\berkasRapatController@detailRapat');
            Route::post('berkas/rapat/data/{id}/ubah', 'berkas\berkasRapatController@ubah');
            Route::get('berkas/rapat/data/{id}/hapus', 'berkas\berkasRapatController@hapusRapat');
            Route::get('berkas/rapat/data/{id}/download', 'berkas\berkasRapatController@getFile');
            Route::get('berkas/rapat/data/{id}/zip', 'berkas\berkasRapatController@showAll');
            // Route::get('/rapat/show/{id}', 'kantor\rapatController@show');
            // Route::get('/rapat/show2/{id}', 'kantor\rapatController@show2');
            // Route::get('/rapat/show2all/{id}', 'kantor\rapatController@show2all');
            // Route::get('/rapat/show3/{id}', 'kantor\rapatController@show3');
            // Route::get('/rapat/show4/{id}', 'kantor\rapatController@show4');
            // Route::get('/rapat/show5/{id}', 'kantor\rapatController@show5');        

    // PERENCANAAN
        // RKA
            Route::get('rka/table', 'administrasi\rkaController@table');
            // Route::post('rka/upload','administrasi\rkaController@upload')->name('api.rka.upload');
            Route::get('rka/hapus/{id}', 'administrasi\rkaController@hapus');

    // TATA USAHA
        // SURAT MASUK
            Route::get('suratmasuk/data', 'tu\suratMasukController@apiGet');
            Route::get('suratmasuk/data/{id}', 'tu\suratMasukController@showChange');
            Route::post('suratmasuk/ubah', 'tu\suratMasukController@ubah')->name('suratmasuk.ubah');
            // Route::put('suratmasuk/{id}', 'tu\suratMasukController@update');
            Route::delete('suratmasuk/{id}', 'tu\suratMasukController@hapus');
            Route::get('suratmasuk/cariasal', 'tu\suratMasukController@acAsal')->name('ac.asal.cari');
            Route::get('suratmasuk/caritempat', 'tu\suratMasukController@acTempat')->name('ac.tempat.cari');
        // SURAT MASUK
            Route::get('suratkeluar/getkode/{id}', 'tu\suratKeluarController@apiKode');
            Route::get('suratkeluar/data', 'tu\suratKeluarController@apiGet');
            Route::get('suratkeluar/data/{id}', 'tu\suratKeluarController@showChange');
            Route::post('suratkeluar/ubah', 'tu\suratKeluarController@ubah')->name('suratkeluar.ubah');
            Route::delete('suratkeluar/{id}', 'tu\suratKeluarController@hapus');
    
    // PPI
        // PLEBITIS
            Route::get('ppi/plebitis/{rm}','ppi\PlebitisController@apiGetRm');  
        // IDO
            Route::get('ppi/ido/{rm}','ppi\IdoController@apiGetRm');  
        // ISK
            Route::get('ppi/isk/{rm}','ppi\IskController@apiGetRm');  
        // DECUBITUS
            Route::get('ppi/decubitus/{rm}','ppi\DecubitusController@apiGetRm');  
        // VAP
            Route::get('ppi/vap/{rm}','ppi\VapController@apiGetRm'); 
        // NEW SURVEILANS
            Route::get('laporan/ppi/surveilans/getpasien/{id}', 'ppi\surveilansController@getPasien');
            Route::get('laporan/ppi/surveilans/getdata/{id}', 'ppi\surveilansController@show');

    // SYSTEM
        // UPDATE
            Route::get('system/update/data', 'system\updateController@apiGet');

});

////////////////////////////////////////////////////////////////////////////////////////////////    <>    \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\