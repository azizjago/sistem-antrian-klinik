<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrian';

    protected $fillable = [
        'layanan_id',
        'nomor_antrian',
        'nama_pasien',
        'nim_nip',
        'status',
        'waktu_ambil',
        'waktu_dipanggil',
        'waktu_selesai',
    ];

    protected function casts(): array
    {
        return [
            'waktu_ambil' => 'datetime',
            'waktu_dipanggil' => 'datetime',
            'waktu_selesai' => 'datetime',
        ];
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    public function riwayatLayanan(): HasOne
    {
        return $this->hasOne(RiwayatLayanan::class);
    }
}
