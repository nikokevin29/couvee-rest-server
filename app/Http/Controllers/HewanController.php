<?php

namespace App\Http\Controllers;
use App\Hewan;
use App\UkuranHewan;
use App\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HewanController extends Controller
{
    public function search($nama)
    {
      $data = Hewan::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'hewan' => $data
      ]);
    }
    public function index(){
        $datas = Hewan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idhewan'=>$data->idhewan,
                'nama'=>$data->nama,
                'tgllahir'=>$data->tgllahir,
                'jenis'=>$data->jenishewan->nama,
                'ukuran'=>$data->ukuranhewan->nama,
                'customer'=>$data->customer->nama,
                'created_at'=>$data->created_at,
                'updated_at'=>$data->updated_at,
                'deleted_at'=>$data->deleted_at,
                'aktor'=>$data->getAktor->nama,
                'aksi'=>$data->aksi,
                ]);
        }   
        return $getAll;
    }
    public function getbyid($idhewan)
    {
        $data = Hewan::find($idhewan);
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function getbynama($nama)
    {
        $data = Hewan::where('nama', $nama)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function create(request $request){
        $data = new Hewan;
        $data->nama = $request->nama;
        $data->tgllahir = $request->tgllahir;
        
        $data->idjenis = $request->idjenis;
        $data->idukuran = $request->idukuran;
        $data->idcustomer = $request->idcustomer;
        $data->aktor = $request->aktor;
        $data->aksi = "Tambah";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idhewan){
        $nama  = $request->nama;
        $tgllahir = $request->tgllahir;
        $idjenis = $request->idjenis;
        $idukuran = $request->idukuran;
        $aksi = $request->aksi;
        $aktor = $request->aktor;
        $idcustomer = $request->idcustomer;

        $data = Hewan::find($idhewan);
        $data->nama = $nama;
        $data->tgllahir = $tgllahir;

        $data->idjenis = $idjenis;
        $data->idukuran = $idukuran;
        $data->aksi = "Edit";
        $data->aktor = $aktor;
        $data->idcustomer = $idcustomer;
        $data->save();

        return "Data di Update";
    }

    public function delete(request $request,$idhewan){
        $data = Hewan::find($idhewan);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
