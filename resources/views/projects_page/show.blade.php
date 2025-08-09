@extends('layouts.app')

@section('title', $card['title'] ?? 'Project Detail')

@section('content')
    <container class="flex flex-col">
        <div class="flex flex-col bg-cover bg-center bg-no-repeat h-[40rem]" style="background-image: url('{{ asset($card['image']) }}')">
            <div class="place-self-end mt-auto px-15 py-10 bg-black/0 w-full bg-gradient-to-t from-black to-transparent">
                <h4 class="text-2xl" style="color: #FAFAF6;">
                    {{ $card['category'] ?? 'Category' }}
                </h4>
                <h1 class="text-5xl font-bold mt-5" style="color: #FAFAF6;">
                    {{ $card['title'] ?? 'Title' }}
                </h1>
                <h4 class="text-2xl mt-5" style="color: #FAFAF6;">
                    {{ \Carbon\Carbon::parse($card['modified'])->format('d/m/Y') ?? 'dd/mm/yyyy' }}
                </h4>
            </div>
        </div>
        
        <div class="flex flex-1 px-15 py-10 min-h-screen">
            <!-- Left position -->
            <div class="flex flex-1 flex-col pr-10">
                <!-- Text content -->
                <p class="text-xl text-justify">
                    {!! $card['content'] ?? 'Konten belum tersedia.' !!}
                </p>

                <!-- Image in content -->
                <div class="w-[40em] m-5 self-center relative drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                    <img src="{{ asset($card['image']) }}" alt="Project Image" class=" inset-0 object-cover rounded-xl w-full h-full">
                </div>

                <!-- Collaborator section -->
                <div class="justify-items-start mt-8 text-xl">
                    <h4 class="text-2xl font-bold">
                        Collaborator
                    </h4>
                    <div class="flex w-full">
                        @if(!empty($card['collaborator']))
                            @foreach(explode(',', $card['collaborator'] ?? 'Collaborator') as $collaborator)
                                <a class="flex place-items-center mt-3" href="/">
                                    <div class="size-12 rounded-full bg-[#9BADDA] mr-3">
                                        <img src="{{ asset('/bal.png') }}" class="w-full h-full object-cover rounded-full bg-[#9BADDA] mr-3 ">   
                                    </div>
                                    <p>
                                        {{ trim($collaborator) }}
                                    </p>
                                </a>
                            @endforeach
                        @else
                            <span class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">No Collaborator</span>
                        @endif
                    </div>
                </div>
            </div>
    
            <!-- Right position -->
            <div class="flex flex-col justify-start ml-auto sticky top-30 self-start">
                <!-- Project section -->
                <div class="justify-items-start max-w-3xs">
                    <h4 class="text-2xl font-bold bg-[#9BADDA] text-center w-full rounded-t-xl py-3">
                        Project Link
                    </h4>
                    <div class="flex flex-wrap w-full p-4 text-[#FAFAF6] border-4 border-[#9BADDA] rounded-b-xl gap-4">
                        @if (!empty($card['project_link']))
                            @foreach (explode(',', $card['project_link']) as $project_link)
                                @php
                                    $url = trim($project_link);
                                    $host = parse_url($url, PHP_URL_HOST) ?? '';
                                    $host = str_replace('www.', '', strtolower($host));
    
                                    // Daftar label sesuai domain
                                    $labels = [
                                        'github.com' => 'GitHub',
                                        'figma.com' => 'Figma',
                                        'tailwindcss.com' => 'Tailwind',
                                        'behance.net' => 'Behance',
                                    ];
    
                                    // Cek apakah host ada di daftar label
                                    $label = $labels[$host] ?? ucfirst(strtok($host, '.'));
                                @endphp
    
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                    class="bg-[#9BADDA] py-2 px-5 rounded-lg drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] hover:bg-[#7690C3] transition">
                                    {{ $label }}
                                </a>
                            @endforeach
                        @else
                            <span class="bg-[#9BADDA] py-2 px-5 rounded-lg drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                                No Project Link
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Tags section -->
                <div class="justify-items-start mt-8 max-w-3xs">
                    <h4 class="text-2xl font-bold bg-[#9BADDA] text-center w-full rounded-t-xl py-3">
                        Tags
                    </h4>
                    <div class="flex w-full mb-10 p-4 text-[#FAFAF6] border-4 border-[#9BADDA] rounded-b-xl">
                        @if(!empty($card['tags']))
                            @foreach(explode(',', $card['tags']) as $tag)
                                <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] hover:bg-[#7690C3]">
                                    {{ trim($tag) }}
                                </a>
                            @endforeach
                        @else
                            <span class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">No Tags</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </container>
@endsection