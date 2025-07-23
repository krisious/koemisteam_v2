@extends('layouts.app')

@section('title', 'Blog Page')

@section('content')
    <container>
        <container class="flex p-30 items-center">
            <div class="flex-1 pl-30">
                <h1 class="text-5xl font-bold">
                    Blog
                </h1>
                <p class="text-xl mt-10">
                    Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                    Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                </p>
            </div>
            <div class="flex-1 ml-5">
                <img src="{{ asset('/Chat 1.png') }}">
            </div>
        </container>

        <container class="flex flex-col px-30 h-full">
            <!-- Header -->
            <div class="w-full bg-[#9BADDA] px-8 rounded-lg text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,100.25)]">
                <!-- Search -->
                <div class="flex my-4 items-center">
                    <!-- Kiri: Info Pencarian -->
                    @if (request('search'))
                        <p class="mb-0 text-sm text-muted">
                            Menampilkan hasil untuk: <strong>{{ request('search') }}</strong>
                        </p>
                    @else
                        <div></div> {{-- Untuk menjaga agar kanan tetap di posisi kanan --}}
                    @endif

                    <div class="flex ml-auto justify-end-safe">
                        <!-- Kanan: Form Search -->
                        <form method="GET" action="{{ route('blog.index') }}" class="form-inline">
                        <input type="text" name="search" placeholder="Search..."
                            value="{{ request('search') }}"
                            class="bg-[#FAFAF6] text-[#444444] w-3xs p-2 rounded-l-lg" />
                            <!-- Button Search -->
                        <button type="submit" class="bg-[#FAFAF6] text-[#444444] size-10 rounded-r-lg">Cari</button>
                    </form>

                    <!-- Filter Button -->
                    <button class="bg-[#FAFAF6] size-10 rounded-lg ml-3 place-items-center">
                        <img src="{{ asset('/Vector.png') }}" width="25em">
                    </button>
                    </div>
                    
                </div>
            </div>

            <!-- Content -->
            <container>
                <a href="{{ route('blog.show') }}" class="flex py-10">
                    <div class="w-xl h-auto">
                        <img src="{{ asset('/gambar1.png') }}">
                    </div>
                    <div>
                        <time class="text-md">
                            Modified
                        </time>
                        <h1 class="text-4xl font-bold mt-3">
                            SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)
                        </h1>
                        <p class="text-xl mt-3">
                            Collaborator
                        </p>
                        <p class="text-md mt-3">
                            Category
                        </p>
                        <p class="text-md mt-3">
                            Tags
                        </p>
                    </div>
                </a>
                <hr class="thick-line">
                <a href="{{ route('blog.show') }}" class="flex py-10">
                    <div class="w-xl h-auto">
                        <img src="{{ asset('/gambar1.png') }}">
                    </div>
                    <div>
                        <time class="text-md">
                            Modified
                        </time>
                        <h1 class="text-4xl font-bold mt-3">
                            SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)
                        </h1>
                        <p class="text-xl mt-3">
                            Collaborator
                        </p>
                        <p class="text-md mt-3">
                            Category
                        </p>
                        <p class="text-md mt-3">
                            Tags
                        </p>
                    </div>
                </a>
                <hr class="thick-line">
                <a href="{{ route('blog.show') }}" class="flex py-10">
                    <div class="w-xl h-auto">
                        <img src="{{ asset('/gambar1.png') }}">
                    </div>
                    <div>
                        <time class="text-md">
                            Modified
                        </time>
                        <h1 class="text-4xl font-bold mt-3">
                            SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)
                        </h1>
                        <p class="text-xl mt-3">
                            Collaborator
                        </p>
                        <p class="text-md mt-3">
                            Category
                        </p>
                        <p class="text-md mt-3">
                            Tags
                        </p>
                    </div>
                </a>
                <hr class="thick-line">
                <a href="{{ route('blog.show') }}" class="flex py-10">
                    <div class="w-xl h-auto">
                        <img src="{{ asset('/gambar1.png') }}">
                    </div>
                    <div>
                        <time class="text-md">
                            Modified
                        </time>
                        <h1 class="text-4xl font-bold mt-3">
                            SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)
                        </h1>
                        <p class="text-xl mt-3">
                            Collaborator
                        </p>
                        <p class="text-md mt-3">
                            Category
                        </p>
                        <p class="text-md mt-3">
                            Tags
                        </p>
                    </div>
                </a>
                <hr class="thick-line">
                <a href="{{ route('blog.show') }}" class="flex py-10">
                    <div class="w-xl h-auto">
                        <img src="{{ asset('/gambar1.png') }}">
                    </div>
                    <div>
                        <time class="text-md">
                            Modified
                        </time>
                        <h1 class="text-4xl font-bold mt-3">
                            SPK Siswa Teladan Metode TOPSIS (SMK Negeri 8 Jakarta)
                        </h1>
                        <p class="text-xl mt-3">
                            Collaborator
                        </p>
                        <p class="text-md mt-3">
                            Category
                        </p>
                        <p class="text-md mt-3">
                            Tags
                        </p>
                    </div>
                </a>
            </container>
        </container>
    </container>
@endsection