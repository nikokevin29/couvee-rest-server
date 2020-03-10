<?php

namespace App\Http\Controllers;
use App\PemesananBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PemesananBarangController extends Controller
{
    public function index(){
        return PemesananBarang::all();
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
        $data->idpegawai = "0";
        $data->tglpesan =$request->tglpesan;
        $data->alamat = $request->alamat;
        $data->notelp =$request->notelp;
        $data->status = $request->status;
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
        $data->idpegawai = "0";
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
