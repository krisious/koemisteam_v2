@extends('layouts.app')

@section('title', $card['title'] ?? 'Project Detail')

@section('content')
    <container class="flex flex-col">
        <div class="flex flex-col bg-cover bg-center bg-no-repeat h-[40rem]" style="background-image: url('{{ $card['thumbnail'] }}')">
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
                <!-- content -->
                @php
                    // Tambah <br> setelah setiap paragraf
                    $formattedContent = isset($card['content'])
                        ? preg_replace('/<\/p>/', '</p><br>', $card['content'])
                        : '<p>Konten belum tersedia.</p>';
                @endphp

                <div class="mt-10 prose prose-lg max-w-none prose-headings:font-bold prose-a:text-blue-600 prose-a:underline hover:prose-a:text-blue-800 prose-img:rounded-lg prose-img:shadow-lg prose-blockquote:border-l-4 prose-blockquote:border-blue-400 prose-blockquote:pl-4 prose-blockquote:text-gray-600 custom-content">
                    {!! $formattedContent !!}
                </div>

                <style>
                    /* Batasi gambar dalam figure */
                    .custom-content figure img {
                        max-width: 40rem;
                        width: 100%;
                        height: auto;
                        margin-left: auto;
                        margin-right: auto;
                        display: block;
                    }

                    /* Optional: figure center alignment */
                    .custom-content figure {
                        text-align: center;
                    }

                    .custom-content h2 {
                        font-size: 1.5rem;
                        font-weight: bold;
                    }
                </style>

                <!-- Collaborator section -->
                <div class="justify-items-start mt-8 text-xl">
                    <h4 class="text-2xl font-bold">
                        Collaborator
                    </h4>
                    <div class="flex flex-col w-full flex-wrap gap-3">
                        @if(!empty($card['collaborators']))
                            @foreach($card['collaborators'] as $collaborator)
                                <a class="flex place-items-center mt-3" href="{{ url('/member-page/show/'.$collaborator['slug']) }}">
                                    <div class="size-12 rounded-full bg-[#9BADDA] mr-3">
                                        <img src="{{ $collaborator['profile_picture'] }}" 
                                            class="w-full h-full object-cover rounded-full">   
                                    </div>
                                    <p>{{ $collaborator['name'] }}</p>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
    
            <!-- Right position -->
            <div class="flex flex-col justify-start ml-auto sticky top-30 self-start">
                <div class="justify-items-start max-w-3xs">
                    <h4 class="text-2xl font-bold bg-[#9BADDA] text-center w-full rounded-t-xl py-3">
                        Project Link
                    </h4>
                    <div class="flex flex-wrap w-full p-4 text-[#FAFAF6] border-4 border-[#9BADDA] rounded-b-xl gap-4">
                        @if (!empty($card['link']))
                            @foreach($card['link'] as $link)
                                @php
                                    $url = $link['url'];
                                    $host = parse_url($url, PHP_URL_HOST) ?? '';
                                    $host = str_replace('www.', '', strtolower($host));

                                    $labels = [
                                        'github.com' => 'GitHub',
                                        'figma.com' => 'Figma',
                                        'tailwindcss.com' => 'Tailwind',
                                        'behance.net' => 'Behance',
                                    ];

                                    $label = $labels[$host] ?? ($link['name'] ?? ucfirst(strtok($host, '.')));
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
                    <div class="flex flex-wrap w-full mb-10 p-4 text-[#FAFAF6] border-4 border-[#9BADDA] rounded-b-xl gap-3">
                        @if(!empty($card['tags']))
                            @foreach(explode(',', $card['tags']) as $tag)
                                <a class="bg-[#9BADDA] py-2 px-5 rounded-lg drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] hover:bg-[#7690C3]">
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
