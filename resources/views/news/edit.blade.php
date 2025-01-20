@extends('layouts.app')

@section('content')
<div class="mt-20 max-w-6xl mx-auto p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">Edit Berita</h2>

    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title" class="text-blue-700">Judul</label>
            <input type="text" name="title" id="title" value="{{ $news->title }}" class="form-control" required>
            @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="upload_date" class="text-blue-700">Tanggal Upload</label>
            <input type="date" name="upload_date" id="upload_date" value="{{ $news->upload_date }}" class="form-control" required>
            @error('upload_date')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="cover_image" class="text-blue-700">Gambar Cover (PNG, JPG)</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/png, image/jpeg">
            <img src="{{ Storage::url($news->cover_image) }}" alt="Cover Image" class="mt-2 w-32 h-32 object-cover rounded-lg">
            @error('cover_image')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="content" class="text-blue-700">Konten Berita</label>
            <textarea name="content" id="content" rows="5" class="form-control" required>{{ $news->content }}</textarea>
            @error('content')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-4 py-2 rounded-full">Update</button>
    </form>
</div>
@endsection
