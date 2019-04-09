<footer class="bg-gray-800 text-white w-full">
    <div class="w-full">
        <div class="flex container mx-auto pt-4 pb-8 md:py-12">

            <div class="hidden md:flex md:pr-16 items-center justify-center border-r border-red-500">
                <div>
                    @include('partials.logo')
                    <div class="mt-4 text-gray-500">
                        Slogan
                    </div>
                </div>
            </div>

            <div class="flex flex-col text-center md:text-left md:flex-row md:pl-16 justify-content-between flex-1">

                <div class="flex-1">
                    <div class="text-gray-500 tracking-wide py-4 md:pb-8 font-semibold text-sm">PRODUCT</div>
                    <div class="leading-loose flex flex-col">
                        @auth
                            <a href="{{ url('/app') }}" class="text-gray-400 ">Dashboard</a>
                        @else
                            <a href="/pricing" class="text-gray-300 ">Sign Up</a>
                        @endauth
                        <a href="/pricing" class="text-gray-300 ">Pricing</a>
                        <a href="/api-docs" class="text-gray-300 ">API</a>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="text-gray-500 tracking-wide py-4 mt-4 md:mt-0 md:pb-8 font-semibold text-sm">LEGAL</div>
                    <div class="leading-loose flex flex-col">
                        <a href="/privacy-policy" class="text-gray-300 ">Privacy Policy</a>
                        <a href="/terms-of-use" class="text-gray-300 ">Terms Of Use</a>
                        {{--<a href="/dmca" class="text-white ">DMCA</a>--}}
                    </div>
                </div>

                <div class="flex-1">
                    <div class="text-gray-500 tracking-wide py-4 mt-4 md:mt-0 md:pb-8 font-semibold text-sm">SUPPORT
                    </div>
                    <div class="leading-loose flex flex-col">
                        <a href="#" class="text-gray-300 ">Live Chat</a>
                        <a href="/contact" class="text-gray-300">Contact Us</a>
                    </div>
                </div>

            </div>

        </div>
        <div class="text-center text-gray-500 text-sm bg-gray-900 p-4 leading-loose">
            All Rights Reserved &copy; 2019 <br>
        </div>

    </div>

</footer>
