<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Detail Karya - Student Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto">
      
      <div class="mb-4">
       <a href="{{ url('/siswa/karya') }}"
   class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">
    ← Kembali ke Daftar Karya
</a>
      </div>

      <div class="bg-white rounded-lg shadow overflow-hidden relative min-h-[300px]">
        
        <div id="loading-content" class="absolute inset-0 bg-white z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
          <div class="flex items-center gap-3 bg-gray-50 px-6 py-3 rounded-full border border-gray-200 shadow-xs">
            <div class="w-5 h-5 border-3 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium text-sm tracking-wide">Memuat detail karya...</p>
          </div>
        </div>
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
          <h2 class="text-xl font-bold text-gray-900">Detail Informasi Karya</h2>
          <p class="text-sm text-gray-500 mt-0.5">Berikut rincian data project beserta umpan balik dari admin.</p>
        </div>

        <div class="p-6">
          <div class="overflow-hidden border border-gray-200 rounded-lg">
            <table class="w-full text-sm text-left text-gray-600">
              <tbody class="divide-y divide-gray-200">
                <tr class="bg-gray-50/50">
                  <td class="px-6 py-4 font-semibold text-gray-900 w-1/4">Judul Karya</td>
                  <td class="px-6 py-4 text-gray-800">{{ $project->title }}</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 font-semibold text-gray-900">Kategori</td>
                  <td class="px-6 py-4">
                    <span class="px-2.5 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">{{ $project->category?->name ?? '-' }}</span>
                  </td>
                </tr>
                <tr class="bg-gray-50/50">
                  <td class="px-6 py-4 font-semibold text-gray-900">Deskripsi</td>
                  <td class="px-6 py-4 leading-relaxed text-gray-700">{{ $project->description }}</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 font-semibold text-gray-900">URL Project</td>
                  <td class="px-6 py-4">
                   @if($project->live_link)
<a href="{{ $project->live_link }}"
   target="_blank"
   class="text-blue-600 hover:text-blue-800 font-medium underline inline-flex items-center gap-1 break-all">

    {{ $project->live_link }}

</a>
@else
<span class="text-gray-500">Tidak ada link</span>
@endif
                  </td>
                </tr>
                <tr class="bg-amber-50/40">
                  <td class="px-6 py-4 font-semibold text-amber-900">Catatan / Alasan Admin</td>
<td class="px-6 py-4">

    @if($project->status == 'approved')

        <p class="text-green-700 italic">
            {{ $project->approval_note ?? 'Project telah disetujui.' }}
        </p>

    @elseif($project->status == 'rejected')

        <p class="text-red-700 italic">
            {{ $project->rejection_reason }}
        </p>

    @else

        <p class="text-yellow-700">
            Project masih menunggu review admin.
        </p>

    @endif

    @if($project->reviewer)
        <span class="inline-block mt-2 text-[10px] bg-gray-100 text-gray-700 px-2 py-0.5 rounded font-semibold">
            Dikirim oleh: {{ $project->reviewer->name }}
        </span>
    @endif

</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script>
      window.addEventListener("load", function () {
        const loadingContent = document.getElementById("loading-content");

        // Jeda 1 detik agar animasi loading terasa halus sebelum data detail muncul
        setTimeout(() => {
          loadingContent.classList.add("opacity-0");

          setTimeout(() => {
            loadingContent.classList.add("hidden");
          }, 300); // Sinkron dengan durasi efek fade-out Tailwind (duration-300)
        }, 1000);
      });
    </script>
  </body>
</html>