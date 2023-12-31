<nav class=" max-w-screen-xl mx-auto flex items-center justify-between px-4 sm:px-6">
    <div class="flex items-center flex-1">
        <div class="flex items-center justify-between w-full md:w-auto">
            <a href="{{route('home')}}">
{{--logo                --}}
                <img class="h-8 w-auto sm:h-8" src="" alt=""/>
            </a>
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open_navbar = true" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
