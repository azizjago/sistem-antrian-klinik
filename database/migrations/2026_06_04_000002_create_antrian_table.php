<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('layanan')->cascadeOnDelete();
            $table->string('nomor_antrian')->unique();
            $table->string('nama_pasien');
            $table->string('nim_nip');
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'skip'])->default('menunggu');
            $table->timestamp('waktu_ambil');
            $table->timestamp('waktu_dipanggil')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();

            $table->index(['status', 'waktu_ambil']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
