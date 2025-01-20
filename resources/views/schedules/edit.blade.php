@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center"> <!-- Set a neutral background color -->
    <div class="max-w-6xl w-full p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">Edit Jadwal</h2>

        <form action="{{ route('schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="category" class="text-blue-700">Kategori</label>
                <select name="category" id="category" class="form-control" required onchange="toggleInputFields()">
                    <option value="ELVERO" {{ $schedule->category === 'ELVERO' ? 'selected' : '' }}>ELVERO</option>
                    <option value="STOVERO" {{ $schedule->category === 'STOVERO' ? 'selected' : '' }}>STOVERO</option>
                    <option value="MUSCOVERO" {{ $schedule->category === 'MUSCOVERO' ? 'selected' : '' }}>MUSCOVERO</option>
                    <option value="ACAVERO" {{ $schedule->category === 'ACAVERO' ? 'selected' : '' }}>ACAVERO</option>
                    <option value="FIDOVERO" {{ $schedule->category === 'FIDOVERO' ? 'selected' : '' }}>FIDOVERO</option>
                </select>
                @error('category')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="name" class="text-blue-700">Nama Kegiatan</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $schedule->name) }}" required>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3" id="location-group">
                <label for="location" class="text-blue-700">Lokasi</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $schedule->location) }}" required>
                @error('location')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3" id="date-group">
                <label for="date" class="text-blue-700">Tanggal</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $schedule->date) }}" required>
                @error('date')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3" id="time-group">
                <label for="time" class="text-blue-700">Jadwal</label>
                <input type="time" name="time" id="time" class="form-control" value="{{ old('time', $schedule->time) }}" required>
                @error('time')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3" id="team1-group" style="display: none;">
                <label for="team1" class="text-blue-700">Team 1 (untuk STOVERO)</label>
                <input type="text" name="team1" id="team1" class="form-control" value="{{ old('team1', $schedule->team1) }}">
            </div>

            <div class="form-group mb-3" id="team2-group" style="display: none;">
                <label for="team2" class="text-blue-700">Team 2 (untuk STOVERO)</label>
                <input type="text" name="team2" id="team2" class="form-control" value="{{ old('team2', $schedule->team2) }}">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-4 py-2 rounded-full">Update Jadwal</button>
        </form>
    </div>
</div>

<script>
function toggleInputFields() {
    const category = document.getElementById('category').value;
    const team1Group = document.getElementById('team1-group');
    const team2Group = document.getElementById('team2-group');

    if (category === 'STOVERO') {
        team1Group.style.display = 'block';
        team2Group.style.display = 'block';
    } else {
        team1Group.style.display = 'none';
        team2Group.style.display = 'none';
    }
}
</script>
@endsection
