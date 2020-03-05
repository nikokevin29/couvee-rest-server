<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Layanan extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'layanan';
    protected $primaryKey ='idlayanan';
    protected $dates =['deleted_at'];
}
?>