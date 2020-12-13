@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

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
