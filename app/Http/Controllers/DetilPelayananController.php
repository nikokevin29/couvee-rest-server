<?php

namespace App\Http\Controllers;
use App\DetilPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetilPelayananController extends Controller
{
    public function index(){
        return DetilPelayanan::all();
    }
    public function getbyid($iddettilpelayanan)
    {
        $data = DetilPelayanan::find($iddettilpelayanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);//->json();
        } else
            return response($data); //->json($data, 200);
    }
    public function create(request $request){
        $data = new DetilPelayanan;
        $data->idlayanan = $request->idlayanan;
        $data->jumlah = $request->jumlah;
        $data->subtotal = $request->subtotal;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $iddettilpelayanan){
        $idlayanan  = $request->idlayanan;
        $jumlah = $request->jumlah;
        $subtotal = $request->subtotal;

        $data = DetilPelayanan::find($iddettilpelayanan);
        $data->idlayanan = $idlayanan;
        $data->jumlah = $jumlah;
        $data->subtotal = $subtotal;
        $data->save();

        return "Data di Update";
    }
    public function delete($iddettilpelayanan){
        
        $data = DetilPelayanan::find($iddettilpelayanan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
