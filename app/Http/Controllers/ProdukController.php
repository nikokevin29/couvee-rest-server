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
        $datas = Produk::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idproduk'=>$data->idproduk,
                'nama'=>$data->nama,
                'harga'=>$data->harga,
                'stok'=>$data->stok,
                'stokminimum'=>$data->stokminimum,
                'gambar'=>$data->gambar,
                'created_at'=>$data->created_at->format('Y-m-d H:i:s'),
                'updated_at'=>$data->updated_at->format('Y-m-d H:i:s'),
                'deleted_at'=>$data->deleted_at,
                'aktor'=>$data->getAktor->nama,
                'aksi'=>$data->aksi,
                'idsupplier'=>$data->getSupplier->nama,
                ]);
        }   
        return $getAll;
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
        $data->aksi = "Tambah";
        $data->aktor= $request->aktor;
        $data->idsupplier =$request->idsupplier;

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $extension =$file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/produk/',$filename);
            $data->gambar = $filename;
        }else{
            return "gambar ngga masuk";
            $data->gambar = " ";
        }

        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idproduk){
        $nama  = $request->nama;
        $harga = $request->harga;
        $stok = $request->stok;
        $stokminimum = $request->stokminimum;
        $aksi = $request->aksi;
        $aktor = $request->aktor;
        $idsupplier = $request->idsupplier;

        $data = Produk::find($idproduk);
        $data->nama = $nama;
        $data->harga = $harga;
        $data->stok = $stok;
        $data->stokminimum = $stokminimum;
        $data->aksi = "Edit";
        $data->aktor = $aktor;
        $data->idsupplier = $idsupplier;
        $data->save();

        return "Data di Update";
    }

    public function delete($idproduk){
        $data = Produk::find($idproduk);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
