<?php

namespace App\Http\Controllers;
use App\Hewan;
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
        return Hewan::all();
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
        $data->idjenis = "0";
        $data->idukuran = "0";
        $data->aksi = "Tambah";
        $data->aktor = "0";
        $data->idcustomer = "0";
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
        $data->idjenis = "0";
        $data->idukuran = "0";
        $data->aksi = "Edit";
        $data->aktor = "0";
        $data->idcustomer = "0";
        $data->save();

        return "Data di Update";
    }

    public function delete($idhewan){
        $data = Hewan::find($idhewan);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
