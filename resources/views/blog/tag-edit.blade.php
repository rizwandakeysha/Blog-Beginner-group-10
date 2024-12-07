@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Tag</h1>

@if($errors->any())
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('tags.update', $tag->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="name" class="block text-gray-700">Nama Tag</label>
        <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('name', $tag->name) }}" required>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
    <a href="{{ route('tags.index') }}" class="ml-2 text-gray-500 hover:underline">Batal</a>
</form>
@endsection
