<nav class="relative max-w-screen-xl mx-auto flex items-center justify-between px-4 sm:px-6">
    <div class="flex items-center flex-1">
        <div class="flex items-center justify-between w-full md:w-auto">
            <a href="{{route('home')}}">
                <img class="h-8 w-auto sm:h-8" src="/images/cit_logo2.svg" alt=""/>
            </a>
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = true" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="hidden md:block md:ml-10 flex justify-between">
            {{--                    <a href="#"--}}
            {{--                       class="font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Courses</a>--}}
            {{--                    <a href="#" class="ml-10 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">Features</a>--}}
            <a href="tel: +35318097266"
               class="ml-10 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">01 – 8097266</a>
            <a href="mailto:info@citltd.ie"
               class="ml-10 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">info@citltd.ie</a>
        </div>
    </div>
    <div class="hidden md:block text-right">
                <span class="inline-flex rounded-md shadow-md">
                  <span class="inline-flex rounded-md shadow-xs">
                    <a href="#"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                     Book different course
                    </a>
                  </span>
                </span>
    </div>
</nav>
