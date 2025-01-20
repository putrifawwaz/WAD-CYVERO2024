@extends('layouts.app')

@section('content')
<div class="container mt-20 flex flex-col justify-center items-center min-h-screen">

    {{-- <div class="absolute top-4 left-4 mt-20">
        <a href="{{ route('subevents.index') }}" class="flex items-center bg-blue-700 text-white border border-blue-700 py-2 px-4 rounded-lg hover:bg-blue-800 hover:text-white transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div> --}}

    <div class="w-full flex justify-center mb-4 mt-6">
        <button id="download-pdf" class="bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-700 transition-transform flex justify-center items-center w-full max-w-[210mm]" style="width: 210mm;">
            <i class="fas fa-download transform transition-all duration-300 hover:rotate-180"></i> Download PDF
        </button>
    </div>

    <div id="receipt" class="card shadow-lg flex flex-col items-center" style="width: 210mm; min-height: 297mm; padding: 20px; margin: 12px;">
        <h2 class="text-xl text-center font-bold mt-10">BUKTI REGISTRASI ULANG</h2>
        <h3 class="text-xl text-center font-bold mb-5">{{ $category }} 2024</h3>

        <div class="text-left w-full">
            @if($category === 'MUSCOVERO' || $category === 'ACAVERO')
                <p><strong>Nama Tim:</strong> {{ $team_name ?? '-' }}</p>
                <p><strong>Nama Ketua:</strong> {{ $captain_name }}</p>
                <p><strong>NIM Ketua:</strong> {{ $captain_nim }}</p>
            @elseif($category === 'STOVERO')
                <p><strong>Kelas:</strong> {{ $class_stovero ?? '-' }}</p>
                <p><strong>Nama Kapten:</strong> {{ $captain_name }}</p>
                <p><strong>NIM Kapten:</strong> {{ $captain_nim }}</p>
            @endif
        </div>

        @if(!empty($participants))
        <table class="table table-bordered mt-4 text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 50%;">Nama Pemain</th>
                    <th style="width: 25%;">NIM</th>
                    <th style="width: 25%;">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $captain_name }}</td>
                    <td class="text-center">{{ $captain_nim }}</td>
                    <td></td>
                </tr>
                @foreach($participants as $index => $player)
                <tr>
                    <td>{{ $index + 2 }}</td>
                    <td>{{ $player->player_name }}</td>
                    <td class="text-center">{{ $player->player_nim }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Tidak ada data partisipan.</p>
        @endif

        <p class="mt-5 italic">
            <strong>Catatan:</strong> Setiap tim diwajibkan membawa print out Bukti Registrasi Ulang saat mengikuti pertandingan atau audisi sebagai syarat keabsahan keikutsertaan.
        </p>
    </div>
</div>

<!-- Include html2pdf.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
    document.getElementById('download-pdf').addEventListener('click', function() {
        var element = document.getElementById('receipt'); // Corrected ID here
        html2pdf()
            .from(element)
            .save('Bukti Registrasi Ulang.pdf');
    });
</script>
@endsection
