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
        return Customer::all();
    }
    public function getbyid($idcustomer)
    {
        $data = Customer::find($idcustomer);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);//->json();
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
        $data->aksi = "Tambah";
        $data->aktor = "0";
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
        $data->aksi = "EDIT";
        $data->aktor = "0";
        $data->save();

        return "Data di Update";
    }

    public function delete($idcustomer){
        
        $data = Customer::find($idcustomer);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
        // public function update(request $request, $idcustomer){
    //     $data = Customer::where('idcustomer', $idcustomer)->first();

    //     if (is_null($data)) {
    //         return response()->json('User not found', 404);
    //     }
    //     else {
    //     $data->nama  = $request->nama;
    //     $data->notelp = $request->notelp;
    //     $data->alamat = $request->alamat;
    //     $data->tgllahir = $request->tgllahir;
    //     $data->aksi = "UPDATES";
    //     $data->aktor = "0";
    //         $success = $data->save();

    //         if (!$success) {
    //             return response()->json('Error Updating', 500);
    //         } else {
    //             return response()->json('Success Updating', 200);
    //         }
    //     }
    // }
}
