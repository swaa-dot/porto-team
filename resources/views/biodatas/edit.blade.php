@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header text-center p-3">
                    <h4>Manajemen Biodata Diri</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                         <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('biodatas.update', $biodata->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $biodata->foto_profil) }}" class="rounded-circle" width="150" height="150" style="object-fit: cover; border: 4px solid var(--border-color);" alt="Foto Profil">
                        </div>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-lg" name="nama_lengkap" value="{{ old('nama_lengkap', $biodata->nama_lengkap) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Alamat Email</label>
                            <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email', $biodata->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bio_singkat" class="form-label fw-bold">Bio Singkat (Tagline)</label>
                            <textarea class="form-control form-control-lg" name="bio_singkat" rows="3" required>{{ old('bio_singkat', $biodata->bio_singkat) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto_profil" class="form-label fw-bold">Ubah Foto Profil</label>
                            <input type="file" class="form-control form-control-lg" name="foto_profil">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ url('/') }}" class="btn btn-secondary btn-lg">Kembali ke Home</a>
                            <button type="submit" class="btn btn-primary btn-lg">UPDATE BIODATA</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
