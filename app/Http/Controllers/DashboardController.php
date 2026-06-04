<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();

        $baseQuery = Antrian::whereDate('waktu_ambil', $today);

        return view('dashboard', [
            'totalHariIni' => (clone $baseQuery)->count(),
            'menunggu' => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'dipanggil' => (clone $baseQuery)->where('status', 'dipanggil')->count(),
            'selesai' => (clone $baseQuery)->where('status', 'selesai')->count(),
            'skip' => (clone $baseQuery)->where('status', 'skip')->count(),
            'antrianTerbaru' => Antrian::with('layanan')->latest('waktu_ambil')->limit(10)->get(),
        ]);
    }
}
