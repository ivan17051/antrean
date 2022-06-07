<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//API route
// Route::post('getnomor2', ['uses' => 'API\Antrian@getNomor', 'as' => 'api.getnomor']);
// Route::post('getlistpasien2', ['uses' => 'API\Antrian@getListPasien', 'as' => 'api.getlistpasien']);
Route::post('getantrianpoli2', ['uses' => 'API\Antrian@getantrianpoli', 'as' => 'api.getantrianpoli']);
Route::post('layaniantrian2', ['uses' => 'API\Antrian@layaniantrian', 'as' => 'api.layaniantrian']);
Route::post('layanikembali2', ['uses' => 'API\Antrian@layanikembali', 'as' => 'api.layanikembali']);
Route::post('gotofarmasilab2', ['uses' => 'API\Antrian@goToFarmasiLab', 'as' => 'api.gotofarmasilab']);
Route::post('gotopolirujukan2', ['uses' => 'API\Antrian@goToPoliRujukan', 'as' => 'api.gotopolirujukan']);