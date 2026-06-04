<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLayanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->get('filter', 'hari_ini');
        $query = RiwayatLayanan::with('layanan')->latest('tanggal')->latest();

        match ($filter) {
            'minggu_ini' => $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]),
            'bulan_ini' => $query->whereMonth('tanggal', Carbon::now()->month)->whereYear('tanggal', Carbon::now()->year),
            default => $query->whereDate('tanggal', Carbon::today()),
        };

        return view('riwayat.index', [
            'riwayat' => $query->get(),
            'filter' => $filter,
        ]);
    }
}
