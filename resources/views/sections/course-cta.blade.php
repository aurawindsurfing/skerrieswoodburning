<div x-data="{ open: false }">
    <div x-show="open == true"
         class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
        <div
{{--            x-show="open == true"--}}
             class="fixed inset-0 transition-opacity"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
        >
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
{{--            x-show="open == true"--}}
            class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline"
             @click.away="open = false"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <div>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                        Thank you for your booking!
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm leading-5 text-gray-500">
                            You will receive <b>a text</b> and <b>an email</b> with booking confirmation shortly.
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
      <span class="flex w-full rounded-md shadow-sm">
{{--        <a href="{{route('home')}}" class="justify-center w-full">--}}
            <button
                @click="open = false"
                type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
          I understand
        </button>
{{--        </a>--}}
      </span>
            </div>
        </div>
</div>
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
                                        <span class="font-semibold">What to bring: </span>{{$type->what_to_bring}}
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
                                        <span class="font-semibold">Delegates: </span>{{$type->delegates}}
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
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">Valid for: </span>{{$type->valid_for_years}} years
                                    </p>
                                </li>
                                <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="ml-3 text-sm leading-5 text-gray-700">
                                        <span class="font-semibold">Start time: </span>{{ Carbon\Carbon::parse($type->start_time)->format('h A')}}
                                    </p>
                                </li>
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
                                <div class="rounded-md shadow"
                                    {{--  @click.prevent="$refs.list.scrollIntoView()"--}}
                                >
                                    <a href="{{ route('list', ['type' => $type->id]) }}"
                                       class="flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                        Book course
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-lg leading-6 font-medium text-gray-900">
                                Bespoke solution
                            </p>
                            <div class="mt-4 text-sm leading-5 max-w-8">
                                <div class="font-medium text-gray-500">
                                    This course is company specific
                                </div>
                                <div class="font-medium text-gray-500">
                                    This is tailroded solution
                                </div>
                            </div>
                            <div class="mt-6">
                                <div class="rounded-md shadow"
                                    {{--  @click.prevent="$refs.list.scrollIntoView()"--}}
                                >
                                    <button @click="open = true"
                                            type="button"
                                            class="flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                        Find out more
                                    </button>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
