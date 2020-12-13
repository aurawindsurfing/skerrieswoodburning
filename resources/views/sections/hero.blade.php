<div x-bind:class="{ 'relative': !show_modal }" class="bg-white overflow-hidden">
    <div x-bind:class="{ 'lg:absolute': !show_modal }"  class="hidden lg:block lg:inset-0">
        <svg x-bind:class="{ 'hidden': show_modal, 'absolute': !show_modal }" class="top-0 left-1/2 transform translate-x-64 -translate-y-8" width="640" height="784"
             fill="none" viewBox="0 0 640 784">
            <defs>
                <pattern id="svg-pattern-squares-desktop" x="118" y="0" width="20" height="20"
                         patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                </pattern>
            </defs>
            <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor"/>
            <rect x="118" width="404" height="784" fill="url(#svg-pattern-squares-desktop)"/>
        </svg>
    </div>
    <div x-bind:class="{ 'relative': !show_modal }" class="pt-6 pb-16 md:pb-16 lg:pb-20 xl:pb-24">

        @include('sections.partials.navbar')

        @include('sections.partials.mobile-nav')

        <div class="mt-8 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-20 xl:mt-24">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
{{--                    <div--}}
{{--                        class="text-sm font-semibold uppercase tracking-wide text-gray-500 sm:text-base lg:text-sm xl:text-base">--}}
{{--                        Construction Industry Training Ltd--}}
{{--                    </div>--}}
                    <h2 class="mt-1 text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:leading-none sm:text-6xl lg:text-5xl xl:text-5xl">
                        Your Workplace Safety
                        <br class="hidden md:inline"/>
                        <span class="text-blue-600">Starts With Us</span>
                    </h2>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                        We offer a complete service, from providing an initial Training Needs Analysis through to
                        Professional Course Delivery and post delivery Course Feedback.
                    </p>
                    <div class="mt-5 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                        {{--                        <p class="text-base font-medium text-gray-900">--}}
                        {{--                            Book your safepass course right now.--}}
                        {{--                        </p>--}}
{{--                        <form action="#" method="POST" class="mt-3 sm:flex">--}}
                            <div class="flex flex-col sm:w-3/4 sm:mx-auto lg:mx-0">
                                {{--                                <div>--}}
                                {{--                                <input aria-label="Name"--}}
                                {{--                                       class="appearance-none block w-full px-3 py-3 border border-gray-300 text-base leading-6 rounded-md placeholder-gray-500 shadow-sm focus:outline-none focus:placeholder-gray-400 focus:shadow-outline focus:border-blue-300 transition duration-150 ease-in-out sm:flex-auto"--}}
                                {{--                                       placeholder="Enter your name"/>--}}
                                {{--                                </div>--}}
                                {{--                                <div>--}}
                                {{--                                <input aria-label="Phone"--}}
                                {{--                                       class="mt-3 appearance-none block w-full px-3 py-3 border border-gray-300 text-base leading-6 rounded-md placeholder-gray-500 shadow-sm focus:outline-none focus:placeholder-gray-400 focus:shadow-outline focus:border-blue-300 transition duration-150 ease-in-out sm:flex-auto"--}}
                                {{--                                       placeholder="Enter your phone number"/>--}}
                                {{--                                </div>--}}


                                <div class="mt-3">
                                    <a href="{{route('list', ['type' => 1])}}">
                                        <button class="mt-3 ml-0 w-full px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-0 sm:flex-shrink-0  sm:items-center ">
                                            Book Safepass Now
                                        </button>
                                    </a>
                                </div>

                                <div class="mt-3">
                                    <a href="{{route('list')}}">
                                        <button class="mt-3 ml-0 w-full px-6 py-3 border text-lg leading-6 font-medium rounded-md text-blue-600 bg-gray-50 hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:bg-gray-100 focus:text-blue-700 transition duration-150 ease-in-out">
                                            Book Other Course Now
                                        </button>
                                    </a>
                                </div>

                            </div>

{{--                        </form>--}}
                        {{--                        <p class="mt-3 text-sm leading-5 text-gray-500">--}}
                        {{--                            We care about the protection of your data. Read our--}}
                        {{--                            <a href="#" class="font-medium text-gray-900 underline">Privacy Policy</a>.--}}
                        {{--                        </p>--}}
                    </div>
                </div>
                <div
                    class="mt-12  sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
{{--                    <svg--}}
{{--                        class=" top-0 left-1/2 transform -translate-x-1/2 -translate-y-8 scale-75 origin-top sm:scale-100 lg:hidden"--}}
{{--                        width="640" height="784" fill="none" viewBox="0 0 640 784">--}}
{{--                        <defs>--}}
{{--                            <pattern id="svg-pattern-squares-mobile" x="118" y="0" width="20" height="20"--}}
{{--                                     patternUnits="userSpaceOnUse">--}}
{{--                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>--}}
{{--                            </pattern>--}}
{{--                        </defs>--}}
{{--                        <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor"/>--}}
{{--                        <rect x="118" width="404" height="784" fill="url(#svg-pattern-squares-mobile)"/>--}}
{{--                    </svg>--}}
                    <div class=" mx-auto w-full rounded-lg shadow-lg lg:max-w-2xl ">
                        <button
                            class="block w-full rounded-lg overflow-hidden focus:outline-none focus:shadow-outline">
                            <img class="w-full" src="{{ $image }}" alt=""/>
{{--                            <div class="absolute inset-0 w-full h-full flex items-center justify-center">--}}
{{--                                <svg class="h-20 w-20 text-blue-500" fill="currentColor" viewBox="0 0 84 84">--}}
{{--                                    <circle opacity="0.9" cx="42" cy="42" r="42" fill="white"/>--}}
{{--                                    <path--}}
{{--                                        d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
