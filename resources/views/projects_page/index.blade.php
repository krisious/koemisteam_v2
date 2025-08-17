@extends('layouts.app')

@section('title', 'Project Page')

@section('content')
<div>
    <!-- Hero Section -->
    <div class="relative flex items-center bg-cover bg-center bg-no-repeat h-[40rem]" 
        style="background-image: url('{{ asset('/bg-project.png') }}')">
        <div class="max-w-5xl px-8 py-12">
            <h1 class="text-5xl font-bold" style="color: #FAFAF6;">Project</h1>
            <p class="text-xl my-6 max-w-3xl" style="color: #FAFAF6;">
                Setiap karya lahir dari kolaborasi, ide, dan proses panjang yang penuh makna. Di halaman project ini, kami membagikan jejak langkah kami—dari konsep, eksperimen, hingga hasil akhir. Inilah tempat untuk melihat wujud nyata dari visi dan mimpi yang kami bangun bersama.
            </p>

            <!-- Search & Filters (form GET) -->
            <form id="filterForm" method="GET" action="{{ route('project.index') }}" class="space-y-4">
                <!-- Search -->
                <div class="flex items-center gap-2">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search..."
                        value="{{ $search ?? '' }}"
                        class="flex-1 bg-white/90 text-[#444444] h-11 p-3 rounded-md border border-gray-300 focus:outline-none"
                    />
                    <button type="submit" class="h-11 px-4 rounded-md bg-[#FAFAF6] text-[#444444] border border-gray-300 hover:bg-gray-200">
                        Submit
                    </button>
                    <a href="{{ route('project.index') }}" class="h-11 px-3 rounded-md bg-white/20 text-white border border-white/30 flex items-center justify-center hover:underline">Reset</a>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <button type="button" onclick="toggleDropdown('ddSort')" class="flex items-center gap-2 px-4 py-2 rounded-md bg-[#9BADDA] text-white hover:bg-[#7f94c4]">
                            Sort
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div id="ddSort" class="hidden absolute mt-2 bg-white text-gray-800 rounded shadow w-48 z-50">
                            <label class="block px-4 py-2">
                                <input type="radio" name="filter_modified" value="latest" {{ ($filterModified ?? 'latest') === 'latest' ? 'checked' : '' }}>
                                <span class="ml-2">Latest</span>
                            </label>
                            <label class="block px-4 py-2">
                                <input type="radio" name="filter_modified" value="oldest" {{ ($filterModified ?? '') === 'oldest' ? 'checked' : '' }}>
                                <span class="ml-2">Oldest</span>
                            </label>
                            <div class="flex justify-end gap-2 px-3 py-2 border-t">
                                <button type="button" onclick="submitFilter()" class="px-3 py-1 bg-[#9BADDA] text-white rounded">Apply</button>
                            </div>
                        </div>
                    </div>

                    <!-- Category Dropdown (multiple) -->
                    <div class="relative">
                        <button type="button" id="catBtn" onclick="toggleDropdown('ddCategory')" class="flex items-center gap-2 px-4 py-2 rounded-md bg-[#9BADDA] text-white hover:bg-[#7f94c4]">
                            Category
                            <span id="catSummary" class="text-sm ml-2 opacity-90" style="color: #FAFAF6">
                                {{ count($selectedCategoryNames) ? implode(', ', array_slice($selectedCategoryNames,0,3)) . (count($selectedCategoryNames) > 3 ? '...' : '') : 'All' }}
                            </span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div id="ddCategory" class="hidden absolute mt-2 bg-white text-gray-800 rounded shadow w-64 z-50">
                            <div class="max-h-48 overflow-auto p-2 space-y-1">
                                @foreach ($categories as $category)
                                    <label class="flex items-center gap-2 px-2 py-1 rounded hover:bg-gray-50">
                                        <input type="checkbox" name="filter_category[]" value="{{ $category->slug }}"
                                            data-name="{{ $category->name }}"
                                            class="cat-checkbox"
                                            {{ in_array($category->slug, $selectedCategories) ? 'checked' : '' }}>
                                        <span class="text-sm">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="flex justify-between items-center gap-2 px-3 py-2 border-t">
                                <div>
                                    <button type="button" onclick="clearSelection('cat-checkbox')" class="text-sm text-gray-600 hover:underline">Clear</button>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" onclick="submitFilter()" class="px-3 py-1 bg-[#9BADDA] text-white rounded">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags Dropdown (multiple) -->
                    <div class="relative">
                        <button type="button" id="tagBtn" onclick="toggleDropdown('ddTags')" class="flex items-center gap-2 px-4 py-2 rounded-md bg-[#9BADDA] text-white hover:bg-[#7f94c4]">
                            Tags
                            <span id="tagSummary" class="text-sm ml-2 opacity-90" style="color: #FAFAF6">
                                {{ count($selectedTagNames) ? implode(', ', array_slice($selectedTagNames,0,3)) . (count($selectedTagNames) > 3 ? '...' : '') : 'All' }}
                            </span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div id="ddTags" class="hidden absolute mt-2 bg-white text-gray-800 rounded shadow w-64 z-50">
                            <div class="max-h-48 overflow-auto p-2 space-y-1">
                                @foreach ($tags as $tag)
                                    <label class="flex items-center gap-2 px-2 py-1 rounded hover:bg-gray-50">
                                        <input type="checkbox" name="filter_tag[]" value="{{ $tag->slug }}"
                                            data-name="{{ $tag->name }}"
                                            class="tag-checkbox"
                                            {{ in_array($tag->slug, $selectedTags) ? 'checked' : '' }}>
                                        <span class="text-sm">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="flex justify-between items-center gap-2 px-3 py-2 border-t">
                                <div>
                                    <button type="button" onclick="clearSelection('tag-checkbox')" class="text-sm text-gray-600 hover:underline">Clear</button>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" onclick="submitFilter()" class="px-3 py-1 bg-[#9BADDA] text-white rounded">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end filters row -->
            </form>
        </div>
    </div>

    <!-- Project Cards Grid -->
    <div class="max-w-6xl mx-auto px-6 -translate-y-16">
        @if (count($cards) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($cards as $card)
                    <article class="bg-white rounded-xl overflow-hidden shadow group">
                        <a href="{{ route('project.show', ['slug' => $card['slug']]) }}" class="block">
                            <div class="h-56 overflow-hidden relative">
                                <img src="{{ $card['thumbnail'] }}" alt="{{ $card['title'] }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
                            </div>
                            <div class="p-5">
                                <time class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($card['modified'])->format('d M Y') }}</time>
                                <h3 class="text-xl font-bold mt-2">{{ \Illuminate\Support\Str::words($card['title'], 12, '...') }}</h3>
                                <p class="text-sm text-gray-600 mt-2">{{ $card['category'] }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $card['tags'] }}</p>
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
                <h2 class="text-2xl font-bold text-gray-800">Tidak Ada Project yang Sesuai</h2>
                <p class="text-gray-600 mt-2">Coba ubah kata kunci atau filter pencarian Anda.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleDropdown(id) {
        ['ddSort','ddCategory','ddTags'].forEach(k => {
            if (k !== id) document.getElementById(k)?.classList.add('hidden');
        });
        document.getElementById(id)?.classList.toggle('hidden');
    }

    document.addEventListener('click', function(e) {
        const dropdowns = ['ddSort','ddCategory','ddTags'];
        const inside = dropdowns.some(id => {
            const el = document.getElementById(id);
            const btn = document.querySelector(`[onclick="toggleDropdown('${id}')"]`);
            return el && (el.contains(e.target) || (btn && btn.contains(e.target)));
        });
        if (!inside) {
            dropdowns.forEach(id => document.getElementById(id)?.classList.add('hidden'));
        }
    });

    function submitFilter() {
        document.getElementById('filterForm').submit();
    }

    function clearSelection(checkboxClass) {
        document.querySelectorAll('.' + checkboxClass).forEach(cb => cb.checked = false);
        updateSummaries();
    }

    function updateSummaries() {
        const catChecks = Array.from(document.querySelectorAll('.cat-checkbox'));
        const selectedCats = catChecks.filter(c => c.checked).map(c => c.dataset.name);
        const catSummary = document.getElementById('catSummary');
        catSummary.textContent = selectedCats.length === 0 ? 'All' : (selectedCats.length <= 3 ? selectedCats.join(', ') : selectedCats.slice(0,3).join(', ') + '...');

        const tagChecks = Array.from(document.querySelectorAll('.tag-checkbox'));
        const selectedTags = tagChecks.filter(c => c.checked).map(c => c.dataset.name);
        const tagSummary = document.getElementById('tagSummary');
        tagSummary.textContent = selectedTags.length === 0 ? 'All' : (selectedTags.length <= 3 ? selectedTags.join(', ') : selectedTags.slice(0,3).join(', ') + '...');
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSummaries();
        document.querySelectorAll('.cat-checkbox, .tag-checkbox').forEach(cb => {
            cb.addEventListener('change', updateSummaries);
        });
    });
</script>
@endsection
