<?php

namespace App\Http\Controllers;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class PegawaiController extends Controller
{
    public function auth(Request $request){
        $username = $request->username;
        $password = $request->password;
        $akun = DB::table('pegawai')->where('username', $username)->where('password', $password)->first();
        if ($akun!= null) {
            if($akun->role == "Owner"){
                return response()->json($akun, 200);
            }else if($akun->role == "CS"){
                return  response()->json($akun, 200);
            }else{
                return 'Bukan CS ataupun Owner';
            }
        }else{
            return response()->json($akun,400);
        }
    }
    public function search($nama)
    {
      $data = Pegawai::where('nama', 'like', "%{$nama}%")->get();
      return response()->json([
        'pegawai' => $data
      ]);
    }
    public function index(){
        $datas = Pegawai::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idpegawai'=>$data->idpegawai,
                'nama'=>$data->nama,
                'alamat'=>$data->alamat,
                'tgllahir'=>$data->tgllahir,
                'notelp'=>$data->notelp,
                'role'=>$data->role,
                'username'=>$data->username,
                'password'=>$data->password,
                'created_at'=>$data->created_at->format('Y-m-d H:i:s'),
                'updated_at'=>$data->updated_at->format('Y-m-d H:i:s'),
                'deleted_at'=>$data->deleted_at,
                'aktor'=>$data->getAktor->nama,
                'aksi'=>$data->aksi,
                ]);
        }   
        return $getAll;
    }
    public function getbyid($idpegawai)
    {
        $data = Pegawai::find($idpegawai);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
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
        $data->username = $request->username;
        $data->password = $request->password;
        $data->aktor = $request->aktor;
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
        $data->aksi = "Edit";
        $data->aktor = $aktor;
        $data->save();

        return "Data di Update";
    }

    public function delete($idpegawai){
        
        $data = Pegawai::find($idpegawai);
        $data->delete();
        return "Data Dihapus(Soft Delete)";
    }
}
