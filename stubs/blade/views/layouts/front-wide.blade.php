@extends('layouts.app')
@section('body')
    <body class="bg-gray-100 text-gray-700 antialiased h-screen">
    <div id="app" class="flex h-screen flex-col">

        <div class="md:h-24 p-4 bg-gray-800 items-center md:items-start justify-between">
            <div class="container mx-auto flex flex-col md:flex-row items-center">
                <div class="flex w-full md:w-auto justify-between">
                    <div>
                        @include('partials.logo')
                    </div>
                    <div class="md:hidden">
                        <a href="#" onclick="showmenu()"> <img class="h-8" src="/hamburger.svg" alt=""> </a>
                    </div>
                </div>

                @include('partials.headernav')

            </div>
        </div>

        <div class="flex-1">
            @yield('content')
        </div>

        {{--        @include('partials.footer')--}}
        @include('partials.footer-minimal')

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        function showmenu() {
            var x = document.getElementById('navbar');
            if (x.style.display == 'none') {
                x.classList.remove('fadeOut')
                x.classList.add('animated', 'fadeIn')
                x.style.display = 'flex';
            } else {
                x.classList.remove('fadeIn')
                x.classList.add('animated', 'fadeOut')
                setTimeout(function () {
                    x.classList.remove('fadeOut', 'animated')
                    x.style.display = 'none';
                }, 300)
            }
        }

        window.addEventListener('resize', function () {
            revealSidebar();
        });

        document.addEventListener("DOMContentLoaded", function () {
            revealSidebar();
        });

        function revealSidebar() {
            if (window.innerWidth >= 768) {
                document.getElementById('navbar').style.display = 'flex';
            }
        }
    </script>

    @yield('scripts')
    @include('partials.common_scripts')
    </body>
@endsection
