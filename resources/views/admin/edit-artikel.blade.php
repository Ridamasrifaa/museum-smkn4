<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Edit Artikel - Admin Museum Karya PPLG</title>
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
                    <h1 class="text-2xl font-bold text-gray-900">Edit Artikel</h1>
                    <a href="{{ url('admin/artikel')}}"
                        class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition">← Kembali ke daftar</a>
                </div>
            </header>

            <div class="flex-1 overflow-auto p-8 relative">
                <div id="loading-content"
                    class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
                    <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
                        <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                        <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data artikel...</p>
                    </div>
                </div>

                <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8">
                    @if ($errors->any())
<div class="mb-5 bg-red-100 border border-red-300 rounded-lg p-4">
    <ul class="list-disc ml-5 text-red-600">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
                   <form
    action="{{ route('articles.update', $article->id) }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6"
>
    @csrf
    @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel *</label>
                            <input type="text" name="title" required
                                value="{{ old('title', $article->title) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Artikel *</label>
                          <select
    name="category_id"
    class="w-full px-4 py-2 border border-gray-300 rounded-lg"
    required
>

<option value="">Pilih Kategori</option>

@foreach($categories as $category)

<option
    value="{{ $category->id }}"
    @selected(old('category_id',$article->category_id)==$category->id)
>
    {{ $category->name }}
</option>

@endforeach

</select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan Singkat *</label>
<textarea
name="excerpt"
rows="2"
required
class="w-full px-4 py-2 border border-gray-300 rounded-lg"
>{{ old('excerpt',$article->excerpt) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Isi Artikel *</label>
                      <textarea
name="content"
rows="10"
required
class="w-full px-4 py-2 border border-gray-300 rounded-lg"
>{{ old('content',$article->content) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sampul (Cover)</label>
                            <div id="coverPreviewWrap" class="mb-3">
                                <div class="w-full h-48 rounded-lg border border-gray-200 bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                                   <div id="coverPreviewWrap" class="mb-3">

@if($article->cover)

<img
    id="coverPreview"
    src="{{ asset('storage/'.$article->cover) }}"
    class="w-full h-48 object-cover rounded-lg border"
/>

@else

<img
    id="coverPreview"
    class="hidden w-full h-48 object-cover rounded-lg border"
/>

@endif

</div>
                                </div>
                            </div>
                           <input
type="file"
name="cover"
accept="image/*"
onchange="previewCover(event)"
class="w-full px-4 py-2 border rounded-lg"
/>
                            <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti gambar sampul yang lama.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                              <select
name="status"
required
class="w-full px-4 py-2 border rounded-lg"
>

<option
value="draft"
@selected(old('status',$article->status)=='draft')
>
Draft
</option>

<option
value="published"
@selected(old('status',$article->status)=='published')
>
Published
</option>

</select>
                            </div>

                            <div class="flex items-center gap-3 pt-8">
                                <input type="checkbox" id="isFeatured" name="is_featured" value="1" @checked(old('is_featured',$article->is_featured))
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer" />
                                <label for="isFeatured" class="text-sm text-gray-700 font-medium cursor-pointer select-none">
                                    ⭐ Jadikan artikel sorotan (tampil di hero)
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs text-gray-400 pt-2 border-t border-gray-100">
                            <span>Dibuat oleh: {{ $article->author->name }}</span>
                            <span>Terakhir diperbarui:{{ $article->updated_at->format('d M Y') }} </span>
                        </div>

                        <div class="flex gap-4 pt-2">
                            <a href="{{ route('articles.index') }}"
                                class="flex-1 text-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Batal</a>
                            <button type="submit"
                                class="flex-1 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-md transition">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal sukses (dummy) --}}
    <div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 text-green-600 text-2xl font-bold">✓</div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Perubahan Disimpan!</h3>
            <p class="text-gray-600 mb-6">Artikel berhasil diperbarui (contoh statis, belum tersambung ke database).</p>
            <a href="admin-artikel-index-statis.html"
                class="block w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center font-semibold transition">Kembali
                ke Daftar Artikel</a>
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

        function previewCover(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("coverPreviewWrap").innerHTML =
                    `<img src="${e.target.result}" class="w-full h-48 object-cover rounded-lg border border-gray-200" />`;
            };
            reader.readAsDataURL(file);
        }

       

        function handleLogout() {
            if (confirm('Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>

</html>