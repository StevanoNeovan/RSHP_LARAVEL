<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Use unsignedBigInteger to match user.iduser which is bigint(20)
        $tables = [
            'jenis_hewan',
            'ras_hewan',
            'kategori',
            'kategori_klinis',
            'kode_tindakan_terapi',
            'role',
            'user',
            'role_user',
            'dokter',
            'perawat',
            'pemilik',
            'pet',
            'temu_dokter',
            'rekam_medis',
            'detail_rekam_medis'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->bigInteger('deleted_by')->nullable();
                $table->foreign('deleted_by')
                      ->references('iduser')
                      ->on('user')
                      ->nullOnDelete();
            });
        }
    }

    public function down()
    {
        $tables = [
            'jenis_hewan',
            'ras_hewan',
            'kategori',
            'kategori_klinis',
            'kode_tindakan_terapi',
            'role',
            'user',
            'role_user',
            'dokter',
            'perawat',
            'pemilik',
            'pet',
            'temu_dokter',
            'rekam_medis',
            'detail_rekam_medis'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                // Drop foreign key first (if it exists)
                $table->dropForeign($table . '_deleted_by_foreign');
                $table->dropColumn('deleted_by');
            });
        }
    }
};