@extends('layouts.app')

@section('title', 'Tambah Layanan')
@section('page_title', 'Tambah Layanan')
@section('page_subtitle', 'Tambahkan layanan baru untuk nomor antrian.')

@section('content')
    <div class="page-card p-4">
        <form method="POST" action="{{ route('layanan.store') }}">
            @include('layanan._form')
        </form>
    </div>
@endsection
