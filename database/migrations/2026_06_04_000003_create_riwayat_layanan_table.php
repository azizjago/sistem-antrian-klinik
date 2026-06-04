<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antrian_id')->unique()->constrained('antrian')->cascadeOnDelete();
            $table->foreignId('layanan_id')->constrained('layanan')->cascadeOnDelete();
            $table->string('nomor_antrian');
            $table->string('nama_pasien');
            $table->enum('status', ['selesai', 'skip']);
            $table->date('tanggal');
            $table->timestamps();

            $table->index(['tanggal', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_layanan');
    }
};
