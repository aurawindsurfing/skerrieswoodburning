<div class="my-16 bg-white shadow overflow-hidden sm:rounded-md">
    <ul>
        @foreach($courses as $course)
            <li class="border-t border-gray-200">
                <a href="#"
                   class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="flex items-center px-4 py-4 sm:px-6">
                        <div class="min-w-0 flex-1 flex items-center">
                            <div class="flex-shrink-0">
                                {{--                                    <img class="h-12 w-12 rounded-full"--}}
                                {{--                                         src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"--}}
                                {{--                                         alt=""/>--}}
                            </div>
                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                <div>
                                    <div
                                        class="text-xl leading-5 font-medium text-blue-600 truncate">{{$course->course_type->name}}</div>
                                    <div
                                        class="hidden md:flex mt-2 flex items-center text-sm leading-5 text-gray-500">
                                        <svg class="flex-shrink-0 -ml-1  mr-1.5 h-5 w-7 text-gray-400"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path class="heroicon-ui"
                                                  d="M14 5.62l-4 2v10.76l4-2V5.62zm2 0v10.76l4 2V7.62l-4-2zm-8 2l-4-2v10.76l4 2V7.62zm7 10.5L9.45 20.9a1 1 0 0 1-.9 0l-6-3A1 1 0 0 1 2 17V4a1 1 0 0 1 1.45-.9L9 5.89l5.55-2.77a1 1 0 0 1 .9 0l6 3A1 1 0 0 1 22 7v13a1 1 0 0 1-1.45.89L15 18.12z"/>
                                        </svg>
                                        <span class="">{{$course->venue->city}}</span>
                                    </div>
                                </div>
                                <div class="block">
                                    <div>
                                        <div class="text-base leading-5 text-gray-900 pt-2 md:pt-0">
                                            {{$course->date->format('d F Y (l) hA')}}
                                            <span class="md:hidden">, {{$course->venue->city}}</span>
                                        </div>
                                        <div
                                            class="hidden md:flex mt-2 flex items-center text-sm leading-5 text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                      clip-rule="evenodd"/>
                                            </svg>
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