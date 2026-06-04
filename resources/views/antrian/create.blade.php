@extends('layouts.app')

@section('title', 'Pengambilan Antrian')
@section('page_title', 'Pengambilan Antrian')
@section('page_subtitle', 'Input data pasien untuk mendapatkan nomor antrian.')

@section('content')
    @if(session('nomor_antrian'))
        <div class="page-card p-4 mb-4 text-center">
            <div class="text-muted mb-2">Nomor antrian yang didapat</div>
            <div class="display-5 fw-bold text-primary">{{ session('nomor_antrian') }}</div>
        </div>
    @endif

    <div class="page-card p-4">
        <form method="POST" action="{{ route('antrian.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="nama_pasien">Nama Pasien</label>
                    <input class="form-control @error('nama_pasien') is-invalid @enderror" id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}" required>
                    @error('nama_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="nim_nip">NIM/NIP</label>
                    <input class="form-control @error('nim_nip') is-invalid @enderror" id="nim_nip" name="nim_nip" value="{{ old('nim_nip') }}" required>
                    @error('nim_nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="layanan_id">Pilih Layanan</label>
                    <select class="form-select @error('layanan_id') is-invalid @enderror" id="layanan_id" name="layanan_id" required>
                        <option value="">Pilih layanan</option>
                        @foreach($layanan as $item)
                            <option value="{{ $item->id }}" @selected(old('layanan_id') == $item->id)>{{ $item->kode_layanan }} - {{ $item->nama_layanan }}</option>
                        @endforeach
                    </select>
                    @error('layanan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <button class="btn btn-primary mt-4">
                <i class="fa-solid fa-ticket me-2"></i>Ambil Nomor
            </button>
        </form>
    </div>
@endsection
