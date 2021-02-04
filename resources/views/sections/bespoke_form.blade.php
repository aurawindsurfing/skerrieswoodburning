<div>
    @if (session('email-success'))
        <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center"
            {{--            x-data="{ open: true }"--}}
        >
            <div
                {{--                x-show="open == true"--}}
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

            <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline"
                 {{--                 x-show="open == true"--}}
                 {{--             @click.away="open = false"--}}
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
                            Thank you for your enquiry
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-500">
                                We will call you back in the next 2h hours.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                  <span class="flex w-full rounded-md shadow-sm">
                    <a href="{{route('home')}}" class="justify-center w-full">
                        <button
                            {{--                @click="open = false"--}}
                            type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                      Go back to homepage
                    </button>
                    </a>
                  </span>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div>
        <div class="min-h-screen">
            <div class="overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 ">
                    <div class="text-base max-w-prose mx-auto lg:max-w-none">
{{--                        <p class="text-base leading-6 text-indigo-600 font-semibold tracking-wide uppercase">CONSTRUCTION INDUSTRY TRAINING LTD</p>--}}
                        <h1 class="mt-2 mb-8 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">What makes us different</h1>
                    </div>
                    <div class="relative text-base max-w-prose mx-auto mb-8 lg:max-w-5xl lg:mx-0 lg:pr-72">
                        <h2 class="text-lg text-gray-500 leading-7">Thank you for your interest in this course. CIT have been providing training solutions for the past 25 years to a wide variety of companies and State bodies. We have a proven track record of listening to our client and delivering to them exactly what is needed.</h2>
                    </div>
                    <div class="lg:grid lg:grid-cols-2 lg:gap-24 lg:items-start">

                        <div class="relative mb-12 lg:mb-0">
                            <div class="mb-10 prose text-gray-500 mx-auto lg:max-w-none">
{{--                                                        <p>We offer a complete service including:</p>--}}
{{--                                                        <ul>--}}
{{--                                                            <li>Initial Training Needs Analysis</li>--}}
{{--                                                            <li>Professional Course Delivery</li>--}}
{{--                                                            <li>Post Delivery Course Feedback</li>--}}
{{--                                                        </ul>--}}
{{--                                                        <p>Rhoncus nisl, libero egestas diam fermentum dui. At quis tincidunt vel ultricies. Vulputate aliquet velit faucibus semper. Pellentesque in venenatis vestibulum consectetur nibh id. In id ut tempus egestas. Enim sit aliquam nec, a. Morbi enim fermentum lacus in. Viverra.</p>--}}
{{--                                                        <h2>We’re here to help</h2>--}}
{{--                                                        <p>Tincidunt integer commodo, cursus etiam aliquam neque, et. Consectetur pretium in volutpat, diam. Montes, magna cursus nulla feugiat dignissim id lobortis amet. Laoreet sem est phasellus eu proin massa, lectus. Diam rutrum posuere donec ultricies non morbi. Mi a platea auctor mi.</p>--}}
                            </div>

                            <h3 class="mt-2 mb-8 text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-3xl sm:leading-10">Your enquiry</h3>
                            <div>
                                <form action="{{ route('send_enquiry') }}" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-1 sm:gap-x-8">
                                    @csrf
                                    <input type="hidden" name="type" value="{{optional($type)->title}}">
                                    <div class="sm:col-span-2">
                                        <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input name="name" value="{{ old('name') }}" class="form-input py-3 px-4 block w-full transition ease-in-out duration-150">
                                        </div>
                                        @error('name')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="company" class="block text-sm font-medium leading-5 text-gray-700">Company</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input name="company" value="{{ old('company') }}" class="form-input py-3 px-4 block w-full transition ease-in-out duration-150">
                                        </div>
                                        @error('company')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input name="email" value="{{ old('email') }}" type="email" class="form-input py-3 px-4 block w-full transition ease-in-out duration-150">
                                        </div>
                                        @error('email')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="phone" class="block text-sm font-medium leading-5 text-gray-700">Phone Number</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input name="phone" value="{{ old('phone') }}" class="form-input py-3 px-4 block w-full  transition ease-in-out duration-150" placeholder="086 1231231">
                                        </div>
                                        @error('phone')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="enquiry" class="block text-sm font-medium leading-5 text-gray-700">Message</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <textarea name="enquiry" rows="4" class="form-textarea py-3 px-4 block w-full  transition ease-in-out duration-150">{{ old('enquiry') }}</textarea>
                                        </div>
                                        @error('enquiry')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                  <span class="w-full lg:w-1/2 inline-flex rounded-md shadow-sm">
                                    <button type="submit"
                                            class="mt-3 ml-0 w-full px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-0 sm:flex-shrink-0  sm:items-center">
                                      Send
                                    </button>
                                  </span>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="relative text-base max-w-prose mx-auto lg:max-w-none">
                            <svg class="absolute top-0 right-0 -mt-20 -mr-20 lg:top-auto lg:right-auto lg:bottom-1/2 lg:left-1/2 lg:mt-0 lg:mr-0 xl:top-0 xl:right-0 xl:-mt-20 xl:-mr-20" width="404" height="384" fill="none" viewBox="0 0 404 384">
                                <defs>
                                    <pattern id="bedc54bc-7371-44a2-a2bc-dc68d819ae60" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                                    </pattern>
                                </defs>
                                <rect class="hidden lg:block" width="404" height="384" fill="url(#bedc54bc-7371-44a2-a2bc-dc68d819ae60)" />
                            </svg>
                            <blockquote class="relative bg-gray-50 rounded-lg shadow-lg">
                                <div class="rounded-t-lg px-6 py-6 sm:px-10 sm:pb-8">
                                    <img src="https://res.cloudinary.com/gazeta-ireland-limited/image/upload/v1607103904/cit/logos/roadbridge.png"
                                         alt="Roadbridge"
                                         class="w-32">
                                    <div class="relative text-lg text-gray-700 leading-7 font-medium">
                                        <svg class="absolute top-0 left-0 transform -translate-x-3 -translate-y-2 h-8 w-8 text-gray-200" fill="currentColor" viewBox="0 0 32 32">
                                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                                        </svg>
                                        <p class="relative mt-3">At Roadbridge we have very high expectations of goods and services.
                                            They have to be efficient, cost effective and flexible.
                                            CIT have been providing Roadbridge with training and certification services for many years and have stood up to these demanding requirements.
                                            All of their instructors are extremely professional and have vast experience in their particular fields.
                                            The admin staff will move heaven and earth to ensure the customer gets what he wants with minimum disruption of day to day operations.
                                            I have no trouble in recommending them.
                                        </p>
                                    </div>
                                </div>
                                <cite class="flex items-center sm:items-start bg-blue-600 rounded-b-lg not-italic py-5 px-6 sm:py-5 sm:pl-12 sm:pr-10 sm:mt-10">
                                    <div class="rounded-full border-2 border-white mr-4 sm:-mt-15 sm:mr-6">
                                        <img class="w-12 h-12 sm:w-20 sm:h-20 rounded-full bg-indigo-300"
                                             src="https://res.cloudinary.com/gazeta-ireland-limited/image/upload/v1607088334/cit/testimonials/MRRoadbridge.jpg">
                                    </div>
                                    <span class="text-gray-400 font-semibold leading-6">
                              <strong class="text-white font-semibold">Michael Ryan</strong>
                              <br class="sm:hidden">
                              Health and Safety Manager
                            </span>
                                </cite>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



