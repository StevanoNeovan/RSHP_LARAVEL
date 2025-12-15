<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDeletesWithUser
{
    use SoftDeletes;

    /**
     * Boot the soft deleting with user trait for a model.
     */
    public static function bootSoftDeletesWithUser()
    {
        // Event saat deleting (soft delete)
        static::deleting(function ($model) {
            // Cek apakah ini soft delete (bukan force delete)
            if (!$model->isForceDeleting()) {
                // Set deleted_by dengan user yang sedang login
                $model->deleted_by = auth()->id();
                
                // Save tanpa trigger event lagi
                $model->saveQuietly();
            }
        });

        // Event saat restoring
        static::restoring(function ($model) {
            // Reset deleted_by saat restore
            $model->deleted_by = null;
        });
    }

    /**
     * Relasi ke user yang menghapus
     */
    public function deletedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by', 'iduser');
    }

    /**
     * Scope untuk filter berdasarkan siapa yang menghapus
     */
    public function scopeDeletedBy($query, $userId)
    {
        return $query->where('deleted_by', $userId);
    }
}