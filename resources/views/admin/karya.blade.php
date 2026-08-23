@extends('layouts.admin')

@section('title', 'Manajemen Data Karya')
@section('page_title', 'Manajemen Data Karya')

@section('content')
    <!-- SPINNER OVERLAY -->
    <div id="loading-content" class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat data karya...</p>
        </div>
    </div>

    <!-- Form Pencarian -->
    <div class="bg-white mb-6 rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Cari Karya</h2>
        <form action="{{ url('/admin/karya') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari judul atau nama siswa..."
                class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">Cari</button>
            <a href="{{ url('/admin/karya') }}" class="px-6 py-2.5 bg-blue-700 text-white rounded-lg font-semibold hover:bg-blue-700">Reset</a>
        </form>
    </div>

    <!-- KARTU KONTEN -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Daftar Karya</h2>
        </div>

        <div class="overflow-x-auto overflow-y-auto max-h-[500px]">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($projects as $project)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-900 text-sm">{{ $project->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $project->user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">{{ $project->jurusan }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $project->status == 'pending'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : ($project->status == 'approved'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700') }}">
                                    {{ $project->status == 'pending' ? 'Menunggu' : ($project->status == 'approved' ? 'Disetujui' : 'Ditolak') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ url('/admin/karya/' . $project->id) }}" class="text-blue-600 hover:underline text-sm font-semibold">Detail</a>
                                <form action="{{ url('/admin/karya/' . $project->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus karya ini?')" class="text-red-600 hover:underline text-sm font-semibold cursor-pointer">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">Belum ada karya ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $projects->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>
@endpush