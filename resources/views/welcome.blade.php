@extends('layouts.app')

@section('title', 'Skerries Wood Burning ')
{{--@section('description', '')--}}

@section('body')
    <div class="relative min-h-screen">
    <div x-data="{ open_navbar: false, show_modal: false }"
        x-init="show_modal = @json(Session::has('overbooked')) || @json(Session::has('success'))"
         class="max-w-screen-xl mx-auto">

        @include('sections.our_principles')
        @include('sections.hero')
{{--        @include('sections.groups')--}}
{{--        @include('sections.public-courses-list')--}}
        @include('sections.logos')
    </div>
        <div class="space-y-8 xl:col-span-1">
            <p class="text-center text-gray-500 text-base leading-6">
                The best wood burning is by us.
            </p>
        </div>
    @include('sections.footer')
    </div>
@endsection
