@extends('layouts.app')

@section('title', 'Skerries Wood Burning ')
{{--@section('description', '')--}}

@section('body')
    <div class="relative min-h-screen">
    <div x-data="{ open_navbar: false, show_modal: false }"
        x-init="show_modal = @json(Session::has('overbooked')) || @json(Session::has('success'))"
         class="max-w-screen-xl mx-auto">
        @include('sections.hero')
        @include('sections.our_principles')
{{--        @include('sections.groups')--}}
{{--        @include('sections.public-courses-list')--}}
        @include('sections.logos')
    </div>

    @include('sections.footer')
    </div>
@endsection
