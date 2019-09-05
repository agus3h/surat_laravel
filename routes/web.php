<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

 Route::group(['middleware'=>['auth','Role:admin']],function(){
// Route::resource('/kategori','KategoriController');
// Route::resource('/surat_masuk','SuratMasukController');
// Route::resource('/surat_keluar','SuratKeluarController');
Route::resource('/user','UserController');
});	
 
Route::group(['middleware'=>['auth','Role:pencatat,admin,pengolah']],function(){
Route::resource('/surat_masuk','SuratMasukController');
Route::resource('/surat_keluar','SuratKeluarController');

});	

Route::group(['middleware'=>['auth','Role:pengolah,admin']],function(){
// Route::resource('/surat_masuk','SuratMasukController');
// Route::resource('/surat_keluar','SuratKeluarController');
Route::resource('/kategori','KategoriController');
Route::get('/sm/excel','SuratMasukController@excel')->name('surat_masuk.excel');
Route::get('/sk/excel','SuratKeluarController@excel')->name('surat_keluar.excel');
Route::get('/surat_masuk/proses/{surat_masuk}','SuratMasukController@proses')->name('surat_masuk.proses');
Route::get('/surat_masuk/selesai/{surat_masuk}','SuratMasukController@selesai')->name('surat_masuk.selesai');
Route::get('/surat_keluar/proses/{surat_keluar}','SuratKeluarController@proses')->name('surat_keluar.proses');
Route::get('/surat_keluar/selesai/{surat_keluar}','SuratKeluarController@selesai')->name('surat_keluar.selesai');
});	


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
