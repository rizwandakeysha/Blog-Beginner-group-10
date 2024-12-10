@extends('layouts.app') <!-- Sesuaikan dengan layout utama yang digunakan -->

@section('content')
<div class="container mx-auto px-4 py-6 font-montserrat">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Utama -->
        <div class="col-span-2 bg-white shadow rounded overflow-hidden max-w-2xl mx-auto">
            <!-- Header Artikel -->
            <div class="bg-gray-800 text-white px-6 py-4 ">
                <h1 class="text-4xl font-bold mb-2 font-amiko">{{ $article->title }}</h1>
                <p class="text-sm">
                    <span>Oleh <strong>{{ $article->user->name }}</strong></span>
                    |
                    <span>5 Desember 2024 13:23:04 WIB</span>
                </p>
            </div>

            <!-- Gambar Artikel -->
            @if($article->image)
                <div class="flex justify-center bg-gray-100">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Image"
                        class="w-full max-w-3xl object-cover rounded mt-6 shadow-lg">
                </div>
            @endif

            <!-- Isi Artikel -->
            <div class="p-6 text-gray-800 leading-relaxed">
                <p class="text-lg mb-4">{!! nl2br(e($article->full_text)) !!}</p>
            </div>

            <div class="p-6">
                <h2 class="text-lg font-semibold mb-4">Tags:</h2>
                <ul class="flex space-x-4">
                    @foreach ($article->tags as $tag)
                        <li class="bg-blue-500 text-white px-3 py-1 rounded">{{ $tag->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Tombol Kembali -->
            <div class="px-6 py-4 border-t flex justify-between items-center">
                <a href="{{ route('home') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Kembali ke Beranda
                </a>

                <!-- Tombol Edit dan Hapus (Hanya tampil jika artikel ditulis oleh pengguna yang sedang login) -->
                @if (auth()->check() && (auth()->user()->id === $article->user_id))
                    <div class="flex space-x-4">
                        <!-- Tombol Edit -->
                        <a href="{{ route('article.edit', $article->id) }}"
                            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                            Edit Artikel
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('article.destroy', $article->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                Hapus Artikel
                            </button>
                        </form>
                    </div>
                @endif
            </div>

        </div>

        <!-- Sidebar -->
        <div class="bg-gray-100 shadow rounded p-6">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Artikel Lainnya</h2>
            <ul class="space-y-4">
                @foreach ($articles as $related)
                    @if ($related->id !== $article->id)
                        <li class="flex items-center space-x-4">
                            <!-- Thumbnail Gambar -->
                            @if ($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}"
                                    class="w-16 h-16 object-cover rounded shadow">
                            @else
                                <div class="w-16 h-16 bg-gray-300 flex items-center justify-center rounded shadow">
                                    <span class="text-gray-500 text-sm">No Image</span>
                                </div>
                            @endif

                            <!-- Informasi Artikel -->
                            <div class="flex-1">
                                <a href="{{ route('article.show', $related->id) }}"
                                    class="text-lg font-medium text-blue-500 hover:underline">
                                    {{ $related->title }}
                                </a>
                                <p class="text-sm text-gray-600">
                                    4 Desember 2024 13.00 WIB
                                </p>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection