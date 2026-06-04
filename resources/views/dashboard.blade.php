@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan antrian klinik hari ini.')

@section('content')
    <div class="row g-3 mb-4">
        @foreach([
            ['label' => 'Total Antrian Hari Ini', 'value' => $totalHariIni, 'icon' => 'fa-ticket'],
            ['label' => 'Menunggu', 'value' => $menunggu, 'icon' => 'fa-hourglass-half'],
            ['label' => 'Dipanggil', 'value' => $dipanggil, 'icon' => 'fa-bullhorn'],
            ['label' => 'Selesai', 'value' => $selesai, 'icon' => 'fa-circle-check'],
            ['label' => 'Skip', 'value' => $skip, 'icon' => 'fa-forward'],
        ] as $stat)
            <div class="col-sm-6 col-xl">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">{{ $stat['label'] }}</div>
                            <div class="h3 mb-0">{{ $stat['value'] }}</div>
                        </div>
                        <span class="stat-icon"><i class="fa-solid {{ $stat['icon'] }}"></i></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="page-card p-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="h6 mb-0">Antrian Terbaru</h2>
            <a href="{{ route('antrian.index') }}" class="btn btn-outline-primary btn-sm">Lihat Data</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Pasien</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Waktu Ambil</th>
                </tr>
                </thead>
                <tbody>
                @forelse($antrianTerbaru as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->nomor_antrian }}</td>
                        <td>{{ $item->nama_pasien }}</td>
                        <td>{{ $item->layanan->nama_layanan }}</td>
                        <td>@include('partials.status-badge', ['status' => $item->status])</td>
                        <td>{{ $item->waktu_ambil->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada antrian.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
