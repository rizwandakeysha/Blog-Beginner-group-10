@extends('layouts.app') <!-- Sesuaikan dengan layout utama yang digunakan -->

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Artikel</h1>
        
        <!-- Form untuk menambah artikel -->
        <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-gray-700 font-semibold">Judul Artikel</label>
        <input type="text" id="title" name="title" class="form-input mt-2 w-full" required>
    </div>

    <div class="mb-4">
        <label for="full_text" class="block text-gray-700 font-semibold">Isi Artikel</label>
        <textarea id="full_text" name="full_text" rows="5" class="form-input mt-2 w-full" required></textarea>
    </div>

    <div class="mb-4">
        <label for="image" class="block text-gray-700 font-semibold">Upload Gambar</label>
        <input type="file" id="image" name="image" class="form-input mt-2 w-full">
    </div>

    <div class="mb-4">
        <label for="category_id" class="block text-gray-700 font-semibold">Kategori</label>
        <select id="category_id" name="category_id" class="form-select mt-2 w-full" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="">Tambah Artikel</button>
</form>


    </div>
</div>
@endsection
