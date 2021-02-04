@extends('layouts.app')

@section('title', ($group->name.' BOOK NOW - '))
@section('description', ('Book now '.$group->name.', as well as '))

@section('body')
    <div x-data="{open_navbar: false, show_modal: false}" class="relative min-h-screen">
        <div class="bg-white overflow-hidden">
            <div class="pt-6 pb-4 md:pb-16 lg:pb-20 xl:pb-24">
                @include('sections.partials.navbar')
                @include('sections.partials.mobile-nav')
                <div class="mt-8 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-20 xl:mt-24">
                    @foreach($course_types as $type)
                        @include('sections.course-cta')
                    @endforeach
                </div>
            </div>
        </div>

        @include('sections.courses-list')

        @if (isset($courses))
            @include('sections.footer')
        @else
            <div class=" absolute inset-x-0 bottom-0">
                @include('sections.footer')
            </div>
        @endif

    </div>


@endsection
