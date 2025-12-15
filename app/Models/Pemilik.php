<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SoftDeletesWithUser;

class Pemilik extends Model
{
    use SoftDeletesWithUser;
    
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    protected $fillable = [
        'no_wa',
        'alamat',
        'iduser',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser')->withTrashed();
    }

    /**
     * Relasi ke Pet (One-to-Many)
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik')->withTrashed();
    }

    /**
     * Format nomor WA
     */
    public function getFormattedNoWaAttribute()
    {
        if (!$this->no_wa) {
            return 'Belum diisi';
        }

        $no = $this->no_wa;
        
        // Format: 0812-3456-7890
        if (strlen($no) >= 10) {
            return substr($no, 0, 4) . '-' . substr($no, 4, 4) . '-' . substr($no, 8);
        }
        
        return $no;
    }
}