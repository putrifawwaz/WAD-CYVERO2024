@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen mt-20">
    <div class="container mx-auto mt-4">
        @if (session('success'))
            <div class="bg-blue-700 text-white p-2 rounded-lg flex items-center justify-center mb-10" style="height: 30px;">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8.032 12 1.984 1.984 4.96-4.96m4.55 5.272.893-.893a1.984 1.984 0 0 0 0-2.806l-.893-.893a1.984 1.984 0 0 1-.581-1.403V7.04a1.984 1.984 0 0 0-1.984-1.984h-1.262a1.983 1.983 0 0 1-1.403-.581l-.893-.893a1.984 1.984 0 0 0-2.806 0l-.893.893a1.984 1.984 0 0 1-1.403.581H7.04A1.984 1.984 0 0 0 5.055 7.04v1.262c0 .527-.209 1.031-.581 1.403l-.893.893a1.984 1.984 0 0 0 0 2.806l.893.893c.372.372.581.876.581 1.403v1.262a1.984 1.984 0 0 0 1.984 1.984h1.262c.527 0 1.031.209 1.403.581l.893.893a1.984 1.984 0 0 0 2.806 0l.893-.893a1.985 1.985 0 0 1 1.403-.581h1.262a1.984 1.984 0 0 0 1.984-1.984V15.7c0-.527.209-1.031.581-1.403Z"/>
                </svg>
                <span class="text-center ml-2">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-6 flex justify-end">
            @if (Auth::check() && Auth::user()->email === 'admin@gmail.com')
                <a href="{{ route('subevents.create') }}"
                   class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-3 py-2 rounded-full shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah Sub-Event</span>
                </a>
            @endif
        </div>

        <div class="bg-white">
            @if($subEvents->isEmpty())
                <div class="text-center text-gray-500 mt-6">
                    No sub-events available.
                </div>
            @else
                @foreach($subEvents->groupBy('category') as $category => $events)
                    <h2 class="text-2xl font-semibold mt-6 mb-3">{{ $category }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($events as $subevent)
                            <div class="card bg-base-100 shadow-md rounded-lg max-w-[280px]">
                                <a href="{{ route('subevents.index', $subevent->id) }}">
                                    <figure>
                                        <img src="{{ $subevent->image }}" alt="{{ $subevent->name }}" class="w-full h-40 object-cover rounded-t-lg" />
                                    </figure>
                                </a>
                                <div class="card-body">
                                    <h2 class="card-title text-xl font-bold text-blue-700">
                                        {{ $subevent->name }}
                                    </h2>
                                    <p class="text-sm text-gray-700">{{ $subevent->description }}</p>
                                    <p class="text-sm text-blue-900 mt-2">
                                        {{ \Carbon\Carbon::parse($subevent->start_date)->format('d F') }}
                                        @if($subevent->category !== 'ELVERO' && $subevent->category !== 'FIDOVERO')
                                            - {{ \Carbon\Carbon::parse($subevent->end_date)->format('d F') }}
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    @if (Auth::check() && Auth::user()->email === 'admin@gmail.com')

                                        <div class="flex space-x-2 p-2">
                                            <a href="{{ route('subevents.edit', $subevent->id) }}"
                                               class="w-1/2 bg-blue-500 text-white hover:bg-blue-600 transition duration-300 text-center px-2 py-2 rounded-full shadow-md text-sm font-semibold transform hover:scale-105">
                                                <svg class="w-5 h-5 inline-block text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                                </svg>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('subevents.destroy', $subevent->id) }}" method="POST" class="w-1/2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="mr-2 w-full bg-red-600 text-white hover:bg-red-700 transition duration-300 text-center px-2 py-2 rounded-full shadow-md text-sm font-semibold transform hover:scale-105">
                                                    <svg class="w-5 h-5 inline-block text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <!-- Button Peraturan dan Daftar -->
                                        <div class="flex space-x-2 p-2">
                                            <a href="{{ route('subevents.rules', $subevent->id) }}"
                                               class="w-1/2 bg-white text-blue-700 border border-blue-500 hover:bg-gray-600 hover:text-blue-700 transition duration-300 text-center px-2 py-2 rounded-full shadow-md text-sm font-semibold transform hover:scale-105">
                                                <svg class="w-5 h-5 inline-block text-blue-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                                                </svg>
                                                <span>Peraturan</span>
                                            </a>
                                            <a href="{{ route('registrations.register', $subevent->id) }}"
                                                class="w-1/2 bg-blue-500 text-white hover:bg-blue-600 transition duration-300 text-center px-2 py-2 rounded-full shadow-md text-sm font-semibold transform hover:scale-105">
                                                 <svg class="w-5 h-5 text-white inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                 </svg>
                                                 <span>Daftar</span>
                                             </a>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
