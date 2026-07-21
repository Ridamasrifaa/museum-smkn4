<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Tambah Artikel - Admin Museum Karya PPLG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">

        {{-- SIDEBAR ADMIN --}}
        <div class="w-64 custom-nav-bg text-white shadow-lg flex flex-col justify-between">
            <div>
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center font-bold text-md">
                            A</div>
                        <div>
                            <p class="font-bold">Museum Karya Smkn 4</p>
                        </div>
                    </div>
                </div>
                <nav class="mt-6 space-y-1">
                    <a href="{{ url('/admin/dashboard') }}"
                        class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">Dashboard</a>
                    <a href="{{ url('/admin/karya') }}"
                        class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">Data
                        Karya</a>
                    <a href="{{ url('/admin/siswa') }}"
                        class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">Data
                        Siswa</a>
                    <a href="{{ url('/admin/kategori') }}"
                        class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">Kategori</a>
                    <a href="{{ url('/admin/manajemen-admin') }}"
                        class="flex items-center gap-3 px-6 py-3 text-gray-300 hover:bg-gray-800 transition">Manajemen
                        Admin</a>
                    <a href="{{ url('/admin/artikel') }}"
                        class="flex items-center gap-3 px-6 py-3 bg-gray-800 text-white border-l-4 border-blue-500">Manajemen
                        Artikel</a>
                </nav>
            </div>

            <div class="p-6 border-t border-gray-700">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button type="button" onclick="handleLogout()"
                    class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    Logout
                </button>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="flex-1 overflow-auto flex flex-col">
            <header class="bg-white shadow-sm z-10">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Tambah Artikel Baru</h1>
                    <a href="{{ url('admin/artikel') }}"
                        class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition">← Kembali ke
                        daftar</a>
                </div>
            </header>

            <div class="flex-1 overflow-auto p-8 relative">
                <div id="loading-content"
                    class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
                    <div
                        class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
                        <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin">
                        </div>
                        <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat formulir artikel...</p>
                    </div>
                </div>

                <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8">
                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-lg p-4">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="articleForm" action="{{ route('articles.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel *</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Masukan Judul Artikel...">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Artikel *</label>
                            <select name="category_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan Singkat *</label>
                            <textarea name="excerpt" rows="2" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Masukan ringkasan singkat untuk artikel...">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Artikel *</label>
                            <select name="status" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="">Pilih Status</option>
                                <option value="draft" @selected(old('status') == 'draft')>Draft</option>
                                <option value="published" @selected(old('status') == 'published')>Published</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Isi Artikel *</label>
                            <textarea name="content" rows="10" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Masukan Isi Artikelnya yang berunsur 5W + 1H.... ">{{ old('content') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sampul (Cover) *</label>
                            <input type="file" name="cover" accept="image/*" required
                                onchange="previewCover(event)"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <div id="coverPreviewWrap" class="hidden mt-3">
                                <img id="coverPreview"
                                    class="w-full max-h-56 object-cover rounded-lg border border-gray-200" />
                            </div>
                        </div>

                        <div class="flex gap-4 pt-4 border-t">
                            <button type="button" onclick="resetForm()"
                                class="flex-1 px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Reset</button>
                            <button type="submit"
                                class="flex-1 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan
                                Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", () => {
            const loadingContent = document.getElementById("loading-content");
            setTimeout(() => {
                loadingContent.classList.add("opacity-0");
                setTimeout(() => loadingContent.classList.add("hidden"), 300);
            }, 700);
        });

        function resetForm() {
            document.getElementById("articleForm").reset();
            document.getElementById("coverPreviewWrap").classList.add("hidden");
        }

        function previewCover(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById("coverPreview").src = e.target.result;
                    document.getElementById("coverPreviewWrap").classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        }

        function handleLogout() {
            if (confirm('Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>

</html>
