@extends('layouts.app')

@section('title', 'Project Page')

@section('content')
    <container class="flex flex-col p-15 ">
        <!-- Head Content -->
        <div class="flex flex-col ">
            <h4 class="text-2xl mt-auto">
                Category
            </h4>
            <h1 class="text-5xl font-bold mt-5">
                Title
            </h1>
            <h4 class="text-2xl mt-5">
                date, dd/mm/yyyy
            </h4> 

            <!-- Image placeholder -->
            <div class="w-auto h-auto mt-5 bg-[#9BADDA] p-8 rounded-lg text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,100.25)] justify-items-center">
                <img src="{{ asset('/Chat 1.png') }}">
            </div>
        </div>
            
        <!-- Body Content -->
        <p class="text-xl mt-10 text-justify">
                Berawal dari perkumpulan tiga remaja dengan kelas mata kuliah yang sama dan akhirnya bertambah anggotanya menjadi 15 mahasiswa/i 
                dengan sifat, passion dan sifat yang berbeda-beda. Dikenal sebagai Warkop Bubur Koemis yang berasal dari tempat kami berkumpul 
                yaitu sebuah warung kopi dengan nama Bubur Kumis. Kami merupakan kumpulan mahasiswa/i dari program studi Sistem Informasi Fakultas 
                Ilmu Komputer UPN Veteran Jakarta. Warkop Bubur Koemis atau BK kami jadikan sebagai wadah untuk berbagi cerita, pengalaman, canda, 
                tawa, suka, duka, serta karya yang kami buat.
        </p>

        <div class="justify-items-start mt-8 text-xl">
            <h4 class="text-2xl font-bold">
                Collaborator
            </h4>

            <div class="flex flex-col w-auto">
                <a class="flex items-center">
                    <img src="{{ asset('/logo1 (2).png') }}" width="25em" class="size-10 rounded-full bg-[#9BADDA] mr-3 place-items-center mt-3">   
                    <p>teks</p>
                </a>
                <a class="flex items-center">
                    <div class="grid size-10 rounded-full bg-[#9BADDA] mr-3 place-items-center mt-3">
                        <img src="{{ asset('/logo1 (2).png') }}" width="25em">
                    </div>    
                    <p>teks</p>
                </a>
                <a class="flex items-center" href="/">
                    <div class="grid size-10 rounded-full bg-[#9BADDA] mr-3 place-items-center mt-3">
                        <i class="fa-regular fa-circle-user fa-2x"></i>
                    </div>
                    <p>teks</p>
                </a>
                    
                </a>
            </div>
        </div>

        <div class="justify-items-start mt-8">
            <h4 class="text-2xl font-bold">
                Project Links
            </h4>

            <div class="flex w-auto text-[#FAFAF6] mt-3 drop-shadow-[8px_8px_4px_rgba(107,114,158,100.25)]">
                <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg">
                    text 1
                </a>
                <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg">
                    text testing 2
                </a>
            </div>
        </div>

        <div class="justify-items-start mt-8">
            <h4 class="text-2xl font-bold">
                Tags
            </h4>

            <div class="flex w-auto text-[#FAFAF6] mt-3 drop-shadow-[8px_8px_4px_rgba(107,114,158,100.25)]">
                <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg ">
                    text testing 1
                </a>
                <a class="mr-4 bg-[#9BADDA] py-2 px-5 rounded-lg">
                    text 2
                </a>
            </div>
        </div>
    </container>
@endsection