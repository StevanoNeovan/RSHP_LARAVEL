<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // ← PENTING: Set false karena tabel tidak punya created_at/updated_at

    protected $fillable = [
        'no_wa',
        'alamat',
        'iduser'
    ];

    /**
     * Relationship: Pemilik belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /**
     * Relationship: Pemilik has many Pets
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
}