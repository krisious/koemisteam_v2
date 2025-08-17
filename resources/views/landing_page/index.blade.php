@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')

    <container>
        <container class="flex px-35 py-20 justify-center">
            <div class="flex mr-20">
                <img src="{{ asset('/Home.png') }}" class="w-2xl">
            </div>
            <div class="flex-1 content-center">
                <h1 class="text-5xl font-bold">
                    Welcome to The KOEMIS TEAM!
                </h1>
                <p class="text-xl mt-10 text-justify">
                    Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                    Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                </p>
                <div class="flex text-center drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] text-[#FAFAF6] mt-10">
                    <div class="bg-[#9BADDA] w-32 mr-8 px-5 py-2 rounded-xl">
                        <p class="font-bold text-xl -mb-2">{{ $membersCount }}</p>
                        <div>Members</div>
                    </div>
                    <div class="bg-[#9BADDA] w-32 mr-8 px-5 py-2 rounded-xl">
                        <p class="font-bold text-xl -mb-2">{{ $blogsCount }}</p>
                        <div>Stories</div>
                    </div>
                    <div class="bg-[#9BADDA] w-32 px-5 py-2 rounded-xl">
                        <p class="font-bold text-xl -mb-2">{{ $projectsCount }}</p>
                        <div>Projects</div>
                    </div>
                </div>
            </div>
        </container>
        
        <container class="flex flex-col px-35 py-20 place-content-center items-center w-full h-[45rem] self-center bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('/about-us.png') }}')">
            <h1 class="text-5xl font-bold text-center" style="color: #FAFAF6;">
                About US
            </h1>
            <p class="text-xl mt-10 text-center max-w-4xl" style="color: #FAFAF6;">
                Koemis team adalah circle pertemanan yang lahir dari tugas kuliah, berawal dari empat orang yang kini bertumbuh dengan anggota sefrekuensi. Terinspirasi dari 
                obrolan di warkop bubur kumis, kami resmi berdiri sebagai komunitas yang merayakan keberasamaan, kreativitas, dan kolaborasi, terus memperluas ikatan dan 
                menciptakan kenangan tak terlupakan.
            </p>
        </container>

        <container class="flex flex-col px-35 py-20 items-center">
            <h1 class="text-5xl/16 font-bold text-center">
                The Beginning of The </br> Koemis Team's </br> Journey
            </h1>
            
            <section class="px-4 relative -translate-y-25">
                <div class="relative max-w-6xl mx-auto">
                    <!-- Vertical line (1 garis penuh) -->
                    <div class="absolute top-[11rem] bottom-[6rem] left-1/2 transform -translate-x-1/2 w-1 bg-blue-300 z-0"></div>

                    <!-- Timeline items -->
                    <div class=" relative">
                        <!-- Row 1 -->
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-6">
                            <!-- Left Content -->
                            <div class="text-right hidden md:block">
                                <img src="{{ asset('/Timeline 1.png') }}" class="w-full max-w-[34rem] h-auto object-cover translate-y-15" />
                            </div>

                            <!-- Dot -->
                            <div class="flex justify-center relative w-[2rem]">
                                <div class="w-4 h-4 bg-blue-500 rounded-full z-10"></div>
                            </div>

                            <!-- Right Content -->
                            <div class="text-left">
                                <p class="text-gray-600 w-full">
                                    Berawal dari sebuah grup pada satu mata kuliah, empat orang membentuk pondasi circle penuh semangat.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Row 2 -->
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-6">
                            <!-- Left Content -->
                            <div class="text-right hidden md:block">
                                
                            </div>

                            <!-- Dot -->
                            <div class="flex justify-center relative w-[2rem]">
                                <div class="w-4 h-4 bg-blue-500 rounded-full z-10"></div>
                            </div>

                            <!-- Right Content -->
                            <div class="text-left">
                                <p class="text-gray-600 w-full">
                                    Saat kuliah offline, empat founder mengajak teman yang dianggap se-frekuensi, sehingga memperluas circle dengan anggota baru.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Row 3 -->
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-6">
                            <!-- Left Content -->
                            <div class="text-right hidden md:block">
                                Setelah kuliah, mendatangi warkop bubur kumis untuk mempererat ikatan dalam tawa dan obrolan.
                            </div>

                            <!-- Dot -->
                            <div class="flex justify-center relative w-[2rem]">
                                <div class="w-4 h-4 bg-blue-500 rounded-full z-10"></div>
                            </div>

                            <!-- Right Content -->
                            <div class="text-left">
                                <div class="text-right hidden md:block">
                                    <img src="{{ asset('/Timeline 2.png') }}" class="w-full max-w-[34rem] h-auto object-cover translate-y-17" />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Row 4 -->
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-6">
                            <!-- Left Content -->
                            <div class="text-right hidden md:block">
                                Pertemuan kedua dilaksanakan pada sebuah cafe, kami mengukuhkan visi bersama, dengan lebih banyak anggota baru dalam keakraban.
                            </div>

                            <!-- Dot -->
                            <div class="flex justify-center relative w-[2rem]">
                                <div class="w-4 h-4 bg-blue-500 rounded-full z-10"></div>
                            </div>

                            <!-- Right Content -->
                            <div class="text-left">
                                <p class="text-gray-600 max-w-[28rem]">
                                    
                                </p>
                            </div>
                        </div>
                        
                        <!-- Row 5 -->
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-6">
                            <!-- Left Content -->
                            <div class="justify-items-end my-15 hidden md:block">
                                <img src="{{ asset('/icon.png') }}" class="w-25 max-w-[34rem] h-auto object-cover" />
                            </div>

                            <!-- Dot -->
                            <div class="flex justify-center relative w-[2rem]">
                                <div class="w-4 h-4 bg-blue-500 rounded-full z-10"></div>
                            </div>

                            <!-- Right Content -->
                            <div class="text-left">
                                <p class="text-gray-600 w-full">
                                    Dari pertemuan rutin, kolaborasi, dan komunitas yang kian besar, circle resmi berdiri sebagai bubur 
                                    kumis yang namanya diambil berdasarkan tempat berkumpul pertama.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="flex justify-center">
                    <button class="bg-[#9BADDA] px-6 py-3 rounded-xl text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] hover:bg-[#7690C3] transition">
                        <a href="{{ route('member.index') }}">Show More</a>
                    </button>
                </div>
            </section>

        </container>

        <container class="flex flex-col px-15 pb-20 items-center h-full">
            <h1 class="text-5xl font-bold text-center">
                Blog
            </h1>

            <p class="text-xl mt-10 text-center max-w-xl justify-self-center">
                Blog ini hadir sebagai ruang berbagi informasi, pengalaman, dan perjalanan kami sebagai sebuah komunitas. 
                Semua terangkum untuk mendekatkan kami dengan kamu.
            </p>

            {{-- Blog thumbnail from DB --}}
            <div class="flex mt-10">
                @foreach($latestBlogs as $blog)
                    <div class="bg-[#9BADDA] w-2xs h-[11rem] mr-10 rounded-xl drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] overflow-hidden relative">
                        <img src="{{ asset('storage/'.$blog->thumbnail) }}" class="absolute inset-0 object-cover w-full h-full" />
                    </div>
                @endforeach
            </div>

            <!-- Button -->
            <button class="mt-10 bg-[#9BADDA] px-6 py-3 rounded-xl text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] hover:bg-[#7690C3] transition">
                <a href="{{ route('blog.index') }}">Show More</a>
            </button>
        </container>
        
        <container class="flex flex-col px-35 py-20 justify-center h-full">
            <h1 class="text-5xl font-bold text-center">
                Project
            </h1>
            <div class="flex mt-10 justify-center translate-x-22">
                <div class="mr-15 w-xs h-[27rem] bg-[#9BADDA] rounded-xl text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] overflow-hidden relative">
                    <img src="{{ asset('/prj.png') }}" class="absolute inset-0 object-cover w-full h-full" />
                </div>
                <div class="flex-1 max-w-3xl">
                    <p class="text-xl text-justify max-w-xl">
                    Wadah kolaborasi antar anggota. Setiap karya dihasilkan bukan hanya untuk menunjukkan kemampuan, tetapi juga sebagai sarana 
                    belajar bersama dan membangun portofolio yang bermakna. Semua dimulai dari semangat untuk tumbuh dan saling mendukung.
                    </p>
                    <!-- Button -->
                    <button class="mt-10 bg-[#9BADDA] px-6 py-3 rounded-xl text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] hover:bg-[#7690C3] transition">
                        <a href="{{ route('project.index') }}">Show More</a>
                    </button>
                    {{-- Project thumbnail from DB --}}
                    <div class="flex mt-10 max-w-3xl -translate-x-45">
                        @foreach($latestProjects as $project)
                            <div class="bg-[#9BADDA] w-[14rem] h-[8rem] mr-10 px-8 py-3 rounded-xl drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] overflow-hidden relative">
                                <img src="{{ asset('storage/'.$project->thumbnail) }}" class="absolute inset-0 object-cover w-full h-full" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </container>
    </container>

@endsection