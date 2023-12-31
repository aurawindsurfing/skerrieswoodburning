<div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pt-10" x-ref="list">
    <div class="lg:text-center">
{{--                <p class="text-base leading-6 text-blue-600 font-semibold tracking-wide uppercase">ABOUT US</p>--}}
        <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
            Upcoming Public Courses
        </h3>
        <p class="max-w-4xl mt-4 text-xl leading-7 text-gray-500 lg:mx-auto">
            All courses are also available for private group bookings on any given date. If you do not see the course or
            date you require, please
            <a href="{{route('bespoke')}}" class="text-gray-500 hover:text-gray-900">
                enquire
            </a>
            as we may still be able to help you.
        </p>
    </div>

    @includeWhen(isset($courses), 'sections.partials.list')

</div>
