@extends('layouts.app')

@section('title', __('Construction Training Provider'))
@section('description', __('Quality Training, Excellent Service, Experienced Team, Attention to detail'))
@section('keywords', __('Training, Construction, Safepass, Safety'))

@section('body')
    <div x-data="{open: false}">
        @include('sections.header')
        @include('sections.courses-list')
    </div>
@include('sections.footer')


@endsection
