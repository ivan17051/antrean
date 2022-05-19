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


// Auth::routes();
// Route::middleware(['auth'])->group(function () {
//   Route::get('/home', 'HomeController@index')->name('home');
  
// });
  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/daftar', 'PendaftaranController@daftarOnline');
  Route::get('/daftaronsite', 'PendaftaranController@daftarOnSite');
  Route::get('/daftarbarcode', 'PendaftaranController@daftarBarcode');

  Route::get('/resume', 'ResumeController@resume');

  Route::get('/tvpoli', function(){ return view('tvpoli'); })->name('tvpoli');

  Route::get('/tvpoli2', function(){ return view('tvpoli2'); })->name('tvpoli2');

  Route::get('/admintvpoli', function(){ return view('admintvpoli'); })->name('admintvpoli');

  Route::get('/tv', function(){ return view('tv'); })->name('tv');

  Route::get('/tvutama', function(){ return view('tvutama'); })->name('tvutama');