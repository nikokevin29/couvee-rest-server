<?php
//by Nicholas Kevin
namespace App\Http\Controllers;
use App\PemesananBarang;
use App\DetilPemesanan;
use App\DetilPelayanan;
use App\DetilPenjualan;
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
        select('P.harga as harga' ,DB::raw('sum(jumlah) as jumlah'),DB::raw('DATE_FORMAT(tglpesan, "%M") as bulan'))
        ->join('pemesanan_barang AS PB','PB.idpemesanan','=','detil_pemesanan.idpemesanan')
        ->join('produk AS P','P.idproduk','=','detil_pemesanan.idproduk')
        ->whereYear('tglpesan','=',$tahun)//Tahun Sesuai input
        ->groupBy('bulan')//Grouping berdasarkan bulan
        ->orderBy('tglpesan','asc')
        ->get();
        
        return PDF::loadview('laporan_pengadaan_tahunan',compact('dt','data','tahun'))->stream();
    }
    public function laporan_pengadaan_bulanan($tahun,$bulan){
        $dt = Carbon::now()->translatedFormat('d F Y');// get Sekarang buat tanggal transaksi
        
        $data = DetilPemesanan::
        select('P.harga as harga' ,DB::raw('sum(jumlah) as jumlah'),DB::raw('DATE_FORMAT(tglpesan, "%M") as bulan'), 'P.nama as nama')
        ->join('pemesanan_barang AS PB','PB.idpemesanan','=','detil_pemesanan.idpemesanan')
        ->join('produk AS P','P.idproduk','=','detil_pemesanan.idproduk')
        ->whereYear('tglpesan','=',$tahun)//Tahun Sesuai input
        ->whereMonth('tglpesan','=',$bulan)//Bulan Sesuai input
        ->groupBy('nama')//Grouping berdasarkan Nama
        ->orderBy('tglpesan','asc')
        ->get();

        $dateObj = Carbon::createFromFormat('!m', $bulan);
        $mon = $dateObj->translatedFormat('F'); // Translate Format ke Indonesia
        
        return PDF::loadview('laporan_pengadaan_bulanan',compact('dt','data','tahun','mon'))->stream();
    }

    //Laporan Pendapatan Bulanan
    public function laporan_pendapatan_bulanan($tahun,$bulan){
        $dt = Carbon::now()->translatedFormat('d F Y');// get Sekarang buat tanggal transaksi
        
        $dataL = DetilPelayanan::
        select('L.harga as harga' ,DB::raw('sum(jumlah) as jumlah'),DB::raw('DATE_FORMAT(tanggaltransaksi, "%M") as bulan'), 'L.nama as nama','U.nama as ukuran')
        ->join('transaksi_pelayanan AS TL','TL.idtransaksipelayanan','=','detil_pelayanan.idtransaksipelayanan')
        ->join('layanan AS L','L.idlayanan','=','detil_pelayanan.idlayanan')
        ->join('hewan AS H','H.idhewan','=','TL.idhewan')
        ->join('ukuran_hewan AS U','U.idukuran','=','H.idukuran')
        ->whereYear('tanggaltransaksi','=',$tahun)//Tahun Sesuai input
        ->whereMonth('tanggaltransaksi','=',$bulan)//Bulan Sesuai input
        ->groupBy('nama')//Grouping berdasarkan Nama
        ->orderBy('nama','asc')
        ->skip(0)
        ->take(5)
        ->get();

        $dataP = DetilPenjualan::
        select('P.harga as harga' ,DB::raw('sum(jumlah) as jumlah'),DB::raw('DATE_FORMAT(tanggaltransaksi, "%M") as bulan'), 'P.nama as nama')
        ->join('transaksi_penjualan AS TP','TP.idtransaksipenjualan','=','detil_penjualan.idtransaksipenjualan')
        ->join('produk AS P','P.idproduk','=','detil_penjualan.idproduk')
        ->whereYear('tanggaltransaksi','=',$tahun)//Tahun Sesuai input
        ->whereMonth('tanggaltransaksi','=',$bulan)//Bulan Sesuai input
        ->groupBy('nama')//Grouping berdasarkan Nama
        ->orderBy('nama','asc')
        ->skip(0)
        ->take(5)
        ->get();

        $dateObj = Carbon::createFromFormat('!m', $bulan);
        $mon = $dateObj->translatedFormat('F'); // Translate Format ke Indonesia
        
        return PDF::loadview('laporan_pendapatan_bulanan',compact('dt','dataL','dataP','tahun','mon'))->stream();
    }
    
    //Laporan Pendapatan Tahunan
    public function laporan_pendapatan_tahunan($tahun){
        $dt = Carbon::now()->translatedFormat('d F Y');// get Sekarang buat tanggal transaksi
        
        $dataL = DetilPelayanan::
        select('L.harga as hargaL' ,DB::raw('sum(jumlah) as jumlahL'),DB::raw('DATE_FORMAT(tanggaltransaksi, "%M") as bulanL'))
        ->join('transaksi_pelayanan AS TL','TL.idtransaksipelayanan','=','detil_pelayanan.idtransaksipelayanan')
        ->join('layanan AS L','L.idlayanan','=','detil_pelayanan.idlayanan')
        ->where('TL.total','!=',0)
        ->whereYear('tanggaltransaksi','=',$tahun)//Tahun Sesuai input
        ->groupBy('bulanL')//Grouping berdasarkan bulan
        ->orderBy('tanggaltransaksi','asc')
        ->get();

        $dataP = DetilPenjualan::
        select('P.harga as hargaP' ,DB::raw('sum(jumlah) as jumlahP'),DB::raw('DATE_FORMAT(tanggaltransaksi, "%M") as bulanP'))
        ->join('transaksi_penjualan AS TP','TP.idtransaksipenjualan','=','detil_penjualan.idtransaksipenjualan')
        ->join('produk AS P','P.idproduk','=','detil_penjualan.idproduk')
        ->where('TP.total','!=',0)
        ->whereYear('tanggaltransaksi','=',$tahun)//Tahun Sesuai input
        ->groupBy('bulanP')//Grouping berdasarkan bulan
        ->orderBy('tanggaltransaksi','asc')
        ->get();

        //$data = array_merge($dataP->toArray(),$dataL->toArray());
        //return $data;
        return PDF::loadview('laporan_pendapatan_tahunan',compact('dt','dataL','tahun'))->stream();
    }
}
