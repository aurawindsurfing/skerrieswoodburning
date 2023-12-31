@extends('layouts.app')

@section('title', (' BOOK NOW - '.$venue->city.' - '.$venue->postal_code.' - '))
@section('description', ($venue ? 'Book now '.optional($venue)->name.', as well as ' : ''))

@section('body')
    <div class="relative">
        <div x-data="{open_navbar: false, show_modal: false}">
            <div class="bg-white overflow-hidden">
                <div class="pt-6 pb-4 md:pb-16 lg:pb-20 xl:pb-24">
                    @include('sections.partials.navbar')
                    @include('sections.partials.mobile-nav')
                </div>
            </div>

            <div class="relative py-8 bg-white overflow-hidden">
                <div class="hidden lg:block lg:absolute lg:inset-y-0 lg:h-full lg:w-full">
                    <div class="relative h-full text-lg max-w-prose mx-auto">
                        <svg class="absolute top-12 left-full transform translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
                            <defs>
                                <pattern id="74b3fd99-0a6f-4271-bef2-e80eeafdf357" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                                </pattern>
                            </defs>
                            <rect width="404" height="384" fill="url(#74b3fd99-0a6f-4271-bef2-e80eeafdf357)" />
                        </svg>
                        <svg class="absolute top-1/2 right-full transform -translate-y-1/2 -translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
                            <defs>
                                <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                                </pattern>
                            </defs>
                            <rect width="404" height="384" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
                        </svg>
                        <svg class="absolute bottom-12 left-full transform translate-x-32" width="404" height="384" fill="none" viewBox="0 0 404 384">
                            <defs>
                                <pattern id="d3eb07ae-5182-43e6-857d-35c643af9034" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                                </pattern>
                            </defs>
                            <rect width="404" height="384" fill="url(#d3eb07ae-5182-43e6-857d-35c643af9034)" />
                        </svg>
                    </div>
                </div>
                <div class="relative px-4 sm:px-6 lg:px-8">
                    <div class="text-lg mx-auto mb-6">
                        <h1 class="text-base text-center leading-6 text-blue-600 font-semibold tracking-wide uppercase">Safe Pass Course Dublin at</h1>
                        <div class="mt-2 mb-8 text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">{{$venue->name}}</div>
                        <h2 class="max-w-3xl mx-auto text-center prose prose-lg text-gray-500 leading-8">@markdown($venue->description)</h2>
                    </div>
                    <div class="prose prose-lg text-gray-500 mx-auto">
                      <figure>
                            <img class="w-full rounded-lg" src="{{$venue->image_url()}}" alt="{{$venue->name}}" width="1310" height="873">
                            <figcaption>Photo credit: Venue Owner's Website</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @include('sections.courses-list')

    {{--        <div class="max-w-3xl text-center prose prose-lg text-gray-500 mx-auto mb-12">--}}
    {{--            @markdown($venue->description)--}}
    {{--        </div>--}}

    @include('sections.footer')


@endsection
