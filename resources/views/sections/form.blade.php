<form action="{{route('store-booking')}}" method="post" id="payment-form">
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
                    {{$course->venue->name}}, {{$course->venue->address_line_1}}, {{$course->venue->postal_code}}, {{$course->venue->city}}
                </p>
                <br>
                <span class="text-sm leading-6 text-gray-500">on</span>
                <p class="mt-1 text-lg font-medium leading-5 text-gray-900">
                      {{$course->date->format('(l) d F Y, h A')}}
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
                        <input name="name" value="{{ old('name') }}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
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
                        <input name="surname" value="{{ old('surname') }}"  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
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
                        <input name="email" value="{{ old('email') }}"  type="email" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
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
                        <input name="phone" value="{{ old('phone') }}"  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="086 1231234" />
                    </div>
                    @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-4">
                    <div class="absolute flex items-center h-5">
                        <input type="hidden" name="pps" value="0">
                        <input type="checkbox" name="pps" value="1" {{ old('pps') ? 'checked' : null }} class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">

{{--                        <input name="pps" value="{{ old('pps') }}" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" />--}}
                    </div>
                    <div class="pl-7 text-sm leading-5">
                        <label for="pps" class="font-medium text-gray-700">I confirm I hold a valid Irish PPS number</label>
{{--                        <p class="text-gray-500">Let us know if you have valid PPS number.</p>--}}
                    </div>
                </div>


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

{{--                <p class="block text-sm font-medium leading-5 text-gray-700">--}}
{{--                    Credit or debit card--}}
{{--                </p>--}}
                <input id="card-holder-name" type="text">
                    <div id="card-element" class="block mt-4 px-2 py-3 sm:col-span-4 mt-1 rounded-md shadow-md form-input block  w-full sm:w-3/5 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
{{--                        <div class="">--}}
{{--                            <input class=""--}}
{{--                                   placeholder="4242 4242 4242 4242" />--}}
                            <div id="card-errors"></div>
{{--                        </div>--}}
{{--                    </input>--}}

{{--                    <input type="submit" class="submit" value="Submit Payment">--}}

            </div>

        </div>
    </div>
    <div class="mt-8 pt-5">
        <div class="flex justify-end">
            <a href="{{route('home')}}">
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                      Cancel
                    </button>
                </span>
            </a>
            <span class="ml-3 inline-flex rounded-md shadow-sm">
            <div class="card-button">
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out"
    {{--                    value="Pay and book now"--}}
                >Pay and book now
                </button>
            </div>
          </span>
        </div>
    </div>
</div>
</form>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('stripe-public-key');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );

        if (error) {
            // Display "error.message" to the user...
        } else {
            // The card has been verified successfully...
        }
    });


</script>

