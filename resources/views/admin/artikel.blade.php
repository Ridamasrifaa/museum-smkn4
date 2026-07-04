<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Kelola Artikel - Admin Museum Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css')}}">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">

        {{-- SIDEBAR ADMIN --}}
        <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
            <div>
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-md">A</div>
                        <div>
                            <p class="font-bold">Museum Karya Smkn 4</p>
                            <!-- <p class="text-xs text-gray-400">PPLG</p> -->
                        </div>
                    </div>
                </div>
                <nav class="mt-6 space-y-1">
                    <a href="{{ url('/admin/dashboard')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/admin/karya')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
                        <span>Data Karya</span>
                    </a>
                    <a href="{{ url('/admin/siswa')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
                        <span>Data Siswa</span>
                    </a>
                    <a href="{{ url('/admin/kategori')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
                        <span>Kategori</span>
                    </a>
                    <a href="{{ url('/admin/manajemen-admin')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle:hover text-gray-300 transition">
                        <span>Manajemen Admin</span>
                    </a>
                    <a href="{{ url('/admin/artikel')}}" class="flex items-center gap-3 px-6 py-3 nav-link-idle nav-link-active">
                        <span>Manajemen Artikel</span>
                    </a>
                </nav>
            </div>
            
            <!-- Logout Section -->
            <div class="p-6 border-t border-gray-700">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button type="button" onclick="handleLogout()" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    Logout
                </button>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="flex-1 overflow-auto flex flex-col">
            <header class="bg-white shadow-sm z-10">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Kelola Artikel</h1>
                    <a href="{{ url('/admin/artikel/upload')}}"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Artikel
                    </a>
                </div>
            </header>

            <div class="flex-1 overflow-auto p-8 relative">
                <div id="loading-content"
                    class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
                    <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
                        <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                        <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat daftar artikel...</p>
                    </div>
                </div>

                {{-- Kartu statistik ringkas (dummy) --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-5">
                        <p class="text-sm text-gray-500 mb-1">Total Artikel</p>
                        <p class="text-2xl font-bold text-gray-900">6</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <p class="text-sm text-gray-500 mb-1">Sudah Terbit</p>
                        <p class="text-2xl font-bold text-green-600">5</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <p class="text-sm text-gray-500 mb-1">Draft</p>
                        <p class="text-2xl font-bold text-yellow-600">1</p>
                    </div>
                </div>

                {{-- Filter & Search (dummy, non-fungsional ke server) --}}
                <div class="bg-white rounded-lg shadow p-5 mb-6">
                    <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                        <input id="searchInput" type="text" placeholder="Cari judul artikel..."
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />

                        <select id="statusFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option value="">Semua Status</option>
                            <option value="published">Terbit</option>
                            <option value="draft">Draft</option>
                        </select>

                        <select id="categoryFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                            <option value="">Semua Kategori</option>
                            <option value="Prestasi">Prestasi</option>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Tefa">Tefa</option>
                        </select>

                        <button type="button" onclick="runFilter()"
                            class="px-5 py-2 bg-gray-800 text-white rounded-lg font-medium hover:bg-gray-900 transition">Terapkan</button>
                    </div>
                </div>

                {{-- Tabel Artikel (dummy, mengikuti gaya tabel referensi) --}}
                <div class="bg-white rounded-lg shadow">
                    <div class="overflow-x-auto overflow-y-auto max-h-[500px]">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Penulis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Sorotan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="articleTableBody" class="divide-y divide-gray-200">

                                <tr class="article-row hover:bg-gray-50" data-title="tim pplg raih juara lks provinsi"
                                    data-category="Prestasi" data-status="published">
                                    
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">Tim PPLG SMKN 4 Tasikmalaya Raih Juara 1 Lomba Aplikasi Tingkat Provinsi</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Prestasi</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Admin Sekolah</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Terbit</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><span class="text-yellow-500 text-lg">⭐</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">28 Jun 2026</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <a href="{{ url('/admin/artikel/edit')}}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">Edit</a>
                                        <button type="button" onclick="hapusBaris(this)" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="article-row hover:bg-gray-50" data-title="pameran teaching factory 2026"
                                    data-category="Kegiatan" data-status="published">
                                   
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">Pameran Teaching Factory 2026 Pamerkan Puluhan Karya Siswa</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Kegiatan</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Admin Sekolah</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Terbit</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><span class="text-gray-300 text-lg">—</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">20 Jun 2026</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <a href="{{ url('/admin/artikel/edit')}}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">Edit</a>
                                        <button type="button" onclick="hapusBaris(this)" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="article-row hover:bg-gray-50" data-title="kelas xi mulai program tefa"
                                    data-category="Tefa" data-status="published">
                                    
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">Siswa Kelas XI Resmi Mulai Program Teaching Factory Semester Ini</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Tefa</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Admin Sekolah</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Terbit</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><span class="text-gray-300 text-lg">—</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">12 Jun 2026</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <a href="{{ url('/admin/artikel/edit')}}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">Edit</a>
                                        <button type="button" onclick="hapusBaris(this)" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="article-row hover:bg-gray-50" data-title="workshop ui ux bersama alumni"
                                    data-category="Kegiatan" data-status="draft">
                                    
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">Workshop UI/UX Bersama Alumni yang Kini Bekerja di Startup</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Kegiatan</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Admin Sekolah</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Draft</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><span class="text-gray-300 text-lg">—</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">5 Jun 2026</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <a href="{{ url('/admin/artikel/edit')}}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">Edit</a>
                                        <button type="button" onclick="hapusBaris(this)" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="article-row hover:bg-gray-50" data-title="karya game siswa tembus 1000 unduhan"
                                    data-category="Prestasi" data-status="published">
                                    
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">Game Buatan Siswa Kelas XII Tembus 1.000 Unduhan di Play Store</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Prestasi</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Admin Sekolah</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Terbit</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><span class="text-gray-300 text-lg">—</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">1 Jun 2026</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <a href="{{ url('/admin/artikel/edit')}}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">Edit</a>
                                        <button type="button" onclick="hapusBaris(this)" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="article-row hover:bg-gray-50" data-title="pengumuman libur semester genap"
                                    data-category="Kegiatan" data-status="draft">
                                    
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">Pengumuman Jadwal Libur Semester Genap Tahun Ajaran 2025/2026</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Kegiatan</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Admin Sekolah</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Draft</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm"><span class="text-gray-300 text-lg">—</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">-</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <a href="{{ url('/admin/artikel/edit')}}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">Edit</a>
                                        <button type="button" onclick="hapusBaris(this)" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">Hapus</button>
                                    </td>
                                </tr>

                                <tr id="emptyRow" class="hidden">
                                    <td colspan="8" class="text-center py-12">
                                        <h2 id="emptyTitle" class="font-bold text-lg text-gray-500">Belum ada data artikel</h2>
                                        <p id="emptyDesc" class="hidden text-gray-500 text-sm">
                                            Tidak ada artikel dengan kata kunci <strong id="emptyQuery"></strong>
                                        </p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            const loadingContent = document.getElementById("loading-content");
            setTimeout(() => {
                loadingContent.classList.add("opacity-0");
                setTimeout(() => {
                    loadingContent.classList.add("hidden");
                }, 300);
            }, 700);
        });

        function handleLogout() {
            if (confirm('Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        function hapusBaris(btn) {
            if (confirm("Hapus artikel ini? (contoh statis, tidak benar-benar menghapus dari database)")) {
                btn.closest("tr").remove();
            }
        }

        const searchInput = document.getElementById("searchInput");
        const statusFilter = document.getElementById("statusFilter");
        const categoryFilter = document.getElementById("categoryFilter");
        const rows = document.querySelectorAll(".article-row");
        const emptyRow = document.getElementById("emptyRow");

        const emptyTitle = document.getElementById("emptyTitle");
        const emptyDesc = document.getElementById("emptyDesc");
        const emptyQuery = document.getElementById("emptyQuery");

        function runFilter() {
            const query = (searchInput.value || "").toLowerCase().trim();
            const status = statusFilter.value;
            const category = categoryFilter.value;
            let visibleCount = 0;

            rows.forEach((row) => {
                const d = row.dataset;
                const matchesQuery = query === "" || d.title.includes(query);
                const matchesStatus = status === "" || d.status === status;
                const matchesCategory = category === "" || d.category === category;
                const isMatch = matchesQuery && matchesStatus && matchesCategory;
                row.classList.toggle("hidden", !isMatch);
                if (isMatch) visibleCount++;
            });

            emptyRow.classList.toggle("hidden", visibleCount > 0);

            if (visibleCount === 0) {
                if (query !== "") {
                    emptyTitle.textContent = "Data tidak ditemukan";
                    emptyQuery.textContent = searchInput.value.trim();
                    emptyDesc.classList.remove("hidden");
                } else {
                    emptyTitle.textContent = "Tidak ada artikel yang cocok dengan filter";
                    emptyDesc.classList.add("hidden");
                }
            }
        }

        searchInput.addEventListener("input", runFilter);
    </script>
</body>

</html>