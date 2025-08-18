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
                                <img src="{{ asset('storage/'.$contact->icon) }}" alt="{{ $contact->name }}" class="w-4 h-4 mx-auto">
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
                        <img src="{{ asset('storage/'.$skill->icon) }}" alt="{{ $skill->name }}" class="w-6 h-6 inline-block mr-2">
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
    <div class="px-16 mt-16">
        <h3 class="text-5xl font-bold">Blog</h3>
        <hr class="thick-line px-16 mt-5 mb-10">

        <div class="flex flex-wrap gap-10 justify-center">
            @forelse ($blogs as $blog)
                <div class="flex flex-col max-w-sm drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] basis-1/4 group hover:bg-white/50 rounded-xl">
                    <a href="{{ route('blog.show', $blog->slug) }}">
                        <div class="h-[14rem] relative overflow-hidden rounded-t-xl">
                            <img src="{{ $blog->thumbnail ? asset('storage/'.$blog->thumbnail) : asset('/bg-blog.png') }}" 
                                class="absolute inset-0 object-cover w-full h-full transition-transform duration-300 group-hover:scale-110 group-hover:brightness-90" />
                        </div>
                        <div class="rounded-b-xl p-5 border-x border-b border-white/80 h-[16rem] leading-relaxed">
                            <time class="text-md pb-2">
                                {{ $blog->created_at->format('d M Y') }}
                            </time>
                            <h1 class="text-2xl font-bold pb-3">{{ limitWords($blog->title, 8) }}</h1>
                            <p class="text-md pb-2">{{ $blog->category->name ?? '-' }}</p>
                            <p class="text-md pb-2">
                                {{ $blog->tags->pluck('name')->take(3)->implode(', ') }}
                                @if($blog->tags->count() > 3)
                                    +{{ $blog->tags->count() - 3 }}
                                @endif
                            </p>
                            <p class="text-md font-bold text-[#9BADDA]">See more...</p>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-gray-500">No blog posts available.</p>
            @endforelse
        </div>

        {{-- Blog Pagination --}}
        @if ($totalBlogPages > 1)
            <div class="flex justify-center items-center space-x-2 my-10">
                @for ($page = 1; $page <= $totalBlogPages; $page++)
                    <a href="?blog_page={{ $page }}&project_page={{ $currentProjectPage }}"
                    class="px-4 py-2 border rounded {{ $page == $currentBlogPage ? 'bg-[#9CADDA] text-white' : 'bg-white text-[#9CADDA] hover:bg-[#9CADDA]/20' }}">
                        {{ $page }}
                    </a>
                @endfor
            </div>
        @endif
    </div>

    <!-- Project Section -->
    <div class="px-16 mt-16">
        <h1 class="text-5xl font-bold">Project</h1>
        <hr class="thick-line px-16 mt-5 mb-10">

        <div class="flex flex-wrap gap-10 justify-center">
            @forelse ($projects as $project)
                <div class="flex flex-col max-w-sm drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] basis-1/4 group hover:bg-white/50 rounded-xl">
                    <a href="{{ route('project.show', $project->slug) }}">
                        <div class="h-[14rem] relative overflow-hidden rounded-t-xl">
                            <img src="{{ $project->thumbnail ? asset('storage/'.$project->thumbnail) : asset('/bg-project.png') }}" 
                                class="absolute inset-0 object-cover w-full h-full transition-transform duration-300 group-hover:scale-110 group-hover:brightness-90" />
                        </div>
                        <div class="rounded-b-xl p-5 border-x border-b border-white/80 h-[16rem] leading-relaxed">
                            <time class="text-md pb-2">
                                {{ $project->created_at->format('d M Y') }}
                            </time>
                            <h1 class="text-2xl font-bold pb-3">{{ limitWords($project->title, 8) }}</h1>
                            <p class="text-md pb-2">{{ $project->category->name ?? '-' }}</p>
                            <p class="text-md pb-2">
                                {{ $project->tags->pluck('name')->take(3)->implode(', ') }}
                                @if($project->tags->count() > 3)
                                    +{{ $project->tags->count() - 3 }}
                                @endif
                            </p>
                            <p class="text-md font-bold text-[#9BADDA]">See more...</p>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-gray-500">No projects available.</p>
            @endforelse
        </div>

        {{-- Project Pagination --}}
        @if ($totalProjectPages > 1)
            <div class="flex justify-center items-center space-x-2 my-10">
                @for ($page = 1; $page <= $totalProjectPages; $page++)
                    <a href="?project_page={{ $page }}&blog_page={{ $currentBlogPage }}"
                       class="px-4 py-2 border rounded {{ $page == $currentProjectPage ? 'bg-[#9CADDA] text-white' : 'bg-white text-[#9CADDA] hover:bg-[#9CADDA]/20' }}">
                        {{ $page }}
                    </a>
                @endfor
            </div>
        @endif
    </div>
</container>
@endsection
