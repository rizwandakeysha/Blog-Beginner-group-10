@extends('layouts.app')

@section('content')
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('delete'))
    <script>
        alert("{{ session('delete') }}");
    </script>
@endif

@if(session('edit'))
    <script>
        alert("{{ session('edit') }}");
    </script>
@endif

<!-- Latar belakang penuh -->
<div class="bg-[#45242D] min-h-screen">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Daftar Artikel</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4">
            @foreach($articles as $article)
               <div class="bg-[#D2C2BC] shadow-lg rounded-lg overflow-hidden">
                    <!-- Gambar Artikel -->
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Image" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif

                    <!-- Konten Artikel -->
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            <a href="{{ route('article.show', $article->id) }}" class="hover:text-blue-500">{{ $article->title }}</a>
                        </h2>
                        
                        <p class="text-gray-600 text-sm mb-2">
                            Oleh <strong>{{ $article->user->name }}</strong> | 
                            <span>4 Desember 2024 13.00 WIB</span>
                        </p>
                        
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->full_text, 150) }}</p>

                        <a href="{{ route('article.show', $article->id) }}" class="text-blue-500 hover:underline">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
