<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $idhewan
 * @property string $nama
 * @property string $tgllahir
 * @property int $idjenis
 * @property int $idukuran
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $aktor
 * @property string $aksi
 * @property int $idcustomer
 */
class Hewan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'hewan';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idhewan';

    /**
     * @var array
     */
    use SoftDeletes; 
    public $timestamps = true;
    protected $dates =['deleted_at'];
    
    public function ukuranhewan()
    {
        return $this->hasOne(UkuranHewan::class, 'idukuran', 'idukuran');
    }
    public function jenishewan()
    {
        return $this->hasOne(JenisHewan::class, 'idjenis', 'idjenis');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'idcustomer', 'idcustomer');
    }
    public function getAktor()
    {
        return $this->hasOne(Pegawai::class, 'idpegawai', 'aktor');
    }
}
?>
