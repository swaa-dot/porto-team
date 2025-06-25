@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center my-4">Manajemen Data Project</h2>
            <hr>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('projects.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PROJECT</a>
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
                                    <th scope="col">GAMBAR</th>
                                    <th scope="col">NAMA PROJECT</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                <tr>
                                    <td class="text-center">
                                        {{-- INI KUNCI UTAMA GAMBAR TAMPIL: Gunakan Storage::url() --}}
                                        <img src="{{ Storage::url($project->gambar_projek) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $project->nama_projek }}</td>
                                    <td>{!! $project->deskripsi !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <div class="alert alert-danger">Data Project belum Tersedia.</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
