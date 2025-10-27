<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nama_ras',
        'idjenis_hewan'
    ];

    // 🔗 Relasi ke JenisHewan (Many to One)
    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    // 🔗 Relasi ke Pet (One to Many)
    public function pet()
    {
        return $this->hasMany(Pet::class, 'idras_hewan', 'idras_hewan');
    }
}