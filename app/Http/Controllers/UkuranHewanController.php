<?php

namespace App\Http\Controllers;
use App\UkuranHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UkuranHewanController extends Controller
{
    public function search($nama)
    {
      $data = UkuranHewan::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'ukuran_hewan' => $data
      ]);
    }
    public function index(){
        $datas = UkuranHewan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idukuran'=>$data->idukuran,
                'nama'=>$data->nama,
                'created_at'=>$data->created_at,
                'updated_at'=>$data->updated_at,
                'deleted_at'=>$data->deleted_at,
                'aktor'=>$data->getAktor->nama,
                'aksi'=>$data->aksi,
                ]);
        }   
        return $getAll;
    }
    public function getbyid($idukuran)
    {
        $data = UkuranHewan::find($idukuran);
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function getbynama($nama)
    {
        $data = UkuranHewan::where('nama', $nama)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function create(request $request){
        $data = new UkuranHewan;
        $data->nama = $request->nama;
        $data->aksi = "Tambah";
        $data->aktor = $request->aktor;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idukuran){
        $nama  = $request->nama;
        $aksi = $request->aksi;
        $aktor =$request->aktor;


        $data = UkuranHewan::find($idukuran);
        $data->nama = $nama;
        $data->aksi = "Edit";
        $data->aktor = $aktor;
        $data->save();

        return "Data di Update";
    }

    public function delete($idukuran){
        $data = UkuranHewan::find($idukuran);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
