@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')
    <div class="max-w-screen-xl mx-auto" x-data="{open: false}">
        @include('sections.hero')
        @include('sections.our_principles')
        @include('sections.groups')
        @include('sections.public-courses-list')
        @include('sections.logos')
    </div>

@include('sections.footer')
@endsection
