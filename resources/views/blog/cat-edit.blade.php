@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Kategori</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="name" class="block text-gray-700">Nama Kategori</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}" class="w-full border border-gray-300 rounded px-4 py-2">
        @error('name')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Perbarui</button>
</form>
@endsection
