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
        $tags = Tag::all(); // Ambil data tag dari database
        // Kirim data kategori ke view
        return view('blog.create', compact('categories', 'tags'));
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
        $request->validate([
            'title' => 'required|max:255',
            'full_text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $article = Article::create([
            'title' => $request->title,
            'full_text' => $request->full_text,
            'image' => $imagePath,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
        ]);

        if ($request->has('tags')) {
            $article->tags()->attach($request->input('tags')); // Attach the selected tags
        }

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
        // Ambil semua kategori dan tag
        $categories = Category::all();
        $tags = Tag::all();

        // Ambil artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // Ambil tag yang sudah terhubung dengan artikel (ID tag yang terpilih)
        $selectedTags = $article->tags->pluck('id')->toArray(); // Mengambil ID tag yang terpilih

        // Kirim data artikel, kategori, tag, dan tag yang terpilih ke view
        return view('blog.edit', compact('article', 'categories', 'tags', 'selectedTags'));
    }


    public function update(Request $request, $id)
    {
        // Validasi inputan artikel
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'full_text' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array', // Validasi tags sebagai array
            'tags.*' => 'exists:tags,id', // Validasi setiap tag yang dipilih ada di tabel tags
        ]);

        // Ambil artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // Periksa apakah ada gambar yang di-upload
        if ($request->hasFile('image')) {
            // Simpan gambar dan ambil path-nya
            $imagePath = $request->file('image')->store('articles', 'public');
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $imagePath; // Tambahkan gambar ke data artikel
        }

        // Update artikel dengan data yang sudah divalidasi
        $article->update($validated);

        // Update hubungan tags jika ada
        if ($request->has('tags')) {
            $article->tags()->sync($request->input('tags', [])); // Sync akan menambah dan menghapus tag yang dipilih
        }

        // Redirect setelah update berhasil
        return redirect()->route('home')->with('edit', 'Artikel berhasil diedit!');
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('home')->with('delete', 'Artikel berhasil dihapus!');
    }
}
