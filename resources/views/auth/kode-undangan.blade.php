<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Kode Unik - Karya PPLG</title>
    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>

<header class="navbar shadow-sm sticky top-0 z-50 bg-white dark:bg-gray-900 transition-colors duration-300">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
        <div class="flex lg:flex-1 items-center gap-2">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                🏛️
            </div>
            <span class="text-2xl font-bold text-blue-600">Museum Karya</span>
        </div>
        <div class="flex flex-wrap items-center justify-center gap-3 lg:gap-x-8 lg:justify-end lg:items-center">
            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Beranda</a>
            <a href="{{ url('/karya') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Karya</a>
            <a href="{{ url('/artikel') }}" class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Artikel</a>
            <a href="{{ url('/login') }}" class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Login</a>
            <button id="themeToggle" onclick="toggleTheme()" aria-label="Ganti mode terang/gelap"
                class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-yellow-300">
                <svg class="icon-sun w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg class="icon-moon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div>
    </nav>
</header>

<div class="main-wrapper">
    <div class="login-container">
        <!-- Kiri: Form -->
        <div class="login-left">
            <div class="login-logo">
                <div class="login-logo-circle">K</div>
                <div class="login-logo-text">Karya PPLG</div>
            </div>

            <h1 class="login-title">Kode Undangan</h1>
            <p class="login-subtitle">
                Masukkan kode undangan untuk menyelesaikan pendaftaran dengan Google
            </p>

            @if ($errors->any())
                <div class="login-alert">{{ $errors->first() }}</div>
            @endif

            <form class="login-form" action="{{ route('auth.kode-undangan.submit') }}" method="POST">
                @csrf

                <div class="login-form-group">
                    <label class="login-label" for="kode_unik">Kode Unik / Kode Undangan</label>
                    <input type="text"
                           id="kode_unik"
                           name="kode_unik"
                           placeholder="Contoh: XII-PPLG-2-2026"
                           value="{{ old('kode_unik') }}"
                           class="login-input @error('kode_unik') error @enderror"
                           required
                           autofocus />
                    @error('kode_unik')
                        <p class="login-error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="login-button">
                    Lanjutkan Pendaftaran
                </button>
            </form>

            <p class="login-register-text mt-6">
                Sudah punya akun?
                <a href="{{ url('/login') }}" class="login-register-link">Kembali ke Login</a>
            </p>
        </div>

        <!-- Kanan: Info -->
        <div class="login-right">
            <div>
                <h2 class="right-title">Satu Langkah Lagi!</h2>
                <p class="right-subtitle">
                    Karena kamu login dengan Google, kami butuh kode undangan untuk menentukan kelas & jurusan kamu.
                </p>
                <div class="right-features">
                    <div class="right-feature-item">
                        <div>
                            <div class="right-feature-title">Kode dari Guru / Admin</div>
                            <p>Mintalah kode undangan kepada guru atau admin kelas kamu</p>
                        </div>
                    </div>
                    <div class="right-feature-item">
                        <div>
                            <div class="right-feature-title">Otomatis Masuk Kelas</div>
                            <p>Setelah valid, akun Google kamu langsung terdaftar sebagai siswa</p>
                        </div>
                    </div>
                    <div class="right-feature-item">
                        <div>
                            <div class="right-feature-title">Aman & Cepat</div>
                            <p>Tidak perlu isi data lagi, langsung masuk dashboard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleTheme() {
        document.documentElement.classList.toggle('dark');
        localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    }
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // Loading state saat submit
    document.querySelector(".login-form").addEventListener("submit", function () {
        const b = this.querySelector(".login-button");
        b.classList.add("loading");
        b.disabled = true;
        b.textContent = "Memproses...";
    });
</script>
</body>
</html>