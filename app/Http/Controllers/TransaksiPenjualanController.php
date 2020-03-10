<?php

namespace App\Http\Controllers;
use App\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiPenjualanController extends Controller
{
    public function index(){
        return TransaksiPenjualan::all();
    }
    public function getbyid($idtransaksipenjualan)
    {
        $data = TransaksiPenjualan::find($idtransaksipenjualan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new TransaksiPenjualan;
        $data->idpegawai = "0";
        $data->idhewan = "0";
        $data->diskon = $request->diskon;
        $data->idproduk ="0";
        $data->total = $request->total;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idtransaksipenjualan){
        $idpegawai  = $request->idpegawai;
        $idhewan = $request->idhewan;
        $status = $request->status;
        $diskon = $request->diskon;
        $idproduk = $request->idproduk;
        $total = $request->total;

        $data = TransaksiPenjualan::find($idtransaksipenjualan);
        $data->idpegawai = "0";
        $data->idhewan = "0";
        $data->status = $status;
        $data->diskon = $diskon;
        $data->idproduk = "0";
        $data->total = $total;
        $data->save();

        return "Data di Update";
    }

    public function delete($idtransaksipenjualan){
        
        $data = TransaksiPenjualan::find($idtransaksipenjualan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
