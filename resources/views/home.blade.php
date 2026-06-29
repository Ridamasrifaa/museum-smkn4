@extends('layouts.app')

@section('title', 'Museum SMKN 4 Tasikmalaya')

@section('content')

<!-- HERO -->

<section class="relative overflow-hidden">

    <div class="grid lg:grid-cols-2 gap-12 items-center py-20">

        <div>

            <span
                class="px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm">
                ✨
                @extends('layouts.app')

@section('title','Museum SMKN 4 Tasikmalaya')

@section('content')

<!-- HERO -->
<section class="relative py-24">

    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/20 blur-[180px] rounded-full"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-500/20 blur-[180px] rounded-full"></div>

    <div class="grid lg:grid-cols-2 gap-16 items-center">

        <div>

            <span class="inline-block px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-400 text-sm mb-6">
                🚀 Galeri Digital SMKN 4 Tasikmalaya
            </span>

            <h1 class="text-5xl lg:text-7xl font-black leading-tight">

                Galeri
                <span class="text-blue-500">
                    Karya Digital
                </span>
                Siswa PPLG

            </h1>

            <p class="mt-8 text-slate-400 text-lg leading-8">

                Eksplorasi karya Website, UI/UX,
                Mobile App, Poster, Game,
                Video Editing, 3D Modeling
                dan berbagai project terbaik siswa
                SMKN 4 Tasikmalaya.

            </p>

            <div class="flex gap-4 mt-10">

                <a href="/login" class="btn-primary">
                    Upload Karya
                </a>

                <a href="/karya" class="btn-outline">
                    Telusuri Karya
                </a>

            </div>

        </div>

        <div>

            <div class="card p-8">

                <img
                src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=900"
                class="rounded-2xl w-full">

            </div>

        </div>

    </div>

</section>

<!-- STATISTIK -->

<section class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">

<div class="card p-8 text-center">

<h2 class="text-5xl font-black text-blue-500">

375+

</h2>

<p class="text-slate-400 mt-3">

Total Karya

</p>

</div>

<div class="card p-8 text-center">

<h2 class="text-5xl font-black text-blue-500">

284+

</h2>

<p class="text-slate-400 mt-3">

Artikel

</p>

</div>

<div class="card p-8 text-center">

<h2 class="text-5xl font-black text-blue-500">

216+

</h2>

<p class="text-slate-400 mt-3">

Siswa

</p>

</div>

<div class="card p-8 text-center">

<h2 class="text-5xl font-black text-blue-500">

15

</h2>

<p class="text-slate-400 mt-3">

Guru Pembimbing

</p>

</div>

</section>

<!-- SEARCH -->

<section class="mt-24">

<div class="flex justify-between items-center mb-8">

<div>

<h2 class="section-title">

Cari Karya

</h2>

<p class="section-desc">

Temukan karya siswa berdasarkan kategori.

</p>

</div>

</div>

<div class="card p-6">

<div class="grid lg:grid-cols-5 gap-5">

<input
type="text"
placeholder="Cari judul karya..."
class="lg:col-span-3 bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 outline-none focus:border-blue-500">

<select
class="bg-slate-900 border border-slate-700 rounded-xl px-5">

<option>Semua</option>
<option>Website</option>
<option>Game</option>
<option>Poster</option>
<option>Video</option>
<option>Aplikasi</option>

</select>

<button class="btn-primary">

Cari Karya

</button>

</div>

</div>

</section>

<!-- KATEGORI -->

<section class="mt-16">

<div class="flex flex-wrap gap-4">

@php

$kategori=[
'Website',
'UI UX',
'Game',
'Aplikasi',
'Poster',
'Grafis',
'Video',
'Audio',
'3D',
'Fotografi'
];

@endphp

@foreach($kategori as $item)

<button
class="px-5 py-3 rounded-full border border-slate-700 hover:bg-blue-600 hover:border-blue-600 transition">

{{ $item }}

</button>

@endforeach

</div>

</section>
<!-- KARYA TERBARU -->

