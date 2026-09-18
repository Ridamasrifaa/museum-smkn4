@extends('layouts.admin')

@section('title', 'Detail Karya Admin - Museum Karya PPLG')
@section('page_title', 'Detail Karya')

@section('content')
    <!-- MAIN KONTEN -->
    <div class="w-full max-w-2xl md:max-w-3xl my-auto mx-auto">

        <!-- TOMBOL KEMBALI -->
        <div class="mb-4">
            <a href="{{ url('/admin/karya') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-black bg-white px-3 py-1.5 rounded-lg border-2 border-black shadow-[2px_2px_0px_#000] hover:bg-[#ffcc00] transition btn-neubrutal">
                ← Kembali ke Data Karya
            </a>
        </div>

        <!-- CARD DETAIL -->
        <div class="neubrutal-card relative overflow-hidden bg-white border-3 border-black rounded-xl shadow-[6px_6px_0px_#000]">

            <!-- LOADING CONTENT -->
            <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
                <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
                    <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
                    <p class="font-black text-xs sm:text-sm uppercase tracking-wider">Memuat detail karya...</p>
                </div>
            </div>

            <!-- HEADER CARD -->
            <div class="bg-[#ffcc00] text-black p-4 sm:p-6 border-b-3 border-black">
                <h2 class="text-xl sm:text-2xl font-black uppercase">Detail Karya Siswa</h2>
                <p class="text-xs sm:text-sm font-bold mt-1">Informasi lengkap project yang diupload siswa.</p>
            </div>

            <!-- BODY CARD -->
            <div class="p-4 sm:p-6 space-y-6">
                <div class="border-2 border-black rounded-lg overflow-x-auto">
                    <table class="w-full text-xs sm:text-sm text-left font-bold">
                        <tbody class="divide-y-2 divide-black">

                            <tr class="bg-gray-50">
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50 w-1/3 sm:w-1/4">Nama Siswa</td>
                                <td class="p-3 sm:p-4">{{ $project->user->name ?? 'Tidak Diketahui' }}</td>
                            </tr>

                            <tr>
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Judul Project</td>
                                <td class="p-3 sm:p-4 font-black">{{ $project->title }}</td>
                            </tr>

                            <tr class="bg-gray-50">
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Jurusan</td>
                                <td class="p-3 sm:p-4">
                                    <span class="px-2.5 py-1 bg-blue-100 border-2 border-black rounded-md text-xs font-black text-blue-800 shadow-[2px_2px_0px_#000]">{{ $project->jurusan }}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Deskripsi</td>
                                <td class="p-3 sm:p-4 leading-relaxed">{{ $project->description ?? 'Deskripsi project tidak tersedia.' }}</td>
                            </tr>

                            <tr class="bg-gray-50">
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Link Project</td>
                                <td class="p-3 sm:p-4">
                                    @if(!empty($project->live_link))
                                        <a href="{{ $project->live_link }}" target="_blank" class="bg-blue-100 px-2.5 py-1 rounded border-2 border-black hover:bg-blue-200 font-bold underline inline-flex items-center gap-1 break-all shadow-[2px_2px_0px_#000]">
                                            {{ $project->live_link }} ↗
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>

                            @if(strtoupper($project->jurusan) === 'PPLG')
                            <tr>
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Link GitHub</td>
                                <td class="p-3 sm:p-4">
                                    @if(!empty($project->github_link))
                                        <a href="{{ $project->github_link }}" target="_blank" class="bg-blue-100 px-2.5 py-1 rounded border-2 border-black hover:bg-blue-200 font-bold underline inline-flex items-center gap-1 break-all shadow-[2px_2px_0px_#000]">
                                            {{ $project->github_link }} ↗
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endif

                            <tr class="bg-gray-50">
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Dokumentasi Project</td>
                                <td class="p-3 sm:p-4">
                                    @if(!empty($project->file_path))
                                        <div class="relative inline-block">
                                            <img src="{{ asset('storage/' . $project->file_path) }}"
                                                 alt="Dokumentasi"
                                                 class="w-20 h-20 sm:w-28 sm:h-28 object-cover rounded-lg border-2 border-black shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-x-0.5 hover:translate-y-0.5 transition"
                                                 onclick="openModal(this.src)">
                                        </div>

                                        <!-- MODAL PREVIEW GAMBAR -->
                                        <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/70 backdrop-blur-xs flex items-center justify-center p-4" onclick="closeModal()">
                                            <div class="relative max-w-2xl max-h-[85vh] bg-white border-3 border-black rounded-xl p-3 shadow-[6px_6px_0px_#000]" onclick="event.stopPropagation()">
                                                <button type="button" onclick="closeModal()" class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full border-2 border-black w-8 h-8 flex items-center justify-center text-sm font-black cursor-pointer shadow-[2px_2px_0px_#000]">
                                                    ✕
                                                </button>
                                                <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[75vh] rounded-lg border-2 border-black bg-white object-contain">
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Status</td>
                                <td class="p-3 sm:p-4">
                                    @if($project->status == 'pending')
                                        <span class="px-2.5 py-1 rounded-md bg-yellow-100 border-2 border-black text-yellow-800 text-xs font-black shadow-[2px_2px_0px_#000]">Menunggu Review</span>
                                    @elseif($project->status == 'approved')
                                        <span class="px-2.5 py-1 rounded-md bg-green-100 border-2 border-black text-green-800 text-xs font-black shadow-[2px_2px_0px_#000]">Disetujui</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-md bg-red-100 border-2 border-black text-red-800 text-xs font-black shadow-[2px_2px_0px_#000]">Ditolak</span>
                                    @endif
                                </td>
                            </tr>

                            <tr class="bg-gray-50">
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Upload</td>
                                <td class="p-3 sm:p-4">
                                    {{ $project->created_at?->format('d F Y H:i') ?? '-' }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- FORM REVIEW (JIKA PENDING) -->
                @if($project->status == 'pending')
                <div class="border-t-2 border-black pt-5">
                    <h2 class="text-base sm:text-lg font-black uppercase mb-3">Review Project</h2>

                    <form action="{{ url('/admin/karya/'.$project->id.'/update-status') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-xs sm:text-sm font-black mb-2 uppercase">Catatan Admin</label>
                            <textarea name="catatan" rows="3" class="w-full rounded-lg border-2 border-black p-3 text-xs sm:text-sm font-bold bg-gray-50 focus:bg-white focus:outline-none shadow-[2px_2px_0px_#000]" placeholder="Tulis catatan persetujuan atau penolakan..."></textarea>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <button type="submit" name="status" value="approved" class="flex-1 sm:flex-none bg-green-400 hover:bg-green-500 text-black px-5 py-2.5 rounded-xl font-black text-xs sm:text-sm border-2 border-black shadow-[3px_3px_0px_#000] cursor-pointer transition">
                                ✔ APPROVE
                            </button>

                            <button type="submit" name="status" value="rejected" class="flex-1 sm:flex-none bg-red-400 hover:bg-red-500 text-black px-5 py-2.5 rounded-xl font-black text-xs sm:text-sm border-2 border-black shadow-[3px_3px_0px_#000] cursor-pointer transition">
                                ✖ REJECT
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <!-- HASIL REVIEW (JIKA SUDAH DIREVIEW) -->
                @if($project->status != 'pending')
                <div class="bg-amber-50 border-2 border-black rounded-lg p-4 sm:p-5 shadow-[3px_3px_0px_#000] space-y-3">
                    <div>
                        <h2 class="font-black text-gray-900 text-sm sm:text-base uppercase mb-1.5">Catatan Review Admin</h2>
                        <p class="text-gray-800 text-xs sm:text-sm font-bold italic leading-relaxed">
                            "{{ $project->approval_note ?: ($project->rejection_reason ?: 'Tidak ada catatan.') }}"
                        </p>
                    </div>

                    <!-- Badge Reviewer di bawah catatan -->
                    <div>
                        <span class="inline-block text-xs font-black bg-[#ffcc00] border-2 border-black px-2.5 py-1 rounded-md shadow-[2px_2px_0px_#000]">
                            Reviewer: {{ $project->reviewer->name ?? 'Admin' }}
                        </span>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Modal Preview Gambar
        function openModal(imageSrc) {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            if (modal && modalImg) {
                modalImg.src = imageSrc;
                modal.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            }
        }

        function closeModal() {
            const modal = document.getElementById("imageModal");
            if (modal) {
                modal.classList.add("hidden");
                document.body.style.overflow = "auto";
            }
        }

        // Loading Screen
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