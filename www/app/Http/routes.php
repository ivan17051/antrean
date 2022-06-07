<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
Route::get('login', ['uses' => 'UserController@index', 'as' => 'login']);
// Route::post('login', ['uses' => 'UserController@doLogin', 'as' => 'login']);
// Route::get('/', 'Home@index');
Route::get('getunitkerja', ['uses' => 'Home@getData', 'as' => 'get-data']);

// Route::get('lihat/{id}', ['uses' => 'Lihat@index', 'as' => 'lihat']);
// Route::get('getlistpoli/{tipe}/{id}', ['uses' => 'Antrian@getPoliUtama', 'as' => 'get-poliutama']);
// Route::get('getnomor/{id}', ['uses' => 'Antrian@getNomor', 'as' => 'get-nomor']);
Route::get('/', function(){
	return redirect(url('/login'));
});
Route::group(['prefix'=>'{idunitkerja}', 'middleware'=>'customize.parameter'], function(){
// Route::group(['middleware' => ['auth']], function () {
	Route::get('logout', ['uses' => 'UserController@logout', 'as' => 'logout']);
	Route::get('/', ['uses' => 'Admin@index']);

	//TV
	// Route::get('lihat/{id}', ['uses' => 'Lihat@index', 'as' => 'lihat']);
	Route::get('tv', ['uses' => 'TV@index', 'as' => 'tv']);
	Route::get('tvpoli', ['uses' => 'TVPoli@index', 'as' => 'tvpoli']);
	Route::get('getlistpoli', ['uses' => 'Antrian@getListPoli', 'as' => 'getlistpoli']);
	Route::get('getnomor', ['uses' => 'Antrian@getNomor', 'as' => 'get-nomor']);
	Route::get('getnomorlocal', ['uses' => 'Antrian@getNomorLocal', 'as' => 'get-nomor-local']);

	Route::get('poli', ['uses' => 'Poli@index']);
	Route::get('poli2', ['uses' => 'Poli@index2']);
	Route::get('poli3', ['uses' => 'Poli@index3']);
	Route::get('lab', ['uses' => 'Poli@lab']);
	Route::get('farmasi', ['uses' => 'Poli@farmasi']);

	Route::post('layaniantrian', ['uses' => 'Antrian@layaniantrian', 'as' => 'layaniantrian']);
	Route::post('layanikembali', ['uses' => 'Antrian@layanikembali', 'as' => 'layanikembali']);
	Route::post('gotofarmasilab', ['uses' => 'Antrian@goToFarmasiLab', 'as' => 'gotofarmasilab']);
	Route::post('gotopolirujukan', ['uses' => 'Antrian@goToPoliRujukan', 'as' => 'gotopolirujukan']);

	Route::get('setpoli', ['uses' => 'Setpoli@index']);
	Route::get('getpoliunit', ['uses' => 'Setpoli@getPoliUnit', 'as' => 'getpoliunit']);
	Route::get('getdetailpoliunit', ['uses' => 'Setpoli@getDetail', 'as' => 'getdetailpoliunit']);
	Route::post('ssetpoli', ['uses' => 'Setpoli@simpan', 'as' => 'ssetpoli']);

	Route::get('loket', ['uses' => 'Loket@index']);
	Route::get('loket2', ['uses' => 'Loket@index2']);
	Route::post('loket2/{noid?}', ['uses' => 'Loket@update', 'as' => 'antrian.hadir']);

	Route::get('kasir', ['uses' => 'Kasir@index']);
	Route::get('aplab', ['uses' => 'Aplab@index']);

	Route::post('addhistory/{tipe}', ['uses' => 'Antrian@addhistory', 'as' => 'addhistory']);
	Route::post('getriwayat', ['uses' => 'Antrian@getriwayat', 'as' => 'getriwayat']);

	Route::get('getrekappoli', ['uses' => 'Antrian@getrekappoli', 'as' => 'getrekappoli']);

	Route::get('getpanggilanantrian', ['uses' => 'Antrian@getPanggilanAntrian', 'as' => 'getpanggilanantrian']);
	Route::post('addantriansuara', ['uses' => 'Antrian@addAntrianSuara', 'as' => 'addantriansuara']);
	Route::get('deletepanggilanantrian/{id}', ['uses' => 'Antrian@deletePanggilanAntrian', 'as' => 'deletepanggilanantrian']);
	Route::get('getdataunitkerja', ['uses' => 'Antrian@getDataUnitkerja', 'as' => 'getdataunitkerja']);

	//stream
	Route::get('tv2', ['uses' => 'TV@tvstream', 'as' => 'tvs']);
	Route::get('tvn', ['uses' => 'TV@tvnonpanggilan', 'as' => 'tvn']);
	Route::get('getnomorstream', ['uses' => 'AntrianStream@getNomor', 'as' => 'getnomors']);
	Route::get('getnomorstreamlocal', ['uses' => 'AntrianStream@getNomorLocal', 'as' => 'getnomorslocal']);	
	Route::get('getpanggilanantrianstream', ['uses' => 'AntrianStream@getPanggilanAntrian', 'as' => 'getpanggilanantrians']);
	
	//dokter
	Route::get('dokter', ['uses' => 'Dokter@index', 'as' => 'dokter']);
	Route::get('dokter/show', ['uses' => 'Dokter@show', 'as' => 'dokter.show']);
	Route::post('dokter/{noid?}', ['uses' => 'Dokter@storeUpdate', 'as' => 'dokter.storeupdate']);
	
	Route::get('getdokter', ['uses' => 'Antrian@getDokter', 'as' => 'get-dokter']);
	Route::get('getlistpasien', ['uses' => 'Antrian@getListPasien', 'as' => 'get-pasien']);
	Route::get('getlistpasienlocal', ['uses' => 'Antrian@getListPasienLocal', 'as' => 'get-pasien-local']);
	Route::get('tvpoli2', ['uses' => 'TVPoli@index2', 'as' => 'tvpoli2']);
	Route::get('tvpoli3', ['uses' => 'TVPoli@index3', 'as' => 'tvpoli3']);
	Route::get('tvpoli4', ['uses' => 'TVPoli@index4', 'as' => 'tvpoli4']);
	Route::get('tvpoli5', ['uses' => 'TVPoli@index5', 'as' => 'tvpoli5']);
	
	Route::get('tvloket', ['uses' => 'TV@tvloket', 'as' => 'tvloket']);
	Route::get('tvloket2', ['uses' => 'TV@tvloket2', 'as' => 'tvloket2']);
	Route::get('tvloket3', ['uses' => 'TV@tvloket3', 'as' => 'tvloket3']);
	Route::get('tvloket4', ['uses' => 'TV@tvloket4', 'as' => 'tvloket4']);

	Route::get('detail/{id}/{idbppoli}', ['uses' => 'Detail@index', 'as' => 'detail']);
	Route::get('getdatapoli/{idbppoli}', ['uses' => 'Antrian@getDataPoli', 'as' => 'getdatapoli']);
	Route::get('getpasienpoli', ['uses' => 'Antrian@getPasienPoli', 'as' => 'getpasienpoli']);
});

Route::get('puskesmas', ['uses' => 'Antrianx@index', 'as' => 'antreanpuskesmas']);
Route::post('antreanpuskesmas', ['uses' => 'Antrianx@getNomor', 'as' => 'antreanpuskesmas']);

