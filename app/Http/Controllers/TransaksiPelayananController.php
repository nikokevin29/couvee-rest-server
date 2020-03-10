<?php

namespace App\Http\Controllers;
use App\TransaksiPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiPelayananController extends Controller
{
    public function index(){
        return TransaksiPelayanan::all();
    }
    public function getbyid($idtransaksipelayanan)
    {
        $data = TransaksiPelayanan::find($idtransaksipelayanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);//->json();
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new TransaksiPelayanan;
        $data->idpegawai = "0";
        $data->idhewan = "0";
        $data->status = $request->status;
        $data->diskon = $request->diskon;
        $data->idlayanan ="0";
        $data->total = $request->total;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idtransaksipelayanan){
        $idpegawai  = $request->idpegawai;
        $idhewan = $request->idhewan;
        $status = $request->status;
        $diskon = $request->diskon;
        $idlayanan = $request->idlayanan;
        $total = $request->total;

        $data = TransaksiPelayanan::find($idtransaksipelayanan);
        $data->idpegawai = "0";
        $data->idhewan = "0";
        $data->status = $status;
        $data->diskon = $diskon;
        $data->idlayanan = "0";
        $data->total = $total;
        $data->save();

        return "Data di Update";
    }

    public function delete($idtransaksipelayanan){
        
        $data = TransaksiPelayanan::find($idtransaksipelayanan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
