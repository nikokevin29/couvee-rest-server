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
                'idpegawai'=>$data->getpegawai->nama,
                'tglpesan'=>$data->tglpesan,
                'alamat'=>$data->alamat,
                'notelp'=>$data->notelp,
                'tglcetak'=>$data->tglcetak,
                'status'=>$data->status,
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
        $data->alamat = $request->alamat;
        $data->notelp =$request->notelp;
        $data->status = $request->status;
        $data->save();
        $data->noPO = PemesananBarang::getNomorPOnoIncrement().$data->idpemesanan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idpemesanan){
        $idpegawai  = $request->idpegawai;
        $tglpesan = $request->tglpesan;
        $alamat = $request->alamat;
        $notelp = $request->notelp;
        $status = $request->status;

        $data = PemesananBarang::find($idpemesanan);
        $data->idpegawai = $idpegawai;
        $data->tglpesan = $tglpesan;
        $data->alamat = $alamat;
        $data->notelp = $notelp;
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
