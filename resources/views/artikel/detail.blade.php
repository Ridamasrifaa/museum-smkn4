```blade
@extends('layouts.app')

@section('title','Detail Artikel')

@section('content')

<!-- Header Artikel -->

<section class="py-10">

    <div class="max-w-5xl mx-auto">

        <span class="bg-blue-500/20 text-blue-400 px-4 py-2 rounded-full">

            Laravel

        </span>

        <h1 class="text-5xl font-black mt-8 leading-tight">

            Belajar Laravel 12 dari Nol
            Hingga Mahir

        </h1>

        <div class="flex items-center gap-5 mt-8">

            <img
            src="https://ui-avatars.com/api/?background=2563eb&color=fff&name=Ridda"
            class="w-14 h-14 rounded-full">

            <div>

                <h3 class="font-bold">

                    Ridda Masrifa

                </h3>

                <p class="text-slate-400">

                    29 Juni 2026 • 8 menit membaca

                </p>

            </div>

        </div>

    </div>

</section>

<!-- Thumbnail -->

<section>

<div class="max-w-5xl mx-auto">

<div class="card overflow-hidden">

<img
src="https://picsum.photos/1200/650?random=90"
class="w-full h-[500px] object-cover">

</div>

</div>

</section>

<!-- Isi -->

<section class="py-12">

<div class="max-w-4xl mx-auto">

<div class="card p-10">

<h2 class="text-3xl font-bold">

Apa itu Laravel?

</h2>

<p class="text-slate-300 mt-6 leading-9">

Laravel merupakan framework PHP modern
yang mempermudah proses pengembangan
website. Framework ini menyediakan
Routing, Blade Template, Authentication,
Middleware, Migration, ORM Eloquent,
serta berbagai fitur yang mempercepat
pengembangan aplikasi.

</p>

<h2 class="text-3xl font-bold mt-12">

Mengapa Laravel?

</h2>

<ul class="list-disc ml-8 mt-6 space-y-3 text-slate-300">

<li>Struktur project rapi</li>

<li>Mudah dipelajari</li>

<li>Blade Template</li>

<li>Routing sederhana</li>

<li>Keamanan tinggi</li>

<li>Komunitas besar</li>

</ul>

<h2 class="text-3xl font-bold mt-12">

Contoh Alur CRUD

</h2>

<div class="bg-slate-900 rounded-xl p-6 mt-6 overflow-x-auto">

<pre><code>

Route::resource('karya',KaryaController::class);

</code></pre>

</div>

<p class="text-slate-300 mt-8 leading-9">

Dengan satu baris tersebut Laravel
otomatis membuat route CRUD sehingga
proses pengembangan menjadi jauh
lebih cepat dibanding PHP native.

</p>

</div>

</div>

</section>

<!-- Artikel Terkait -->

<section class="pb-16">

<div class="flex justify-between items-center mb-10">

<h2 class="section-title">

Artikel Terkait

</h2>

<a
href="/artikel"
class="text-blue-400">

Lihat Semua →

</a>

</div>

<div class="grid lg:grid-cols-3 gap-8">

@for($i=1;$i<=3;$i++)

<div class="card overflow-hidden group">

<img
src="https://picsum.photos/600/400?random={{100+$i}}"
class="w-full h-52 object-cover group-hover:scale-110 duration-500">

<div class="p-6">

<span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full">

Laravel

</span>

<h3 class="text-2xl font-bold mt-5">

Tutorial Laravel {{$i}}

</h3>

<p class="text-slate-400 mt-3">

Belajar Laravel dengan project nyata.

</p>

<a
href="#"
class="inline-block mt-6 text-blue-400">

Baca →

</a>

</div>

</div>

@endfor

</div>

</section>

@endsection
```
