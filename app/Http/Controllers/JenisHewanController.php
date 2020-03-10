<?php

namespace App\Http\Controllers;
use App\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class JenisHewanController extends Controller
{
    public function search($nama)
    {
      $data = JenisHewan::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'jenis_hewan' => $data
      ]);
    }
    public function index(){    
        return JenisHewan::all();
    }
    public function getbyid($idjenis)
    {
        $data = JenisHewan::find($idjenis);
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function getbynama($nama)
    {
        $data = JenisHewan::where('nama', $nama)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function create(request $request){
        $data = new JenisHewan;
        $data->nama = $request->nama;
        $data->aksi = "Tambah";
        $data->aktor = "0";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idjenis){
        $nama  = $request->nama;
        $aksi = $request->aksi;
        $aktor = $request->aktor;

        $data = JenisHewan::find($idjenis);
        $data->nama = $nama;
        $data->aksi = "Edit";
        $data->aktor = "0";
        $data->save();

        return "Data di Update";
    }

    public function delete($idjenis){
        $data = JenisHewan::find($idjenis);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
