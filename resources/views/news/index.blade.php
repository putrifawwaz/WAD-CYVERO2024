@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-20">
    @if (session('success'))
        <div class="bg-blue-700 text-white p-2 rounded-lg flex items-center justify-center mb-10" style="height: 30px;">
            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8.032 12 1.984 1.984 4.96-4.96m4.55 5.272.893-.893a1.984 1.984 0 0 0 0-2.806l-.893-.893a1.984 1.984 0 0 1-.581-1.403V7.04a1.984 1.984 0 0 0-1.984-1.984h-1.262a1.983 1.983 0 0 1-1.403-.581l-.893-.893a1.984 1.984 0 0 0-2.806 0l-.893.893a1.984 1.984 0 0 1-1.403.581H7.04A1.984 1.984 0 0 0 5.055 7.04v1.262c0 .527-.209 1.031-.581 1.403l-.893.893a1.984 1.984 0 0 0 0 2.806l.893.893c.372.372.581.876.581 1.403v1.262a1.984 1.984 0 0 0 1.984 1.984h1.262c.527 0 1.031.209 1.403.581l.893.893a1.984 1.984 0 0 0 2.806 0l.893-.893a1.985 1.985 0 0 1 1.403-.581h1.262a1.984 1.984 0 0 0 1.984-1.984V15.7c0-.527.209-1.031.581-1.403Z"/>
            </svg>
            <span class="text-center ml-2">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-5 flex justify-end">
        @if (Auth::check() && Auth::user()->email === 'admin@gmail.com')
            <a href="{{ route('news.create') }}"
               class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-3 py-2 rounded-full shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Berita</span>
            </a>
        @endif
    </div>

    @php
        $newsGroupedByDate = $news->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->upload_date)->format('d F Y');
        });
    @endphp

    @foreach ($newsGroupedByDate as $date => $items)
        <div class="mb-5">
            <h2 class="text-md mb-3 font-semibold">{{ $date }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($items as $item)
                    <div class="bg-white rounded-lg shadow-md p-4 flex w-full">
                        <img src="{{ Storage::url($item->cover_image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded-lg">
                        <div class="ml-4 flex flex-col justify-between w-full">
                            <div>
                                <h3 class="text-xl font-semibold">{{ $item->title }}</h3>
                                <p class="text-gray-500">{{ \Carbon\Carbon::parse($item->upload_date)->format('d F Y') }}</p>
                                <p class="text-gray-700 break-words">{{ Str::limit($item->content, 100) }} <a href="{{ route('news.show', $item->id) }}" class="text-blue-600">Read more</a></p>
                            </div>
                            @if (auth()->user()->email === 'admin@gmail.com')
                                <div class="flex items-center space-x-2 mb-1">
                                    <a href="{{ route('news.edit', $item->id) }}" class="text-gray-800 hover:text-blue-600">
                                        <svg class="w-5 h-5 text-blue-900 text-opacity-80" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="inline-block">
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
