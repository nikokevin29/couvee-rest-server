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
        return $this->hasOne(Pegawai::class, 'idpegawai', 'idpegawai');
    }
    public static function getNomorPOnoIncrement(){
        $date = Carbon::now();
        $getYear = $date->year;
        $getMonth = $date->format('m');
        $getDay = $date->format('d');
        return "PO"."-".$getYear."-".$getMonth."-".$getDay."-";
    }
}
?>