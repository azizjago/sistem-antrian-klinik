<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLayananRequest;
use App\Models\Layanan;
use Illuminate\Http\RedirectResponse;

class LayananController extends Controller
{
    public function store(StoreLayananRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Layanan::create([
            'nama_layanan' => $data['nama_layanan'],
            'kode_layanan' => $data['kode_layanan'],
        ]);

        return redirect()->route('antrian.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(StoreLayananRequest $request, Layanan $layanan): RedirectResponse
    {
        $data = $request->validated();

        $layanan->update([
            'nama_layanan' => $data['nama_layanan'],
            'kode_layanan' => $data['kode_layanan'],
        ]);

        return redirect()->route('antrian.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan): RedirectResponse
    {
        $layanan->delete();

        return redirect()->route('antrian.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
