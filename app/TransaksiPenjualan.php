<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class TransaksiPenjualan extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_penjualan';
    protected $primaryKey ='idtransaksipenjualan';
}
?>