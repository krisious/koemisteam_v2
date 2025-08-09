@extends('layouts.app')

@section('title', $card['title'] ?? 'Blog Detail')

@section('content')
    <container class="flex flex-col p-15 ">
        <div class="flex flex-col items-center">
            <h4 class="text-2xl text-center mt-auto">
                {{ $card['category'] ?? 'Category' }}
            </h4>
            <h1 class="text-5xl font-bold text-center mt-5">
                {{ $card['title'] ?? 'Title' }}
            </h1>
            <h4 class="text-2xl text-center mt-5">
                {{ $card['writer'] ?? 'Writer' }}
            </h4>
            <h4 class="text-2xl text-center mt-5">
                {{ \Carbon\Carbon::parse($card['modified'])->format('d/m/Y') ?? 'dd/mm/yyyy' }}
            </h4>

            <div class="w-auto h-auto mt-5 bg-[#9BADDA] p-8 rounded-lg text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                <img src="{{ asset($card['image'] ?? '/Chat 1.png') }}" alt="Blog Image" class="mx-auto">
            </div>
        </div>

        <p class="text-xl mt-10 text-justify">
            {!! $card['content'] ?? 'Konten belum tersedia.' !!}
        </p>

        <div class="justify-items-start mt-8">
            <h4 class="text-2xl font-bold">
                Tags
            </h4>
            <div class="flex w-auto text-[#FAFAF6] mt-3 drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] ">
                @if(!empty($card['tags']))
                    @foreach(explode(',', $card['tags']) as $tag)
                        <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg hover:bg-[#7690C3]">
                            {{ trim($tag) }}
                        </a>
                    @endforeach
                @else
                    <span class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg">No tags</span>
                @endif
            </div>
        </div>
    </container>
@endsection
