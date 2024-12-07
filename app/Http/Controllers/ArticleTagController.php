<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleTagController extends Controller
{
    public function index()
    {
        // Ambil semua data tags
        $tags = Tag::all();

        // Kirim data tags ke view
        return view('blog.tags', compact('tags'));
    }

    public function create()
    {
        // Return ke form create tag
        return view('blog.tag-create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan tag baru
        $tag = Tag::create($validated);

        // Redirect ke halaman tags dengan pesan sukses
        return redirect()->route('tags.index')->with('success', 'Tag berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ambil tag berdasarkan ID
        $tag = Tag::findOrFail($id);

        // Return ke form edit tag
        return view('blog.tag-edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update tag berdasarkan ID
        $tag = Tag::findOrFail($id);
        $tag->update($validated);

        // Redirect ke halaman tags dengan pesan sukses
        return redirect()->route('tags.index')->with('success', 'Tag berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus tag berdasarkan ID
        $tag = Tag::findOrFail($id);
        $tag->delete();

        // Redirect ke halaman tags dengan pesan sukses
        return redirect()->route('tags.index')->with('success', 'Tag berhasil dihapus!');
    }
}
