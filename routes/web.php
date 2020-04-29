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

Route::get('/', function () {
    return view('welcome');
});

Route::get('transaksi_penjualan','TransaksiPenjualanController@index');
Route::get('/transaksi_penjualan/cetak_struk/{idtransaksipenjualan}','TransaksiPenjualanController@cetak_struk');

Route::get('transaksi_pelayanan','TransaksiPelayananController@index');
Route::get('/transaksi_pelayanan/cetak_struk/{idtransaksipelayanan}','TransaksiPelayananController@cetak_struk');

Route::get('pemesanan_barang','PemesananBarangController@index');
Route::get('/pemesanan_barang/cetak_struk/{idpemesanan}','PemesananBarangController@cetak_struk');