@extends('layouts.app')

@section('title', 'Member Page')

@section('content')
    <container class="flex flex-col p-15 ">
        <!-- Content section -->
        <div class="flex">
            <div class="flex-1 grid gap-4">
                <div>
                    <h1 class="text-5xl font-bold mb-5">
                        Name
                    </h1>
                    <p class="text-xl text-justify">
                        Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                        Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                        Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                        Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                        Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                        Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                        Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                        Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                        Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                        Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                        Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                        Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                    </p>
                </div>
                <div class="content-end">
                    <h3 class="text-3xl font-bold">
                        Contact
                    </h3>
                    <button class="flex bg-[#9BADDA] size-10 rounded-lg mt-3 place-items-center">
                        IG
                    </button>
                </div>                
            </div>
            <container class="flex ml-15 bg-white p-4 pb-10 rounded-4xl drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                <img src="{{ asset('/bal.png') }}" class="w-auto h-120 rounded-3xl mx-auto mb-2 bg-[#9BADDA]" />
            </container>
        </div>

        <!-- Skills section -->
        <div class="flex flex-col items-center">
            <h3 class="text-2xl font-bold text-center mt-auto">
                Skills
            </h3>

            <div class="flex w-auto text-[#FAFAF6] mt-3 drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg">
                    text 1
                </a>
                <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg">
                    text testing 2
                </a>
            </div>
        </div>        
    </container>

    <!-- Project Section -->
    <container class="flex flex-col px-15 h-full">
        <!-- Memotong judul jadi 2 -->
        @php
            function limitWords($string, $limit = 8) {
                $words = explode(' ', $string);
                if (count($words) > $limit) {
                    return implode(' ', array_slice($words, 0, $limit)) . '...';
                }
                return $string;
            }
        @endphp    
        
        <!-- Card blog -->
        <div class=" px-16">
            <h3 class="text-5xl font-bold">
                Blog
            </h3>
            <hr class="thick-line px-16 mt-5 mb-10">
            <!-- Content -->
            <div class="flex flex-wrap gap-10 z-0 justify-center">
                @foreach ($cards as $index => $card)
                    <div class="flex flex-col max-w-sm drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] basis-1/4 group cursor-pointer hover:bg-white/50 rounded-xl">
                        <a href="{{ route('blog.show', ['id' => $card['id']]) }}">
                            <div class="h-[14rem] relative overflow-hidden rounded-t-xl">
                                <img src="{{ asset('/bg-blog.png') }}" 
                                    class="absolute inset-0 object-cover w-full h-full transition-transform duration-300 group-hover:scale-110 group-hover:brightness-90 rounded-t-xl" />
                            </div>
                            <div class="rounded-b-xl p-5 border-x border-b border-white/80 h-[16rem] leading-relaxed">
                                <time class="text-md pb-2">
                                    {{ \Carbon\Carbon::parse($card['modified'])->format('d M Y') }}
                                </time>
                                <h1 class="text-2xl font-bold pb-3">
                                    {{ limitWords($card['title'], 8) }}
                                </h1>
                                <p class="text-md pb-2">
                                    {{ $card['category'] }}
                                </p>
                                <p class="text-md pb-2">
                                    {{ $card['tags'] }}
                                </p>
                                <p class="text-md font-bold" style="color: #9BADDA;">
                                    See more...
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($totalPages > 1)
                <div class="flex justify-center items-center space-x-2 my-10">
                    {{-- Prev Button --}}
                    <a href="?page={{ max(1, $currentPage - 1) }}"
                        class="px-3 py-2 border border-[#9CADDA] rounded cursor-pointer
                            {{ $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#9CADDA] hover:text-white' }}"
                        @if($currentPage == 1) aria-disabled="true" @endif>
                            <i class="fa-solid fa-caret-left" style="color: #6B729E;"></i>
                    </a>

                    {{-- Number Buttons --}}
                    @for ($page = 1; $page <= $totalPages; $page++)
                        <a href="?page={{ $page }}"
                            class="px-4 py-2 border rounded {{ $page == $currentPage ? 'bg-[#9CADDA] text-white' : 'bg-white text-[#9CADDA] hover:bg-[#9CADDA]/20' }}">
                            {{ $page }}
                        </a>
                    @endfor

                    {{-- Next Button --}}
                    <a href="?page={{ min($totalPages, $currentPage + 1) }}"
                        class="px-3 py-2 border border-[#9CADDA] rounded cursor-pointer
                            {{ $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#9CADDA] hover:text-white' }}"
                        @if($currentPage == $totalPages) aria-disabled="true" @endif>
                            <i class="fa-solid fa-caret-right" style="color: #6B729E;"></i>
                    </a>
                </div>
            @endif
        </div>
        
        <!-- Card project -->
        <div class="px-16">
            <h1 class="text-5xl font-bold">
                Project
            </h1>
            <hr class="thick-line px-16 mt-5">
            <!-- Content -->
            <div class="flex flex-wrap gap-10 z-0 justify-center mt-10">
                @foreach ($cards as $index => $card)
                    <div class="flex flex-col max-w-sm drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] basis-1/4 group cursor-pointer hover:bg-white/50 rounded-xl">
                        <a href="{{ route('project.show', ['id' => $card['id']]) }}">
                            <div class="h-[14rem] relative overflow-hidden rounded-t-xl">
                                <img src="{{ asset('/bg-project.png') }}" 
                                    class="absolute inset-0 object-cover w-full h-full transition-transform duration-300 group-hover:scale-110 group-hover:brightness-90 rounded-t-xl" />
                            </div>
                            <div class="rounded-b-xl p-5 border-x border-b border-white/80 h-[16rem] leading-relaxed">
                                <time class="text-md pb-2">
                                    {{ \Carbon\Carbon::parse($card['modified'])->format('d M Y') }}
                                </time>
                                <h1 class="text-2xl font-bold pb-3">
                                    {{ limitWords($card['title'], 8) }}
                                </h1>
                                <p class="text-md pb-2">
                                    {{ $card['category'] }}
                                </p>
                                <p class="text-md pb-2">
                                    {{ $card['tags'] }}
                                </p>
                                <p class="text-md font-bold" style="color: #9BADDA;">
                                    See more...
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($totalPages > 1)
                <div class="flex justify-center items-center space-x-2 mt-10 mb-20">
                    {{-- Prev Button --}}
                    <a href="?page={{ max(1, $currentPage - 1) }}"
                        class="px-3 py-2 border border-[#9CADDA] rounded cursor-pointer
                            {{ $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#9CADDA] hover:text-white' }}"
                        @if($currentPage == 1) aria-disabled="true" @endif>
                            <i class="fa-solid fa-caret-left" style="color: #6B729E;"></i>
                    </a>

                    {{-- Number Buttons --}}
                    @for ($page = 1; $page <= $totalPages; $page++)
                        <a href="?page={{ $page }}"
                            class="px-4 py-2 border rounded {{ $page == $currentPage ? 'bg-[#9CADDA] text-white' : 'bg-white text-[#9CADDA] hover:bg-[#9CADDA]/20' }}">
                            {{ $page }}
                        </a>
                    @endfor

                    {{-- Next Button --}}
                    <a href="?page={{ min($totalPages, $currentPage + 1) }}"
                        class="px-3 py-2 border border-[#9CADDA] rounded cursor-pointer
                            {{ $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#9CADDA] hover:text-white' }}"
                        @if($currentPage == $totalPages) aria-disabled="true" @endif>
                            <i class="fa-solid fa-caret-right" style="color: #6B729E;"></i>
                    </a>
                </div>
            @endif
        </div>
        
    </container>
@endsection