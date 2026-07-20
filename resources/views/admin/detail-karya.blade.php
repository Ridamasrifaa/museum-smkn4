<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Detail Karya Admin - Student Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto">
      
      <div class="mb-4">
        <a href="{{ url('/admin/karya') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800 transition"> 
          ← Kembali ke Data Karya 
        </a>
      </div>

      <div class="bg-white rounded-lg shadow overflow-hidden relative min-h-[300px]">
        <div id="loading-content" class="absolute inset-0 bg-white z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
          <div class="flex items-center gap-3 bg-gray-50 px-6 py-3 rounded-full border border-gray-200 shadow-xs">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat detail karya...</p>
          </div>
        </div>

        <div class="bg-blue-600 text-white px-8 py-5">
          <h1 class="text-2xl font-bold">Detail Karya Siswa</h1>
          <p class="text-blue-100 text-sm mt-0.5">Informasi lengkap project yang diupload siswa.</p>
        </div>

        <div class="p-6">
          <div class="overflow-hidden border border-gray-200 rounded-lg">
            <table class="w-full text-sm text-left text-gray-600">
              <tbody class="divide-y divide-gray-200">
                
                <tr class="bg-gray-50/50">
                  <td class="px-6 py-4 font-semibold text-gray-900 w-1/4">Nama Siswa</td>
                  <td class="px-6 py-4 text-gray-800">{{ $project->user->name }}</td>
                </tr>

                <tr>
                  <td class="px-6 py-4 font-semibold text-gray-900">Judul Project</td>
                  <td class="px-6 py-4 text-gray-800 font-medium">{{ $project->title }}</td>
                </tr>

                <tr class="bg-gray-50/50">
                  <td class="px-6 py-4 font-semibold text-gray-900">Jurusan</td>
                  <td class="px-6 py-4">
                    <span class="px-2.5 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                      {{ $project->jurusan }}
                    </span>
                  </td>
                </tr>

                <tr>
                  <td class="px-6 py-4 font-semibold text-gray-900">Deskripsi</td>
                  <td class="px-6 py-4 leading-relaxed text-gray-700">{{ $project->description }}</td>
                </tr>

                <tr class="bg-gray-50/50">
                  <td class="px-6 py-4 font-semibold text-gray-900">Link Project</td>
                  <td class="px-6 py-4">
                    @if($project->live_link)
                      <a href="{{ $project->live_link }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline inline-flex items-center gap-1 break-all"> 
                        {{ $project->live_link }} ↗
                      </a>
                    @else
                      <span class="text-gray-500">-</span>
                    @endif
                  </td>
                </tr>

                <tr class="bg-gray-50/50">
                  <td class="px-6 py-4 font-semibold text-gray-900">Dokumentasi project</td>
                  <td class="px-6 py-4">
                    @if($project->file_path)
                      <!-- Tampilan Gambar Utama (Bisa Diklik) -->
                      <div class="relative inline-block">
                        <img src="{{ asset('storage/' . $project->file_path) }}" 
                            alt="Dokumentasi" 
                            class="w-32 h-auto rounded-lg object-cover shadow-sm cursor-pointer hover:opacity-80 transition duration-200"
                            onclick="openModal(this.src)"> <!-- Cukup panggil this.src -->
                      </div>

                      <!-- Struktur Modal Pop-up (Tersembunyi secara default) -->
                      <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/70 backdrop-blur-sm flex items-center justify-center p-4" onclick="closeModal()">
                        <div class="relative max-w-3xl max-h-[90vh] bg-white rounded-xl p-2 shadow-2xl" onclick="event.stopPropagation()">
                          <!-- Tombol Close -->
                          <button onclick="closeModal()" class="absolute -top-4 -right-4 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-lg">
                            ✕
                          </button>
                          <!-- Gambar di dalam Pop-up -->
                          <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[80vh] rounded-lg object-contain">
                        </div>
                      </div>
                    @else
                      <span class="text-gray-500">-</span>
                    @endif
                  </td>
                </tr>

                <tr>
                  <td class="px-6 py-4 font-semibold text-gray-900">Status</td>
                  <td class="px-6 py-4">
                    @if($project->status=='pending')
                      <span class="px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                        Menunggu Review
                      </span>
                    @elseif($project->status=='approved')
                      <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                        Disetujui
                      </span>
                    @else
                      <span class="px-2.5 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                        Ditolak
                      </span>
                    @endif
                  </td>
                </tr>

                <tr class="bg-gray-50/50">
                  <td class="px-6 py-4 font-semibold text-gray-900">Upload</td>
                  <td class="px-6 py-4 text-gray-700">
                    {{ $project->created_at->format('d F Y H:i') }}
                  </td>
                </tr>

              </tbody>
            </table>
          </div>

          @if($project->status=='pending')
            <div class="mt-8 border-t border-gray-200 pt-6">
              <h2 class="text-lg font-bold text-gray-900 mb-4">Review Project</h2>
              
              <form action="{{ url('/admin/karya/'.$project->id.'/update-status') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Admin</label>
                  <textarea name="catatan" rows="4" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700" placeholder="Tulis catatan atau alasan persetujuan/penolakan untuk siswa..."></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                  <button type="submit" name="status" value="approved" class="flex items-center gap-1.5 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-xs cursor-pointer">
                    ✔ Approve
                  </button>
                  
                  <button type="submit" name="status" value="rejected" class="flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-xs cursor-pointer">
                    ✖ Reject
                  </button>
                </div>
              </form>
            </div>
          @endif

          @if($project->status!='pending')
            <div class="mt-6 bg-amber-50/40 border border-amber-200 rounded-lg p-5">
              <h2 class="font-bold text-gray-900 text-base mb-2">Hasil Review</h2>
              
              @if($project->status=='approved')
                <p class="text-green-800 text-sm italic font-medium leading-relaxed">
                  <strong>Catatan :</strong> "{{ $project->approval_note ?? 'Tidak ada catatan.' }}"
                </p>
              @else
                <p class="text-red-800 text-sm italic font-medium leading-relaxed">
                  <strong>Alasan Penolakan :</strong> "{{ $project->rejection_reason }}"
                </p>
              @endif

              @if($project->reviewer)
                <div class="mt-3 pt-2 border-t border-amber-200/60">
                  <span class="inline-block text-[11px] bg-white text-gray-700 px-2.5 py-0.5 rounded border border-gray-200 font-medium"> 
                    Direview oleh: <strong class="text-gray-900">{{ $project->reviewer->name }}</strong>
                  </span>
                </div>
              @endif
            </div>
          @endif

        </div>
      </div>
    </div>

    <script src="{{ asset('assets/js/admin/detail.js')}}"></script>
  </body>
</html>