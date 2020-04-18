<?php

namespace App\Http\Controllers;
use App\PemesananBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PemesananBarangController extends Controller
{
    public function index(){
        $datas = PemesananBarang::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idpemesanan'=>$data->idpemesanan,
                'noPO'=>$data->noPO,
                'idsupplier'=>$data->getsupplier,
                'idpegawai'=>$data->getpegawai->nama,
                'tglpesan'=>$data->tglpesan,
                'tglcetak'=>$data->tglcetak,
                'status'=>$data->status,
                'detil'=>$data->detil_pemesanan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($idpemesanan)
    {
        $data = PemesananBarang::find($idpemesanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new PemesananBarang;
        $data->noPO = "";
        $data->idpegawai = $request->idpegawai;
        $data->tglpesan =$request->tglpesan;
        $data->status = $request->status;
        $data->idsupplier = $request->idsupplier;
        $data->save();
        $data->noPO = PemesananBarang::getNomorPOnoIncrement().$data->idpemesanan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idpemesanan){
        $idpegawai  = $request->idpegawai;
        $tglpesan = $request->tglpesan;
        $status = $request->status;

        $data = PemesananBarang::find($idpemesanan);
        $data->idpegawai = $idpegawai;
        $data->tglpesan = $tglpesan;
        $data->status = $status;
        $data->save();

        return "Data di Update";
    }

    public function delete($idpemesanan){
        
        $data = PemesananBarang::find($idpemesanan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
