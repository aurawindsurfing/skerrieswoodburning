<div>
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
                    <div class="bg-white px-6 py-8 lg:flex-1 lg:p-12">
                        <h3 class="text-2xl leading-8 font-extrabold text-gray-900 sm:text-3xl sm:leading-9">
                            Who should attend:
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
                                @isset($type->outline)
                                <li class="flex items-start lg:col-span-1">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">Outline: </span>
                                        <article class="prose prose-sm text-sm leading-5 text-gray-700">{!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($type->outline) !!}</article>
                                    </div>
                                </li>
                                @endisset
                                @isset($type->certification)
                                    <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3 text-sm leading-5 text-gray-700">
                                            <article class="font-semibold">Certification: </article>{{$type->certification}}
                                        </div>
                                    </li>
                                @endisset
                                @isset($type->what_to_bring)
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">What to bring: </span>
                                        <article class="prose prose-sm text-sm leading-5 text-gray-700">{!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($type->what_to_bring) !!} </article>
                                    </div>
                                </li>
                                @endisset
                                @isset($type->plan_of_the_day)
                                    <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3 text-sm leading-5 text-gray-700">
                                            <span class="font-semibold">What to bring: </span>
                                            <article class="prose prose-sm text-sm leading-5 text-gray-700">{!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($type->plan_of_the_day) !!} </article>
                                        </div>
                                    </li>
                                @endisset
                                @isset($type->duration)
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-sm leading-5 text-gray-700">
                                        <article class="font-semibold">Duration: </article>{{$type->duration}}
                                    </div>
                                </li>
                                @endisset

                                @isset($type->delegates)
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-sm leading-5 text-gray-700">
                                        <article class="font-semibold">Delegates: </article>{{$type->delegates}}
                                    </div>
                                </li>
                                @endisset
                                @isset($type->valid_for_years)
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-sm leading-5 text-gray-700">
                                        <article class="font-semibold">Valid for: </article>{{$type->valid_for_years}} years
                                    </div>
                                </li>
                                @endisset
                                @isset($type->start_time)
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-sm leading-5 text-gray-700">
                                        <article class="font-semibold">Start time: </article>{{ Carbon\Carbon::parse($type->start_time)->format('H:i')}}
                                    </div>
                                </li>
                                @endisset
                            </ul>
                        </div>
                    </div>
                    <div class="py-8 px-6 text-center bg-gray-50 lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                        @if ($type->default_rate > 0)
                            <div class="mt-4 flex items-center justify-center text-4xl leading-none font-extrabold text-gray-900">
                              <span>
                                €{{$type->default_rate}}
                              </span>
                                <span class="ml-3 text-xl leading-7 font-medium text-gray-500">
                                EUR
                              </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('list', ['type' => $type->id]) }}"
                                   class="flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                    <button class="rounded-md shadow w-full">
                                        Book course
                                    </button>
                                </a>
                            </div>
                        @else
{{--                            <p class="text-lg leading-6 font-medium text-gray-900">--}}
{{--                                Bespoke solution--}}
{{--                            </p>--}}
                            <div class="flex justify-center pt-4">

                                    <a href="{{ route('bespoke', ['type' => $type->id]) }}"
                                       class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                        <button class="rounded-md shadow w-full">
                                        Make enquiry
                                        </button>
                                    </a>
                            </div>
                            <p class="font-medium text-gray-500 pt-2">
                                or
                            </p>
                            <div class="flex justify-center w-full">
                                    <a href="tel: +35318097266" class="w-full">
                                        <button class="mt-2 ml-0 w-full px-6 py-3 border text-lg leading-6 font-medium rounded-md text-blue-600 bg-gray-50 hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:bg-gray-100 focus:text-blue-700 transition duration-150 ease-in-out">
                                        Call us now
                                        </button>
                                    </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
