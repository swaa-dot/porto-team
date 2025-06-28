@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Daftar Pengalaman Kerja</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('work-experiences.create') }}" class="btn btn-success mb-3">Tambah Pengalaman</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Posisi</th>
                <th>Perusahaan</th>
                <th>Deskripsi</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($experiences as $exp)
            <tr>
                <td>{{ $exp->posisi }}</td>
                <td>{{ $exp->perusahaan }}</td>
                <td>{{ $exp->deskripsi }}</td>
                <td>{{ $exp->tanggal_mulai }} - {{ $exp->tanggal_selesai ?? 'Sekarang' }}</td>
                <td>
                    <a href="{{ route('work-experiences.edit', $exp->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('work-experiences.destroy', $exp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
