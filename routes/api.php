<?php
// use App\Http\Controllers\k3\manriskController;
// use App\Http\Controllers\Admin\profilController;

Route::group(['prefix' => '', 'as' => ''], function () {


// API PROFIL
  Route::get('api/provinsi/{id}', 'Admin\profilController@apiProvinsi');
  Route::get('api/kota/{id}', 'Admin\profilController@apiKota');
  Route::get('api/kecamatan/{id}', 'Admin\profilController@apiKecamatan');

// MANRISK
  Route::get('api/k3/manrisk/berulang/validasi/{id}', 'k3\manriskController@apiValidasiBerulang');
  Route::get('api/k3/manrisk/berulang', 'k3\manriskController@apiBerulang');
  Route::get('k3/manrisk/data', 'k3\manriskController@apiData');
  // Route::get('k3/manrisk/data', 'k3\manriskController@apiData');
  Route::get('api/k3/manrisk/hapus/{id}', 'k3\manriskController@apiHapus');
  
  // Route::get('k3/manrisk/data', [manriskController::class, 'apiData']);

// SKL
  Route::get('kebidanan/skl/all/api','kebidanan\sklController@apiAll');

// ANTIGEN
  Route::get('antigen/all/api','lab\antigenController@apiShowAll')->name('antigen.apiall');  
  Route::get('antigen/api/get','lab\antigenController@apiGet')->name('antigen.apiget');  
  Route::post('antigen/api/ubah/{id}', 'lab\antigenController@ubah')->name('antigen.ubah');
  Route::get('antigen/api/getubah/{id}', 'lab\antigenController@getubah')->name('antigen.getubah');
  Route::get('antigen/api/hapus/{id}', 'lab\antigenController@hapus')->name('antigen.hapus');

});