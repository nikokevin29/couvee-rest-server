<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class PemesananBarang extends Model
{
    public $timestamps = false;
    protected $table = 'pemesanan_barang';
    protected $primaryKey ='idpemesanan';
}
?>