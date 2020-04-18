<?php

namespace App\Http\Controllers;
use App\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiPenjualanController extends Controller
{
    public function index(){
        $datas = TransaksiPenjualan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idtransaksipenjualan'=>$data->idtransaksipenjualan,
                'noPR'=>$data->noPR,
                'idpegawai'=>$data->getpegawai->nama,
                'idhewan'=>$data->gethewan->nama,
                'diskon'=>$data->diskon,
                'total'=>$data->total,
                'detil'=>$data->detil_penjualan,
                ]);
        }
        return $getAll;
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
        $data->noPR = "";
        $data->idpegawai = $request->idpegawai;
        $data->idhewan =$request->idhewan;
        $data->diskon = $request->diskon;
        $data->total = $request->total;
        $data->save();
        $data->noPR = TransaksiPenjualan::getNomorPRnoIncrement().$data->idtransaksipenjualan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idtransaksipenjualan){
        $idpegawai  = $request->idpegawai;
        $idhewan = $request->idhewan;
        $diskon = $request->diskon;
        $total = $request->total;

        $data = TransaksiPenjualan::find($idtransaksipenjualan);
        $data->idpegawai = $idpegawai;
        $data->idhewan = $idhewan;
        $data->diskon = $diskon;
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
