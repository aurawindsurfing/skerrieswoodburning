<div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:text-center">
        {{--        <p class="text-base leading-6 text-blue-600 font-semibold tracking-wide uppercase">ABOUT US</p>--}}
        <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
            Upcoming Public Courses
        </h3>
        <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
            All courses are also available for private group bookings on any given date. If you do not see the course or
            date you require, please enquire as we may still be able to help you.
        </p>
    </div>

    <div class="my-16 bg-white shadow overflow-hidden sm:rounded-md">
        <ul>
            @foreach($upcoming_public_courses as $course)
                <li class="border-t border-gray-200">
                    <a href="#"
                       class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex items-center px-4 py-4 sm:px-6">
                            <div class="min-w-0 flex-1 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full"
                                         src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                         alt=""/>
                                </div>
                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                    <div>
                                        <div
                                            class="text-sm leading-5 font-medium text-indigo-600 truncate">{{$course->course_type->name}}</div>
                                        <div class="mt-2 flex items-center text-sm leading-5 text-gray-500">
                                            {{--                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">--}}
                                            {{--                                                <path fill-rule="evenodd" d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884zM18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" clip-rule="evenodd"/>--}}
                                            {{--                                            </svg>--}}
                                            <span class="">{{$course->venue->city}}</span>
                                        </div>
                                    </div>
                                    <div class="hidden md:block">
                                        <div>
                                            <div class="text-sm leading-5 text-gray-900">
                                                {{$course->date->format('d F Y (l) hA')}}
                                            </div>
                                            <div class="mt-2 flex items-center text-sm leading-5 text-gray-500">
                                                {{--                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">--}}
                                                {{--                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>--}}
                                                {{--                                                </svg>--}}
                                                Duration: {{$course->course_type->duration}} - valid
                                                for {{$course->course_type->valid_for_years}} years
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</div>
