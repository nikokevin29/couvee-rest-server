<?php

namespace App\Http\Controllers;
use App\DetilPemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetilPemesananController extends Controller
{
    public function index(){
        return DetilPemesanan::all();
    }
    public function getbyid($iddetilpemesanan)
    {
        $data = DetilPemesanan::find($iddetilpemesanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);//->json();
        } else
            return response($data); //->json($data, 200);
    }
    public function create(request $request){
        $data = new DetilPemesanan;
        $data->idproduk = $request->idproduk;
        $data->jumlah = $request->jumlah;
        $data->satuan = $request->satuan;
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
