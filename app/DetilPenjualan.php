<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class DetilPenjualan extends Model
{
    protected $table = 'detil_penjualan';
    protected $primaryKey ='iddetilpenjualan';
    public $timestamps = false;
}
?>