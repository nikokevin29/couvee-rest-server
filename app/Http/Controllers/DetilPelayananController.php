<?php
//by Nicholas Kevin
namespace App\Http\Controllers;
use App\DetilPelayanan;
use App\TransaksiPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DetilPelayananController extends Controller
{
    public function index(){
        $datas = DetilPelayanan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'iddetilpelayanan'=>$data->iddetilpelayanan,
                'idlayanan'=>$data->getlayanan->nama,
                'jumlah'=>$data->jumlah,
                'subtotal'=>$data->subtotal,
                'idtransaksipelayanan'=>$data->idtransaksipelayanan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($iddettilpelayanan)
    {
        $data = DetilPelayanan::find($iddettilpelayanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function getlastid()
    {
        $data = TransaksiPelayanan::find(DB::table('transaksi_pelayanan')->max('idtransaksipelayanan'));//get max id
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new DetilPelayanan;
        $data->idlayanan = $request->idlayanan;
        $data->jumlah = $request->jumlah;
        $data->subtotal = $request->subtotal;
        $data->idtransaksipelayanan = $request->idtransaksipelayanan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $iddettilpelayanan){
        $idlayanan  = $request->idlayanan;
        $jumlah = $request->jumlah;
        $subtotal = $request->subtotal;

        $data = DetilPelayanan::find($iddettilpelayanan);
        $data->idlayanan = $idlayanan;
        $data->jumlah = $jumlah;
        $data->subtotal = $subtotal;
        $data->save();

        return "Data di Update";
    }
    public function delete($iddettilpelayanan){
        
        $data = DetilPelayanan::find($iddettilpelayanan);
        $data->delete();
        return "Data Dihapus(Hard Delete)";
    }
}
