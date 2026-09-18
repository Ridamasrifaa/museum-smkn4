@extends('layouts.admin')

@section('title', 'Data Kategori')
@section('page_title', 'Manajemen Kategori Karya')

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data kategori...</p>
        </div>
    </div>

    <div class="neubrutal-card overflow-hidden">
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b-3 border-black bg-gray-50 flex justify-between items-center">
            <h2 class="text-base sm:text-xl font-black text-gray-900">Kategori Artikel</h2>
            <button type="button" onclick="openKategoriModal('tambah')" class="px-4 py-2 sm:px-6 sm:py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer whitespace-nowrap">
                Tambah Kategori
            </button>
        </div>

        <!-- TAMPILAN TABEL (Khusus Desktop / Layar Besar) -->
        <div class="hidden lg:block w-full overflow-x-auto">
            <table class="w-full border-collapse min-w-[500px] table-neubrutal">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Kategori Artikel</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-600 font-semibold">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                <span class="badge-neubrutal bg-blue-100 text-blue-800">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <button type="button" onclick="openKategoriModal('edit', this)" data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="px-3 py-1.5 bg-blue-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">
                                    Edit
                                </button>
                                <form action="{{ url('/admin/kategori/'.$category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus kategori ini?')" class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500 font-bold text-sm">
                                Belum ada kategori Artikel ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TAMPILAN CARD VERTIKAL (Khusus Mobile / HP) -->
        <div class="lg:hidden divide-y-2 divide-gray-200">
            @forelse($categories as $category)
                <div class="p-4 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-black px-2.5 py-1 bg-gray-200 border-2 border-black rounded-md shadow-[1px_1px_0px_#000]">
                            #{{ $loop->iteration }}
                        </span>
                        <span class="badge-neubrutal bg-blue-100 text-blue-800 text-xs px-3 py-1">
                            {{ $category->name }}
                        </span>
                    </div>

                    <div class="flex gap-2 pt-1">
                        <button type="button" onclick="openKategoriModal('edit', this)" data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="flex-1 text-center px-3 py-2 bg-blue-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">
                            Edit
                        </button>
                        <form action="{{ url('/admin/kategori/'.$category->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kategori ini?')" class="w-full text-center px-3 py-2 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500 font-bold text-sm px-4">
                    Belum ada kategori Artikel ditemukan.
                </div>
            @endforelse
        </div>

        @if(method_exists($categories, 'links'))
            <div class="px-4 py-3 sm:px-6 sm:py-4 border-t-3 border-black bg-gray-50">
                {{ $categories->withQueryString()->links() }}
            </div>
        @endif
    </div>

    {{-- Modal Form Kategori --}}
    <div id="kategori-modal" class="hidden fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4">
        <div class="modal-card max-w-md w-full p-6">
            <h3 id="modal-title" class="text-lg font-black text-gray-900 mb-4 uppercase">Tambah Kategori Baru</h3>

            <form id="modal-form" method="POST" action="">
                @csrf
                <div id="method-container"></div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-gray-700 mb-1 uppercase">Nama Kategori</label>
                        <input type="text" id="input-name" name="name" class="w-full px-3 py-2 rounded-lg input-neubrutal text-sm" placeholder="Contoh: Mobile App" required />
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeKategoriModal()" class="flex-1 px-4 py-2 bg-gray-200 text-black rounded-xl btn-neubrutal text-sm cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-sm cursor-pointer">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/kategori.js') }}"></script>
    <script>
        window.addEventListener("load", function () {
            const loadingContent = document.getElementById("loading-content");
            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => {
                        loadingContent.classList.add("hidden");
                    }, 300);
                }, 500);
            }
        });
    </script>
@endpush