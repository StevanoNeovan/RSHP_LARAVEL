<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            // Master Data
            'jenis_hewan',
            'ras_hewan',
            'kategori',
            'kategori_klinis',
            'kode_tindakan_terapi',
            'role',
            
            // User Management
            'user',
            'role_user',
            'dokter',
            'perawat',
            
            // Transactional Data
            'pemilik',
            'pet',
            'temu_dokter',
            'rekam_medis',
            'detail_rekam_medis'
        ];

        foreach ($tables as $table) {
            try {
                // Cek apakah tabel ada
                if (!Schema::hasTable($table)) {
                    echo "⚠️  Table {$table} not found. Skipping...\n";
                    continue;
                }
                
                // Cek apakah kolom deleted_at sudah ada
                if (Schema::hasColumn($table, 'deleted_at')) {
                    echo "⚠️  Column deleted_at already exists in {$table}. Skipping...\n";
                    continue;
                }
                
                Schema::table($table, function (Blueprint $table) {
                    $table->softDeletes()->nullable();
                });
                
                echo "✅ Added deleted_at to {$table}\n";
                
            } catch (\Exception $e) {
                echo "❌ Error on table {$table}: " . $e->getMessage() . "\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            // Master Data
            'jenis_hewan',
            'ras_hewan',
            'kategori',
            'kategori_klinis',
            'kode_tindakan_terapi',
            'role',
            
            // User Management
            'user',
            'role_user',
            'dokter',
            'perawat',
            
            // Transactional Data
            'pemilik',
            'pet',
            'temu_dokter',
            'rekam_medis',
            'detail_rekam_medis'
        ];

        foreach ($tables as $table) {
            try {
                if (!Schema::hasTable($table)) {
                    continue;
                }
                
                if (!Schema::hasColumn($table, 'deleted_at')) {
                    continue;
                }
                
                Schema::table($table, function (Blueprint $table) {
                    $table->dropSoftDeletes();
                });
                
                echo "✅ Removed deleted_at from {$table}\n";
                
            } catch (\Exception $e) {
                echo "❌ Error on table {$table}: " . $e->getMessage() . "\n";
            }
        }
    }
};