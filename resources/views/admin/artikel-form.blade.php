@extends('layouts.admin')

{{-- Menandakan menu aktif di navbar admin layout --}}
@section('active_menu', 'articles')

@section('title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')
@section('page_title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel Baru')

@section('header_action')
    <a href="{{ route('articles.index') }}" class="text-xs sm:text-sm font-black text-gray-700 hover:text-black transition flex items-center gap-1 whitespace-nowrap">
        &larr; Kembali ke daftar
    </a>
@endsection

@section('content')

    <!-- SPINNER OVERLAY LOADING -->
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">
                {{ isset($article) ? 'Memuat data artikel...' : 'Memuat formulir artikel...' }}
            </p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto neubrutal-card p-4 sm:p-8">

        @if ($errors->any())
            <div class="mb-6 neubrutal-card bg-red-100 px-4 py-3">
                <ul class="list-disc ml-5 font-bold text-red-800 text-xs sm:text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="articleForm"
              action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
            @csrf
            @if(isset($article))
                @method('PUT')
            @endif

            <div>
                <label class="block text-xs sm:text-sm font-black text-gray-900 mb-2">Judul Artikel *</label>
                <input type="text" name="title" required
                       value="{{ old('title', $article->title ?? '') }}"
                       placeholder="Masukan Judul Artikel..."
                       class="w-full px-3.5 py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-900">
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-black text-gray-900 mb-2">Kategori Artikel *</label>
                <div class="relative">
                    <select name="category_id" required class="w-full px-3.5 py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-900 bg-white appearance-none cursor-pointer">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id ?? '') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-black font-black text-xs">
                        ▼
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-black text-gray-900 mb-2">Ringkasan Singkat *</label>
                <textarea name="excerpt" rows="3" required
                          placeholder="Masukan ringkasan singkat untuk artikel..."
                          class="w-full px-3.5 py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-900">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-black text-gray-900 mb-2">Isi Artikel *</label>
                <textarea name="content" rows="8" required
                          placeholder="Masukan isi artikel yang berunsur 5W + 1H..."
                          class="w-full px-3.5 py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-900">{{ old('content', $article->content ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-black text-gray-900 mb-2">
                    Gambar Sampul (Cover) {{ isset($article) ? '' : '*' }}
                </label>

                <div id="coverPreviewWrap" class="{{ isset($article) && $article->cover ? '' : 'hidden' }} mb-3">
                    <img id="coverPreview"
                         src="{{ isset($article) && $article->cover ? asset('storage/'.$article->cover) : '' }}"
                         class="w-full max-h-56 object-cover rounded-xl border-3 border-black shadow-[2px_2px_0px_#000]" />
                </div>

                <input type="file" name="cover" accept="image/*" onchange="previewCover(event)"
                       {{ isset($article) ? '' : 'required' }}
                       class="w-full px-3 py-2 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-900 bg-white cursor-pointer file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-2 file:border-black file:text-xs file:font-black file:bg-[#ffcc00] file:text-black hover:file:bg-yellow-400">

                @if(isset($article))
                    <p class="text-[11px] sm:text-xs font-bold text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar sampul yang lama.</p>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-xs sm:text-sm font-black text-gray-900 mb-2">Status *</label>
                    <div class="relative">
                        <select name="status" required class="w-full px-3.5 py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-900 bg-white appearance-none cursor-pointer">
                            <option value="">Pilih Status</option>
                            <option value="draft" @selected(old('status', $article->status ?? '') == 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $article->status ?? '') == 'published')>Published</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-black font-black text-xs">
                            ▼
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 sm:pt-8">
                    <input type="checkbox" id="isFeatured" name="is_featured" value="1"
                           @checked(old('is_featured', $article->is_featured ?? false))
                           class="w-5 h-5 rounded border-2 border-black text-yellow-400 focus:ring-0 cursor-pointer accent-[#ffcc00]">
                    <label for="isFeatured" class="text-xs sm:text-sm font-black text-gray-900 cursor-pointer select-none">
                        ⭐ Jadikan artikel sorotan (tampil di hero)
                    </label>
                </div>
            </div>

            @if(isset($article))
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-1 text-[11px] sm:text-xs font-bold text-gray-500 pt-3 border-t-2 border-black">
                    <span>Dibuat oleh: {{ $article->author->name ?? '-' }}</span>
                    <span>Terakhir diperbarui: {{ $article->updated_at->format('d M Y') }}</span>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row gap-3 pt-3 {{ isset($article) ? '' : 'border-t-3 border-black' }}">
                @if(isset($article))
                    <a href="{{ route('articles.index') }}" class="w-full sm:flex-1 text-center px-6 py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal font-black text-xs sm:text-sm">
                        Batal
                    </a>
                @else
                    <button type="button" onclick="resetForm()" class="w-full sm:flex-1 px-6 py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal font-black text-xs sm:text-sm cursor-pointer">
                        Reset
                    </button>
                @endif
                <button type="submit" class="w-full sm:flex-1 px-6 py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal font-black text-xs sm:text-sm cursor-pointer">
                    {{ isset($article) ? 'Simpan Perubahan' : 'Simpan Artikel' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", function() {
            const loadingContent = document.getElementById("loading-content");
            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => loadingContent.classList.add("hidden"), 300);
                }, 700);
            }
        });

        function resetForm() {
            const form = document.getElementById("articleForm");
            if (form) form.reset();
            const wrap = document.getElementById("coverPreviewWrap");
            if (wrap) wrap.classList.add("hidden");
        }

        function previewCover(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("coverPreview").src = e.target.result;
                document.getElementById("coverPreviewWrap").classList.remove("hidden");
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush