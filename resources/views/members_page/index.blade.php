@extends('layouts.app')

@section('title', 'Member Page')

@section('content')
    <div class="flex flex-col p-15 items-center">
        <h1 class="text-5xl font-bold text-center mt-5">Let's meet our team!</h1>

        <div class="container max-w-[1280px] py-8 mt-5 drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($members as $member)
                        <div class="swiper-slide">
                            <div class="bg-white p-4 rounded-4xl text-center transition-transform duration-300 transform hover:scale-105">
                                <img src="{{ asset($member['img']) }}" />
                                <h2 class="font-semibold">{{ $member['name'] }}</h2>
                                <p class="text-sm text-gray-500">{{ $member['desc'] }}</p>
                                <a href="{{ route('member.show', $member['id']) }}"
                                   class="inline-block bg-[#9BADDA] text-[#FAFAF6] px-5 py-2 rounded-lg hover:bg-[#7690C3] transition drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)]">
                                    Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="swiper-button-prev"></button>
                <button class="swiper-button-next"></button>
            </div>
        </div>

        <h4 class="text-4xl font-bold mt-3">Name</h4>
        <p class="text-xl mt-3 text-justify max-w-3xl">
            Berawal dari perkumpulan tiga remaja dengan kelas mata kuliah yang sama dan akhirnya bertambah anggotanya menjadi 15 mahasiswa/i 
            dengan sifat, passion dan sifat yang berbeda-beda...
        </p>

        <!-- Button -->
        <button class="mt-5 bg-[#9BADDA] px-6 py-3 rounded-xl text-[#FAFAF6] drop-shadow-[8px_8px_4px_rgba(107,114,158,0.35)] hover:bg-[#7690C3] transition">
            <a href="{{ route('blog.index') }}">Show More</a>
        </button>
    </div>

    <style>
        .mySwiper .swiper-wrapper {
        overflow-x: visible !important;  /* biarkan isi lebar bebas horizontal */
        overflow-y: visible !important;  /* biarkan isi lebar bebas vertikal */
        padding-top: 20px;   /* beri ruang atas supaya scale tidak terpotong */
        padding-bottom: 20px; /* beri ruang bawah supaya scale tidak terpotong */
        }
        .mySwiper {
        overflow-x: hidden !important; /* sembunyikan scrollbar horizontal */
        overflow-y: visible !important; /* biarkan overflow vertikal visible */
        position: relative;
        }
        .swiper-slide {
            display: flex;
            justify-content: center;
            transition: transform 0.3s ease, opacity 0.3s ease;
            height: auto !important;
        }

        .swiper-slide > div {
            width: 290px;
            height: 470px;
            background-color: white;
            padding: 1rem;
            border-radius: 2rem;
            text-align: center;
            /* display: flex; */
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .swiper-slide img {
            height: 350px;
            width: 100%;
            object-fit: cover;
            border-radius: 1rem;
            background-color: #9BADDA;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        window.addEventListener('load', function () {
            const swiper = new Swiper(".mySwiper", {
                slidesPerView: 5,
                centeredSlides: true, // ✅ Slide aktif berada di tengah
                spaceBetween: 30,
                loop: true,
                grabCursor: true,
                watchSlidesProgress: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    320: { slidesPerView: 1 },
                    640: { slidesPerView: 2 },
                    768: { slidesPerView: 3 },
                    1024: { slidesPerView: 4 },
                },
                on: {
                    setTranslate: function () {
                        this.slides.forEach((slide) => {
                            const progress = slide.progress;
                            let scale = 0.8;
                            let opacity = 0.5;
                            let translateX = 0;

                            if (Math.abs(progress) < 0.5) {
                                scale = 1;
                                opacity = 1;
                                translateX = 0;
                            } else if (Math.abs(progress) < 1.5) {
                                scale = 0.9;
                                opacity = 0.8;
                                translateX = progress * 15; // offset kecil
                            } else {
                                scale = 0.8;
                                opacity = 0.5;
                                translateX = progress * 30; // offset lebih besar
                            }

                            slide.style.transform = `translateX(${translateX}px) scale(${scale})`;
                            slide.style.opacity = opacity;
                        });
                    },
                    setTransition: function (speed) {
                        this.slides.forEach((slide) => {
                            slide.style.transition = `${speed}ms`;
                        });
                    },
                }
            });
        });
    </script>
@endsection
