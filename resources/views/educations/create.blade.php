@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Tambah Riwayat Pendidikan</h2>

    <form action="{{ route('educations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Institusi</label>
            <input type="text" name="institusi" class="form-control" value="{{ old('institusi') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tahun Mulai</label>
                <input type="date" name="tahun_mulai" class="form-control" value="{{ old('tahun_mulai') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tahun Selesai</label>
                <input type="date" name="tahun_selesai" class="form-control" value="{{ old('tahun_selesai') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('educations.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
