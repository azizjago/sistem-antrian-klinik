@extends('layouts.app')

@section('title', 'Data Antrian')
@section('page_title', 'Data Antrian')
@section('page_subtitle', 'Daftar antrian pasien beserta statusnya.')
@section('page_action')
    <a href="{{ route('antrian.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-ticket me-2"></i>Ambil Antrian
    </a>
@endsection

@section('content')
    <div class="page-card p-3 mb-3">
        <form class="row g-3 align-items-end" method="GET" action="{{ route('antrian.index') }}">
            <div class="col-md-4">
                <label class="form-label" for="layanan_id">Filter Layanan</label>
                <select class="form-select" id="layanan_id" name="layanan_id">
                    <option value="">Semua layanan</option>
                    @foreach($layanan as $item)
                        <option value="{{ $item->id }}" @selected(($filters['layanan_id'] ?? '') == $item->id)>{{ $item->nama_layanan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="status">Filter Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Semua status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-filter me-2"></i>Filter</button>
                <a href="{{ route('antrian.index') }}" class="btn btn-light">Reset</a>
            </div>
        </form>
    </div>

    <div class="page-card p-3">
        <div class="table-responsive">
            <table class="table data-table align-middle">
                <thead>
                <tr>
                    <th>Nomor Antrian</th>
                    <th>Nama Pasien</th>
                    <th>NIM/NIP</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Waktu Ambil</th>
                </tr>
                </thead>
                <tbody>
                @foreach($antrian as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->nomor_antrian }}</td>
                        <td>{{ $item->nama_pasien }}</td>
                        <td>{{ $item->nim_nip }}</td>
                        <td>{{ $item->layanan->nama_layanan }}</td>
                        <td>@include('partials.status-badge', ['status' => $item->status])</td>
                        <td>{{ $item->waktu_ambil->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
