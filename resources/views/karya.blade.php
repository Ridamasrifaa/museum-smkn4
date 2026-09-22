<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Semua Karya - Museum Karya SMKN 4 Tasikmalaya</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/karya.css') }}">
    <style>
        .icon-moon { display: block; }
        .icon-sun { display: none; }
        .dark .icon-moon { display: none; }
        .dark .icon-sun { display: block; }
        .card-filtered-out { display: none !important; }
    </style>
</head>
<body class="scroll-smooth bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    <header class="navbar shadow-sm sticky top-0 z-50 bg-white dark:bg-gray-900 transition-colors duration-300">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1 items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                    <img src="{{ asset('images/smk4.png') }}" alt="Logo Museum" class="w-10 h-10 rounded-full object-cover">
                </div>
                <span class="text-2xl font-bold text-blue-600">Museum Karya</span>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3 lg:gap-x-8 lg:justify-end lg:items-center">
                <a href="{{ url('/') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Beranda</a>
                <a href="{{ url('/karya') }}"
                    class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Karya</a>
                <a href="{{ url('/artikel') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Artikel</a>
                <a href="{{ url('/tentang') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Tentang</a>
                <a href="{{ route('login') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Login</a>
                <button id="themeToggle" onclick="toggleTheme()" aria-label="Ganti mode terang/gelap"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-yellow-300">
                    <svg class="icon-sun w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="icon-moon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <section class="my-bg text-white py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
            <h1 class="text-3xl lg:text-5xl font-bold mb-4">Semua Karya</h1>
        </div>
    </section>

    <section id="karya" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mb-10">
                <div class="relative max-w-xl mx-auto mb-6">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input id="searchInput" type="text" placeholder="Ketik judul, nama siswa, deskripsi...."
                        class="w-full pl-12 pr-4 py-4 rounded-full border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:focus:border-blue-400 shadow-sm transition" />
                </div>

                <div class="flex flex-wrap items-center justify-center gap-2 mb-4">
                    <button data-filter="all"
                        class="filter-pill active flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border-2 transition">
                        Semua
                    </button>
                    <button data-filter="pplg"
                        class="filter-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border-2 transition">
                        <img src="{{ asset('assets/img/pplg.jpeg') }}" alt="Logo PPLG"
                            class="w-4 h-4 rounded-full object-cover">
                        PPLG
                    </button>
                    <button data-filter="dkv"
                        class="filter-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border-2 transition">
                        <img src="{{ asset('assets/img/dkv.jpeg') }}" alt="Logo DKV"
                            class="w-4 h-4 rounded-full object-cover">
                        DKV
                    </button>
                    <button data-filter="toi"
                        class="filter-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border-2 transition">
                        <img src="{{ asset('assets/img/toi.jpeg') }}" alt="Logo TOI"
                            class="w-4 h-4 rounded-full object-cover">
                        TOI
                    </button>
                </div>

                <p id="resultCounter" class="text-center text-sm text-gray-500 dark:text-gray-400"></p>
            </div>

            <div id="allKaryaGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($karyas as $karya)
                    <div class="karya-card bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col group"
                        data-title="{{ $karya->title }}"
                        data-desc="{{ $karya->description }}"
                        data-category="{{ $karya->jurusan ?? '-' }}"
                        data-event="Museum Karya"
                        data-siswa="{{ $karya->user->name ?? '-' }}"
                        data-guru="{{ $karya->guru_pengampu ?? '-' }}"
                        data-avatar="{{ $karya->user->avatar ?? '' }}"
                        data-avatar-letter="{{ strtoupper(substr($karya->user->name ?? '-', 0, 1)) }}"
                        data-kelas="{{ $karya->user->kelas ?? '-' }}"
                        data-jurusan-siswa="{{ $karya->user->jurusan ?? '-' }}"
                        data-angkatan="{{ $karya->user->angkatan ?? '-' }}"
                        data-tahun="{{ $karya->created_at ? $karya->created_at->format('Y') : '-' }}"
                        data-tech="{{ $karya->technology_stack ?? '-' }}"
                        data-live="{{ $karya->live_link ?? '' }}"
                        data-github="{{ $karya->github_link ?? '' }}"
                        data-file-path="{{ $karya->file_path ? asset('storage/' . $karya->file_path) : '' }}"
                        data-file-type="{{ $karya->file_type ?? '' }}"
                        data-views="{{ $karya->views_count ?? 0 }}"
                        data-likes="{{ $karya->likes_count ?? 0 }}">

                        <div class="relative h-48 w-full overflow-hidden bg-gray-100 dark:bg-gray-700 cursor-pointer" onclick="openModal(this.closest('.karya-card'))">
                            @if ($karya->file_path)
                                <img src="{{ asset('storage/' . $karya->file_path) }}" alt="{{ $karya->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            @elseif ($karya->live_link)
                                <iframe src="{{ $karya->live_link }}" loading="lazy" class="w-full h-full pointer-events-none border-0"></iframe>
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 dark:text-gray-500 text-sm">
                                    Tidak ada Preview
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-300 text-xs font-semibold rounded-full uppercase tracking-wider">
                                    {{ $karya->jurusan ?? 'Umum' }}
                                </span>
                            </div>

                            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1 line-clamp-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $karya->title }}
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-1">
                                Oleh: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $karya->user->name ?? 'Anonim' }}</span>
                            </p>

                            <div class="mt-auto">
                                <button onclick="openModal(this.closest('.karya-card'))"
                                    class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <h2 class="text-2xl font-bold text-gray-500 dark:text-gray-400">Belum ada karya.</h2>
                    </div>
                @endforelse
            </div>

            <div id="emptyState" class="hidden text-center py-16">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Tidak ada karya ditemukan</h3>
                <p class="text-gray-600 dark:text-gray-400">Coba ubah kata kunci atau filter kategori Anda</p>
            </div>
            <div id="paginationContainer" class="mt-12 flex justify-center items-center gap-2"></div>

        </div>
    </section>

    <footer class="bg-gray-900 dark:bg-black text-white text-center py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="border-t border-gray-800 pt-8">
                <p class="text-gray-400 text-sm">&copy; 2026 Museum Karya SMKN 4 Tasikmalaya</p>
                <p class="text-gray-400 text-sm">Design &amp; Development By PPLG</p>
            </div>
        </div>
    </footer>

    {{-- ===== MODAL DETAIL ===== --}}
    <div id="detailModal" class="fixed inset-0 bg-black/60 z-50 hidden backdrop-blur-sm">
        <div class="flex items-center justify-center min-h-screen p-4 w-full">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transition-colors duration-300 border border-gray-100 dark:border-gray-800">
                <div class="sticky top-0 px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-white dark:bg-gray-900 z-10">
                    <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white"></h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Preview Media --}}
                    <div id="modalMediaPreview" class="w-full h-64 sm:h-80 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center">
                    </div>

                    {{-- Badge --}}
                    <div class="flex gap-2 flex-wrap">
                        <span class="inline-block bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 px-3 py-1 rounded-full text-xs font-semibold">
                            Disetujui
                        </span>
                        <span id="modalCategory"
                            class="inline-block bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full text-xs font-semibold"></span>
                        <span id="modalEvent"
                            class="inline-block bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300 px-3 py-1 rounded-full text-xs font-semibold"></span>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Deskripsi</h4>
                        <p id="modalDescription" class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm"></p>
                    </div>

                    {{-- AVATAR + BIODATA SISWA --}}
                    <div class="bg-gray-50 dark:bg-gray-800/60 p-4 rounded-xl border border-gray-100 dark:border-gray-700/50">
                        <div class="flex items-center gap-3">
                            <div id="modalAvatar"
                                class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg overflow-hidden shrink-0">
                            </div>
                            <div class="min-w-0">
                                <p id="modalSiswa" class="font-semibold text-gray-900 dark:text-white truncate"></p>
                                <p id="modalBiodata" class="text-sm text-gray-600 dark:text-gray-400"></p>
                                <p id="modalGuru" class="text-sm text-gray-500 dark:text-gray-500 mt-0.5"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Info tambahan --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 dark:bg-gray-800/60 p-4 rounded-xl border border-gray-100 dark:border-gray-700/50">
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Kategori</p>
                            <p id="modalKategoriDetail" class="font-semibold text-gray-900 dark:text-white text-sm"></p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-800/60 p-4 rounded-xl border border-gray-100 dark:border-gray-700/50">
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Tahun</p>
                            <p id="modalTahun" class="font-semibold text-gray-900 dark:text-white text-sm"></p>
                        </div>
                    </div>

                    {{-- Teknologi --}}
                    <div class="bg-gray-50 dark:bg-gray-800/60 p-4 rounded-xl border border-gray-100 dark:border-gray-700/50">
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Teknologi</p>
                        <p id="modalTech" class="font-semibold text-gray-900 dark:text-white text-sm"></p>
                    </div>

                    {{-- Container Tombol Dinamis --}}
                    <div id="actionButtonsContainer" class="pt-4 border-t border-gray-200 dark:border-gray-700 flex flex-wrap gap-3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ===== Dark / Light Mode =====
        function applyTheme(theme) {
            document.documentElement.classList.toggle("dark", theme === "dark");
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.contains("dark");
            const next = isDark ? "light" : "dark";
            localStorage.setItem("theme", next);
            applyTheme(next);
        }

        (function initTheme() {
            const saved = localStorage.getItem("theme");
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
            applyTheme(saved || (prefersDark ? "dark" : "light"));
        })();

        // ===== Modal =====
        function openModal(card) {
            if (!card) return;
            const d = card.dataset;

            if (document.getElementById("modalTitle")) document.getElementById("modalTitle").textContent = d.title || "";
            if (document.getElementById("modalCategory")) document.getElementById("modalCategory").textContent = d.category || "";
            if (document.getElementById("modalEvent")) document.getElementById("modalEvent").textContent = d.event || "";
            if (document.getElementById("modalDescription")) document.getElementById("modalDescription").textContent = d.desc || "";
            if (document.getElementById("modalKategoriDetail")) document.getElementById("modalKategoriDetail").textContent = d.category || "";
            if (document.getElementById("modalTahun")) document.getElementById("modalTahun").textContent = d.tahun || "";
            if (document.getElementById("modalTech")) document.getElementById("modalTech").textContent = d.tech || "";
            
            // ===== Render Tombol Aksi =====
            const actionContainer = document.getElementById("actionButtonsContainer");
            if (actionContainer) {
                actionContainer.innerHTML = "";
                let hasButton = false;

                if (d.github) {
                    hasButton = true;
                    actionContainer.innerHTML += `
                        <a href="${d.github}" target="_blank" class="flex-1 min-w-[140px] px-4 py-3 bg-gray-800 hover:bg-gray-900 text-white rounded-xl font-semibold transition text-center text-sm shadow-md flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            Repository GitHub
                        </a>`;
                }

                if (d.live) {
                    hasButton = true;
                    actionContainer.innerHTML += `
                        <a href="${d.live}" target="_blank" class="flex-1 min-w-[140px] px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition text-center text-sm shadow-md">
                            Buka Live
                        </a>`;
                }

                if (!d.github && !d.live && d.filePath) {
                    hasButton = true;
                    actionContainer.innerHTML += `
                        <a href="${d.filePath}" target="_blank" class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition text-center text-sm shadow-md">
                            Lihat Berkas / Karya Full
                        </a>`;
                }

                actionContainer.classList.toggle("hidden", !hasButton);
            }

            // ===== Render Preview Media =====
            const mediaPreview = document.getElementById("modalMediaPreview");
            if (mediaPreview) {
                if (d.filePath) {
                    mediaPreview.innerHTML = `<img src="${d.filePath}" alt="${d.title}" class="w-full h-full object-contain bg-black/10" />`;
                } else if (d.live) {
                    mediaPreview.innerHTML = `<iframe src="${d.live}" class="w-full h-full border-0 rounded-xl" loading="lazy"></iframe>`;
                } else {
                    mediaPreview.innerHTML = `<span class="text-gray-400 dark:text-gray-500 text-sm">Tidak ada preview media</span>`;
                }
            }

            // ===== Avatar =====
            const modalAvatar = document.getElementById("modalAvatar");
            if (modalAvatar) {
                modalAvatar.innerHTML = "";
                if (d.avatar) {
                    const img = document.createElement("img");
                    img.src = d.avatar;
                    img.alt = d.siswa || "Avatar";
                    img.className = "w-full h-full object-cover";
                    img.onerror = function () {
                        modalAvatar.innerHTML = "";
                        modalAvatar.textContent = d.avatarLetter || (d.siswa ? d.siswa.charAt(0).toUpperCase() : "U");
                        modalAvatar.classList.add("bg-blue-600", "text-white");
                    };
                    modalAvatar.appendChild(img);
                    modalAvatar.classList.remove("bg-blue-600", "text-white");
                } else {
                    modalAvatar.textContent = d.avatarLetter || (d.siswa ? d.siswa.charAt(0).toUpperCase() : "U");
                    modalAvatar.classList.add("bg-blue-600", "text-white");
                }
            }

            if (document.getElementById("modalSiswa")) document.getElementById("modalSiswa").textContent = d.siswa || "-";

            const modalBiodata = document.getElementById("modalBiodata");
            if (modalBiodata) {
                const parts = [];
                if (d.kelas && d.kelas !== "-") parts.push(d.kelas);
                if (d.jurusanSiswa && d.jurusanSiswa !== "-") parts.push(d.jurusanSiswa);
                if (d.angkatan && d.angkatan !== "-") parts.push("Angkatan " + d.angkatan);
                modalBiodata.textContent = parts.length ? parts.join(" • ") : "-";
            }

            if (document.getElementById("modalGuru")) {
                document.getElementById("modalGuru").textContent = d.guru && d.guru !== "-" ? "Guru: " + d.guru : "";
            }

            const modal = document.getElementById("detailModal");
            if (modal) modal.classList.remove("hidden");
        }

        function closeModal() {
            const modal = document.getElementById("detailModal");
            if (modal) {
                modal.classList.add("hidden");
                const mediaPreview = document.getElementById("modalMediaPreview");
                if (mediaPreview) mediaPreview.innerHTML = "";
            }
        }

        document.getElementById("detailModal")?.addEventListener("click", (e) => {
            if (e.target.id === "detailModal") closeModal();
        });

        // ===== Pencarian, Filter Kategori, & Pagination =====
        const searchInput = document.getElementById("searchInput");
        const filterPills = document.querySelectorAll(".filter-pill");
        const allCards = Array.from(document.querySelectorAll(".karya-card"));
        const resultCounter = document.getElementById("resultCounter");
        const emptyState = document.getElementById("emptyState");
        const paginationContainer = document.getElementById("paginationContainer");

        let activeCategory = "all";
        let currentPage = 1;
        
        // ===== DIUBAH KE 16 KARYA PER HALAMAN =====
        const itemsPerPage = 16; 
        
        let filteredCards = [];

        function normalize(text) {
            return (text || "").toLowerCase();
        }

        function runFilter() {
            const query = normalize(searchInput?.value.trim() || "");

            // Filter elemen
            filteredCards = allCards.filter((card) => {
                const d = card.dataset;
                const haystack = normalize(`${d.title} ${d.siswa} ${d.tech} ${d.category} ${d.desc}`);
                const matchesQuery = query === "" || haystack.includes(query);
                const matchesCategory = activeCategory === "all" || normalize(d.category) === normalize(activeCategory);
                return matchesQuery && matchesCategory;
            });

            currentPage = 1; // Reset ke halaman 1 tiap kali memfilter
            renderPage();
        }

        function renderPage() {
            const totalItems = filteredCards.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;

            if (currentPage > totalPages) currentPage = totalPages;

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            // Sembunyikan semua card
            allCards.forEach(card => card.classList.add("card-filtered-out"));

            // Tampilkan hanya card yang berada di rentang item halaman saat ini
            const currentSlice = filteredCards.slice(startIndex, endIndex);
            currentSlice.forEach(card => card.classList.remove("card-filtered-out"));

            // Update Teks Info Jumlah
            if (resultCounter) {
                resultCounter.textContent = totalItems === allCards.length
                    ? `Menampilkan ${currentSlice.length} dari ${totalItems} karya`
                    : `Ditemukan ${totalItems} karya (${currentSlice.length} ditampilkan)`;
            }

            // Update Empty State
            if (emptyState) {
                emptyState.classList.toggle("hidden", totalItems > 0);
            }

            // Render Navigasi Pagination
            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            if (!paginationContainer) return;
            paginationContainer.innerHTML = "";

            if (totalPages <= 1) return; // Sembunyikan jika hanya 1 halaman

            // Tombol Prev
            const prevBtn = document.createElement("button");
            prevBtn.textContent = "«";
            prevBtn.className = `px-3.5 py-2 rounded-lg text-sm font-semibold border transition ${currentPage === 1 ? 'opacity-40 cursor-not-allowed border-gray-300' : 'hover:bg-blue-600 hover:text-white border-gray-300 dark:border-gray-700'}`;
            prevBtn.disabled = currentPage === 1;
            prevBtn.onclick = () => { if (currentPage > 1) { currentPage--; renderPage(); window.scrollTo({top: 400, behavior: 'smooth'}); } };
            paginationContainer.appendChild(prevBtn);

            // Tombol Halaman Angka
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement("button");
                pageBtn.textContent = i;
                const isActive = i === currentPage;
                pageBtn.className = `px-3.5 py-2 rounded-lg text-sm font-semibold border transition ${isActive ? 'bg-blue-600 text-white border-blue-600' : 'hover:bg-blue-50 dark:hover:bg-gray-800 border-gray-300 dark:border-gray-700'}`;
                pageBtn.onclick = () => { currentPage = i; renderPage(); window.scrollTo({top: 400, behavior: 'smooth'}); };
                paginationContainer.appendChild(pageBtn);
            }

            // Tombol Next
            const nextBtn = document.createElement("button");
            nextBtn.textContent = "»";
            nextBtn.className = `px-3.5 py-2 rounded-lg text-sm font-semibold border transition ${currentPage === totalPages ? 'opacity-40 cursor-not-allowed border-gray-300' : 'hover:bg-blue-600 hover:text-white border-gray-300 dark:border-gray-700'}`;
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.onclick = () => { if (currentPage < totalPages) { currentPage++; renderPage(); window.scrollTo({top: 400, behavior: 'smooth'}); } };
            paginationContainer.appendChild(nextBtn);
        }

        if (searchInput) searchInput.addEventListener("input", runFilter);

        filterPills.forEach((pill) => {
            pill.addEventListener("click", () => {
                filterPills.forEach((p) => p.classList.remove("active"));
                pill.classList.add("active");
                activeCategory = pill.dataset.filter;
                runFilter();
            });
        });

        // Inisialisasi awal
        runFilter();
    </script>
</body>
</html>