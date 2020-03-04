<div class="bg-gray-100">
    <div class="pt-12 sm:pt-16 lg:pt-20">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10 lg:text-5xl lg:leading-none">
                    {{$type->name}}
                </h2>
                <p class="mt-4 text-xl leading-7 text-gray-500">
                    {{$type->objectives}}
                </p>
            </div>
        </div>
    </div>
    <div class="mt-8 bg-white pb-16 sm:mt-12 sm:pb-20 lg:pb-28">
        <div class="relative">
            <div class="absolute inset-0 h-1/2 bg-gray-100"></div>
            <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
                    <div class="bg-white px-6 py-8 lg:flex-shrink-1 lg:p-12">
                        <h3 class="text-2xl leading-8 font-extrabold text-gray-900 sm:text-3xl sm:leading-9">
                            Who should attend
                        </h3>
                        <p class="mt-6 text-base leading-6 text-gray-500">
                            {{$type->who_should_attend}}
                        </p>
                        <div class="mt-8">
                            <div class="flex items-center">
                                <h4 class="flex-shrink-0 pr-4 bg-white text-sm leading-5 tracking-wider font-semibold uppercase text-indigo-600">
                                    Important information
                                </h4>
                                <div class="flex-1 border-t-2 border-gray-200"></div>
                            </div>
                            <ul class="mt-8 lg:grid lg:grid-cols-2 lg:col-gap-8 lg:row-gap-5">
                                <li class="flex items-start lg:col-span-1">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">Outline: </span>{{$type->outline}}
                                    </p>
                                </li>
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">Delegates: </span>{{$type->delegates}}
                                    </p>
                                </li>
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">Duration: </span>{{$type->duration}}
                                    </p>
                                </li>
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">Certification: </span>{{$type->certification}}
                                    </p>
                                </li>
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">What to bring: </span>{{$type->what_to_bring}}
                                    </p>
                                </li>
                                @isset($type->plan_of_the_day)
                                    <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <p class="ml-3 text-sm leading-5 text-gray-700">
                                            <span class="font-semibold">Plan of the day: </span>{{$type->plan_of_the_day}}
                                        </p>
                                    </li>
                                @endisset
                            </ul>
                        </div>
                    </div>
                    <div class="py-8 px-6 text-center bg-gray-50 lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                        <p class="text-lg leading-6 font-medium text-gray-900">
                            Valid for {{$type->valid_for_years}} years
                        </p>
                        <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-900">
              <span>
                €{{$type->default_rate}}
              </span>
                            <span class="ml-3 text-xl leading-7 font-medium text-gray-500">
                EUR
              </span>
                        </div>
                        <p class="mt-4 text-sm leading-5">
                            <a href="#" class="font-medium text-gray-500 underline">
                                Start time: {{$type->start_time}}
                            </a>
                        </p>
                        <div class="mt-6">
                            <div class="rounded-md shadow">
                                <a href="#" class="flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                    Book now
                                </a>
                            </div>
                        </div>
                        <div class="mt-4 text-sm leading-5">
                            <a href="#" class="font-medium text-gray-900">
                                Capacity
                                <span class="font-normal text-gray-500">
                  ({{$type->capacity}} seats)
                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
