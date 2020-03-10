<?php

namespace App\Http\Controllers;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PegawaiController extends Controller
{
    public function search($nama)
    {
      $data = Pegawai::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'pegawai' => $data
      ]);
    }
    public function index(){
        return Pegawai::all();
    }
    public function getbyid($idpegawai)
    {
        $data = Pegawai::find($idpegawai);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);//->json();
        } else
            return response($data); //->json($data, 200);
    }
    public function getbyusername($username)
    {
        $data = Pegawai::where('username', $username)->get();
        if (is_null($data)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($data, 200);
    }
    public function create(request $request){
        $data = new Pegawai;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->tgllahir = $request->tgllahir;
        $data->notelp = $request->notelp;
        $data->role = $request->role;
        $data->aksi = "Tambah";
        $data->aktor = "0";
        $data->username = $request->username;
        $data->password = $request->password;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idpegawai){
        $nama  = $request->nama;
        $notelp = $request->notelp;
        $alamat = $request->alamat;
        $tgllahir = $request->tgllahir;
        $notelp = $request->notelp;
        $role = $request->role;
        $aksi = $request->aksi;
        $aktor = $request->aktor;
        $username = $request->username;
        $password = $request->password;

        $data = Pegawai::find($idpegawai);
        $data->nama = $nama;
        $data->notelp = $notelp;
        $data->alamat = $alamat;
        $data->tgllahir = $tgllahir;
        $data->notelp = $notelp;
        $data->role = $role;
        $data->aksi = "EDIT";
        $data->aktor = "0";
        $data->username = $request->username;
        $data->password = $request->password;
        $data->save();

        return "Data di Update";
    }

    public function delete($idpegawai){
        
        $data = Pegawai::find($idpegawai);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
