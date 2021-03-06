<?php
//by Nicholas Kevin
namespace App\Http\Controllers;
use App\TransaksiPenjualan;
use App\DetilPenjualan;
use App\Produk;
use PDF;
use Carbon\Carbon;
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

        $detil = DetilPenjualan::where('idtransaksipenjualan','=',$idtransaksipenjualan)->get();
        foreach($detil as $datas){
            Produk::where('idproduk', $datas->idproduk)->decrement('stok', $datas->jumlah);//Update Stock di tabel produk
        }

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
    public function laporan_penjualan_terlaris($tahun){
        $dt = Carbon::now()->translatedFormat('d F Y');// get Sekarang buat tanggal transaksi
        $data = DetilPenjualan::
        select('P.nama',DB::raw('sum(jumlah) as jumlah'),DB::raw('DATE_FORMAT(tanggaltransaksi, "%M") as bulan'))
        ->join('transaksi_penjualan AS T','T.idtransaksipenjualan','=','detil_penjualan.idtransaksipenjualan')
        ->join('produk AS P','P.idproduk','=','detil_penjualan.idproduk')
        ->whereYear('tanggaltransaksi','=',$tahun)//Tahun Sesuai input
        ->groupBy('bulan')//Grouping berdasarkan bulan
        ->orderBy('tanggaltransaksi','asc')
        ->get();

        
        return PDF::loadview('laporan_penjualan_terlaris',compact('dt','data','tahun'))->stream();
    }
}
