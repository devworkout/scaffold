@extends('layouts.app')

@section('body')
    <body class="text-sans bg-gray-900 sm:bg-gray-800 h-screen">
    <div id="app">
        <div class="center h-screen">


            <div class="flex flex-col break-words bg-gray-900 sm:rounded-lg sm:shadow-lg sm:p-10">

                <div class="center">
                    @include('partials.logo')
                </div>

                @if (session('status'))
                    <div class="bg-green-200 text-green-800 rounded p-3 m-8 mb-0 border border-green-400" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')

            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
    @include('partials.common_scripts')
    </body>
@overwrite

@section('content')
    I override content
@endsection