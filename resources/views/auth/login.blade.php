
@extends('layouts.app')

@section('title','Login')

@section('content')

<section class="min-h-[80vh] flex items-center justify-center">

    <div class="grid lg:grid-cols-2 gap-16 items-center w-full max-w-6xl">

        <!-- KIRI -->

        <div class="hidden lg:block">

            <span class="px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400">

                Museum Digital

            </span>

            <h1 class="text-6xl font-black mt-8 leading-tight">

                Selamat Datang
                <span class="text-blue-500">

                    Kembali

                </span>

            </h1>

            <p class="text-slate-400 mt-8 leading-8">

                Login untuk mengunggah karya,
                mengelola artikel,
                dan melihat perkembangan
                Galeri Digital SMKN 4 Tasikmalaya.

            </p>

            <div class="grid grid-cols-2 gap-6 mt-12">

                <div class="card p-6">

                    <h2 class="text-4xl font-black text-blue-500">

                        375+

                    </h2>

                    <p class="text-slate-400 mt-2">

                        Total Karya

                    </p>

                </div>

                <div class="card p-6">

                    <h2 class="text-4xl font-black text-blue-500">

                        216+

                    </h2>

                    <p class="text-slate-400 mt-2">

                        Siswa Aktif

                    </p>

                </div>

            </div>

        </div>

        <!-- FORM -->

        <div>

            <div class="card p-10 backdrop-blur-xl">

                <h2 class="text-4xl font-black text-center">

                    Login

                </h2>

                <p class="text-center text-slate-400 mt-3">

                    Masuk ke akun Museum SMKN 4

                </p>
@if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded-lg">
        {{ $errors->first() }}
    </div>
@endif
                <form action="{{ route('login') }}" method="POST" class="mt-10">
                        @csrf
                    <div class="mb-6">

                        <label class="block mb-3">

                            Email

                        </label>

<input
    type="email"
    name="email"
    placeholder="email@gmail.com"
    value="{{ old('email') }}"
    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 focus:border-blue-500 outline-none">

                    </div>

                    <div class="mb-6">

                        <label class="block mb-3">

                            Password

                        </label>

                      <input
    type="password"
    name="password"
    placeholder="********"
    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 focus:border-blue-500 outline-none">

                    </div>

                    <div class="flex justify-between items-center mb-8">

                        <label class="flex items-center gap-2">

                            <input type="checkbox">

                            <span class="text-slate-400">

                                Ingat Saya

                            </span>

                        </label>

                        <a href="#"
                        class="text-blue-400">

                            Lupa Password?

                        </a>

                    </div>

                    <button
                    class="btn-primary w-full">

                        Login

                    </button>
                        <div class="relative my-6 text-center">
    <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-slate-700"></div>
    </div>
    <div class="relative flex justify-center text-sm">
        <span class="px-2 bg-slate-800 text-slate-400">Atau</span>
    </div>
</div>

<a href="{{ route('google.login') }}" 
   class="flex items-center justify-center gap-3 w-full bg-white text-slate-900 font-bold py-4 rounded-xl hover:bg-slate-200 transition">
   <span>Login dengan Google</span>
</a>
                </form>

                <div class="text-center mt-8 text-slate-400">

                    Belum punya akun?

                    <a href="#"
                    class="text-blue-400">

                        Hubungi Admin

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
