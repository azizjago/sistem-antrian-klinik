<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLayananRequest;
use App\Models\Layanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LayananController extends Controller
{
    public function index(): View
    {
        return view('layanan.index', [
            'layanan' => Layanan::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('layanan.create');
    }

    public function store(StoreLayananRequest $request): RedirectResponse
    {
        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'kode_layanan' => strtoupper($request->kode_layanan),
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan): View
    {
        return view('layanan.edit', compact('layanan'));
    }

    public function update(StoreLayananRequest $request, Layanan $layanan): RedirectResponse
    {
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'kode_layanan' => strtoupper($request->kode_layanan),
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan): RedirectResponse
    {
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
