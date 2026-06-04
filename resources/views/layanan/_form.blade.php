@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="nama_layanan">Nama Layanan</label>
        <input class="form-control @error('nama_layanan') is-invalid @enderror" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}" required>
        @error('nama_layanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="kode_layanan">Kode Layanan</label>
        <input class="form-control text-uppercase @error('kode_layanan') is-invalid @enderror" id="kode_layanan" name="kode_layanan" value="{{ old('kode_layanan', $layanan->kode_layanan ?? '') }}" maxlength="10" required>
        @error('kode_layanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="d-flex gap-2 mt-4">
    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-light">Batal</a>
</div>
