<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @vite('resources/css/app.css')
    
    <title>@yield('title') - Koemis Team </title>

    <!-- Font -->
    <script src="https://kit.fontawesome.com/1cfe2803b2.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- <link href="{{asset('theme/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"> -->
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" width="48px" height="48px">

    <style>
        p, h1, h2, h3, h4, h5, h6, date {
            color: #444444;
        }
        .thick-line {
        height: 3px;
        background-color: #444444;
        border: none; /* Remove default border */
        }
        .swiper-button-next,
        .swiper-button-prev {
            width: 30px;        /* default sekitar 44px */
            height: 30px;       /* default sekitar 44px */
            background-color: rgba(0, 0, 0, 0.3); /* opsional */
            border-radius: 50%; /* opsional: buat jadi bulat */
            backdrop-filter: blur(0.5px); /* efek blur latar belakang */
        }

        /* opsional: ubah ukuran ikon panah */
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 16px; /* default sekitar 20–24px */
            color: white;    /* warna ikon */
        }

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

        .custom-content h3 {
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
</head>

<body id="page-top" class="bg-fixed bg-cover bg-center bg-no-repeat" style="background-image: url('/bg.jpg')">
    <div class="fixed inset-0 bg-white/10 z-0"></div>

    <div id="wrapper" class="relative z-10">

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" style="margin-top: 20px;">

                @include('layouts._header')

                <div class="container-fluid" style="margin-top: 70px;">
                        
                    @yield('content')
                    @yield('scripts')

                </div>
            </div>

            @include('layouts._footer')

        </div>
    </div>

    <!-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->


    <!-- <script src="{{asset('theme/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('theme/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('theme/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @yield('script')

</body>

</html>
