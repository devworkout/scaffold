<div id="navbar" style="display: none"
     class="md:ml-8 flex flex-col flex-1 md:flex-row justify-between items-center md:items-start">
    <div class="flex flex-col md:flex-row w-full md:w-auto items-center">
        {{--        <a href="/api-docs" class="p-4 md:mx-4 text-white ">API Overview</a>--}}
        {{--        <a href="/pricing" class="p-4 md:mx-4 text-white ">Pricing</a>--}}
    </div>
    <div class="flex flex-col md:w-auto md:flex-row w-full items-center">
        @auth
            <a href="{{ url('/app') }}" class="p-4 md:mx-4 text-white ">Dashboard</a>
        @else
            {{--            <a href="/pricing" class="p-4 md:mx-4 text-white ">Sign Up</a>--}}
            <a href="/login" class="p-4 md:mx-4 text-white ">Sign In</a>
        @endauth
    </div>
</div>