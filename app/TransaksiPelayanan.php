<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class TransaksiPelayanan extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_pelayanan';
    protected $primaryKey ='idtransaksipelayanan';
}
?>