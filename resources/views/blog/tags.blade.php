    @extends('layouts.app')

    @section('content')
    <h1 class="text-3xl font-bold mb-6 text-white">Daftar Tags</h1>

    <div class="mb-4">
        <a href="{{ route('tags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Tag</a>
    </div>

    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-200 px-4 py-2">ID</th>
                <th class="border border-gray-200 px-4 py-2">Nama</th>
                <th class="border border-gray-200 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-white">
            @foreach($tags as $tag)
            <tr>
                <td class="border border-gray-200 px-4 py-2">{{ $tag->id }}</td>
                <td class="border border-gray-200 px-4 py-2">{{ $tag->name }}</td>
                <td class="border border-gray-200 px-4 py-2">
                    <a href="{{ route('tags.edit', $tag->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus tag ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
