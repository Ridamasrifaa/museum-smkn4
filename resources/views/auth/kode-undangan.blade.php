<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <title>Kode Undangan - Karya PPLG</title>

    @verbatim
    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    @endverbatim

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
    <script src="{{ asset('assets/js/auth/theme.js') }}"></script>
</head>
<body>

<<<<<<< Updated upstream
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
=======
    <!-- Elemen Dekoratif Grid Background & Floating Shapes -->
    <div class="decorative-shapes" aria-hidden="true">
        <div class="shape shape-1">✨</div>
        <div class="shape shape-2">MUSEUM VIRTUAL</div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4">CURATOR ACCESS</div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
    </div>
>>>>>>> Stashed changes

    <!-- NAVBAR HEADER BARU -->
    <header class="sticky top-4 z-50 px-4">
        <nav class="relative mx-auto max-w-7xl bg-white dark:bg-zinc-900 rounded-full border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] px-4 sm:px-6 py-3 transition-all duration-300">
            <div class="flex items-center justify-between">
                
                <!-- 1. Logo & Title -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-white dark:bg-zinc-800 border-3 border-black dark:border-white flex items-center justify-center font-black shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] shrink-0">
                        <img src="{{ asset('assets/img/smk4.png') }}" alt="Logo" class="w-6 h-6 sm:w-7 sm:h-7 object-cover rounded-md" />
                    </div>
                    <span class="text-sm sm:text-lg font-black tracking-wider text-black dark:text-white whitespace-nowrap">MUSEUM.KARYA</span>
                </div>

                <!-- 2. Menu Links (Tampilan Desktop & Dropdown Melayang di Mobile) -->
                <div id="navLinks"
                    class="hidden md:flex flex-col md:flex-row gap-3 md:gap-8 md:items-center
                    absolute md:static left-0 right-0 top-[calc(100%+16px)] md:top-auto
                    bg-zinc-900/95 md:bg-transparent backdrop-blur-md md:backdrop-blur-none
                    rounded-3xl md:rounded-none border-2 md:border-0 border-zinc-700 md:border-none
                    shadow-xl md:shadow-none 
                    p-5 md:p-0 z-50 text-center md:text-left transition-all">
                    
                    <!-- BERANDA -->
                    <a href="{{ url('/') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        BERANDA
                    </a>

                    <!-- KARYA -->
                    <a href="{{ url('/karya') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        KARYA
                    </a>

                    <!-- ARTIKEL -->
                    <a href="{{ url('/artikel') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        ARTIKEL
                    </a>

                    <!-- TENTANG -->
                    <a href="{{ url('/tentang') }}"
                        class="text-sm md:text-xs font-black text-zinc-300 hover:text-white transition px-4 md:px-0 py-3 md:py-0 rounded-2xl md:rounded-none">
                        TENTANG
                    </a>

                    <!-- Tombol LOGIN di Menu Mobile -->
                    <a href="{{ route('login') }}" 
                        class="md:hidden mt-2 text-xs font-black px-5 py-3 bg-[#74B9FF] text-black border-2 border-black rounded-2xl shadow-[2px_2px_0px_#000] active:translate-y-[1px] transition block text-center">
                        LOGIN
                    </a>
                </div>

                <!-- 3. Right Actions (Theme Toggle, Login Desktop, & Hamburger) -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <button
                        id="themeToggle"
                        onclick="toggleTheme()"
                        aria-label="Ganti mode"
                        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-[#FFD23F] border-3 border-black dark:border-white shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-gray-900 cursor-pointer hover:translate-y-[-2px] transition">
                        🌙
                    </button>
                    
                    <!-- Login (Desktop) -->
                    <a href="{{ route('login') }}" 
                        class="hidden md:inline-block text-[10px] sm:text-xs font-black px-3 sm:px-5 py-2 sm:py-2.5 bg-[#74B9FF] text-black border-3 border-black dark:border-white rounded-full shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-[#54a0ff] transition whitespace-nowrap">
                        LOGIN
                    </a>

                    <!-- Hamburger Button (Mobile) -->
                    <button 
                        id="menuToggle" 
                        aria-label="Open Menu" 
                        class="md:hidden w-9 h-9 rounded-xl bg-white dark:bg-zinc-800 border-3 border-black dark:border-white flex items-center justify-center font-black shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-black dark:text-white cursor-pointer active:translate-y-[1px]">
                        <svg id="hamburgerIcon" class="w-5 h-5 block" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="closeIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

            </div>
        </nav>
    </header>

    <div class="main-wrapper">
        <div class="login-container">
            {{-- Kiri: Form Kode Undangan --}}
            <div class="login-left">
                <div class="login-logo">
                    <div class="login-logo-circle">K</div>
                    <div class="login-logo-text">Karya PPLG</div>
                </div>

                <h1 class="login-title">Kode Undangan</h1>
                <p class="login-subtitle">Masukkan kode undangan untuk menyelesaikan pendaftaran dengan Google</p>

                @if ($errors->any())
                    <div class="login-alert" style="background-color: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="login-form kode-form" action="{{ route('auth.kode-undangan.submit') }}" method="POST">
                    @csrf

                    <div class="login-form-group">
                        <label class="login-label" for="kode_unik">Kode Unik / Kode Undangan</label>
                        <input type="text" id="kode_unik" name="kode_unik"
                               placeholder="Contoh: XII-PPLG-2-2026"
                               value="{{ old('kode_unik') }}"
                               class="login-input @error('kode_unik') error @enderror"
                               required autofocus />
                        @error('kode_unik')
                            <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="login-button kode-button">Lanjutkan Pendaftaran</button>
                </form>

                <p class="login-register-text">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="login-register-link">Kembali ke Login</a>
                </p>
            </div>

            {{-- Kanan: Info --}}
            <div class="login-right">
                <div>
                    <h2 class="right-title">Satu Langkah Lagi!</h2>
                    <p class="right-subtitle">Karena kamu login dengan Google, kami butuh kode undangan untuk menentukan kelas &amp; jurusan kamu.</p>
                    <div class="right-features">
                        <div class="right-feature-item">
                            <div>
                                <div class="right-feature-title">Kode dari Guru / Admin</div>
                                <p>Mintalah kode undangan kepada guru atau Ketua Murid (KM) kelas kamu</p>
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
                                <div class="right-feature-title">Aman &amp; Cepat</div>
                                <p>Tidak perlu isi data lagi, langsung masuk dashboard</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Hamburger Toggle Mobile -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const closeIcon = document.getElementById('closeIcon');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        document.querySelector(".kode-form").addEventListener("submit", function () {
            const b = document.querySelector(".kode-button");
            b.classList.add("opacity-75", "cursor-not-allowed", "loading");
            b.disabled = true;
            b.textContent = "Tunggu bentar yaa.....";
        });
    </script>
</body>
</html>