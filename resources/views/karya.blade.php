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
        /* Icon toggle mode terang/gelap: disamakan dengan halaman index dan artikel */
        .icon-moon {
            display: block;
        }

        .icon-sun {
            display: none;
        }

        .dark .icon-moon {
            display: none;
        }

        .dark .icon-sun {
            display: block;
        }
    </style>
</head>

<body class="scroll-smooth bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <header class="navbar shadow-sm sticky top-0 z-50 bg-white dark:bg-gray-900 transition-colors duration-300">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1 items-center gap-2">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                    🏛️</div>
                <span class="text-2xl font-bold text-blue-600">Museum Karya</span>
            </div>
            <div class="hidden lg:flex lg:gap-x-8 lg:items-center">
                <a href="{{ url('/') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Beranda</a>
                <a href="{{ url('/karya') }}"
                    class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Karya</a>
                <a href="{{ url('/artikel') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Artikel</a>
                <a href="{{ url('/login') }}"
                    class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">Login</a>
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

    <section class="my-bg text-white py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
            <h1 class="text-3xl lg:text-5xl font-bold mb-4">📚 Semua Karya</h1>
            <p class="text-lg text-gray-100">Jelajahi seluruh koleksi karya siswa Teaching Factory (Tefa)</p>
        </div>
    </section>

    <section id="karya" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Search & Filter (unik: live search + pill kategori + counter) -->
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

                    <button data-filter="tkj"
                        class="filter-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border-2 transition">
                        <img src="{{ asset('assets/img/tkj.jpeg') }}" alt="Logo TKJ"
                            class="w-4 h-4 rounded-full object-cover">
                        TKJ
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

                    <button data-filter="tsm"
                        class="filter-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border-2 transition">
                        <img src="{{ asset('assets/img/tsm.jpeg') }}" alt="Logo TSM"
                            class="w-4 h-4 rounded-full object-cover">
                        TSM
                    </button>
                </div>

                <p id="resultCounter" class="text-center text-sm text-gray-500 dark:text-gray-400"></p>
            </div>

            <div id="allKaryaGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                @forelse($karyas as $karya)
                    <div class="karya-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md card-hover transition-colors duration-300"
                        data-title="{{ $karya->title }}" data-desc="{{ $karya->description }}"
                        data-category="{{ $karya->jurusan ?? '-' }}" data-event="Museum Karya"
                        data-siswa="{{ $karya->user->name ?? '-' }}" data-guru="{{ $karya->guru_pengampu ?? '-' }}"
                        data-avatar="{{ strtoupper(substr($karya->user->name ?? '-', 0, 1)) }}"
                        data-tahun="{{ $karya->created_at->format('Y') }}"
                        data-tech="{{ $karya->technology_stack ?? '-' }}" data-live="{{ $karya->live_link ?? '' }}"
                        data-file-path="{{ $karya->file_path ? asset('storage/' . $karya->file_path) : '' }}"
                        data-file-type="{{ $karya->file_type ?? '' }}" data-views="{{ $karya->views_count ?? 0 }}"
                        data-likes="{{ $karya->likes_count ?? 0 }}">

                        {{-- Preview: disamakan persis dengan logika iframe di index.blade.php --}}
                        <div class="iframe-container" onclick="openModal(this.closest('.karya-card'))">
                            @php
                                $isImage = $karya->file_path && str_starts_with($karya->file_type ?? '', 'image/');
                            @endphp

                            @if ($isImage)
                                <img src="{{ asset('storage/' . $karya->file_path) }}" alt="{{ $karya->title }}"
                                    class="w-full h-full object-cover" />
                            @elseif ($karya->live_link)
                                <iframe src="{{ $karya->live_link }}" loading="lazy"></iframe>
                            @else
                                <div class="flex items-center justify-center h-full bg-gray-200">
                                    Tidak ada Preview
                                </div>
                            @endif

                            <div class="overlay"></div>

                        </div>

                        <div class="p-6">

                            <span class="badge-custom mb-3">
                                {{ $karya->jurusan ?? '-' }}
                            </span>

                            <p class="text-gray-600 text-sm mt-2">
                                <strong>{{ $karya->user->name ?? '-' }}</strong>
                            </p>

                            <p class="font-semibold mb-4">
                                {{ $karya->title }}
                            </p>

                            <button onclick="openModal(this.closest('.karya-card'))"
                                class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                                Lihat Detail
                            </button>

                        </div>

                    </div>

                @empty

                    <div class="col-span-4 text-center py-20">

                        <h2 class="text-2xl font-bold">
                            Belum ada karya.
                        </h2>

                    </div>
                @endforelse

            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Tidak ada karya ditemukan</h3>
                <p class="text-gray-600 dark:text-gray-400">Coba ubah kata kunci atau filter kategori Anda</p>
            </div>
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

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4 w-full">
            <div
                class="bg-white dark:bg-gray-900 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transition-colors duration-300">
                <div
                    class="sticky top-0 px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-white dark:bg-gray-900">
                    <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white"></h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <div class="flex gap-2 flex-wrap">
                        <span
                            class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-3 py-1 rounded-full text-sm font-semibold">✅
                            Disetujui</span>
                        <span id="modalCategory"
                            class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm font-semibold"></span>
                        <span id="modalEvent"
                            class="inline-block bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full text-sm font-semibold"></span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Deskripsi</h4>
                        <p id="modalDescription" class="text-gray-700 dark:text-gray-300 leading-relaxed"></p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div id="modalAvatar"
                                class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            </div>
                            <div>
                                <p id="modalSiswa" class="font-semibold text-gray-900 dark:text-white"></p>
                                <p id="modalGuru" class="text-sm text-gray-600 dark:text-gray-400"></p>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-1">Kategori</p>
                            <p id="modalKategoriDetail" class="font-semibold text-gray-900 dark:text-white"></p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-1">Tahun</p>
                            <p id="modalTahun" class="font-semibold text-gray-900 dark:text-white"></p>
                        </div>
                    </div>
                    <!-- <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">🛠️ Teknologi</h4>
            <p id="modalTech" class="text-gray-700 dark:text-gray-300"></p>
          </div> -->
                    <div class="grid grid-cols-2 gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a id="liveBtn" href="#" target="_blank"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-center">🔗
                            Buka Live</a>
                        <!-- <a id="downloadBtn" href="#" download class="px-4 py-2 border-2 border-blue-600 text-blue-600 dark:text-blue-400 rounded-lg font-semibold hover:bg-blue-50 dark:hover:bg-blue-950 transition text-center">📥 Download</a> -->
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

            // ===== Modal (baca data langsung dari atribut data-* card, aman dari error elemen null) =====
            function openModal(card) {
                if (!card) return;
                const d = card.dataset;

                // Cek keberadaan elemen terlebih dahulu sebelum mengisi data agar tidak menyebabkan error crash
                if (document.getElementById("modalTitle")) document.getElementById("modalTitle").textContent = d.title;
                if (document.getElementById("modalCategory")) document.getElementById("modalCategory").textContent = d.category;
                if (document.getElementById("modalEvent")) document.getElementById("modalEvent").textContent = "🎉 " + d.event;
                if (document.getElementById("modalDescription")) document.getElementById("modalDescription").textContent = d
                    .desc;
                if (document.getElementById("modalSiswa")) document.getElementById("modalSiswa").textContent = d.siswa;
                if (document.getElementById("modalGuru")) document.getElementById("modalGuru").textContent = "👨‍🏫 " + d.guru;
                if (document.getElementById("modalKategoriDetail")) document.getElementById("modalKategoriDetail").textContent =
                    d.category;
                if (document.getElementById("modalTahun")) document.getElementById("modalTahun").textContent = d.tahun;
                if (document.getElementById("modalAvatar")) document.getElementById("modalAvatar").textContent = d.avatar;
                if (document.getElementById("liveBtn")) document.getElementById("liveBtn").href = d.live;

                // Elemen-elemen yang sedang di-comment di HTML diproteksi di sini:
                if (document.getElementById("modalViews")) document.getElementById("modalViews").textContent = d.views;
                if (document.getElementById("modalLikes")) document.getElementById("modalLikes").textContent = d.likes;
                if (document.getElementById("modalTech")) document.getElementById("modalTech").textContent = d.tech;
                if (document.getElementById("downloadBtn")) document.getElementById("downloadBtn").href = d.download;

                // Tampilkan modal
                const modal = document.getElementById("detailModal");
                if (modal) modal.classList.remove("hidden");
            }

            function closeModal() {
                document.getElementById("detailModal").classList.add("hidden");
            }

            document.getElementById("detailModal").addEventListener("click", (e) => {
                if (e.target.id === "detailModal") closeModal();
            });

            // ===== Pencarian & Filter Kategori (unik: live search + pill + counter) =====
            const searchInput = document.getElementById("searchInput");
            const filterPills = document.querySelectorAll(".filter-pill");
            const allCards = document.querySelectorAll(".karya-card");
            const resultCounter = document.getElementById("resultCounter");
            const emptyState = document.getElementById("emptyState");

            let activeCategory = "all";

            function normalize(text) {
                return (text || "").toLowerCase();
            }

            function runFilter() {
                const query = normalize(searchInput.value.trim());
                let visibleCount = 0;

                allCards.forEach((card) => {
                    const d = card.dataset;
                    const haystack = normalize(`${d.title} ${d.siswa} ${d.tech} ${d.category} ${d.desc}`);
                    const matchesQuery = query === "" || haystack.includes(query);
                    const matchesCategory = activeCategory === "all" || normalize(d.category) === normalize(
                        activeCategory);
                    const isMatch = matchesQuery && matchesCategory;

                    card.classList.toggle("card-filtered-out", !isMatch);
                    if (isMatch) visibleCount++;
                });

                if (resultCounter) {
                    resultCounter.textContent = visibleCount === allCards.length ?
                        `Menampilkan semua ${allCards.length} karya` :
                        `Menampilkan ${visibleCount} dari ${allCards.length} karya`;
                }

                if (emptyState) {
                    emptyState.classList.toggle("hidden", visibleCount > 0);
                }
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

            // Jalankan sekali di awal untuk isi counter
            runFilter();
        </script>
</body>

</html>
