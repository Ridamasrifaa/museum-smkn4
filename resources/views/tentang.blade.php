<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang — Museum Karya SMKN 4 Tasikmalaya</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    <style>
        .icon-moon { display: block; }
        .icon-sun { display: none; }
        .dark .icon-moon { display: none; }
        .dark .icon-sun { display: block; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-gray-950 text-slate-800 dark:text-gray-100 transition-colors duration-300 antialiased min-h-screen flex flex-col justify-between">

    <div>
        <!-- ===== HEADER ===== -->
        <header class="navbar shadow-xs sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md transition-colors duration-300 border-b border-slate-100 dark:border-gray-800">
            <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-8">
                <div class="flex lg:flex-1 items-center gap-3">
                    <img src="{{ asset('images/smk4.png') }}" alt="SMK4 Logo" class="w-9 h-9 rounded-full object-cover ring-2 ring-blue-500/20" />
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Museum Karya</span>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 lg:gap-x-8 lg:justify-end lg:items-center">
                    <a href="{{ url('/') }}" class="text-sm font-medium text-slate-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white transition">Beranda</a>
                    <a href="{{ url('/karya') }}" class="text-sm font-medium text-slate-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white transition">Karya</a>
                    <a href="{{ url('/artikel') }}" class="text-sm font-medium text-slate-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white transition">Artikel</a>
                    <a href="{{ url('/tentang') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400 pb-0.5">Tentang</a>
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white transition">Login</a>
                    <button id="themeToggle" onclick="toggleTheme()" aria-label="Ganti mode terang/gelap"
                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 dark:bg-gray-800 text-slate-600 dark:text-yellow-400 hover:bg-slate-200 dark:hover:bg-gray-700 transition cursor-pointer">
                        <svg class="icon-sun w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg class="icon-moon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                </div>
            </nav>
        </header>

        <!-- ===== MAIN CONTENT CONTAINER ===== -->
        <main class="py-10 sm:py-16">

            <!-- ===== HERO ===== -->
            <section class="pb-10 text-center">
                <div class="mx-auto max-w-4xl px-4 sm:px-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 mb-4 text-xs font-semibold text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-950/80 border border-blue-200/60 dark:border-blue-800/50 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 dark:bg-blue-400 animate-pulse"></span>
                        Informasi Proyek
                    </span>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4">
                        Tentang <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Museum Karya</span>
                    </h1>
                    <p class="text-slate-600 dark:text-gray-400 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                        Mengenal latar belakang pengerjaan proyek, tujuan pengembangannya, dan talenta berbakat di balik platform ini.
                    </p>
                </div>
            </section>

            <!-- ===== TENTANG PROYEK ===== -->
            <section id="tentang-proyek" class="mx-auto max-w-4xl px-4 sm:px-6">
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 sm:p-10 shadow-sm border border-slate-200/80 dark:border-gray-800/80 transition-colors duration-300">
                    
                    <div class="space-y-4 sm:space-y-6 text-slate-600 dark:text-gray-300 leading-relaxed text-sm sm:text-base">
                        <p>
                            <strong class="text-slate-900 dark:text-white font-semibold">Museum Karya</strong> hadir sebagai wadah digital terintegrasi yang dirancang khusus untuk menampung, mendokumentasikan, dan mempublikasikan berbagai hasil karya siswa-siswi SMKN 4 Tasikmalaya. Potensi kreativitas dan inovasi yang dihasilkan oleh para siswa sangat kaya, sehingga sangat disayangkan apabila karya-karya luar biasa tersebut hanya tersimpan tanpa sempat diapresiasi secara luas.
                        </p>
                        <p>
                            Platform ini dikembangkan melalui <span class="text-blue-600 dark:text-blue-400 font-semibold">kolaborasi antar tim pengembang</span> yang mulai dikerjakan secara intensif pada tanggal <span class="text-blue-600 dark:text-blue-400 font-semibold">28 Juni 2026</span>. Melalui kolaborasi ini, diharapkan Museum Karya dapat menjadi galeri digital terdepan yang tidak hanya memamerkan portofolio terbaik siswa, tetapi juga menginspirasi lahirnya karya-karya baru di lingkungan SMKN 4 Tasikmalaya.
                        </p>
                    </div>

                    <div class="mt-8 p-5 rounded-2xl bg-gradient-to-r from-blue-50/80 to-indigo-50/50 dark:from-blue-950/30 dark:to-indigo-950/20 border border-blue-100 dark:border-blue-900/40 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-sm font-bold text-slate-900 dark:text-white">Penasaran siapa saja yang membangun platform ini?</p>
                            <p class="text-xs text-slate-500 dark:text-gray-400 mt-0.5">Lihat profil dan peran dari masing-masing tim pengembang kami.</p>
                        </div>
                        <a href="#tim-kami" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium text-xs sm:text-sm transition-all shadow-sm hover:shadow-blue-500/25 shrink-0 active:scale-95">
                            Lihat Tim Pengembang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Ringkasan Statistik -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-10 pt-6 border-t border-slate-100 dark:border-gray-800/80 text-center sm:text-left">
                        <div>
                            <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 font-semibold">Mulai Pengerjaan</p>
                            <p class="text-sm sm:text-base font-bold text-slate-800 dark:text-white mt-0.5">28 Juni 2026</p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 font-semibold">Bentuk Proyek</p>
                            <p class="text-sm sm:text-base font-bold text-slate-800 dark:text-white mt-0.5">Kolaborasi Tim</p>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 font-semibold">Versi Sistem</p>
                            <p class="text-sm sm:text-base font-bold text-blue-600 dark:text-blue-400 mt-0.5">v1.0.0</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- ===== TIM KAMI ===== -->
            <section id="tim-kami" class="scroll-mt-24 pt-16 sm:pt-24 mx-auto max-w-5xl px-4 sm:px-6">
                
                <!-- Section Header -->
                <div class="mb-12 text-center max-w-xl mx-auto">
                    <span class="inline-block px-3 py-1 mb-3 text-[11px] font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/70 border border-indigo-100 dark:border-indigo-900/50 rounded-full">
                        Meet The Crew
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Tim Pengembang</h2>
                    <p class="text-slate-500 dark:text-gray-400 text-xs sm:text-sm mt-2">
                        Klik pada foto profil untuk melihat foto lebih jelas.
                    </p>
                </div>

                <!-- CARD GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">

                    <!-- DEV CARD 1 -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-slate-200/80 dark:border-gray-800/80 shadow-xs hover:shadow-lg hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full p-[3px] bg-gradient-to-br from-blue-500 to-indigo-500 cursor-pointer"
                             onclick="openAvatarModal('https://ui-avatars.com/api/?name=Rida+Masrifa&background=2563EB&color=FFFFFF&size=500', 'Rida Masrifa Hasbian')">
                            <img src="https://ui-avatars.com/api/?name=Rida+Masrifa&background=2563EB&color=FFFFFF&size=300"
                                alt="Foto Rida Masrifa"
                                class="w-full h-full rounded-full object-cover ring-2 ring-white dark:ring-gray-900" />
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white">Rida Masrifa Hasbian</h3>
                        <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 mt-0.5 mb-3">XII PPLG 1</p>
                        
                        <!-- Badge Role -->
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                            Backend Developer
                        </span>

                        <div class="grid grid-cols-2 gap-2 mt-5 pt-5 border-t border-slate-100 dark:border-gray-800/80">
                            <a href="https://github.com/Ridamasrifaa" target="_blank"
                                class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold border border-slate-300 dark:border-gray-700 text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                                GitHub
                            </a>
                            <a href="#" target="_blank"
                                class="py-2 rounded-lg text-xs font-semibold border border-blue-300 dark:border-blue-800 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/40 transition">
                                Portofolio
                            </a>
                        </div>
                    </div>

                    <!-- DEV CARD 2 -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-slate-200/80 dark:border-gray-800/80 shadow-xs hover:shadow-lg hover:shadow-sky-500/5 hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full p-[3px] bg-gradient-to-br from-sky-500 to-cyan-400 cursor-pointer"
                             onclick="openAvatarModal('https://ui-avatars.com/api/?name=Nama+Anggota3&background=7C3AED&color=FFFFFF&size=300', 'Zaki Nur Faizi')">
                            <img src="https://ui-avatars.com/api/?name=Zaki+Nur3&background=7C3AED&color=FFFFFF&size=300"
                                alt="Foto Zaki Nur Faizi"
                                class="w-full h-full rounded-full object-cover ring-2 ring-white dark:ring-gray-900" />
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white">Zaki Nur Faizi</h3>
                        <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 mt-0.5 mb-3">XII PPLG 2</p>

                        <!-- Badge Role -->
                        <div class="flex items-center justify-center gap-1.5 flex-wrap">
                            <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full bg-sky-100 text-sky-800 dark:bg-sky-900/50 dark:text-sky-300 border border-sky-200 dark:border-sky-800">
                                Frontend
                            </span>
                            <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                                Backend
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 mt-5 pt-5 border-t border-slate-100 dark:border-gray-800/80">
                            <a href="https://github.com/faizinurzaki12" target="_blank"
                                class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold border border-slate-300 dark:border-gray-700 text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                                GitHub
                            </a>
                            <a href="https://zackynurfazz.netlify.app" target="_blank"
                                class="py-2 rounded-lg text-xs font-semibold border border-sky-300 dark:border-sky-800 text-sky-600 dark:text-sky-400 hover:bg-sky-50 dark:hover:bg-sky-950/40 transition">
                                Portofolio
                            </a>
                        </div>
                    </div>

                    <!-- DEV CARD 3 -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-slate-200/80 dark:border-gray-800/80 shadow-xs hover:shadow-lg hover:shadow-purple-500/5 hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full p-[3px] bg-gradient-to-br from-purple-500 to-fuchsia-400 cursor-pointer"
                             onclick="openAvatarModal('https://ui-avatars.com/api/?name=Nama+Anggota3&background=7C3AED&color=FFFFFF&size=500', 'Nama Anggota 3')">
                            <img src="https://ui-avatars.com/api/?name=Salsa+Cantika&background=7C3AED&color=FFFFFF&size=300"
                                alt="Foto Anggota 3"
                                class="w-full h-full rounded-full object-cover ring-2 ring-white dark:ring-gray-900" />
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white">Salsa Cantika</h3>
                        <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 mt-0.5 mb-3">XII PPLG 1</p>

                        <!-- Badge Role -->
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300 border border-purple-200 dark:border-purple-800">
                            Frontend Developer
                        </span>

                        <div class="grid grid-cols-2 gap-2 mt-5 pt-5 border-t border-slate-100 dark:border-gray-800/80">
                            <a href="#" target="_blank"
                                class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold border border-slate-300 dark:border-gray-700 text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                                GitHub
                            </a>
                            <a href="#" target="_blank"
                                class="py-2 rounded-lg text-xs font-semibold border border-purple-300 dark:border-purple-800 text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-950/40 transition">
                                Portofolio
                            </a>
                        </div>
                    </div>

                    <!-- DEV CARD 4 -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-slate-200/80 dark:border-gray-800/80 shadow-xs hover:shadow-lg hover:shadow-pink-500/5 hover:-translate-y-1 transition-all duration-300 text-center lg:col-start-1 lg:translate-x-1/2">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full p-[3px] bg-gradient-to-br from-pink-500 to-rose-400 cursor-pointer"
                             onclick="openAvatarModal('https://ui-avatars.com/api/?name=Nama+Anggota4&background=DB2777&color=FFFFFF&size=500', 'Nama Anggota 4')">
                            <img src="https://ui-avatars.com/api/?name=Zahra+Afifah4&background=DB2777&color=FFFFFF&size=300"
                                alt="Foto Anggota 4"
                                class="w-full h-full rounded-full object-cover ring-2 ring-white dark:ring-gray-900" />
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white">Zahra Afifah Hifdillah</h3>
                        <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 mt-0.5 mb-3">XII PPLG 2</p>

                        <!-- Badge Role -->
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full bg-pink-100 text-pink-800 dark:bg-pink-900/50 dark:text-pink-300 border border-pink-200 dark:border-pink-800">
                            Frontend Developer
                        </span>

                        <div class="grid grid-cols-2 gap-2 mt-5 pt-5 border-t border-slate-100 dark:border-gray-800/80">
                            <a href="#" target="_blank"
                                class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold border border-slate-300 dark:border-gray-700 text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                                GitHub
                            </a>
                            <a href="#" target="_blank"
                                class="py-2 rounded-lg text-xs font-semibold border border-pink-300 dark:border-pink-800 text-pink-600 dark:text-pink-400 hover:bg-pink-50 dark:hover:bg-pink-950/40 transition">
                                Portofolio
                            </a>
                        </div>
                    </div>

                    <!-- DEV CARD 5 -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-slate-200/80 dark:border-gray-800/80 shadow-xs hover:shadow-lg hover:shadow-orange-500/5 hover:-translate-y-1 transition-all duration-300 text-center lg:col-start-2 lg:translate-x-1/2">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full p-[3px] bg-gradient-to-br from-orange-500 to-amber-400 cursor-pointer"
                             onclick="openAvatarModal('https://ui-avatars.com/api/?name=Nama+Anggota5&background=EA580C&color=FFFFFF&size=500', 'Nama Anggota 5')">
                            <img src="https://ui-avatars.com/api/?name=Nama+Anggota5&background=EA580C&color=FFFFFF&size=300"
                                alt="Foto Anggota 5"
                                class="w-full h-full rounded-full object-cover ring-2 ring-white dark:ring-gray-900" />
                        </div>
                        <h3 class="font-bold text-base text-slate-900 dark:text-white">All Raffi Ghani Iskandar</h3>
                        <p class="text-[11px] uppercase tracking-wider text-slate-400 dark:text-gray-500 mt-0.5 mb-3">XII PPLG 2</p>

                        <!-- Badge Role -->
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300 border border-orange-200 dark:border-orange-800">
                            Backend Developer
                        </span>

                        <div class="grid grid-cols-2 gap-2 mt-5 pt-5 border-t border-slate-100 dark:border-gray-800/80">
                            <a href="#" target="_blank"
                                class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-xs font-semibold border border-slate-300 dark:border-gray-700 text-slate-700 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                                GitHub
                            </a>
                            <a href="#" target="_blank"
                                class="py-2 rounded-lg text-xs font-semibold border border-orange-300 dark:border-orange-800 text-orange-600 dark:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-950/40 transition">
                                Portofolio
                            </a>
                        </div>
                    </div>

                </div>
            </section>

        </main>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="mt-16 border-t border-slate-200/80 dark:border-gray-800/80 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 text-center text-xs text-slate-500 dark:text-gray-400">
            <p>&copy; 2026 Museum Karya SMKN 4 Tasikmalaya. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- ===== AVATAR MODAL PREVIEW ===== -->
    <div id="avatarModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div id="modalContent" class="relative max-w-md w-full mx-4 bg-white dark:bg-gray-900 rounded-3xl p-8 border border-slate-200 dark:border-gray-800 shadow-2xl transform scale-95 transition-all duration-300 text-center">
            
            <!-- Tombol Close -->
            <button onclick="closeAvatarModal()" class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-600 dark:hover:text-white rounded-full bg-slate-100 dark:bg-gray-800 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Container Pratinjau Foto -->
            <div class="w-64 h-64 sm:w-72 sm:h-72 mx-auto mb-4 rounded-full overflow-hidden ring-4 ring-blue-500/30 shadow-lg">
                <img id="modalImage" src="" alt="" class="w-full h-full object-cover object-top" />
            </div>

            <h4 id="modalName" class="text-xl font-bold text-slate-900 dark:text-white"></h4>
            <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Foto Profil</p>
        </div>
    </div>

    <!-- ===== JAVASCRIPT LOGIC ===== -->
    <script>
        // Toggle Dark/Light Mode
        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Auto load saved theme preference
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Modal Handlers
        function openAvatarModal(imgSrc, devName) {
            const modal = document.getElementById('avatarModal');
            const modalImg = document.getElementById('modalImage');
            const modalName = document.getElementById('modalName');
            const modalContent = document.getElementById('modalContent');

            modalImg.src = imgSrc;
            modalName.textContent = devName;

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }

        function closeAvatarModal() {
            const modal = document.getElementById('avatarModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }

        // Close Modal via Backdrop Click
        document.getElementById('avatarModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAvatarModal();
            }
        });

        // Close Modal via Escape Key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAvatarModal();
            }
        });
    </script>

</body>
</html>