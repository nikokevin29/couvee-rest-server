<?php

namespace App\Http\Controllers;
use App\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LayananController extends Controller
{
    public function search($nama)
    {
      $data = Layanan::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'layanan' => $data
      ]);
    }
    public function index(){
        return Layanan::all();
    }
    public function getbyid($idlayanan)
    {
        $data = Layanan::find($idlayanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);//->json();
        } else
            return response($data); //->json($data, 200);
    }
    public function getbynama($nama)
    {
        $data = Layanan::where('nama', $nama)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function create(request $request){
        $data = new Layanan;
        $data->nama = $request->nama;
        $data->harga = $request->harga;
        $data->aksi = "Tambah";
        $data->aktor = "0";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idlayanan){
        $nama  = $request->nama;
        $harga = $request->harga;
        $aksi = $request->aksi;
        $aktor = $request->aktor;

        $data = Layanan::find($idlayanan);
        $data->nama = $nama;
        $data->harga = $harga;
        $data->aksi = "EDIT";
        $data->aktor = "0";
        $data->save();

        return "Data di Update";
    }

    public function delete($idlayanan){
        
        $data = Layanan::find($idlayanan);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
