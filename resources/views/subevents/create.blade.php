@extends('layouts.app')

@section('content')
<div class="mt-20 max-w-6xl mx-auto p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">Tambah Sub-Event</h2>

    <form action="{{ route('subevents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="name" class="text-blue-700">Nama Acara</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-red-500 text-sm">{{ $message }}</div>

            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="text-blue-700">Deskripsi</label>
            <textarea name="description" id="description" class ="form-control" required></textarea>
            @error('description')
                <div class="text-red-500 text-sm">{{ $message }}</div>

            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category" class="text-blue-700">Kategori</label>
            <select name="category" id="category" class="form-control" required onchange="toggleDateFields()">
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
            <label for="image" class="text-blue-700">Gambar (JPG, PNG)</label>
            <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)" required>
            <img id="image-preview" style="display:none; max-width:200px; margin-top:10px;">
            @error('image')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="rules_file" class="text-blue-700">File Peraturan (PDF, DOCX)</label>
            <input type="file" name="rules_file" id="rules_file" class="form-control" required>
            @error('rules_file')
                <div class="text-red-500 text-sm">{{ $message }}</div>

            @enderror
        </div>

        <div class="form-group mb-3" id="start-date-group">
            <label for="start_date" class="text-blue-700">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
            @error('start_date')
                <div class="text-red-500 text-sm">{{ $message }}</div>

            @enderror
        </div>

        <div class="form-group mb-3" id="end-date-group">
            <label for="end_date" class="text-blue-700">Tanggal Selesai</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
            @error('end_date')
                <div class="text-red-500 text-sm">{{ $message }}</div>

            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-4 py-2 rounded-full">Simpan</button>
    </form>

</div>

<script>
function toggleDateFields() {
    const category = document.getElementById('category').value;
    const endDateGroup = document.getElementById('end-date-group');
    if (category === 'ELVERO' || category === 'FIDOVERO') {
        endDateGroup.style.display = 'none';
    } else {
        endDateGroup.style.display = 'block';
    }
}

function previewImage(event) {
    const imagePreview = document.getElementById('image-preview');
    imagePreview.src = URL.createObjectURL(event.target.files[0]);
    imagePreview.style.display = 'block';
}
</script>
@endsection
