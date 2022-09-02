<?php
// use App\Http\Controllers\k3\manriskController;
// use App\Http\Controllers\Admin\profilController;

Route::group(['prefix' => '', 'as' => ''], function () {


// // API PROFIL
//   Route::get('provinsi/{id}', 'Admin\profilController@apiProvinsi');
//   Route::get('kota/{id}', 'Admin\profilController@apiKota');
//   Route::get('kecamatan/{id}', 'Admin\profilController@apiKecamatan');

// // MANRISK
//   Route::get('k3/manrisk/berulang/validasi/{id}', 'k3\manriskController@apiValidasiBerulang');
//   Route::get('k3/manrisk/berulang/{id}', 'k3\manriskController@apiBerulang');
//   Route::get('k3/manrisk/data', 'k3\manriskController@apiData');
//   Route::get('k3/manrisk/hapus/{id}', 'k3\manriskController@apiHapus');

// // SKL
//   Route::get('kebidanan/skl/all','kebidanan\sklController@apiAll');

// // ANTIGEN
//   Route::get('antigen/all','lab\antigenController@apiShowAll')->name('antigen.apiall');  
//   Route::get('antigen/get','lab\antigenController@apiGet')->name('antigen.apiget');  
//   Route::post('antigen/ubah/{id}', 'lab\antigenController@ubah')->name('antigen.ubah');
//   Route::get('antigen/getubah/{id}', 'lab\antigenController@getubah')->name('antigen.getubah');
//   Route::get('antigen/hapus/{id}', 'lab\antigenController@hapus')->name('antigen.hapus');

});