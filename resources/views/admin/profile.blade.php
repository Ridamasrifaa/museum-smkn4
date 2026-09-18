@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('page_title', 'Pengaturan Profil')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="mb-6 neubrutal-card bg-green-100 px-4 py-3 font-bold text-green-900">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="mb-6 neubrutal-card bg-red-100 px-4 py-3">
            <ul class="list-disc list-inside font-bold text-red-800 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="neubrutal-card overflow-hidden">

        {{-- CARD HEADER INFORMASI AKUN --}}
        <div class="p-6 sm:p-8 border-b-3 border-black bg-[#fffdf9] flex items-center gap-4 sm:gap-5">
            <div class="w-14 h-14 sm:w-16 sm:h-16 bg-[#ffcc00] border-2 border-black rounded-2xl flex items-center justify-center font-black text-2xl text-black shadow-[3px_3px_0px_#000] shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg sm:text-xl font-black text-gray-900">{{ $user->name }}</h2>
                <p class="text-xs sm:text-sm mt-1">
                    <span class="badge-neubrutal bg-white text-gray-900">
                        {{ $user->isSuperAdmin() ? 'Super Admin' : 'Admin ' . ($user->jurusan ?? 'Jurusan') }}
                    </span>
                </p>
            </div>
        </div>

        {{-- FORM EDIT PROFIL --}}
        <form action="{{ route('admin.profile.update') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">

                {{-- NAMA LENGKAP --}}
                <div>
                    <label class="block text-sm font-black text-gray-900 mb-2">Nama Pengurus</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-black text-gray-900 mb-2">Email Akun</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                {{-- JURUSAN (READONLY / DISABLED) --}}
                <div>
                    <label class="block text-sm font-black text-gray-900 mb-2">Jurusan Tanggung Jawab</label>
                    <input type="text" value="{{ $user->jurusan ?? 'Semua Jurusan (Super Admin)' }}" disabled
                        class="w-full px-4 py-2.5 rounded-xl border-2 border-black bg-gray-100 text-gray-500 font-bold text-sm cursor-not-allowed">
                    <p class="text-xs font-bold text-gray-500 mt-1">*Jurusan hanya bisa diganti oleh Super Admin.</p>
                </div>

            </div>

            <hr class="border-t-3 border-black my-2">

            <div class="space-y-4">
                <h3 class="text-sm sm:text-base font-black text-gray-900">Ganti Password (Opsional)</h3>
                <p class="text-xs font-bold text-gray-500">Kosongkan kolom password di bawah ini jika tidak ingin mengubah password akun.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    {{-- PASSWORD BARU --}}
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-2">Password Baru</label>
                        <input type="password" name="password" placeholder="Minimal 6 karakter"
                            class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                            class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-3 border-t-3 border-black">
                <button type="submit"
                    class="px-6 py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal font-black text-sm cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection