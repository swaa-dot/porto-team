@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-vcard-fill" style="font-size: 3rem; color: var(--primary-accent);"></i>
                        <h3 class="mt-2">Formulir Biodata Diri</h3>
                        <p class="text-muted">Lengkapi biodata Anda. Data ini akan ditampilkan di halaman utama portofolio.</p>
                    </div>
                    
                    <form action="{{ route('biodatas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Alamat Email</label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="bio_singkat" class="form-label fw-bold">Bio Singkat (Tagline)</label>
                            <textarea class="form-control form-control-lg @error('bio_singkat') is-invalid @enderror" name="bio_singkat" rows="3" required>{{ old('bio_singkat') }}</textarea>
                            @error('bio_singkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto_profil" class="form-label fw-bold">Foto Profil</label>
                            <input type="file" class="form-control form-control-lg @error('foto_profil') is-invalid @enderror" name="foto_profil" required>
                            @error('foto_profil')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">SIMPAN BIODATA</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
