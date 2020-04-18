<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class DetilPelayanan extends Model
{
    protected $table = 'detil_pelayanan';
    protected $primaryKey ='iddetilpelayanan';
    public $timestamps = false;
    
    public function getlayanan()
    {
        return $this->belongsTo(Layanan::class, 'idlayanan', 'idlayanan');
    }
}
?>