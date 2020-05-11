<?php
//by Nicholas Kevin
namespace App\Http\Controllers;
use App\DetilPenjualan;
use App\TransaksiPenjualan;
use App\Produk;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetilPenjualanController extends Controller
{
    public function index(){
        $datas = DetilPenjualan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'iddetilpenjualan '=>$data->iddetilpenjualan,
                'idproduk'=>$data->getproduk->nama,
                'jumlah'=>$data->jumlah,
                'subtotal'=>$data->subtotal,
                'idtransaksipenjualan'=>$data->idtransaksipenjualan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($iddetilpenjualan)
    {
        $data = DetilPenjualan::find($iddetilpenjualan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function getlastid()
    {
        $data = TransaksiPenjualan::find(DB::table('transaksi_penjualan')->max('idtransaksipenjualan'));//get max id tabel transaksi
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $datas = new DetilPenjualan;
        $datas->idproduk = $request->idproduk;
        $datas->jumlah = $request->jumlah;
        $datas->subtotal = $request->subtotal;
        $datas->idtransaksipenjualan = $request->idtransaksipenjualan;
        $datas->save();
        
        
        $getid = Pegawai::select('idpegawai')->where('role','=','Owner')->get();
        
        // fcm($getid)
        //     ->to() // $recipients must an array
        //     ->priority('high')  
        //     ->timeToLive(0)
        //     ->data([
        //         'title' => 'Stok Barang Menipis',
        //         'body' => 'Segera isi barang',
        //     ])->send();
        return "Data Masuk";
    }
    public function update(request $request, $iddetilpenjualan){
        $idproduk  = $request->idproduk;
        $jumlah = $request->jumlah;
        $subtotal = $request->subtotal;

        $data = DetilPenjualan::find($iddetilpenjualan);
        $data->idproduk = $idproduk;
        $data->jumlah = $jumlah;
        $data->subtotal = $subtotal;
        $data->save();

        return "Data di Update";
    }
    public function delete($iddetilpenjualan){
        
        $data = DetilPenjualan::find($iddetilpenjualan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
