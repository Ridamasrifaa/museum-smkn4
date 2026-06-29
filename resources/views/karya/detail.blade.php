@extends('layouts.app')

@section('title','Detail Karya')

@section('content')

<section class="py-10">

    <div class="grid lg:grid-cols-3 gap-10">

        <!-- Preview -->

        <div class="lg:col-span-2">

            <div class="card overflow-hidden">

                <img
                src="https://picsum.photos/1200/700?random=20"
                class="w-full h-[500px] object-cover">

            </div>

            <div class="card p-8 mt-8">

                <span class="bg-blue-500/20 text-blue-400 px-4 py-2 rounded-full">

                    Website

                </span>

                <h1 class="text-5xl font-black mt-6">

                    Museum Digital SMKN 4

                </h1>

                <p class="text-slate-400 mt-6 leading-8">

                    Website ini dibuat sebagai media digital
                    untuk menampilkan karya siswa PPLG
                    SMKN 4 Tasikmalaya.

                    Dibangun menggunakan Laravel,
                    Tailwind CSS dan MySQL.

                    Pengguna dapat melihat karya,
                    artikel, profil siswa
                    dan melakukan upload karya.

                </p>

                <h2 class="text-2xl font-bold mt-10">

                    Teknologi

                </h2>

                <div class="flex flex-wrap gap-4 mt-6">

                    <span class="px-4 py-2 rounded-full bg-slate-800">
                        Laravel
                    </span>

                    <span class="px-4 py-2 rounded-full bg-slate-800">
                        Tailwind CSS
                    </span>

                    <span class="px-4 py-2 rounded-full bg-slate-800">
                        MySQL
                    </span>

                    <span class="px-4 py-2 rounded-full bg-slate-800">
                        Javascript
                    </span>

                </div>

            </div>

        </div>

        <!-- Sidebar -->

        <div>

            <div class="card p-8">

                <img

                src="https://ui-avatars.com/api/?background=2563eb&color=fff&size=200&name=Ridda"

                class="w-24 rounded-full">

                <h2 class="text-2xl font-bold mt-5">

                    Ridda Masrifa

                </h2>

                <p class="text-slate-400">

                    XI PPLG

                </p>

                <hr class="border-slate-700 my-6">

                <div class="space-y-4">

                    <div class="flex justify-between">

                        <span class="text-slate-400">

                            Kategori

                        </span>

                        <span>

                            Website

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">

                            Dibuat

                        </span>

                        <span>

                            2026

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">

                            Dilihat

                        </span>

                        <span>

                            1.230x

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-slate-400">

                            Rating

                        </span>

                        <span>

                            ⭐⭐⭐⭐⭐

                        </span>

                    </div>

                </div>

                <a
                href="#"
                class="btn-primary block text-center mt-8">

                    Demo Website

                </a>

                <a
                href="#"
                class="btn-outline block text-center mt-4">

                    Source Code

                </a>

            </div>

        </div>

    </div>

</section>

<!-- KARYA LAINNYA -->

<section class="mt-24">

<div class="flex justify-between items-center mb-8">

<h2 class="section-title">

Karya Lainnya

</h2>

<a href="/karya"

class="text-blue-400">

Lihat Semua →

</a>

</div>

<div class="grid lg:grid-cols-3 gap-8">

@for($i=1;$i<=3;$i++)

<div class="card overflow-hidden">

<img
src="https://picsum.photos/600/400?random={{40+$i}}"
class="h-52 w-full object-cover">

<div class="p-6">

<span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full">

Website

</span>

<h3 class="text-2xl font-bold mt-5">

Project {{$i}}

</h3>

<p class="text-slate-400 mt-3">

Website Laravel modern.

</p>

<a
href="#"
class="text-blue-400 mt-6 inline-block">

Lihat →

</a>

</div>

</div>

@endfor

</div>

</section>

@endsection