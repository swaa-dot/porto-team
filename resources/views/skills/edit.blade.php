@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Edit Skill: <strong>{{ $skill->nama }}</strong></h2>

    <form action="{{ route('skills.update', $skill->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Skill</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $skill->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $skill->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level (%)</label>
            <input type="number" class="form-control" id="level" name="level" value="{{ old('level', $skill->level) }}" min="0" max="100" required>
        </div>

        <div class="mb-3">
            <label for="warna" class="form-label">Warna (Bootstrap)</label>
            <select class="form-select" name="warna" id="warna">
                @foreach(['primary', 'success', 'warning', 'danger', 'info', 'secondary', 'dark'] as $warna)
                    <option value="{{ $warna }}" @selected(old('warna', $skill->warna) == $warna)>{{ ucfirst($warna) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
    <label for="ikon" class="form-label">Ikon (Bootstrap Icon)</label>
    <input type="text" class="form-control" id="ikon" name="ikon" value="{{ old('ikon', $skill->ikon) }}" placeholder="Contoh: bi bi-code">
    <div class="form-text">
        Cek daftar ikon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
    </div>
</div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('skills.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
