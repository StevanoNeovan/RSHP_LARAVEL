<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nama_role'];

    // 🔗 Relasi ke RoleUser (One to Many)
    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'idrole', 'idrole');
    }
}