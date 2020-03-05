<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class JenisHewan extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'jenis_hewan';
    protected $primaryKey ='idjenis';
    protected $dates =['deleted_at'];
}
?>