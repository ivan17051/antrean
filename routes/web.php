<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::middleware(['auth'])->group(function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/profile', 'ProfileController@index')->name('profile');

  Route::get('/daftar', 'PendaftaranController@daftarOnline');
  Route::get('/daftaronsite', 'PendaftaranController@daftarOnSite');
  Route::get('/daftarbarcode', 'PendaftaranController@daftarBarcode');

  Route::get('/resume', 'ResumeController@resume');

  Route::get('/tvpoli', function(){ return view('tvpoli'); })->name('tvpoli');

  Route::get('/tvpoli2', function(){ return view('tvpoli2'); })->name('tvpoli2');

  Route::get('/admintvpoli', function(){ return view('admintvpoli'); })->name('admintvpoli');

  Route::get('/admintvpoli2', function(){ return view('admintvpoli2'); })->name('admintvpoli2');

  Route::get('/tv', function(){ return view('tv'); })->name('tv');

  Route::get('/tvutama', function(){ return view('tvutama'); })->name('tvutama');

  Route::get('poli/getall', 'PoliController@getall')->name('poli.getall');

  Route::resource('poli', PoliController::class);

  Route::get('/tv', function(){ return view('tv'); })->name('tv');

  Route::get('/tvutama', function(){ return view('tvutama'); })->name('tvutama');

  //ANTRIAN AJAX REQUEST

  Route::get('getlistpoli', 'Antrian@getListPoli' )->name('getlistpoli');

  Route::get('getnomor', 'Antrian@getNomor')->name('get-nomor');

});


