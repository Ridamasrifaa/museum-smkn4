@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('page_title', 'Edit Artikel')

@section('header_action')
    <a href="{{ url('admin/artikel') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition">← Kembali ke daftar</a>
@endsection

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
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

        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel *</label>
                <input type="text" name="title" required value="{{ old('title', $article->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Artikel *</label>
                <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ringkasan Singkat *</label>
                <textarea name="excerpt" rows="2" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Isi Artikel *</label>
                <textarea name="content" rows="10" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('content', $article->content) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sampul (Cover)</label>
                <div id="coverPreviewWrap" class="mb-3">
                    @if($article->cover)
                        <img id="coverPreview" src="{{ asset('storage/'.$article->cover) }}" class="w-full h-48 object-cover rounded-lg border" />
                    @else
                        <img id="coverPreview" class="hidden w-full h-48 object-cover rounded-lg border" />
                    @endif
                </div>
                <input type="file" name="cover" accept="image/*" onchange="previewCover(event)" class="w-full px-4 py-2 border rounded-lg" />
                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti gambar sampul yang lama.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" required class="w-full px-4 py-2 border rounded-lg">
                        <option value="draft" @selected(old('status', $article->status) == 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $article->status) == 'published')>Published</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 pt-8">
                    <input type="checkbox" id="isFeatured" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured)) class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer" />
                    <label for="isFeatured" class="text-sm text-gray-700 font-medium cursor-pointer select-none">
                        ⭐ Jadikan artikel sorotan (tampil di hero)
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs text-gray-400 pt-2 border-t border-gray-100">
                <span>Dibuat oleh: {{ $article->author->name }}</span>
                <span>Terakhir diperbarui: {{ $article->updated_at->format('d M Y') }}</span>
            </div>

            <div class="flex gap-4 pt-2">
                <a href="{{ route('articles.index') }}" class="flex-1 text-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Batal</a>
                <button type="submit" class="flex-1 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-md transition">Simpan Perubahan</button>
            </div>
        </form>
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
    </script>
@endpush