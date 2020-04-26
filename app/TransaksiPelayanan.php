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
        return $this->belongsTo(Pegawai::class, 'idpegawai', 'idpegawai');
    }
    public function gethewan()
    {
        return $this->belongsTo(Hewan::class, 'idhewan', 'idhewan');
    }
    public function getcustomer()
    {
        return $this->hasOne(Customer::class, 'idcustomer', 'idcustomer');
    }
    public static function getNomorLYnoIncrement(){
        $date = Carbon::now();
        $getYear = $date->year;
        $getYear = substr($getYear,-2);
        $getMonth = $date->format('m');
        $getDay = $date->format('d');
        return "LY"."-".$getYear.$getMonth.$getDay."-";
    }
    
    public function detil_pelayanan(){
        return $this->hasMany(DetilPelayanan::class,'idtransaksipelayanan','idtransaksipelayanan');
    }
}
?>