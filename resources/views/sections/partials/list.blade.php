<div class="my-16 bg-white shadow overflow-hidden sm:rounded-md">
    <ul>
        @foreach($courses as $course)
            @if ($course->placesLeft() > 0)
            <li class="border-t border-gray-200 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                <a href="{{route('create-booking', ['course'  => $course->slug])}}">
            @else
            <li x-bind:class="{ 'opacity-50 cursor-not-allowed': !show_modal }" class="border-t border-gray-200 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
            @endif
                    <div class="flex items-center justify-between px-4 py-4 sm:px-6">
                        <div class="flex items-center">
                            <div class="px-4 flex flex-wrap lg:flex-no-wrap">
                                <div>
                                    <h2 class="text-xl leading-5 font-medium text-blue-600 truncate">{{$course->course_type->name}}</h2>
                                    <div class="hidden md:flex mt-2 flex items-center text-sm leading-5 text-gray-500">
                                        <span>Duration: {{$course->course_type->duration}} - valid for {{$course->course_type->valid_for_years}} years</span>
                                    </div>
                                </div>
                                <div class="block ml-0 lg:ml-6">
                                    <h2 class="text-base leading-5 text-gray-900 pt-2 md:pt-0">
                                        {{$course->date->format('d F Y (l)') .' '. Carbon\Carbon::parse($course->time)->format('H:i')}}
                                        <h3 class="md:hidden">, {{$course->venue->address_line_1}}, {{$course->venue->city}}</h3>
                                    </h2>
                                    <div class="hidden md:flex mt-2 flex items-center text-sm leading-5 text-gray-500">
                                        <span class="">{{$course->venue_name()}}</span>
                                    </div>
                                </div>
                                <div class="flex-grow-0 block sm:hidden">
                                    <div class="block sm:hidden text-base leading-5 text-gray-900 pt-2 md:pt-0">
                                        @if ($course->placesLeft() > 5)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                {{ $course->placesLeft() }} places left
                                            </span>
                                        @endif
                                        @if ($course->placesLeft() <= 5 && $course->placesLeft() > 2)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                {{ $course->placesLeft() }} places left
                                            </span>
                                        @endif
                                        @if ($course->placesLeft() == 2)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                Only {{ $course->placesLeft() }} places remaining
                                            </span>
                                        @endif
                                        @if ($course->placesLeft() == 1)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                Only 1 place remaining
                                            </span>
                                        @endif
                                        @if ($course->placesLeft() <= 0)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            Fully booked
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="flex-grow-0 hidden sm:block">
                                <div class="text-base leading-5 text-gray-900 pt-2 md:pt-0">
                                    @if ($course->placesLeft() > 0)
                                    <a href="{{route('create-booking', ['course' => $course->slug])}}">
                                    @endif
                                        @if ($course->placesLeft() > 5)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                {{ $course->placesLeft() }} places left
                                            </span>
                                        @endif
                                        @if ($course->placesLeft() <= 5 && $course->placesLeft() > 2)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                {{ $course->placesLeft() }} places left
                                            </span>
                                        @endif
                                        @if ($course->placesLeft() == 2)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            Only {{ $course->placesLeft() }} places remaining
                                        </span>
                                        @endif
                                        @if ($course->placesLeft() == 1)
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            Only 1 place remaining
                                        </span>
                                        @endif
                                        @if ($course->placesLeft() <= 0)
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            Fully booked
                                        </span>
                                        @endif
                                    @if ($course->placesLeft() > 0)
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @if ($course->placesLeft() > 0)
                            <div class="flex w-48 hidden sm:block">
                                <div class="rounded-md shadow">
                                    <button class="w-48 mt-3 ml-0 px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-0 sm:flex-shrink-0  sm:items-center">
                                        <a href="{{route('create-booking', ['course' => $course->slug])}}">
                                            Book now
                                        </a>
                                    </button>

                                </div>
                            </div>
                            @else
                            <div class="flex w-48 hidden sm:block">
                                <div class="rounded-md shadow">
                                    <button x-bind:class="{'cursor-not-allowed': !show_modal }" class="w-48 mt-3 ml-0 px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-0 sm:flex-shrink-0 sm:items-center">
                                        Fully booked
                                    </button>
                                </div>
                            </div>
                            @endif
                        <div class="block sm:hidden">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>

                    </div>
            @if ($course->placesLeft() > 0)
                </a>
            @else
            </li>
            @endif
        @endforeach
    </ul>
</div>
