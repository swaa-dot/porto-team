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
                        <i class="bi bi-key-fill" style="font-size: 3rem; color: var(--primary-accent);"></i>
                        <h3 class="card-title mt-2">Lupa Password?</h3>
                        <p class="text-muted">Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.</p>
                    </div>

                    <!-- Menampilkan status sesi (misal: "Link reset telah dikirim!") -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Input Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Alamat Email Terdaftar</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="contoh@email.com">
                            
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Kirim Link Reset -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Kirim Link Reset Password
                            </button>
                        </div>
                    </form>

                    <!-- Link untuk Kembali ke Halaman Login -->
                    <div class="text-center mt-4">
                        <p class="text-muted">Ingat password Anda? <a href="{{ route('login') }}" style="color: var(--primary-accent);">Kembali ke Login</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
