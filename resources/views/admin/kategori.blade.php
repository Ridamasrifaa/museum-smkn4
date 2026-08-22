@extends('layouts.admin')

@section('title', 'Data Kategori')
@section('page_title', 'Manajemen Kategori Karya')

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data kategori...</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Kategori Artikel</h2>
            <button type="button" onclick="openKategoriModal('tambah')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold cursor-pointer">
                Tambah Kategori
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kategori artikel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <button type="button" onclick="openKategoriModal('edit', this)" data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">
                                    Edit
                                </button>
                                <form action="{{ url('/admin/kategori/'.$category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus kategori ini?')" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500">
                                Belum ada kategori Artikel ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Form Kategori --}}
    <div id="kategori-modal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <h3 id="modal-title" class="text-lg font-bold text-gray-900 mb-4">Tambah Kategori Baru</h3>
            
            <form id="modal-form" method="POST" action="">
                @csrf
                <div id="method-container"></div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" id="input-name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="Contoh: Mobile App" required />
                    </div>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeKategoriModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/kategori.js') }}"></script>
@endpush