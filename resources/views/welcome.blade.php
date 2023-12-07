@extends('layouts.app')

@section('title', 'Skerries Wood Burning ')
@section('description', "Skerries Wood Burning can be found in many places such as Eurospar Skerries, Bradly's Pharmacy and St'Vincents. We sell colored ornament Chrismas Coasters and Pecil Cases.")


@section('body')
    <div class=" min-h-screen">
        <div class="max-w-screen-xl mx-auto">

{{--            @include('sections.hero')--}}
            @include('sections.photos')
            @include('sections.team')
            {{--        @include('sections.groups')--}}
            {{--        @include('sections.public-courses-list')--}}
            @include('sections.logos')
        </div>
        <div class="text-center space-y-8 xl:col-span-1">
            <p class="text-gray-500 text-base leading-6">
                The best wood burning is by us.
            </p>
        </div>
        @include('sections.footer')
    </div>
@endsection
