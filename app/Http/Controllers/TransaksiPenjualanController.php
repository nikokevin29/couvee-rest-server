<?php

namespace App\Http\Controllers;
use App\TransaksiPenjualan;
use App\DetilPenjualan;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiPenjualanController extends Controller
{
    public function index(){
        $datas = TransaksiPenjualan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idtransaksipenjualan'=>$data->idtransaksipenjualan,
                'noPR'=>$data->noPR,
                'tanggaltransaksi'=>$data->tanggaltransaksi,
                'idpegawai'=>$data->getpegawai->nama,
                'idhewan'=>$data->gethewan->nama,
                'idcustomer'=>$data->getcustomer->nama,
                'diskon'=>$data->diskon,
                'total'=>$data->total,
                'detil'=>$data->detil_penjualan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($idtransaksipenjualan)
    {
        $data = TransaksiPenjualan::find($idtransaksipenjualan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new TransaksiPenjualan;
        $data->noPR = "";
        $data->idpegawai = $request->idpegawai;
        $data->idcustomer = $request->idcustomer;
        $data->idhewan =$request->idhewan;
        $data->diskon = $request->diskon;
        $data->total = $request->total;
        $data->save();
        $data->noPR = TransaksiPenjualan::getNomorPRnoIncrement().$data->idtransaksipenjualan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idtransaksipenjualan){
        $diskon = $request->diskon;
        $total = $request->total;

        $data = TransaksiPenjualan::find($idtransaksipenjualan);
        $data->diskon = $diskon;
        $data->total = $total;
        $data->save();

        return "Edit Success";
    }

    public function delete($idtransaksipenjualan){
        DetilPenjualan::where('idtransaksipenjualan', $idtransaksipenjualan)->delete();//delete child di tabel detil
        TransaksiPenjualan::find($idtransaksipenjualan)->delete();
        return "Delete Success";
    }
    public function cetak_struk($idtransaksipenjualan)
    {
    	$header = TransaksiPenjualan::where('idtransaksipenjualan','=',$idtransaksipenjualan)->find($idtransaksipenjualan);
        $detil = DetilPenjualan::where('idtransaksipenjualan','=',$idtransaksipenjualan)->get();

        $sum = 0;
        foreach($detil as $d){
            $sum += $d->subtotal;
        }
        return PDF::loadview('struk_penjualan',compact('header','detil','sum'))->stream();
        
    }
}
