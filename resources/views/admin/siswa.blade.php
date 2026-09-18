@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page_title', 'Manajemen Data Siswa')

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data siswa...</p>
        </div>
    </div>

    <!-- Form Pencarian -->
    <div class="neubrutal-card p-4 sm:p-6 mb-4 sm:mb-6">
        <h2 class="text-base sm:text-xl font-black text-gray-900 mb-3">Cari Siswa</h2>
        <form action="{{ url('/admin/siswa') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, kelas, atau email siswa..." class="flex-1 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-800" />
            <div class="flex gap-2">
                <button type="submit" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer whitespace-nowrap">
                    Cari Siswa
                </button>
                <a href="{{ url('/admin/siswa') }}" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-gray-200 text-black rounded-xl btn-neubrutal text-xs sm:text-sm text-center whitespace-nowrap">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Kartu Konten Tabel -->
    <div class="neubrutal-card overflow-hidden mb-6">
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b-3 border-black bg-gray-50">
            <h2 class="text-base sm:text-xl font-black text-gray-900">Daftar Siswa</h2>
        </div>
        <div class="w-full overflow-x-auto overflow-y-auto max-h-[500px]">
            <table class="w-full border-collapse min-w-[700px] table-neubrutal">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Angkatan</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $siswa)
                        <tr>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ $siswa->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 font-semibold">{{ $siswa->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 font-semibold">
                                {{ $siswa->invitationCode->kelas ?? $siswa->kelas ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 font-semibold">
                                {{ $siswa->angkatan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <button type="button"
                                        onclick="openSiswaModal(this)"
                                        data-id="{{ $siswa->id }}"
                                        data-nama="{{ $siswa->name }}"
                                        data-kelas="{{ $siswa->invitationCode->kelas ?? $siswa->kelas }}"
                                        data-email="{{ $siswa->email }}"
                                        class="px-3 py-1.5 bg-blue-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">
                                    Edit
                                </button>

                                <button type="button"
                                        onclick="confirmDeleteSiswa(this)"
                                        data-id="{{ $siswa->id }}"
                                        data-nama="{{ $siswa->name }}"
                                        class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 font-bold">
                                @if(request()->filled('search'))
                                    <h2 class="text-lg text-gray-800">Data tidak ditemukan</h2>
                                    <p class="text-gray-500 text-sm font-semibold">Tidak ada siswa dengan kata kunci <strong>{{ request('search') }}</strong></p>
                                @else
                                    <h2 class="text-lg text-gray-500">Belum ada data siswa</h2>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-t-3 border-black bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-gray-700 font-bold">
            <span>Total: <span class="font-black">{{ $totalSiswa }}</span> Siswa</span>
            <div>
                {{ $siswas->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Edit Siswa -->
    <div id="siswa-modal" class="hidden fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4">
        <div class="modal-card max-w-md w-full p-6">
            <h3 class="text-lg font-black text-gray-900 mb-4 uppercase">Ubah Data Siswa</h3>

            <form id="modal-form" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-gray-700 mb-1 uppercase">Nama Siswa</label>
                        <input type="text" id="input-nama" name="name" class="w-full px-3 py-2 rounded-lg input-neubrutal text-sm" required />
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-700 mb-1 uppercase">Kelas</label>
                        <input type="text" id="input-kelas" name="kelas" class="w-full px-3 py-2 rounded-lg input-neubrutal text-sm" required />
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-700 mb-1 uppercase">Email</label>
                        <input type="email" id="input-email" name="email" class="w-full px-3 py-2 rounded-lg input-neubrutal text-sm" required />
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeSiswaModal()" class="flex-1 px-4 py-2 bg-gray-200 text-black rounded-xl btn-neubrutal text-sm cursor-pointer">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-sm cursor-pointer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Siswa -->
    <div id="modal-hapus-siswa" class="hidden fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4">
        <div class="modal-card max-w-sm w-full p-6 text-center space-y-4">
            <div class="w-14 h-14 bg-red-100 text-red-600 border-2 border-black rounded-full flex items-center justify-center mx-auto shadow-[2px_2px_0px_#000]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <div>
                <h3 class="text-lg font-black text-gray-900 uppercase">Hapus Data Siswa?</h3>
                <p class="text-sm text-gray-600 font-semibold mt-1">
                    Kamu yakin mau menghapus siswa <span id="delete-siswa-nama" class="font-black text-red-600"></span>?
                </p>
            </div>

            <form id="form-hapus-siswa" method="POST" class="pt-2 flex gap-3 justify-center">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeHapusSiswaModal()" class="w-full py-2.5 bg-gray-200 text-black font-black rounded-xl btn-neubrutal text-sm cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="w-full py-2.5 bg-red-500 text-white font-black rounded-xl btn-neubrutal text-sm cursor-pointer">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/siswa.js') }}"></script>
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