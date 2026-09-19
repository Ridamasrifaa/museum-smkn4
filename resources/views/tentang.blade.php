@extends('layouts.app')

@section('title', 'Tentang — Museum Karya SMKN 4 Tasikmalaya')
@section('body_class', 'bg-[#FFFDF5] dark:bg-zinc-950 text-slate-900 dark:text-zinc-100 transition-colors duration-300 antialiased min-h-screen flex flex-col')

@push('styles')
    <style>
        /* Background kotak-kotak, sama seperti halaman index */
        .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.06) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.06) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        /*
         * Kartu tim dirender oleh dev.js, jadi gayanya dipaksa dari sini
         * supaya ikut neo-brutalist tanpa mengubah dev.js.
         */
        #team-grid > * {
            background: #ffffff;
            color: #000000;
            border: 4px solid #000000;
            border-radius: 1.5rem;
            box-shadow: 6px 6px 0 #000000;
            transition: transform 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        #team-grid > *:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0 #000000;
        }
        #team-grid img {
            border: 3px solid #000000;
        }
        .dark #team-grid > * {
            background: #18181b;
            color: #f4f4f5;
            border-color: #ffffff;
            box-shadow: 6px 6px 0 #ffffff;
        }
        .dark #team-grid > *:hover {
            box-shadow: 9px 9px 0 #ffffff;
        }
        .dark #team-grid img {
            border-color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <div class="flex-grow bg-grid-pattern">

        <!-- ===== MAIN CONTENT CONTAINER ===== -->
        <main class="py-10 sm:py-14">

            <!-- ===== HERO ===== -->
            <section class="pb-10 text-center">
                <div class="mx-auto max-w-4xl px-4 sm:px-6">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 mb-6 text-xs font-black uppercase tracking-wider text-black bg-[#88D498] border-3 border-black dark:border-white rounded-full shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                        <span class="w-2 h-2 rounded-full bg-black animate-pulse"></span>
                        Informasi Proyek
                    </span>
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black uppercase leading-tight tracking-tight text-black dark:text-white mb-6">
                        Tentang
                        <span class="inline-block mt-2 bg-[#FFD23F] text-black px-4 py-1 border-4 border-black dark:border-white rounded-2xl shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] -rotate-1">Museum Karya</span>
                    </h1>
                    <p class="text-zinc-700 dark:text-zinc-300 font-bold text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                        Mengenal latar belakang pengerjaan proyek, tujuan pengembangannya, dan talenta berbakat di balik platform ini.
                    </p>
                </div>
            </section>

            <!-- ===== TENTANG PROYEK ===== -->
            <section id="tentang-proyek" class="mx-auto max-w-4xl px-4 sm:px-6">
                <div class="bg-white dark:bg-zinc-900 rounded-3xl p-6 sm:p-10 border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] transition-colors duration-300">

                    <div class="space-y-4 sm:space-y-6 text-slate-800 dark:text-zinc-200 font-bold leading-relaxed text-sm sm:text-base">
                        <p>
                            <strong class="font-black text-black dark:text-white">Museum Karya</strong> hadir sebagai wadah digital terintegrasi yang dirancang khusus untuk menampung, mendokumentasikan, dan mempublikasikan berbagai hasil karya siswa-siswi SMKN 4 Tasikmalaya. Potensi kreativitas dan inovasi yang dihasilkan oleh para siswa sangat kaya, sehingga sangat disayangkan apabila karya-karya luar biasa tersebut hanya tersimpan tanpa sempat diapresiasi secara luas.
                        </p>
                        <p>
                            Platform ini dikembangkan melalui <span class="bg-[#74B9FF] text-black font-black px-1.5 py-0.5 rounded-md border-2 border-black box-decoration-clone">kolaborasi antar tim pengembang</span> yang mulai dikerjakan secara intensif pada tanggal <span class="bg-[#FFD23F] text-black font-black px-1.5 py-0.5 rounded-md border-2 border-black box-decoration-clone">28 Juni 2026</span>. Melalui kolaborasi ini, diharapkan Museum Karya dapat menjadi galeri digital terdepan yang tidak hanya memamerkan portofolio terbaik siswa, tetapi juga menginspirasi lahirnya karya-karya baru di lingkungan SMKN 4 Tasikmalaya.
                        </p>
                    </div>

                    <div class="mt-8 p-5 rounded-2xl bg-[#74B9FF]/30 dark:bg-sky-900/30 border-3 border-black dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-sm sm:text-base font-black text-black dark:text-white">Penasaran siapa saja yang membangun platform ini?</p>
                            <p class="text-xs font-bold text-zinc-700 dark:text-zinc-300 mt-0.5">Lihat profil dan peran dari masing-masing tim pengembang kami.</p>
                        </div>
                        <a href="#tim-kami" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-[#FFD23F] text-black font-black text-xs sm:text-sm border-3 border-black dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[6px_6px_0px_#000] dark:hover:shadow-[6px_6px_0px_#fff] active:translate-x-0.5 active:translate-y-0.5 active:shadow-[1px_1px_0px_#000] dark:active:shadow-[1px_1px_0px_#fff] transition-all shrink-0">
                            Lihat Tim Pengembang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Ringkasan Statistik -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-10 pt-8 border-t-4 border-dashed border-black dark:border-white">
                        <div class="bg-[#88D498] text-black border-3 border-black dark:border-white rounded-2xl p-4 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                            <p class="text-[11px] uppercase tracking-wider font-black text-black/70">Mulai Pengerjaan</p>
                            <p class="text-base sm:text-lg font-black mt-1">28 Juni 2026</p>
                        </div>
                        <div class="bg-[#FFA552] text-black border-3 border-black dark:border-white rounded-2xl p-4 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                            <p class="text-[11px] uppercase tracking-wider font-black text-black/70">Bentuk Proyek</p>
                            <p class="text-base sm:text-lg font-black mt-1">Kolaborasi Tim</p>
                        </div>
                        <div class="col-span-2 sm:col-span-1 bg-[#B8A9FA] text-black border-3 border-black dark:border-white rounded-2xl p-4 shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                            <p class="text-[11px] uppercase tracking-wider font-black text-black/70">Versi Sistem</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span id="app-version" class="text-base sm:text-lg font-black">v1.0.0</span>
                                <button onclick="openChangelogModal()" class="text-[11px] px-2.5 py-1 rounded-lg bg-white text-black border-2 border-black shadow-[2px_2px_0px_#000] hover:bg-[#FFD23F] active:translate-y-px transition cursor-pointer font-black">
                                    Riwayat Update
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- ===== TIM KAMI ===== -->
            <section id="tim-kami" class="scroll-mt-28 pt-16 sm:pt-24 mx-auto max-w-5xl px-4 sm:px-6">

                <!-- Section Header -->
                <div class="mb-12 text-center max-w-xl mx-auto">
                    <span class="inline-block px-4 py-1.5 mb-4 text-[11px] font-black uppercase tracking-widest text-black bg-[#B8A9FA] border-3 border-black dark:border-white rounded-full shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                        Meet The Crew
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black uppercase tracking-tight text-black dark:text-white">Tim Pengembang</h2>
                    <p class="text-zinc-700 dark:text-zinc-300 font-bold text-xs sm:text-sm mt-3">
                        Klik pada foto profil untuk melihat foto lebih jelas.
                    </p>
                </div>

                <!-- CARD GRID (Rendered via dev.js / Static markup) -->
                <div id="team-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
                    <!-- Placeholder untuk dynamic dev grid atau komponen statis -->
                </div>
            </section>

        </main>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-zinc-900 text-white text-center py-8 border-t-3 border-zinc-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <p class="text-xs font-bold">&copy; {{ date('Y') }} Museum Karya SMKN 4 Tasikmalaya</p>
            <p class="text-xs font-bold text-cyan-300 mt-1">Design &amp; Development By PPLG</p>
        </div>
    </footer>

    <!-- ===== AVATAR MODAL PREVIEW ===== -->
    <div id="avatarModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-300">
        <div id="modalContent" class="relative max-w-md w-full mx-4 bg-white dark:bg-zinc-900 rounded-3xl p-8 border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] transform scale-95 transition-all duration-300 text-center">

            <button onclick="closeAvatarModal()" aria-label="Tutup" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center bg-[#FF6B6B] text-black font-black border-3 border-black rounded-xl shadow-[3px_3px_0px_#000] hover:bg-white active:translate-x-px active:translate-y-px transition cursor-pointer">
                ✕
            </button>

            <div class="w-64 h-64 sm:w-72 sm:h-72 mx-auto mb-6 mt-4 rounded-full overflow-hidden bg-[#FFD23F] border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff]">
                <img id="modalImage" src="" alt="" class="w-full h-full object-cover object-top" />
            </div>

            <h4 id="modalName" class="text-xl font-black uppercase text-black dark:text-white"></h4>
            <span class="inline-block mt-2 px-3 py-1 text-[11px] font-black uppercase tracking-wider text-black bg-[#74B9FF] border-2 border-black rounded-lg shadow-[2px_2px_0px_#000]">Foto Profil</span>
        </div>
    </div>

    <!-- ===== CHANGELOG / RIWAYAT UPDATE MODAL ===== -->
    <div id="changelogModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-300">
        <div id="changelogContent" class="relative max-w-lg w-full mx-4 bg-white dark:bg-zinc-900 rounded-3xl border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] transform scale-95 transition-all duration-300 max-h-[80vh] flex flex-col overflow-hidden">

            <div class="px-6 py-4 bg-[#FFD23F] border-b-4 border-black dark:border-white flex items-center justify-between gap-4">
                <h3 class="text-lg font-black uppercase text-black">Riwayat Pembaruan</h3>
                <button onclick="closeChangelogModal()" aria-label="Tutup" class="w-10 h-10 shrink-0 flex items-center justify-center bg-[#FF6B6B] text-black font-black border-3 border-black rounded-xl shadow-[3px_3px_0px_#000] hover:bg-white active:translate-x-px active:translate-y-px transition cursor-pointer">
                    ✕
                </button>
            </div>

            <div class="p-6 sm:p-8 flex flex-col min-h-0">
                <p class="text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-4 pb-3 border-b-2 border-dashed border-black dark:border-white">Catatan versi dan log perubahan aplikasi Museum Karya.</p>

                <div id="changelogList" class="overflow-y-auto space-y-6 pr-1">
                    <!-- Rendered dynamically by app.js -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Pemanggilan File JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/dev.js') }}"></script>

    <!-- ===== JAVASCRIPT LOCAL LOGIC ===== -->
    <script>

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
@endpush