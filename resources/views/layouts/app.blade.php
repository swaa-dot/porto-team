<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Digital</title>

    <!-- Google Fonts: Poppins (Font yang bersih dan modern) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



    <style>
        /* --- Definisi Palet Warna untuk Mode Terang & Gelap --- */

        /* [DEFAULT] Palet Warna Mode Gelap "Langit Tenang" */
        :root,
        /* Palet Warna Mode Terang "Mentari Pagi" */
        body[data-theme="light"] {
            --bg-main: #f0f7ff;
            --bg-card: #ffffff;
            --bg-nav: rgba(255, 255, 255, 0.7);
            --primary-accent: #4f46e5;
            --primary-accent-hover: #6366f1;
            --secondary-accent: #0891b2;
            --text-main: #1e3a8a;
            --text-muted: #6b7280;
            --border-color: #e2e8f0;
            --shadow-color: rgba(79, 70, 229, 0.2);
            --btn-text-color: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            overflow-x: hidden;
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        /* --- Kontainer Animasi Latar Belakang --- */
        .animation-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
        }

        .animation-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: opacity 0.8s ease-in-out;
        }

        /* Tampilkan/Sembunyikan Animasi berdasarkan Tema */
     

        body[data-theme="light"] .dark-mode-animation {
            opacity: 0;
            pointer-events: none;
        }

      

        body[data-theme="light"] .light-mode-animation {
            opacity: 1;
        }

        /* Animasi Bintang & Meteor (Mode Gelap) */


        @keyframes twinkle {
            0% {
                opacity: 0.4;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.4;
            }
        }

        /* .meteor {
            background: linear-gradient(45deg, var(--secondary-accent), transparent);
            width: 2px;
            height: 200px;
            animation: meteor-fall 20s linear infinite;
        }

        .meteor:nth-child(1) {
            top: -10vh;
            left: 40vw;
            animation-delay: 2s;
        }

        .meteor:nth-child(2) {
            top: 10vh;
            left: 90vw;
            animation-delay: 12s;
        } */

        /* @keyframes meteor-fall {
            0% {
                opacity: 1;
                transform: rotate(-45deg) translateX(50vw);
            }

            100% {
                opacity: 0;
                transform: rotate(-45deg) translateX(-100vw);
            }
        } */

        /* Animasi Gelembung Cahaya (Mode Terang) */
        .orb {
            position: absolute;
            bottom: -150px;
            background-color: var(--primary-accent);
            border-radius: 50%;
            animation: float-up 25s linear infinite;
            opacity: 0;
        }

        .orb:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-duration: 20s;
            animation-delay: 0s;
        }

        .orb:nth-child(2) {
            width: 30px;
            height: 30px;
            left: 35%;
            animation-duration: 30s;
            animation-delay: 2s;
            background-color: var(--secondary-accent);
        }

        .orb:nth-child(3) {
            width: 120px;
            height: 120px;
            left: 50%;
            animation-duration: 18s;
            animation-delay: 5s;
        }

        .orb:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 80%;
            animation-duration: 28s;
            animation-delay: 1s;
            background-color: var(--secondary-accent);
        }

        .orb:nth-child(5) {
            width: 90px;
            height: 90px;
            left: 90%;
            animation-duration: 22s;
            animation-delay: 8s;
        }

        @keyframes float-up {
            0% {
                transform: translateY(0);
                opacity: 0.2;
            }

            20% {
                opacity: 0.6;
            }

            80% {
                opacity: 0.6;
            }

            100% {
                transform: translateY(-120vh);
                opacity: 0;
            }
        }

        /* --- Styling Komponen Umum --- */
        main {
            z-index: 1;
            position: relative;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        a,
        span,
        li {
            color: var(--text-main);
            transition: color 0.5s ease;
        }

        p {
            color: var(--text-muted);
            transition: color 0.5s ease;
        }

        a {
            text-decoration: none;
        }

        hr {
            border-color: var(--border-color);
        }

        .navbar-custom {
            background-color: var(--bg-nav);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            transition: all 0.5s ease;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: var(--text-main);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .navbar-brand:hover {
            color: var(--primary-accent);
        }

        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            transition: all 0.4s ease;
            backdrop-filter: blur(5px);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 0 25px var(--shadow-color);
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-accent), var(--secondary-accent));
            border: none;
            font-weight: 600;
            color: var(--btn-text-color);
            transition: all 0.3s ease;
            box-shadow: 0 0 10px var(--shadow-color);
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px var(--primary-accent), 0 0 30px var(--secondary-accent);
        }

        #theme-toggle {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 1.25rem;
        }
    </style>
</head>

<body data-theme="light">
    {{-- unutuk loading --}}
    <!-- LOADER -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    {{-- BARU --}}
    <!-- Wadah untuk Animasi Latar Belakang -->
    <div class="animation-container">
        <!-- Animasi Mode Gelap -->
        {{-- <div class="dark-mode-animation animation-wrapper">
            <div id="stars"></div>
            <div class="meteor"></div>
            <div class="meteor"></div>
        </div> --}}
        <!-- Animasi Mode Terang -->
        <div class="light-mode-animation animation-wrapper">
            <div class="orb"></div>
            <div class="orb"></div>
            <div class="orb"></div>
            <div class="orb"></div>
            <div class="orb"></div>
        </div>
    </div>

    <!-- ======================================================= -->
    <!-- ======== NAVBAR DENGAN LOGIKA OTENTIKASI LENGKAP ======== -->
    <!-- ======================================================= -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}"><i class="bi bi-stars"></i> Portofolio Digital</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link dropdown-toggle" href="#" id="masterDataDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Master Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="masterDataDropdown">
                            <li><a class="dropdown-item" href="{{ route('projects.index') }}">Manajemen Project</a></li>
                            <li><a class="dropdown-item" href="{{ route('biodatas.index') }}">Manajemen Biodata</a></li>
                            <li><a class="dropdown-item" href="{{ route('skills.index') }}">Manajemen Skill</a></li>
                            <li><a class="dropdown-item" href="{{ route('work-experiences.index') }}">Manajemen
                                    Pengalaman Kerja</a></li>
                            <li><a class="dropdown-item" href="{{ route('educations.index') }}">Manajemen Pendidikan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm ms-2">Login</a>
                    </li>
                    {{-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm ms-2">Register</a>
                    </li>
                    @endif --}}
                    @endauth
                    {{-- <li class="nav-item ms-2">
                        <button id="theme-toggle" class="nav-link px-2">
                            <i class="bi bi-sun-fill d-none" id="theme-icon-sun"></i>
                            <i class="bi bi-moon-stars-fill" id="theme-icon-moon"></i>
                        </button>
                    </li> --}}
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