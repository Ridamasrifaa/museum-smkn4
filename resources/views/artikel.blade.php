```blade
@extends('layouts.app')

@section('title','Artikel')

@section('content')

<!-- HERO -->

<section class="py-20 text-center">

    <span class="px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400">

        📚 Artikel Teknologi

    </span>

    <h1 class="text-5xl font-black mt-8">

        Belajar Bersama
        <span class="text-blue-500">

            PPLG SMKN 4

        </span>

    </h1>

    <p class="text-slate-400 mt-6 max-w-3xl mx-auto">

        Kumpulan artikel seputar Laravel,
        UI/UX, Figma, GitHub, Android,
        AI, dan teknologi terbaru.

    </p>

</section>

<!-- SEARCH -->

<section>

<div class="card p-6">

<div class="grid lg:grid-cols-4 gap-5">

<input
type="text"
placeholder="Cari artikel..."
class="bg-slate-900 border border-slate-700 rounded-xl px-5 py-4">

<select
class="bg-slate-900 border border-slate-700 rounded-xl px-5">

<option>Semua</option>
<option>Laravel</option>
<option>Figma</option>
<option>GitHub</option>
<option>UI UX</option>

</select>

<select
class="bg-slate-900 border border-slate-700 rounded-xl px-5">

<option>Terbaru</option>
<option>Populer</option>

</select>

<button class="btn-primary">

Cari

</button>

</div>

</div>

</section>

<!-- GRID ARTIKEL -->

<section class="mt-16">

<div class="grid lg:grid-cols-3 gap-8">

@for($i=1;$i<=9;$i++)

<div class="card overflow-hidden group">

<img
src="https://picsum.photos/600/400?random={{$i+60}}"
class="w-full h-56 object-cover duration-500 group-hover:scale-110">

<div class="p-6">

<span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-sm">

Laravel

</span>

<h2 class="text-2xl font-bold mt-5">

Belajar Laravel {{$i}}

</h2>

<p class="text-slate-400 mt-4">

Tutorial membuat website modern menggunakan
Laravel dan Tailwind CSS.

</p>

<div class="flex justify-between mt-8">

<span class="text-slate-500">

29 Juni 2026

</span>

<a
href="/artikel/{{$i}}"
class="text-blue-400">

Baca →

</a>

</div>

</div>

</div>

@endfor

</div>

</section>

<!-- PAGINATION -->

<section class="mt-20">

<div class="flex justify-center gap-3">

<button class="px-5 py-3 rounded-lg bg-blue-600">

1

</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">

2

</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">

3

</button>

<button class="px-5 py-3 rounded-lg bg-slate-800 hover:bg-blue-600">

→

</button>

</div>

</section>

@endsection
```
