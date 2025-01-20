@extends('layouts.app')

@section('content')
<div class="mt-20 max-w-7xl mx-auto p-6 bg-blue-200 bg-opacity-30 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-900">Daftar Peserta</h2>

    <form method="GET" class="mb-4">
        <label for="category" class="text-blue-700">Filter Kategori:</label>
        <select name="category" id="category" class="form-control" onchange="this.form.submit()">
            <option value="">Pilih Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
        </select>
    </form>

    @if($selectedCategory)
        <div class="flex justify-end mb-4">
            <span class="text-md font-semibold text-blue-600 mr-5">Jumlah Pendaftar: {{ $registrations->count() }}</span>
        </div>

        @if(in_array($selectedCategory, ['ELVERO', 'FIDOVERO']))
            <table class="min-w-full bg-white border border-blue-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">NIM</th>
                        <th class="border px-4 py-2">Nomor Telepon</th>
                        <th class="border px-4 py-2">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                        <tr>
                            <td class="border px-4 py-2">{{ $registration->id }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_name }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_nim }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_phone }}</td>
                            <td class="border px-4 py-2">{{ $registration->class }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(in_array($selectedCategory, ['MUSCOVERO', 'ACAVERO']))
            <table class="min-w-full bg-white border border-blue-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nama Tim</th>
                        <th class="border px-4 py-2">Nama Ketua</th>
                        <th class="border px-4 py-2">NIM Ketua</th>
                        <th class="border px-4 py-2">Nomor Telepon</th>
                        <th class="border px-4 py-2">KTM</th>
                        <th class="border px-4 py-2">Pembayaran</th>
                        <th class="border px-4 py-2">Anggota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                        <tr>
                            <td class="border px-4 py-2">{{ $registration->id }}</td>
                            <td class="border px-4 py-2">{{ $registration->team_name }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_name }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_nim }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_phone }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ asset('storage/ktm/' . $registration->ktm) }}" class="text-blue-500 hover:underline">KTM</a>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ asset('storage/payments/' . $registration->payment_proof) }}" class="text-blue-500 hover:underline">Payment Proof</a>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ url('/registrations/proof/' . $registration->id) }}" class="text-blue-500 hover:underline">Lihat Anggota</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif($selectedCategory == 'STOVERO')
            <table class="min-w-full bg-white border border-blue-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Kelas</th>
                        <th class="border px-4 py-2">Nama Captain</th>
                        <th class="border px-4 py-2">NIM Captain</th>
                        <th class="border px-4 py-2">Nomor Telepon Captain</th>
                        <th class="border px-4 py-2">KTM</th>
                        <th class="border px-4 py-2">Pembayaran</th>
                        <th class="border px-4 py-2">Anggota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                        <tr>
                            <td class="border px-4 py-2">{{ $registration->id }}</td>
                            <td class="border px-4 py-2">{{ $registration->class }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_name }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_nim }}</td>
                            <td class="border px-4 py-2">{{ $registration->captain_phone }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ asset('storage/uploads/ktm/' . $registration->ktm) }}" class="text-blue-500 hover:underline">KTM</a>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ asset('storage/uploads/payments/' . $registration->payment_proof) }}" class="text-blue-500 hover:underline">Payment Proof</a>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ url('/registrations/proof/' . $registration->id) }}" class="text-blue-500 hover:underline">Lihat Anggota</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
