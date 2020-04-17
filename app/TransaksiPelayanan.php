<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class TransaksiPelayanan extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_pelayanan';
    protected $primaryKey ='idtransaksipelayanan';
    public function getpegawai()
    {
        return $this->hasOne(Pegawai::class, 'idpegawai', 'idpegawai');
    }
    public function gethewan()
    {
        return $this->hasOne(Hewan::class, 'idhewan', 'idhewan');
    }
    public static function getNomorLYnoIncrement(){
        $date = Carbon::now();
        $getYear = $date->year;
        $getYear = substr($getYear,-2);
        $getMonth = $date->format('m');
        $getDay = $date->format('d');
        return "LY"."-".$getYear.$getMonth.$getDay."-";
    }
}
?>