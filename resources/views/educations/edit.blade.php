@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Edit Riwayat Pendidikan</h2>

    <form action="{{ route('educations.update', $education->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Institusi</label>
            <input type="text" name="nama_institusi" class="form-control" value="{{ old('nama_institusi', $education->nama_institusi) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gelar</label>
            <input type="text" name="gelar" class="form-control" value="{{ old('gelar', $education->gelar) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $education->jurusan) }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tahun Mulai</label>
                <input type="number" name="tahun_mulai" class="form-control" value="{{ old('tahun_mulai', $education->tahun_mulai) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tahun Selesai</label>
                <input type="number" name="tahun_selesai" class="form-control" value="{{ old('tahun_selesai', $education->tahun_selesai) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('educations.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
