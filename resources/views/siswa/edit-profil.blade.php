@extends('layouts.siswa')

@section('title', 'Edit Profil')

@section('content')
<div class="flex-1 p-6 md:p-10 overflow-y-auto">

    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Profil</h1>
            <a href="{{ url('/siswa/profil') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                &larr; Kembali ke Profil
            </a>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi error validasi umum --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
                Terdapat kesalahan pada input. Mohon periksa kembali form di bawah.
            </div>
        @endif

        <form action="{{ url('/siswa/profil') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl shadow-sm p-6 md:p-10">
            @csrf
            @method('PUT')

            {{-- ============ FOTO PROFIL ============ --}}
            <div class="flex flex-col items-center text-center mb-8">
                <div class="relative">
                    <div class="p-1 rounded-full" style="background: linear-gradient(135deg, #2563eb, #1e40af);">
                        <img id="avatar-preview"
                            src="{{ Auth::user()->avatar ?? 'https://api.dicebear.com/7.x/initials/svg?seed=' . urlencode(Auth::user()->name) . '&backgroundColor=2563eb&textColor=ffffff' }}"
                            alt="Foto Profil"
                            class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover border-4 border-white">
                    </div>
                    <label for="avatar"
                        class="absolute bottom-1 right-1 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full cursor-pointer shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828H9V13z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 19h14" />
                        </svg>
                    </label>
                    <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden"
                        onchange="previewAvatar(event)">
                </div>
                <p class="mt-3 text-xs text-gray-400">JPG atau PNG, maksimal 2MB</p>
                @error('avatar')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t border-gray-100 mb-8"></div>

            {{-- ============ DATA DIRI ============ --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1.5">Kelas</label>
                    <input type="text" name="kelas" id="kelas" placeholder="Contoh: XII PPLG 1"
                        value="{{ old('kelas', $siswa->kelas ?? '') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:border-blue-500 focus:ring-blue-500">
                    @error('kelas')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1.5">Jurusan</label>
                    <select name="jurusan" id="jurusan"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @php $jurusanTerpilih = old('jurusan', $siswa->jurusan ?? ''); @endphp
                        <option value="" disabled {{ $jurusanTerpilih == '' ? 'selected' : '' }}>Pilih Jurusan</option>
                        <option value="PPLG" {{ $jurusanTerpilih == 'PPLG' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim</option>
                        <option value="DKV" {{ $jurusanTerpilih == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                        <option value="TOI" {{ $jurusanTerpilih == 'TOI' ? 'selected' : '' }}>Teknik Otomasi Industri</option>
                    </select>
                    @error('jurusan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-1.5">Angkatan</label>
                    <input type="number" name="angkatan" id="angkatan" placeholder="Contoh: 2023"
                        value="{{ old('angkatan', $siswa->angkatan ?? '') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('angkatan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-t border-gray-100 my-8"></div>
            <div>
                <h3 class="font-semibold text-sm text-gray-900 mb-1">Ganti Password</h3>
                <p class="text-xs text-gray-400 mb-4">Kosongkan bagian ini jika tidak ingin mengganti password.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                        <input type="password" name="password" id="password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            {{-- ============ TOMBOL AKSI ============ --}}
            <div class="flex items-center justify-end gap-3 mt-10 pt-6 border-t border-gray-100">
                <a href="{{ url('/siswa/profil') }}"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush