@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-white" >Tambah Kategori</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-white">Nama Kategori</label>
        <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-4 py-2">
        @error('name')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
</form>
@endsection
