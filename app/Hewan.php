<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Hewan extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'hewan';
    protected $primaryKey ='idhewan';
    protected $dates =['deleted_at'];
}
?>