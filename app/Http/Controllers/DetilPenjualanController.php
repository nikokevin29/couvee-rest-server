<?php

namespace App\Http\Controllers;
use App\DetilPenjualan;
use App\TransaksiPenjualan;
use App\Produk;
use App\Events\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetilPenjualanController extends Controller
{
    public function index(){
        $datas = DetilPenjualan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'iddetilpenjualan '=>$data->iddetilpenjualan,
                'idproduk'=>$data->getproduk->nama,
                'jumlah'=>$data->jumlah,
                'subtotal'=>$data->subtotal,
                'idtransaksipenjualan'=>$data->idtransaksipenjualan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($iddetilpenjualan)
    {
        $data = DetilPenjualan::find($iddetilpenjualan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function getlastid()
    {
        $data = TransaksiPenjualan::find(DB::table('transaksi_penjualan')->max('idtransaksipenjualan'));//get max id tabel transaksi
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $datas = new DetilPenjualan;
        $datas->idproduk = $request->idproduk;
        $datas->jumlah = $request->jumlah;
        $datas->subtotal = $request->subtotal;
        $datas->idtransaksipenjualan = $request->idtransaksipenjualan;
        $datas->save();
        Produk::where('idproduk', $datas->idproduk)->decrement('stok', $datas->jumlah);//Update Stock di tabel produk
        
        $stok =Produk::where('idproduk',$datas->idproduk)->first()->stok;
        $stokminimum =Produk::where('idproduk',$datas->idproduk)->first()->stokminimum;
        if($stok <= $stokminimum){
            event(new PushNotification('Test'));
        }
        return "Data Masuk";
    }
    public function update(request $request, $iddetilpenjualan){
        $idproduk  = $request->idproduk;
        $jumlah = $request->jumlah;
        $subtotal = $request->subtotal;

        $data = DetilPenjualan::find($iddetilpenjualan);
        $data->idproduk = $idproduk;
        $data->jumlah = $jumlah;
        $data->subtotal = $subtotal;
        $data->save();

        return "Data di Update";
    }
    public function delete($iddetilpenjualan){
        
        $data = DetilPenjualan::find($iddetilpenjualan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
