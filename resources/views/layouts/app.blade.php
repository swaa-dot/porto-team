<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Digital</title>

    <!-- Google Fonts: Poppins (Font yang bersih dan modern) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        /* --- Palet Warna "Samudra Hindia" (Cool & Techy) --- */
        :root {
            --bg-main: #f0f7ff;              /* Latar belakang utama (biru pucat) */
            --bg-card: #ffffff;              /* Warna kartu (putih bersih) */
            --primary-accent: #3b82f6;       /* Aksen utama (biru cerah) */
            --primary-accent-hover: #60a5fa; /* Aksen saat disentuh */
            --text-dark: #1e3a8a;             /* Teks utama (biru dongker) */
            --text-muted-light: #6b7280;      /* Teks sekunder (abu-abu kebiruan) */
            --border-color: #dbeafe;         /* Warna garis pemisah */
        }

        /* --- Tipografi & Body --- */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-dark);
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: var(--text-dark);
        }

        /* --- Navbar --- */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }
        .navbar-custom .nav-link:hover, .navbar-custom .navbar-brand:hover {
            color: var(--primary-accent);
        }

        /* --- Header di Halaman Welcome --- */
        .welcome-header {
            background-color: var(--bg-card);
            padding: 3rem 2rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border-color);
            text-align: center;
        }

        /* --- Card Styling --- */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(30, 58, 138, 0.1);
        }
        .card-header, .card-footer {
            background-color: #f8fafc;
            border-color: var(--border-color);
        }
        
        /* --- Button Styling --- */
        .btn-primary {
            background-color: var(--primary-accent);
            border-color: var(--primary-accent);
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: var(--primary-accent-hover);
            border-color: var(--primary-accent-hover);
        }
        .btn-outline-primary {
            color: var(--primary-accent);
            border-color: var(--primary-accent);
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-accent);
            color: white;
        }

        /* --- Footer --- */
        .footer-custom {
            background-color: #eef4fb;
            color: var(--text-muted-light);
            border-top: 1px solid var(--border-color);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        /* --- Dropdown Menu --- */
        .dropdown-menu {
            border-color: var(--border-color);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>

    <!-- ======================================================= -->
    <!-- ======== NAVBAR DENGAN LOGIKA OTENTIKASI LENGKAP ======== -->
    <!-- ======================================================= -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-code-slash"></i> Portofolio Digital
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    
                    @auth
    <!-- JIKA PENGGUNA SUDAH LOGIN, TAMPILKAN MENU INI -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="masterDataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Master Data
    </a>
    <ul class="dropdown-menu" aria-labelledby="masterDataDropdown">
        <li><a class="dropdown-item" href="{{ route('projects.index') }}">Manajemen Project</a></li>
        <li><a class="dropdown-item" href="{{ route('biodatas.index') }}">Manajemen Biodata</a></li>
        <li><a class="dropdown-item" href="{{ route('skills.index') }}">Manajemen Skill</a></li>
        <li><a class="dropdown-item" href="{{ route('work-experiences.index') }}">Manajemen Pengalaman Kerja</a></li>
        <li><a class="dropdown-item" href="{{ route('educations.index') }}">Manajemen Pendidikan</a></li>
    </ul>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::user()->name }}
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </a>
            </form>
        </li>
    </ul>
</li>
@else
    <!-- JIKA BELUM LOGIN (TAMU), TAMPILKAN MENU INI -->
    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link">Login</a>
    </li>
    @if (Route::has('register'))
        <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm ms-2">Register</a>
        </li>
    @endif
@endauth

                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama dari Halaman Lain -->
    <main class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom text-center">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} - Dibuat Oleh Kelompok 3</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
