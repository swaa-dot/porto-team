@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Riwayat Pendidikan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('educations.create') }}" class="btn btn-success mb-3">Tambah Pendidikan</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Institusi</th>
                <th>Gelar</th>
                <th>Jurusan</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($educations as $edu)
            <tr>
                <td>{{ $edu->nama_institusi }}</td>
                <td>{{ $edu->gelar }}</td>
                <td>{{ $edu->jurusan }}</td>
                <td>{{ $edu->tahun_mulai }} - {{ $edu->tahun_selesai ?? 'Sekarang' }}</td>
                <td>
                    <a href="{{ route('educations.edit', $edu->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('educations.destroy', $edu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data pendidikan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
