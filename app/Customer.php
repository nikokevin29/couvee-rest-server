<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'customer';
    protected $primaryKey ='idcustomer';
    protected $dates =['deleted_at'];
}
?>