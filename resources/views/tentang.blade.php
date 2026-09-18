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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
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
                            <div class="flex items-center justify-center sm:justify-start gap-2 mt-0.5">
                                <span id="app-version" class="text-sm sm:text-base font-bold text-blue-600 dark:text-blue-400">v1.0.0</span>
                                <button onclick="openChangelogModal()" class="text-[11px] px-2 py-0.5 rounded-md bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-300 border border-blue-200 dark:border-blue-800 hover:bg-blue-100 transition cursor-pointer font-medium">
                                    Riwayat Update
                                </button>
                            </div>
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
                <div id="team-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                    <!-- team developer (render via dev.js) -->
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
            <button onclick="closeAvatarModal()" class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-600 dark:hover:text-white rounded-full bg-slate-100 dark:bg-gray-800 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="w-64 h-64 sm:w-72 sm:h-72 mx-auto mb-4 rounded-full overflow-hidden ring-4 ring-blue-500/30 shadow-lg">
                <img id="modalImage" src="" alt="" class="w-full h-full object-cover object-top" />
            </div>
            <h4 id="modalName" class="text-xl font-bold text-slate-900 dark:text-white"></h4>
            <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Foto Profil</p>
        </div>
    </div>

    <!-- ===== CHANGELOG / RIWAYAT UPDATE MODAL ===== -->
    <div id="changelogModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div id="changelogContent" class="relative max-w-lg w-full mx-4 bg-white dark:bg-gray-900 rounded-3xl p-6 sm:p-8 border border-slate-200 dark:border-gray-800 shadow-2xl transform scale-95 transition-all duration-300 max-h-[80vh] flex flex-col">
            <button onclick="closeChangelogModal()" class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-600 dark:hover:text-white rounded-full bg-slate-100 dark:bg-gray-800 transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Riwayat Pembaruan</h3>
            <p class="text-xs text-slate-500 dark:text-gray-400 mb-4 pb-3 border-b border-slate-100 dark:border-gray-800">Catatan versi dan log perubahan aplikasi Museum Karya.</p>
            
            <div id="changelogList" class="overflow-y-auto space-y-6 pr-1">
                <!-- Rendered dynamically by app.js -->
            </div>
        </div>
    </div>

    <!-- Pemanggilan File JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/dev.js') }}"></script>

    <!-- ===== JAVASCRIPT LOCAL LOGIC ===== -->
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

        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Avatar Modal Handlers
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

        // Changelog Modal Handlers
        function openChangelogModal() {
            const modal = document.getElementById('changelogModal');
            const modalContent = document.getElementById('changelogContent');

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }

        function closeChangelogModal() {
            const modal = document.getElementById('changelogModal');
            const modalContent = document.getElementById('changelogContent');

            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }

        // Close Modals via Backdrop Click
        document.getElementById('avatarModal').addEventListener('click', function(e) {
            if (e.target === this) closeAvatarModal();
        });
        document.getElementById('changelogModal').addEventListener('click', function(e) {
            if (e.target === this) closeChangelogModal();
        });

        // Close Modals via Escape Key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAvatarModal();
                closeChangelogModal();
            }
        });
    </script>

</body>
</html>