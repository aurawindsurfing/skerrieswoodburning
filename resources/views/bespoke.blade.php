@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')
    <div x-data="{open_navbar: false, show_modal: false}">

        <div class="relative bg-white overflow-hidden">

            <div class="relative pt-6 md:pb-16 lg:pb-20 xl:pb-24">

                @include('sections.partials.navbar')
                @include('sections.partials.mobile-nav')

            </div>
        </div>

        @include('sections.bespoke_form')
    </div>
@include('sections.footer')


@endsection
