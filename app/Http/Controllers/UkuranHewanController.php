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
        return UkuranHewan::all();
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
        $data->aktor = "0";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idukuran){
        $nama  = $request->nama;
        $aksi = $request->aksi;
        $aktor = $request->aktor;

        $data = UkuranHewan::find($idukuran);
        $data->nama = $nama;
        $data->aksi = "Edit";
        $data->aktor = "0";
        $data->save();

        return "Data di Update";
    }

    public function delete($idukuran){
        $data = UkuranHewan::find($idukuran);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
