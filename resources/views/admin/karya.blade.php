@extends('layouts.admin')

@section('title', 'Manajemen Data Karya - Museum Karya PPLG')
@section('page_title', 'Manajemen Data Karya')

@section('content')
    <!-- SPINNER OVERLAY -->
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data karya...</p>
        </div>
    </div>

    <!-- Form Pencarian -->
    <div class="neubrutal-card mb-4 sm:mb-6 p-4 sm:p-6">
        <h2 class="text-base sm:text-xl font-black text-gray-900 mb-3">Cari Karya</h2>
        <form action="{{ url('/admin/karya') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari judul, jurusan, atau siswa..."
                class="flex-1 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-800">
            <div class="flex gap-2">
                <button type="submit" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">Cari</button>
                <a href="{{ url('/admin/karya') }}" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-gray-200 text-black rounded-xl btn-neubrutal text-xs sm:text-sm text-center">Reset</a>
            </div>
        </form>
    </div>

    <!-- KARTU KONTEN TABEL -->
    <div class="neubrutal-card overflow-hidden mb-6">
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b-3 border-black bg-gray-50">
            <h2 class="text-base sm:text-xl font-black text-gray-900">Daftar Karya</h2>
        </div>

        <!-- TAMPILAN TABEL KARYA (desktop / layar besar) -->
        <div class="hidden lg:block w-full overflow-x-auto">
            <table class="w-full border-collapse min-w-[600px] table-neubrutal">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Judul & Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-center text-xs font-black text-gray-900 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-black text-gray-900 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 text-sm">{{ $project->title }}</div>
                                <div class="text-xs text-gray-500 font-semibold mt-0.5">Siswa: {{ $project->user->name ?? 'Tidak Diketahui' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="badge-neubrutal bg-blue-100 text-blue-800">{{ $project->jurusan }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($project->status == 'approved')
                                    <span class="badge-neubrutal bg-green-100 text-green-800">Disetujui</span>
                                @elseif($project->status == 'pending')
                                    <span class="badge-neubrutal bg-yellow-100 text-yellow-800">Menunggu</span>
                                @else
                                    <span class="badge-neubrutal bg-red-100 text-red-800">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex gap-2 justify-center items-center">
                                    <a href="{{ url('/admin/karya/' . $project->id) }}" class="px-3 py-1.5 bg-blue-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal">Detail</a>

                                    <form action="{{ url('/admin/karya/' . $project->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus karya ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-gray-500 font-bold text-sm">
                                @if(request()->filled('search'))
                                    Tidak ada karya dengan kata kunci <strong>{{ request('search') }}</strong>.
                                @else
                                    Belum ada data karya yang ditemukan.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TAMPILAN KARTU KARYA (mobile & tablet, di bawah lg) -->
        <div class="lg:hidden divide-y-2 divide-gray-200">
            @forelse($projects as $project)
                <div class="p-4 relative">
                    <div class="absolute top-4 right-4">
                        <span class="badge-neubrutal bg-blue-100 text-blue-800 text-[10px] px-2 py-0.5">{{ $project->jurusan }}</span>
                    </div>

                    <div class="pr-16">
                        <h3 class="font-black text-gray-900 text-sm leading-snug">{{ $project->title }}</h3>
                        <p class="text-xs text-gray-500 font-semibold mt-0.5">Siswa: {{ $project->user->name ?? 'Tidak Diketahui' }}</p>
                    </div>

                    <div class="mt-3">
                        @if($project->status == 'approved')
                            <span class="badge-neubrutal bg-green-100 text-green-800">Disetujui</span>
                        @elseif($project->status == 'pending')
                            <span class="badge-neubrutal bg-yellow-100 text-yellow-800">Menunggu</span>
                        @else
                            <span class="badge-neubrutal bg-red-100 text-red-800">Ditolak</span>
                        @endif
                    </div>

                    <div class="flex gap-2 mt-3">
                        <a href="{{ url('/admin/karya/' . $project->id) }}" class="flex-1 text-center px-3 py-2 bg-blue-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal">Detail</a>

                        <form action="{{ url('/admin/karya/' . $project->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus karya ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] btn-neubrutal cursor-pointer">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500 font-bold text-sm px-4">
                    @if(request()->filled('search'))
                        Tidak ada karya dengan kata kunci <strong>{{ request('search') }}</strong>.
                    @else
                        Belum ada data karya yang ditemukan.
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Footer Pagination -->
        @if(method_exists($projects, 'links'))
            <div class="px-4 py-3 sm:px-6 sm:py-4 border-t-3 border-black bg-gray-50">
                {{ $projects->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", function () {
            const loadingContent = document.getElementById("loading-content");
            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => {
                        loadingContent.classList.add("hidden");
                    }, 300);
                }, 800);
            }
        });
    </script>
@endpush