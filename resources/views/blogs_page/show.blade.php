@extends('layouts.app')

@section('title', 'Blog Page')

@section('content')
    <container class="flex flex-col p-15 ">
        <!-- Head Content -->
        <div class="flex flex-col items-center">
            <h4 class="text-2xl text-center mt-auto">
                Category
            </h4>
            <h1 class="text-5xl font-bold text-center mt-5">
                Title
            </h1>
            <h4 class="text-2xl text-center mt-5">
                Writer
            </h1>
            <h4 class="text-2xl text-center mt-5">
                date, dd/mm/yyyy
            </h4> 

            <!-- Image placeholder -->
            <div class="w-auto h-auto mt-5 bg-[#9BADDA] p-8 rounded-lg text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,100.25)]">
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