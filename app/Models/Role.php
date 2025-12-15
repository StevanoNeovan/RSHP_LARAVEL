<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SoftDeletesWithUser;

class Role extends Model
{
    use SoftDeletesWithUser;

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