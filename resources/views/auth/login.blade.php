{{-- Menggunakan layout utama kita yang sudah memiliki tema gelap dan Bootstrap 5 --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6 col-lg-5">

            {{-- Menggunakan komponen 'card' yang sudah kita styling di layout --}}
            <div class="card p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="bi bi-box-arrow-in-right" style="font-size: 3rem; color: var(--primary-accent);"></i>
                        <h3 class="card-title mt-2">Login Akun</h3>
                        <p class="text-muted">Selamat datang kembali! Silakan masuk untuk melanjutkan.</p>
                    </div>

                    <!-- Menampilkan status sesi (misal: setelah reset password) -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Input Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Alamat Email</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="contoh@email.com">
                            
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">

                             @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label text-muted">
                                    Ingat saya
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-muted small" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <!-- Tombol Login -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Log In
                            </button>
                        </div>
                    </form>

                    <!-- Link ke Halaman Registrasi -->
                    {{-- <div class="text-center mt-4">
                        <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}" style="color: var(--primary-accent);">Daftar di sini</a></p>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
