<?php
Route::resource('/', 'WelcomeController');
Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');
// Route::resource('/antrian', 'queuePoliController');
// Route::get('/demos', function () {
//     return view('index');
// });
// Route::resource('/lokasi', 'other\lokasiController');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
Route::post('edit_akun/{id}', 'Admin\UsersController@ubahData')->name('ubah.akun');

// Other
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/file-manager', 'HomeController@fileManager')->name('file_manager'); //file manager
Route::resource('user', 'Admin\profilController');
Route::post('/user/foto', 'Admin\profilController@storeImg');
// Route::post('/antrian/poli/antrian', 'queueController@tambahAntrianSaatIni')->name('antriansaatini');
// Route::get('/', 'HomeController@index'); //file manager

// Admin
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
    Route::resource('supervisi', 'it\log\logController');

    
    // Antrian Poli
    Route::resource('/antrian/poli', 'queue\admin\setQueuePoliController');

    // Imut
        // Pilar
        Route::post('/imut/pilar/{id}', 'it\imut\pilarController@pilarClear')->name('pilar.selesai');
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

});

// Kepegawaian
Route::group(['middleware' => ['auth'], 'prefix' => 'kepegawaian', 'as' => 'kepegawaian.'], function () {
    Route::resource('/karyawan', 'kantor\kepegawaianController');
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
        Route::get('/rapat/show/{id}', 'kantor\rapatController@show');
        Route::get('/rapat/show2/{id}', 'kantor\rapatController@show2');
        Route::get('/rapat/show3/{id}', 'kantor\rapatController@show3');
        Route::get('/rapat/show4/{id}', 'kantor\rapatController@show4');
        Route::get('/rapat/show5/{id}', 'kantor\rapatController@show5');
        Route::resource('regulasi', 'kantor\regulasiController');
        Route::resource('laporan/bulanan', 'kantor\laporanBulananController');

    // Log Perawat
        // Pernyataan Log
            Route::resource('logperawat', 'perawat\logPerawatController');
            Route::resource('logtgsperawat', 'perawat\logTgsPerawatController');
            Route::resource('logprofkpr', 'perawat\logProfKprController');

        // Tindakan Harian
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
        Route::get('cetak/word', 'kebidanan\sklController@word');

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

// IPSRS
    Route::post('pengaduan/ipsrs/selesai', 'ipsrs\pengaduan\pengaduanController@selesai')->name('pengaduan.ipsrs.selesai');
    Route::post('pengaduan/ipsrs/tambahketerangan', 'ipsrs\pengaduan\pengaduanController@tambahketerangan')->name('pengaduan.ipsrs.tambahketerangan');
    Route::post('pengaduan/ipsrs/kerjakan', 'ipsrs\pengaduan\pengaduanController@kerjakan')->name('pengaduan.ipsrs.kerjakan');
    Route::post('pengaduan/ipsrs/terima', 'ipsrs\pengaduan\pengaduanController@terima')->name('pengaduan.ipsrs.terima');
    Route::post('pengaduan/ipsrs/tolak', 'ipsrs\pengaduan\pengaduanController@tolak')->name('pengaduan.ipsrs.tolak');
    Route::resource('pengaduan/ipsrs', 'ipsrs\pengaduan\pengaduanController');