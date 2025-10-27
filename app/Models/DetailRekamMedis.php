<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRekamMedis extends Model
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'keterangan'
    ];

    // 🔗 Relasi ke RekamMedis (Many to One)
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    // 🔗 Relasi ke KodeTindakanTerapi (Many to One)
    public function tindakan()
    {
        return $this->belongsTo(KodeTindakanTerapi::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }
}
