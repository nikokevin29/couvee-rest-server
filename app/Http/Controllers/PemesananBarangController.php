<?php
//by Nicholas Kevin
namespace App\Http\Controllers;
use App\PemesananBarang;
use App\DetilPemesanan;
use App\Produk;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PemesananBarangController extends Controller
{
    public function index(){
        $datas = PemesananBarang::all();
        $getAll = [];
        foreach($datas as $data)
        {
            array_push($getAll,[
                'idpemesanan'=>$data->idpemesanan,
                'noPO'=>$data->noPO,
                'idsupplier'=>$data->getsupplier->nama,
                'idpegawai'=>$data->getpegawai->nama,
                'tglpesan'=>$data->tglpesan,
                'tglcetak'=>$data->tglcetak,
                'status'=>$data->status,
                'detil'=>$data->detil_pemesanan,
                ]);
        }
        return $getAll;
    }
    public function getbyid($idpemesanan)
    {
        $data = PemesananBarang::find($idpemesanan);
        if (is_null($data)) {
            return response(['Messeage'=>'Not Found'],404);
        } else
            return response($data);
    }
    public function create(request $request){
        $data = new PemesananBarang;
        $data->noPO = "";
        $data->idpegawai = $request->idpegawai;
        $data->tglpesan =$request->tglpesan;
        $data->status = $request->status;
        $data->idsupplier = $request->idsupplier;
        $data->save();
        $data->noPO = PemesananBarang::getNomorPOnoIncrement().$data->idpemesanan;
        $data->save();
        return "Data Masuk";
    }
    public function update(request $request, $idpemesanan){
        $data = PemesananBarang::find($idpemesanan);
        $data->status = $request->status;
        $data->save();

        $detil = DetilPemesanan::where('idpemesanan','=',$idpemesanan)->get();
        foreach($detil as $data){
            Produk::where('idproduk', $data->idproduk)->increment('stok', $data->jumlah);//Update Stock di tabel produk
        }
        return "Status Diupdate";
    }

    public function delete($idpemesanan){
        DetilPemesanan::where('idpemesanan', $idpemesanan)->delete();//delete child di tabel detil
        PemesananBarang::find($idpemesanan)->delete();
        return "Data di Delete";
    }
    public function cetak_struk($idpemesanan)
    {
    	$header = PemesananBarang::where('idpemesanan','=',$idpemesanan)->find($idpemesanan);
        $detil = DetilPemesanan::where('idpemesanan','=',$idpemesanan)->get();

        return PDF::loadview('struk_pemesanan',compact('header','detil'))->stream();
    }
    public function laporan_pengadaan_tahunan($tahun){
        $dt = Carbon::now()->translatedFormat('d F Y');// get Sekarang buat tanggal transaksi
        
        $data = DetilPemesanan::
        select('P.harga as harga' ,'jumlah',DB::raw('DATE_FORMAT(tglcetak, "%M") as bulan'))
        ->join('pemesanan_barang AS PB','PB.idpemesanan','=','detil_pemesanan.idpemesanan')
        ->join('produk AS P','P.idproduk','=','detil_pemesanan.idproduk')
        ->whereYear('tglcetak','=',$tahun)//Tahun Sesuai input
        ->groupBy('bulan')//Grouping berdasarkan bulan
        ->orderBy('tglcetak','asc')
        ->get();
        
        return PDF::loadview('laporan_pengadaan_tahunan',compact('dt','data','tahun'))->stream();
    }
}
