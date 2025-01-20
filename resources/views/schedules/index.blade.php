@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen pb-10">
    <h1 class="text-3xl font-bold mb-5">Schedules</h1>

    @if (session('success'))
            <div class="bg-blue-700 text-white p-2 rounded-lg flex items-center justify-center mb-10" style="height: 30px;">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8.032 12 1.984 1.984 4.96-4.96m4.55 5.272.893-.893a1.984 1.984 0 0 0 0-2.806l-.893-.893a1.984 1.984 0 0 1-.581-1.403V7.04a1.984 1.984 0 0 0-1.984-1.984h-1.262a1.983 1.983 0 0 1-1.403-.581l-.893-.893a1.984 1.984 0 0 0-2.806 0l-.893.893a1.984 1.984 0 0 1-1.403.581H7.04A1.984 1.984 0 0 0 5.055 7.04v1.262c0 .527-.209 1.031-.581 1.403l-.893.893a1.984 1.984 0 0 0 0 2.806l.893.893c.372.372.581.876.581 1.403v1.262a1.984 1.984 0 0 0 1.984 1.984h1.262c.527 0 1.031.209 1.403.581l.893.893a1.984 1.984 0 0 0 2.806 0l.893-.893a1.985 1.985 0 0 1 1.403-.581h1.262a1.984 1.984 0 0 0 1.984-1.984V15.7c0-.527.209-1.031.581-1.403Z"/>
                </svg>
                <span class="text-center ml-2">{{ session('success') }}</span>
            </div>
        @endif

    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ route('schedules.index') }}" class="flex-grow">
            <select name="category" id="category" class="border-1 border-blue-700 rounded-md p-2 w-full" onchange="this.form.submit()">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
        </form>

        @if (auth()->user()->email === 'admin@gmail.com')
            <a href="{{ route('schedules.create') }}"
                   class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-3 py-2 rounded-full shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Jadwal</span>
                </a>
        @endif
    </div>

    @if ($schedules->isEmpty())
        <div class="text-gray-600 p-4 rounded-md text-center">
            <p class="">Jadwal tidak tersedia.</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach ($schedules->groupBy('date') as $date => $groupedSchedules)
                <h2 class="text-md font-semibold">{{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</h2>
                @foreach ($groupedSchedules as $schedule)
                    <div class="bg-blue-100 bg-opacity-5 border-1 border-blue-500 p-3 rounded-xl shadow-md flex justify-between">
                        <div class="flex-1">
                            @if ($schedule->category === 'STOVERO')
                                <h3 class="text-sm font-semibold text-blue-600">{{ $schedule->name }}</h3>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-lg font-semibold">{{ $schedule->team1 }} vs {{ $schedule->team2 }}</span>
                                </div>
                            @else
                                <h3 class="text-lg font-semibold">{{ $schedule->name }}</h3>
                            @endif

                            @if (in_array($schedule->category, ['ELVERO', 'MUSCOVERO', 'ACAVERO', 'FIDOVERO', 'STOVERO']))
                                <div class="flex items-center mb-1">
                                    <svg class="w-5 h-5 text-blue-600 text-opacity-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"/>
                                    </svg>
                                    <span class="ml-1 text-gray-700">{{ $schedule->location }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 text-opacity-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <span class="ml-1 text-gray-700">{{ $schedule->time }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col items-end">
                            @if (auth()->user()->email === 'admin@gmail.com')
                                <div class="flex items-center space-x-2 mb-1">
                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="text-gray-800 hover:text-blue-600">
                                        <svg class="w-5 h-5 text-blue-900 text-opacity-80" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 text-opacity-80 hover:text-red-800">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <span class="bg-blue-500 rounded-full px-2 py-1 text-white text-sm font-semibold">{{ $schedule->category }}</span>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    @endif
</div>
@endsection
