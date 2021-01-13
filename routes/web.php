<?php
Route::resource('/', 'WelcomeController');
Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
    Route::resource('unit', 'Admin\UnitController');
});
    // IT
        // Log
        Route::resource('/it/supervisi', 'it\log\logController');
        Route::get('it/home', 'it\itController@index')->name('it.home');

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
        Route::resource('rapat', 'kantor\rapatController');
        Route::get('/rapat/show/{id}', 'kantor\rapatController@show');
        Route::get('/rapat/show2/{id}', 'kantor\rapatController@show2');
        Route::get('/rapat/show3/{id}', 'kantor\rapatController@show3');
        Route::get('/rapat/show4/{id}', 'kantor\rapatController@show4');

    // Log Perawat
        // Tindakan Harian
            Route::get('/tdkperawat/cari', 'perawat\tdkPerawatController@cariLog')->name('tdkperawat.cari');
            Route::resource('logperawat', 'perawat\logPerawatController');
            // Route::get('tdkperawat/{id}', 'perawat\tdkPerawatController@show')->name('tdkperawat.show');
            Route::resource('tdkperawat', 'perawat\tdkPerawatController');
            Route::get('tdkperawat/{id}/cetak','perawat\tdkPerawatController@generatePDF')->name('tdkperawat.cetak');

        // Log Profesi Keperawatan
        Route::resource('profkpr', 'perawat\profKprController');

        // Log Penunjang Tugas Perawat
        Route::resource('tgsperawat', 'perawat\tgsPerawatController');

    // Kebidanan
    Route::resource('kebidanan/skl', 'kebidanan\sklController');
    Route::get('kebidanan/skl/{id}/cetak','kebidanan\sklController@cetak')->name('skl.cetak');  
    // Route::get('cetak/word', 'kebidanan\sklController@word');

    // K3
    Route::resource('k3/accidentreport', 'k3\accidentReportController');