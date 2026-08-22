@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('page_title', 'Kelola Artikel')

@section('header_action')
    <a href="{{ route('articles.create') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2">
        <span>+</span> Tambah Artikel
    </a>
@endsection

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat daftar artikel...</p>
        </div>
    </div>

    <!-- Kartu statistik ringkas -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500 mb-1">Total Artikel</p>
            <p class="text-2xl font-bold text-gray-900">{{ $articles->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500 mb-1">Sudah Terbit</p>
            <p class="text-2xl font-bold text-green-600">{{ $articles->where('status','published')->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
            <p class="text-sm text-gray-500 mb-1">Draft</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $articles->where('status','draft')->count() }}</p>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow p-5 mb-6">
        <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
            <input id="searchInput" type="text" placeholder="Cari judul artikel..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />

            <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">Semua Status</option>
                <option value="published">Terbit</option>
                <option value="draft">Draft</option>
            </select>

            <select id="categoryFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="button" onclick="runFilter()" class="px-5 py-2 bg-gray-800 text-white rounded-lg font-medium hover:bg-gray-900 transition">Terapkan</button>
        </div>
    </div>

    <!-- Tabel Artikel -->
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
                    @forelse($articles as $article)
                        <tr class="article-row hover:bg-gray-50" data-title="{{ strtolower($article->title) }}" data-category="{{ $article->category?->name }}" data-status="{{ $article->status }}">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">{{ $article->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $article->category?->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $article->author->name }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($article->status=='published')
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Terbit</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $article->is_featured ? '⭐' : '—' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $article->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <a href="{{ route('articles.edit',$article) }}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold">Edit</a>
                                <form action="{{ route('articles.destroy',$article) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus artikel ini?')" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-500">Belum ada artikel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", function() {
            const loadingContent = document.getElementById("loading-content");
            setTimeout(() => {
                loadingContent.classList.add("opacity-0");
                setTimeout(() => loadingContent.classList.add("hidden"), 300);
            }, 700);
        });

        const searchInput = document.getElementById("searchInput");
        const statusFilter = document.getElementById("statusFilter");
        const categoryFilter = document.getElementById("categoryFilter");
        const rows = document.querySelectorAll(".article-row");

        function runFilter() {
            const query = (searchInput.value || "").toLowerCase().trim();
            const status = statusFilter.value;
            const category = categoryFilter.value.toLowerCase();

            rows.forEach((row) => {
                const d = row.dataset;
                const matchesQuery = query === "" || d.title.includes(query);
                const matchesStatus = status === "" || d.status === status;
                const matchesCategory = category === "" || (d.category && d.category.toLowerCase() === category);
                const isMatch = matchesQuery && matchesStatus && matchesCategory;
                row.classList.toggle("hidden", !isMatch);
            });
        }

        searchInput.addEventListener("input", runFilter);
    </script>
@endpush