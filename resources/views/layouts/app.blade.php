<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Museum SMKN 4</title>
</head>
<body class="bg-slate-950 text-white font-sans">
    
    <!-- Navbar -->
    <nav class="p-6 border-b border-slate-800">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-black text-blue-500 uppercase tracking-tighter">Museum<span class="text-white">SMKN4</span></a>
            <div class="space-x-4 text-slate-400">
                <a href="/" class="hover:text-white">Beranda</a>
                <a href="/" class="hover:text-white">Artikel</a>
                <a href="/" class="hover:text-white">Karya</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-6xl mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>