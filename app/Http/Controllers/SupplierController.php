<?php
//by Nicholas Kevin
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
        $datas =  Supplier::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idsupplier'=>$data->idsupplier,
                'nama'=>$data->nama,
                'alamat'=>$data->alamat,
                'notelp'=>$data->notelp,
                'created_at'=>$data->created_at->format('Y-m-d H:i:s'),
                'updated_at'=>$data->updated_at->format('Y-m-d H:i:s'),
                'deleted_at'=>$data->deleted_at,
                'aktor'=>$data->getAktor->nama,
                'aksi'=>$data->aksi,
                ]);
        }   
        return $getAll;
        
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
        $data->aktor = $request->aktor;
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
        $data->aktor = $aktor;
        $data->save();

        return "Data di Update";
    }

    public function delete($idsupplier){
        $data = Supplier::find($idsupplier);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
