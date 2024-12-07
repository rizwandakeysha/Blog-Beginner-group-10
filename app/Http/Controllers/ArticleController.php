<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();

        // Kirim data kategori ke view
        return view('blog.create', compact('categories'));
    }

    public function index()
    {
        // Mengambil data artikel dari database
        $articles = Article::all();

        // Pastikan view 'home' ada di folder resources/views/blog
        return view('blog.home', compact('articles'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'full_text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        // Penanganan upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        // Menambahkan user_id yang dikirim dari form
        $validated['user_id'] = auth()->user()->id; // Menggunakan id user yang sedang login

        // Membuat artikel baru
        $article = Article::create($validated);

        // Redirect ke halaman home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Artikel berhasil dibuat!');
    }

    public function about()
    {
        return view('blog.about');
    }


    public function show($id)
    {
        $articles = Article::all();
        $article = Article::with(['user'])->findOrFail($id);

        return view('blog.article', compact('article', 'articles'));
    }

    public function edit($id)
    {
        // Ambil artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // Ambil semua kategori untuk dropdown kategori
        $categories = Category::all();

        // Kirim data artikel dan kategori ke view edit
        return view('blog.edit', compact('article', 'categories'));
    }




    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'full_text' => 'nullable',
            'image' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $article = Article::findOrFail($id);
        $article->update($validated);
        return redirect()->route('home')->with('edit', 'Artikel berhasil diedit!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('home')->with('delete', 'Artikel berhasil dihapus!');
    }
}
