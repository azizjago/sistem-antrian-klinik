@extends('layouts.app')

@section('title', 'Antrian')
@section('page_title', 'Antrian')
@section('page_subtitle', 'Form ambil antrian dan data antrian pasien klinik kampus.')
@section('page_action')
    <div class="d-flex flex-wrap gap-2">
        <a href="#form-ambil-antrian" class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i>Tambah/Ambil Antrian
        </a>
        @if(auth()->user()->isAdmin())
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#layananModal">
                <i class="fa-solid fa-briefcase-medical me-2"></i>Master Layanan
            </button>
        @endif
    </div>
@endsection

@section('content')
    @if(session('nomor_antrian'))
        <div class="page-card p-4 mb-4 text-center">
            <div class="text-muted mb-2">Nomor antrian yang didapat</div>
            <div class="display-5 fw-bold text-primary">{{ session('nomor_antrian') }}</div>
        </div>
    @endif

    <div id="form-ambil-antrian" class="page-card p-4 mb-4">
        <div class="d-flex align-items-center gap-3 mb-3">
            <span class="stat-icon"><i class="fa-solid fa-ticket"></i></span>
            <div>
                <h2 class="h6 mb-1">Form Ambil Antrian</h2>
                <p class="text-muted mb-0">Input data pasien untuk mendapatkan nomor antrian otomatis.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('antrian.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="nama_pasien">Nama Pasien</label>
                    <input class="form-control @error('nama_pasien') is-invalid @enderror" id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}" required>
                    @error('nama_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="nim_nip">NIM/NIP</label>
                    <input class="form-control @error('nim_nip') is-invalid @enderror" id="nim_nip" name="nim_nip" value="{{ old('nim_nip') }}" required>
                    @error('nim_nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="layanan_id_form">Pilih Layanan</label>
                    <select class="form-select @error('layanan_id') is-invalid @enderror" id="layanan_id_form" name="layanan_id" required>
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

    <div class="page-card p-3 mb-3">
        <form class="row g-3 align-items-end" method="GET" action="{{ route('antrian.index') }}">
            <div class="col-md-4">
                <label class="form-label" for="layanan_id_filter">Filter Layanan</label>
                <select class="form-select" id="layanan_id_filter" name="layanan_id">
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
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="h6 mb-0">Data Antrian</h2>
        </div>
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

    @if(auth()->user()->isAdmin())
        <div class="modal fade" id="layananModal" tabindex="-1" aria-labelledby="layananModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h2 class="modal-title h5" id="layananModalLabel">Master Layanan</h2>
                            <p class="text-muted small mb-0">Data internal untuk pilihan layanan pada form antrian.</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 align-items-end mb-4" method="POST" action="{{ route('layanan.store') }}">
                            @csrf
                            <div class="col-md-5">
                                <label class="form-label" for="nama_layanan">Nama Layanan</label>
                                <input class="form-control @error('nama_layanan') is-invalid @enderror" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan') }}">
                                @error('nama_layanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="kode_layanan">Kode Layanan</label>
                                <input class="form-control text-uppercase @error('kode_layanan') is-invalid @enderror" id="kode_layanan" name="kode_layanan" value="{{ old('kode_layanan') }}" maxlength="10">
                                @error('kode_layanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary w-100">
                                    <i class="fa-solid fa-plus me-2"></i>Tambah Layanan
                                </button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Layanan</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($layanan as $item)
                                    <tr>
                                        <td><span class="badge bg-primary-subtle text-primary-emphasis">{{ $item->kode_layanan }}</span></td>
                                        <td>{{ $item->nama_layanan }}</td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editLayanan{{ $item->id }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <form method="POST" action="{{ route('layanan.destroy', $item) }}" class="d-inline" data-confirm="Hapus layanan ini? Data antrian terkait juga ikut terhapus.">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach($layanan as $item)
            <div class="modal fade" id="editLayanan{{ $item->id }}" tabindex="-1" aria-labelledby="editLayananLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('layanan.update', $item) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h2 class="modal-title h5" id="editLayananLabel{{ $item->id }}">Edit Layanan</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_layanan_{{ $item->id }}">Nama Layanan</label>
                                    <input class="form-control" id="nama_layanan_{{ $item->id }}" name="nama_layanan" value="{{ $item->nama_layanan }}" required>
                                </div>
                                <div>
                                    <label class="form-label" for="kode_layanan_{{ $item->id }}">Kode Layanan</label>
                                    <input class="form-control text-uppercase" id="kode_layanan_{{ $item->id }}" name="kode_layanan" value="{{ $item->kode_layanan }}" maxlength="10" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection

@push('scripts')
    @if($errors->has('nama_layanan') || $errors->has('kode_layanan'))
        <script>
            new bootstrap.Modal(document.getElementById('layananModal')).show();
        </script>
    @endif
@endpush
