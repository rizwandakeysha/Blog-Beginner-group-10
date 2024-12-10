@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Artikel</h1>

        <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input Judul -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">Judul</label>
                <input type="text" name="title" id="title" value="{{ $article->title }}" 
                       class="w-full mt-2 p-2 border border-gray-300 rounded">
            </div>

            <!-- Input Gambar -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold">Gambar</label>
                <input type="file" name="image" id="image" class="mt-2">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Current Image" 
                         class="mt-4 w-32 rounded shadow">
                @endif
            </div>

            <!-- Dropdown Kategori -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-semibold">Kategori</label>
                <select name="category_id" id="category_id" 
                        class="w-full mt-2 p-2 border border-gray-300 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ $category->id == $article->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Input Isi Artikel -->
            <div class="mb-4">
                <label for="full_text" class="block text-gray-700 font-semibold">Isi Artikel</label>
                <textarea name="full_text" id="full_text" rows="6" 
                          class="w-full mt-2 p-2 border border-gray-300 rounded">{{ $article->full_text }}</textarea>
            </div>

            <div>
    <label class="block text-sm font-semibold text-gray-700 pb-2">Tags</label>
    @foreach($tags as $tag)
        <div class="flex items-center mb-2">
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}" 
                   class="mr-2" 
                   {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
            <label for="tag_{{ $tag->id }}" class="text-sm text-gray-700">{{ $tag->name }}</label>
        </div>
    @endforeach
</div>

            <!-- Tombol Submit -->
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
