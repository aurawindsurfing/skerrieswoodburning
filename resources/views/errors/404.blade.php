@extends('layouts.app')

@section('title', 'BOOK NOW! ')
{{--@section('description', '')--}}

@section('body')
    <div class="relative min-h-screen">
    <div x-data="{ open_navbar: false, show_modal: false }"
        x-init="show_modal = @json(Session::has('overbooked'))" class="max-w-screen-xl mx-auto">

            <div x-bind:class="{ 'relative': !show_modal }" class="bg-white overflow-hidden">
                <div x-bind:class="{ 'lg:absolute': !show_modal }"  class="hidden lg:block lg:inset-0">
                    <svg x-bind:class="{ 'hidden': show_modal, 'absolute': !show_modal }" class="top-0 left-1/2 transform translate-x-64 -translate-y-8" width="640" height="784"
                         fill="none" viewBox="0 0 640 784">
                        <defs>
                            <pattern id="svg-pattern-squares-desktop" x="118" y="0" width="20" height="20"
                                     patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                            </pattern>
                        </defs>
                        <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor"/>
                        <rect x="118" width="404" height="784" fill="url(#svg-pattern-squares-desktop)"/>
                    </svg>
                </div>
                <div x-bind:class="{ 'relative': !show_modal }" class="pt-6 pb-16 md:pb-16 lg:pb-20 xl:pb-24">

                    @include('sections.partials.navbar')

                    @include('sections.partials.mobile-nav')

                    <div class="mt-8 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-20 xl:mt-24">
                        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                                <div class="mt-1 text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:leading-none sm:text-6xl lg:text-5xl xl:text-5xl">
                                    We are really sorry
                                    <br class="hidden md:inline"/>
                                    <span class="text-blue-600">But we did not find what you were looking for!</span>
                                </div>
                                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                    Check links below, go back to the previous page or give us a call.
                                    We will be delighted to help you.
                                </p>
                                <div class="mt-5 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                                    <div class="flex flex-col sm:w-3/4 sm:mx-auto lg:mx-0">

                                        <div class="mt-3">
                                            <a href="{{route('list', ['type' => 'solas-safe-pass'])}}">
                                                <button class="mt-3 ml-0 w-full px-6 py-3 border border-transparent text-lg leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-0 sm:flex-shrink-0  sm:items-center ">
                                                    Book Safepass Now
                                                </button>
                                            </a>
                                        </div>

                                        <div class="mt-3">
                                            <a href="{{route('list')}}">
                                                <button class="mt-3 ml-0 w-full px-6 py-3 border text-lg leading-6 font-medium rounded-md text-blue-600 bg-gray-50 hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:bg-gray-100 focus:text-blue-700 transition duration-150 ease-in-out">
                                                    Book Other Course Now
                                                </button>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-12  sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                                                    <svg
                                                        class=" top-0 left-1/2 transform -translate-x-1/2 -translate-y-8 scale-75 origin-top sm:scale-100 lg:hidden"
                                                        width="640" height="784" fill="none" viewBox="0 0 640 784">
                                                        <defs>
                                                            <pattern id="svg-pattern-squares-mobile" x="118" y="0" width="20" height="20"
                                                                     patternUnits="userSpaceOnUse">
                                                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                                                            </pattern>
                                                        </defs>
                                                        <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor"/>
                                                        <rect x="118" width="404" height="784" fill="url(#svg-pattern-squares-mobile)"/>
                                                    </svg>
                                <div class="mx-auto w-full rounded-lg shadow-lg lg:max-w-2xl">
                                    <button
                                        class="block w-full rounded-lg overflow-hidden focus:outline-none focus:shadow-outline">
                                        <img class="w-full" src="https://res.cloudinary.com/gazeta-ireland-limited/image/upload/c_fit,dpr_auto,e_sharpen,h_1080,q_auto,w_1920/1CnIy2xeNEDVMDoS3YsfMpA5GWrSUMm6Qo65mlPo.jpeg" alt="Safe Pass Dublin"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    </div>
    <div class="inset-x-0 bottom-0">
        @include('sections.footer')
    </div>
    </div>
@endsection
