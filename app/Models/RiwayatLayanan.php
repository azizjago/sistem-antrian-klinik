<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatLayanan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_layanan';

    protected $fillable = [
        'antrian_id',
        'layanan_id',
        'nomor_antrian',
        'nama_pasien',
        'status',
        'tanggal',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function antrian(): BelongsTo
    {
        return $this->belongsTo(Antrian::class);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }
}
