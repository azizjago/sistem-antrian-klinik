<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@klinik.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@klinik.test'],
            [
                'name' => 'Petugas Klinik',
                'password' => Hash::make('password'),
                'role' => 'petugas',
            ]
        );

        collect([
            ['kode_layanan' => 'UMM', 'nama_layanan' => 'Umum'],
            ['kode_layanan' => 'GIG', 'nama_layanan' => 'Gigi'],
            ['kode_layanan' => 'KON', 'nama_layanan' => 'Konsultasi'],
        ])->each(fn (array $layanan) => Layanan::updateOrCreate(
            ['kode_layanan' => $layanan['kode_layanan']],
            ['nama_layanan' => $layanan['nama_layanan']]
        ));
    }
}
