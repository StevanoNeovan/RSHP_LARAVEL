<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // ← IMPORTANT: Table doesn't have created_at/updated_at

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
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
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