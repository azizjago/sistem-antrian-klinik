<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAntrianRequest;
use App\Models\Antrian;
use App\Models\Layanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AntrianController extends Controller
{
    public function index(Request $request): View
    {
        $query = Antrian::with('layanan')->latest('waktu_ambil');

        if ($request->filled('layanan_id')) {
            $query->where('layanan_id', $request->layanan_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('antrian.index', [
            'antrian' => $query->get(),
            'layanan' => Layanan::orderBy('nama_layanan')->get(),
            'statuses' => ['menunggu', 'dipanggil', 'selesai', 'skip'],
            'filters' => $request->only(['layanan_id', 'status']),
        ]);
    }

    public function create(): View
    {
        return view('antrian.create', [
            'layanan' => Layanan::orderBy('nama_layanan')->get(),
        ]);
    }

    public function store(StoreAntrianRequest $request): RedirectResponse
    {
        $antrian = DB::transaction(function () use ($request) {
            $layanan = Layanan::lockForUpdate()->findOrFail($request->layanan_id);
            $nomor = $this->generateNomorAntrian($layanan);

            return Antrian::create([
                'layanan_id' => $layanan->id,
                'nomor_antrian' => $nomor,
                'nama_pasien' => $request->nama_pasien,
                'nim_nip' => $request->nim_nip,
                'status' => 'menunggu',
                'waktu_ambil' => now(),
            ]);
        });

        return redirect()
            ->route('antrian.create')
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
