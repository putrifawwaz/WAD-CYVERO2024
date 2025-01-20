@extends('layouts.app')

@section('content')
<div class="mt-20 max-w-7xl mx-auto p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">FORM REGISTRASI</h2>

    <form action="{{ route('registrations.storeRegistration', $subEvent->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="category" class="text-blue-700">Kategori</label>
            <input type="text" name="category_display" id="category_display" class="form-control" value="{{ $subEvent->category }}" disabled>
            <input type="hidden" name="category" value="{{ $subEvent->category }}">
        </div>

        <div class="form-group mb-3">
            <label for="captain_name" class="text-blue-700">Nama</label>
            <input type="text" name="captain_name" id="captain_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="captain_nim" class="text-blue-700">NIM</label>
            <input type="text" name="captain_nim" id="captain_nim" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="captain_phone" class="text-blue-700">Nomor Telepon</label>
            <input type="text" name="captain_phone" id="captain_phone" class="form-control" required>
        </div>

        <div id="class-input" class="form-group mb-3" style="display: none;">
            <label for="class" class="text-blue-700">Kelas</label>
            <input type="text" name="class" id="class" class="form-control">
        </div>

        <div id="team-input" class="form-group mb-3" style="display: none;">
            <label for="team_name" class="text-blue-700">Nama Tim</label>
            <input type="text" name="team_name" id="team_name" class="form-control">
        </div>

        <div id="players-input" class="form-group mb-3" style="display: none;">
            <div id="player-list" class="grid grid-cols-1 gap-4">
                <!-- Player fields will be added dynamically here -->
            </div>
            <button type="button" onclick="addPlayer()" class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-3 py-1 rounded-full mt-2 transform hover:scale-105">Tambah Pemain</button>
        </div>

        <div id="ktm-input" class="form-group mb-3" style="display: none;">
            <label for="ktm" class="text-blue-700">Upload File KTM Seluruh Peserta (PDF)</label>
            <input type="file" name="ktm" id="ktm" class="form-control" accept=".jpg,.png,.pdf">
        </div>

        <div id="payment-proof-input" class="form-group mb-3" style="display: none;">
            <label for="payment_proof" class="text-blue-700">Upload Bukti Pembayaran: BCA 12345678 a/n Admin (JPG, PNG, PDF)</label>
            <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept=".jpg,.png,.pdf">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-3 py-2 rounded-lg shadow-md text-sm font-semibold transform">Daftar</button>
    </form>
</div>

<script>
    let playerCount = 0;

    function updateForm() {
        const category = document.querySelector('input[name="category"]').value;

        document.querySelectorAll('.form-group').forEach(group => group.style.display = 'none');
        document.querySelectorAll('#captain_name, #captain_nim, #captain_phone').forEach(input => input.required = true);

        document.querySelectorAll('#captain_name, #captain_nim, #captain_phone').forEach(input => {
            input.closest('.form-group').style.display = 'block';
        });

        if (['ELVERO', 'FIDOVERO'].includes(category)) {
            document.getElementById('class-input').style.display = 'block';
            document.getElementById('class').required = true;
        } else if (category === 'STOVERO') {
            document.getElementById('class-input').style.display = 'block';
            document.getElementById('players-input').style.display = 'block';
            document.getElementById('ktm-input').style.display = 'block';
            document.getElementById('payment-proof-input').style.display = 'block';

            document.getElementById('class').required = true;
        } else if (['ACAVERO', 'MUSCOVERO'].includes(category)) {
            document.getElementById('team-input').style.display = 'block';
            document.getElementById('players-input').style.display = 'block';
            document.getElementById('ktm-input').style.display = 'block';
            document.getElementById('payment-proof-input').style.display = 'block';

            document.getElementById('team_name').required = true;
        }
    }

    function addPlayer() {
        const playerList = document.getElementById('player-list');
        playerCount++;

        if (playerCount <= 11) {
            const playerDiv = document.createElement('div');
            playerDiv.classList.add('grid', 'grid-cols-2', 'gap-4');
            playerDiv.innerHTML = `
                <div>
                    <label for="player_name_${playerCount}" class="text-blue-700">Nama Anggota</label>
                    <input type="text" name="player_name[]" id="player_name_${playerCount}" class="form-control" required>
                </div>
                <div>
                    <label for="player_nim_${playerCount}" class="text-blue-700">NIM Anggota</label>
                    <input type="text" name="player_nim[]" id="player_nim_${playerCount}" class="form-control" required>
                </div>
            `;
            playerList.appendChild(playerDiv);
        } else {
            alert('Maksimal 11 pemain diperbolehkan.');
        }
    }

    document.addEventListener('DOMContentLoaded', updateForm);
</script>
@endsection