<section class="mt-24">

    <div class="flex justify-between items-center mb-10">

        <div>

            <h2 class="section-title">
                Karya Terbaru
            </h2>

            <p class="section-desc">
                Hasil Project Based Learning siswa PPLG.
            </p>

        </div>

        <a href="/karya" class="text-blue-400 hover:text-blue-300">
            Lihat Semua →
        </a>

    </div>

    @php

    $karya = [

    [
        'kategori'=>'Website',
        'judul'=>'Museum Digital SMKN 4',
        'author'=>'Ridda Masrifa',
        'gambar'=>'https://picsum.photos/600/400?random=1'
    ],

    [
        'kategori'=>'UI UX',
        'judul'=>'Coffee Shop Mobile App',
        'author'=>'Naufal',
        'gambar'=>'https://picsum.photos/600/400?random=2'
    ],

    [
        'kategori'=>'Game',
        'judul'=>'Forest Escape',
        'author'=>'Adit',
        'gambar'=>'https://picsum.photos/600/400?random=3'
    ],

    [
        'kategori'=>'Poster',
        'judul'=>'Hari Pendidikan',
        'author'=>'Nisa',
        'gambar'=>'https://picsum.photos/600/400?random=4'
    ],

    [
        'kategori'=>'Aplikasi',
        'judul'=>'Kasir Laravel',
        'author'=>'Salsa',
        'gambar'=>'https://picsum.photos/600/400?random=5'
    ],

    [
        'kategori'=>'Grafis',
        'judul'=>'Brand Identity',
        'author'=>'Fajar',
        'gambar'=>'https://picsum.photos/600/400?random=6'
    ]

    ];

    @endphp

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($karya as $item)

        <div class="card overflow-hidden group">

            <div class="overflow-hidden">

                <img
                src="{{ $item['gambar'] }}"
                class="w-full h-56 object-cover group-hover:scale-110 duration-500">

            </div>

            <div class="p-6">

                <span class="text-xs bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full">

                    {{ $item['kategori'] }}

                </span>

                <h3 class="text-2xl font-bold mt-4">

                    {{ $item['judul'] }}

                </h3>

                <p class="text-slate-400 mt-3">

                    oleh {{ $item['author'] }}

                </p>

                <div class="flex justify-between items-center mt-6">

                    <div class="text-yellow-400">

                        ⭐⭐⭐⭐⭐

                    </div>

                    <a
                    href="#"
                    class="text-blue-400 hover:text-blue-300">

                        Lihat →

                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>



<!-- POPULER -->

<section class="mt-24">

<div class="flex justify-between items-center mb-10">

<div>

<h2 class="section-title">

🔥 Populer Bulan Ini

</h2>

<p class="section-desc">

Karya yang paling banyak dilihat.

</p>

</div>

<a href="/karya" class="text-blue-400">

Lihat Semua →

</a>

</div>

<div class="grid lg:grid-cols-3 gap-8">

@for($i=1;$i<=3;$i++)

<div class="card p-7">

<div class="flex justify-between">

<span class="text-blue-400">

Game

</span>

<span class="text-yellow-400">

⭐ 5.0

</span>

</div>

<h2 class="text-2xl font-bold mt-5">

Forest Escape {{$i}}

</h2>

<p class="text-slate-400 mt-3">

Game petualangan 2D berbasis Unity dengan puzzle interaktif.

</p>

<div class="flex justify-between mt-8">

<div>

<p class="text-slate-500">

Dilihat

</p>

<h3 class="text-xl font-bold">

{{ rand(80,220) }}

</h3>

</div>

<a href="#" class="btn-primary">

Lihat

</a>

</div>

</div>

@endfor

</div>

</section>

<!-- ===========================
     KARYA TERBAIK
=========================== -->

