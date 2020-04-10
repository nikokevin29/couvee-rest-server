<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Produk extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'produk';
    protected $primaryKey ='idproduk';
    protected $dates =['deleted_at'];

    public function getAktor()
    {
        return $this->hasOne(Pegawai::class, 'idpegawai', 'aktor');
    }
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, 'idsupplier', 'idsupplier');
    }
}
?>