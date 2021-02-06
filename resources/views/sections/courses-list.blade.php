<div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pt-2" x-ref="list">
    <div class="lg:text-center">
        @if ($courses->count() > 0)
            <h2 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                {{ isset($course_type) ? 'Upcoming '.$course_type->name.' Courses' : 'Upcoming Courses'  }}
            </h2>
        @else
            <h2 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                {{ isset($course_type) ? 'We are sorry but there are no upcoming '.$course_type->name.' courses available' : 'We are sorry but there are no upcoming courses available'  }}
            </h2>
        @endif
        <p class="mt-4 max-w-4xl text-xl leading-7 text-gray-500 lg:mx-auto">
            All courses are also available for private group bookings on any given date. If you do not see the course or
            date you require, please enquire as we may still be able to help you.
        </p>
    </div>

    @includeWhen(isset($courses), 'sections.partials.list')

</div>