<section class="mt-24">

    <div class="flex justify-between items-center mb-10">

        <div>
            <h2 class="section-title">
                🏆 Karya Terbaik
            </h2>

            <p class="section-desc">
                Karya dengan penilaian tertinggi dari guru pembimbing.
            </p>
        </div>

        <a href="/karya" class="text-blue-400 hover:text-blue-300">
            Lihat Semua →
        </a>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        @for($i=1;$i<=3;$i++)

        <div class="card overflow-hidden">

            <img
            src="https://picsum.photos/600/350?random={{$i+10}}"
            class="h-56 w-full object-cover">

            <div class="p-6">

                <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">

                    Website

                </span>

                <h2 class="text-2xl font-bold mt-5">

                    Web Portfolio V{{$i}}

                </h2>

                <p class="text-slate-400 mt-3">

                    Portfolio modern menggunakan Laravel &
                    Tailwind CSS.

                </p>

                <div class="flex justify-between items-center mt-6">

                    <div>

                        ⭐⭐⭐⭐⭐

                    </div>

                    <a href="#" class="text-blue-400">

                        Detail →

                    </a>

                </div>

            </div>

        </div>

        @endfor

    </div>

</section>



<!-- ===========================
     SISWA TERBAIK
=========================== -->

<section class="mt-24">

<div class="flex justify-between items-center mb-10">

<div>

<h2 class="section-title">

👨‍🎓 Siswa Terbaik

</h2>

<p class="section-desc">

Peraih poin terbanyak bulan ini.

</p>

</div>

<a href="#"
class="text-blue-400">

Lihat Semua →

</a>

</div>

<div class="grid lg:grid-cols-4 gap-8">

@php

$siswa=[

"Ridda Masrifa",

"Naufal",

"Aditya",

"Salsa"

];

@endphp

@foreach($siswa as $nama)

<div class="card p-8 text-center">

<img

src="https://ui-avatars.com/api/?background=2563eb&color=fff&size=200&name={{ urlencode($nama) }}"

class="w-24 h-24 rounded-full mx-auto">

<h3 class="font-bold text-xl mt-5">

{{ $nama }}

</h3>

<p class="text-slate-400">

PPLG XI

</p>

<div class="mt-6">

<div class="text-4xl font-black text-blue-500">

{{ rand(300,1500) }}

</div>

<div class="text-slate-400">

Poin

</div>

</div>

<a href="#"

class="btn-primary block mt-7">

Lihat Profil

</a>

</div>

@endforeach

</div>

</section>



<!-- ===========================
ARTIKEL
=========================== -->

<section class="mt-24">

<div class="flex justify-between items-center mb-10">

<div>

<h2 class="section-title">

📚 Artikel Terbaru

</h2>

<p class="section-desc">

Belajar teknologi bersama PPLG.

</p>

</div>

<a href="/artikel"

class="text-blue-400">

Lihat Semua →

</a>

</div>

<div class="grid lg:grid-cols-3 gap-8">

@for($i=1;$i<=3;$i++)

<div class="card overflow-hidden">

<img

src="https://picsum.photos/600/350?random={{$i+20}}"

class="w-full h-56 object-cover">

<div class="p-6">

<div class="text-blue-400">

Laravel

</div>

<h2 class="text-2xl font-bold mt-3">

Belajar Laravel CRUD dari Nol

</h2>

<p class="text-slate-400 mt-4">

Panduan lengkap membuat website
menggunakan Laravel 12
untuk pemula.

</p>

<div class="flex justify-between items-center mt-8">

<span class="text-slate-500">

29 Juni 2026

</span>

<a href="#"

class="text-blue-400">

Baca →

</a>

</div>

</div>

</div>

@endfor

</div>

</section>



<!-- CTA -->

<section class="mt-28">

<div class="card p-12 text-center">

<h2 class="text-5xl font-black">

Siap Menampilkan
<span class="text-blue-500">

Karyamu?

</span>

</h2>

<p class="text-slate-400 mt-6 max-w-2xl mx-auto">

Publikasikan hasil project terbaikmu
agar dapat dilihat oleh guru,
teman, dan dunia industri.

</p>

<div class="mt-10">

<a href="/login"

class="btn-primary">

Upload Karya Sekarang

</a>

</div>

</div>

</section>

@endsection