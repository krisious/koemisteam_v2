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

    <link rel="icon" type="image/png" href="{{ asset('logo1 (2).png') }}" width="48px" height="48px">

    <style>
        p, h1, h2, h3, h4, h5, h6, date {
            color: #444444;
        }
        .thick-line {
        height: 3px;
        background-color: #9BADDA;
        border: none; /* Remove default border */
        }
    </style>
</head>

<body id="page-top" style="background-color: #FAFAF6">
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" style="margin-top: 20px;">

                @include('layouts._header')

                <div class="container-fluid" style="margin-top: 70px;">

                    @yield('content')

                </div>

            </div>

            @include('layouts._footer')

        </div>

    </div>

    <!-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->


    <script src="{{asset('theme/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('theme/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('theme/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    @yield('script')

</body>

</html>
