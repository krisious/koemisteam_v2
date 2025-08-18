@extends('layouts.app')

@section('title', $card['title'] ?? 'Blog Detail')

@section('content')
    <div class="flex flex-col p-15">
        <div class="flex flex-col items-center">
            <!-- Category -->
            <h4 class="text-2xl text-center mt-auto">
                {{ $card['category'] ?? 'No category' }}
            </h4>

            <!-- Title -->
            <h1 class="text-5xl font-bold text-center mt-5">
                {{ $card['title'] ?? 'Title' }}
            </h1>

            <!-- Writer -->
            <h4 class="text-2xl text-center mt-5">
                {{ $card['writer'] ?? 'Unknown' }}
            </h4>

            <!-- Date Modified -->
            <h4 class="text-2xl text-center mt-5">
                {{ isset($card['modified']) ? \Carbon\Carbon::parse($card['modified'])->format('d/m/Y') : 'dd/mm/yyyy' }}
            </h4>

            <!-- Image -->
            <div class="w-auto h-auto mt-5 bg-[#9BADDA] p-8 rounded-lg text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                <img src="{{ asset($card['thumbnail'] ?? '/Chat 1.png') }}" alt="Blog Image" class="mx-auto">
            </div>
        </div>

        <!-- Content -->
        @php
            // Tambah <br> setelah setiap paragraf
            $formattedContent = isset($card['content'])
                ? preg_replace('/<\/p>/', '</p><br>', $card['content'])
                : '<p>Konten belum tersedia.</p>';
        @endphp

        <div class="mt-10 prose prose-lg max-w-none prose-headings:font-bold prose-a:text-blue-600 prose-a:underline hover:prose-a:text-blue-800 prose-img:rounded-lg prose-img:shadow-lg prose-blockquote:border-l-4 prose-blockquote:border-blue-400 prose-blockquote:pl-4 prose-blockquote:text-gray-600 custom-content">
            {!! $formattedContent !!}
        </div>

        <!-- Tags -->
        <div class="mt-8">
            <h4 class="text-2xl font-bold">Tags</h4>
            <div class="flex w-auto mt-3 drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                @if(!empty($card['tags']))
                    @foreach(explode(',', $card['tags']) as $tag)
                        <span class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg hover:bg-[#7690C3]" 
                        style="color: #FAFAF6;">
                            {{ trim($tag) }}
                        </span>
                    @endforeach
                @else
                    <span class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg"  style="color: #FAFAF6;">>No tags</span>
                @endif
            </div>
        </div>
    </div>
@endsection
