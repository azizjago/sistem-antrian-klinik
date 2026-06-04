<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\RiwayatLayanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PemanggilanController extends Controller
{
    public function index(): View
    {
        return view('pemanggilan.index', [
            'saatIni' => $this->antrianSaatIni(),
            'menunggu' => Antrian::where('status', 'menunggu')->count(),
        ]);
    }

    public function next(): RedirectResponse
    {
        if ($this->antrianSaatIni()) {
            return back()->with('warning', 'Selesaikan atau skip antrian yang sedang dipanggil terlebih dahulu.');
        }

        $antrian = Antrian::with('layanan')
            ->where('status', 'menunggu')
            ->oldest('waktu_ambil')
            ->first();

        if (! $antrian) {
            return back()->with('warning', 'Tidak ada antrian menunggu.');
        }

        $antrian->update([
            'status' => 'dipanggil',
            'waktu_dipanggil' => now(),
        ]);

        return back()->with('success', 'Antrian '.$antrian->nomor_antrian.' dipanggil.');
    }

    public function finish(): RedirectResponse
    {
        return $this->completeCurrent('selesai');
    }

    public function skip(): RedirectResponse
    {
        return $this->completeCurrent('skip');
    }

    private function completeCurrent(string $status): RedirectResponse
    {
        $antrian = $this->antrianSaatIni();

        if (! $antrian) {
            return back()->with('warning', 'Belum ada antrian yang sedang dipanggil.');
        }

        $antrian->update([
            'status' => $status,
            'waktu_selesai' => now(),
        ]);

        RiwayatLayanan::updateOrCreate(
            ['antrian_id' => $antrian->id],
            [
                'layanan_id' => $antrian->layanan_id,
                'nomor_antrian' => $antrian->nomor_antrian,
                'nama_pasien' => $antrian->nama_pasien,
                'status' => $status,
                'tanggal' => now()->toDateString(),
            ]
        );

        return back()->with('success', 'Antrian '.$antrian->nomor_antrian.' ditandai '.ucfirst($status).'.');
    }

    private function antrianSaatIni(): ?Antrian
    {
        return Antrian::with('layanan')
            ->where('status', 'dipanggil')
            ->oldest('waktu_dipanggil')
            ->first();
    }
}
