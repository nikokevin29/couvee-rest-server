<?php
//by Nicholas Kevin
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

        $datas = JenisHewan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idjenis'=>$data->idjenis,
                'nama'=>$data->nama,
                'created_at'=>$data->created_at->format('Y-m-d H:i:s'),
                'updated_at'=>$data->updated_at->format('Y-m-d H:i:s'),
                'deleted_at'=>$data->deleted_at,
                'aktor'=>$data->getAktor->nama,
                'aksi'=>$data->aksi,
                ]);
        }   
        return $getAll;
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

        $data->aktor = $request->aktor;
        $data->aksi = "Tambah";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idjenis){
        $nama  = $request->nama;
        $aksi = $request->aksi;
        $aktor = $request->aktor;

        $data = JenisHewan::find($idjenis);
        $data->nama = $nama;
        $data->aktor = $aktor;
        $data->aksi = "Edit";
        $data->save();

        return "Data di Update";
    }

    public function delete($idjenis){
        $data = JenisHewan::find($idjenis);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
