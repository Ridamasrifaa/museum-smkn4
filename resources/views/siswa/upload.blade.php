@extends('layouts.siswa')

@section('title', 'Kirim Project')

@section('content')
<!-- Data penanda session success untuk ditangkap file JS eksternal -->
<div id="pageData" data-success="{{ session('success') ? 'true' : 'false' }}" class="hidden"></div>

<div class="p-6 md:p-8 w-full flex justify-center items-start my-auto">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-lg p-6 md:p-8 my-6">

        <!-- Pilihan Jurusan -->
        <div class="flex flex-row justify-center gap-3 flex-wrap">
            @foreach ($jurusanList as $jurusan)
                <button type="button"
                    onclick="pilihJurusan('{{ $jurusan }}', event)"
                    class="btn-jurusan cursor-pointer w-[100px] px-3 py-2 rounded-lg text-white font-semibold text-sm {{ $jurusanColor[$jurusan] }}">
                    {{ $jurusan }}
                </button>
            @endforeach
        </div>

        <hr class="my-6 border-gray-200" />

        <div id="pilihJurusanNotice">
            <p id="pilihJurusanText" class="text-center text-sm font-medium text-gray-500 mb-2">Pilih Jurusan Kamu Terlebih Dahulu</p>

            <!-- Pesan jika belum memilih jurusan -->
            <div id="belumPilihJurusan" class="text-center text-gray-400 py-6">
                <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <p class="text-sm">Silahkan pilih jurusan di atas untuk menampilkan form Kirim.</p>
            </div>
        </div>

        @foreach ($jurusanList as $jurusan)
            <form id="form_{{ $jurusan }}" method="POST" action="{{ url('/siswa/upload') }}"
                enctype="multipart/form-data" class="hidden space-y-6 mt-4" novalidate>
                @csrf

                <div class="text-center mb-4">
                    <span class="inline-block text-sm font-semibold px-4 py-1.5 rounded-full text-white {{ $jurusanBadge[$jurusan] }}">
                        Form Kirim karya - {{ $jurusan }}
                    </span>
                </div>

                <input type="hidden" name="jurusan" value="{{ $jurusan }}" />

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Karya *</label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                        placeholder="Contoh: Aplikasi Kasir Berbasis Web"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    @error('title')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        @switch($jurusan)
                            @case('PPLG') Bahasa Pemrograman / Framework yang Digunakan * @break
                            @case('DKV') Software Desain yang Digunakan * @break
                            @case('TOI') Jenis Alat / Mesin Otomasi * @break
                        @endswitch
                    </label>
                    <input type="text" name="technology_stack" required value="{{ old('technology_stack') }}"
                        placeholder="@switch($jurusan)
                            @case('PPLG') Contoh: Laravel, React, Flutter @break
                            @case('DKV') Contoh: Adobe Photoshop, Figma, CorelDRAW @break
                            @case('TOI') Contoh: PLC, Arduino, Sensor IoT @break
                        @endswitch"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    @error('technology_stack')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Karya *</label>
                    <textarea name="description" required rows="4"
                        placeholder="Jelaskan fitur dan cara kerja karya yang kamu buat....."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        @switch($jurusan)
                            @case('PPLG') Link Repository (GitHub/GitLab) * @break
                            @case('DKV') Link Portfolio (Behance/Dribbble/Drive) * @break
                            @case('TOI') Link Video Demo Alat (YouTube/Drive) * @break
                        @endswitch
                    </label>
                    <input type="url" name="live_link" required value="{{ old('live_link') }}"
                        placeholder="https://"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    @error('live_link')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        @switch($jurusan)
                            @case('PPLG') Screenshot Tampilan Aplikasi * @break
                            @case('DKV') File Hasil Desain * @break
                            @case('TOI') Foto Alat / Mesin * @break
                        @endswitch
                    </label>
                    <input type="file" name="file_path" accept="image/*" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                    @error('file_path')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border border-gray-200 rounded-lg bg-gray-50 p-4 space-y-3">
                    <h4 class="text-sm font-bold text-gray-800">Syarat & Ketentuan Upload Karya:</h4>
                    <ul class="text-xs text-gray-600 list-disc list-inside space-y-1">
                        <li>Karya atau kode program harus asli hasil buatan sendiri/tim kelompok (bukan plagiat).</li>
                        <li>Link yang dicantumkan harus bersifat publik agar bisa diperiksa oleh Admin.</li>
                        <li>Karya yang melanggar hak cipta atau mengandung konten negatif akan langsung dihapus.</li>
                        <li>Karya adalah buatan siswa SMK 4 aktif dan alumni.</li>
                        <li>Karya tidak mengandung SARA.</li>
                    </ul>

                    <hr class="border-gray-200 my-2" />

                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="agree_{{ $jurusan }}"
                            class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                            onchange="toggleSubmitButton('{{ $jurusan }}')" />
                        <label for="agree_{{ $jurusan }}"
                            class="text-xs text-gray-700 leading-normal font-medium cursor-pointer select-none">
                            Saya menyetujui semua syarat dan ketentuan di atas serta menjamin bahwa project yang saya upload adalah karya asli saya sendiri.
                        </label>
                    </div>
                </div>

                <div class="flex gap-4 pt-2">
                    <button type="button" onclick="resetForm('{{ $jurusan }}')"
                        class="flex-1 px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Reset</button>
                    <button type="submit" id="submit_{{ $jurusan }}" disabled
                        class="flex-1 px-6 py-2 bg-gray-400 text-white rounded-lg font-medium shadow-md cursor-not-allowed transition">Kirim Karya</button>
                </div>
            </form>
        @endforeach
    </div>
</div>

{{-- ================= MODAL SUCCESS SUDAH KIRIM KARYA ================= --}}
<div id="successModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden transform transition-all p-6 text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h3 class="text-xl font-bold text-gray-900 mb-2">Berhasil Kirim Karya!</h3>
        <p class="text-gray-600 text-sm leading-relaxed mb-6">
            {{ session('success', 'Karya kamu berhasil di-upload! Mantapp siip kawann...') }}
        </p>

        <a href="{{ url('/siswa/dashboard') }}"
            class="block w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition">
            Ke Dashboard Sekarang
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-jurusan {
        opacity: 0.55;
        transition: all 0.15s ease-in-out;
        cursor: pointer;
    }

    .btn-jurusan.active {
        opacity: 1;
        outline: 3px solid #111827;
        outline-offset: 2px;
        transform: scale(1.03);
    }

    .was-validated input:invalid,
    .was-validated textarea:invalid,
    .was-validated select:invalid {
        border-color: #dc2626;
    }

    .was-validated input:invalid:focus,
    .was-validated textarea:invalid:focus,
    .was-validated select:invalid:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.25);
    }
</style>
@endpush

@push('scripts')
    {{-- Panggil file JS eksternal kamu di sini --}}
    <script src="{{ asset('assets/js/siswa/upload-project.js') }}"></script>
@endpush