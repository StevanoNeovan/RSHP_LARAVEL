<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SoftDeletesWithUser;

class User extends Authenticatable
{
    use Notifiable, SoftDeletesWithUser;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; 

    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Relationship: User has many RoleUser
     */
    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser')->withTrashed();
    }

    /**
     * Relationship: User has one Pemilik
     */
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }
    
    /**
     * Get user's active roles
     */
    public function getActiveRolesAttribute()
    {
        return $this->roleUser()->where('status', 1)->with('role')->get();
    }
    
    /**
     * Check if user has specific role
     */
    public function hasRole($roleId)
    {
        return $this->roleUser()->where('idrole', $roleId)->where('status', 1)->exists();
    }
    
    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->hasRole(1);
    }
}