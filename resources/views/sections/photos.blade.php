<div class="py-6 bg-white">
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Skerries Stationary
                    <br/>
                    <span class="text-blue-600">Led By 6th</span>
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">Skerries Wood Burning can be found in many places such as Eurospar Skerries, Bradly's Pharmacy and St. Vincent's. We sell colored ornaments, Christmas Coasters and Pencil Cases.
                </p>
            </div>
            <div class="mx-auto  mt-16 grid max-w-2xl grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                @foreach($photos as $photo)
                    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                        <img src="{{$photo['path'] ?? ''}}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                        <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>

                        <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-gray-300 z-10">
{{--                            <time datetime="2023-12-11" class="mr-8">11 Dec, 2023</time>--}}
{{--                            <div class="-ml-4 flex items-center gap-x-4">--}}
{{--                                <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">--}}
{{--                                    <circle cx="1" cy="1" r="1" />--}}
{{--                                </svg>--}}
{{--                                <div class="flex gap-x-2.5">--}}
{{--                                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-6 w-6 flex-none rounded-full bg-white/10">--}}
{{--                                    Michael Foster--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-white z-10">
{{--                            <a href="#">--}}
                                <span class="absolute inset-0"></span>
                                {{$photo['title'] ?? ''}}
{{--                            </a>--}}
                        </h3>
                    </article>
                @endforeach

            </div>
        </div>
    </div>

</div>
