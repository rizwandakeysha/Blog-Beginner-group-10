<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Blog') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-amiko">
    <div class="bg-[#E8E3DE] shadow">
    <div class="container mx-auto px-4 py-5 flex justify-between items-center">
        <!-- Nama Website -->
        <a href="{{ route('home') }}" class="text-xl font-semibold text-gray-800">
            Blog Kelompok 11
        </a>
        <a href="{{ route('article.create') }}" class="font-bold text-lg">Buat Artikel</a>
        <a href="{{ route('tags.index') }}" class="font-bold text-lg">Tags</a>
        <a href="{{ route('categories.index') }}" class="font-bold text-lg">Kategori</a>
        <a href="{{ route('about') }}" class="font-bold text-lg">Tentang</a>

        <!-- Profil -->
        <div class="flex items-center space-x-4">
            @auth
                <span class="text-gray-600 text-lg">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-800 hover:underline text-lg">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-800 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-gray-800 hover:underline">Register</a>
            @endauth
        </div>
    </div>
</div>

</body>
</html>


