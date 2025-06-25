@extends('layouts.app')

@section('content')

{{--
CATATAN:
File ini mengambil data $biodata dan $projects dari route '/' di routes/web.php.
Pastikan route tersebut sudah benar.
--}}

<div class="container my-4">

    <!-- ======================================================= -->
    <!-- BAGIAN HEADER & BIODATA -->
    <!-- ======================================================= -->
    <header class="welcome-header mb-5 shadow-sm">
        @if($biodata)
            {{-- Tampilan jika biodata sudah diisi --}}
            <img src="{{ asset('storage/' . $biodata->foto_profil) }}" class="img-fluid rounded-circle mb-3" alt="Foto Profil" style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #ffffff;">
            <h1 class="display-5">{{ $biodata->nama_lengkap }}</h1>
            <p class="lead text-muted-light">{{ $biodata->bio_singkat }}</p>
        @else
            {{-- Tampilan jika biodata belum diisi --}}
            <h1>Selamat Datang di Portofolio</h1>
            <p class="text-muted-light">Portofolio ini sedang dalam pengembangan. Silakan login dan gunakan API untuk mengelola konten.</p>
        @endif
    </header>

    <!-- ======================================================= -->
    <!-- BAGIAN PROJECT SAYA -->
    <!-- ======================================================= -->
    <section id="my-projects" class="mb-5">
        <h2 class="text-center mb-4">Project Unggulan</h2>
        <div class="row g-4 justify-content-center">
            @forelse($projects as $project)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $project->gambar_projek) }}" class="card-img-top" alt="{{ $project->nama_projek }}" style="height: 220px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $project->nama_projek }}</h5>
                        <p class="card-text text-muted-light flex-grow-1">{{ Str::limit($project->deskripsi, 100) }}</p>
                        @if($project->link_projek)
                            <a href="{{ $project->link_projek }}" class="btn btn-outline-primary mt-auto" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-box-arrow-up-right"></i> Lihat Project
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 col-md-8">
                <div class="card p-4 text-center">
                    <p class="text-muted-light mb-0">Belum ada project untuk ditampilkan. Silakan gunakan Postman untuk menambahkan project baru melalui API.</p>
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <hr class="my-5" style="border-color: var(--border-color);">

    <!-- ======================================================= -->
    <!-- BAGIAN INTEGRASI PROJECT TEMAN -->
    <!-- ======================================================= -->
    <section id="team-projects">
        <h2 class="text-center mb-4">Kolaborasi Tim</h2>

        <!-- Project Tim 1 -->
        <div class="mb-5">
            <h4 class="mb-3"><i class="bi bi-people-fill text-primary"></i> Project Milik: [Nama Teman 1]</h4>
            <div id="teman1-projects" class="row g-4">
                <div class="col-12 text-center text-muted-light">
                    <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
        </div>

        <!-- Project Tim 2 -->
        <div>
            <h4 class="mb-3"><i class="bi bi-people-fill text-primary"></i> Project Milik: [Nama Teman 2]</h4>
            <div id="teman2-projects" class="row g-4">
                <div class="col-12 text-center text-muted-light">
                    <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- SCRIPT JAVASCRIPT UNTUK MENGAMBIL DATA API --}}
<script>
    function fetchAndDisplayProjects(apiUrl, containerId) {
        const container = document.getElementById(containerId);
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Gagal mengambil data, status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                let html = "";
                if (data && data.length > 0) {
                    data.forEach(p => {
                        let description = p.deskripsi ? p.deskripsi.substring(0, 100) + '...' : 'Tidak ada deskripsi.';
                        let projectLink = p.link_projek ? `<a href="${p.link_projek}" class="btn btn-outline-primary mt-auto" target="_blank" rel="noopener noreferrer"><i class="bi bi-box-arrow-up-right"></i> Lihat Project</a>` : '';
                        let imageUrl = p.gambar_url || 'https://placehold.co/600x400/eef4fb/1e3a8a?text=Gambar+Tidak+Tersedia';

                        html += `
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                <div class="card h-100 shadow-sm">
                                    <img src="${imageUrl}" class="card-img-top" alt="${p.nama_projek}" style="height: 220px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">${p.nama_projek || 'Tanpa Judul'}</h5>
                                        <p class="card-text text-muted-light flex-grow-1">${description}</p>
                                        ${projectLink}
                                    </div>
                                </div>
                            </div>`;
                    });
                } else {
                    html = "<div class='col-12'><div class='card p-3'><p class='text-center text-muted-light mb-0'>Tidak ada project untuk ditampilkan dari teman ini.</p></div></div>";
                }
                container.innerHTML = html;
            })
            .catch(error => {
                console.error(`Error fetching from ${apiUrl}:`, error);
                container.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            <strong>Oops!</strong> Gagal memuat project teman. API mungkin sedang offline atau URL salah.
                        </div>
                    </div>`;
            });
    }

    // GANTI URL DI BAWAH INI DENGAN URL API PUBLIK TEMAN ANDA SETELAH DEPLOY
    const apiUrlTeman1 = 'https://URL-API-TEMAN-1.com/api/projects'; // CONTOH
    const apiUrlTeman2 = 'https://URL-API-TEMAN-2.com/api/projects'; // CONTOH

    document.addEventListener('DOMContentLoaded', () => {
        fetchAndDisplayProjects(apiUrlTeman1, 'teman1-projects');
        fetchAndDisplayProjects(apiUrlTeman2, 'teman2-projects');
    });
</script>
@endsection
