<?php
Route::get('/', 'WelcomeController@welcome')->name('homepage');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
});

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
        Route::resource('pengadaan/rutin', 'it\pengadaan\pengadaanController');
        Route::resource('pengadaan/nonrutin', 'it\pengadaan\pengadaanNonRutinController');
        Route::get('/pengadaan/jenis-pengadaan', 'it\pengadaan\pengadaanController@linkToPengadaan')->name('pengadaan.pilih');
        Route::resource('barang', 'it\pengadaan\barangPengadaanController');
        // Route::resource('pengadaan/rutin', 'it\pengadaan\rutinController');
        // Route::get('pengadaan/nonrutin/token/{token}','it\pengadaan\nonrutinController@getbyapi')->name('api.nonrutin');
        // Route::get('pengadaan/rutin/cetak/{token}','it\pengadaan\rutinController@generatePDF')->name('rutin.cetak');
        // Route::get('pengadaan/nonrutin/cetak/{token}','it\pengadaan\nonrutinController@generatePDF')->name('nonrutin.cetak');
        Route::get('/pengadaan/api/barang/{id}', 'it\pengadaan\barangPengadaanController@apifile')->name('barang.api');


    // Kantor Route
        Route::resource('rapat', 'kantor\rapatController');
        Route::get('/rapat/show/{id}', 'kantor\rapatController@show');
        Route::get('/rapat/show2/{id}', 'kantor\rapatController@show2');
        Route::get('/rapat/show3/{id}', 'kantor\rapatController@show3');
        Route::get('/rapat/show4/{id}', 'kantor\rapatController@show4');