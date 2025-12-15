<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SoftDeletesWithUser;

class KategoriKlinis extends Model
{
    use SoftDeletesWithUser;
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nama_kategori_klinis'];

    // 🔗 Relasi ke KodeTindakanTerapi (One to Many)
    public function kodeTindakanTerapi()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}