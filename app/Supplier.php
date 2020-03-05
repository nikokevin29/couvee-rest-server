<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Supplier extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'supplier';
    protected $primaryKey ='idsupplier';
    protected $dates =['deleted_at'];
}
?>