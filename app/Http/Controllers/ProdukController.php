<?php

namespace App\Http\Controllers;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProdukController extends Controller
{
    public function search($nama)
    {
      $data = Produk::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'produk' => $data
      ]);
    }
    public function index(){
        return Produk::all();
    }
    public function getbyid($idproduk)
    {
        $data = Produk::find($idproduk);
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function getbynama($nama)
    {
        $data = Produk::where('nama', $nama)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function create(request $request){
        $data = new Produk;
        $data->nama = $request->nama;
        $data->harga = $request->harga;
        $data->stok = $request->stok;
        $data->stokminimum = $request->stokminimum;
        $data->gambar = $request->gambar;
        $data->aksi = "Tambah";
        $data->aktor = "0";
        $data->idsupplier = "0";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idproduk){
        $nama  = $request->nama;
        $harga = $request->harga;
        $stok = $request->stok;
        $stokminimum = $request->stokminimum;
        $gambar = $request->gambar;
        $aksi = $request->aksi;
        $aktor = $request->aktor;

        $data = Produk::find($idproduk);
        $data->nama = $nama;
        $data->harga = $harga;
        $data->stok = $stok;
        $data->stokminimum = $stokminimum;
        $data->gambar = $gambar;
        $data->aksi = "Edit";
        $data->aktor = "0";
        $data->idsupplier = "0";
        $data->save();

        return "Data di Update";
    }

    public function delete($idproduk){
        $data = Produk::find($idproduk);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
