<?php

namespace App\Http\Controllers;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SupplierController extends Controller
{
    public function search($nama)
    {
      $data = Supplier::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'supplier' => $data
      ]);
    }
    public function index(){    
        return Supplier::all();
    }
    public function getbyid($idsupplier)
    {
        $data = Supplier::find($idsupplier);
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function getbynama($nama)
    {
        $data = Supplier::where('nama', $nama)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function create(request $request){
        $data = new Supplier;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->notelp = $request->notelp;
        $data->aksi = "Tambah";
        $data->aktor = "0";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idsupplier){
        $nama  = $request->nama;
        $alamat  = $request->alamat;
        $notelp  = $request->notelp;
        $aksi = $request->aksi;
        $aktor = $request->aktor;

        $data = Supplier::find($idsupplier);
        $data->nama = $nama;
        $data->alamat = $alamat;
        $data->notelp = $notelp;
        $data->aksi = "Edit";
        $data->aktor = "0";
        $data->save();

        return "Data di Update";
    }

    public function delete($idsupplier){
        $data = Supplier::find($idsupplier);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
