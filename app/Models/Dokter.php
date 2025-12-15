<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SoftDeletesWithUser;

class Dokter extends Model
{
    use SoftDeletesWithUser;
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false;

    protected $fillable = [
        'alamat',
        'no_hp',
        'bidang_dokter',
        'jenis_kelamin',
        'iduser',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /**
     * Relasi ke RoleUser (jika diperlukan)
     */
    public function roleUser()
    {
        return $this->hasOneThrough(
            RoleUser::class,
            User::class,
            'iduser', 
            'iduser', 
            'iduser', 
            'iduser'  
        );
    }

    /**
     * Format nomor HP
     */
    public function getFormattedNoHpAttribute()
    {
        $no = $this->no_hp;
        
        // Format: 0812-3456-7890
        if (strlen($no) >= 10) {
            return substr($no, 0, 4) . '-' . substr($no, 4, 4) . '-' . substr($no, 8);
        }
        
        return $no;
    }
}