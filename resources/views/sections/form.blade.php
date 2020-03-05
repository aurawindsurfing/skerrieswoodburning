<form action="/charge" method="post" id="payment-form">
<div>
        <div>
            <div>
                <h3 class="text- leading-6 font-medium text-gray-900">
                    You are now booking:
                </h3>
                <p class="mt-1 text-sm leading-5 text-gray-500">
                    {{$course->course_type->name}} at {{$course->venue->name}} on {{$course->date->format('d F Y (l) h A')}}
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
                    <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                        First name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="first_name" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="last_name" class="block text-sm font-medium leading-5 text-gray-700">
                        Last name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="last_name" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="email" type="email" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="pps" class="block text-sm font-medium leading-5 text-gray-700">
                        PPS number
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="pps" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="pps" class="block text-sm font-medium leading-5 text-gray-700">
                        Phone Number
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="phone_number" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="086 1231234" />
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
                    <div class="inline-block  mt-4 px-2 py-3 sm:col-span-4 mt-1 rounded-md shadow-md form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" id="card-element">
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
            <input type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out"
                    value="Pay and book now"
            >
{{--            </input>--}}
          </span>
        </div>
    </div>
</div>
</form>

<script>
    var stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
    var elements = stripe.elements();
    var card = elements.create('card', {
        hidePostalCode: true,
        style: {
            base: {
                // iconColor: '#666EE8',
                color: '#87919C',
                // lineHeight: '40px',
                // fontWeight: 300,
                // fontFamily: '"Inter", Inter, sans',
                // fontSize: '15px',

                '::placeholder': {
                    color: '#87919C',
                },
            },
        }
    });

    // Add an instance of the card UI component into the `card-element` <div>
    card.mount('#card-element');
</script>
