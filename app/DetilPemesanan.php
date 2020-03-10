<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class DetilPemesanan extends Model
{
    protected $table = 'detil_pemesanan';
    protected $primaryKey ='iddetilpemesanan';
    public $timestamps = false;
}
?>