<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan'
    ];

    /**
     * Relasi ke Pemilik (Many to One)
     */
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    /**
     * Relasi ke RasHewan (Many to One)
     */
    public function ras()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    /**
     * Relasi ke TemuDokter (One to Many)
     * Pet bisa punya banyak temu dokter
     */
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idpet', 'idpet');
    }

   
    
    /**
     * Get rekam medis melalui temu dokter
     * Usage: $pet->rekamMedisList
     */
    public function getRekamMedisListAttribute()
    {
        return \App\Models\RekamMedis::whereHas('temuDokter', function($query) {
            $query->where('idpet', $this->idpet);
        })->with(['temuDokter.roleUser.user', 'details.tindakan'])
          ->orderBy('created_at', 'desc')
          ->get();
    }

    /**
     * Get temu dokter list
     * Usage: $pet->temuDokterList
     */
    public function getTemuDokterListAttribute()
    {
        return $this->temuDokter()
            ->with(['roleUser.user', 'rekamMedis'])
            ->orderBy('waktu_daftar', 'desc')
            ->get();
    }
}