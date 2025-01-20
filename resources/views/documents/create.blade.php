@extends('layouts.app')

@section('content')
<div class="mt-20 max-w-6xl mx-auto p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">Tambah Dokumentasi</h2>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data"> <!-- Added enctype -->
        @csrf

        <div class="form-group mb-3">
            <label for="category" class="text-blue-700">Kategori</label>
            <select name="category" id="category" class="form-control" required>
                <option value="ELVERO">ELVERO</option>
                <option value="STOVERO">STOVERO</option>
                <option value="MUSCOVERO">MUSCOVERO</option>
                <option value="ACAVERO">ACAVERO</option>
                <option value="FIDOVERO">FIDOVERO</option>
            </select>
            @error('category')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="link" class="text-blue-700">Link Dokumentasi (Google Drive)</label>
            <input type="url" name="link" id="link" class="form-control" required>
            @error('link')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="text-blue-700">Gambar (JPG, PNG)</label>
            <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png,.gif" required> <!-- Changed to file input -->
            @error('image')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-4 py-2 rounded-full">Simpan</button>
    </form>
</div>
@endsection
