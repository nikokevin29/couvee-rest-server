<?php

namespace App\Http\Controllers;

use App\Produk;
use App\DetilPemesanan;
use App\PemesananBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetilPemesananController extends Controller
{
    public function index(){
        $datas = DetilPemesanan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'iddetilpemesanan'=>$data->iddetilpemesanan,
                'idproduk'=>$data->getproduk->nama,
                'jumlah'=>$data->jumlah,
                'satuan'=>$data->satuan,
                'idpemesanan'=>$data->idpemesanan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($iddetilpemesanan)
    {
        $data = DetilPemesanan::find($iddetilpemesanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function getlastid()
    {
        $data = PemesananBarang::find(DB::table('pemesanan_barang')->max('idpemesanan'));//get max id
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new DetilPemesanan;
        $data->idproduk = $request->idproduk;
        $data->jumlah = $request->jumlah;
        $data->satuan = $request->satuan;
        $data->idpemesanan = $request->idpemesanan;
        $data->save();
        
        return "Data Masuk";
    }
    public function update(request $request, $iddetilpemesanan){
        $idproduk  = $request->idproduk;
        $jumlah = $request->jumlah;
        $satuan = $request->satuan;

        $data = DetilPemesanan::find($iddetilpemesanan);
        $data->idproduk = $idproduk;
        $data->jumlah = $jumlah;
        $data->satuan = $satuan;
        $data->save();

        return "Data di Update";
    }
    public function delete($iddetilpemesanan){
        
        $data = DetilPemesanan::find($iddetilpemesanan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
