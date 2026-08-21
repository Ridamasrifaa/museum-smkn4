@extends('layouts.siswa')

@section('title', 'My karya Gue')

@section('content')
    <header class="bg-white shadow-sm z-10">
        <div class="px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Karya Saya</h1>
        </div>
    </header>

    <div class="flex-1 overflow-auto p-8 relative">
        <div id="loading-content"
            class="absolute inset-0 bg-gray-100 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200">
                <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat daftar karya...</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">My Karya Gue</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola dan pantau status karya yang telah dikirim</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul Karya</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal Upload</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($projects as $project)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    {{ $project->title }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                        {{ $project->jurusan ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($project->status == 'approved')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Disetujui</span>
                                    @elseif($project->status == 'pending')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $project->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 flex items-center gap-4">
                                    <a href="{{ url('/siswa/karya/detail/' . $project->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat</a>
                                    <form action="{{ url('/siswa/karya/' . $project->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus karya ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-500 text-sm">
                                    Belum ada karya yang diupload.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
        }, 1000);
    });
</script>
@endpush