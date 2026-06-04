@extends('layouts.app')

@section('title', 'Manajemen Layanan')
@section('page_title', 'Manajemen Layanan')
@section('page_subtitle', 'Kelola jenis layanan klinik kampus.')
@section('page_action')
    <a href="{{ route('layanan.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>Tambah Layanan
    </a>
@endsection

@section('content')
    <div class="page-card p-3">
        <div class="table-responsive">
            <table class="table data-table align-middle">
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
                            <a href="{{ route('layanan.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
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
@endsection
