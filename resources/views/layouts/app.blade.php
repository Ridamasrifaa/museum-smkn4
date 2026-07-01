<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>@yield('title','Museum SMKN 4 Tasikmalaya')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        *{
            font-family:'Inter',sans-serif;
        }

        body{
            background:#020617;
            color:white;
            overflow-x:hidden;
        }

        ::-webkit-scrollbar{
            width:8px;
        }

        ::-webkit-scrollbar-thumb{
            background:#2563eb;
            border-radius:20px;
        }

        ::-webkit-scrollbar-track{
            background:#0f172a;
        }

        /* Background */

        .bg-grid{

            position:fixed;
            inset:0;

            background-image:
            linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.02) 1px, transparent 1px);

            background-size:40px 40px;

            z-index:-3;

        }

        .blur1{

            position:fixed;

            width:420px;
            height:420px;

            border-radius:999px;

            background:#2563eb;

            filter:blur(130px);

            opacity:.20;

            top:-120px;
            left:-100px;

            z-index:-2;

        }

        .blur2{

            position:fixed;

            width:500px;
            height:500px;

            border-radius:999px;

            background:#1d4ed8;

            filter:blur(150px);

            opacity:.18;

            bottom:-220px;
            right:-150px;

            z-index:-2;

        }

        .blur3{

            position:fixed;

            width:350px;
            height:350px;

            border-radius:999px;

            background:#38bdf8;

            filter:blur(130px);

            opacity:.10;

            top:40%;
            right:15%;

            z-index:-2;

        }

        /* Navbar */

        nav{

            backdrop-filter:blur(16px);

            background:rgba(2,6,23,.70);

            border-bottom:1px solid rgba(255,255,255,.05);

            transition:.4s;

        }

        .nav-link{

            color:#cbd5e1;

            transition:.3s;

            font-weight:500;
        }

        .nav-link:hover{

            color:#60a5fa;

        }

        /* Card */

        .card{

            background:#0f172a;

            border:1px solid #1e293b;

            border-radius:20px;

            transition:.35s;

        }

        .card:hover{

            transform:translateY(-8px);

            border-color:#3b82f6;

            box-shadow:0 20px 60px rgba(37,99,235,.20);

        }

        /* Button */

        .btn-primary{

            background:linear-gradient(90deg,#2563eb,#3b82f6);

            padding:12px 28px;

            border-radius:12px;

            font-weight:600;

            transition:.3s;

        }

        .btn-primary:hover{

            transform:translateY(-2px);

            box-shadow:0 0 25px rgba(59,130,246,.45);

        }

        .btn-outline{

            border:1px solid #2563eb;

            color:#60a5fa;

            padding:12px 28px;

            border-radius:12px;

            transition:.3s;

        }

        .btn-outline:hover{

            background:#2563eb;

            color:white;

        }

        footer{

            border-top:1px solid #1e293b;

            background:#020617;

        }

        .section-title{

            font-size:34px;

            font-weight:800;

            margin-bottom:10px;

        }

        .section-desc{

            color:#94a3b8;

        }

        @media(max-width:768px){

            .section-title{

                font-size:28px;

            }

        }

    </style>

</head>

<body>

<div class="bg-grid"></div>

<div class="blur1"></div>

<div class="blur2"></div>

<div class="blur3"></div>


<!-- Navbar -->

<nav class="sticky top-0 z-50">

<div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">

<a href="/" class="text-3xl font-black tracking-tight">

<span class="text-blue-500">Museum</span>

<span class="text-white">SMKN4</span>

</a>

<div class="hidden md:flex gap-8 items-center">

<a href="/" class="nav-link">Beranda</a>


<a href="/karya" class="nav-link">Karya</a>

<a href="/login" class="btn-primary">

Login

</a>

</div>

<!-- Mobile -->

<div class="md:hidden">

<button onclick="toggleMenu()">

<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2">

<path d="M4 7h16M4 12h16M4 17h16"/>

</svg>

</button>

</div>

</div>

<div id="mobileMenu" class="hidden md:hidden border-t border-slate-800">

<div class="flex flex-col p-6 gap-5">

<a href="/">Beranda</a>

<a href="/artikel">Artikel</a>

<a href="/karya">Karya</a>

<a href="/login" class="btn-primary text-center">

Login

</a>

</div>

</div>

</nav>


<!-- Content -->

<main class="max-w-7xl mx-auto px-6 py-12">

@yield('content')

</main>


<!-- Footer -->

<footer>

<div class="max-w-7xl mx-auto py-12 px-6">

<div class="grid md:grid-cols-3 gap-10">

<div>

<h2 class="text-2xl font-bold text-blue-500">

Museum SMKN 4

</h2>

<p class="text-slate-400 mt-4">

Galeri digital karya siswa SMKN 4 Tasikmalaya sebagai wadah untuk mengapresiasi kreativitas, inovasi, dan hasil pembelajaran Project Based Learning.

</p>

</div>

<div>

<h3 class="font-bold text-lg mb-4">

Menu

</h3>

<div class="space-y-2 text-slate-400">

<p><a href="/">Beranda</a></p>

<p><a href="/artikel">Artikel</a></p>

<p><a href="/karya">Karya</a></p>

<p><a href="/login">Login</a></p>

</div>

</div>

<div>

<h3 class="font-bold text-lg mb-4">

Museum SMKN 4

</h3>

<p class="text-slate-400">

Website Galeri Digital Siswa Jurusan PPLG SMKN 4 Tasikmalaya.

</p>

</div>

</div>

<div class="border-t border-slate-800 mt-10 pt-6 text-center text-slate-500">

© {{ date('Y') }} Museum SMKN 4 Tasikmalaya • All Rights Reserved.

</div>

</div>

</footer>

<script>

function toggleMenu(){

document.getElementById('mobileMenu').classList.toggle('hidden');

}

</script>

</body>
</html>