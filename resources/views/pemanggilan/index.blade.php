@extends('layouts.app')

@section('title', 'Pemanggilan Antrian')
@section('page_title', 'Pemanggilan Antrian')
@section('page_subtitle', 'Kelola antrian yang sedang dilayani petugas.')

@section('content')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="page-card p-4 text-center h-100">
                <div class="text-muted mb-2">Nomor Saat Ini</div>
                <div class="display-4 fw-bold text-primary mb-3">{{ $saatIni?->nomor_antrian ?? '-' }}</div>
                <h2 class="h5 mb-1">{{ $saatIni?->nama_pasien ?? 'Belum ada antrian dipanggil' }}</h2>
                <p class="text-muted mb-4">{{ $saatIni?->layanan?->nama_layanan ?? 'Klik panggil berikutnya untuk memulai.' }}</p>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <form method="POST" action="{{ route('pemanggilan.next') }}">
                        @csrf
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-bullhorn me-2"></i>Panggil Berikutnya
                        </button>
                    </form>
                    <form method="POST" action="{{ route('pemanggilan.finish') }}">
                        @csrf
                        <button class="btn btn-success" @disabled(! $saatIni)>
                            <i class="fa-solid fa-circle-check me-2"></i>Selesai
                        </button>
                    </form>
                    <form method="POST" action="{{ route('pemanggilan.skip') }}">
                        @csrf
                        <button class="btn btn-outline-secondary" @disabled(! $saatIni)>
                            <i class="fa-solid fa-forward me-2"></i>Skip
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="stat-card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <span class="stat-icon"><i class="fa-solid fa-hourglass-half"></i></span>
                    <div>
                        <div class="text-muted small">Sisa Menunggu</div>
                        <div class="h2 mb-0">{{ $menunggu }}</div>
                    </div>
                </div>
                <hr>
                <p class="text-muted mb-0">Status antrian akan berpindah dari Menunggu ke Dipanggil, lalu ditutup sebagai Selesai atau Skip.</p>
            </div>
        </div>
    </div>
@endsection
