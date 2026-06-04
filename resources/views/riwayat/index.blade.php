@extends('layouts.app')

@section('title', 'Riwayat Layanan')
@section('page_title', 'Riwayat Layanan')
@section('page_subtitle', 'Catatan antrian yang selesai atau dilewati.')

@section('content')
    <div class="page-card p-3 mb-3">
        <form class="row g-3 align-items-end" method="GET" action="{{ route('riwayat.index') }}">
            <div class="col-md-4">
                <label class="form-label" for="filter">Filter Tanggal</label>
                <select class="form-select" id="filter" name="filter">
                    <option value="hari_ini" @selected($filter === 'hari_ini')>Hari ini</option>
                    <option value="minggu_ini" @selected($filter === 'minggu_ini')>Minggu ini</option>
                    <option value="bulan_ini" @selected($filter === 'bulan_ini')>Bulan ini</option>
                </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary"><i class="fa-solid fa-filter me-2"></i>Filter</button>
            </div>
        </form>
    </div>

    <div class="page-card p-3">
        <div class="table-responsive">
            <table class="table data-table align-middle">
                <thead>
                <tr>
                    <th>Nomor Antrian</th>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($riwayat as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->nomor_antrian }}</td>
                        <td>{{ $item->nama_pasien }}</td>
                        <td>{{ $item->layanan->nama_layanan }}</td>
                        <td>@include('partials.status-badge', ['status' => $item->status])</td>
                        <td>{{ $item->tanggal->format('d M Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
