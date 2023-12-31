@extends('layouts.app')

@section('body')
<div x-data="{open_navbar: false}" class="relative min-h-screen">
    <div class="relative bg-white overflow-hidden">
        <div class="relative pt-6 pb-16 md:pb-16 lg:pb-20 xl:pb-24">
            @include('sections.partials.navbar')
            @include('sections.partials.mobile-nav')
            <div class="mt-8 mx-auto w-full lg:w-1/2 px-4 sm:mt-12 sm:px-6 md:mt-20 xl:mt-24">
                @include('sections.form')
            </div>
        </div>
    </div>
    @include('sections.footer')
</div>

@endsection
