<?php

namespace App\Http\Controllers;
use App\TransaksiPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiPelayananController extends Controller
{
    public function index(){
        $datas = TransaksiPelayanan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idtransaksipelayanan'=>$data->idtransaksipelayanan,
                'noLY'=>$data->noLY,
                'idpegawai'=>$data->getpegawai->nama,
                'idhewan'=>$data->gethewan->nama,
                'status'=>$data->status,
                'diskon'=>$data->diskon,
                'total'=>$data->total,
                ]);
        }
        return $getAll;
    }
    public function getbyid($idtransaksipelayanan)
    {
        $data = TransaksiPelayanan::find($idtransaksipelayanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new TransaksiPelayanan;
        $data->noLY = "";
        $data->idpegawai = $request->idpegawai;
        $data->idhewan = $request->idhewan;
        $data->status = $request->status;
        $data->diskon = $request->diskon;
        $data->total = $request->total;
        $data->save();
        $data->noLY = TransaksiPelayanan::getNomorLYnoIncrement().$data->idtransaksipelayanan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idtransaksipelayanan){
        $idpegawai  = $request->idpegawai;
        $idhewan = $request->idhewan;
        $status = $request->status;
        $diskon = $request->diskon;
        $total = $request->total;

        $data = TransaksiPelayanan::find($idtransaksipelayanan);
        $data->idpegawai = $idpegawai;
        $data->idhewan = $idhewan;
        $data->status = $status;
        $data->diskon = $diskon;
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
