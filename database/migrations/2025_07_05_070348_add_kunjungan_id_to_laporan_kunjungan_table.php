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
        Schema::table('laporan_kunjungan', function (Blueprint $table) {
            $table->foreignId('kunjungan_id')
                ->nullable()
                ->after('id')
                ->constrained('kunjungans')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kunjungan', function (Blueprint $table) {
            $table->dropForeign(['kunjungan_id']);
            $table->dropColumn('kunjungan_id');
        });
    }
};
