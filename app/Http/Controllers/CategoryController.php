<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Ambil semua data kategori
        $categories = Category::all();

        // Kirim data kategori ke view
        return view('blog.categories', compact('categories'));
    }

    public function create()
    {
        // Return ke form tambah kategori
        return view('blog.cat-create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan kategori baru
        Category::create($validated);

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ambil kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Return ke form edit kategori
        return view('blog.cat-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update kategori berdasarkan ID
        $category = Category::findOrFail($id);
        $category->update($validated);

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus kategori berdasarkan ID
        $category = Category::findOrFail($id);
        $category->delete();

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
    