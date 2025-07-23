@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')

    <container>
        <container class="flex p-30 items-center">
            <div class="flex-1 pl-30">
                <h1 class="text-5xl font-bold">
                    Welcome to The KOEMIS TEAM!
                </h1>
                <p class="text-xl mt-10">
                    Kami adalah kolaborasi dari para kreator yang percaya bahwa setiap proses layak untuk diceritakan. 
                    Website ini menjadi ruang untuk mengenal siapa kami, mengapa kami terbentuk, dan karya apa yang telah kami hasilkan.
                </p>
                <button class="mt-10 bg-[#9BADDA] px-8 py-3 rounded-lg text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,100.25)]">
                    <a href="{{ route('member.index') }}">Know Us Better</a>
                </button>
            </div>
            <div class="flex-1 ml-5">
                <img src="{{ asset('/gambar1.png') }}">
            </div>
        </container>
        
        <container class="flex flex-col p-30 items-center bg-[#BECDF4] h-full">
            <div class="py-[50px]">
                <h1 class="text-5xl font-bold text-center">
                    About US
                </h1>
                <p class="text-xl mt-10 text-justify max-w-3xl">
                    Berawal dari perkumpulan tiga remaja dengan kelas mata kuliah yang sama dan akhirnya bertambah anggotanya menjadi 15 mahasiswa/i 
                    dengan sifat, passion dan sifat yang berbeda-beda. Dikenal sebagai Warkop Bubur Koemis yang berasal dari tempat kami berkumpul 
                    yaitu sebuah warung kopi dengan nama Bubur Kumis. Kami merupakan kumpulan mahasiswa/i dari program studi Sistem Informasi Fakultas 
                    Ilmu Komputer UPN Veteran Jakarta. Warkop Bubur Koemis atau BK kami jadikan sebagai wadah untuk berbagi cerita, pengalaman, canda, 
                    tawa, suka, duka, serta karya yang kami buat.
                </p>
            </div>
        </container>

        <container class="flex flex-col p-30 items-center">
            <div class="py-[50px]">
                <h1 class="text-5xl font-bold text-center">
                    Blog
                </h1>
                <p class="text-xl mt-10 text-justify max-w-3xl">
                    Berawal dari perkumpulan tiga remaja dengan kelas mata kuliah yang sama dan akhirnya bertambah anggotanya menjadi 15 mahasiswa/i 
                    dengan sifat, passion dan sifat yang berbeda-beda. Dikenal sebagai Warkop Bubur Koemis yang berasal dari tempat kami berkumpul 
                    yaitu sebuah warung kopi dengan nama Bubur Kumis. Kami merupakan kumpulan mahasiswa/i dari program studi Sistem Informasi Fakultas 
                    Ilmu Komputer UPN Veteran Jakarta. Warkop Bubur Koemis atau BK kami jadikan sebagai wadah untuk berbagi cerita, pengalaman, canda, 
                    tawa, suka, duka, serta karya yang kami buat.
                </p>
            </div>
        </container>

        <container class="flex flex-col p-30 items-center bg-[#BECDF4] h-full">
            <div class="py-[50px]">
                <h1 class="text-5xl font-bold text-center">
                    About US
                </h1>
                <p class="text-xl mt-10 text-justify max-w-3xl">
                    Berawal dari perkumpulan tiga remaja dengan kelas mata kuliah yang sama dan akhirnya bertambah anggotanya menjadi 15 mahasiswa/i 
                    dengan sifat, passion dan sifat yang berbeda-beda. Dikenal sebagai Warkop Bubur Koemis yang berasal dari tempat kami berkumpul 
                    yaitu sebuah warung kopi dengan nama Bubur Kumis. Kami merupakan kumpulan mahasiswa/i dari program studi Sistem Informasi Fakultas 
                    Ilmu Komputer UPN Veteran Jakarta. Warkop Bubur Koemis atau BK kami jadikan sebagai wadah untuk berbagi cerita, pengalaman, canda, 
                    tawa, suka, duka, serta karya yang kami buat.
                </p>
            </div>
        </container>
    </container>

@endsection