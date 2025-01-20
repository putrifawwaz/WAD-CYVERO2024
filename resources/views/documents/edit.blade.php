@extends('layouts.app')

@section('content')
<div class="mt-20 max-w-6xl mx-auto p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">Edit Dokumentasi</h2>

    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data"> <!-- Added enctype for file uploads -->
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="category" class="text-blue-700">Kategori</label>
            <select name="category" id="category" class="form-control" required>
                <option value="ELVERO" {{ $document->category === 'ELVERO' ? 'selected' : '' }}>ELVERO</option>
                <option value="STOVERO" {{ $document->category === 'STOVERO' ? 'selected' : '' }}>STOVERO</option>
                <option value="MUSCOVERO" {{ $document->category === 'MUSCOVERO' ? 'selected' : '' }}>MUSCOVERO</option>
                <option value="ACAVERO" {{ $document->category === 'ACAVERO' ? 'selected' : '' }}>ACAVERO</option>
                <option value="FIDOVERO" {{ $document->category === 'FIDOVERO' ? 'selected' : '' }}>FIDOVERO</option>
            </select>
            @error('category')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="link" class="text-blue-700">Link Dokumentasi (Google Drive)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ $document->link }}" required>
            @error('link')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="text-blue-700">Gambar (JPG, PNG, GIF)</label>
            <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png,.gif"> <!-- Changed to file input -->
            <p class="text-gray-500 text-sm">Current Image: <a href="{{ $document->image }}" target="_blank" class="text-blue-600">{{ $document->image }}</a></p> <!-- Display current image link -->
            @error('image')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-4 py-2 rounded-full">Update Informasi</button>
    </form>
</div>
@endsection
