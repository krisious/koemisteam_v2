@extends('layouts.app')

@section('title', 'Project Page')

@section('content')
    <container>
        <container class="flex p-15 items-center bg-cover bg-center bg-no-repeat h-[40rem]" style="background-image: url('{{ asset('/bg-project.png') }}')">
            <div class="flex-col pl-30 max-w-3xl">
                <h1 class="text-5xl font-bold" style="color: #FAFAF6;">
                    Project
                </h1>
                <p class="text-xl my-10" style="color: #FAFAF6;">
                    Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                    Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                </p>
                <!-- Kumpulan Button -->
                <div class="flex flex-col w-max mb-8 relative z-50">

                    <!-- Form Search -->
                    <form method="GET" action="{{ route('project.index') }}" class="flex items-center space-x-0">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search..."
                            value="{{ $search }}"
                            class="bg-[#FAFAF6] text-[#444444] w-full h-11 p-2 rounded-l-lg border border-gray-300 focus:outline-none"
                        />
                        <button
                            type="submit"
                            class="bg-[#FAFAF6] text-[#444444] w-20 h-11 rounded-r-lg border border-gray-300 hover:bg-gray-200 transition"
                        >
                            Submit
                        </button>
                    </form>

                    <!-- Info hasil pencarian -->
                    @if ($search)
                        <p class="mt-2 text-sm text-gray-600">
                            Menampilkan hasil untuk: <strong>{{ $search }}</strong>
                            <a href="{{ route('project.index') }}" class="ml-4 text-blue-600 hover:underline">Reset</a>
                        </p>
                    @endif

                    <!-- Filter Buttons -->
                    <div class="flex space-x-4 mt-6 text-[#FAFAF6]">

                        <!-- Modified Filter -->
                        <div class="relative">
                            <button
                                type="button"
                                onclick="toggleDropdown('dropdownModified')"
                                class="bg-[#9BADDA] px-5 py-3 rounded-xl flex items-center focus:outline-none hover:bg-[#7690C3]"
                            >
                                <div class="mr-2">Modified</div>
                                <i class="fa-solid fa-caret-down"></i>
                            </button>

                            <div
                                id="dropdownModified"
                                class="hidden absolute mt-2 bg-white text-black rounded shadow py-2 w-40 z-20"
                            >
                                <a href="{{ route('project.index', array_merge(request()->except('filter_modified'), ['filter_modified' => 'latest'])) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 {{ $filterModified == 'latest' ? 'font-bold' : '' }}">
                                    Latest
                                </a>
                                <a href="{{ route('project.index', array_merge(request()->except('filter_modified'), ['filter_modified' => 'oldest'])) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 {{ $filterModified == 'oldest' ? 'font-bold' : '' }}">
                                    Oldest
                                </a>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="relative">
                            <button
                                type="button"
                                onclick="toggleDropdown('dropdownCategory')"
                                class="bg-[#9BADDA] px-5 py-3 rounded-xl flex items-center focus:outline-none hover:bg-[#7690C3]"
                            >
                                <div class="mr-2">Category</div>
                                <i class="fa-solid fa-caret-down"></i>
                            </button>

                            <div
                                id="dropdownCategory"
                                class="hidden absolute mt-2 bg-white text-black rounded shadow py-2 w-40 max-h-60 overflow-auto z-20"
                            >
                                @php
                                    $categories = ['Education', 'Teknologi', 'Bisnis', 'Kesehatan', 'Seni', 'Olahraga', 'Musik', 'Travel', 'Fashion'];
                                @endphp
                                <a href="{{ route('project.index', array_merge(request()->except('filter_category'), ['filter_category' => ''])) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 {{ $filterCategory == '' ? 'font-bold' : '' }}">
                                    All
                                </a>
                                @foreach ($categories as $cat)
                                    <a href="{{ route('project.index', array_merge(request()->except('filter_category'), ['filter_category' => $cat])) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 {{ $filterCategory == $cat ? 'font-bold' : '' }}">
                                        {{ $cat }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tags Filter -->
                        <div class="relative">
                            <button
                                type="button"
                                onclick="toggleDropdown('dropdownTags')"
                                class="bg-[#9BADDA] px-5 py-3 rounded-xl flex items-center focus:outline-none hover:bg-[#7690C3]"
                            >
                                <div class="mr-2">Tags</div>
                                <i class="fa-solid fa-caret-down"></i>
                            </button>

                            <div
                                id="dropdownTags"
                                class="hidden absolute mt-2 bg-white text-black rounded shadow py-2 w-40 max-h-60 overflow-auto z-20"
                            >
                                @php
                                    $tags = ['SPK', 'TOPSIS', 'AI', 'Machine Learning', 'Marketing', 'Sales', 'Wellness', 'Nutrition', 'Design', 'Painting', 'Football', 'Training', 'Jazz', 'Rock', 'Adventure', 'Tips', 'Style', 'Trends'];
                                @endphp
                                <a href="{{ route('project.index', array_merge(request()->except('filter_tag'), ['filter_tag' => ''])) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 {{ $filterTag == '' ? 'font-bold' : '' }}">
                                    All
                                </a>
                                @foreach ($tags as $tag)
                                    <a href="{{ route('project.index', array_merge(request()->except('filter_tag'), ['filter_tag' => $tag])) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 {{ $filterTag == $tag ? 'font-bold' : '' }}">
                                        {{ $tag }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </container>
        
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

        <!-- Content -->
        <div class="flex flex-wrap gap-10 -translate-y-30 z-0 justify-center">
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
            <div class="flex justify-center items-center space-x-2 -translate-y-15">
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
        
    </container>
@endsection

@section('scripts')
    <script>
        function toggleDropdown(id) {
            // Tutup semua dropdown kecuali yang diklik
            ['dropdownModified', 'dropdownCategory', 'dropdownTags'].forEach(dropdownId => {
                if (dropdownId !== id) {
                    document.getElementById(dropdownId).classList.add('hidden');
                }
            });
            // Toggle dropdown yang dipanggil
            const el = document.getElementById(id);
            el.classList.toggle('hidden');
        }

        // Tutup dropdown saat klik di luar tombol atau dropdown
        window.addEventListener('click', function(e) {
            if (!e.target.closest('button')) {
                ['dropdownModified', 'dropdownCategory', 'dropdownTags'].forEach(dropdownId => {
                    document.getElementById(dropdownId).classList.add('hidden');
                });
            }
        });
    </script>
@endsection