<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class TransaksiPenjualan extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_penjualan';
    protected $primaryKey ='idtransaksipenjualan';
    public function getpegawai()
    {
        return $this->hasOne(Pegawai::class, 'idpegawai', 'idpegawai');
    }
    public function gethewan()
    {
        return $this->hasOne(Hewan::class, 'idhewan', 'idhewan');
    }
    public static function getNomorPRnoIncrement(){
        $date = Carbon::now();
        $getYear = $date->year;
        $getYear = substr($getYear,-2);
        $getMonth = $date->format('m');
        $getDay = $date->format('d');
        return "PR"."-".$getYear.$getMonth.$getDay."-";
    }
}
?>