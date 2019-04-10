@extends('layouts.html')

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('body')
    <body class="bg-gray-100 text-gray-700 h-screen antialiased">
    <div id="app">

        <div class="min-h-screen md:flex">

            <div class="flex-none bg-gray-800 text-white py-4 px-8 w-full md:max-w-xs">
                <div class="flex justify-between">
                    <div>
                        @include('partials.logo')
                    </div>
                    <div class="md:hidden">
                        <a href="#" onclick="showmenu()">
                            <svg height="32px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px"
                                 xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z" fill="#fff"/></svg>
                        </a>
                    </div>
                </div>

                <div class="md:pb-8"></div>

                <ul id="navbar" class="list-reset md:flex flex-col" style="display: none;">
                    <li class="rounded-lg {{ active_check('app',false) }}">
                        <a class="text-white  flex p-3 py-4 my-2" href="{{ route('app.dashboard.index') }}">
                            <div class="mt-1 w-3 h-3 mr-6 rounded-full {{ active_check('app',false,'bg-red-500','bg-gray-700') }}"></div>
                            <div class="">Dashboard</div>
                        </a></li>
                    <li class="rounded-lg {{ active_check('app/account-settings',true) }}">
                        <a class="text-white  flex p-3 py-4 my-2" href="{{ route('app.account.index') }}">
                            <div class="mt-1 w-3 h-3 mr-6 rounded-full {{ active_check('app/account-settings',false,'bg-red-500','bg-gray-700') }}"></div>
                            <div class="">Account Settings</div>
                        </a></li>
                </ul>
            </div>
            <div class="content flex-1 flex flex-col">
                <div class="shadow bg-white text-grey-darker h-12 p-4">
                    <div class="text-right">
                        {{--                    {{ Auth::user()->name }}--}}

                        <a href="{{ route('logout') }}"
                           class="hover:underline p-3"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>

                    </div>

                </div>
                @include('flash::message')
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
    @include('partials.common_scripts')
    </body>
@endsection