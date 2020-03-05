<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UkuranHewan extends Model
{
    use SoftDeletes; 
    public $timestamps = true;
    protected $table = 'ukuran_hewan';
    protected $primaryKey ='idukuran';
    protected $dates =['deleted_at'];
}
?>