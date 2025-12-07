<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false; // Sesuaikan jika tabel punya created_at/updated_at

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
            'iduser', // Foreign key on users table
            'iduser', // Foreign key on role_user table
            'iduser', // Local key on dokter table
            'iduser'  // Local key on users table
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