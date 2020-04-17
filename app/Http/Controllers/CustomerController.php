<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{
    public function search($nama)
    {
      $data = Customer::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'customer' => $data
      ]);
    }
    public function index(){
        $datas = Customer::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idcustomer'=>$data->idcustomer,
                'nama'=>$data->nama,
                'notelp'=>$data->notelp,
                'alamat'=>$data->alamat,
                'tgllahir'=>$data->tgllahir,
                'created_at'=>$data->created_at,
                'updated_at'=>$data->updated_at,
                'deleted_at'=>$data->deleted_at,
                'aksi'=>$data->aksi,
                'aktor'=>$data->getAktor->nama,
                ]);
        }   
        return $getAll;
    }
    public function getbyid($idcustomer)
    {
        $data = Customer::find($idcustomer);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function getbynama($nama)
    {
        $data = Customer::where('nama', $nama)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
        }
    public function create(request $request){
        $data = new Customer;
        $data->nama = $request->nama;
        $data->notelp = $request->notelp;
        $data->alamat = $request->alamat;
        $data->notelp = $request->notelp;
        $data->tgllahir = $request->tgllahir;

        $data->aktor = $request->aktor;
        $data->aksi = "Tambah";
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idcustomer){
        $nama  = $request->nama;
        $notelp = $request->notelp;
        $alamat = $request->alamat;
        $tgllahir = $request->tgllahir;
        $aksi = $request->aksi;
        $aktor = $request->aktor;

        $data = Customer::find($idcustomer);
        $data->nama = $nama;
        $data->notelp = $notelp;
        $data->alamat = $alamat;
        $data->tgllahir = $tgllahir;
        
        $data->aktor =$aktor;
        $data->aksi = "Edit";
        $data->save();

        return "Data di Update";
    }

    public function delete($idcustomer){
        
        $data = Customer::find($idcustomer);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
