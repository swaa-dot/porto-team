@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Edit Pengalaman Kerja</h2>

    <form action="{{ route('work-experiences.update', $workExperience->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Posisi</label>
            <input type="text" name="posisi" class="form-control" value="{{ old('posisi', $workExperience->posisi) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Perusahaan</label>
            <input type="text" name="perusahaan" class="form-control" value="{{ old('perusahaan', $workExperience->perusahaan) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $workExperience->deskripsi) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $workExperience->tanggal_mulai) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $workExperience->tanggal_selesai) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('work-experiences.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
