@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')

@include('sections.hero')
@include('sections.about')
@include('sections.groups')
@include('sections.public-courses-list')
@include('sections.logos')

@include('sections.footer')


@endsection
