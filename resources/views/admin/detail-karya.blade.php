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
        <div class="neubrutal-card relative overflow-hidden">

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
                                    <span class="badge-neubrutal bg-blue-100 text-blue-800">{{ $project->jurusan }}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Deskripsi</td>
                                <td class="p-3 sm:p-4 leading-relaxed">{{ $project->description ?? 'Deskripsi project tidak tersedia.' }}</td>
                            </tr>

<<<<<<< Updated upstream
                                        <tr>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4 font-semibold text-gray-900">Deskripsi</td>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4 leading-relaxed text-gray-700">{{ $project->description }}</td>
                                        </tr>

                                        <tr class="bg-gray-50/50">
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4 font-semibold text-gray-900">Link Project</td>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4">
                                                @if($project->live_link)
                                                    <a href="{{ $project->live_link }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline inline-flex items-center gap-1 break-all"> 
                                                        {{ $project->live_link }} ↗
                                                    </a>
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4 font-semibold text-gray-900">Dokumentasi project</td>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4">
                                                @if($project->file_path)
                                                    <div class="relative inline-block">
                                                        <img src="{{ asset('storage/' . $project->file_path) }}" 
                                                             alt="Dokumentasi" 
                                                             class="w-20 h-20 sm:w-28 sm:h-28 rounded-lg object-cover border border-gray-200 shadow-xs cursor-pointer hover:opacity-80 transition duration-200"
                                                             onclick="openModal(this.src)">
                                                    </div>

                                                    {{-- MODAL PREVIEW GAMBAR --}}
                                                    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/70 backdrop-blur-xs flex items-center justify-center p-4" onclick="closeModal()">
                                                        <div class="relative max-w-2xl max-h-[85vh] bg-white rounded-xl p-2 shadow-2xl" onclick="event.stopPropagation()">
                                                            <button onclick="closeModal()" class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-xs font-bold shadow-lg cursor-pointer">
                                                                ✕
                                                            </button>
                                                            <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[75vh] rounded-lg object-contain">
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr class="bg-gray-50/50">
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4 font-semibold text-gray-900">Status</td>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4">
                                                @if($project->status=='pending')
                                                    <span class="px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 text-[11px] sm:text-xs font-semibold">
                                                        Menunggu Review
                                                    </span>
                                                @elseif($project->status=='approved')
                                                    <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-[11px] sm:text-xs font-semibold">
                                                        Disetujui
                                                    </span>
                                                @else
                                                    <span class="px-2.5 py-1 rounded-full bg-red-100 text-red-700 text-[11px] sm:text-xs font-semibold">
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4 font-semibold text-gray-900">Upload</td>
                                            <td class="px-3.5 py-3 sm:px-6 sm:py-4 text-gray-700">
                                                {{ $project->created_at->format('d F Y H:i') }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            {{-- FORM REVIEW (PENDING) --}}
                            @if($project->status=='pending')
                                <div class="border-t border-gray-200 pt-5">
                                    <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-3">Review Project</h2>
                                    
                                    <form action="{{ url('/admin/karya/'.$project->id.'/update-status') }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">Catatan Admin</label>
                                            <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded-lg p-3 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700" placeholder="Tulis catatan atau alasan persetujuan/penolakan untuk siswa..."></textarea>
                                        </div>

                                        <div class="flex flex-wrap gap-2.5 sm:gap-3">
                                            <button type="submit" name="status" value="approved" class="flex-1 sm:flex-none justify-center flex items-center gap-1.5 bg-green-600 hover:bg-green-700 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg text-xs sm:text-sm font-semibold transition shadow-xs cursor-pointer">
                                                ✔ Approve
                                            </button>
                                            
                                            <button type="submit" name="status" value="rejected" class="flex-1 sm:flex-none justify-center flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg text-xs sm:text-sm font-semibold transition shadow-xs cursor-pointer">
                                                ✖ Reject
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            {{-- HASIL REVIEW --}}
                            @if($project->status!='pending')
                                <div class="bg-amber-50/40 border border-amber-200 rounded-lg p-4 sm:p-5">
                                    <h2 class="font-bold text-gray-900 text-sm sm:text-base mb-1.5">Hasil Review</h2>
                                    
                                    @if($project->status=='approved')
                                        <p class="text-green-800 text-xs sm:text-sm italic font-medium leading-relaxed">
                                            <strong>Catatan :</strong> "{{ $project->approval_note ?? 'Tidak ada catatan.' }}"
                                        </p>
=======
                            <tr class="bg-gray-50">
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Link Project</td>
                                <td class="p-3 sm:p-4">
                                    @if(!empty($project->live_link))
                                        <a href="{{ $project->live_link }}" target="_blank" class="bg-blue-100 px-2 py-1 rounded border-2 border-black hover:bg-blue-200 font-bold underline inline-flex items-center gap-1 break-all">
                                            {{ $project->live_link }} ↗
                                        </a>
>>>>>>> Stashed changes
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>

                            @if(strtoupper($project->jurusan) === 'PPLG')
                            <tr>
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Link GitHub</td>
                                <td class="p-3 sm:p-4">
                                    @if(!empty($project->github_link))
                                        <a href="{{ $project->github_link }}" target="_blank" class="bg-blue-100 px-2 py-1 rounded border-2 border-black hover:bg-blue-200 font-bold underline inline-flex items-center gap-1 break-all">
                                            {{ $project->github_link }} ↗
                                        </a>
                                    @else
                                        <span>-</span>
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
                                                 class="w-20 h-20 sm:w-28 sm:h-28 object-cover rounded-lg border-2 border-black shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-x-1 hover:translate-y-1 transition"
                                                 onclick="openModal(this.src)">
                                        </div>

                                        <!-- MODAL PREVIEW GAMBAR -->
                                        <div id="imageModal" class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center p-4" onclick="closeModal()">
                                            <div class="relative max-w-2xl max-h-[85vh] modal-card p-3" onclick="event.stopPropagation()">
                                                <button type="button" onclick="closeModal()" class="absolute -top-4 -right-4 bg-red-500 text-white rounded-full border-2 border-black w-8 h-8 flex items-center justify-center text-sm font-black cursor-pointer shadow-[2px_2px_0px_#000] btn-neubrutal">
                                                    ✕
                                                </button>
                                                <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[75vh] rounded-lg border-2 border-black bg-white object-contain">
                                            </div>
                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="p-3 sm:p-4 border-r-2 border-black bg-yellow-50">Status</td>
                                <td class="p-3 sm:p-4">
                                    @if($project->status == 'pending')
                                        <span class="badge-neubrutal bg-yellow-100 text-yellow-800">Menunggu Review</span>
                                    @elseif($project->status == 'approved')
                                        <span class="badge-neubrutal bg-green-100 text-green-800">Disetujui</span>
                                    @else
                                        <span class="badge-neubrutal bg-red-100 text-red-800">Ditolak</span>
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
                            <textarea name="catatan" rows="3" class="w-full rounded-lg input-neubrutal p-3 text-xs sm:text-sm font-bold bg-gray-50 focus:bg-white focus:outline-none" placeholder="Tulis catatan persetujuan atau penolakan..."></textarea>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <button type="submit" name="status" value="approved" class="flex-1 sm:flex-none bg-green-400 hover:bg-green-500 text-black px-5 py-2.5 rounded-xl font-black text-xs sm:text-sm btn-neubrutal cursor-pointer">
                                ✔ APPROVE
                            </button>

                            <button type="submit" name="status" value="rejected" class="flex-1 sm:flex-none bg-red-400 hover:bg-red-500 text-black px-5 py-2.5 rounded-xl font-black text-xs sm:text-sm btn-neubrutal cursor-pointer">
                                ✖ REJECT
                            </button>
                        </div>
                    </form>
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