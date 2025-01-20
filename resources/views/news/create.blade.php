@extends('layouts.app')

@section('content')
<div class="mt-20 max-w-6xl mx-auto p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">Tambah Berita</h2>

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="title" class="text-blue-700">Judul</label>
            <input type="text" name="title" id="title" class="form-control" required>
            @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="upload_date" class="text-blue-700">Tanggal Upload</label>
            <input type="date" name="upload_date" id="upload_date" class="form-control" required>
            @error('upload_date')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="cover_image" class="text-blue-700">Gambar Cover (PNG, JPG)</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/png, image/jpeg" required>
            @error('cover_image')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="content" class="text-blue-700">Konten Berita</label>
            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
            @error('content')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-4 py-2 rounded-full">Simpan</button>
    </form>
</div>
@endsection
