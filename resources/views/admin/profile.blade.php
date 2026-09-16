@extends('layouts.admin')   

@section('title', 'Profil Saya')
@section('page_title', 'Pengaturan Profil')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl shadow-xs">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-xs">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        {{-- CARD HEADER INFORMASI AKUN --}}
        <div class="p-8 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-indigo-600 text-white flex items-center gap-5">
            <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center font-bold text-2xl border border-white/30 shadow-inner">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                <p class="text-blue-100 text-sm mt-0.5">
                    Role: <span class="font-semibold">{{ $user->isSuperAdmin() ? 'Super Admin' : 'Admin ' . ($user->jurusan ?? 'Jurusan') }}</span>
                </p>
            </div>
        </div>

        {{-- FORM EDIT PROFIL --}}
        <form action="{{ route('admin.profile.update') }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- NAMA LENGKAP --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pengurus</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Akun</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                </div>

                {{-- JURUSAN (READONLY / DISABLED) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jurusan Tanggung Jawab</label>
                    <input type="text" value="{{ $user->jurusan ?? 'Semua Jurusan (Super Admin)' }}" disabled
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                    <p class="text-xs text-gray-400 mt-1">*Jurusan hanya bisa diganti oleh Super Admin.</p>
                </div>

            </div>

            <hr class="border-gray-100 my-4">

            <div class="space-y-4">
                <h3 class="text-md font-bold text-gray-800">Ganti Password (Opsional)</h3>
                <p class="text-xs text-gray-500">Kosongkan kolom password di bawah ini jika tidak ingin mengubah password akun.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- PASSWORD BARU --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                        <input type="password" name="password" placeholder="Minimal 6 karakter"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" 
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-200 shadow-md text-sm cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection