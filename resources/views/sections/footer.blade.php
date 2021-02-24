
<footer class="bg-white">
    <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8 xl:col-span-1">
                <a href="{{route('home')}}">
                    <img class="h-10 w-auto sm:h-8" src="/images/cit_logo2.svg" alt="Contruction Industry Training Ltd"/>
                </a>
                <p class="text-gray-500 text-base leading-6">
                    Your Workplace Safety Starts With Us.
                </p>
            </div>
            <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                            Popular Courses
                        </h4>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="{{route('group', ['group' => 'solas-safe-pass-courses-dublin'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Safe Pass
                                </a>
                            </li>

                            <li>
                                <a href="{{route('group', ['group' => 'first-aid-courses-dublin'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    First Aid
                                </a>
                            </li>

                            <li>
                                <a href="{{route('group', ['group' => 'mewp-courses-dublin'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    MEWP
                                </a>
                            </li>

                            <li>
                                <a href="{{route('group', ['group' => 'manual-handling-courses-dublin'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Manual Handling
                                </a>
                            </li>

                            <li>
                                <a href="{{route('group', ['group' => 'other-courses'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Other safety courses
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <h4 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                            Our Venues
                        </h4>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="{{route('venue', ['venue' => 'parslickstown-house-base-enterprise-centre-ladyswell-road-mulhuddart-dublin-15-dublin-d15-x2vw'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Parslickstown House
                                </a>
                            </li>

                            <li>
                                <a href="{{route('venue', ['venue' => 'carlton-hotel-tyrrelstown-dublin-15'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Carlton Hotel
                                </a>
                            </li>

                            <li>
                                <a href="{{route('venue', ['venue' => 'the-grasshopper-inn-main-street-clonee-meath'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Grasshopper Inn
                                </a>
                            </li>

                            <li>
                                <a href="{{route('venue', ['venue' => 'wynn-s-hotel'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Wynn's Hotel
                                </a>
                            </li>

                            <li>
                                <a href="{{route('venue', ['venue' => 'red-cow-moran-hotel'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Red Cow Moran Hotel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h4 class="text-sm leading-5 font-semibold text-gray-400 tracking-wider uppercase">
                            FAQ
                        </h4>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="{{route('blog', ['blogpost' => 'how-much-is-safe-pass-in-ireland'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    How much is Safe Pass in Ireland?
                                </a>
                            </li>
                            <li>
                                <a href="{{route('blog', ['blogpost' => 'can-you-do-safe-pass-course-online'])}}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                                    Can you do Safe Pass course online?
                                </a>
                            </li>
                            <li>
                                <a href="{{route('blog', ['blogpost' => 'where-can-you-get-safe-pass'])}}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                                    Where can you get safe pass?
                                </a>
                            </li>
                            <li>
                                <a href="{{route('blog', ['blogpost' => 'what-is-solas-safe-pass'])}}" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                                    What is SOLAS Safe Pass?
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                            Legal
                        </h3>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="{{route('blog', ['blogpost' => 'privacy-policy'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Privacy Policy
                                </a>
                            </li>

                            <li>
                                <a href="{{route('blog', ['blogpost' => 'cookies-policy'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Cookies Policy
                                </a>
                            </li>

                            <li>
                                <a href="{{route('blog', ['blogpost' => 'cancellation-policy'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Cancellation Policy
                                </a>
                            </li>

                            <li>
                                <a href="{{route('blog', ['blogpost' => 'refund-policy'])}}" class="text-base text-gray-500 hover:text-gray-900">
                                    Refund Policy
                                </a>
                            <li>
                                <a href="{{route('bespoke')}}" class="text-gray-500 hover:text-gray-900">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-200 pt-8">
            <p class="text-base leading-6 text-gray-400 xl:text-center">
                &copy; {{ now()->year }} CIT Ltd. All rights reserved.
            </p>
        </div>
    </div>
</footer>


