@extends('layouts.admin')

@section('title', 'Data Siswa')
@section('page_title', 'Manajemen Data Siswa')

@section('content')
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out m-0!">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data siswa...</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Siswa</h2>
        <form action="{{ url('/admin/siswa') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, kelas, atau email siswa..." class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm" />
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm whitespace-nowrap">
                Cari Siswa
            </button>
            <a href="{{ url('/admin/siswa')}}" class="px-6 py-2.5 bg-blue-700 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm whitespace-nowrap">
                Reset
            </a>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Daftar Siswa</h2>
        </div>
        <div class="overflow-x-auto overflow-y-auto max-h-[500px]">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Angkatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if($siswas->count())
                        @foreach($siswas as $siswa)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $siswa->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $siswa->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{-- Ambil dari relasi invitationCode, fallback ke kolom kelas user --}}
                                    {{ $siswa->invitationCode->kelas ?? $siswa->kelas ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $siswa->angkatan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button type="button" 
                                            onclick="openSiswaModal(this)" 
                                            data-id="{{ $siswa->id }}" 
                                            data-nama="{{ $siswa->name }}" 
                                            data-kelas="{{ $siswa->invitationCode->kelas ?? $siswa->kelas }}" 
                                            data-email="{{ $siswa->email }}" 
                                            class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition cursor-pointer">
                                        Edit
                                    </button>
                                    <form action="{{ url('/admin/siswa/'.$siswa->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus siswa ini?')" class="text-red-600 hover:text-red-800 font-semibold transition cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                @if(request()->filled('search'))
                                    <h2 class="font-bold text-lg text-gray-800">Data tidak ditemukan</h2>
                                    <p class="text-gray-500 text-sm">Tidak ada siswa dengan kata kunci <strong>{{ request('search') }}</strong></p>
                                @else
                                    <h2 class="font-bold text-lg text-gray-500">Belum ada data siswa</h2>
                                @endif
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center text-sm text-gray-600">
            <span>Total: <span class="font-bold">{{ $totalSiswa }}</span> Siswa</span>
            <div>
                {{ $siswas->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Edit Siswa --}}
    <div id="siswa-modal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Ubah Data Siswa</h3>
            
            <form id="modal-form" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                        <input type="text" id="input-nama" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                        <input type="text" id="input-kelas" name="kelas" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="input-email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" required />
                    </div>
                </div>
                
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeSiswaModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/siswa.js') }}"></script>
@endpush