<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'iduser',
        'idrole',
        'status'
    ];

    // 🔗 Relasi ke User (Many to One)
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // 🔗 Relasi ke Role (Many to One)
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    // 🔗 Relasi ke TemuDokter (One to Many)
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idrole_user', 'idrole_user');
    }

    // 🔗 Relasi ke RekamMedis (One to Many)
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa', 'idrole_user');
    }
}