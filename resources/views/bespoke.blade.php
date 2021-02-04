@extends('layouts.app')

@section('title', 'CONTACT US ')

@section('body')
    <div x-data="{open_navbar: false, show_modal: false}" class="relative min-h-screen">
        <div class=" bg-white overflow-hidden">
            <div class=" pt-6 md:pb-16 lg:pb-20 xl:pb-24">
                @include('sections.partials.navbar')
                @include('sections.partials.mobile-nav')
            </div>
        </div>

        @include('sections.bespoke_form')
    </div>

    @include('sections.footer')

@endsection
