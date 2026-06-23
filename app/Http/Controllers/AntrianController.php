<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAntrianRequest;
use App\Models\Antrian;
use App\Models\Layanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AntrianController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'layanan_id' => ['nullable', 'integer', 'exists:layanan,id'],
            'status' => ['nullable', Rule::in(['menunggu', 'dipanggil', 'selesai', 'skip'])],
        ]);

        $query = Antrian::with('layanan')->latest('waktu_ambil');

        if (! empty($filters['layanan_id'])) {
            $query->where('layanan_id', $filters['layanan_id']);
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return view('antrian.index', [
            'antrian' => $query->get(),
            'layanan' => Layanan::orderBy('nama_layanan')->get(),
            'statuses' => ['menunggu', 'dipanggil', 'selesai', 'skip'],
            'filters' => $filters,
        ]);
    }

    public function store(StoreAntrianRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $antrian = DB::transaction(function () use ($data) {
            $layanan = Layanan::lockForUpdate()->findOrFail($data['layanan_id']);
            $nomor = $this->generateNomorAntrian($layanan);

            return Antrian::create([
                'layanan_id' => $layanan->id,
                'nomor_antrian' => $nomor,
                'nama_pasien' => $data['nama_pasien'],
                'nim_nip' => $data['nim_nip'],
                'status' => 'menunggu',
                'waktu_ambil' => now(),
            ]);
        });

        return redirect()
            ->route('antrian.index')
            ->with('success', 'Antrian berhasil dibuat.')
            ->with('nomor_antrian', $antrian->nomor_antrian);
    }

    private function generateNomorAntrian(Layanan $layanan): string
    {
        $nextNumber = Antrian::where('layanan_id', $layanan->id)
            ->count() + 1;

        return $layanan->kode_layanan.'-'.str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
