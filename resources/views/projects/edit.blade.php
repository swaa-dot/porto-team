@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4>Edit Project</h4>
                    <hr>
                    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_projek" class="form-label">Nama Project</label>
                            <input type="text" class="form-control @error('nama_projek') is-invalid @enderror" name="nama_projek" value="{{ old('nama_projek', $project->nama_projek) }}">
                            @error('nama_projek')<div class="alert alert-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5">{{ old('deskripsi', $project->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="alert alert-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="gambar_projek" class="form-label">Gambar Project</label>
                            <input type="file" class="form-control @error('gambar_projek') is-invalid @enderror" name="gambar_projek">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            <div class="mt-2"><img src="{{ Storage::url($project->gambar_projek) }}" width="150" class="rounded"></div>
                            @error('gambar_projek')<div class="alert alert-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="link_projek" class="form-label">Link Project (Opsional)</label>
                            <input type="url" class="form-control @error('link_projek') is-invalid @enderror" name="link_projek" value="{{ old('link_projek', $project->link_projek) }}">
                            @error('link_projek')<div class="alert alert-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
