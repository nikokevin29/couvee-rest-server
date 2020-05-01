<?php

namespace App\Http\Controllers;
use App\TransaksiPelayanan;
use App\DetilPelayanan;
use PDF;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiPelayananController extends Controller
{
    public function index(){
        $datas = TransaksiPelayanan::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idtransaksipelayanan'=>$data->idtransaksipelayanan,
                'noLY'=>$data->noLY,
                'tanggaltransaksi'=>$data->tanggaltransaksi,
                'idpegawai'=>$data->getpegawai->nama,
                'idhewan'=>$data->gethewan->nama,
                'idcustomer'=>$data->getcustomer->nama,
                'status'=>$data->status,
                'diskon'=>$data->diskon,
                'total'=>$data->total,
                'detil'=>$data->detil_pelayanan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($idtransaksipelayanan)
    {
        $data = TransaksiPelayanan::find($idtransaksipelayanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new TransaksiPelayanan;
        $data->noLY = "";
        $data->idpegawai = $request->idpegawai;
        $data->idhewan = $request->idhewan;
        $data->idcustomer = $request->idcustomer;
        $data->status = $request->status;
        $data->diskon = $request->diskon;
        $data->total = $request->total;
        $data->save();
        $data->noLY = TransaksiPelayanan::getNomorLYnoIncrement().$data->idtransaksipelayanan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request,$idtransaksipelayanan){
        $status = $request->status;
        $diskon = $request->diskon;
        $total = $request->total;
        $data = TransaksiPelayanan::find($idtransaksipelayanan);
        $data->status = $status;
        $data->diskon = $diskon;
        $data->total = $total;
        $data->save();
        
        //get notelp buat dikirim lewat Nexmo
        $getnotelp = DB::table('transaksi_pelayanan')
            ->join('customer', 'transaksi_pelayanan.idcustomer', '=','customer.idcustomer')
            ->select('customer.notelp')
            ->where('customer.idcustomer','=',$data->idtransaksipelayanan)
            ->get();
        //convert object ke String langsung pake foreach
        foreach($getnotelp as $notlp){
            $nope = $notlp->notelp;
        }
        //send SMS pake Library Nexmo
        Nexmo::message()->send([
            'to'   => $nope,
            'from' => 'Kouvee xBanana',
            'text' => 'Layanan Anda di Kouvee PetShop Telah Selesai'
        ]);
        return 'Transaksi Berhasil di Edit dan SMS dikirim ke nomor '.$nope;
    }

    public function delete($idtransaksipelayanan){
        DetilPelayanan::where('idtransaksipelayanan', $idtransaksipelayanan)->delete();//delete child di tabel detil
        TransaksiPelayanan::find($idtransaksipelayanan)->delete();
        return "Data di Delete";
    }
    public function cetak_struk($idtransaksipelayanan)
    {
    	$header = TransaksiPelayanan::where('idtransaksipelayanan','=',$idtransaksipelayanan)->find($idtransaksipelayanan);
        $detil = DetilPelayanan::where('idtransaksipelayanan','=',$idtransaksipelayanan)->get();

        //get total subtotal di transaksi tertentu
        $sum = 0;
        foreach($detil as $d){
            $sum += $d->subtotal;
        }
        return PDF::loadview('struk_pelayanan',compact('header','detil','sum'))->stream();
    }
}
