<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Customer
Route::get('/customer/getbyid/{idcustomer}','CustomerController@getbyid');
Route::get('/customer/getbynama/{nama}','CustomerController@getbynama');
Route::get('customer','CustomerController@index');
Route::post('customer','CustomerController@create');
Route::put('/customer/{idcustomer}','CustomerController@update');
Route::delete('/customer/{idcustomer}','CustomerController@delete');

//Produk
Route::get('/produk/getbyid/{idproduk}','ProdukController@getbyid');
Route::get('/produk/getbynama/{idproduk}','ProdukController@getbynama');
Route::get('produk','ProdukController@index');
Route::post('produk','ProdukController@create');
Route::put('/produk/{idproduk}','ProdukController@update');
Route::delete('/produk/{idproduk}','ProdukController@delete');

//Hewan
Route::get('/hewan/getbyid/{idhewan}','HewanController@getbyid');
Route::get('/hewan/getbynama/{idhewan}','HewanController@getbynama');
Route::get('hewan','HewanController@index');
Route::post('hewan','HewanController@create');
Route::put('/hewan/{idhewan}','HewanController@update');
Route::delete('/hewan/{idhewan}','HewanController@delete');

//Jenis Hewan

Route::get('/jenis_hewan/search/','JenisHewanController@index');
Route::get('/jenis_hewan/search/{nama}','JenisHewanController@search');
Route::get('/jenis_hewan/getbyid/{idjenis}','JenisHewanController@getbyid');
Route::get('/jenis_hewan/getbynama/{nama}','JenisHewanController@getbynama');
Route::get('jenis_hewan','JenisHewanController@index');
Route::post('jenis_hewan','JenisHewanController@create');
Route::put('/jenis_hewan/{idjenis}','JenisHewanController@update');
Route::delete('/jenis_hewan/{idjenis}','JenisHewanController@delete');

//Ukuran Hewan
Route::get('/ukuran_hewan/getbyid/{idukuran}','UkuranHewanController@getbyid');
Route::get('/ukuran_hewan/getbynama/{idukuran}','UkuranHewanController@getbynama');
Route::get('ukuran_hewan','UkuranHewanController@index');
Route::post('ukuran_hewan','UkuranHewanController@create');
Route::put('/ukuran_hewan/{idukuran}','UkuranHewanController@update');
Route::delete('/ukuran_hewan/{idukuran}','UkuranHewanController@delete');

//Layanan
Route::get('/layanan/getbyid/{idlayanan}','LayananController@getbyid');
Route::get('/layanan/getbynama/{idlayanan}','LayananController@getbynama');
Route::get('layanan','LayananController@index');
Route::post('layanan','LayananController@create');
Route::put('/layanan/{idlayanan}','LayananController@update');
Route::delete('/layanan/{idlayanan}','LayananController@delete');

//Pegawai
Route::get('/pegawai/getbyid/{idpegawai}','PegawaiController@getbyid');
Route::get('/pegawai/getbynama/{idpegawai}','PegawaiController@getbynama');
Route::get('pegawai','PegawaiController@index');
Route::post('pegawai','PegawaiController@create');
Route::put('/pegawai/{idpegawai}','PegawaiController@update');
Route::delete('/pegawai/{idpegawai}','PegawaiController@delete');

//Supllier
Route::get('/supplier/getbyid/{idsupplier}','SupplierController@getbyid');
Route::get('/supplier/getbynama/{idsupplier}','SupplierController@getbynama');
Route::get('supplier','SupplierController@index');
Route::post('supplier','SupplierController@create');
Route::put('/supplier/{idsupplier}','SupplierController@update');
Route::delete('/supplier/{idsupplier}','SupplierController@delete');