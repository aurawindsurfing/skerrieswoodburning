@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')
    <div x-data="{open: false}">

        <div class="relative bg-white overflow-hidden">

            <div class="relative pt-6 pb-16 md:pb-16 lg:pb-20 xl:pb-24">

                @include('sections.partials.navbar')
                @include('sections.partials.mobile-nav')

{{--                <div class="mt-8 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-20 xl:mt-24">--}}
{{--                    <div class="lg:grid lg:grid-cols-12 lg:gap-8">--}}
{{--                        <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">--}}
{{--                            @foreach($group->course_types as $type)--}}
{{--                                @include('sections.course-cta')--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>

        @include('sections.courses-list')
    </div>
@include('sections.footer')


@endsection