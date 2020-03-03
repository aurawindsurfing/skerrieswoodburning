@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')

@include('sections.header')

{{--@include('sections.courses-list')--}}
@foreach($group->course_types as $type)
    @include('sections.course-cta')
@endforeach

{{--@include('sections.course-groups')--}}
{{--@include('sections.logos')--}}

@include('sections.footer')


@endsection
