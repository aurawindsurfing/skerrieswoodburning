@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')

{{--    @include('sections.hero')--}}
{{--    @include('sections.hero1')--}}
@include('sections.hero2')
@include('sections.about')
@include('sections.course-types')
{{--@include('sections.cta')--}}
@include('sections.courses-list')
@include('sections.testimonials')
@include('sections.logos')

@include('sections.footer')


@endsection
