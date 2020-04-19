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
        $datas = Layanan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idlayanan'=>$data->idlayanan,
                'nama'=>$data->nama,
                'harga'=>$data->harga,
                'created_at'=>$data->created_at->format('Y-m-d H:i:s'),
                'updated_at'=>$data->updated_at->format('Y-m-d H:i:s'),
                'deleted_at'=>$data->deleted_at,
                'aktor'=>$data->getAktor->nama,
                'aksi'=>$data->aksi,
                ]);
        }   
        return $getAll;
        
    }
    public function getbyid($idlayanan)
    {
        $data = Layanan::find($idlayanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
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

        $data->aktor = $request->aktor;
        $data->aksi = "Tambah";
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

        $data->aktor = $aktor;
        $data->aksi = "Edit";
        $data->save();

        return "Data di Update";
    }

    public function delete($idlayanan){
        
        $data = Layanan::find($idlayanan);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
