<div>
    <div>
        @if (session('success'))
        <div x-data="{ open: true }"
             class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
            <div x-show="open == true"
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
                 x-show="open == true"
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
        <a href="{{route('home')}}" class="justify-center w-full">
            <button
                {{--                @click="open = false"--}}
                type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
          I understand
        </button>
        </a>
      </span>
                </div>
            </div>
        </div>
        @endif
        @if (session('card-error'))
            <div x-data="{ open2: true }" x-show="open2 == true"
                 class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
                <div x-show="open2 == true"
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
                     x-show="open2 == true"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                {{ session('card-error') }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Please try again or go back and try again later. Please remember there is limited amount of spaces available!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button @click="open2 = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Try again
                        </button>
                        <a href="{{route('home')}}">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Go back
                            </button>
                        </a>
                    </div>
                </div>





            </div>
        @endif
    </div>
    <div>
        <form action="{{route('store-booking')}}" method="post" id="payment-form">
            <input type="hidden" name="courseId" value="{{$course->id}}">
            @csrf
            <div>
                <div>
                    <div>
                        <h3 class="text-sm leading-6 text-gray-500">
                            You are now booking:
                        </h3>
                        <p class="mt-1 text-2xl font-medium leading-5 text-gray-900">
                            {{$course->course_type->name}}
                        </p>
                        <br>
                        <span class="text-sm leading-6 text-gray-500">at</span>
                        <p class="mt-1 text-lg font-medium leading-5 text-gray-900">
                            {{$course->venue->name}}, {{$course->venue->address_line_1}}, {{$course->venue->postal_code}}
                            , {{$course->venue->city}}
                        </p>
                        <br>
                        <span class="text-sm leading-6 text-gray-500">on</span>
                        <p class="mt-1 text-lg font-medium leading-5 text-gray-900">
                            {{$course->date->format('(l) d F Y').', '.Carbon\Carbon::parse($course->time)->format('H:i')}}
                        </p>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Personal Information
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            Remember that if you do not have PPS you can still attend the course.
                        </p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                First name
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input name="name" value="{{ old('name') }}"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                            </div>
                            @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="surname" class="block text-sm font-medium leading-5 text-gray-700">
                                Last name
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input name="surname" value="{{ old('surname') }}"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                            </div>
                            @error('surname')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input name="email" value="{{ old('email') }}" type="email"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                            </div>
                            @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-4">
                            <label for="phone" class="block text-sm font-medium leading-5 text-gray-700">
                                Phone Number
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input name="phone" value="{{ old('phone') }}"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                       placeholder="086 1231234"/>
                            </div>
                            @error('phone')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <div class="bg-white rounded-md -space-y-px">
                                <!-- On: "bg-indigo-50 border-indigo-200 z-10", Off: "border-gray-200" -->
                                <div class=" border rounded-tl-md rounded-tr-md p-4 flex">
                                    <div class="flex items-center h-5">
                                        <input
                                            name="pps"
                                            value="1"
                                            {{ old('pps') == true ? 'checked' : '' }}
                                            id="settings-option-0"
                                            type="radio"
                                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out cursor-pointer">
                                    </div>
                                    <label for="settings-option-0" class="ml-3 flex flex-col cursor-pointer">
                                        <!-- On: "text-indigo-900", Off: "text-gray-900" -->
                                        <span class="block text-sm leading-5 font-medium">
                                          I have Irish PPS number
                                        </span>
                                        <!-- On: "text-indigo-700", Off: "text-gray-500" -->
{{--                                        <span class="block text-sm leading-5"></span>--}}
                                    </label>
                                </div>

                                <!-- On: "bg-indigo-50 border-indigo-200 z-10", Off: "border-gray-200" -->
                                <div class=" border border-gray-200 rounded-bl-md rounded-br-md p-4 flex">
                                    <div class="flex items-center h-5">
                                        <input
                                            name="pps"
                                            value="0"
                                            {{ old('pps') !== null &&  old('pps') == false ? 'checked' : '' }}
                                            id="settings-option-1"
                                            type="radio"
                                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out cursor-pointer">
                                    </div>
                                    <label for="settings-option-1" class="ml-3 flex flex-col cursor-pointer">
                                        <!-- On: "text-indigo-900", Off: "text-gray-900" -->
                                        <span class="block text-sm leading-5 font-medium">
                                          I do not have an Irish PPS number
                                        </span>
                                        <!-- On: "text-indigo-700", Off: "text-gray-500" -->
{{--                                        <span class="block text-sm leading-5"></span>--}}
                                    </label>
                                </div>

                            </div>
                        </div>
                        @error('pps')
                        <p class="text-red-500 text-xs italic sm:col-span-6">{{ $message }}</p>
                        @enderror

                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Payment
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            You will be charged {{$course->price}} euro
                        </p>

                        <div id="card-element"
                             class="mt-4 px-2 py-3 sm:col-span-4 mt-1 rounded-md shadow-md form-input block w-full sm:w-3/5 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <div id="card-errors"></div>
                        </div>

                        @if (session('card-error'))
                            <p class="text-red-500 text-xs italic">{{ session('card-error') }}</p>
                        @endif

                    </div>
                </div>
                <div class="mt-8 pt-5">
                    <div class="flex justify-end">
                        <a href="{{route('home')}}">
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button"
                            class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                      Cancel
                    </button>
                </span>
                        </a>
                        <span class="ml-3 inline-flex rounded-md shadow-sm">
            <div class="card-button">
                <button type="submit"
                        id="card-button"
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out"
                >Pay and book now
                </button>
            </div>
          </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{env('STRIPE_KEY')}}');
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        hidePostalCode: true,
    });

    cardElement.mount('#card-element');

    // const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    cardButton.addEventListener('click', async (e) => {
        const {paymentMethod, error} = await stripe.createPaymentMethod(
            'card', cardElement, {
                // billing_details: { name: cardHolderName.value }
            }
        );

        if (error) {
        } else {
            stripePaymentHandler(paymentMethod);
        }
    });


    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
    });

    // Submit the form with the token ID.
    function stripePaymentHandler(paymentMethod) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripePaymentMethodId');
        hiddenInput.setAttribute('value', paymentMethod.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }


</script>

