@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center my-4">Manajemen Data Skill</h2>
            <hr>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('skills.create') }}" class="btn btn-md btn-success mb-3">TAMBAH SKILL</a>

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">IKON</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">LEVEL</th>
                                    <th scope="col">WARNA</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
    @forelse ($skills as $skill)
    <tr>
        <td class="text-center">
            @if($skill->ikon)
                <i class="{{ $skill->ikon }} fs-4"></i>
            @else
                <span class="text-muted">-</span>
            @endif
        </td>
        <td>{{ $skill->nama }}</td>
        <td>{{ $skill->deskripsi ?? '-' }}</td>
        <td>{{ $skill->level }}%</td>
        <td>
            <span class="badge bg-{{ $skill->warna }}">{{ ucfirst($skill->warna) }}</span>
        </td>
        <td class="text-center">
            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus skill ini?');" action="{{ route('skills.destroy', $skill->id) }}" method="POST">
                <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center">
            <div class="alert alert-danger">Belum ada data skill.</div>
        </td>
    </tr>
    @endforelse
</tbody>
                        </table>
                    </div>

                    {{-- Pagination jika pakai paginate --}}
                    {{-- {{ $skills->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
