<?php

namespace App\Http\Controllers;
use App\DetilPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetilPenjualanController extends Controller
{
    public function index(){
        return DetilPenjualan::all();
    }
    public function getbyid($iddetilpenjualan)
    {
        $data = DetilPenjualan::find($iddetilpenjualan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);//->json();
        } else
            return response($data); //->json($data, 200);
    }
    public function create(request $request){
        $data = new DetilPenjualan;
        $data->idproduk = $request->idproduk;
        $data->jumlah = $request->jumlah;
        $data->subtotal = $request->subtotal;
        $data->save();
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
