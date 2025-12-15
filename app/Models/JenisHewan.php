<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SoftDeletesWithUser;

class JenisHewan extends Model
{
    use SoftDeletesWithUser;

    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_jenis_hewan'];

    // 🔗 Relasi ke RasHewan (One to Many)
    public function rasHewan()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    public function rasHewanWithTrashed()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan')->withTrashed();
    }
    
    public $timestamps = false;
}
