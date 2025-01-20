@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">{{ $news->title }}</h1>
    <img src="{{ Storage::url($news->cover_image) }}" alt="{{ $news->title }}" class="w-full h-auto rounded-lg mb-4">
    <p class="text-gray-500">{{ \Carbon\Carbon::parse($news->upload_date)->format('d F Y') }}</p>
    <p class="mt-4">{{ $news->content }}</p>
</div>
@endsection
