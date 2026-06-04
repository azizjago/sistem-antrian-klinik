@extends('layouts.app')

@section('title', 'Edit Layanan')
@section('page_title', 'Edit Layanan')
@section('page_subtitle', 'Perbarui nama atau kode layanan.')

@section('content')
    <div class="page-card p-4">
        <form method="POST" action="{{ route('layanan.update', $layanan) }}">
            @method('PUT')
            @include('layanan._form')
        </form>
    </div>
@endsection
