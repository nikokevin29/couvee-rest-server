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
Route::get('/customer/search/','CustomerController@index');
Route::get('/customer/search/{nama}','CustomerController@search');
Route::get('/customer/getbyid/{idcustomer}','CustomerController@getbyid');
Route::get('/customer/getbynama/{nama}','CustomerController@getbynama');
Route::get('customer','CustomerController@index');
Route::post('customer','CustomerController@create');
Route::put('/customer/{idcustomer}','CustomerController@update');
Route::delete('/customer/{idcustomer}','CustomerController@delete');

//Produk

Route::get('/produk/search/','ProdukController@index');
Route::get('/produk/search/{nama}','ProdukController@search');
Route::get('/produk/getbyid/{idproduk}','ProdukController@getbyid');
Route::get('/produk/getbynama/{idproduk}','ProdukController@getbynama');
Route::get('produk','ProdukController@index');
Route::post('produk','ProdukController@create');
Route::put('/produk/{idproduk}','ProdukController@update');
Route::delete('/produk/{idproduk}','ProdukController@delete');

//Hewan
Route::get('/hewan/search/','HewanController@index');
Route::get('/hewan/search/{nama}','HewanController@search');
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
Route::get('/ukuran_hewan/search/','UkuranHewanController@index');
Route::get('/ukuran_hewan/search/{nama}','UkuranHewanController@search');
Route::get('/ukuran_hewan/getbyid/{idukuran}','UkuranHewanController@getbyid');
Route::get('/ukuran_hewan/getbynama/{idukuran}','UkuranHewanController@getbynama');
Route::get('ukuran_hewan','UkuranHewanController@index');
Route::post('ukuran_hewan','UkuranHewanController@create');
Route::put('/ukuran_hewan/{idukuran}','UkuranHewanController@update');
Route::delete('/ukuran_hewan/{idukuran}','UkuranHewanController@delete');

//Layanan
Route::get('/layanan/search/','LayananController@index');
Route::get('/layanan/search/{nama}','LayananController@search');
Route::get('/layanan/getbyid/{idlayanan}','LayananController@getbyid');
Route::get('/layanan/getbynama/{idlayanan}','LayananController@getbynama');
Route::get('layanan','LayananController@index');
Route::post('layanan','LayananController@create');
Route::put('/layanan/{idlayanan}','LayananController@update');
Route::delete('/layanan/{idlayanan}','LayananController@delete');

//Pegawai
Route::get('/pegawai/search/','PegawaiController@index');
Route::get('/pegawai/search/{nama}','PegawaiController@search');
Route::get('/pegawai/getbyid/{idpegawai}','PegawaiController@getbyid');
Route::get('/pegawai/getbynama/{idpegawai}','PegawaiController@getbynama');
Route::get('pegawai','PegawaiController@index');
Route::post('pegawai','PegawaiController@create');
Route::put('/pegawai/{idpegawai}','PegawaiController@update');
Route::delete('/pegawai/{idpegawai}','PegawaiController@delete');

//Supllier
Route::get('/supplier/search/','SupplierController@index');
Route::get('/supplier/search/{nama}','SupplierController@search');
Route::get('/supplier/getbyid/{idsupplier}','SupplierController@getbyid');
Route::get('/supplier/getbynama/{idsupplier}','SupplierController@getbynama');
Route::get('supplier','SupplierController@index');
Route::post('supplier','SupplierController@create');
Route::put('/supplier/{idsupplier}','SupplierController@update');
Route::delete('/supplier/{idsupplier}','SupplierController@delete');

//Detil Transaksi Pelayanan
Route::get('/detil_pelayanan/search/','DetilPelayananController@index');
Route::get('/detil_pelayanan/search/{nama}','DetilPelayananController@search');
Route::get('/detil_pelayanan/getbyid/{iddetilpelayanan}','DetilPelayananController@getbyid');
Route::get('/detil_pelayanan/getbynama/{iddetilpelayanan}','DetilPelayananController@getbynama');
Route::get('detil_pelayanan','DetilPelayananController@index');
Route::post('detil_pelayanan','DetilPelayananController@create');
Route::put('/detil_pelayanan/{iddetilpelayanan}','DetilPelayananController@update');
Route::delete('/detil_pelayanan/{iddetilpelayanan}','DetilPelayananController@delete');

//Detil Transaksi Penjualan
Route::get('/detil_penjualan/search/','DetilPenjualanController@index');
Route::get('/detil_penjualan/search/{nama}','DetilPenjualanController@search');
Route::get('/detil_penjualan/getbyid/{iddetilpenjualan}','DetilPenjualanController@getbyid');
Route::get('/detil_penjualan/getbynama/{iddetilpenjualan}','DetilPenjualanController@getbynama');
Route::get('detil_penjualan','DetilPenjualanController@index');
Route::post('detil_penjualan','DetilPenjualanController@create');
Route::put('/detil_penjualan/{iddetilpenjualan}','DetilPenjualanController@update');
Route::delete('/detil_penjualan/{iddetilpenjualan}','DetilPenjualanController@delete');


//Detil Transaksi Pemesanan
Route::get('/detil_pemesanan/search/','DetilPemesananController@index');
Route::get('/detil_pemesanan/search/{nama}','DetilPemesananController@search');
Route::get('/detil_pemesanan/getbyid/{iddetilpemesanan}','DetilPemesananController@getbyid');
Route::get('/detil_pemesanan/getbynama/{iddetilpemesanan}','DetilPemesananController@getbynama');
Route::get('detil_pemesanan','DetilPemesananController@index');
Route::post('detil_pemesanan','DetilPemesananController@create');
Route::put('/detil_pemesanan/{iddetilpemesanan}','DetilPemesananController@update');
Route::delete('/detil_pemesanan/{iddetilpemesanan}','DetilPemesananController@delete');

//Transaksi Pelayanan
Route::get('/transaksi_pelayanan/getbyid/{idtransaksipelayanan}','TransaksiPelayananController@getbyid');
Route::get('transaksi_pelayanan','TransaksiPelayananController@index');
Route::post('transaksi_pelayanan','TransaksiPelayananController@create');
Route::put('/transaksi_pelayanan/{idtransaksipelayanan}','TransaksiPelayananController@update');
Route::delete('/transaksi_pelayanan/{idtransaksipelayanan}','TransaksiPelayananController@delete');

//Transaksi Penjualan
Route::get('/transaksi_penjualan/getbyid/{idtransaksipenjualan}','TransaksiPenjualanController@getbyid');
Route::get('transaksi_penjualan','TransaksiPenjualanController@index');
Route::post('transaksi_penjualan','TransaksiPenjualanController@create');
Route::put('/transaksi_penjualan/{idtransaksipenjualan}','TransaksiPenjualanController@update');
Route::delete('/transaksi_penjualan/{idtransaksipenjualan}','TransaksiPenjualanController@delete');

//Pemesanan Barang
Route::get('/pemesanan_barang/getbyid/{idpemesanan}','PemesananBarangController@getbyid');
Route::get('pemesanan_barang','PemesananBarangController@index');
Route::post('pemesanan_barang','PemesananBarangController@create');
Route::put('/pemesanan_barang/{idpemesanan}','PemesananBarangController@update');
Route::delete('/pemesanan_barang/{idpemesanan}','PemesananBarangController@delete');