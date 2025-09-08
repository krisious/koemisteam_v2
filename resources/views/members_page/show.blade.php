@extends('layouts.app')

@section('title', $member->name)

@section('content')
<container class="flex flex-col p-15">
    <!-- Header Section -->
    <div class="flex">
        <div class="flex-1 grid gap-4">
            <!-- Member Name -->
            <div>
                <h1 class="text-5xl font-bold mb-5">{{ $member->name }}</h1>
                <p class="text-xl text-justify">{!! $member->bio ?? '-' !!}</p>
            </div>

            <!-- Contacts -->
            <div class="content-end mt-6">
                <h3 class="text-3xl font-bold">Contact</h3>
                <div class="flex flex-wrap gap-3 mt-3">
                    @forelse ($contacts as $contact)
                        <a href="{{ $contact->pivot->value ?? '#' }}" target="_blank" 
                            class="flex bg-[#9BADDA] size-10 rounded-lg place-items-center">
                            @if($contact->icon)
                                <img src="{{ $contact->icon_url  }}" alt="{{ $contact->name }}" class="w-4 h-4 mx-auto">
                            @else
                                <span class="text-white text-sm mx-auto">{{ $contact->name }}</span>
                            @endif
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">No contacts available.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Profile Picture -->
        <container class="flex ml-15 bg-white p-4 pb-10 rounded-4xl drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
            <img src="{{ $member['profile_picture_url'] }}" alt="{{ $member['name'] }}" class="w-auto h-120 rounded-3xl mx-auto mb-2 bg-[#9BADDA]">
        </container>
    </div>

    <!-- Skills -->
    <div class="flex flex-col items-center mt-10">
        <h3 class="text-2xl font-bold text-center">Skills</h3>
        <div class="flex flex-wrap gap-4 mt-3">
            @forelse ($skills as $skill)
                <div class="text-white py-2 px-5 rounded-lg flex items-start" style="background-color: {{ $skill->color }}">
                    @if($skill->icon)
                        <img src="{{ $skill->icon_url }}" alt="{{ $skill->name }}" class="w-6 h-6 inline-block mr-2">
                    @endif
                    <p class="font-bold">{{ $skill->name }}</p>
                </div>
            @empty
                <p class="text-sm text-gray-500">No skills listed.</p>
            @endforelse
        </div>
    </div>

    <!-- Helper function -->
    @php
        function limitWords($string, $limit = 8) {
            $words = explode(' ', $string);
            return count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . '...' : $string;
        }
    @endphp    

    <!-- Blog Section -->
    <div class="max-w-6xl mx-auto px-6 mt-16">
        <h3 class="text-5xl font-bold">Blog</h3>
        <hr class="thick-line px-16 mt-5 mb-10">

        @if ($blogs->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
                @foreach ($blogs as $blog)
                    <article class="bg-white rounded-xl overflow-hidden shadow group">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="block">
                            <!-- Thumbnail -->
                            <div class="h-56 overflow-hidden relative">
                                <img src="{{ $blog->thumbnail_url }}" 
                                    alt="{{ $blog->title }}" 
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105 group-hover:brightness-90" />
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <time class="text-sm text-gray-500">
                                    {{ $blog->created_at->format('d M Y') }}
                                </time>
                                <h1 class="text-xl font-bold mt-2">
                                    {{ limitWords($blog->title, 12) }}
                                </h1>
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $blog->category->name ?? 'Uncategorized' }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $blog->tags->pluck('name')->take(3)->implode(', ') }}
                                    @if($blog->tags->count() > 3)
                                        +{{ $blog->tags->count() - 3 }}
                                    @endif
                                </p>
                                <p class="mt-3 text-sm font-semibold text-[#9BADDA]">See more...</p>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $blogs->links() }}
            </div>
        @else
            <!-- Empty state -->
            <div class="flex flex-col items-center justify-center text-center py-20">
                <i class="fa-solid fa-circle-exclamation text-6xl text-[#9BADDA] mb-4"></i>
                <h2 class="text-2xl font-bold text-gray-800">Sepertinya blog ini masih kosong... Yuk tunggu update terbaru dariku.</h2>
            </div>
        @endif
    </div>


    <!-- Project Section -->
    <div class="max-w-6xl mx-auto px-6 mt-16">
        <h3 class="text-5xl font-bold">Project</h3>
        <hr class="thick-line px-16 mt-5 mb-10">

        @if ($projects->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
                @foreach ($projects as $project)
                    <article class="bg-white rounded-xl overflow-hidden shadow group">
                        <a href="{{ route('project.show', $project->slug) }}" class="block">
                            <!-- Thumbnail -->
                            <div class="h-56 overflow-hidden relative">
                                <img src="{{ $project->thumbnail_url }}" 
                                    alt="{{ $project->title }}" 
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105 group-hover:brightness-90" />
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <time class="text-sm text-gray-500">
                                    {{ $project->created_at->format('d M Y') }}
                                </time>
                                <h1 class="text-xl font-bold mt-2">
                                    {{ limitWords($project->title, 12) }}
                                </h1>
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $project->category->name ?? 'Uncategorized' }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $project->tags->pluck('name')->take(3)->implode(', ') }}
                                    @if($project->tags->count() > 3)
                                        +{{ $project->tags->count() - 3 }}
                                    @endif
                                </p>
                                <p class="mt-3 text-sm font-semibold text-[#9BADDA]">See more...</p>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $projects->links() }}
            </div>
        @else
            <!-- Empty state -->
            <div class="flex flex-col items-center justify-center text-center py-20">
                <i class="fa-solid fa-circle-exclamation text-6xl text-[#9BADDA] mb-4"></i>
                <h2 class="text-2xl font-bold text-gray-800">Sepertinya project ini masih kosong... Yuk tunggu update terbaru dariku.</h2>
            </div>
        @endif
    </div>
</container>
@endsection
