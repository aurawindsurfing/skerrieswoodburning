@extends('layouts.app')

@section('title', (optional($type)->name.' BOOK NOW - '))
@section('description', ($type ? 'Book now '.optional($type)->name.', as well as ' : ''))

@section('body')
    <div class="relative min-h-screen">
        @include('sections.footer')
        <div x-data="{open_navbar: false, show_modal: false}">
            <div class="bg-white overflow-hidden">
                <div class="pt-6 pb-4 md:pb-16 lg:pb-20 xl:pb-24">
                    @include('sections.partials.navbar')
                    @include('sections.partials.mobile-nav')
                </div>
            </div>
            @include('sections.courses-list')
        </div>
    </div>


@endsection
