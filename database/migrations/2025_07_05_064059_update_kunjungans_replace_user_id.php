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
        Schema::table('kunjungans', function (Blueprint $table) {
            // Hapus foreign key dan kolom user_id
            if (Schema::hasColumn('kunjungans', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            // Tambahkan kartu_anggota_id sebagai pengganti
            $table->foreignId('kartu_anggota_id')
                ->after('id') // opsional: letakkan setelah id
                ->constrained('kartu_anggota_perpustakaan_digital')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('kunjungans', function (Blueprint $table) {
            // Rollback: hapus kartu_anggota_id
            $table->dropForeign(['kartu_anggota_id']);
            $table->dropColumn('kartu_anggota_id');

            // Tambahkan kembali user_id jika diperlukan
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
        });
    }
};
