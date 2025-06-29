@extends('layouts.app')

@section('content')
<div class="container my-5">

    <!-- HERO SECTION -->
   <!-- HERO SECTION -->
<section class="mb-5 position-relative hero-section">
    <div class="hero-wrapper text-center position-relative">
        <!-- Gambar blur -->
        <div class="hero-bg-blur" style="background-image: url('{{ asset('storage/project_images/crown.jpeg') }}');"></div>

        <!-- Gambar asli (untuk fallback atau efek tambahan) -->
        <img src="{{ asset('storage/project_images/crown.jpeg') }}" class="hero-image img-fluid rounded-4" alt="Foto Hero">

        <!-- Teks di atas gambar -->
        <div class="hero-text position-absolute top-50 start-50 translate-middle">
            <h1 class="fw-bold">
                <span class="bio d-block">Selamat Datang</span>
            </h1>
        </div>
    </div>
</section>




    <!-- HEADER & BIODATA -->
    <header class="text-center mb-5">
        @if($biodata)
        <img src="{{ asset('storage/' . $biodata->foto_profil) }}"
            class="rounded-circle shadow-lg mb-3 border border-4 border-primary" alt="Foto Profil"
            style="width: 150px; height: 150px; object-fit: cover;">
        <h1 class="fw-bold text-primary">{{ $biodata->nama_lengkap }}</h1>
        <p class="biodata default-text d-block">{{ $biodata->bio_singkat }}</p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            @if($biodata->email)
            <a href="mailto:{{ $biodata->email }}" class="btn btn-outline-dark btn-sm"><i class="bi bi-envelope"></i>
                Email</a>
            @endif
            @if($biodata->linkedin)
            <a href="{{ $biodata->linkedin }}" class="btn btn-outline-primary btn-sm" target="_blank"><i
                    class="bi bi-linkedin"></i> LinkedIn</a>
            @endif
            @if($biodata->github)
            <a href="{{ $biodata->github }}" class="btn btn-outline-dark btn-sm" target="_blank"><i
                    class="bi bi-github"></i> GitHub</a>
            @endif
        </div>
        @else
        <h1 class="fw-bold text-primary">Selamat Datang di Portofolio</h1>
        <p class="text-muted">Portofolio ini sedang dalam pengembangan. Silakan login dan gunakan API untuk mengelola
            konten.</p>
        @endif
    </header>

    <!-- SKILLS SECTION -->
    @if($skills && count($skills))
    <section class="mb-5">
        <h3 class="text-center text-secondary mb-4 text-black">Keahlian & Tools</h3>
        <div class="row justify-content-center g-4">
            @foreach($skills as $skill)
            <div class="col-md-4 col-lg-3">
                <div class="card shadow h-100 border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            @if($skill->ikon)
                            <i class="{{ $skill->ikon }} me-1 text-{{ $skill->warna }}"></i>
                            @endif
                            {{ $skill->nama }}
                        </h5>
                        @if($skill->deskripsi)
                        <p class="card-text text-muted small">{{ $skill->deskripsi }}</p>
                        @endif
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $skill->warna }}"
                                role="progressbar" style="width: {{ $skill->level }}%;"
                                aria-valuenow="{{ $skill->level }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="text-end text-muted small mb-0">{{ $skill->level }}%</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- PENDIDIKAN & PENGALAMAN -->
    @if(($educations && count($educations)) || ($workExperiences && count($workExperiences)))
    <section class="mb-5">
        <h3 class="bio text-center text-secondary mb-4">Riwayat Pendidikan & Pengalaman</h3>
        <div class="row g-4">
            <!-- Pengalaman Kerja -->
            <div class="col-md-6">
                <div class="bg-white p-3 rounded shadow-sm h-100">
                    <h5 class="text-success mb-3"><i class="bi bi-briefcase-fill me-2"></i>Pengalaman Kerja</h5>
                    @foreach($workExperiences as $work)
                    <div class="mb-3 border-start border-success ps-3">
                        <h6 class="mb-1 fw-semibold">{{ $work->perusahaan }}</h6>
                        <p class="mb-0 text-muted small">{{ $work->posisi }} ({{
                            \Carbon\Carbon::parse($work->tahun_mulai)->format('Y') }} - {{
                            \Carbon\Carbon::parse($work->tahun_selesai)->format('Y') }})</p>
                        @if($work->deskripsi)
                        <p class="small text-muted">{{ $work->deskripsi }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pendidikan -->
            <div class="col-md-6">
                <div class="bg-white p-3 rounded shadow-sm h-100">
                    <h5 class="text-primary mb-3"><i class="bi bi-mortarboard-fill me-2"></i>Pendidikan</h5>
                    @foreach($educations as $edu)
                    <div class="mb-3 border-start border-primary ps-3">
                        <h6 class="mb-1 fw-semibold">{{ $edu->institusi }}</h6>
                        <p class="mb-0 text-muted small">{{ $edu->jurusan }} ({{
                            \Carbon\Carbon::parse($edu->tahun_mulai)->format('Y') }} - {{
                            \Carbon\Carbon::parse($edu->tahun_selesai)->format('Y') }})</p>
                        @if($edu->deskripsi)
                        <p class="small text-muted">{{ $edu->deskripsi }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- PROJECT PRIBADI -->
    <section id="my-projects" class="mb-5">
        <h2 class="text-center text-success mb-4 text-black ">Project Saya</h2>
        <div class="row g-4 justify-content-center">
            @forelse($projects as $project)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="card shadow-sm border-0 h-100 rounded-4">
                    <img src="{{ asset('storage/' . $project->gambar_projek) }}" class="card-img-top rounded-top-4"
                        alt="{{ $project->nama_projek }}" style="height: 220px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $project->nama_projek }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($project->deskripsi, 100) }}</p>
                        @if($project->link_projek)
                        <a href="{{ $project->link_projek }}" class="btn btn-outline-success mt-auto" target="_blank">
                            <i class="bi bi-box-arrow-up-right"></i> Lihat Project
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 col-md-8">
                <div class="card p-4 text-center bg-light border">
                    <p class="text-muted mb-0">Belum ada project. Tambahkan melalui API terlebih dahulu.</p>
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- KOLABORASI -->
    <div class="bg-white p-4 rounded-4 shadow-">
    <section id="team-projects" class="mb-5">
        <h2 class="text-center text-primary mb-4">Kolaborasi Tim</h2>

        <!-- Tombol Pilih Teman -->
        <div class="text-center mb-4">
            <button onclick="switchTeman('1')" class="btn btn-outline-primary me-2" id="btn-teman1">
                <span id="nama-teman1">Teman 1</span>
            </button>
            <button onclick="switchTeman('2')" class="btn btn-outline-primary" id="btn-teman2">
                <span id="nama-teman2">Teman 2</span>
            </button>
        </div>

        <!-- Teman 1 -->
        <div id="teman1-container">
            <div id="teman1-profile" class="text-center mb-4">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Memuat profil teman...</p>
            </div>
            <div id="teman1-projects" class="row g-4">
                <div class="col-12 text-center text-muted">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Memuat project...</p>
                </div>
            </div>
        </div>

        <!-- Teman 2 -->
        <div id="teman2-container" style="display: none;">
            <div id="teman2-profile" class="text-center mb-4">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Memuat profil teman...</p>
            </div>
            <div id="teman2-projects" class="row g-4">
                <div class="col-12 text-center text-muted">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Memuat project...</p>
                </div>
            </div>
        </div>
    </section>
    </div>
</div>



<!-- ======================================================= -->
<!-- JAVASCRIPT UNTUK MENGAMBIL DATA API -->
<!-- ======================================================= -->
<script>
    function fetchAndDisplayProfile(apiUrl, containerId) {
    const container = document.getElementById(containerId);
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) throw new Error(`Status: ${response.status}`);
            return response.json();
        })
        .then(dataArray => {
            const data = dataArray[0]; // ✅ Ambil elemen pertama

            if (!data) {
                container.innerHTML = `<div class="alert alert-warning text-center">Biodata tidak tersedia.</div>`;
                return;
            }

               // Ganti nama tombol jika ada
            if (containerId === 'teman1-profile') {
                document.getElementById('nama-teman1').textContent = data.nama_lengkap || 'Teman 1';
            } else if (containerId === 'teman2-profile') {
                document.getElementById('nama-teman2').textContent = data.nama_lengkap || 'Teman 2';
            }

            let html = `
                <div class="mb-4">
                    <img src="${data.foto_profil_url || 'https://placehold.co/150x150?text=No+Image'}" 
                        class="rounded-circle shadow mb-3 border border-4 border-primary"
                        style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 class="fw-bold text-primary">${data.nama_lengkap || 'Nama Teman'}</h4>
                    <p class="text-muted fst-italic">${data.bio_singkat || 'Tidak ada bio'}</p>
                    <div class="d-flex justify-content-center gap-3">
                        ${data.email ? `<a href="mailto:${data.email}" class="btn btn-outline-dark btn-sm"><i class="bi bi-envelope"></i> Email</a>` : ''}
                        ${data.linkedin ? `<a href="${data.linkedin}" class="btn btn-outline-primary btn-sm" target="_blank"><i class="bi bi-linkedin"></i> LinkedIn</a>` : ''}
                        ${data.github ? `<a href="${data.github}" class="btn btn-outline-dark btn-sm" target="_blank"><i class="bi bi-github"></i> GitHub</a>` : ''}
                        </div>
                </div>
                <h5><i class="bi bi-people text-info"></i> Project Milik: <strong>${data.nama_lengkap || 'Teman'}</strong></h5>
            `;
            container.innerHTML = html;
        })
        .catch(error => {
            console.error(error);
            container.innerHTML = `<div class="alert alert-danger text-center">Gagal memuat profil teman.</div>`;
        });
}


    function fetchAndDisplayProjects(apiUrl, containerId) {
        const container = document.getElementById(containerId);
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) throw new Error(`Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                let html = "";
                if (data.length > 0) {
                    data.forEach(p => {
                        let description = p.deskripsi ? p.deskripsi.substring(0, 100) + '...' : 'Tidak ada deskripsi.';
                        let projectLink = p.link_projek ? `<a href="${p.link_projek}" class="btn btn-outline-primary mt-auto" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Lihat</a>` : '';
                        let imageUrl = p.gambar_url || 'https://placehold.co/600x400?text=No+Image';
                        html += `
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                <div class="card h-100 shadow-sm">
                                    <img src="${imageUrl}" class="card-img-top" alt="${p.nama_projek}" style="height: 220px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">${p.nama_projek}</h5>
                                        <p class="card-text text-muted flex-grow-1">${description}</p>
                                        ${projectLink}
                                    </div>
                                </div>
                            </div>`;
                    });
                } else {
                    html = "<div class='col-12'><div class='alert alert-info text-center'>Belum ada project dari teman ini.</div></div>";
                }
                container.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                container.innerHTML = `<div class="col-12"><div class="alert alert-danger text-center">Gagal memuat project teman.</div></div>`;
            });
    }
    const apiUrlTeman1Profile = 'http://maulanaaditya.my.id/api/biodata'; // Ganti dengan endpoint biodata teman 1
    const apiUrlTeman1Projects = 'http://maulanaaditya.my.id/api/projects';
    //teman 2
    const apiUrlTeman2Profile = 'http://192.168.0.8:8000/api/biodata';
    const apiUrlTeman2Projects = 'http://192.168.0.8:8000/api/projects';


    document.addEventListener('DOMContentLoaded', () => {
        // Load profile dan projects teman 1
        fetchAndDisplayProfile(apiUrlTeman1Profile, 'teman1-profile');
        fetchAndDisplayProjects(apiUrlTeman1Projects, 'teman1-projects');
        
        // Load profile dan projects teman 2
        fetchAndDisplayProfile(apiUrlTeman2Profile, 'teman2-profile');
        fetchAndDisplayProjects(apiUrlTeman2Projects, 'teman2-projects');

        switchTeman('1');
    });

    function switchTeman(id) {
    const t1 = document.getElementById('teman1-container');
    const t2 = document.getElementById('teman2-container');
    const b1 = document.getElementById('btn-teman1');
    const b2 = document.getElementById('btn-teman2');

    if (id === '1') {
        t1.style.display = 'block';
        t2.style.display = 'none';
        b1.classList.add('active');
        b2.classList.remove('active');
    } else {
        t1.style.display = 'none';
        t2.style.display = 'block';
        b1.classList.remove('active');
        b2.classList.add('active');
    }
}

    // Hilangkan loader saat semua konten dimuat
    window.addEventListener("load", function () {
        const loader = document.getElementById("loader");
        if (loader) {
            loader.style.display = "none";
        }
    });
</script>
@endsection