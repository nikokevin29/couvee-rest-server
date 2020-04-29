<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class PemesananBarang extends Model
{
    public $timestamps = false;
    protected $table = 'pemesanan_barang';
    protected $primaryKey ='idpemesanan';
    public function getpegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idpegawai', 'idpegawai');
    }
    public static function getNomorPOnoIncrement(){
        $date = Carbon::now();
        $getYear = $date->year;
        $getMonth = $date->format('m');
        $getDay = $date->format('d');
        return "PO"."-".$getYear."-".$getMonth."-".$getDay."-";
    }
    public function detil_pemesanan(){
        return $this->hasMany(DetilPemesanan::class,'idpemesanan','idpemesanan');
    }
    public function getsupplier(){
        return $this->hasOne(Supplier::class,'idsupplier','idsupplier');
    }
    public function getproduk(){
        return $this->belongsTo(Produk::class,'idproduk','idproduk');
    }
}
?>