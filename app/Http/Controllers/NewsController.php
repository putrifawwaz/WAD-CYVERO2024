<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'upload_date' => 'required|date',
        ]);

        // Menangani upload gambar cover
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('covers', $imageName, 'public'); // Simpan di folder 'covers'
        }

        // Membuat berita baru
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'cover_image' => $imagePath, // Simpan path relatif
            'upload_date' => $request->upload_date,
        ]);

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'upload_date' => 'required|date',
        ]);

        // Jika ada gambar baru yang diupload
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama dari storage
            Storage::delete('public/' . $news->cover_image); // Hapus gambar lama
            // Menangani upload gambar cover
            $image = $request->file('cover_image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('covers', $imageName, 'public'); // Simpan di folder 'covers'
            $news->cover_image = $imagePath; // Update path
        }

        // Update berita
        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'upload_date' => $request->upload_date,
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        // Hapus gambar dari storage
        Storage::delete('public/' . $news->cover_image);
        // Hapus berita
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}
