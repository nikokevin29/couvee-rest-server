<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pegawai extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'pegawai';
    protected $primaryKey ='idpegawai';
    protected $dates =['deleted_at'];
    
    public function getAktor()
    {
        return $this->hasOne(Pegawai::class, 'idpegawai', 'aktor');
    }
}
?>