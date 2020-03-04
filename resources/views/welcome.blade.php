@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')
    <div x-data="{open: false}">
        @include('sections.hero')
        @include('sections.about')
        @include('sections.groups')
        @include('sections.public-courses-list')
        @include('sections.logos')
    </div>

@include('sections.footer')


@endsection
